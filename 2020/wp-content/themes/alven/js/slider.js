(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["slider"],{

/***/ "./wp-content/themes/alven/src/js/components/slider.js":
/*!*************************************************************!*\
  !*** ./wp-content/themes/alven/src/js/components/slider.js ***!
  \*************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var gsap__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! gsap */ "./node_modules/gsap/index.js");
/* harmony import */ var hammerjs__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! hammerjs */ "./node_modules/hammerjs/hammer.js");
/* harmony import */ var hammerjs__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(hammerjs__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _stereorepo_sac__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @stereorepo/sac */ "./node_modules/@stereorepo/sac/src/index.js");




const slider = () => {
    const slider = document.getElementById('slider');
    const nav = document.getElementById('slider-nav');

    if (!slider || !nav) return;

    const slides = slider.querySelectorAll('.slide');
    const btns = nav.querySelectorAll('button');
    let index = 0;
    let nextBtn;
    let slideNextCall;
    const mc = new Hammer(slider);

    const slide = btn => {
        slideNextCall.kill();

        Object(_stereorepo_sac__WEBPACK_IMPORTED_MODULE_2__["forEach"])(slides, slide => {
            slide.classList.remove('on');
        });
        slider.querySelector('[data-startup="' + btn.dataset.slide + '"').classList.add('on');

        Object(_stereorepo_sac__WEBPACK_IMPORTED_MODULE_2__["forEach"])(btns, elt => {
            elt.classList.remove('on');
        });
        btn.classList.add('on');
        btn.blur();

        slideNextCall = gsap__WEBPACK_IMPORTED_MODULE_0__["gsap"].delayedCall(5, slideNext);
    };

    const slideNext = () => {
        index = [].indexOf.call(btns, nav.querySelector('.on'));
        nextBtn = btns[index + 1] ? btns[index + 1] : btns[0];
        slide(nextBtn);
    };

    const slidePrev = () => {
        index = [].indexOf.call(btns, nav.querySelector('.on'));
        nextBtn = btns[index - 1] ? btns[index - 1] : btns[btns.length - 1];
        slide(nextBtn);
    };

    slideNextCall = gsap__WEBPACK_IMPORTED_MODULE_0__["gsap"].delayedCall(5, slideNext);

    Object(_stereorepo_sac__WEBPACK_IMPORTED_MODULE_2__["forEach"])(btns, btn => {
        btn.addEventListener(
            'click',
            () => {
                slide(btn);
            },
            false
        );
    });

    mc.on('swipeleft', () => {
        slideNextCall.kill();
        slideNext();
    });

    mc.on('swiperight', () => {
        slideNextCall.kill();
        slidePrev();
    });
};

/* harmony default export */ __webpack_exports__["default"] = (slider);


/***/ })

}]);
//# sourceMappingURL=slider.js.map?1a17adf49d292f2f45f573ce35c26f62