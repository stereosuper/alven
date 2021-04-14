(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["popin"],{

/***/ "./wp-content/themes/alven/src/js/components/popin.js":
/*!************************************************************!*\
  !*** ./wp-content/themes/alven/src/js/components/popin.js ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _vimeo_player__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @vimeo/player */ "./node_modules/@vimeo/player/dist/player.es.js");
/* harmony import */ var _stereorepo_sac__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @stereorepo/sac */ "./node_modules/@stereorepo/sac/src/index.js");



const vimeo = {
    addPlayer(video) {
        const iframe = video.querySelector('iframe');
        const player = iframe ? new _vimeo_player__WEBPACK_IMPORTED_MODULE_0__["default"](iframe) : new _vimeo_player__WEBPACK_IMPORTED_MODULE_0__["default"](video);

        player.ready().then(() => {
            video.querySelector('.js-cover').addEventListener(
                'click',
                e => {
                    e.target.classList.add('off');
                    player.play();
                },
                false
            );
        });
    },

    initPlayers() {
        const videos = document.querySelectorAll('.js-vimeo');

        if (videos.length) Object(_stereorepo_sac__WEBPACK_IMPORTED_MODULE_1__["forEach"])(videos, video => this.addPlayer(video));
    }
};

/* harmony default export */ __webpack_exports__["default"] = (vimeo);


/***/ })

}]);
//# sourceMappingURL=popin.js.map?fe06d5aa393187d6744169a2876c8a49