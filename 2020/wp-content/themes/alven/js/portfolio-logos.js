(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["portfolio-logos"],{

/***/ "./wp-content/themes/alven/src/js/components/portfolio-logos.js":
/*!**********************************************************************!*\
  !*** ./wp-content/themes/alven/src/js/components/portfolio-logos.js ***!
  \**********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var gsap__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! gsap */ "./node_modules/gsap/index.js");
/* harmony import */ var gsap_ScrollToPlugin_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! gsap/ScrollToPlugin.js */ "./node_modules/gsap/ScrollToPlugin.js");
/* harmony import */ var _stereorepo_sac__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @stereorepo/sac */ "./node_modules/@stereorepo/sac/src/index.js");



gsap__WEBPACK_IMPORTED_MODULE_0__["gsap"].registerPlugin(gsap_ScrollToPlugin_js__WEBPACK_IMPORTED_MODULE_1__["ScrollToPlugin"]);



const logos = () => {
    const listLogos = document.getElementById('logos');

    if (!listLogos) return;

    let logos = listLogos.querySelectorAll('li');
    let nbDisplayedLogos = 11;

    if (logos.length <= nbDisplayedLogos) return;

    const oLogos = listLogos.innerHTML;
    let changeCall;
    let indexes = [];
    let hidedLogos = [];
    let indexLogoToChange = 0;
    let logoToChange;
    let count = 0;
    let wWidth = 0;

    const shuffle = array => {
        array.sort(() => Math.random() - 0.5);
    };

    const changeLogo = () => {
        changeCall.kill();

        logoToChange = logos[indexes[indexLogoToChange]];

        hidedLogos.push(logoToChange.innerHTML);

        gsap__WEBPACK_IMPORTED_MODULE_0__["gsap"].to(logoToChange, 0.3, {
            opacity: 0,
            onComplete: () => {
                logoToChange.innerHTML = hidedLogos[0];
                hidedLogos.splice(0, 1);

                gsap__WEBPACK_IMPORTED_MODULE_0__["gsap"].to(logoToChange, 0.5, {
                    opacity: 1,
                    onComplete: () => {
                        indexLogoToChange = indexLogoToChange + 1 > nbDisplayedLogos - 1 ? 0 : indexLogoToChange + 1;
                        changeCall = gsap__WEBPACK_IMPORTED_MODULE_0__["gsap"].delayedCall(0.5, changeLogo);
                    }
                });
            }
        });
    };

    const setLogos = () => {
        Object(_stereorepo_sac__WEBPACK_IMPORTED_MODULE_2__["forEach"])(logos, (logo, i) => {
            if (i < nbDisplayedLogos) {
                logo.classList.add('on');
                indexes[i] = i;
            } else {
                logo.classList.remove('on');
                hidedLogos[count] = logo.innerHTML;
                count++;
            }
        });

        shuffle(indexes);

        changeCall = gsap__WEBPACK_IMPORTED_MODULE_0__["gsap"].delayedCall(1, changeLogo);
    };

    const reset = () => {
        listLogos.innerHTML = oLogos;
        logos = listLogos.querySelectorAll('li');

        indexes = [];
        hidedLogos = [];
        indexLogoToChange = 0;
        count = 0;

        if (changeCall) {
            changeCall.kill();
        }
    };

    const launch = () => {
        wWidth = window.$stereorepo.superWindow.windowWidth;

        if (wWidth >= 1264) {
            nbDisplayedLogos = 11;
        } else if (wWidth >= 960) {
            nbDisplayedLogos = 9;
        } else if (wWidth >= 768) {
            nbDisplayedLogos = 7;
        } else if (wWidth >= 580) {
            nbDisplayedLogos = 5;
        } else {
            nbDisplayedLogos = 4;
        }

        setLogos();
    };

    const resize = () => {
        reset();
        launch();
    };

    window.$stereorepo.superWindow.initializeWindow();
    window.$stereorepo.superWindow.addResizeFunction(resize);

    launch();
};

/* harmony default export */ __webpack_exports__["default"] = (logos);


/***/ })

}]);
//# sourceMappingURL=portfolio-logos.js.map?775dae4d797450fd6a34e42884555cd6