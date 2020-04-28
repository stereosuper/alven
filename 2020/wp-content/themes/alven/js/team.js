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
    let index = 0;
    let indexPos = 0;
    let parent;
    let next;
    let prev;

    const closeDetail = member => {
        members.forEach(elt => {
            elt.classList.remove('off');
        });
        member.classList.remove('on');
    };

    const displayDetail = member => {
        member.blur();
        desc.innerHTML = '';

        if (member.classList.contains('on')) {
            closeDetail(member);
            return;
        }

        members.forEach(elt => {
            elt.classList.add('off');
        });
        member.classList.remove('off');
        member.classList.add('on');

        parent = member.parentElement;

        desc.appendChild(parent.querySelector('.name').cloneNode(true));
        desc.appendChild(parent.querySelector('.function').cloneNode(true));
        desc.appendChild(parent.querySelector('.team-desc').cloneNode(true));

        index = [].indexOf.call(members, member);
        indexPos = (Math.floor(index / 5) + 1) * 5 - 1;
        indexPos = indexPos > nbMembers ? nbMembers - 1 : indexPos;

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
    };

    desc.className = 'container wrapper-desc';

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
//# sourceMappingURL=team.js.map?cdd6e0779590b4bf7234dc9d73502c82