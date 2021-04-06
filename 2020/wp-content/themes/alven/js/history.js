(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["history"],{

/***/ "./wp-content/themes/alven/src/js/components/history.js":
/*!**************************************************************!*\
  !*** ./wp-content/themes/alven/src/js/components/history.js ***!
  \**************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _stereorepo_sac__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @stereorepo/sac */ "./node_modules/@stereorepo/sac/src/index.js");


const history = () => {
    const history = document.getElementById('history');
    const filters = document.getElementById('periods');

    if (!history || !filters) return;

    const btns = filters.querySelectorAll('button');

    const filter = btn => {
        if (btn.classList.contains('on')) {
            Object(_stereorepo_sac__WEBPACK_IMPORTED_MODULE_0__["forEach"])(history.querySelectorAll('.dates'), list => {
                list.classList.remove('off');
            });

            btn.classList.remove('on');

            return;
        }

        Object(_stereorepo_sac__WEBPACK_IMPORTED_MODULE_0__["forEach"])(history.querySelectorAll('.dates'), list => {
            list.dataset.period === btn.dataset.field ? list.classList.remove('off') : list.classList.add('off');
        });

        Object(_stereorepo_sac__WEBPACK_IMPORTED_MODULE_0__["forEach"])(btns, elt => {
            elt.classList.remove('on');
        });
        btn.classList.add('on');
    };

    Object(_stereorepo_sac__WEBPACK_IMPORTED_MODULE_0__["forEach"])(btns, btn => {
        btn.addEventListener(
            'click',
            () => {
                filter(btn);
            },
            false
        );
    });
};

/* harmony default export */ __webpack_exports__["default"] = (history);


/***/ })

}]);
//# sourceMappingURL=history.js.map?164cb12db00f6dec9437678761dfdd41