(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["vimeo"],{

/***/ "./wp-content/themes/alven/src/js/components/vimeo.js":
/*!************************************************************!*\
  !*** ./wp-content/themes/alven/src/js/components/vimeo.js ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _vimeo_player__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @vimeo/player */ "./node_modules/@vimeo/player/dist/player.es.js");
/* harmony import */ var _stereorepo_sac__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @stereorepo/sac */ "./node_modules/@stereorepo/sac/src/index.js");



const vimeo = () => {
    const videos = document.querySelectorAll('.js-vimeo');

    if (!videos.length) return;

    let players = [];

    Object(_stereorepo_sac__WEBPACK_IMPORTED_MODULE_1__["forEach"])(videos, (video, i) => {
        players[i] = new _vimeo_player__WEBPACK_IMPORTED_MODULE_0__["default"](video);
        players[i].on('play', function () {
            console.log('played the handstick video!');
        });
    });
};

/* harmony default export */ __webpack_exports__["default"] = (vimeo);


/***/ })

}]);
//# sourceMappingURL=vimeo.js.map?8b9fa7152a62a39d62df25777b9dc34c