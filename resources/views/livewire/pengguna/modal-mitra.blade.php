<div wire:ignore.self class="modal fade" id="mitra" tabindex="-1" aria-labelledby="modalEditPenggunaLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditPenggunaLabel">Edit Mitra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit="updateMitra">
                    @csrf
                    <div class="mb-3">
                        <label for="mitra_id" class="form-label">Mitra</label>
                        <select class="form-select" id="mitra_id" wire:model="mitra_id">
                            <option value="">-- Pilih Mitra --</option>
                            @foreach ($mitra as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                        @error('mitra_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" wire:click="updateMitra">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
