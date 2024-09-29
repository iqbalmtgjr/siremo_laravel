@extends('layouts.master')
@push('header')
    <style>
        button.btn-icon.btn-link:hover i {
            opacity: 1;
        }
    </style>
@endpush
@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="app-content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="mb-0">Profil Saya</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="app-content">
                    <div class="container-fluid">
                        <div class="row d-flex justify-content-center">
                            <a href="javascript:void(0)" class="btn btn-icon btn-link"
                                style="width: 150px; height: 150px; border-radius: 100%; border: 2px solid #dee2e6; box-shadow: 0 0 10px rgba(0,0,0,0.1); overflow: hidden; position: relative;
                                display: flex; justify-content: center; align-items: center;">
                                <img src="{{ asset('asset/assets/img/siremoLogo.png') }}"
                                    style="width: 150px; height: 150px; object-fit: cover;" alt="profile">
                                <i class="bi bi-camera-fill"
                                    style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 24px; color: #bdbdbd; opacity: 0; transition: all .3s ease-in-out;"></i>
                            </a>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12 col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h3 class="card-title">Edit Profil</h3>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('profil.update', Auth::user()->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" id="nama" name="nama"
                                                    value="{{ old('nama', Auth::user()->nama) }}">
                                                @error('nama')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    value="{{ old('email', Auth::user()->email) }}">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" class="form-control" id="username" name="username"
                                                    value="{{ old('username', Auth::user()->username) }}">
                                                @error('username')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="no_hp" class="form-label">No HP</label>
                                                <input type="text" class="form-control" id="no_hp" name="no_hp"
                                                    value="{{ old('no_hp', Auth::user()->no_hp) }}">
                                                @error('no_hp')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            @if (Auth::user()->role != 'super_admin')
                                                <div class="mb-3">
                                                    <label for="mitra" class="form-label">Mitra</label>
                                                    <input disabled type="text" class="form-control"
                                                        value="{{ Auth::user()->mitra->nama }}">
                                                </div>
                                            @endif
                                            <div class="mb-3">
                                                <label for="mitra" class="form-label">Role</label>
                                                <input disabled type="text" class="form-control"
                                                    value="{{ Auth::user()->role == 'admin_mitra' ? 'Admin Mitra' : (Auth::user()->role == 'staff_mitra' ? 'Staff Mitra' : (Auth::user()->role == 'user' ? 'User' : 'Super Admin')) }}">
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h3 class="card-title">Ganti Password</h3>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('profil.password', Auth::user()->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="current_password" class="form-label">Password Lama</label>
                                                <input type="password"
                                                    class="form-control @error('current_password') is-invalid @enderror"
                                                    id="current_password" name="current_password"
                                                    placeholder="Masukkan password lama">
                                                @error('current_password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="password" name="password" placeholder="Masukkan password baru">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="password_confirmation" class="form-label">Konfirmasi
                                                    Password</label>
                                                <input type="password"
                                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                                    id="password_confirmation" name="password_confirmation"
                                                    placeholder="Masukkan konfirmasi password baru">
                                                @error('password_confirmation')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
