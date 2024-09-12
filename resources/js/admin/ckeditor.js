import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

// Tüm .editor sınıfına sahip textarea elemanlarını seçin
let ckeditors = document.querySelectorAll('.editor');

ckeditors.forEach((editorElement) => {
    ClassicEditor
        .create(editorElement, { // editorElement kullanın
            toolbar: [
                'heading', '|',
                'bold', 'italic', '|',
                'imageUpload', 'blockQuote', 'undo', 'redo'
            ],
            image: {
                toolbar: ['imageTextAlternative', 'imageStyle:full', 'imageStyle:side']
            },
            simpleUpload: {
                uploadUrl: '/your-image-upload-endpoint',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            },
        })
        .catch(error => {
            console.error(error);
        });
});
