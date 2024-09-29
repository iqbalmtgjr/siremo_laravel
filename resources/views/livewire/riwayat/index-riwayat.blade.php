<div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="app-content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="mb-0">Riwayat Transaksi</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="app-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <div class="row px-3 pt-3 m-2">
                                        <form wire:submit='filter'>
                                            <div class="col-md-12 col-sm-6 mb-3">
                                                <div class="form-group">
                                                    <label for="tgl_awal">Tanggal Awal</label>
                                                    <input type="date" class="form-control" id="tgl_awal"
                                                        wire:model="tgl_awal">
                                                    @error('tgl_awal')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-6 mb-3">
                                                <div class="form-group">
                                                    <label for="tgl_akhir">Tanggal Akhir</label>
                                                    <input type="date" class="form-control" id="tgl_akhir"
                                                        wire:model="tgl_akhir">
                                                    @error('tgl_akhir')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12 d-flex justify-content-end">
                                                <button type="button" class="btn btn-primary"
                                                    wire:click="filter">Filter</button>
                                            </div>
                                        </form>
                                    </div>

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
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- @if ($total > 0) --}}
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
                                                                <a href="javascript:void(0)"
                                                                    class="btn btn-primary btn-sm"
                                                                    data-bs-toggle="modal" data-bs-target="#edit"
                                                                    wire:click="edit({{ $transaksi->id }})">
                                                                    <i class="bi bi-pencil"></i> Edit
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    {{-- @else
                                                        <tr>
                                                            <td colspan="8" class="text-center">
                                                                Tidak ada data ditemukan
                                                            </td>
                                                        </tr>
                                                    @endif --}}
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="4" class="text-end">Total Harga Sewa</th>
                                                        <th colspan="4">Rp.
                                                            {{ number_format($transaksis->sum('total_harga'), 0, ',', '.') }}
                                                        </th>
                                                    </tr>

                                                </tfoot>
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
    @include('livewire.riwayat.modal-edit')
</div>
