<div class="card card-custom gutter-b">
    <div class="card-body">
        <div class="form-group row gap-y-10">
            <div class="col-md-3">
                <label class="form-label">Ana Manşet</label>
                <div class="">
                   <span class="switch switch-icon">
                        <label>
                             <input type="checkbox" name="is_main_headline" @checked($newsletter?->has_main_headline)/>
                             <span></span>
                        </label>
                   </span>
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label">Beşli Manşet</label>
                <div class="">
                   <span class="switch switch-icon">
                        <label>
                             <input type="checkbox" id="five_cuff" name="is_five_cuff" @checked($newsletter?->has_five_cuff)/>
                             <span></span>
                        </label>
                   </span>
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label">Öne Çıkanlar</label>
                <div class="">
                   <span class="switch switch-icon">
                        <label>
                             <input type="checkbox" name="is_outstanding" @checked($newsletter?->has_out_standing)/>
                             <span></span>
                        </label>
                   </span>
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label">Son Dakika</label>
                <div class="">
                   <span class="switch switch-icon">
                        <label>
                             <input type="checkbox" name="is_last_minute" @checked($newsletter?->has_last_minute)/>
                             <span></span>
                        </label>
                   </span>
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label">Günün Manşeti</label>
                <div class="">
                   <span class="switch switch-icon">
                        <label>
                             <input type="checkbox" name="is_today_headline" @checked($newsletter?->has_today_headline)/>
                             <span></span>
                        </label>
                   </span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Etiket:</label>
            <select class="form-control tags" multiple="multiple" name="tags[]">
                @foreach($newsletter->tags as $tag)
                    <option value="{{ $tag?->uuid }}" @if($newsletter->tags->contains('uuid', $tag->uuid)) selected @endif>{{ $tag?->name }}</option>
                @endforeach
            </select>
            <span class="form-text text-muted">Lütfen etiketleri <b>ENTER</b> ile ayırınız.</span>
        </div>
    </div>
</div>
<div class="card card-custom gutter-b">
    <div class="card-body">
        <div class="form-group">
            <label class="form-label">SEO Sistem Tarafından Yapılsın?</label>
            <div class="">
                   <span class="switch switch-icon">
                        <label>
                             <input type="checkbox"  name="is_seo" @checked($newsletter?->has_seo) id="is_seo"/>
                             <span></span>
                        </label>
                   </span>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">SEO Meta Title:</label>
            <input type="text" class="form-control" value="{{ $newsletter->seo?->meta_title }}" name="seo[meta_title]" id="meta_title">
            <p class="form-text text-muted">En fazla 60 karakter giriniz.(<span class="character_count"> Kalan karakter sayısı: 60</span>)</p>
        </div>
        <div class="form-group">
            <label class="form-label">SEO Meta Tag:</label>
            <input type="text" class="tagify form-control" name="seo[meta_keywords]" value="{{ $newsletter->seo?->meta_keywords }}" id="meta_tag">
            <p class="form-text text-muted">En fazla 110 karakter giriniz.(<span class="character_count"> Kalan karakter sayısı: 110</span>)</p>
        </div>
        <div class="form-group">
            <label class="form-label">SEO Meta Description:</label>
            <input type="text" class="form-control" name="seo[meta_description]" value="{{ $newsletter->seo?->meta_description }}" id="meta_description">
            <p class="form-text text-muted">En fazla 150 karakter giriniz.(<span class="character_count"> Kalan karakter sayısı: 150</span>)</p>
        </div>
    </div>
</div>
