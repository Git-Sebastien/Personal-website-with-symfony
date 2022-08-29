/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

import './intersectionObserver';

const burger = document.getElementById('burger');
const nav = document.querySelector('.main-nav')
const li = document.querySelector('.main-nav>ul>li')


burger.addEventListener('click', () => {
    burger.classList.toggle('active')
    nav.classList.toggle('active')
    li.classList.toggle("forward");
});

// var text = `Let me = me \nerhettntegber`;

// // Variable for current position
// var curr = 0;

// var Write = function write() {

//     // Find the target element to write to
//     var elem = document.getElementById('subtitle');

//     // Append next character into the text content
//     elem.textContent += text.charAt(curr);

//     // Update the current position
//     curr++;

//     // if we're not yet in the end of the string
//     // we have a little (20ms) pause before we write the next character
//     if (curr < text.length)
//         window.setTimeout(write, 200);
// };

// Write(); // And of course we have to call the function

import Typed from 'typed.js'



var typed = new Typed('.typed', {
    strings: ["Bienvenue sur mon site personnel.<br>"],
    typeSpeed: 60,
    startDelay: 2000
});

var typed1 = new Typed('.typed1', {
    strings: ["Vous trouverez mes réalisations ainsi que mes compétences !<br>"],
    typeSpeed: 60,
    startDelay: 5000
});

var typed2 = new Typed('.typed2', {
    strings: ["N'hésitez pas a me contacter pour toutes demandes<br>"],
    typeSpeed: 60,
    startDelay: 11000
});