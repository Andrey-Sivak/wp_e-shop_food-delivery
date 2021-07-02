'use strict';
import * as $ from 'jquery';
import './slick.min';
import './jquery.validate.min.js'

window.addEventListener('load', function () {

    (function mobMenu() {
        if (document.querySelector('.header__mob-menu')) {
            const menuBtn = document.querySelector('.header__mob-menu');
            const header = document.querySelector('.header');
            const headerWrap = document.querySelector('.header__wrap');

            menuBtn.addEventListener('click', e => {
                e.preventDefault();
                header.classList.toggle('active');
                headerWrap.classList.toggle('active');
            })
        }
    })();

});