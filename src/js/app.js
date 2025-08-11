document.addEventListener('DOMContentLoaded', function(){
    eventListener();
});

function eventListener(){
    const mobil = document.querySelector('.mobil-menu');

    mobil.addEventListener('click', navegacionResponsive);

}

function navegacionResponsive(){
    const navegacion = document.querySelector('.nav');

    navegacion.classList.toggle('mostrar')
}