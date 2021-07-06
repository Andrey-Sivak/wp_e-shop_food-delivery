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

    (function selectCategory() {
        if (!document.querySelector('.categories')) {
            return;
        }

        const categoryItemClass = '.categories__item_link';
        const categoriesList = [...document.querySelectorAll(categoryItemClass)];
        const dishesList = document.querySelector('.dishes-list');
        const categoryCaption = document.querySelector('.dish__category');

        categoriesList.forEach(c => {
            c.addEventListener('click', function (e) {
                if (this.getAttribute('href') !== '#') {
                    return;
                }
                e.preventDefault();
                if (this.classList.contains('active')) {
                    return;
                }

                const categoryId = +this.dataset.id;

                dishesList.innerHTML = '';
                categoryCaption.innerHTML = this.innerHTML;

                const activeCat = categoriesList.filter(c => c.parentElement.classList.contains('active'))[0];
                if (activeCat) {
                    activeCat.parentElement.classList.remove('active');
                }

                this.parentElement.classList.add('active');


                createDishes(categoryId);
            });
        });

        function createDishes(catId, arr = allDishes) {

            for (let i = 0; i < arr.length; i++) {
                if (arr[i][0] === catId) {
                    if (arr[i].length > 1) {
                        arr[i].forEach(a => {
                            if (arr[i][0] === a) {
                                return;
                            }

                            if (a.post_status !== 'publish') {
                                return;
                            }

                            createElements(a);
                        });
                        break;
                    }

                    const emptyCategoryElement = document.createElement('p');
                    emptyCategoryElement.classList.add('dishes-list__empty');
                    emptyCategoryElement.innerHTML = 'Unfortunately there are not dishes in this category';
                    dishesList.appendChild(emptyCategoryElement);
                    break;
                }
            }
        }

        function createElements(data) {
            const dishItem = document.createElement('a');
            dishItem.classList.add('dish');
            dishItem.setAttribute('href', data.link);

            const elementTemplate = `
                                    <div class="dish__img-wrap">
                                      <div class="dish__img" style="background-image: url('${data.img}');"></div>
                                    </div>
                                    <div class="dish__info">
                                      <div class="dish__info_main">
                                        <p class="dish__info_title">${data.post_title}</p>
                                        <p class="dish__info_coast">${data.price}<span></span></p>
                                      </div>
                                      <div class="dish__info_delivery">
                                        <p class="${data.free_delivery ?
                'free' : 'price'}">${data.free_delivery ?
                'Free delivery' : 'Delivery ' + data.delivery_price}</p> 
                                      </div>
                                    </div>`;
            dishItem.insertAdjacentHTML('afterbegin', elementTemplate);

            dishesList.appendChild(dishItem);
        }

    })();

    (function restaurantsSlider() {
        if (!document.querySelector('.restaurants__list')) {
            return;
        }

        $('.restaurants__list').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            prevArrow: '<div class="slick-prev"><span></span></div>',
            nextArrow: '<div class="slick-next"><span></span></div>',
            autoplay: true,
        });
    })();

});