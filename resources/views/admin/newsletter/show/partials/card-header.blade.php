@isset($newsletter)
<div class="ribbon-target" style="top: 12px;">
    <span class="ribbon-inner bg-{{ \App\Helpers\Custom\CustomHelper::getNewsletterPublicationStatusLabelColor($newsletter->code) }}"></span>{{ \App\Helpers\Custom\CustomHelper::getNewsletterPublicationStatusLabelText($newsletter->code) }}
</div>
<h3 class="card-title">
    {{ $newsletter->title }}
</h3>
@endisset
