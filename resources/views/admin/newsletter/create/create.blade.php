@php
    $newsletterToggle = 'active';
@endphp
@extends('admin.layouts.app')
@section('title', 'Haber Oluştur')
@push('css')
@endpush
@section('content')
    <div class="card-flush pt-5">
        <div class="row">
            <div class="col-md-2">
               @include('admin.newsletter.create.partials.left')
            </div>
            <div class="col-md-10">
                @include('admin.newsletter.create.partials.right')
            </div>
        </div>
    </div>
    @include('admin.newsletter.create.modals.newsletter-source.category-create-modal')
    @include('admin.newsletter.create.modals.newsletter-source.newsletter-source-create-modal')
@endsection
@push('js')

    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/js/pages/select2.js') }}"></script>
    <script src="{{ asset('assets/js/file-upload/dropzonejs.js') }}"></script>

    @vite([
        "resources/js/admin/newsletter/create.js",
        "resources/js/admin/ckeditor.js",
        "resources/js/admin/newsletter/create/general-setting-tab.js",
        "resources/js/admin/newsletter/create/dropzone.js",
    ])
@endpush
