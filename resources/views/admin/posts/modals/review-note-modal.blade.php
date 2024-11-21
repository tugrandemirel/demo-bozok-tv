<div class="modal fade" id="reviewNote" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Köşe Yazısı Bildirimleri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="" class="table align-middle table-row-dashed fs-6 gy-5" data-uuid="{{ $post->post_uuid }}">
                        <thead>
                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                            <th>Açıklama</th>
                            <th>Durum</th>
                            <th>Geri Bildirim Yapan</th>
                            <th>Tarih</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                        @forelse($post_reviews as $post_review)
                            <tr>
                                <td>
                                    {!! $post_review->review_note !!}
                                </td>
                                <td>
                                    <span style="width: 120px;">
                                        <span class="label label-{{ \App\Helpers\Custom\CustomHelper::getPostStatusLabelColor($post_review?->status?->code) }}  label-dot mr-2"></span>
                                        <span class="font-weight-bold text-{{ \App\Helpers\Custom\CustomHelper::getPostStatusLabelColor($post_review?->status?->code) }} ">{{ $post_review?->status?->name }}</span>
                                    </span>
                                </td>
                                <td>
                                    {{ $post_review->user?->name }} {{ $post_review->user?->surname }}
                                </td>
                                <td>
                                    {{ $post_review->created_at->translatedFormat('j F Y') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>@include('admin.not-founded')</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>
