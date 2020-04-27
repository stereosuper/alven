(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["portfolio"],{

/***/ "./wp-content/themes/alven/src/js/components/portfolio.js":
/*!****************************************************************!*\
  !*** ./wp-content/themes/alven/src/js/components/portfolio.js ***!
  \****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
const portfolio = () => {
    const portfolio = document.getElementById('portfolio');
    const filters = document.getElementById('portfolio-filters');

    if (!portfolio || !filters) return;

    const btns = filters.querySelectorAll('button');
    let filterName = '';

    btns.forEach(btn => {
        btn.addEventListener(
            'click',
            () => {
                filterName = btn.dataset.filter;

                portfolio.querySelectorAll('li').forEach(link => {
                    link.dataset[filterName].split(',').includes(btn.dataset[filterName])
                        ? link.classList.remove('off')
                        : link.classList.add('off');
                });

                btns.forEach(elt => {
                    elt.classList.remove('on');
                });
                btn.classList.add('on');
            },
            false
        );
    });
};

/* harmony default export */ __webpack_exports__["default"] = (portfolio);


/***/ })

}]);
//# sourceMappingURL=portfolio.js.map?c5a995b6f05120342d19d188a95b7ee3