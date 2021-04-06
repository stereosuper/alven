(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["videos"],{

/***/ "./wp-content/themes/alven/src/js/components/videos.js":
/*!*************************************************************!*\
  !*** ./wp-content/themes/alven/src/js/components/videos.js ***!
  \*************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var gsap__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! gsap */ "./node_modules/gsap/index.js");
/* harmony import */ var _vimeo__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./vimeo */ "./wp-content/themes/alven/src/js/components/vimeo.js");
/* harmony import */ var _stereorepo_sac__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @stereorepo/sac */ "./node_modules/@stereorepo/sac/src/index.js");




const videos = () => {
    const wrapper = document.getElementById('videos');
    const slider = document.getElementById('videos-slider');

    if (!wrapper || !slider) return;

    let slides = slider.querySelectorAll('.slide-video');
    let slideW = slides[0].offsetWidth;
    const lastSlideIndex = slides.length - 1;
    const lastSlide = slides[lastSlideIndex];

    const sliderText = wrapper.querySelector('#video-text');
    const nexts = wrapper.querySelectorAll('.js-video-next');
    const prevs = wrapper.querySelectorAll('.js-video-prev');
    const btns = wrapper.querySelectorAll('.js-video-nav');

    // center slider
    const setInitialPos = () => {
        const wWidth = window.innerWidth;
        let ratio = 0.5;

        if (wWidth < 768) {
            ratio = 1;
        } else if (wWidth < 1264) {
            ratio = 0.825;
        }

        gsap__WEBPACK_IMPORTED_MODULE_0__["gsap"].set(slider, { left: -slideW * ratio, opacity: 1 });
    };

    // update text
    const updateText = () =>
        gsap__WEBPACK_IMPORTED_MODULE_0__["gsap"].to(sliderText, 0.3, {
            opacity: 0,
            y: 20,
            onComplete: () => {
                sliderText.innerHTML = '';
                sliderText.appendChild(slider.querySelector('.on').querySelector('.js-video-text').cloneNode(true));
                gsap__WEBPACK_IMPORTED_MODULE_0__["gsap"].to(sliderText, 0.3, { opacity: 1, y: 0 });
            }
        });

    // set active slide
    const setActiveSlide = newSlide => {
        // set active slide
        slides[1].classList.remove('on');
        slides[newSlide].classList.add('on');

        // set player
        _vimeo__WEBPACK_IMPORTED_MODULE_1__["default"].addPlayer(slides[newSlide].querySelector('.js-vimeo'));

        // set active nav btn
        Object(_stereorepo_sac__WEBPACK_IMPORTED_MODULE_2__["forEach"])(btns, btn => btn.classList.remove('on'));
        wrapper.querySelector('[data-slide="' + (slides[newSlide].dataset.index | 0) + '"]').classList.add('on');
    };

    // slide next
    const slideNext = noTransition => {
        if (gsap__WEBPACK_IMPORTED_MODULE_0__["gsap"].isTweening(slider)) return;

        const dur = noTransition === true ? 0 : 0.3;

        slides = slider.querySelectorAll('.slide-video');

        // clone first slide and add it at the end
        slider.appendChild(slides[0].cloneNode(true));

        // set active slide
        setActiveSlide(2);

        // slide
        gsap__WEBPACK_IMPORTED_MODULE_0__["gsap"].to(slider, dur, {
            x: -slideW,
            // once slider has slided, remove first slide and put slider at the right place
            onComplete: () => {
                slider.removeChild(slides[0]);
                gsap__WEBPACK_IMPORTED_MODULE_0__["gsap"].set(slider, { x: 0 });
            }
        });

        if (noTransition !== true) updateText();
    };

    // slide prev
    const slidePrev = () => {
        if (gsap__WEBPACK_IMPORTED_MODULE_0__["gsap"].isTweening(slider)) return;

        slides = slider.querySelectorAll('.slide-video');

        // clone last slide, add it at the beginning and put slider at the right place
        slider.insertBefore(slides[lastSlideIndex].cloneNode(true), slides[0]);
        gsap__WEBPACK_IMPORTED_MODULE_0__["gsap"].set(slider, { x: -slideW });

        // set active slide
        setActiveSlide(0);

        // slide
        gsap__WEBPACK_IMPORTED_MODULE_0__["gsap"].to(slider, 0.3, {
            x: 0,
            // once slider has slided, remove last slide
            onComplete: () => slider.removeChild(slides[lastSlideIndex])
        });

        updateText();
    };

    // slide
    const slide = slide => {
        if (gsap__WEBPACK_IMPORTED_MODULE_0__["gsap"].isTweening(slider)) return;

        const nbSlide = slide | 0;

        slides = slider.querySelectorAll('.slide-video');

        // get index of the next slide to display
        const nextSlide = [].slice.call(slides).indexOf(slider.querySelector('[data-index="' + nbSlide + '"]'));
        // get index of the current active slide
        const currentSlide = [].slice.call(slides).indexOf(slider.querySelector('.on'));
        // get the difference between those indexes to know how many times to slide next
        const nbSlidesToMove = nextSlide === 0 ? slides.length - currentSlide : nextSlide - currentSlide;

        let i = 0;
        for (i; i < nbSlidesToMove; i++) {
            slideNext(i < nbSlidesToMove - 1);
        }
    };

    // center slider and then make it appear
    slider.insertBefore(lastSlide.cloneNode(true), slides[0]);
    slider.removeChild(lastSlide);
    btns[0].classList.add('on');
    setInitialPos();
    updateText();

    // add events
    Object(_stereorepo_sac__WEBPACK_IMPORTED_MODULE_2__["forEach"])(nexts, next => next.addEventListener('click', slideNext, false));
    Object(_stereorepo_sac__WEBPACK_IMPORTED_MODULE_2__["forEach"])(prevs, prev => prev.addEventListener('click', slidePrev, false));
    Object(_stereorepo_sac__WEBPACK_IMPORTED_MODULE_2__["forEach"])(btns, btn => btn.addEventListener('click', () => slide(btn.dataset.slide), false));

    // resize
    window.$stereorepo.superWindow.initializeWindow();
    window.$stereorepo.superWindow.addResizeFunction(() => {
        slides = slider.querySelectorAll('.slide-video');
        slideW = slides[0].offsetWidth;
        setInitialPos();
    });
};

/* harmony default export */ __webpack_exports__["default"] = (videos);


/***/ })

}]);
//# sourceMappingURL=videos.js.map?603565718c2493a5aaa6f3e6e64b1859