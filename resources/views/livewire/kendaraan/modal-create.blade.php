<div wire:ignore.self class="modal fade" id="tambah" tabindex="-1" aria-labelledby="modalCreateKendaraanLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateKendaraanLabel">Tambah Kendaraan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit="store">
                    @csrf
                    <div class="mb-3">
                        <label for="pemilik" class="form-label">Pemilik</label>
                        <div wire:ignore>
                            <select style="width: 100%" class="form-select select2" id="pemilik" wire:model="pemilik">
                                <option value="">-- Cari Pemilik --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('pemilik')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tipe" class="form-label">Tipe</label>
                        <select class="form-select" id="tipe" wire:model="tipe">
                            <option value="">-- Pilih Tipe --</option>
                            <option value="Mobil">Mobil</option>
                            <option value="Motor">Motor</option>
                        </select>
                        @error('tipe')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="merk" class="form-label">Merk</label>
                        <input type="text" class="form-control" id="merk" wire:model="merk"
                            placeholder="Masukkan merk...">
                        @error('merk')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="plat" class="form-label">Plat</label>
                        <input type="text" class="form-control" id="plat" wire:model="plat"
                            placeholder="Masukkan plat...">
                        @error('plat')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="harga_sewa" class="form-label">Harga Sewa</label>
                        <input type="number" class="form-control" id="harga_sewa" wire:model="harga_sewa"
                            placeholder="Masukkan harga sewa tanpa titik atau koma">
                        @error('harga_sewa')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" wire:model="alamat" placeholder="Masukkan alamat..."></textarea>
                        @error('alamat')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Foto Kendaraan</label>
                        <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                            x-on:livewire-upload-finish="uploading = false"
                            x-on:livewire-upload-cancel="uploading = false"
                            x-on:livewire-upload-error="uploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <!-- File Input -->
                            <input type="file" class="form-control" wire:model="foto">
                            @error('foto')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <!-- Progress Bar -->
                            <div x-show="uploading">
                                <progress max="100" x-bind:value="progress"></progress>
                            </div>
                        </div>
                        @if ($foto)
                            <img class="mt-3" width="200" src="{{ $foto->temporaryUrl() }}">
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
