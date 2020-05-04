(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["team"],{

/***/ "./wp-content/themes/alven/src/js/components/team.js":
/*!***********************************************************!*\
  !*** ./wp-content/themes/alven/src/js/components/team.js ***!
  \***********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var gsap__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! gsap */ "./node_modules/gsap/index.js");
/* harmony import */ var gsap_ScrollToPlugin_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! gsap/ScrollToPlugin.js */ "./node_modules/gsap/ScrollToPlugin.js");



gsap__WEBPACK_IMPORTED_MODULE_0__["gsap"].registerPlugin(gsap_ScrollToPlugin_js__WEBPACK_IMPORTED_MODULE_1__["ScrollToPlugin"]);

const team = () => {
    const team = document.getElementById('team');

    if (!team) return;

    const members = team.querySelectorAll('.team-member');
    const nbMembers = members.length;
    const desc = document.createElement('div');
    let wWidth = 0;
    let row = 5;
    let index = 0;
    let indexPos = 0;
    let parent;
    let next;
    let prev;

    const closeDetail = member => {
        members.forEach(elt => {
            elt.classList.remove('off');
            elt.classList.remove('on');
        });
    };

    const displayDetail = member => {
        if (gsap__WEBPACK_IMPORTED_MODULE_0__["gsap"].isTweening('#desc')) return;

        gsap__WEBPACK_IMPORTED_MODULE_0__["gsap"].to(desc, 0.3, {
            opacity: 0,
            onComplete: () => {
                member.blur();
                desc.innerHTML = '';

                if (member.classList.contains('on')) {
                    closeDetail(member);
                    return;
                }

                members.forEach(elt => {
                    elt.classList.add('off');
                    elt.classList.remove('on');
                });
                member.classList.remove('off');
                member.classList.add('on');

                parent = member.parentElement;

                desc.appendChild(parent.querySelector('.name').cloneNode(true));
                desc.appendChild(parent.querySelector('.function').cloneNode(true));
                desc.appendChild(parent.querySelector('.team-desc').cloneNode(true));

                index = [].indexOf.call(members, member);
                indexPos = (Math.floor(index / row) + 1) * row - 1;
                indexPos = indexPos >= nbMembers ? nbMembers - 1 : indexPos;

                members[indexPos].parentElement.after(desc);

                desc.querySelector('.next').addEventListener(
                    'click',
                    () => {
                        next = members[index + 1] ? members[index + 1] : members[0];
                        displayDetail(next);
                    },
                    false
                );

                desc.querySelector('.prev').addEventListener(
                    'click',
                    () => {
                        prev = members[index - 1] ? members[index - 1] : members[nbMembers - 1];
                        displayDetail(prev);
                    },
                    false
                );

                gsap__WEBPACK_IMPORTED_MODULE_0__["gsap"].to(window, { duration: 0.8, scrollTo: '#desc' });
                gsap__WEBPACK_IMPORTED_MODULE_0__["gsap"].to(desc, 0.3, { opacity: 1 });
            }
        });
    };

    const resize = () => {
        wWidth = window.$stereorepo.superWindow.windowWidth;
        if (wWidth >= 960) {
            row = 5;
        } else if (wWidth >= 580) {
            row = 3;
        } else {
            row = 2;
        }
    };

    window.$stereorepo.superWindow.initializeWindow();
    window.$stereorepo.superWindow.addResizeFunction(resize);
    resize();

    desc.className = 'container wrapper-desc';
    desc.id = 'desc';

    members.forEach(member => {
        member.addEventListener(
            'click',
            () => {
                displayDetail(member);
            },
            false
        );
    });
};

/* harmony default export */ __webpack_exports__["default"] = (team);


/***/ })

}]);
//# sourceMappingURL=team.js.map?ecff01be995f770020bef1d4f98fcd48