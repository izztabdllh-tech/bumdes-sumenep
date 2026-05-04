@extends('layouts.public')
@section('title', 'Edit Profil Admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4 p-md-5">

                    {{-- Header --}}
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
                        <div>
                            <h3 class="mb-1 fw-semibold">Edit Profil Admin</h3>
                            <p class="text-muted mb-0">Kelola informasi profil administrator</p>
                        </div>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary rounded-3 px-4">
                            Kembali
                        </a>
                    </div>

                    @include('admin.partials.alert')

                    @if($errors->any())
                        <div class="alert alert-danger rounded-3">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf

                        {{-- FOTO PROFIL --}}
                        <div class="card border-0 bg-light rounded-4 mb-4">
                            <div class="card-body p-4 text-center">

                                @if(!empty($admin->photo))
                                    <img src="{{ asset('uploads/profile/' . $admin->photo) }}"
                                         class="rounded-circle shadow-sm border"
                                         style="width:120px;height:120px;object-fit:cover;">
                                @else
                                    <div class="mx-auto rounded-circle bg-white border d-flex align-items-center justify-content-center shadow-sm"
                                         style="width:120px;height:120px;">
                                        <span class="text-muted">No Photo</span>
                                    </div>
                                @endif

                                <div class="mt-3">
                                    <label class="form-label fw-medium">Ubah Foto Profil</label>
                                    <input type="file" name="photo" class="form-control">
                                    <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
                                </div>

                            </div>
                        </div>

                        {{-- INFORMASI PROFIL --}}
                        <div class="card border-0 shadow-sm rounded-4 mb-4">
                            <div class="card-body p-4">
                                <h5 class="fw-semibold mb-4">Informasi Profil</h5>

                                <div class="row g-3">

                                    <div class="col-md-6">
                                        <label class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control"
                                            value="{{ old('username', $admin->username ?? '') }}"
                                            required autocomplete="off">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Nama</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name', $admin->name ?? '') }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email', $admin->email ?? '') }}"
                                            autocomplete="off">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">No. HP</label>
                                        <input type="text" name="phone" class="form-control"
                                            value="{{ old('phone', $admin->phone ?? '') }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Tanggal Lahir</label>
                                        <input type="date" name="date_of_birth" class="form-control"
                                            value="{{ old('date_of_birth', $admin->date_of_birth ?? '') }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Negara</label>
                                        <input type="text" name="country" class="form-control"
                                            value="{{ old('country', $admin->country ?? '') }}">
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- KEAMANAN --}}
                        <div class="card border-0 shadow-sm rounded-4 mb-4">
                            <div class="card-body p-4">
                                <h5 class="fw-semibold mb-2">Keamanan</h5>
                                <p class="text-muted small mb-4">Isi password jika ingin mengganti.</p>

                                <div class="row g-3">

                                    {{-- PASSWORD LAMA --}}
                                    <div class="col-md-4">
                                        <label class="form-label">Password Lama</label>
                                        <div class="position-relative">
                                            <input type="password" id="password_lama"
                                                name="password_lama"
                                                class="form-control pe-5"
                                                autocomplete="current-password">
                                            <span class="toggle-password" data-target="password_lama">
                                                <i class="bi bi-eye-slash"></i>
                                            </span>
                                        </div>
                                    </div>

                                    {{-- PASSWORD BARU --}}
                                    <div class="col-md-4">
                                        <label class="form-label">Password Baru</label>
                                        <div class="position-relative">
                                            <input type="password" id="password_baru"
                                                name="password_baru"
                                                class="form-control pe-5"
                                                autocomplete="new-password">
                                            <span class="toggle-password" data-target="password_baru">
                                                <i class="bi bi-eye-slash"></i>
                                            </span>
                                        </div>
                                    </div>

                                    {{-- KONFIRMASI --}}
                                    <div class="col-md-4">
                                        <label class="form-label">Konfirmasi Password</label>
                                        <div class="position-relative">
                                            <input type="password" id="password_baru_confirmation"
                                                name="password_baru_confirmation"
                                                class="form-control pe-5"
                                                autocomplete="new-password">
                                            <span class="toggle-password" data-target="password_baru_confirmation">
                                                <i class="bi bi-eye-slash"></i>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- BUTTON --}}
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary px-4">Batal</a>
                            <button type="submit" class="btn btn-primary px-4">Simpan</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- STYLE --}}
<style>
.toggle-password {
    position: absolute;
    top: 50%;
    right: 12px;
    transform: translateY(-50%);
    cursor: pointer;
    color: #6c757d;
}
.toggle-password:hover {
    color: #000;
}
</style>

{{-- SCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-password').forEach(function (el) {
        el.addEventListener('click', function () {
            let input = document.getElementById(this.dataset.target);
            let icon = this.querySelector('i');

            if (input.type === "password") {
                input.type = "text";
                icon.classList.replace('bi-eye-slash','bi-eye');
            } else {
                input.type = "password";
                icon.classList.replace('bi-eye','bi-eye-slash');
            }
        });
    });
});
</script>

@endsection