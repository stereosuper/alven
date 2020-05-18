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
