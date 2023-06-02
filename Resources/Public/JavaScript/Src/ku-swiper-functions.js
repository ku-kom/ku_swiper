/**
 * Init Swiper plugin with settings from html data-* attributes.
 * @author NEL
 * @copyright 2023.
 */

document.addEventListener('DOMContentLoaded', () => {
    'use strict';

    // Swiper play/pause button classes
    const play = 'bi-play-fill';
    const pause = 'bi-pause-fill';
    const swipers = document.querySelectorAll('.swiper-slideshow');

    class SwiperState {
        constructor(swiper, thumbsgallery) {
            this.swiper = swiper;
            this.gallery = thumbsgallery;
            this.children = swiper.querySelectorAll('.swiper-slide').length;

            this.btn = swiper.parentNode.querySelector('.btn');
            if (this.btn) {
                this.icon = this.btn.querySelector('.bi');
            }
            // Custom Swiper settings from html data-* attributes
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

            if (this.gallery) {
                this.defaultOptions = Object.assign(this.defaultOptions, {
                    loop: true,
                    thumbs: {
                        swiper: this.initThumbs(),
                    },
                }
                );
            }

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
             * If this.dataOptions.initialSlide is set to 1, get random integer between min and max, both inclusive.
             * Set to 0 to use default slide order.
             * @param max: (total number of slides
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
                let slideshow = new Swiper(this.swiper, this.settings);
            }
        }


        initThumbs() {
            /**
             * Check if Swiper plugin exists and init Swiper gallery
             */
            if (typeof Swiper !== 'undefined') {
                if (this.gallery) {
                    // Default gallery settings
                    this.thumbsOptions = {
                        slidesPerView: 'auto',
                        loop: true,
                        spaceBetween: 10,
                        freeMode: true,
                        watchSlidesProgress: true
                    }
                    let thumbs = new Swiper(this.gallery, this.thumbsOptions);
                    return thumbs;
                };
            }
        }

        addEventListeners() {
            this.btn.addEventListener('click', () => {
                this.togglePlayPause();
            });
        }

        togglePlayPause() {
            if (this.swiper.swiper.autoplay.running) {
                this.pauseSwiper();
            } else {
                this.playSwiper();
            }
        }

        playSwiper() {
            this.swiper.swiper.autoplay.start();
            this.icon.classList.replace(play, pause);
            this.btn.setAttribute('aria-label', translate.pause);
        }

        pauseSwiper() {
            this.swiper.swiper.autoplay.stop();
            this.icon.classList.replace(pause, play);
            this.btn.setAttribute('aria-label', translate.play);
        }

        prefersReducedMotion() {
            if (this.swiper.swiper.autoplay.running && matchMedia('(prefers-reduced-motion)').matches) {
                this.pauseSwiper();
            }
        }
    }

    if (swipers) {
        /**
         * Assign Swiper to swiper elements - also thumbnail gallery if enabled
        */
        swipers.forEach((el) => {
            let thumbsgallery;
            if (el.dataset.hasgallery === '1') {
                thumbsgallery = el.closest('.swiper-element').querySelector('[data-gallery^="gallery_swiper_"]');
            }
            const swiperEl = new SwiperState(el, thumbsgallery);
        });
    }

});