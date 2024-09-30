<div>
    @push('header')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush
    @push('footer')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            document.addEventListener('livewire:init', function() {
                // Inisialisasi Select2 setelah Livewire selesai dimuat
                // $('.select2').select2();

                // Dengarkan event dari Select2 dan sinkronkan dengan Livewire
                $('.select2').on('change', function(e) {
                    let element = $(this);
                    @this.set(element.attr('wire:model'), element.val());
                });
            });

            document.addEventListener('livewire:update', function() {
                // Re-inisialisasi Select2 setelah Livewire diperbarui
                $('.select2').select2();
            });
            $(document).ready(function() {
                $('.select2').select2();
            });
        </script>
    @endpush
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                {{-- <div class="app-content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="mb-0">Transaksi</h3>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="app-content mt-4">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    @if ($mitra->valid == 0)
                                        <div class="card-body" wire:ignore>
                                            <center>
                                                @if ($mitra->logo != null)
                                                    <img src="{{ asset('storage/mitra/logo/' . $mitra->logo . '') }}"
                                                        alt="Logo Mitra"
                                                        style="width: 100px; height: 100px; object-fit: contain;">
                                                @endif
                                                <h2 class="align-center text-danger">{{ $mitra->nama }} belum
                                                    divalidasi admin</h2>
                                                <p>Untuk melakukan transaksi mitra anda harus divalidasi admin. Silahkan
                                                    hubungi admin via Whatapp : 08996979079</p>
                                            </center> <br>
                                        </div>
                                    @else
                                        <div class="card-body" wire:ignore>
                                            <center>
                                                @if ($mitra->logo != null)
                                                    <img src="{{ asset('storage/mitra/logo/' . $mitra->logo . '') }}"
                                                        alt="Logo Mitra"
                                                        style="width: 100px; height: 100px; object-fit: contain;">
                                                @endif
                                                <h2 class="align-center">Input Transaksi {{ $mitra->nama }}</h2>
                                            </center> <br>
                                            <div wire:ignore.self>
                                                <form wire:submit.prevent="store" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="kendaraan_id" class="form-label">Kendaraan</label>
                                                        <div wire:ignore>
                                                            <select class="form-select select2" style="width: 100%"
                                                                wire:model="kendaraan_id">
                                                                <option value="">-- Pilih Kendaraan --
                                                                </option>
                                                                @foreach ($kendaraans as $kendaraan)
                                                                    <option value="{{ $kendaraan->id }}">
                                                                        {{ $kendaraan->merk }} - {{ $kendaraan->plat }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @error('kendaraan_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <div wire:ignore>
                                                            <label for="pengguna" class="form-label">Pengguna</label>
                                                            <select style="width: 100%" class="form-select select2"
                                                                id="pengguna-id" wire:model="pengguna_id">
                                                                <option value="">-- Pilih Pengguna --
                                                                </option>
                                                                @foreach ($users as $user)
                                                                    <option value="{{ $user->id }}">
                                                                        {{ $user->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @error('pengguna_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <div class="mt-2">
                                                            <button type="button" class="btn btn-sm btn-primary"
                                                                data-bs-toggle="modal" data-bs-target="#tambah">
                                                                Tambah Pengguna Baru
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="lama_sewa" class="form-label">Lama Sewa</label>
                                                        <input type="number" class="form-control" id="lama_sewaa"
                                                            wire:model="lama_sewa" placeholder="Masukkan lama sewa...">
                                                        <small class="text-warning">Dalam hari</small> <br>
                                                        @error('lama_sewa')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="pembayaran" class="form-label">Pembayaran</label>
                                                        <select class="form-select" id="pembayarann"
                                                            wire:model="pembayaran">
                                                            <option value="">-- Pilih Pembayaran --</option>
                                                            <option value="lunas">Lunas</option>
                                                            <option value="belum_lunas">Belum Lunas</option>
                                                        </select>
                                                        @error('pembayaran')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    {{-- <div class="mb-3">
                                                    <label for="ktp" class="form-label">Upload KTP
                                                        Pengguna</label>
                                                    <div x-data="{ uploading: false, progress: 0 }"
                                                        x-on:livewire-upload-start="uploading = true"
                                                        x-on:livewire-upload-finish="uploading = false"
                                                        x-on:livewire-upload-cancel="uploading = false"
                                                        x-on:livewire-upload-error="uploading = false"
                                                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                                                        <!-- File Input -->
                                                        <input type="file" class="form-control" wire:model="ktp">
                                                        @error('ktp')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                        <!-- Progress Bar -->
                                                        <div x-show="uploading">
                                                            <progress max="100"
                                                                x-bind:value="progress"></progress>
                                                        </div>
                                                    </div>
                                                    @if ($ktp)
                                                        <img class="mt-3" width="200"
                                                            src="{{ $ktp->temporaryUrl() }}">
                                                    @endif
                                                </div> --}}

                                                    <div class="d-flex justify-content-end">
                                                        <button type="submit" wire:click="store"
                                                            class="btn btn-primary btn-sm">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="card mb-4">
                                    <div class="d-flex justify-content-between align-items-center px-3 pt-3 m-2">
                                        <div class="input-group w-auto">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="bi bi-search"></i></span>
                                            <input type="text" wire:model.live.debounce.1000ms="search"
                                                class="form-control" placeholder="Cari..." aria-label="Cari"
                                                aria-describedby="basic-addon1">
                                        </div>
                                        {{-- <div class="ms-2">
                                            <a href="javascript:void(0)" wire:click="resetInput"
                                                class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#tambah">
                                                <i class="bi bi-plus-circle"></i> Tambah
                                            </a>
                                        </div> --}}
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered m-2">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10px">#</th>
                                                        <th>Kendaraan</th>
                                                        <th>Nama Penyewa</th>
                                                        <th>Lama Sewa</th>
                                                        <th>Total Harga Sewa</th>
                                                        <th>Tanggal Sewa</th>
                                                        <th>Pembayaran</th>
                                                        <th style="width: 200px">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($total > 0)
                                                        @foreach ($transaksis as $index => $transaksi)
                                                            <tr wire:key="{{ $transaksi->id }}" class="align-middle">
                                                                <td>{{ $transaksis->firstItem() + $loop->index }}.
                                                                </td>
                                                                <td>{{ $transaksi->kendaraan->merk }} -
                                                                    {{ $transaksi->kendaraan->plat }}
                                                                </td>
                                                                <td>{{ $transaksi->user->nama }}</td>
                                                                <td>{{ $transaksi->lama_sewa }} Hari</td>
                                                                <td>Rp.
                                                                    {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                                                                </td>
                                                                <td>{{ \Carbon\Carbon::parse($transaksi->created_at)->format('d-m-Y') }}
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="badge rounded-pill bg-{{ $transaksi->pembayaran == 'lunas' ? 'success' : 'danger' }} text-light">
                                                                        {{ ucfirst($transaksi->pembayaran) }}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <div class="btn-group" role="group"
                                                                        aria-label="Basic example">
                                                                        <a href="#" class="btn btn-info btn-sm"
                                                                            wire:click="selesai({{ $transaksi->id }})">
                                                                            <i class="bi bi-check-circle"></i> Selesai
                                                                        </a>
                                                                        <a href="#" class="btn btn-primary btn-sm"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#ktp"
                                                                            wire:click="viewktp({{ $transaksi->user_id }})">
                                                                            <i class="bi bi-eye"></i> Lihat KTP
                                                                        </a>
                                                                        <a href="#"
                                                                            class="btn btn-warning btn-sm"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#edit"
                                                                            wire:click="edit({{ $transaksi->id }})">
                                                                            <i class="bi bi-pencil-square"></i> Edit
                                                                        </a>
                                                                        <a href="#"
                                                                            class="btn btn-danger btn-sm"
                                                                            wire:click="delete({{ $transaksi->id }})"
                                                                            wire:confirm="Apakah anda yakin ingin menghapus data ini?">
                                                                            <i class="bi bi-trash3"></i> Hapus
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="8" class="text-center">
                                                                Tidak ada data ditemukan
                                                            </td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        {{ $transaksis->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.penggunamitra.modal-create')
    @include('livewire.transaksi.modal-edit')
    @include('livewire.transaksi.modal-ktp')
    <script type="text/javascript">
        document.addEventListener('livewire:init', () => {
            Livewire.on('created', () => {
                const tambahModal = document.getElementById('tambah')
                const tambahModalInstance = bootstrap.Modal.getInstance(tambahModal)
                tambahModalInstance.hide()
            });

            Livewire.on('edited', () => {
                const editModal = document.getElementById('edit')
                const editModalInstance = bootstrap.Modal.getInstance(editModal)
                editModalInstance.hide()
            });
        });
    </script>
</div>
