<div wire:ignore.self class="modal fade" id="tambah" tabindex="-1" aria-labelledby="modalCreateMitraLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateMitraLabel">Tambah Mitra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit="store" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" wire:model="nama"
                            placeholder="Masukkan nama...">
                        @error('nama')
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
                        <label for="no_hp" class="form-label">No HP</label>
                        <input type="number" class="form-control" id="no_hp" wire:model="no_hp"
                            placeholder="Masukkan no hp...">
                        @error('no_hp')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- <div class="mb-3">
                        <label for="logo" class="form-label">Logo</label>
                        <input type="file" class="form-control" id="logo" wire:model="logo">
                        @error('logo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}
                    <label for="logo" class="form-label">Logo</label>
                    <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                        x-on:livewire-upload-finish="uploading = false" x-on:livewire-upload-cancel="uploading = false"
                        x-on:livewire-upload-error="uploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <!-- File Input -->
                        <input type="file" class="form-control" wire:model="logo">
                        @error('logo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <!-- Progress Bar -->
                        <div x-show="uploading">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>
                    @if ($logo)
                        <img class="mt-3" width="200" src="{{ $logo->temporaryUrl() }}">
                    @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" wire:click="store">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
