(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["history"],{

/***/ "./wp-content/themes/alven/src/js/components/history.js":
/*!**************************************************************!*\
  !*** ./wp-content/themes/alven/src/js/components/history.js ***!
  \**************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
const history = () => {
    const history = document.getElementById('history');
    const filters = document.getElementById('periods');

    if (!history || !filters) return;

    const btns = filters.querySelectorAll('button');

    const filter = btn => {
        if (btn.classList.contains('on')) {
            history.querySelectorAll('.dates').forEach(list => {
                list.classList.remove('off');
            });

            btn.classList.remove('on');

            return;
        }

        history.querySelectorAll('.dates').forEach(list => {
            list.dataset.period === btn.dataset.field ? list.classList.remove('off') : list.classList.add('off');
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

/* harmony default export */ __webpack_exports__["default"] = (history);


/***/ })

}]);
//# sourceMappingURL=history.js.map?4320f70a53e97d931f906a466657279b