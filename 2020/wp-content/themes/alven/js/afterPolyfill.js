(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["afterPolyfill"],{

/***/ "./wp-content/themes/alven/src/js/components/afterPolyfill.js":
/*!********************************************************************!*\
  !*** ./wp-content/themes/alven/src/js/components/afterPolyfill.js ***!
  \********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function (x) {
    var o = x.prototype;
    o.after ||
        (o.after = function () {
            var e,
                m = arguments,
                l = m.length,
                i = 0,
                t = this,
                p = t.parentNode,
                n = Node,
                s = String,
                d = document;
            if (p !== null) {
                while (i < l) {
                    (e = m[i]) instanceof n
                        ? (t = t.nextSibling) !== null
                            ? p.insertBefore(e, t)
                            : p.appendChild(e)
                        : p.appendChild(d.createTextNode(s(e)));
                    ++i;
                }
            }
        });
})(Element);


/***/ })

}]);
//# sourceMappingURL=afterPolyfill.js.map?744fb1cfb347d930303a81d0c229828d