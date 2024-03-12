function prikazi(){
    document.getElementById("dodajKomentar").style.display = "flex";
}

function odgovori(event){
    var komentar = event.currentTarget.parentElement;
    var odgovoriForma = komentar.getElementsByTagName('form')[0];
    if(odgovoriForma.classList.contains('formaOdgovori')){
       odgovoriForma.classList.remove('formaOdgovori');
       odgovoriForma.classList.add('aktivnaForma');
    }
    else{
        odgovoriForma.classList.remove('aktivnaForma');
        odgovoriForma.classList.add('formaOdgovori');
        
    }
}
