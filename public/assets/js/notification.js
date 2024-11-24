// Hata mesajlarını göster
function error(response) {
    // Güvenli bir şekilde response ve data nesnelerini alın
    let { data } = response?.response || {};
    let { icon, errors, status, message } = data || {}; // data varsayılan olarak boş olabilir

    // Hata mesajlarını oluştur
    let errorMessage = '';

    if (errors && typeof errors === 'object') {
        // errors bir nesne ise, anahtarları üzerinde döngü yaparak her bir hatayı topla
        Object.keys(errors).forEach(key => {
            if (Array.isArray(errors[key])) {
                errors[key].forEach(error => {
                    errorMessage += formatTimelineError(error); // Hata mesajlarını timeline formatında oluştur
                });
            } else {
                // Eğer dizi değilse, tek bir hata mesajı olarak ele al
                errorMessage += formatTimelineError(errors[key]); // Hata mesajlarını timeline formatında oluştur
            }
        });
    } else {
        // Eğer errors tanımlı değilse veya dizi değilse varsayılan bir hata mesajı ekle
        errorMessage = formatTimelineError(message || 'Bilinmeyen bir hata oluştu.');
    }

    // SweetAlert2 ile hata mesajını göster
    swal.fire({
        title: status ? 'Hata' : 'Başarısız', // status'a göre başlık ayarı
        icon: icon || 'error', // Varsayılan icon: 'error'
        html: `<div class="timeline timeline-6 mt-3">${errorMessage}</div>`, // HTML olarak timeline formatını ekle
        showConfirmButton: true,
        confirmButtonText: 'Tamam',
    });
}

// Başarı mesajlarını göster
function success(response) {
    let { data } = response || {}; // response.response boş olabilir
    let { icon, message, status } = data || {}; // data boş olabilir

    // Başarı mesajını oluştur
    let successMessage = '';
    if (message) {
        successMessage = formatTimelineSuccess(message); // Başarı mesajını timeline formatında oluştur
    } else {
        // Eğer message tanımlı değilse varsayılan bir başarı mesajı ekle
        successMessage = formatTimelineSuccess('Başarıyla tamamlandı.');
    }

    // SweetAlert2 ile başarı mesajını göster
    swal.fire({
        title: status ? 'Başarılı' : 'Başarı',
        icon: icon || 'success',
        html: `<div class="timeline-container">${successMessage}</div>`, // Genel div ile timeline formatını ekle
        showConfirmButton: true,
        confirmButtonText: 'Tamam',
    });
}

// timeline formatındaki HTML için fonksiyonlar
function formatTimelineError(error) {
    let currentTime = new Date().toLocaleTimeString('tr-TR', {
        hour: '2-digit',
        minute: '2-digit'
    });

    return `
    <div class="timeline-item align-items-start">
        <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">${currentTime}</div>
        <div class="timeline-badge">
            <i class="fa fa-genderless text-danger icon-xl"></i>
        </div>
        <div class="font-weight-normal font-size-lg timeline-content pl-3">
            ${error}
        </div>
    </div>`;
}

function formatTimelineSuccess(message) {
    let currentTime = new Date().toLocaleTimeString('tr-TR', {
        hour: '2-digit',
        minute: '2-digit'
    });

    return `
    <div class="timeline-item align-items-start">
        <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">${currentTime}</div>
        <div class="timeline-badge">
            <i class="fa fa-genderless text-success icon-xl"></i>
        </div>
        <div class="font-weight-normal font-size-lg timeline-content pl-3">
            ${message}
        </div>
    </div>`;
}
