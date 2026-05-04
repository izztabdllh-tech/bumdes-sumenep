<?php

namespace App\Exports;

use App\Models\Bumdes;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BumdesExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(private ?string $search = null) {}

    public function collection(): Collection
    {
        return Bumdes::with(['desa.kecamatan'])
            ->when($this->search, function ($q) {
                $s = $this->search;
                $q->where('nama_bumdes', 'like', "%{$s}%")
                  ->orWhere('direktur', 'like', "%{$s}%")
                  ->orWhere('status_hukum', 'like', "%{$s}%")
                  ->orWhere('klasifikasi', 'like', "%{$s}%");
            })
            ->orderBy('nama_bumdes')
            ->get();
    }

    public function headings(): array
    {
        return ['No','Nama BUMDes','Desa','Kecamatan','Direktur','Status Hukum','Klasifikasi'];
    }

    public function map($b): array
    {
        static $no = 0; $no++;

        return [
            $no,
            $b->nama_bumdes ?? '-',
            $b->desa->nama_desa ?? '-',
            $b->desa->kecamatan->nama_kecamatan ?? '-',
            $b->direktur ?? '-',
            $b->status_hukum ?? '-',
            $b->klasifikasi ?? '-',
        ];
    }
}
