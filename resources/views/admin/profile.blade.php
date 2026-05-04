@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Profil</h2>

    @if(session('success'))
        <div style="color: green; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.profile.update') }}" method="POST">
        @csrf

        <div style="margin-bottom: 10px;">
            <label>Nama</label><br>
            <input type="text" name="name" value="{{ old('name', $user->name) }}">
        </div>

        <div style="margin-bottom: 10px;">
            <label>Email</label><br>
            <input type="email" name="email" value="{{ old('email', $user->email) }}">
        </div>

        <button type="submit">Simpan</button>
    </form>
</div>
@endsection