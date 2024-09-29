<div class="modal fade" id="kritikSaranModal" tabindex="-1" aria-labelledby="kritikSaranModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kritikSaranModalLabel">Kritik & Saran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('kritiksaran.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="kritikSaran" class="form-label">Kritik & Saran</label>
                        <textarea class="form-control" id="kritikSaran" rows="5" name="saran" placeholder="Masukkan kritik & saran..."></textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
