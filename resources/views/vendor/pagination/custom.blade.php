@if ($paginator->hasPages())
    <div class="card card-custom">
        <div class="card-body py-7">
            <!--begin::Pagination-->
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex flex-wrap mr-3">
                    {{-- İlk sayfa ve önceki sayfa butonları --}}
                    @if ($paginator->onFirstPage())
                        <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1 disabled">
                            <i class="ki ki-bold-double-arrow-back icon-xs"></i>
                        </a>
                        <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1 disabled">
                            <i class="ki ki-bold-arrow-back icon-xs"></i>
                        </a>
                    @else
                        <a href="{{ $paginator->url(1) }}" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
                            <i class="ki ki-bold-double-arrow-back icon-xs"></i>
                        </a>
                        <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
                            <i class="ki ki-bold-arrow-back icon-xs"></i>
                        </a>
                    @endif

                    {{-- Sayfa numaraları --}}
                    @foreach ($elements as $element)
                        {{-- Üç nokta "..." kısmı --}}
                        @if (is_string($element))
                            <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">{{ $element }}</a>
                        @endif

                        {{-- Sayfa linkleri --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary active mr-2 my-1">{{ $page }}</a>
                                @else
                                    <a href="{{ $url }}" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">{{ $page }}</a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Sonraki sayfa ve son sayfa butonları --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
                            <i class="ki ki-bold-arrow-next icon-xs"></i>
                        </a>
                        <a href="{{ $paginator->url($paginator->lastPage()) }}" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
                            <i class="ki ki-bold-double-arrow-next icon-xs"></i>
                        </a>
                    @else
                        <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1 disabled">
                            <i class="ki ki-bold-arrow-next icon-xs"></i>
                        </a>
                        <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1 disabled">
                            <i class="ki ki-bold-double-arrow-next icon-xs"></i>
                        </a>
                    @endif
                </div>

                <div class="d-flex align-items-center">
                    {{-- Eğer sayfa boyutunu seçmek için bir select kullanacaksanız, bu alanı ayrı şekilde yönetmeniz gerekir. --}}
{{--                    <select class="form-control form-control-sm text-primary font-weight-bold mr-4 border-0 bg-light-primary" style="width: 75px;">--}}
{{--                        <option value="10">10</option>--}}
{{--                        <option value="20">20</option>--}}
{{--                        <option value="30">30</option>--}}
{{--                        <option value="50">50</option>--}}
{{--                        <option value="100">100</option>--}}
{{--                    </select>--}}
                    <span class="text-muted">
                    Displaying {{ $paginator->count() }} of {{ $paginator->total() }} records
                </span>
                </div>
            </div>
            <!--end:: Pagination-->
        </div>
    </div>
@endif
