var deconnecte = document.getElementById('deconnecte');
deconnecte.addEventListener('click', function(e){
    e.preventDefault();
    if(confirm('Voulez-vous vraiment déconnecter ?')){
        location.href = deconnecte;
    }
});