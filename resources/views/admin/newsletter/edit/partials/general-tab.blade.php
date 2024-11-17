<div class="card card-custom gutter-b">
    <div class="card-body">
        <div class="form-group">
            <label class="form-label">Başlık:</label>
            <input type="text" name="title" value="{{ $newsletter?->title }}" class="form-control">
            <span class="form-text text-muted">Haber Başlığını lütfen giriniz.</span>
        </div>
        <div id="form-group">
            <label class="form-label">Spot: </label>
            <textarea name="spot" class="summernote form-control" cols="30" rows="5">{{ $newsletter?->spot }}</textarea>
        </div>
    </div>
</div>
<div class="card card-custom gutter-b">
    <div class="card-body">
        <div class="form-group">
            <label class="form-label">Haber İçeriği:</label>
            <textarea name="content" class="summernote form-control" cols="30" rows="10">{{ $newsletter->content }}</textarea>
        </div>
    </div>
</div>
