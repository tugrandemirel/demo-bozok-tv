<div class="alert alert-custom alert-outline-primary alert-shadow fade show gutter-b" role="alert">
    <div class="alert-icon">
      <span class="svg-icon svg-icon-primary svg-icon-xl">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <defs></defs>
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect x="0" y="0" width="24" height="24"></rect>
                <path d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z" fill="#000000" opacity="0.3"></path>
                <path d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z" fill="#000000" fill-rule="nonzero"></path>
            </g>
        </svg>
      </span>
    </div>
    <div class="text-black">
        Iconları <a href="https://fontawesome.com/search" target="_blank">buradan</a> seçebilirsiniz.

        <b>Yapmanız gereken oradaki yazıyı kopyalayarak Icon İnputu içerisine düz metin olarak yapıştırmak</b>.
        Örneğin Facebook iconu için: <b>fab fa-facebook</b> yazısını kopyalamanız ve icon inputu içerisine yapıştırmanız.
    </div>
</div>
<form id="socialMediaForm">
    <div id="kt_repeater_1">
        <div class="form-group row justify-content-end" id="kt_repeater_1">
            <div data-repeater-list="links" class="col-lg-12">
                @if($social_medias && count($social_medias->links) > 0)
                    @foreach($social_medias->links as $key => $value)
                        <div data-repeater-item class="form-group row align-items-center">
                            <div class="col-md-3">
                                <label>Adı:</label>
                                <input type="text" class="form-control form-control-lg form-control-solid" name="links[{{ $key }}][name]" value="{{ $value['name'] ?? '' }}" placeholder=""/>
                                <div class="d-md-none mb-2"></div>
                            </div>
                            <div class="col-md-3">
                                <label>Icon:</label>
                                <input type="text" class="form-control form-control-lg form-control-solid" name="links[{{ $key }}][icon]" value="{{ $value['icon'] ?? '' }}" placeholder="fa-brands fa-tiktok"/>
                            </div>
                            <div class="col-md-3">
                                <label>URL:</label>
                                <input type="text" class="form-control form-control-lg form-control-solid" name="links[{{ $key }}][url]" value="{{ $value['url'] ?? '' }}" placeholder=""/>
                                <div class="d-md-none mb-2"></div>
                            </div>
                            <div class="col-md-2">
                                <label for="">Aktif:</label>
                                <span class="switch">
                                    <label>
                                        <input type="checkbox" name="links[{{ $key }}][is_active]" @checked($value['is_active']) />
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                            <div class="col-md-1 mt-auto">
                                <a href="javascript:;" data-repeater-delete="" class="btn btn-sm font-weight-bolder btn-light-danger">
                                    <i class="la la-trash-o"></i>Delete
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div data-repeater-item class="form-group row align-items-center">
                        <div class="col-md-3">
                            <label>Adı:</label>
                            <input type="text" class="form-control form-control-lg form-control-solid" name="links[0][name]" placeholder=""/>
                            <div class="d-md-none mb-2"></div>
                        </div>
                        <div class="col-md-3">
                            <label>Icon:</label>
                            <input type="text" class="form-control form-control-lg form-control-solid" name="links[0][icon]" placeholder="<i class='fa-brands fa-tiktok'></i>"/>
                        </div>
                        <div class="col-md-3">
                            <label>URL:</label>
                            <input type="text" class="form-control form-control-lg form-control-solid" name="links[0][url]" placeholder=""/>
                            <div class="d-md-none mb-2"></div>
                        </div>
                        <div class="col-md-2">
                            <label for="">Aktif:</label>
                            <span class="switch">
                                    <label>
                                        <input type="checkbox" name="link[0][is_active]" />
                                        <span></span>
                                    </label>
                                </span>
                        </div>
                        <div class="col-md-1 mt-auto">
                            <a href="javascript:;" data-repeater-delete="" class="btn btn-sm font-weight-bolder btn-light-danger">
                                <i class="la la-trash-o"></i>Delete
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-4">
                <a href="javascript:;" data-repeater-create="" class="btn btn-sm font-weight-bolder btn-light-primary">
                    <i class="la la-plus"></i>Add
                </a>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-12 text-right">
            <button type="button" class="btn btn-success mr-2" id="socialMediaButton">Güncelle</button>
        </div>
    </div>
</form>
