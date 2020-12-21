console.log('hello Crearchitex')

let mobileNav = document.querySelector('header nav')
let triggerButton = document.querySelectorAll('.trigger')

triggerButton.forEach(btn => {
    btn.addEventListener('click', () => {
        if (mobileNav.classList.contains('active')) mobileNav.classList.remove('active')
        else mobileNav.classList.add('active')
    })
})


/* Roll number bullet from grey to green */
let numArticles = document.querySelectorAll('[id^="num-"]')
let i = 0
numArticles.forEach(article => {
    let num = article.querySelector('.num')
    setTimeout(() => {
        num.style.backgroundColor = '#81b600'
    }, i * 4000)
    setTimeout(() => {
        num.style.removeProperty('background-color')
    }, i * 8000)
    i++
})

/* manage thumbnail height*/
let projectThumbs = document.querySelectorAll('.thumbnail')
if (projectThumbs !== undefined) {
    projectThumbs.forEach(thumb => {
        let image = thumb.querySelector('img')
        let cache = thumb.querySelector('.cache')
        image.style.height = image.clientWidth + 'px'
        thumb.style.height = image.clientWidth + 'px'
        cache.style.height = image.clientWidth + 'px'
    })
}

listenZoom()

/* zooms */
function listenZoom () {
    let zooms = document.querySelectorAll('.zoom-it')

    zooms.forEach(zoom => {
        zoom.addEventListener('click', () => {
            let id = zoom.dataset.id
            console.log(id)
            var request = new XMLHttpRequest();
            request.open('GET', '/projet/' + id, true)
            request.onload = function () {
                if (request.status >= 200 && request.status < 400) {
                    let body = document.querySelector('body')
                    body.innerHTML = body.innerHTML + request.response

                    setTimeout(() => {
                        body.querySelector('.zoom').classList.add('active')
                        closeZoom()
                    }, 1000)
                }
            };

            request.send();


        })
    })
}

function closeZoom() {
    setTimeout(() => {
        let zoomClose = document.querySelector('#zoom-close')
        zoomClose.addEventListener('click', () => {
            document.querySelector('.zoom').classList.remove('active')
            let child = document.querySelector('.zoom')
            // body.removeChild(child)
            listenZoom()
        })

    }, 5000)
}
