const toggle = document.getElementsByClassName('barra')[0]
const navbarlinks = document.getElementsByClassName('links')[0]
        toggle.addEventListener('click', () => {
            navbarlinks.classList.barra('active')
        })