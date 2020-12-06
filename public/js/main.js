console.log('hello Crearchitex')

let mobileNav = document.querySelector('header .container_12.mobile-menu')
let triggerButton = document.querySelectorAll('.trigger')

triggerButton.forEach(btn => {
    btn.addEventListener('click', ()=> {
        if (mobileNav.classList.contains('active')) mobileNav.classList.remove('active')
        else mobileNav.classList.add('active')
    })
})

console.log(mobileNav)