<?php

namespace App\Http\Controllers;

use App\Models\Bumdes;
use Illuminate\Http\Request;

use App\Exports\BumdesExport;
use Maatwebsite\Excel\Facades\Excel;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class BumdesController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $bumdes = Bumdes::with(['desa.kecamatan'])
            ->when($search, function ($q) use ($search) {
                $q->where(function ($qq) use ($search) {
                    $qq->where('nama_bumdes', 'like', "%{$search}%")
                        ->orWhere('direktur', 'like', "%{$search}%")
                        ->orWhere('status_hukum', 'like', "%{$search}%")
                        ->orWhere('klasifikasi', 'like', "%{$search}%")
                        ->orWhereHas('desa', function ($q2) use ($search) {
                            $q2->where('nama_desa', 'like', "%{$search}%");
                        })
                        ->orWhereHas('desa.kecamatan', function ($q3) use ($search) {
                            $q3->where('nama_kecamatan', 'like', "%{$search}%");
                        });
                });
            })
            ->orderBy('nama_bumdes')
            ->paginate(10)
            ->withQueryString();

        return view('bumdes.index', compact('bumdes'));
    }

    public function exportExcel(Request $request)
    {
        $search = $request->search;
        $filename = 'data-bumdes-' . now()->format('Ymd-His') . '.xlsx';

        return Excel::download(new BumdesExport($search), $filename);
    }

    public function exportWord(Request $request)
    {
        $search = $request->search;

        $data = Bumdes::with(['desa.kecamatan'])
            ->when($search, function ($q) use ($search) {
                $q->where(function ($qq) use ($search) {
                    $qq->where('nama_bumdes', 'like', "%{$search}%")
                        ->orWhere('direktur', 'like', "%{$search}%")
                        ->orWhere('status_hukum', 'like', "%{$search}%")
                        ->orWhere('klasifikasi', 'like', "%{$search}%");
                });
            })
            ->orderBy('nama_bumdes')
            ->get();

        $phpWord = new PhpWord();
        $section = $phpWord->addSection([
            'marginTop' => 600,
            'marginBottom' => 600,
            'marginLeft' => 600,
            'marginRight' => 600,
        ]);

        $section->addText('DATA BUMDes', ['bold' => true, 'size' => 14]);
        $section->addText('Kabupaten Sumenep', ['size' => 11, 'color' => '666666']);
        $section->addTextBreak(1);

        $phpWord->addTableStyle('BumdesTable', [
            'borderSize' => 6,
            'borderColor' => '999999',
            'cellMargin' => 90,
        ]);

        $table = $section->addTable('BumdesTable');

        $headers = ['No', 'Nama BUMDes', 'Desa', 'Kecamatan', 'Direktur', 'Status Hukum', 'Klasifikasi'];
        $table->addRow();
        foreach ($headers as $h) {
            $table->addCell(2300)->addText($h, ['bold' => true]);
        }

        $no = 1;
        foreach ($data as $b) {
            $table->addRow();
            $table->addCell(700)->addText((string) $no++);
            $table->addCell(2600)->addText($b->nama_bumdes ?? '-');
            $table->addCell(2000)->addText($b->desa->nama_desa ?? '-');
            $table->addCell(2000)->addText($b->desa->kecamatan->nama_kecamatan ?? '-');
            $table->addCell(2000)->addText($b->direktur ?? '-');
            $table->addCell(2000)->addText($b->status_hukum ?? '-');
            $table->addCell(2000)->addText($b->klasifikasi ?? '-');
        }

        $filename = 'data-bumdes-' . now()->format('Ymd-His') . '.docx';
        $tempPath = storage_path('app/' . $filename);

        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($tempPath);

        return response()->download($tempPath)->deleteFileAfterSend(true);
    }
}