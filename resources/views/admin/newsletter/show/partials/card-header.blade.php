@php use App\Helpers\Custom\CustomHelper; @endphp
@isset($newsletter)
    <div class="ribbon-target" style="top: 12px;">
        <span
            class="ribbon-inner bg-{{ CustomHelper::getNewsletterPublicationStatusLabelColor($newsletter->code) }}"></span>{{ CustomHelper::getNewsletterPublicationStatusLabelText($newsletter->code) }}
    </div>
    <h3 class="card-title">
        {{ $newsletter->title }}
    </h3>

@endisset
