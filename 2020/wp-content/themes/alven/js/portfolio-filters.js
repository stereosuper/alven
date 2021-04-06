(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["portfolio-filters"],{

/***/ "./wp-content/themes/alven/src/js/components/portfolio-filters.js":
/*!************************************************************************!*\
  !*** ./wp-content/themes/alven/src/js/components/portfolio-filters.js ***!
  \************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _stereorepo_sac__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @stereorepo/sac */ "./node_modules/@stereorepo/sac/src/index.js");
/* harmony import */ var gsap__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! gsap */ "./node_modules/gsap/index.js");
/* harmony import */ var gsap_ScrollToPlugin_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! gsap/ScrollToPlugin.js */ "./node_modules/gsap/ScrollToPlugin.js");





gsap__WEBPACK_IMPORTED_MODULE_1__["gsap"].registerPlugin(gsap_ScrollToPlugin_js__WEBPACK_IMPORTED_MODULE_2__["ScrollToPlugin"]);

const portfolio = () => {
    const portfolio = document.getElementById('portfolio');
    const filters = document.getElementById('portfolio-filters');

    if (!portfolio || !filters) return;

    const btns = filters.querySelectorAll('.btn-filter');
    const links = portfolio.querySelectorAll('li');
    const types = ['investment', 'location', 'field', 'subfield'];
    let filterNames = [];

    // responsive variables
    let filtersWrapper;
    const btnsFilters = filters.querySelectorAll('.js-open-filters');
    const closeFilters = filters.querySelectorAll('.js-close-filters');

    const sortPortfolio = () => {
        Object(_stereorepo_sac__WEBPACK_IMPORTED_MODULE_0__["forEach"])(links, link => {
            Object(_stereorepo_sac__WEBPACK_IMPORTED_MODULE_0__["forEach"])(filterNames, filter => {
                if (!link.dataset[filter.name].split(',').includes(filter.filter)) link.classList.add('off');
            });
        });
    };

    const addFilter = btn => {
        filterNames.push({ name: btn.dataset.filter, filter: btn.dataset[btn.dataset.filter] });
        sortPortfolio();
    };

    const removeFilter = btn => {
        filterNames = filterNames.filter(x => x.filter !== btn.dataset[btn.dataset.filter]);
        Object(_stereorepo_sac__WEBPACK_IMPORTED_MODULE_0__["forEach"])(links, link => {
            if (!link.dataset[btn.dataset.filter].split(',').includes(btn.dataset[btn.dataset.filter]))
                link.classList.remove('off');
        });

        sortPortfolio();

        btn.classList.remove('on');
        btn.blur();
    };

    const handleUniqueFilter = (btn, cat) => {
        if (btn.dataset.filter !== cat) return;

        Object(_stereorepo_sac__WEBPACK_IMPORTED_MODULE_0__["forEach"])(btns, link => {
            if (
                (cat === 'field' && link.dataset.filter === 'subfield') ||
                (cat === 'subfield' && link.dataset.filter === 'field' && btn.dataset.parent !== link.dataset.field)
            ) {
                removeFilter(link);
            }

            if (!link.dataset[cat]) return;

            if (link.dataset[cat] !== btn.dataset[btn.dataset.filter] && link.classList.contains('on')) {
                removeFilter(link);
            }
        });
    };

    const handleFilter = btn => {
        if (btn.classList.contains('on')) {
            removeFilter(btn);
            return;
        }

        addFilter(btn);
        btn.classList.add('on');

        Object(_stereorepo_sac__WEBPACK_IMPORTED_MODULE_0__["forEach"])(types, type => {
            handleUniqueFilter(btn, type);
        });

        gsap__WEBPACK_IMPORTED_MODULE_1__["gsap"].to(window, { duration: 0.5, scrollTo: { y: '#startup', offsetY: 70 } });
    };

    Object(_stereorepo_sac__WEBPACK_IMPORTED_MODULE_0__["forEach"])(btns, btn => {
        if (btn.classList.contains('on')) {
            addFilter(btn);
        }

        btn.addEventListener(
            'click',
            () => {
                handleFilter(btn);
            },
            false
        );
    });

    // responsive
    Object(_stereorepo_sac__WEBPACK_IMPORTED_MODULE_0__["forEach"])(btnsFilters, btn => {
        btn.addEventListener(
            'click',
            () => {
                filtersWrapper = document.getElementById(btn.dataset.type);
                gsap__WEBPACK_IMPORTED_MODULE_1__["gsap"].fromTo(filtersWrapper, 0.2, { display: 'block' }, { opacity: 1, y: 0 });
                gsap__WEBPACK_IMPORTED_MODULE_1__["gsap"].fromTo(filtersWrapper.querySelector('.filters-inner'), 0.25, { y: 50 }, { y: 0, delay: 0.05 });
                document.getElementsByTagName('html')[0].classList.add('no-scroll');
            },
            false
        );
    });

    Object(_stereorepo_sac__WEBPACK_IMPORTED_MODULE_0__["forEach"])(closeFilters, btn => {
        btn.addEventListener(
            'click',
            () => {
                gsap__WEBPACK_IMPORTED_MODULE_1__["gsap"].to(filtersWrapper.querySelector('.filters-inner'), 0.2, { y: 50 });
                gsap__WEBPACK_IMPORTED_MODULE_1__["gsap"].to(filtersWrapper, 0.2, {
                    opacity: 0,
                    delay: 0.1,
                    onComplete: () => {
                        gsap__WEBPACK_IMPORTED_MODULE_1__["gsap"].set(filtersWrapper, { display: 'none' });
                    }
                });
                document.getElementsByTagName('html')[0].classList.remove('no-scroll');
                gsap__WEBPACK_IMPORTED_MODULE_1__["gsap"].set(window, { scrollTo: '#portfolio-filters' });
            },
            false
        );
    });
};

/* harmony default export */ __webpack_exports__["default"] = (portfolio);


/***/ })

}]);
//# sourceMappingURL=portfolio-filters.js.map?73653666e963d584d81592178311a215