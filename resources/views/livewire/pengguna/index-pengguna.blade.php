<div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="app-content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="mb-0">Kelola Pengguna</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="app-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <div class="d-flex justify-content-between align-items-center px-3 pt-3 m-2">
                                        <div class="input-group w-auto">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="bi bi-search"></i></span>
                                            <input type="text" wire:model.live.debounce.1000ms="search"
                                                class="form-control" placeholder="Cari..." aria-label="Cari"
                                                aria-describedby="basic-addon1">
                                        </div>
                                        <div class="ms-2">
                                            <a href="javascript:void(0)" wire:click="resetInput"
                                                class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#tambah">
                                                <i class="bi bi-plus-circle"></i> Tambah
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body" wire:ignore>
                                        <div class="table-responsive">
                                            <table class="table table-bordered m-2">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10px">#</th>
                                                        <th>Nama Lengkap</th>
                                                        <th>Mitra</th>
                                                        <th>Email</th>
                                                        <th>No Hp</th>
                                                        <th>Role</th>
                                                        <th style="width: 200px">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($total > 0)
                                                        @foreach ($users as $index => $pengguna)
                                                            <tr wire:key="{{ $pengguna->id }}" class="align-middle">
                                                                <td>{{ $users->firstItem() + $loop->index }}.</td>
                                                                <td>{{ $pengguna->nama }}</td>
                                                                <td>
                                                                    @if ($pengguna->mitra)
                                                                        {{ $pengguna->mitra->nama }}
                                                                    @else
                                                                        -
                                                                    @endif
                                                                </td>
                                                                <td>{{ $pengguna->email }}</td>
                                                                <td>{{ $pengguna->no_hp }}</td>
                                                                <td>{{ $pengguna->role }}</td>
                                                                <td>
                                                                    <div class="btn-group" role="group"
                                                                        aria-label="Basic example">
                                                                        <a href="#" class="btn btn-warning btn-sm"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#edit"
                                                                            wire:click="edit({{ $pengguna->id }})">
                                                                            <i class="bi bi-pencil-square"></i> Edit
                                                                        </a>
                                                                        <a href="#" class="btn btn-info btn-sm"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#mitra"
                                                                            wire:click="mitrakita({{ $pengguna->id }})">
                                                                            <i class="bi bi-intersect"></i> Mitra
                                                                        </a>
                                                                        <a href="#" class="btn btn-danger btn-sm"
                                                                            wire:click="delete({{ $pengguna->id }})"
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
                                        {{ $users->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.pengguna.modal-create')
    @include('livewire.pengguna.modal-edit')
    @include('livewire.pengguna.modal-mitra')
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

            Livewire.on('mitraed', () => {
                const editModal = document.getElementById('mitra')
                const editModalInstance = bootstrap.Modal.getInstance(editModal)
                editModalInstance.hide()
            });
        });
    </script>
