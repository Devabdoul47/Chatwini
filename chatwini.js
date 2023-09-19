var deconnecter = document.getElementById('deconnecter');
var boiteu = document.getElementById('boiteu');
var non = document.getElementById('non');

deconnecter.addEventListener('click', function () {
   boiteu.style.display ="block";
});
non.addEventListener('click', ()=>{
    boiteu.style.display ="none";
});
