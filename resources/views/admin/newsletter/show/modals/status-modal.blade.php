@isset($publication_statuses)
<!-- Modal-->
<div class="modal fade" id="publicationStatusEditModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Haber Durumu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="publicationStatusEditModalForm">
                <div class="form-group">
                    <label for="">Haber Durumu</label>
                    <select name="publication_status" class="form-control select2" id="publication_status">
                        <option value="" disabled selected>Seçiniz</option>
                        @foreach($publication_statuses as $publication_status)
                            <option value="{{ $publication_status?->uuid }}" @selected($publication_status->id === $newsletter?->newsletter_publication_status_id)>{{ $publication_status->name }}</option>
                        @endforeach
                        <option value="deneme">deneme</option>
                    </select>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">İptal</button>
                <button type="button" id="publicationStatusEditModalButton" data-uuid="{{ $newsletter?->uuid }}" class="btn btn-primary font-weight-bold">Kaydet</button>
            </div>
        </div>
    </div>
</div>
@endisset
