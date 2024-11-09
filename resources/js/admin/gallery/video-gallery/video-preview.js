$(document).on('input', '#video_url', function () {
    const url = $(this).val()
    let preview_div = $('#videoPreview')
    let embed_code = ''
    preview_div.empty()
    if (url.includes('youtube.com/watch?v=')) {
        const video_id = url.split('v=')[1];
        embed_code = `<iframe width="100%" height="100%" src="https://www.youtube.com/embed/${video_id}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>`;
    } else if (url.includes('vimeo.com/')) {
        const video_id = url.split('.com/')[1];
        embed_code = `<iframe src="https://player.vimeo.com/video/${video_id}" width="100%" height="100%" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>`;
    }

    if (embed_code) {
        preview_div.append(embed_code)
    } else {
        preview_div.append('')
    }
})
