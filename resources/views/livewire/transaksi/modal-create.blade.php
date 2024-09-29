<div wire:ignore.self class="modal fade" id="tambah" tabindex="-1" aria-labelledby="modalCreateTransaksiLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateTransaksiLabel">Tambah Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit="store" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="kendaraan_id" class="form-label">Kendaraan</label>
                        <div wire:ignore>
                            <select class="form-control form-select select2" style="width: 100%" wire:model="kendaraan">
                                <option value="" disabled>-- Pilih Kendaraan --</option>
                                @foreach ($kendaraans as $kendaraan)
                                    <option value="{{ $kendaraan->id }}">{{ $kendaraan->merk }} - {{ $kendaraan->plat }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('kendaraan')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="pengguna" class="form-label">Pengguna</label>
                        <div wire:ignore>
                            <select style="width: 100%" class="form-select select2" id="pengguna-id"
                                wire:model="pengguna">
                                <option value="" disabled>-- Pilih User --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('pengguna')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="lama_sewa" class="form-label">Lama Sewa</label>
                        <input type="number" class="form-control" id="lama_sewa" wire:model="lama_sewa"
                            placeholder="Masukkan lama sewa...">
                        <small class="text-warning">Dalam hari</small>
                        @error('lama_sewa')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="pembayaran" class="form-label">Pembayaran</label>
                        <select class="form-select" id="pembayaran" wire:model="pembayaran">
                            <option value="">-- Pilih Pembayaran --</option>
                            <option value="lunas">Lunas</option>
                            <option value="belum_lunas">Belum Lunas</option>
                        </select>
                        @error('pembayaran')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
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
                                <progress max="100" x-bind:value="progress"></progress>
                            </div>
                        </div>
                        @if ($ktp)
                            <img class="mt-3" width="200" src="{{ $ktp->temporaryUrl() }}">
                        @endif
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" wire:click="store">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
