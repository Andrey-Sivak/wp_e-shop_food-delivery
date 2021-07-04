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

        categoriesList.forEach(c => {
            c.addEventListener('click', function (e) {
                e.preventDefault();
                if (this.classList.contains('active')) {
                    return;
                }

                const categoryId = +this.dataset.id;

                dishesList.innerHTML = '';

                this.classList.add('active');
                document.querySelector(`${categoryItemClass}.active`)
                    .classList.remove('active');

                if (categoryId === 23) {
                    createDishes(categoryId, hitsDishes);
                }

                createDishes(categoryId);
            });

            function createDishes(catId, arr = allDishes) {

                if (arr !== allDishes) {
                    arr.forEach(a => {
                       createElements(a);
                    });
                    return;
                }

                for (let i = 0; i < allDishes.length; i++) {
                    if (allDishes[i][0] === catId) {
                        if (allDishes[i].length > 1) {
                            allDishes[i].forEach(a => {
                                if (allDishes[i][0] === a) {
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
                const dishItem = document.createElement('div');
                dishItem.classList.add('dish');

                const elementTemplate = `
                                    <div class="dish__img-wrap">
                                      <div class="dish__img" style="background-image: url('${data.img}');"></div>
                                    </div>
                                    <div class="dish__info">
                                      <div class="dish__info_main">
                                        <p class="dish__info_title">${data.post_title}</p>
                                        <p class="dish__info_coast">${data.price}<span></span></p>
                                      </div>
                                    </div>`;
                dishItem.insertAdjacentHTML('afterbegin', elementTemplate);

                dishesList.appendChild(dishItem);
            }
        });
    })();

});