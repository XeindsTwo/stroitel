const o=document.querySelectorAll(".admin__confirm");o.forEach(t=>{t.addEventListener("click",function(){const n=this.getAttribute("data-id");confirm("Вы уверены, что хотите одобрить этот отзыв? В дальнейшем отзыв можно только удалить из БД окончательно")&&fetch(`/admin/reviews/${n}/approve`,{method:"PUT",headers:{"X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').getAttribute("content"),"Content-Type":"application/json",Accept:"application/json"}}).then(e=>{if(!e.ok)throw new Error("Ошибка при одобрении отзыва");return e.json()}).then(e=>{alert(e.message),t.closest(".admin__item").remove()}).catch(e=>{console.error("Ошибка:",e),alert("Произошла ошибка. Попробуйте еще раз.")})})});