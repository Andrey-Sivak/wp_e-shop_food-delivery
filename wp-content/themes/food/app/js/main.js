'use strict';
import * as $ from 'jquery';
import './slick.min';
import './jquery.validate.min.js'

window.addEventListener('load', function () {

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
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });

        document.querySelector('.restaurants__list').parentElement.removeChild(document.querySelector('.loader'));
        document.querySelector('.restaurants__list').classList.remove('hide');
    })();

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
        const dishes = [...dishesList.children];
        const dishesWrap = dishesList.parentElement;

        if (dishes.length <= dishesCount) {
            dishes.forEach(d => {
                d.style.display = 'block';
                d.classList.add('active');
            });
        } else {
            showDishes(dishes, 0, dishesCount);
            addSeeMoreBtn(dishes);
        }

        dishes.forEach(d => {
            d.addEventListener('click', function (e) {
                const target = e.target;
                if (target.classList.contains('dish__favorite')) {
                    e.preventDefault();
                    const id = target.dataset.dish;
                    like(id, target);
                }
            })
        });

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
                if (document.querySelector('.dishes__see-more')) {
                    dishesWrap.removeChild(document.querySelector('.dishes__see-more'));
                }
                if (document.querySelector('.dishes__note')) {
                    dishesWrap.removeChild(document.querySelector('.dishes__note'));
                }
                categoryCaption.innerHTML = this.innerHTML;

                const activeCat = categoriesList.filter(c => c.parentElement.classList.contains('active'))[0];
                if (activeCat) {
                    activeCat.parentElement.classList.remove('active');
                }

                this.parentElement.classList.add('active');


                createDishes(categoryId);

                const currentDishes = [...document.querySelectorAll('.dish')];

                if (currentDishes.length <= dishesCount) {
                    currentDishes.forEach((d, i) => {
                        d.style.display = 'block';
                        setTimeout(() => {
                            d.classList.add('active');
                        }, 300 * (i - 1));
                    });
                    return;
                }

                showDishes(currentDishes, 0, dishesCount);
                addSeeMoreBtn(currentDishes);
            });
        });

        function createDishes(catId, arr = allDishes) {
            const currentArr = arr.filter(a => a[0] === catId);
            const currentArrLength = currentArr[0].length - 1;

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

            if (currentArrLength % 3 === 2) {
                const helpElem = document.createElement('div');
                helpElem.classList.add('dish', 'hidden');
                dishesList.appendChild(helpElem);
            }
        }

        function createElements(data) {
            const dishItem = document.createElement('a');
            dishItem.classList.add('dish');
            if (data.biglunch) {
                dishItem.setAttribute('href', `${data.link}?biglunch=1`);
            } else {
                dishItem.setAttribute('href', data.link);
            }

            const elementTemplate = `
                                    <div class="dish__img-wrap">
                                    <span data-dish="${data.ID}" class="dish__favorite${data.favorite ? ' active' : ''}"></span>
                                      <div class="dish__img" style="background-image: url('${data.img}');"></div>
                                    </div>
                                    <div class="dish__info">
                                      <div class="dish__info_main">
                                        <p class="dish__info_title">${data.post_title}</p>
                                        <p class="dish__info_coast">${data.price}&#8364;<span></span></p>
                                      </div>
                                      <div class="dish__info_delivery">
                                        <p class="${data.free_delivery ?
                'free' : 'price'}">${data.free_delivery ?
                'Free delivery' : 'Delivery ' + data.delivery_price}&#8364;</p> 
                                      </div>
                                    </div>`;

            dishItem.addEventListener('click', function (e) {
                const target = e.target;
                if (target.classList.contains('dish__favorite')) {
                    e.preventDefault();
                    const id = target.dataset.dish;
                    like(id, target);
                }
            });

            dishItem.insertAdjacentHTML('afterbegin', elementTemplate);

            dishesList.appendChild(dishItem);
        }

        function showDishes(dishes, start, end) {
            const dishesToShow = dishes.slice(start, end);
            dishesToShow.forEach((d, i) => {
                d.style.display = 'block';
                setTimeout(() => {
                    d.classList.add('active');
                }, 300 * i)
            })
        }

        function addSeeMoreBtn(arr) {
            const seeMoreBtn = document.createElement('span');
            seeMoreBtn.classList.add('dishes__see-more');
            seeMoreBtn.innerHTML = 'See more';
            seeMoreBtn.addEventListener('click', function (e) {
                e.preventDefault();
                const activeDishes = document.querySelectorAll('.dish.active');
                if (activeDishes.length + dishesCount > arr.length) {
                    showDishes(arr, activeDishes.length, arr.length);

                    dishesWrap.removeChild(seeMoreBtn);

                    const noteText = document.createElement('p');
                    noteText.classList.add('dishes__note');
                    noteText.innerHTML = 'No more dishes in this category';
                    setTimeout(() => {
                        dishesWrap.appendChild(noteText);
                    }, 300 * dishesCount);
                    return;
                }

                showDishes(arr, activeDishes.length, activeDishes.length + dishesCount);
            });
            dishesWrap.appendChild(seeMoreBtn);
        }

        function like(id, targetElem) {
            $.ajax({
                type: "POST",
                url: `${theme_directory}/inc/add-to-favorites.php`,
                data: {
                    like: id
                },

                success: function() {
                    targetElem.classList.toggle('active');
                }
            });
        }

    })();

    (function categoriesSlider() {
        if (!document.querySelector('.categories')) {
            return;
        }

        let isMobile = false;
        const sliderSelector = '.categories';

        if (document.body.offsetWidth < 767) {
            isMobile = true;
            initSlider(sliderSelector);
        }

        window.addEventListener('resize', function (e) {
            let windowWidth = document.body.offsetWidth;
            if (windowWidth < 767) {
                if (!isMobile) {
                    isMobile = true;
                    initSlider(sliderSelector);
                }
            } else if (isMobile) {
                isMobile = false;
                destroySlider(sliderSelector);
            }
        });

        function initSlider(slider) {
            $(slider).slick({
                infinite: false,
                slidesToShow: 5,
                variableWidth: true,
                swipeToSlide: true,
                prevArrow: '',
                nextArrow: '',
                responsive: [
                    {
                        breakpoint: 475,
                        settings: {
                            slidesToShow: 4,
                        }
                    },
                ]
            })
        }

        function destroySlider(slider) {
            $(slider).slick('unslick');
        }
    })();

});