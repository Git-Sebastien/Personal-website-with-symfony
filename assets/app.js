/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus applicatio
import './bootstrap';

import './intersectionObserver';

const burger = document.getElementById('burger');
const nav = document.querySelector('.main-nav');
const li = document.querySelector('.main-nav>ul>li');
const form = document.querySelector('#form-contact');

burger.addEventListener('click', () => {
    burger.classList.toggle('active')
    nav.classList.toggle('active')
    li.classList.toggle("forward");
});

import Typed from 'typed.js';

var typed = new Typed('.typed', {
    strings: ["Bienvenue sur mon site personnel.<br>"],
    typeSpeed: 30,
    startDelay: 2000
});

var typed1 = new Typed('.typed1', {
    strings: ["Vous trouverez mes réalisations ainsi que mes compétences !<br>"],
    typeSpeed: 30,
    startDelay: 3500
});

var typed2 = new Typed('.typed2', {
    strings: ["N'hésitez pas a me contacter pour toutes demandes<br>"],
    typeSpeed: 30,
    startDelay: 6100
});

const siteKey = '6LcOI-whAAAAACmGnKqML46B5q6BN-bEb7-pE4y1';



//or on form post:
grecaptcha.ready(function() {
    grecaptcha.execute(siteKey, {
        action: 'homepage'
    }).then(function(token) {
        //submit the form
        return http.post(url, { email, captcha: token });
    });
});