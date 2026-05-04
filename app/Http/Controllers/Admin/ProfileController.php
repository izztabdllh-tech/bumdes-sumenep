<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $admin = (object) [
            'username' => session('admin_username', 'Admin'),
            'name' => session('admin_name', ''),
            'email' => session('admin_email', ''),
            'phone' => session('admin_phone', ''),
            'date_of_birth' => session('admin_date_of_birth', ''),
            'country' => session('admin_country', ''),
            'photo' => session('admin_photo', null),
        ];

        return view('admin.profile.edit', compact('admin'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'country' => 'nullable|string|max:100',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,jfif|max:2048',
        ]);

        if ($request->filled('password_baru') || $request->filled('password_lama') || $request->filled('password_baru_confirmation')) {
            $request->validate([
                'password_lama' => 'required',
                'password_baru' => 'required|min:6|confirmed',
            ]);
        }

        $photoName = session('admin_photo');

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $photoName = time() . '_' . $file->getClientOriginalName();

            $destination = public_path('uploads/profile');
            if (!file_exists($destination)) {
                mkdir($destination, 0777, true);
            }

            $file->move($destination, $photoName);
        }

        session([
            'admin_username' => $request->username,
            'admin_name' => $request->name,
            'admin_email' => $request->email,
            'admin_phone' => $request->phone,
            'admin_date_of_birth' => $request->date_of_birth,
            'admin_country' => $request->country,
            'admin_photo' => $photoName,
        ]);

        $message = 'Profil berhasil diperbarui.';

        if ($request->filled('password_baru')) {
            $message = 'Profil berhasil diperbarui. Password belum benar-benar disimpan karena masih menggunakan session.';
        }

        return redirect()->back()->with('success', $message);
    }
}