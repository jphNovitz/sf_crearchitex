console.log('hello Crearchitex')

let mobileNav = document.querySelector('header .container_12.mobile-menu')
let triggerButton = document.querySelectorAll('.trigger')

triggerButton.forEach(btn => {
    btn.addEventListener('click', ()=> {
        if (mobileNav.classList.contains('active')) mobileNav.classList.remove('active')
        else mobileNav.classList.add('active')
    })
})


/* Roll number bullet from grey to green */
let numArticles = document.querySelectorAll('[id^="num-"]')
let i =0
numArticles.forEach(article => {
    let num = article.querySelector('.num')
    setTimeout(()=>{
        num.style.backgroundColor = '#81b600'
    }, i*4000)
    setTimeout(()=>{
        num.style.removeProperty('background-color')
    }, i*8000)
    i++
})