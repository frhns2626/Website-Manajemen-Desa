<!-- Modal -->
<div class="modal fade" id="konfirmasiHapus-{{ $item->id }}" tabindex="-1" aria-labelledby="konfirmasiHapusLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form action="/complaint/{{ $item->id }}" method="post">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="konfirmasiHapusLabel">Konfirmasi Hapus</h4>
                </div>
                <div class="modal-body">
                    <span>Yakin DiHapus ?</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-outline-danger">Yakin</button>
                </div>
            </div>
        </form>
    </div>
</div>
