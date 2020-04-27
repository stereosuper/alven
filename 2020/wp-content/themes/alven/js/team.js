(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["team"],{

/***/ "./wp-content/themes/alven/src/js/components/team.js":
/*!***********************************************************!*\
  !*** ./wp-content/themes/alven/src/js/components/team.js ***!
  \***********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
const team = () => {
    const team = document.getElementById('team');

    if (!team) return;

    const members = team.querySelectorAll('.team-member');
    const nbMembers = members.length;
    const desc = document.createElement('div');
    let index;

    desc.className = 'container wrapper-desc';

    members.forEach(member => {
        member.addEventListener(
            'click',
            () => {
                index = (Math.floor([].indexOf.call(members, member) / 5) + 1) * 5 - 1;
                index = index > nbMembers ? nbMembers - 1 : index;

                desc.innerHTML = '';
                desc.appendChild(member.parentElement.querySelector('.team-desc').cloneNode(true));

                members[index].parentElement.after(desc);
            },
            false
        );
    });
};

/* harmony default export */ __webpack_exports__["default"] = (team);


/***/ })

}]);
//# sourceMappingURL=team.js.map?72964792417394db97e14569b0fb2e9e