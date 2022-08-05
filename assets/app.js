/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

import * as bootstrap from 'bootstrap'


let addToCartBtn = $('.main-cta');
let gradiant = $('.gradiant');

addToCartBtn.mousemove(function (e) {
    const {
              left: t,
              width: n,
              top: o,
              height: i,
          } = e.target.getBoundingClientRect(), r = (e.clientX - t) / n * 100, s = (e.clientY - o) / i * 100;

    gradiant.css('--mouse-x', String(r));
    gradiant.css('--mouse-y', String(s));
    gradiant.css('background-position', 'calc((100 - var(--mouse-x, 0)) * 1%) calc((100 - var(--mouse-y, 0)) * 1%)');
})
