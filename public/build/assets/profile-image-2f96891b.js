var t=new KTImageInput("kt_profile_avatar");t.on("cancel",function(i){swal.fire({title:"Resim yükleme iptal edildi",icon:"success",buttonsStyling:!1,confirmButtonText:"Tamam!",confirmButtonClass:"btn btn-primary font-weight-bold"})});t.on("change",function(i){swal.fire({title:"Resim Başarılı bir şekilde değiştirildi.",icon:"success",buttonsStyling:!1,confirmButtonText:"Tamam!",confirmButtonClass:"btn btn-primary font-weight-bold"})});t.on("remove",function(i){swal.fire({title:"Resim başarılı bir şekilde kaldırıldı.",type:"error",buttonsStyling:!1,confirmButtonText:"Tamam!",confirmButtonClass:"btn btn-primary font-weight-bold"})});