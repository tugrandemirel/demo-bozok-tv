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
                <div class="dropzone dropzone-default" id="kt_dropzone_1">
                    <div class="dropzone-msg dz-message needsclick">
                        <h3 class="dropzone-msg-title">Dosyanızı sürükleyip bırakabilirsiniz..</h3>
                        <span class="dropzone-msg-desc">Yalnızca: png, jpg, jpeg.</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Etiket:</label>
            <select class="form-control select2" id="kt_select2_11" multiple="multiple" name="tags">
                <option value="">Test</option>
            </select>
            <span class="form-text text-muted">Lütfen etiketleri <b>ENTER</b> ile ayırınız.</span>
        </div>
    </div>
</div>
<div class="card card-custom gutter-b">
    <div class="card-body">
        <div class="form-group">
            <label class="form-label">SEO Meta Title:</label>
            <input type="text" class="form-control" name="meta_title" id="meta_title">
            <p class="form-text text-muted">En fazla 60 karakter giriniz.(<span class="character_count"> Kalan karakter sayısı: 60</span>)</p>
        </div>
        <div class="form-group">
            <label class="form-label">SEO Meta Tag:</label>
            <input type="text" class="form-control" name="meta_tag" id="meta_tag">
            <p class="form-text text-muted">En fazla 110 karakter giriniz.(<span class="character_count"> Kalan karakter sayısı: 110</span>)</p>
        </div>
        <div class="form-group">
            <label class="form-label">SEO Meta Description:</label>
            <input type="text" class="form-control" name="meta_description" id="meta_description">
            <p class="form-text text-muted">En fazla 150 karakter giriniz.(<span class="character_count"> Kalan karakter sayısı: 150</span>)</p>
        </div>
    </div>
</div>
