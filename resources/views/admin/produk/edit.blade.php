@extends('layouts.public')
@section('title', 'Edit Profil Admin')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                <div>
                    <h3 class="mb-1">Edit Profil Admin</h3>
                    <p class="text-muted mb-0">Kelola informasi profil administrator</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali</a>
            </div>

            @include('admin.partials.alert')

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        class="form-control"
                        value="{{ old('username', $admin->username ?? '') }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control"
                        value="{{ old('name', $admin->name ?? '') }}"
                    >
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email', $admin->email ?? '') }}"
                    >
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">No. HP</label>
                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        class="form-control"
                        value="{{ old('phone', $admin->phone ?? '') }}"
                    >
                </div>

                <div class="mb-3">
                    <label for="date_of_birth" class="form-label">Tanggal Lahir</label>
                    <input
                        type="date"
                        id="date_of_birth"
                        name="date_of_birth"
                        class="form-control"
                        value="{{ old('date_of_birth', $admin->date_of_birth ?? '') }}"
                    >
                </div>

                <div class="mb-3">
                    <label for="country" class="form-label">Negara</label>
                    <input
                        type="text"
                        id="country"
                        name="country"
                        class="form-control"
                        value="{{ old('country', $admin->country ?? '') }}"
                    >
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label">Foto Profil</label>
                    <input
                        type="file"
                        id="photo"
                        name="photo"
                        class="form-control"
                    >
                </div>

                @if(!empty($admin->photo))
                    <div class="mb-3">
                        <label class="form-label d-block">Foto Saat Ini</label>
                        <img
                            src="{{ asset('uploads/profile/' . $admin->photo) }}"
                            alt="Foto Profil"
                            class="img-thumbnail rounded-3"
                            style="max-width: 140px;"
                        >
                    </div>
                @endif

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection