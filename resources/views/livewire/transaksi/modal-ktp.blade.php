<div wire:ignore.self class="modal modal-lg fade" id="ktp" tabindex="-1" aria-labelledby="modalCreateTransaksiLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateTransaksiLabel">Lihat KTP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <center>
                    <img class="img-fluid" width="330" src="{{ asset('storage/pengguna/ktp/' . $lihat_ktp . '') }}"
                        alt="foto ktp">
                </center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
