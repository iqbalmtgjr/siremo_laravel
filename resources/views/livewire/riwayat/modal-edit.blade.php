<div wire:ignore.self class="modal fade" id="edit" tabindex="-1" aria-labelledby="modalCreateTransaksiLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateTransaksiLabel">Edit Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit="update">
                    @csrf
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" wire:click="update">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
