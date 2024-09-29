<div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="app-content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="mb-0">Kelola Harga Sewa</h3>
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
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered m-2">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10px">#</th>
                                                        <th>Kendaraan</th>
                                                        <th>Harga Sewa</th>
                                                        <th style="width: 200px">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($total > 0)
                                                        @foreach ($hargasewis as $index => $hargasewi)
                                                            <tr wire:key="{{ $hargasewi->id }}" class="align-middle">
                                                                <td>{{ $hargasewis->firstItem() + $loop->index }}.</td>
                                                                <td>{{ $hargasewi->kendaraan->merk }} -
                                                                    {{ $hargasewi->kendaraan->plat }}
                                                                </td>
                                                                <td>Rp.
                                                                    {{ number_format($hargasewi->harga, 0, ',', '.') }}
                                                                </td>
                                                                <td>
                                                                    <a href="#" class="btn btn-warning btn-sm"
                                                                        data-bs-toggle="modal" data-bs-target="#edit"
                                                                        wire:click="edit({{ $hargasewi->id }})">
                                                                        <i class="bi bi-pencil-square"></i> Edit
                                                                    </a>
                                                                    <a href="#" class="btn btn-danger btn-sm"
                                                                        wire:click="delete({{ $hargasewi->id }})"
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
                                        {{ $hargasewis->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.hargasewa.modal-create')
    @include('livewire.hargasewa.modal-edit')
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
