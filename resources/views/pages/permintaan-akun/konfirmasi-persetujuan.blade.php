<!-- Modal -->
<div class="modal fade" id="konfirmasiSetuju-{{ $item->id }}" tabindex="-1" aria-labelledby="konfirmasiSetujuLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form action="/permintaan-akun/approval/{{ $item->id }}" method="post">
            @csrf
            @method('POST')                                                                                 
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="konfirmasiSetujuLabel">Konfirmasi Setuju</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="for" value="approve">
                    <span>Apakah anda yakin menyetujui akun ini?</span></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-outline-success">Yakin</button>
                </div>
            </div>
        </form>
    </div>
</div>