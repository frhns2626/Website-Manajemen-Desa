<!-- Modal -->
<div class="modal fade" id="confirmationDelete-{{ $item->id }}" tabindex="-1" aria-labelledby="confirmationDeleteLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form action="/penduduk/{{ $item->id }}" method="post">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="confirmationDeleteLabel">Konfirmasi Hapus</h4>
                </div>
                <div class="modal-body">
                    <span>Yakin DiHapus ?</span></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-outline-danger">Yakin</button>
                </div>
            </div>
        </form>
    </div>
</div>
