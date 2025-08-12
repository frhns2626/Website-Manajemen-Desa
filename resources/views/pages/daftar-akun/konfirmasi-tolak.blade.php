<!-- Modal -->
<div class="modal fade" id="konfirmasiTolak-{{ $item->id }}" tabindex="-1" aria-labelledby="konfirmasiTolakLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form action="/permintaan-akun/approval/{{ $item->id }}" method="post">
            @csrf
            @method('POST')
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="konfirmasiTolakLabel">Konfirmasi</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="for" value="deactivate">
                    <span>Apakah anda yakin menonaktifkan akun ini?</span></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-outline-success">Ya, nonaktifkan</button>
                </div>
            </div>
        </form>
    </div>
</div>