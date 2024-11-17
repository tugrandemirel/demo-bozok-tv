<div class="modal fade" id="postStatusModal" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Köşe Yazısı Yayın Durumu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="postStatusModalForm" data-uuid="{{ $post->post_uuid }}">
                    <div class="form-group">
                        <label for="post_status">Yayın Durumu</label>
                        <select name="post_status" class="select2" id="post_status">
                            <option value="" disabled selected>Seçiniz</option>
                            @foreach($post_statuses as $post_status)
                                <option value="{{ $post_status->code }}">{{ $post_status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group d-none" id="review_note_row">
                        <label for="post_status">Geri Bildirim Mesajı</label>
                        <textarea name="review_note" id="review_note" class="summernote" cols="30" rows="20"></textarea>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Kapat</button>
                <button type="button" class="btn btn-primary font-weight-bold" id="postStatusModalButton">Durumu Güncelle</button>
            </div>
        </div>
    </div>
</div>
