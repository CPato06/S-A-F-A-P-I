buttonUp = document.getElementById('button-up');

buttonUp.addEventListener('click', scrollUp);

function scrollUp () {
    
    var currentScroll = document.documentElement.scrollTop;
    
    if(currentScroll > 0) {
       window.requestAnimationFrame(scrollUp);
        window.scrollTo (0, currentScroll - (currentScroll / 10));
    }
}

window.onscroll = function() {
    var scroll = document.documentElement.scrollTop;
    
    if (scroll > 100) {
        buttonUp.style.transform = 'scale(1)';
    } else {
        buttonUp.style.transform = 'scale(0)';
    }
}