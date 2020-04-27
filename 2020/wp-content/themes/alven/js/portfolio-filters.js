(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["portfolio-filters"],{

/***/ "./wp-content/themes/alven/src/js/components/portfolio-filters.js":
/*!************************************************************************!*\
  !*** ./wp-content/themes/alven/src/js/components/portfolio-filters.js ***!
  \************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
const portfolio = () => {
    const portfolio = document.getElementById('portfolio');
    const filters = document.getElementById('portfolio-filters');

    if (!portfolio || !filters) return;

    const btns = filters.querySelectorAll('.btn-filter');
    const links = portfolio.querySelectorAll('li');
    let filterName = '';

    const filter = btn => {
        filterName = btn.dataset.filter;

        links.forEach(link => {
            link.dataset[filterName].split(',').includes(btn.dataset[filterName])
                ? link.classList.remove('off')
                : link.classList.add('off');
        });

        btns.forEach(elt => {
            elt.classList.remove('on');
        });
        btn.classList.add('on');
    };

    btns.forEach(btn => {
        btn.addEventListener(
            'click',
            () => {
                filter(btn);
            },
            false
        );
    });
};

/* harmony default export */ __webpack_exports__["default"] = (portfolio);


/***/ })

}]);
//# sourceMappingURL=portfolio-filters.js.map?78bf40d028aba85523fea6f865455a88