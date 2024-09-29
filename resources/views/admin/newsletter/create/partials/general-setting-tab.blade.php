<div class="card card-custom gutter-b">
    <div class="card-body">
        <div class="form-group row gap-y-10">
            <div class="col-md-3">
                <label class="form-label">Ana Manşet</label>
                <div class="">
                   <span class="switch switch-icon">
                        <label>
                             <input type="checkbox"  name="is_main_headline"/>
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
                             <input type="checkbox"  id="five_cuff" name="is_five_cuff"/>
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
                             <input type="checkbox"  name="is_outstanding"/>
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
                             <input type="checkbox" name="is_last_minute"/>
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
                             <input type="checkbox"  name="is_today_headline"/>
                             <span></span>
                        </label>
                   </span>
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label">Özel Haber</label>
                <div class="">
                   <span class="switch switch-icon">
                        <label>
                             <input type="checkbox"  name="is_special_news"/>
                             <span></span>
                        </label>
                   </span>
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label">Sokak Röportajı</label>
                <div class="">
                   <span class="switch switch-icon">
                        <label>
                             <input type="checkbox"  name="is_street_interview"/>
                             <span></span>
                        </label>
                   </span>
                </div>
            </div>
        </div>
        <div class="form-group row hidden" id="five_cuff_image">
            <label class="col-form-label col-sm-12">Beşli Manşet Görseli</label>
            <div class="col-sm-12">
                <div class="image-input image-input-outline w-100 text-center" id="inside_image">
                    <div class="image-input-wrapper  w-100" style="background-image: url({{ asset('assets/media/users/100_1.jpg') }})"></div>

                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="İç Kapak Görselini değiştir">
                        <i class="fa fa-pen icon-sm text-muted"></i>
                        <input type="file" name="five_cuff_image" accept=".png, .jpg, .jpeg"/>
                        <input type="hidden" name="profile_avatar_remove"/>
                    </label>

                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="İptal Et">
                              <i class="ki ki-bold-close icon-xs text-muted"></i>
                         </span>
                </div>
                <span class="form-text">Yalnızca: png, jpg, jpeg.</span>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Etiket:</label>
            <select class="form-control tags" multiple="multiple" name="tags[]">
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
                             <input type="checkbox"  name="is_seo" id="is_seo"/>
                             <span></span>
                        </label>
                   </span>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">SEO Meta Title:</label>
            <input type="text" class="form-control" name="seo[meta_title]" id="meta_title">
            <p class="form-text text-muted">En fazla 60 karakter giriniz.(<span class="character_count"> Kalan karakter sayısı: 60</span>)</p>
        </div>
        <div class="form-group">
            <label class="form-label">SEO Meta Tag:</label>
            <input type="text" class="form-control" name="seo[meta_keywords]" id="meta_tag">
            <p class="form-text text-muted">En fazla 110 karakter giriniz.(<span class="character_count"> Kalan karakter sayısı: 110</span>)</p>
        </div>
        <div class="form-group">
            <label class="form-label">SEO Meta Description:</label>
            <input type="text" class="form-control" name="seo[meta_description]" id="meta_description">
            <p class="form-text text-muted">En fazla 150 karakter giriniz.(<span class="character_count"> Kalan karakter sayısı: 150</span>)</p>
        </div>
    </div>
</div>
