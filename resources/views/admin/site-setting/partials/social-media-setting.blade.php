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
                                <input type="text" class="form-control form-control-lg form-control-solid" name="links[{{ $key }}][icon]" value="{{ $value['icon'] ?? '' }}" placeholder="<i class='fa-brands fa-tiktok'></i>"/>
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
