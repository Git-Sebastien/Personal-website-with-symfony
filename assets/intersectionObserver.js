const ratio = .4;

const fade = document.querySelectorAll('.fade');
const slide = document.querySelectorAll('.slide')


let options = {
    root: null,
    rootMargin: '0px',
    threshold: ratio
}

const handleIntersect = (entries, observer) => {
    entries.forEach(function(entry) {
        if (entry.intersectionRatio > ratio) {
            entry.target.classList.add('appear');
            observer.unobserve(entry.target)
        }
    });
}

const observer = new IntersectionObserver(handleIntersect, options);

fade.forEach(function(r) {
    observer.observe(r);
})

slide.forEach(function(r) {
    observer.observe(r);
})