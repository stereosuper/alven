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
/* harmony import */ var gsap_ScrollToPlugin_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! gsap/ScrollToPlugin.js */ "./node_modules/gsap/ScrollToPlugin.js");



gsap__WEBPACK_IMPORTED_MODULE_0__["gsap"].registerPlugin(gsap_ScrollToPlugin_js__WEBPACK_IMPORTED_MODULE_1__["ScrollToPlugin"]);

const slider = () => {
    const slider = document.getElementById('slider');
    const nav = document.getElementById('slider-nav');

    if (!slider || !nav) return;

    const slides = slider.querySelectorAll('.slide');
    const btns = nav.querySelectorAll('button');
    let index = 0;
    let nextBtn;
    let slideAutoCall;

    const slide = btn => {
        slideAutoCall.kill();

        slides.forEach(slide => {
            slide.classList.remove('on');
        });
        slider.querySelector('[data-startup="' + btn.dataset.slide + '"').classList.add('on');

        btns.forEach(elt => {
            elt.classList.remove('on');
        });
        btn.classList.add('on');
        btn.blur();

        slideAutoCall = gsap__WEBPACK_IMPORTED_MODULE_0__["gsap"].delayedCall(5, slideAuto);
    };

    const slideAuto = () => {
        index = [].indexOf.call(btns, nav.querySelector('.on'));
        nextBtn = btns[index + 1] ? btns[index + 1] : btns[0];
        slide(nextBtn);
    };

    slideAutoCall = gsap__WEBPACK_IMPORTED_MODULE_0__["gsap"].delayedCall(5, slideAuto);

    btns.forEach(btn => {
        btn.addEventListener(
            'click',
            () => {
                slide(btn);
            },
            false
        );
    });
};

/* harmony default export */ __webpack_exports__["default"] = (slider);


/***/ })

}]);
//# sourceMappingURL=slider.js.map?1b7dfe94fd3ec6b02e7fd78fb3175c50