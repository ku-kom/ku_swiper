/**
 * Init Swiper plugin with settings from html data-* attributes.
 * @author Nanna Ellegaard
 * @copyright 2023.
 */

document.addEventListener('DOMContentLoaded', () => {
    'use strict';

    // Swiper play/pause button icon classes
    const play = 'bi-play-fill';
    const pause = 'bi-pause-fill';
    // Swiper elements
    const swipers = document.querySelectorAll('.swiper-slideshow');

    class SwiperState {
        constructor(swiper, thumbsgallery) {
            this.swiper = swiper;
            this.gallery = thumbsgallery;
            // Number of slides
            this.children = swiper.querySelectorAll('.swiper-slide').length;
            // Play/pause button
            this.btn = swiper.parentNode.querySelector('.btn');
            // Button icon
            if (this.btn) {
                this.icon = this.btn.querySelector('.bi');
            }
            // Custom Swiper settings from html data-* attributes
            this.id = this.swiper.dataset.id;
            this.data = this.swiper.dataset.slides || {};
            if (this.data) {
                this.dataOptions = [];
                try {
                    this.dataOptions = JSON.parse(this.data);
                }
                catch (e) {
                    console.log(`${e}. Error getting custom data. Using Swiper defaults instead.`);
                }
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

            // If slideshow has a corresponding thumb gallery, add settings to control it
            if (this.gallery) {
                this.defaultOptions = Object.assign(this.defaultOptions, {
                    loop: true,
                    thumbs: {
                        swiper: this.initThumbs(), // thumb gallery instance
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
             * If this.dataOptions.initialSlide equals 1, get random integer between min and max, both inclusive.
             * Set to 0 to use default added slide order.
             * @param max: (int) total number of slides
             * @returns (int) start slide  
             */
            const min = 0;
            max = Math.floor(max);
            let isRandom = this.dataOptions.initialSlide || 0;
            return isRandom === 1 ? Math.floor(Math.random() * (max - min + 1) + min) : min;
        }

        initSwiper() {
            /**
             * init Swiper
             */
            let slideshow = new Swiper(this.swiper, this.settings);
        }

        initThumbs() {
            /**
             * Init Swiper thumb gallery
             */

            if (this.gallery) {
                // Default thumb gallery settings
                this.thumbsOptions = {
                    slidesPerView: 1.3,
                    loop: true,
                    spaceBetween: 10,
                    freeMode: true,
                    watchSlidesProgress: true,
                    breakpoints: {
                        992: {
                          slidesPerView: 'auto',
                        },
                    }
                }
                let thumbs = new Swiper(this.gallery, this.thumbsOptions);
                return thumbs;
            };
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

    if (swipers && typeof Swiper !== 'undefined') {
        /**
         * If Swiper plugin exists, assign Swiper to swiper elements
        */
        swipers.forEach((el) => {
            // If a slideshow has enabled thumbs gallery, pass it along as well
            let thumbsgallery;
            if (el.dataset.hasgallery === '1') {
                thumbsgallery = el.closest('.swiper-element').querySelector('[data-gallery^="gallery_swiper_"]');
            }
            const swiperEl = new SwiperState(el, thumbsgallery);
        });
    }

});