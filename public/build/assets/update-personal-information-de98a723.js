let t=KTUtil.getById("updatePersonalInformation");KTUtil.addEvent(t,"click",function(){t.disabled=!0,KTUtil.btnWait(t,"spinner spinner-right spinner-white pr-15","Lütfen bekleyiniz."),setTimeout(function(){let e=$("#updatePersonalInformationForm"),i=new FormData(e[0]),a="/admin/dashboard/profile/update";axios.post(a,i).then(function(n){n.status===200&&(success(n),setTimeout(function(){location.reload()},2e3))}).catch(function(n){error(n)}).finally(function(){KTUtil.btnRelease(t),t.disabled=!1})},1e3)});