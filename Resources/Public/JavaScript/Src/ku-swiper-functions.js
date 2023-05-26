/**
 * Init Swiper plugin with settings from html data-* attributes.
 * @author NEL
 * @copyright 2023.
 */

document.addEventListener('DOMContentLoaded', () => {
    'use strict';

    // Swiper play/pause classes
    const play = 'bi-play-fill';
    const pause = 'bi-pause-fill';
    const slideshows = document.querySelectorAll('.swiper');

    class SwiperState {
        constructor(swiper) {
            this.swiper = swiper;
            this.children = swiper.querySelectorAll('.swiper-slide').length;
            this.btn = swiper.parentNode.querySelector('.btn');
            if (this.btn) {
                this.icon = this.btn.querySelector('.bi');
            }
            // Declare custom Swiper settings from html data-* attributes
            this.id = this.swiper.dataset.id;
            this.data = this.swiper.dataset.slides || {};
            if (this.data) {
                this.dataOptions = JSON.parse(this.data);
            }

            // Default settings which cannot be changed by user
            this.defaultOptions = {
                loopPreventsSliding: false,
                spaceBetween: 20,
                initialSlide: this.getRandomSlide(this.children),
                keyboard: true,
                pagination: {
                    el: swiper.parentNode.querySelector('.swiper-pagination'),
                    clickable: true
                },
                navigation: {
                    nextEl: swiper.parentNode.querySelector('.swiper-button-next'),
                    prevEl: swiper.parentNode.querySelector('.swiper-button-prev'),
                }
            };

            // Merge custom Swiper settings with default settings
            this.settings = Object.assign({}, this.dataOptions, this.defaultOptions);

            this.initSwiper();
            this.prefersReducedMotion();
            if (this.btn) {
                this.addEventListeners();
            }
        }

        getRandomSlide(max) {
            /**
             * If set to 1, get random integer between two values, both inclusive.
             * Set to 0 to use default slide order.
             * @param max: (total number of slides.
             * @returns (int) start slide  
             */
            let min = 0;
            max = Math.floor(max);
            return this.dataOptions.initialSlide === 1 ? Math.floor(Math.random() * (max - min + 1) + min) : min;
        }

        initSwiper() {
            /**
             * Check if Swiper plugin exists and init Swiper
             */
            if (typeof Swiper !== 'undefined') {
                this.swiper = new Swiper(this.swiper, this.settings);
            }
        }

        addEventListeners() {
            this.btn.addEventListener('click', () => {
                this.togglePlayPause();
            });
        }

        togglePlayPause() {
            if (this.swiper.autoplay.running) {
                this.pauseSwiper();
            } else {
                this.playSwiper();
            }
        }

        playSwiper() {
            this.swiper.autoplay.start();
            this.icon.classList.replace(play, pause);
            this.btn.setAttribute('aria-label', translate.pause);
        }

        pauseSwiper() {
            this.swiper.autoplay.stop();
            this.icon.classList.replace(pause, play);
            this.btn.setAttribute('aria-label', translate.play);
        }

        prefersReducedMotion() {
            if (this.swiper.autoplay.running && matchMedia('(prefers-reduced-motion)').matches) {
                this.pauseSwiper();
            }
        }
    }

    if (slideshows) {
        /**
         * Assign Swiper to swiper elements
        */
        Array.from(slideshows).forEach((slideshow) => {
            const swiperEl = new SwiperState(slideshow);
        });
    }
});