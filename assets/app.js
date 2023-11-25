/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

let hideShowFields = function(selectedValue) {
    // Copy elements into an array with the "spread operator" ... so we can safely use ".forEach"
    let allElements = [...document.querySelectorAll('[data-hide-show-me]')];
    if (parseInt(selectedValue) === 1) {
        allElements.forEach(item => item.classList.remove('hidden-class'));
    } else {
        allElements.forEach(item => item.classList.add('hidden-class'));
    }
};

// wait for page load
window.onload = function() {
    let selectElement = document.querySelector('[data-select-hide-show]');

    // Only if element exists
    if(!!selectElement) {
        selectElement.addEventListener('change', function () {
            hideShowFields(this.value);
        });

        // also trigger once on pageload
        hideShowFields(selectElement.value);
    }
};