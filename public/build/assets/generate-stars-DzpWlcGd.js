document.addEventListener("DOMContentLoaded",function(){document.querySelectorAll(".company-reviews__rating").forEach(function(t){const n=parseInt(t.textContent);t.innerHTML=r(n)})});function r(e){let t="";for(let n=0;n<e;n++)t+='<span class="star star-filled">&#9733;</span>';return t}