let t=KTUtil.getById("postStatusModalButton");KTUtil.addEvent(t,"click",function(){t.disabled=!0,KTUtil.btnWait(t,"spinner spinner-right spinner-white pr-15","Lütfen bekleyiniz."),setTimeout(function(){let e=$("#postStatusModalForm"),n=new FormData(e[0]),a=e.data("uuid");n.append("post_uuid",a);let o="/admin/dashboard/posts/update";axios.post(o,n).then(function(i){i.status===200&&(success(i),setTimeout(function(){location.reload()},2e3))}).catch(function(i){error(i)}).finally(function(){KTUtil.btnRelease(t),t.disabled=!1})},1e3)});