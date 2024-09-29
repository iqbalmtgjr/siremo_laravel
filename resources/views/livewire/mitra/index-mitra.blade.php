<div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="app-content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="mb-0">Kelola Mitra</h3>
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
                                                        <th>Nama</th>
                                                        <th>Logo</th>
                                                        <th>Alamat</th>
                                                        <th>No Hp</th>
                                                        <th>Status</th>
                                                        <th>Validasi</th>
                                                        <th style="width: 200px">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($total > 0)
                                                        @foreach ($mitras as $index => $mitra)
                                                            <tr wire:key="{{ $mitra->id }}" class="align-middle">
                                                                <td>{{ $mitras->firstItem() + $loop->index }}.</td>
                                                                <td>{{ $mitra->nama }}</td>
                                                                <td>
                                                                    @if ($mitra->logo)
                                                                        <img src="{{ asset('storage/mitra/logo/' . $mitra->logo) }}"
                                                                            alt="Logo {{ $mitra->nama }}"
                                                                            class="img-thumbnail" width="100">
                                                                    @else
                                                                        <span class="text-warning">Belum ada logo</span>
                                                                    @endif
                                                                </td>
                                                                <td>{{ $mitra->alamat }}</td>
                                                                <td>{{ $mitra->no_hp }}</td>
                                                                <td>
                                                                    <span
                                                                        class="badge rounded-pill bg-{{ $mitra->status == 'buka' ? 'success' : 'danger' }} text-light">
                                                                        {{ ucfirst($mitra->status) }}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:void(0)"
                                                                        wire:click="valid({{ $mitra->id }})"
                                                                        wire:confirm="Ubah validasi mitra ini?"
                                                                        class="badge rounded-pill bg-{{ $mitra->valid == 1 ? 'success' : 'danger' }} text-light">
                                                                        {{ ucfirst($mitra->valid ? 'Valid' : 'Belum Valid') }}
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:void(0)"
                                                                        class="btn btn-warning btn-sm"
                                                                        data-bs-toggle="modal" data-bs-target="#edit"
                                                                        wire:click="edit({{ $mitra->id }})">
                                                                        <i class="bi bi-pencil-square"></i> Edit
                                                                    </a>
                                                                    <a href="javascript:void(0)"
                                                                        class="btn btn-danger btn-sm"
                                                                        wire:click="delete({{ $mitra->id }})"
                                                                        wire:confirm="Apakah anda yakin ingin menghapus data ini?">
                                                                        <i class="bi bi-trash3"></i> Hapus
                                                                    </a>
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
                                        {{ $mitras->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.mitra.modal-create')
    @include('livewire.mitra.modal-edit')
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
