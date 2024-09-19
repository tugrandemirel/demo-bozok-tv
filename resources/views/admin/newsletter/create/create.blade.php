@php
    $newsletterToggle = 'active';
@endphp
@extends('admin.layouts.app')
@section('title', 'Haber Oluştur')
@push('css')
@endpush
@section('content')
    <div class="card-flush pt-5">
        <form id="newslettersFormStore" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-2">
                   @include('admin.newsletter.create.partials.left')
                </div>
                <div class="col-md-10">
                    @include('admin.newsletter.create.partials.right')
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-end">
                    <button type="button" id="newsletterStoreButton" class="btn btn-primary mr-2">Kaydet</button>
                </div>
            </div>
        </form>
    </div>
    @include('admin.newsletter.create.modals.newsletter-source.category-create-modal')
    @include('admin.newsletter.create.modals.newsletter-source.newsletter-source-create-modal')
@endsection
@push('js')

    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/js/pages/select2.js') }}"></script>

    @vite([
        "resources/js/admin/newsletter/create.js",
        "resources/js/admin/ckeditor.js",
        "resources/js/admin/newsletter/create/general-setting-tab.js",

        "resources/js/admin/newsletter/category-store.js",
        "resources/js/admin/newsletter/newsletter-source-store.js",
        "resources/js/admin/newsletter/create/store.js",
    ])
@endpush
