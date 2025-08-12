document.addEventListener('DOMContentLoaded', function () {
    eventListener();

    darkmode();
});

function darkmode() {

    const prefDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    if (prefDarkMode.matches) {
        document.body.classList.add('activado');
    } else {
        document.body.classList.remove('activado');
    }

    prefDarkMode.addEventListener('change', function () {
        if (prefDarkMode.matches) {
            document.body.classList.add('activado');
        } else {
            document.body.classList.remove('activado');
        }
    })

    const darkmode = document.querySelector('.dark-mode');

    darkmode.addEventListener('click', function () {
        document.body.classList.toggle('activado')
    })
}

function eventListener() {
    const mobil = document.querySelector('.mobil-menu');

    mobil.addEventListener('click', navegacionResponsive);

}

function navegacionResponsive() {
    const navegacion = document.querySelector('.nav');

    navegacion.classList.toggle('mostrar')
}