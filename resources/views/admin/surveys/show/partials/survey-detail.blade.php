
<!--begin::Details-->
<div class="d-flex mb-9">
<!--begin: Pic-->
<!--end::Pic-->
<!--begin::Info-->
<div class="flex-grow-1">
    <!--begin::Title-->
    <div class="d-flex justify-content-between flex-wrap mt-1">
        <div class="d-flex mr-3">
            <a href="#" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3">{{ $survey?->title }}</a>
            <a href="#">
                <i class="flaticon2-correct text-success font-size-h5"></i>
            </a>
        </div>
        <div class="my-lg-0 my-3">
            <a href="#" class="btn btn-sm btn-{{ \App\Helpers\Custom\CustomHelper::getSurveyStatusColor($survey->status) }} font-weight-bolder text-uppercase">{{ \App\Helpers\Custom\CustomHelper::getSurveyStatusText($survey->status) }}</a>
        </div>
    </div>
    <!--end::Title-->
    <!--begin::Content-->
    <div class="d-flex flex-wrap justify-content-between mt-1">
        <div class="d-flex flex-column flex-grow-1 pr-8">
            <div class="d-flex flex-wrap mb-4">
                <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2" data-toggle="tooltip" title="Başlangıç Tarihi">
                    <i class="flaticon-calendar-with-a-clock-time-tools mr-2 font-size-lg"></i>Başlangıç Tarihi: {{ $survey?->start_date ?? '-' }}</a>
                <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                    <i class="flaticon-calendar-with-a-clock-time-tools mr-2 font-size-lg"></i>Bitiş Tarihi: {{ $survey?->end_date ?? '-' }}</a>
            </div>
            <span class="font-weight-bold text-dark-50">{!! $survey?->description !!}</span>
        </div>
    </div>
    <!--end::Content-->
</div>
<!--end::Info-->
</div>
    <!--end::Details-->
    <div class="separator separator-solid"></div>
    <!--begin::Items-->
    <div class="d-flex align-items-center flex-wrap mt-8">
    <!--begin::Item-->
    <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                                        <span class="mr-4">
                                            <i class="flaticon-piggy-bank display-4 text-muted font-weight-bold"></i>
                                        </span>
        <div class="d-flex flex-column text-dark-75">
            <span class="font-weight-bolder font-size-sm">Earnings</span>
            <span class="font-weight-bolder font-size-h5">
                                            <span class="text-dark-50 font-weight-bold">$</span>249,500</span>
        </div>
    </div>
    <!--end::Item-->
    <!--begin::Item-->
    <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
        <span class="mr-4">
            <i class="flaticon-confetti display-4 text-muted font-weight-bold"></i>
        </span>
        <div class="d-flex flex-column text-dark-75">
            <span class="font-weight-bolder font-size-sm">Toplam Soru Seçenecek Sayısı</span>
            <a href="#" class="text-primary font-weight-bolder">{{ $options_count ?? '-' }}</a>
        </div>
    </div>
    <!--end::Item-->
    <!--begin::Item-->
    <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
        <span class="mr-4">
            <i class="flaticon-file-2 display-4 text-muted font-weight-bold"></i>
        </span>
        <div class="d-flex flex-column flex-lg-fill">
            <span class="text-dark-75 font-weight-bolder font-size-sm">Soru Sayısı</span>
            <a href="#" class="text-primary font-weight-bolder">{{ $survey?->questions_count ?? '-' }}</a>
        </div>
    </div>
    <!--end::Item-->
    <!--begin::Item-->
    <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
        <span class="mr-4">
            <i class="flaticon-chat-1 display-4 text-muted font-weight-bold"></i>
        </span>
        <div class="d-flex flex-column">
            <span class="text-dark-75 font-weight-bolder font-size-sm">Katılımcı Sayısı</span>
            <a href="#" class="text-primary font-weight-bolder">90</a>
        </div>
    </div>
    <!--end::Item-->
<!--end::Item-->
</div>
<!--begin::Items-->
