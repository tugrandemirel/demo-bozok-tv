let e=KTUtil.getById("newsletterStoreButton");KTUtil.addEvent(e,"click",function(){e.disabled=!0,KTUtil.btnWait(e,"spinner spinner-right spinner-white pr-15","Lütfen bekleyiniz."),setTimeout(function(){let n=$("#newslettersFormUpdate"),i=new FormData(n[0]),a=n.data("uuid");i.append("newsletter_uuid",a);let l="/admin/dashboard/newsletters/update";axios.post(l,i).then(function(t){t.status===200&&($("#newsletterSourceCreateModal").modal("hide"),n[0].reset(),success(t),setTimeout(function(){window.location.href="/admin/dashboard/newsletters/show/"+a},2e3))}).catch(function(t){error(t)}).finally(function(){KTUtil.btnRelease(e),e.disabled=!1})},1e3)});