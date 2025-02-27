/*
 * 2007-2023 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 *  @author PrestaShop SA <contact@prestashop.com>
 *  @copyright  2007-2023 PrestaShop SA
 *  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */
! function(t, e) { "object" == typeof exports && "undefined" != typeof module ? module.exports = e() : "function" == typeof define && define.amd ? define(e) : t.IMask = e() }(this, function() {
    "use strict";
    var t = function(t) { if (null == t) throw TypeError("Can't call method on  " + t); return t },
        e = {}.hasOwnProperty,
        u = function(t, u) { return e.call(t, u) },
        n = {}.toString,
        r = Object("z").propertyIsEnumerable(0) ? Object : function(t) { return "String" == function(t) { return n.call(t).slice(8, -1) }(t) ? t.split("") : Object(t) },
        i = function(e) { return r(t(e)) },
        s = Math.ceil,
        a = Math.floor,
        o = function(t) { return isNaN(t = +t) ? 0 : (t > 0 ? a : s)(t) },
        l = Math.min,
        h = function(t) { return t > 0 ? l(o(t), 9007199254740991) : 0 },
        c = Math.max,
        f = Math.min;

    function p(t, e) { return t(e = { exports: {} }, e.exports), e.exports }
    var d, v, g = p(function(t) { var e = t.exports = "undefined" != typeof window && window.Math == Math ? window : "undefined" != typeof self && self.Math == Math ? self : Function("return this")(); "number" == typeof __g && (__g = e) }),
        y = g["__core-js_shared__"] || (g["__core-js_shared__"] = {}),
        _ = 0,
        k = Math.random(),
        m = function(t) { return "Symbol(".concat(void 0 === t ? "" : t, ")_", (++_ + k).toString(36)) },
        A = y[d = "keys"] || (y[d] = {}),
        F = (v = !1, function(t, e, u) {
            var n, r = i(t),
                s = h(r.length),
                a = function(t, e) { return (t = o(t)) < 0 ? c(t + e, 0) : f(t, e) }(u, s);
            if (v && e != e) {
                for (; s > a;)
                    if ((n = r[a++]) != n) return !0
            } else
                for (; s > a; a++)
                    if ((v || a in r) && r[a] === e) return v || a || 0; return !v && -1
        }),
        D = function(t) { return A[t] || (A[t] = m(t)) }("IE_PROTO"),
        E = "constructor,hasOwnProperty,isPrototypeOf,propertyIsEnumerable,toLocaleString,toString,valueOf".split(","),
        C = Object.keys || function(t) {
            return function(t, e) {
                var n, r = i(t),
                    s = 0,
                    a = [];
                for (n in r) n != D && u(r, n) && a.push(n);
                for (; e.length > s;) u(r, n = e[s++]) && (~F(a, n) || a.push(n));
                return a
            }(t, E)
        },
        b = p(function(t) { var e = t.exports = { version: "2.5.5" }; "number" == typeof __e && (__e = e) }),
        B = (b.version, function(t) { return "object" == typeof t ? null !== t : "function" == typeof t }),
        P = function(t) { if (!B(t)) throw TypeError(t + " is not an object!"); return t },
        w = function(t) { try { return !!t() } catch (t) { return !0 } },
        S = !w(function() { return 7 != Object.defineProperty({}, "a", { get: function() { return 7 } }).a }),
        O = g.document,
        x = B(O) && B(O.createElement),
        T = !S && !w(function() { return 7 != Object.defineProperty((t = "div", x ? O.createElement(t) : {}), "a", { get: function() { return 7 } }).a; var t }),
        I = Object.defineProperty,
        M = {
            f: S ? Object.defineProperty : function(t, e, u) {
                if (P(t), e = function(t, e) { if (!B(t)) return t; var u, n; if (e && "function" == typeof(u = t.toString) && !B(n = u.call(t))) return n; if ("function" == typeof(u = t.valueOf) && !B(n = u.call(t))) return n; if (!e && "function" == typeof(u = t.toString) && !B(n = u.call(t))) return n; throw TypeError("Can't convert object to primitive value") }(e, !0), P(u), T) try { return I(t, e, u) } catch (t) {}
                if ("get" in u || "set" in u) throw TypeError("Accessors not supported!");
                return "value" in u && (t[e] = u.value), t
            }
        },
        j = S ? function(t, e, u) { return M.f(t, e, function(t, e) { return { enumerable: !(1 & t), configurable: !(2 & t), writable: !(4 & t), value: e } }(1, u)) } : function(t, e, u) { return t[e] = u, t },
        V = p(function(t) {
            var e = m("src"),
                n = Function.toString,
                r = ("" + n).split("toString");
            b.inspectSource = function(t) { return n.call(t) }, (t.exports = function(t, n, i, s) {
                var a = "function" == typeof i;
                a && (u(i, "name") || j(i, "name", n)), t[n] !== i && (a && (u(i, e) || j(i, e, t[n] ? "" + t[n] : r.join(String(n)))), t === g ? t[n] = i : s ? t[n] ? t[n] = i : j(t, n, i) : (delete t[n], j(t, n, i)))
            })(Function.prototype, "toString", function() { return "function" == typeof this && this[e] || n.call(this) })
        }),
        R = function(t, e, u) {
            if (function(t) { if ("function" != typeof t) throw TypeError(t + " is not a function!") }(t), void 0 === e) return t;
            switch (u) {
                case 1:
                    return function(u) { return t.call(e, u) };
                case 2:
                    return function(u, n) { return t.call(e, u, n) };
                case 3:
                    return function(u, n, r) { return t.call(e, u, n, r) }
            }
            return function() { return t.apply(e, arguments) }
        },
        H = function(t, e, u) {
            var n, r, i, s, a = t & H.F,
                o = t & H.G,
                l = t & H.S,
                h = t & H.P,
                c = t & H.B,
                f = o ? g : l ? g[e] || (g[e] = {}) : (g[e] || {}).prototype,
                p = o ? b : b[e] || (b[e] = {}),
                d = p.prototype || (p.prototype = {});
            for (n in o && (u = e), u) i = ((r = !a && f && void 0 !== f[n]) ? f : u)[n], s = c && r ? R(i, g) : h && "function" == typeof i ? R(Function.call, i) : i, f && V(f, n, i, t & H.U), p[n] != i && j(p, n, s), h && d[n] != i && (d[n] = i)
        };
    g.core = b, H.F = 1, H.G = 2, H.S = 4, H.P = 8, H.B = 16, H.W = 32, H.U = 64, H.R = 128;
    var N, L, U, Y, z = H;
    N = "keys", L = function() { return function(e) { return C(function(e) { return Object(t(e)) }(e)) } }, U = (b.Object || {})[N] || Object[N], (Y = {})[N] = L(U), z(z.S + z.F * w(function() { U(1) }), "Object", Y);
    b.Object.keys;
    var G = function(e) {
        var u = String(t(this)),
            n = "",
            r = o(e);
        if (r < 0 || r == 1 / 0) throw RangeError("Count can't be negative");
        for (; r > 0;
            (r >>>= 1) && (u += u)) 1 & r && (n += u);
        return n
    };
    z(z.P, "String", { repeat: G });
    b.String.repeat;
    var Z = function(e, u, n, r) {
            var i = String(t(e)),
                s = i.length,
                a = void 0 === n ? " " : String(n),
                o = h(u);
            if (o <= s || "" == a) return i;
            var l = o - s,
                c = G.call(a, Math.ceil(l / a.length));
            return c.length > l && (c = c.slice(0, l)), r ? c + i : i + c
        },
        W = g.navigator,
        $ = W && W.userAgent || "";
    z(z.P + z.F * /Version\/10\.\d+(\.\d+)? Safari\//.test($), "String", { padStart: function(t) { return Z(this, t, arguments.length > 1 ? arguments[1] : void 0, !0) } });
    b.String.padStart;
    z(z.P + z.F * /Version\/10\.\d+(\.\d+)? Safari\//.test($), "String", { padEnd: function(t) { return Z(this, t, arguments.length > 1 ? arguments[1] : void 0, !1) } });
    b.String.padEnd;
    var X = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(t) { return typeof t } : function(t) { return t && "function" == typeof Symbol && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : typeof t },
        q = function(t, e) { if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function") },
        J = function() {
            function t(t, e) {
                for (var u = 0; u < e.length; u++) {
                    var n = e[u];
                    n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(t, n.key, n)
                }
            }
            return function(e, u, n) { return u && t(e.prototype, u), n && t(e, n), e }
        }(),
        K = Object.assign || function(t) { for (var e = 1; e < arguments.length; e++) { var u = arguments[e]; for (var n in u) Object.prototype.hasOwnProperty.call(u, n) && (t[n] = u[n]) } return t },
        Q = function t(e, u, n) { null === e && (e = Function.prototype); var r = Object.getOwnPropertyDescriptor(e, u); if (void 0 === r) { var i = Object.getPrototypeOf(e); return null === i ? void 0 : t(i, u, n) } if ("value" in r) return r.value; var s = r.get; return void 0 !== s ? s.call(n) : void 0 },
        tt = function(t, e) {
            if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function, not " + typeof e);
            t.prototype = Object.create(e && e.prototype, { constructor: { value: t, enumerable: !1, writable: !0, configurable: !0 } }), e && (Object.setPrototypeOf ? Object.setPrototypeOf(t, e) : t.__proto__ = e)
        },
        et = function(t, e) { if (!t) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return !e || "object" != typeof e && "function" != typeof e ? t : e },
        ut = function t(e, u, n, r) {
            var i = Object.getOwnPropertyDescriptor(e, u);
            if (void 0 === i) {
                var s = Object.getPrototypeOf(e);
                null !== s && t(s, u, n, r)
            } else if ("value" in i && i.writable) i.value = n;
            else {
                var a = i.set;
                void 0 !== a && a.call(r, n)
            }
            return n
        },
        nt = function() {
            return function(t, e) {
                if (Array.isArray(t)) return t;
                if (Symbol.iterator in Object(t)) return function(t, e) {
                    var u = [],
                        n = !0,
                        r = !1,
                        i = void 0;
                    try { for (var s, a = t[Symbol.iterator](); !(n = (s = a.next()).done) && (u.push(s.value), !e || u.length !== e); n = !0); } catch (t) { r = !0, i = t } finally { try {!n && a.return && a.return() } finally { if (r) throw i } }
                    return u
                }(t, e);
                throw new TypeError("Invalid attempt to destructure non-iterable instance")
            }
        }(),
        rt = function(t) { if (Array.isArray(t)) { for (var e = 0, u = Array(t.length); e < t.length; e++) u[e] = t[e]; return u } return Array.from(t) };

    function it(t) { return "string" == typeof t || t instanceof String }

    function st(t, e) { var u = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : ""; return it(t) ? t : t ? e : u }
    var at = { NONE: 0, LEFT: -1, RIGHT: 1 };

    function ot(t, e) { return e === at.LEFT && --t, t }

    function lt(t) { return t.replace(/([.*+?^=!:${}()|[\]/\\])/g, "\\$1") }
    var ht = "undefined" != typeof window && window || "undefined" != typeof global && global.global === global && global || "undefined" != typeof self && self.self === self && self || {},
        ct = function() {
            function t(e, u, n, r) { for (q(this, t), this.value = e, this.cursorPos = u, this.oldValue = n, this.oldSelection = r; this.value.slice(0, this.startChangePos) !== this.oldValue.slice(0, this.startChangePos);) --this.oldSelection.start }
            return J(t, [{ key: "startChangePos", get: function() { return Math.min(this.cursorPos, this.oldSelection.start) } }, { key: "insertedCount", get: function() { return this.cursorPos - this.startChangePos } }, { key: "inserted", get: function() { return this.value.substr(this.startChangePos, this.insertedCount) } }, { key: "removedCount", get: function() { return Math.max(this.oldSelection.end - this.startChangePos || this.oldValue.length - this.value.length, 0) } }, { key: "removed", get: function() { return this.oldValue.substr(this.startChangePos, this.removedCount) } }, { key: "head", get: function() { return this.value.substring(0, this.startChangePos) } }, { key: "tail", get: function() { return this.value.substring(this.startChangePos + this.insertedCount) } }, { key: "removeDirection", get: function() { return !this.removedCount || this.insertedCount ? at.NONE : this.oldSelection.end === this.cursorPos || this.oldSelection.start === this.cursorPos ? at.RIGHT : at.LEFT } }]), t
        }(),
        ft = function() {
            function t(e) { q(this, t), K(this, { inserted: "", overflow: !1, shift: 0 }, e) }
            return J(t, [{ key: "aggregate", value: function(t) { return t.rawInserted && (this.rawInserted += t.rawInserted), this.inserted += t.inserted, this.shift += t.shift, this.overflow = this.overflow || t.overflow, this } }, { key: "offset", get: function() { return this.shift + this.inserted.length } }, { key: "rawInserted", get: function() { return null != this._rawInserted ? this._rawInserted : this.inserted }, set: function(t) { this._rawInserted = t } }]), t
        }(),
        pt = function() {
            function t(e) { q(this, t), this._value = "", this._update(e), this.isInitialized = !0 }
            return J(t, [{ key: "updateOptions", value: function(t) { this.withValueRefresh(this._update.bind(this, t)) } }, { key: "_update", value: function(t) { K(this, t) } }, { key: "clone", value: function() { var e = new t(this); return e._value = this.value.slice(), e } }, { key: "assign", value: function(t) { return K(this, t) } }, { key: "reset", value: function() { this._value = "" } }, { key: "resolve", value: function(t) { return this.reset(), this._append(t, { input: !0 }), this._appendTail(), this.doCommit(), this.value } }, { key: "nearestInputPos", value: function(t, e) { return t } }, {
                key: "extractInput",
                value: function() {
                    var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : 0,
                        e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : this.value.length;
                    return this.value.slice(t, e)
                }
            }, {
                key: "_extractTail",
                value: function() {
                    var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : 0,
                        e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : this.value.length;
                    return { value: this.extractInput(t, e), fromPos: t, toPos: e }
                }
            }, { key: "_appendTail", value: function(t) { return this._append(t ? t.value : "", { tail: !0 }) } }, {
                key: "_append",
                value: function(t) {
                    var e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {},
                        u = this.value.length,
                        n = this.clone(),
                        r = !1;
                    t = this.doPrepare(t, e);
                    for (var i = 0; i < t.length; ++i) {
                        if (this._value += t[i], !1 === this.doValidate(e) && (this.assign(n), !e.input)) { r = !0; break }
                        n = this.clone()
                    }
                    return new ft({ inserted: this.value.slice(u), overflow: r })
                }
            }, {
                key: "appendWithTail",
                value: function(t, e) {
                    for (var u = new ft, n = this.clone(), r = void 0, i = 0; i < t.length; ++i) {
                        var s = t[i],
                            a = this._append(s, { input: !0 });
                        if (r = this.clone(), !(!a.overflow && !this._appendTail(e).overflow) || !1 === this.doValidate({ tail: !0 })) { this.assign(n); break }
                        this.assign(r), n = this.clone(), u.aggregate(a)
                    }
                    return u.shift += this._appendTail(e).shift, u
                }
            }, {
                key: "remove",
                value: function() {
                    var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : 0,
                        e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : this.value.length - t;
                    return this._value = this.value.slice(0, t) + this.value.slice(t + e), new ft
                }
            }, {
                key: "withValueRefresh",
                value: function(t) {
                    if (this._refreshing || !this.isInitialized) return t();
                    this._refreshing = !0;
                    var e = this.unmaskedValue,
                        u = this.value,
                        n = t();
                    return this.resolve(u) !== u && (this.unmaskedValue = e), delete this._refreshing, n
                }
            }, { key: "doPrepare", value: function(t) { var e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {}; return this.prepare ? this.prepare(t, this, e) : t } }, { key: "doValidate", value: function(t) { return !this.validate || this.validate(this.value, this, t) } }, { key: "doCommit", value: function() { this.commit && this.commit(this.value, this) } }, {
                key: "splice",
                value: function(t, e, u, n) {
                    var r = t + e,
                        i = this._extractTail(r),
                        s = this.nearestInputPos(t, n);
                    return new ft({ shift: s - t }).aggregate(this.remove(s)).aggregate(this.appendWithTail(u, i))
                }
            }, { key: "value", get: function() { return this._value }, set: function(t) { this.resolve(t) } }, { key: "unmaskedValue", get: function() { return this.value }, set: function(t) { this.reset(), this._append(t), this._appendTail(), this.doCommit() } }, { key: "typedValue", get: function() { return this.unmaskedValue }, set: function(t) { this.unmaskedValue = t } }, { key: "rawInputValue", get: function() { return this.extractInput(0, this.value.length, { raw: !0 }) }, set: function(t) { this.reset(), this._append(t, { raw: !0 }), this._appendTail(), this.doCommit() } }, { key: "isComplete", get: function() { return !0 } }]), t
        }();

    function dt(t) { if (null == t) throw new Error("mask property should be defined"); return t instanceof RegExp ? ht.IMask.MaskedRegExp : it(t) ? ht.IMask.MaskedPattern : t instanceof Date || t === Date ? ht.IMask.MaskedDate : t instanceof Number || "number" == typeof t || t === Number ? ht.IMask.MaskedNumber : Array.isArray(t) || t === Array ? ht.IMask.MaskedDynamic : t.prototype instanceof ht.IMask.Masked ? t : t instanceof Function ? ht.IMask.MaskedFunction : (console.warn("Mask not found for mask", t), ht.IMask.Masked) }

    function vt(t) { var e = (t = K({}, t)).mask; return e instanceof ht.IMask.Masked ? e : new(dt(e))(t) }
    var gt = function() {
        function t(e) { q(this, t), K(this, e), this.mask && (this._masked = vt(e)) }
        return J(t, [{ key: "reset", value: function() { this.isHollow = !1, this.isRawInput = !1, this._masked && this._masked.reset() } }, { key: "resolve", value: function(t) { return !!this._masked && this._masked.resolve(t) } }, { key: "isInput", get: function() { return this.type === t.TYPES.INPUT } }, { key: "isHiddenHollow", get: function() { return this.isHollow && this.optional } }]), t
    }();
    gt.DEFAULTS = { 0: /\d/, a: /[\u0041-\u005A\u0061-\u007A\u00AA\u00B5\u00BA\u00C0-\u00D6\u00D8-\u00F6\u00F8-\u02C1\u02C6-\u02D1\u02E0-\u02E4\u02EC\u02EE\u0370-\u0374\u0376\u0377\u037A-\u037D\u0386\u0388-\u038A\u038C\u038E-\u03A1\u03A3-\u03F5\u03F7-\u0481\u048A-\u0527\u0531-\u0556\u0559\u0561-\u0587\u05D0-\u05EA\u05F0-\u05F2\u0620-\u064A\u066E\u066F\u0671-\u06D3\u06D5\u06E5\u06E6\u06EE\u06EF\u06FA-\u06FC\u06FF\u0710\u0712-\u072F\u074D-\u07A5\u07B1\u07CA-\u07EA\u07F4\u07F5\u07FA\u0800-\u0815\u081A\u0824\u0828\u0840-\u0858\u08A0\u08A2-\u08AC\u0904-\u0939\u093D\u0950\u0958-\u0961\u0971-\u0977\u0979-\u097F\u0985-\u098C\u098F\u0990\u0993-\u09A8\u09AA-\u09B0\u09B2\u09B6-\u09B9\u09BD\u09CE\u09DC\u09DD\u09DF-\u09E1\u09F0\u09F1\u0A05-\u0A0A\u0A0F\u0A10\u0A13-\u0A28\u0A2A-\u0A30\u0A32\u0A33\u0A35\u0A36\u0A38\u0A39\u0A59-\u0A5C\u0A5E\u0A72-\u0A74\u0A85-\u0A8D\u0A8F-\u0A91\u0A93-\u0AA8\u0AAA-\u0AB0\u0AB2\u0AB3\u0AB5-\u0AB9\u0ABD\u0AD0\u0AE0\u0AE1\u0B05-\u0B0C\u0B0F\u0B10\u0B13-\u0B28\u0B2A-\u0B30\u0B32\u0B33\u0B35-\u0B39\u0B3D\u0B5C\u0B5D\u0B5F-\u0B61\u0B71\u0B83\u0B85-\u0B8A\u0B8E-\u0B90\u0B92-\u0B95\u0B99\u0B9A\u0B9C\u0B9E\u0B9F\u0BA3\u0BA4\u0BA8-\u0BAA\u0BAE-\u0BB9\u0BD0\u0C05-\u0C0C\u0C0E-\u0C10\u0C12-\u0C28\u0C2A-\u0C33\u0C35-\u0C39\u0C3D\u0C58\u0C59\u0C60\u0C61\u0C85-\u0C8C\u0C8E-\u0C90\u0C92-\u0CA8\u0CAA-\u0CB3\u0CB5-\u0CB9\u0CBD\u0CDE\u0CE0\u0CE1\u0CF1\u0CF2\u0D05-\u0D0C\u0D0E-\u0D10\u0D12-\u0D3A\u0D3D\u0D4E\u0D60\u0D61\u0D7A-\u0D7F\u0D85-\u0D96\u0D9A-\u0DB1\u0DB3-\u0DBB\u0DBD\u0DC0-\u0DC6\u0E01-\u0E30\u0E32\u0E33\u0E40-\u0E46\u0E81\u0E82\u0E84\u0E87\u0E88\u0E8A\u0E8D\u0E94-\u0E97\u0E99-\u0E9F\u0EA1-\u0EA3\u0EA5\u0EA7\u0EAA\u0EAB\u0EAD-\u0EB0\u0EB2\u0EB3\u0EBD\u0EC0-\u0EC4\u0EC6\u0EDC-\u0EDF\u0F00\u0F40-\u0F47\u0F49-\u0F6C\u0F88-\u0F8C\u1000-\u102A\u103F\u1050-\u1055\u105A-\u105D\u1061\u1065\u1066\u106E-\u1070\u1075-\u1081\u108E\u10A0-\u10C5\u10C7\u10CD\u10D0-\u10FA\u10FC-\u1248\u124A-\u124D\u1250-\u1256\u1258\u125A-\u125D\u1260-\u1288\u128A-\u128D\u1290-\u12B0\u12B2-\u12B5\u12B8-\u12BE\u12C0\u12C2-\u12C5\u12C8-\u12D6\u12D8-\u1310\u1312-\u1315\u1318-\u135A\u1380-\u138F\u13A0-\u13F4\u1401-\u166C\u166F-\u167F\u1681-\u169A\u16A0-\u16EA\u1700-\u170C\u170E-\u1711\u1720-\u1731\u1740-\u1751\u1760-\u176C\u176E-\u1770\u1780-\u17B3\u17D7\u17DC\u1820-\u1877\u1880-\u18A8\u18AA\u18B0-\u18F5\u1900-\u191C\u1950-\u196D\u1970-\u1974\u1980-\u19AB\u19C1-\u19C7\u1A00-\u1A16\u1A20-\u1A54\u1AA7\u1B05-\u1B33\u1B45-\u1B4B\u1B83-\u1BA0\u1BAE\u1BAF\u1BBA-\u1BE5\u1C00-\u1C23\u1C4D-\u1C4F\u1C5A-\u1C7D\u1CE9-\u1CEC\u1CEE-\u1CF1\u1CF5\u1CF6\u1D00-\u1DBF\u1E00-\u1F15\u1F18-\u1F1D\u1F20-\u1F45\u1F48-\u1F4D\u1F50-\u1F57\u1F59\u1F5B\u1F5D\u1F5F-\u1F7D\u1F80-\u1FB4\u1FB6-\u1FBC\u1FBE\u1FC2-\u1FC4\u1FC6-\u1FCC\u1FD0-\u1FD3\u1FD6-\u1FDB\u1FE0-\u1FEC\u1FF2-\u1FF4\u1FF6-\u1FFC\u2071\u207F\u2090-\u209C\u2102\u2107\u210A-\u2113\u2115\u2119-\u211D\u2124\u2126\u2128\u212A-\u212D\u212F-\u2139\u213C-\u213F\u2145-\u2149\u214E\u2183\u2184\u2C00-\u2C2E\u2C30-\u2C5E\u2C60-\u2CE4\u2CEB-\u2CEE\u2CF2\u2CF3\u2D00-\u2D25\u2D27\u2D2D\u2D30-\u2D67\u2D6F\u2D80-\u2D96\u2DA0-\u2DA6\u2DA8-\u2DAE\u2DB0-\u2DB6\u2DB8-\u2DBE\u2DC0-\u2DC6\u2DC8-\u2DCE\u2DD0-\u2DD6\u2DD8-\u2DDE\u2E2F\u3005\u3006\u3031-\u3035\u303B\u303C\u3041-\u3096\u309D-\u309F\u30A1-\u30FA\u30FC-\u30FF\u3105-\u312D\u3131-\u318E\u31A0-\u31BA\u31F0-\u31FF\u3400-\u4DB5\u4E00-\u9FCC\uA000-\uA48C\uA4D0-\uA4FD\uA500-\uA60C\uA610-\uA61F\uA62A\uA62B\uA640-\uA66E\uA67F-\uA697\uA6A0-\uA6E5\uA717-\uA71F\uA722-\uA788\uA78B-\uA78E\uA790-\uA793\uA7A0-\uA7AA\uA7F8-\uA801\uA803-\uA805\uA807-\uA80A\uA80C-\uA822\uA840-\uA873\uA882-\uA8B3\uA8F2-\uA8F7\uA8FB\uA90A-\uA925\uA930-\uA946\uA960-\uA97C\uA984-\uA9B2\uA9CF\uAA00-\uAA28\uAA40-\uAA42\uAA44-\uAA4B\uAA60-\uAA76\uAA7A\uAA80-\uAAAF\uAAB1\uAAB5\uAAB6\uAAB9-\uAABD\uAAC0\uAAC2\uAADB-\uAADD\uAAE0-\uAAEA\uAAF2-\uAAF4\uAB01-\uAB06\uAB09-\uAB0E\uAB11-\uAB16\uAB20-\uAB26\uAB28-\uAB2E\uABC0-\uABE2\uAC00-\uD7A3\uD7B0-\uD7C6\uD7CB-\uD7FB\uF900-\uFA6D\uFA70-\uFAD9\uFB00-\uFB06\uFB13-\uFB17\uFB1D\uFB1F-\uFB28\uFB2A-\uFB36\uFB38-\uFB3C\uFB3E\uFB40\uFB41\uFB43\uFB44\uFB46-\uFBB1\uFBD3-\uFD3D\uFD50-\uFD8F\uFD92-\uFDC7\uFDF0-\uFDFB\uFE70-\uFE74\uFE76-\uFEFC\uFF21-\uFF3A\uFF41-\uFF5A\uFF66-\uFFBE\uFFC2-\uFFC7\uFFCA-\uFFCF\uFFD2-\uFFD7\uFFDA-\uFFDC]/, "*": /./ }, gt.TYPES = { INPUT: "input", FIXED: "fixed" };
    var yt = function() {
            function t(e, u) {
                var n = u.name,
                    r = u.offset,
                    i = u.mask,
                    s = u.validate;
                q(this, t), this.masked = e, this.name = n, this.offset = r, this.mask = i, this.validate = s || function() { return !0 }
            }
            return J(t, [{ key: "doValidate", value: function(t) { return this.validate(this.value, this, t) } }, { key: "value", get: function() { return this.masked.value.slice(this.masked.mapDefIndexToPos(this.offset), this.masked.mapDefIndexToPos(this.offset + this.mask.length)) } }, { key: "unmaskedValue", get: function() { return this.masked.extractInput(this.masked.mapDefIndexToPos(this.offset), this.masked.mapDefIndexToPos(this.offset + this.mask.length)) } }]), t
        }(),
        _t = function() {
            function t(e) {
                var u = nt(e, 2),
                    n = u[0],
                    r = u[1],
                    i = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : String(r).length;
                q(this, t), this._from = n, this._to = r, this._maxLength = i, this.validate = this.validate.bind(this), this._update()
            }
            return J(t, [{ key: "_update", value: function() { this._maxLength = Math.max(this._maxLength, String(this.to).length), this.mask = "0".repeat(this._maxLength) } }, {
                key: "validate",
                value: function(t) {
                    var e = "",
                        u = "",
                        n = t.match(/^(\D*)(\d*)(\D*)/) || [],
                        r = nt(n, 3),
                        i = r[1],
                        s = r[2];
                    return s && (e = "0".repeat(i.length) + s, u = "9".repeat(i.length) + s), -1 === t.search(/[^0]/) && t.length <= this._matchFrom || (e = e.padEnd(this._maxLength, "0"), u = u.padEnd(this._maxLength, "9"), this.from <= Number(u) && Number(e) <= this.to)
                }
            }, { key: "to", get: function() { return this._to }, set: function(t) { this._to = t, this._update() } }, { key: "from", get: function() { return this._from }, set: function(t) { this._from = t, this._update() } }, { key: "maxLength", get: function() { return this._maxLength }, set: function(t) { this._maxLength = t, this._update() } }, { key: "_matchFrom", get: function() { return this.maxLength - String(this.from).length } }]), t
        }();
    yt.Range = _t, yt.Enum = function(t) { return { mask: "*".repeat(t[0].length), validate: function(e, u, n) { return t.some(function(t) { return t.indexOf(u.unmaskedValue) >= 0 }) } } };
    var kt = function() {
            function t(e) { q(this, t), this.chunks = e }
            return J(t, [{ key: "value", get: function() { return this.chunks.map(function(t) { return t.value }).join("") } }, { key: "fromPos", get: function() { var t = this.chunks[0]; return t && t.stop } }, { key: "toPos", get: function() { var t = this.chunks[this.chunks.length - 1]; return t && t.stop } }]), t
        }(),
        mt = function(t) {
            function e() { var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {}; return q(this, e), t.definitions = K({}, gt.DEFAULTS, t.definitions), et(this, (e.__proto__ || Object.getPrototypeOf(e)).call(this, K({}, e.DEFAULTS, t))) }
            return tt(e, pt), J(e, [{
                key: "_update",
                value: function() {
                    var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
                    t.definitions = K({}, this.definitions, t.definitions), Q(e.prototype.__proto__ || Object.getPrototypeOf(e.prototype), "_update", this).call(this, t), this._rebuildMask()
                }
            }, {
                key: "_rebuildMask",
                value: function() {
                    var t = this,
                        u = this.definitions;
                    this._charDefs = [], this._groupDefs = [];
                    var n = this.mask;
                    if (n && u) {
                        var r = !1,
                            i = !1,
                            s = !1,
                            a = function(a) {
                                if (t.groups) {
                                    var l = n.slice(a),
                                        h = Object.keys(t.groups).filter(function(t) { return 0 === l.indexOf(t) });
                                    h.sort(function(t, e) { return e.length - t.length });
                                    var c = h[0];
                                    if (c) {
                                        var f = t.groups[c];
                                        t._groupDefs.push(new yt(t, { name: c, offset: t._charDefs.length, mask: f.mask, validate: f.validate })), n = n.replace(c, f.mask)
                                    }
                                }
                                var p = n[a],
                                    d = p in u ? gt.TYPES.INPUT : gt.TYPES.FIXED,
                                    v = d === gt.TYPES.INPUT || r,
                                    g = d === gt.TYPES.INPUT && i;
                                if (p === e.STOP_CHAR) return s = !0, "continue";
                                if ("{" === p || "}" === p) return r = !r, "continue";
                                if ("[" === p || "]" === p) return i = !i, "continue";
                                if (p === e.ESCAPE_CHAR) {
                                    if (!(p = n[++a])) return "break";
                                    d = gt.TYPES.FIXED
                                }
                                t._charDefs.push(new gt({ char: p, type: d, optional: g, stopAlign: s, unmasking: v, mask: d === gt.TYPES.INPUT ? u[p] : function(t) { return t === p } })), s = !1, o = a
                            };
                        t: for (var o = 0; o < n.length; ++o) {
                            switch (a(o)) {
                                case "continue":
                                    continue;
                                case "break":
                                    break t
                            }
                        }
                    }
                }
            }, { key: "doValidate", value: function() { for (var t, u = arguments.length, n = Array(u), r = 0; r < u; r++) n[r] = arguments[r]; return this._groupDefs.every(function(t) { return t.doValidate.apply(t, rt(n)) }) && (t = Q(e.prototype.__proto__ || Object.getPrototypeOf(e.prototype), "doValidate", this)).call.apply(t, [this].concat(rt(n))) } }, {
                key: "clone",
                value: function() {
                    var t = this,
                        u = new e(this);
                    return u._value = this.value, u._charDefs.forEach(function(e, u) { return K(e, t._charDefs[u]) }), u._groupDefs.forEach(function(e, u) { return K(e, t._groupDefs[u]) }), u
                }
            }, { key: "reset", value: function() { Q(e.prototype.__proto__ || Object.getPrototypeOf(e.prototype), "reset", this).call(this), this._charDefs.forEach(function(t) { delete t.isHollow }) } }, { key: "hiddenHollowsBefore", value: function(t) { return this._charDefs.slice(0, t).filter(function(t) { return t.isHiddenHollow }).length } }, { key: "mapDefIndexToPos", value: function(t) { return t - this.hiddenHollowsBefore(t) } }, {
                key: "mapPosToDefIndex",
                value: function(t) {
                    for (var e = t, u = 0; u < this._charDefs.length; ++u) {
                        var n = this._charDefs[u];
                        if (u >= e) break;
                        n.isHiddenHollow && ++e
                    }
                    return e
                }
            }, { key: "_appendTail", value: function(t) { var u = new ft; return t && u.aggregate(t instanceof kt ? this._appendChunks(t.chunks, { tail: !0 }) : Q(e.prototype.__proto__ || Object.getPrototypeOf(e.prototype), "_appendTail", this).call(this, t)), u.aggregate(this._appendPlaceholder()) } }, {
                key: "_append",
                value: function(t) {
                    var e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {},
                        u = this.value.length,
                        n = "",
                        r = !1;
                    t = this.doPrepare(t, e);
                    for (var i = 0, s = this.mapPosToDefIndex(this.value.length); i < t.length;) {
                        var a = t[i],
                            o = this._charDefs[s];
                        if (null == o) { r = !0; break }
                        o.isHollow = !1;
                        var l = void 0,
                            h = void 0,
                            c = st(o.resolve(a), a);
                        o.type === gt.TYPES.INPUT ? (c && (this._value += c, this.doValidate() || (c = "", this._value = this.value.slice(0, -1))), l = !!c, h = !c && !o.optional, c ? n += c : (o.optional || e.input || this.lazy || (this._value += this.placeholderChar, h = !1), h || (o.isHollow = !0))) : (this._value += o.char, l = c && (o.unmasking || e.input || e.raw) && !e.tail, o.isRawInput = l && (e.raw || e.input), o.isRawInput && (n += o.char)), h || ++s, (l || h) && ++i
                    }
                    return new ft({ inserted: this.value.slice(u), rawInserted: n, overflow: r })
                }
            }, {
                key: "_appendChunks",
                value: function(t) {
                    for (var e = new ft, u = arguments.length, n = Array(u > 1 ? u - 1 : 0), r = 1; r < u; r++) n[r - 1] = arguments[r];
                    for (var i = 0; i < t.length; ++i) {
                        var s = t[i],
                            a = s.stop,
                            o = s.value,
                            l = null != a && this._charDefs[a];
                        if (l && l.stopAlign && e.aggregate(this._appendPlaceholder(a)), e.aggregate(this._append.apply(this, [o].concat(rt(n)))).overflow) break
                    }
                    return e
                }
            }, {
                key: "_extractTail",
                value: function() {
                    var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : 0,
                        e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : this.value.length;
                    return new kt(this._extractInputChunks(t, e))
                }
            }, {
                key: "extractInput",
                value: function() {
                    var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : 0,
                        e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : this.value.length,
                        u = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : {};
                    if (t === e) return "";
                    for (var n = this.value, r = "", i = this.mapPosToDefIndex(e), s = t, a = this.mapPosToDefIndex(t); s < e && s < n.length && a < i; ++a) {
                        var o = n[s],
                            l = this._charDefs[a];
                        if (!l) break;
                        l.isHiddenHollow || ((l.isInput && !l.isHollow || u.raw && !l.isInput && l.isRawInput) && (r += o), ++s)
                    }
                    return r
                }
            }, {
                key: "_extractInputChunks",
                value: function() {
                    var t = this,
                        e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : 0,
                        u = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : this.value.length;
                    if (e === u) return [];
                    var n = this.mapPosToDefIndex(e),
                        r = this.mapPosToDefIndex(u),
                        i = this._charDefs.map(function(t, e) { return [t, e] }).slice(n, r).filter(function(t) { return nt(t, 1)[0].stopAlign }).map(function(t) { return nt(t, 2)[1] }),
                        s = [n].concat(rt(i), [r]);
                    return s.map(function(e, u) { return { stop: i.indexOf(e) >= 0 ? e : null, value: t.extractInput(t.mapDefIndexToPos(e), t.mapDefIndexToPos(s[++u])) } }).filter(function(t) {
                        var e = t.stop,
                            u = t.value;
                        return null != e || u
                    })
                }
            }, {
                key: "_appendPlaceholder",
                value: function(t) {
                    for (var e = this.value.length, u = t || this._charDefs.length, n = this.mapPosToDefIndex(this.value.length); n < u; ++n) {
                        var r = this._charDefs[n];
                        r.isInput && (r.isHollow = !0), this.lazy && !t || (this._value += r.isInput || null == r.char ? r.optional ? "" : this.placeholderChar : r.char)
                    }
                    return new ft({ inserted: this.value.slice(e) })
                }
            }, {
                key: "remove",
                value: function() {
                    var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : 0,
                        u = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : this.value.length - t,
                        n = this.mapPosToDefIndex(t),
                        r = this.mapPosToDefIndex(t + u);
                    return this._charDefs.slice(n, r).forEach(function(t) { return t.reset() }), Q(e.prototype.__proto__ || Object.getPrototypeOf(e.prototype), "remove", this).call(this, t, u)
                }
            }, {
                key: "nearestInputPos",
                value: function(t) {
                    var e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : at.NONE,
                        u = e || at.RIGHT,
                        n = this.mapPosToDefIndex(t),
                        r = this._charDefs[n],
                        i = n,
                        s = void 0,
                        a = void 0,
                        o = void 0,
                        l = void 0;
                    if (e !== at.RIGHT && (r && r.isInput || e === at.NONE && t === this.value.length) && (s = n, r && !r.isHollow && (a = n)), null == a && e == at.LEFT || null == s)
                        for (l = ot(i, u); 0 <= l && l < this._charDefs.length; i += u, l += u) { var h = this._charDefs[l]; if (null == s && h.isInput && (s = i, e === at.NONE)) break; if (null == o && h.isHollow && !h.isHiddenHollow && (o = i), h.isInput && !h.isHollow) { a = i; break } }
                    if (e !== at.LEFT || 0 !== i || !this.lazy || this.extractInput() || r && r.isInput || (s = 0), e === at.LEFT || null == s) { var c = !1; for (l = ot(i, u = -u); 0 <= l && l < this._charDefs.length; i += u, l += u) { var f = this._charDefs[l]; if (f.isInput && (s = i, f.isHollow && !f.isHiddenHollow)) break; if (i === n && (c = !0), c && null != s) break }(c = c || l >= this._charDefs.length) && null != s && (i = s) } else null == a && (i = null != o ? o : s);
                    return this.mapDefIndexToPos(i)
                }
            }, { key: "group", value: function(t) { return this.groupsByName(t)[0] } }, { key: "groupsByName", value: function(t) { return this._groupDefs.filter(function(e) { return e.name === t }) } }, { key: "isComplete", get: function() { var t = this; return !this._charDefs.some(function(e, u) { return e.isInput && !e.optional && (e.isHollow || !t.extractInput(u, u + 1)) }) } }, {
                key: "unmaskedValue",
                get: function() {
                    for (var t = this.value, e = "", u = 0, n = 0; u < t.length && n < this._charDefs.length; ++n) {
                        var r = t[u],
                            i = this._charDefs[n];
                        i.isHiddenHollow || (i.unmasking && !i.isHollow && (e += r), ++u)
                    }
                    return e
                },
                set: function(t) { ut(e.prototype.__proto__ || Object.getPrototypeOf(e.prototype), "unmaskedValue", t, this) }
            }]), e
        }();
    mt.DEFAULTS = { lazy: !0, placeholderChar: "_" }, mt.STOP_CHAR = "`", mt.ESCAPE_CHAR = "\\", mt.Definition = gt, mt.Group = yt;
    var At = function(t) {
        function e(t) { return q(this, e), et(this, (e.__proto__ || Object.getPrototypeOf(e)).call(this, K({}, e.DEFAULTS, t))) }
        return tt(e, mt), J(e, [{
            key: "_update",
            value: function(t) {
                t.mask === Date && delete t.mask, t.pattern && (t.mask = t.pattern, delete t.pattern);
                var u = t.groups;
                t.groups = K({}, e.GET_DEFAULT_GROUPS()), t.min && (t.groups.Y.from = t.min.getFullYear()), t.max && (t.groups.Y.to = t.max.getFullYear()), K(t.groups, u), Q(e.prototype.__proto__ || Object.getPrototypeOf(e.prototype), "_update", this).call(this, t)
            }
        }, {
            key: "doValidate",
            value: function() {
                for (var t, u = arguments.length, n = Array(u), r = 0; r < u; r++) n[r] = arguments[r];
                var i = (t = Q(e.prototype.__proto__ || Object.getPrototypeOf(e.prototype), "doValidate", this)).call.apply(t, [this].concat(rt(n))),
                    s = this.date;
                return i && (!this.isComplete || this.isDateExist(this.value) && s && (null == this.min || this.min <= s) && (null == this.max || s <= this.max))
            }
        }, { key: "isDateExist", value: function(t) { return this.format(this.parse(t)) === t } }, { key: "date", get: function() { return this.isComplete ? this.parse(this.value) : null }, set: function(t) { this.value = this.format(t) } }, { key: "typedValue", get: function() { return this.date }, set: function(t) { this.date = t } }]), e
    }();
    At.DEFAULTS = {
        pattern: "d{.}`m{.}`Y",
        format: function(t) { return [String(t.getDate()).padStart(2, "0"), String(t.getMonth() + 1).padStart(2, "0"), t.getFullYear()].join(".") },
        parse: function(t) {
            var e = t.split("."),
                u = nt(e, 3),
                n = u[0],
                r = u[1],
                i = u[2];
            return new Date(i, r - 1, n)
        }
    }, At.GET_DEFAULT_GROUPS = function() { return { d: new yt.Range([1, 31]), m: new yt.Range([1, 12]), Y: new yt.Range([1900, 9999]) } };
    var Ft = function() {
            function t() { q(this, t) }
            return J(t, [{ key: "select", value: function(t, e) { if (null != t && null != e && (t !== this.selectionStart || e !== this.selectionEnd)) try { this._unsafeSelect(t, e) } catch (t) {} } }, { key: "_unsafeSelect", value: function(t, e) {} }, { key: "isActive", value: function() { return !1 } }, { key: "bindEvents", value: function(t) {} }, { key: "unbindEvents", value: function() {} }, { key: "selectionStart", get: function() { var t = void 0; try { t = this._unsafeSelectionStart } catch (t) {} return null != t ? t : this.value.length } }, { key: "selectionEnd", get: function() { var t = void 0; try { t = this._unsafeSelectionEnd } catch (t) {} return null != t ? t : this.value.length } }]), t
        }(),
        Dt = function(t) {
            function e(t) { q(this, e); var u = et(this, (e.__proto__ || Object.getPrototypeOf(e)).call(this)); return u.input = t, u._handlers = {}, u }
            return tt(e, Ft), J(e, [{ key: "isActive", value: function() { return this.input === document.activeElement } }, { key: "_unsafeSelect", value: function(t, e) { this.input.setSelectionRange(t, e) } }, {
                key: "bindEvents",
                value: function(t) {
                    var u = this;
                    Object.keys(t).forEach(function(n) { return u._toggleEventHandler(e.EVENTS_MAP[n], t[n]) })
                }
            }, {
                key: "unbindEvents",
                value: function() {
                    var t = this;
                    Object.keys(this._handlers).forEach(function(e) { return t._toggleEventHandler(e) })
                }
            }, { key: "_toggleEventHandler", value: function(t, e) { this._handlers[t] && (this.input.removeEventListener(t, this._handlers[t]), delete this._handlers[t]), e && (this.input.addEventListener(t, e), this._handlers[t] = e) } }, { key: "_unsafeSelectionStart", get: function() { return this.input.selectionStart } }, { key: "_unsafeSelectionEnd", get: function() { return this.input.selectionEnd } }, { key: "value", get: function() { return this.input.value }, set: function(t) { this.input.value = t } }]), e
        }();
    Dt.EVENTS_MAP = { selectionChange: "keydown", input: "input", drop: "drop", click: "click", focus: "focus", commit: "change" };
    var Et = function() {
            function t(e, u) { q(this, t), this.el = e instanceof Ft ? e : new Dt(e), this.masked = vt(u), this._listeners = {}, this._value = "", this._unmaskedValue = "", this._saveSelection = this._saveSelection.bind(this), this._onInput = this._onInput.bind(this), this._onChange = this._onChange.bind(this), this._onDrop = this._onDrop.bind(this), this.alignCursor = this.alignCursor.bind(this), this.alignCursorFriendly = this.alignCursorFriendly.bind(this), this._bindEvents(), this.updateValue(), this._onChange() }
            return J(t, [{ key: "_bindEvents", value: function() { this.el.bindEvents({ selectionChange: this._saveSelection, input: this._onInput, drop: this._onDrop, click: this.alignCursorFriendly, focus: this.alignCursorFriendly, commit: this._onChange }) } }, { key: "_unbindEvents", value: function() { this.el.unbindEvents() } }, {
                key: "_fireEvent",
                value: function(t) {
                    var e = this._listeners[t];
                    e && e.forEach(function(t) { return t() })
                }
            }, { key: "_saveSelection", value: function() { this.value !== this.el.value && console.warn("Uncontrolled input change, refresh mask manually!"), this._selection = { start: this.selectionStart, end: this.cursorPos } } }, { key: "updateValue", value: function() { this.masked.value = this.el.value } }, {
                key: "updateControl",
                value: function() {
                    var t = this.masked.unmaskedValue,
                        e = this.masked.value,
                        u = this.unmaskedValue !== t || this.value !== e;
                    this._unmaskedValue = t, this._value = e, this.el.value !== e && (this.el.value = e), u && this._fireChangeEvents()
                }
            }, {
                key: "updateOptions",
                value: function(t) {
                    t = K({}, t), this.mask = t.mask, delete t.mask,
                        function t(e, u) {
                            if (u === e) return !0;
                            var n, r = Array.isArray(u),
                                i = Array.isArray(e);
                            if (r && i) {
                                if (u.length != e.length) return !1;
                                for (n = 0; n < u.length; n++)
                                    if (!t(u[n], e[n])) return !1;
                                return !0
                            }
                            if (r != i) return !1;
                            if (u && e && "object" === (void 0 === u ? "undefined" : X(u)) && "object" === (void 0 === e ? "undefined" : X(e))) {
                                var s = Object.keys(u),
                                    a = u instanceof Date,
                                    o = e instanceof Date;
                                if (a && o) return u.getTime() == e.getTime();
                                if (a != o) return !1;
                                var l = u instanceof RegExp,
                                    h = e instanceof RegExp;
                                if (l && h) return u.toString() == e.toString();
                                if (l != h) return !1;
                                for (n = 0; n < s.length; n++)
                                    if (!Object.prototype.hasOwnProperty.call(e, s[n])) return !1;
                                for (n = 0; n < s.length; n++)
                                    if (!t(u[s[n]], e[s[n]])) return !1;
                                return !0
                            }
                            return !1
                        }(this.masked, t) || (this.masked.updateOptions(t), this.updateControl())
                }
            }, { key: "updateCursor", value: function(t) { null != t && (this.cursorPos = t, this._delayUpdateCursor(t)) } }, {
                key: "_delayUpdateCursor",
                value: function(t) {
                    var e = this;
                    this._abortUpdateCursor(), this._changingCursorPos = t, this._cursorChanging = setTimeout(function() { e.el && (e.cursorPos = e._changingCursorPos, e._abortUpdateCursor()) }, 10)
                }
            }, { key: "_fireChangeEvents", value: function() { this._fireEvent("accept"), this.masked.isComplete && this._fireEvent("complete") } }, { key: "_abortUpdateCursor", value: function() { this._cursorChanging && (clearTimeout(this._cursorChanging), delete this._cursorChanging) } }, { key: "alignCursor", value: function() { this.cursorPos = this.masked.nearestInputPos(this.cursorPos, at.LEFT) } }, { key: "alignCursorFriendly", value: function() { this.selectionStart === this.cursorPos && this.alignCursor() } }, { key: "on", value: function(t, e) { return this._listeners[t] || (this._listeners[t] = []), this._listeners[t].push(e), this } }, {
                key: "off",
                value: function(t, e) {
                    if (this._listeners[t]) {
                        if (e) { var u = this._listeners[t].indexOf(e); return u >= 0 && this._listeners[t].splice(u, 1), this }
                        delete this._listeners[t]
                    }
                }
            }, {
                key: "_onInput",
                value: function() {
                    if (this._abortUpdateCursor(), !this._selection) return this.updateValue();
                    var t = new ct(this.el.value, this.cursorPos, this.value, this._selection),
                        e = this.masked.splice(t.startChangePos, t.removed.length, t.inserted, t.removeDirection).offset,
                        u = this.masked.nearestInputPos(t.startChangePos + e, t.removeDirection);
                    this.updateControl(), this.updateCursor(u)
                }
            }, { key: "_onChange", value: function() { this.value !== this.el.value && this.updateValue(), this.masked.doCommit(), this.updateControl() } }, { key: "_onDrop", value: function(t) { t.preventDefault(), t.stopPropagation() } }, { key: "destroy", value: function() { this._unbindEvents(), this._listeners.length = 0, delete this.el } }, {
                key: "mask",
                get: function() { return this.masked.mask },
                set: function(t) {
                    if (!(null == t || t === this.masked.mask || t === Date && this.masked instanceof At))
                        if (this.masked.constructor !== dt(t)) {
                            var e = vt({ mask: t });
                            e.unmaskedValue = this.masked.unmaskedValue, this.masked = e
                        } else this.masked.mask = t
                }
            }, { key: "value", get: function() { return this._value }, set: function(t) { this.masked.value = t, this.updateControl(), this.alignCursor() } }, { key: "unmaskedValue", get: function() { return this._unmaskedValue }, set: function(t) { this.masked.unmaskedValue = t, this.updateControl(), this.alignCursor() } }, { key: "typedValue", get: function() { return this.masked.typedValue }, set: function(t) { this.masked.typedValue = t, this.updateControl(), this.alignCursor() } }, { key: "selectionStart", get: function() { return this._cursorChanging ? this._changingCursorPos : this.el.selectionStart } }, { key: "cursorPos", get: function() { return this._cursorChanging ? this._changingCursorPos : this.el.selectionEnd }, set: function(t) { this.el.isActive && (this.el.select(t, t), this._saveSelection()) } }]), t
        }(),
        Ct = function(t) {
            function e(t) { return q(this, e), et(this, (e.__proto__ || Object.getPrototypeOf(e)).call(this, K({}, e.DEFAULTS, t))) }
            return tt(e, pt), J(e, [{ key: "_update", value: function(t) { Q(e.prototype.__proto__ || Object.getPrototypeOf(e.prototype), "_update", this).call(this, t), this._updateRegExps() } }, {
                key: "_updateRegExps",
                value: function() {
                    var t = "",
                        e = "";
                    this.allowNegative ? (t += "([+|\\-]?|([+|\\-]?(0|([1-9]+\\d*))))", e += "[+|\\-]?") : t += "(0|([1-9]+\\d*))", e += "\\d*";
                    var u = (this.scale ? "(" + this.radix + "\\d{0," + this.scale + "})?" : "") + "$";
                    this._numberRegExpInput = new RegExp("^" + t + u), this._numberRegExp = new RegExp("^" + e + u), this._mapToRadixRegExp = new RegExp("[" + this.mapToRadix.map(lt).join("") + "]", "g"), this._thousandsSeparatorRegExp = new RegExp(lt(this.thousandsSeparator), "g")
                }
            }, {
                key: "_extractTail",
                value: function() {
                    var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : 0,
                        u = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : this.value.length,
                        n = Q(e.prototype.__proto__ || Object.getPrototypeOf(e.prototype), "_extractTail", this).call(this, t, u);
                    return K({}, n, { value: this._removeThousandsSeparators(n.value) })
                }
            }, { key: "_removeThousandsSeparators", value: function(t) { return t.replace(this._thousandsSeparatorRegExp, "") } }, { key: "_insertThousandsSeparators", value: function(t) { var e = t.split(this.radix); return e[0] = e[0].replace(/\B(?=(\d{3})+(?!\d))/g, this.thousandsSeparator), e.join(this.radix) } }, { key: "doPrepare", value: function(t) { for (var u, n = arguments.length, r = Array(n > 1 ? n - 1 : 0), i = 1; i < n; i++) r[i - 1] = arguments[i]; return (u = Q(e.prototype.__proto__ || Object.getPrototypeOf(e.prototype), "doPrepare", this)).call.apply(u, [this, this._removeThousandsSeparators(t.replace(this._mapToRadixRegExp, this.radix))].concat(rt(r))) } }, {
                key: "appendWithTail",
                value: function() {
                    var t, u = this.value;
                    this._value = this._removeThousandsSeparators(this.value);
                    for (var n = this.value.length, r = arguments.length, i = Array(r), s = 0; s < r; s++) i[s] = arguments[s];
                    var a = (t = Q(e.prototype.__proto__ || Object.getPrototypeOf(e.prototype), "appendWithTail", this)).call.apply(t, [this].concat(rt(i)));
                    this._value = this._insertThousandsSeparators(this.value);
                    for (var o = n + a.inserted.length, l = 0; l <= o; ++l) this.value[l] === this.thousandsSeparator && ((l < n || l === n && u[l] === this.thousandsSeparator) && ++n, l < o && ++o);
                    return a.rawInserted = a.inserted, a.inserted = this.value.slice(n, o), a.shift += n - u.length, a
                }
            }, { key: "nearestInputPos", value: function(t, e) { if (!e) return t; var u = ot(t, e); return this.value[u] === this.thousandsSeparator && (t += e), t } }, {
                key: "doValidate",
                value: function(t) {
                    var u = (t.input ? this._numberRegExpInput : this._numberRegExp).test(this._removeThousandsSeparators(this.value));
                    if (u) {
                        var n = this.number;
                        u = u && !isNaN(n) && (null == this.min || this.min >= 0 || this.min <= this.number) && (null == this.max || this.max <= 0 || this.number <= this.max)
                    }
                    return u && Q(e.prototype.__proto__ || Object.getPrototypeOf(e.prototype), "doValidate", this).call(this, t)
                }
            }, {
                key: "doCommit",
                value: function() {
                    var t = this.number,
                        u = t;
                    null != this.min && (u = Math.max(u, this.min)), null != this.max && (u = Math.min(u, this.max)), u !== t && (this.unmaskedValue = String(u));
                    var n = this.value;
                    this.normalizeZeros && (n = this._normalizeZeros(n)), this.padFractionalZeros && (n = this._padFractionalZeros(n)), this._value = this._insertThousandsSeparators(n), Q(e.prototype.__proto__ || Object.getPrototypeOf(e.prototype), "doCommit", this).call(this)
                }
            }, { key: "_normalizeZeros", value: function(t) { var e = this._removeThousandsSeparators(t).split(this.radix); return e[0] = e[0].replace(/^(\D*)(0*)(\d*)/, function(t, e, u, n) { return e + n }), t.length && !/\d$/.test(e[0]) && (e[0] = e[0] + "0"), e.length > 1 && (e[1] = e[1].replace(/0*$/, ""), e[1].length || (e.length = 1)), this._insertThousandsSeparators(e.join(this.radix)) } }, { key: "_padFractionalZeros", value: function(t) { if (!t) return t; var e = t.split(this.radix); return e.length < 2 && e.push(""), e[1] = e[1].padEnd(this.scale, "0"), e.join(this.radix) } }, { key: "unmaskedValue", get: function() { return this._removeThousandsSeparators(this._normalizeZeros(this.value)).replace(this.radix, ".") }, set: function(t) { ut(e.prototype.__proto__ || Object.getPrototypeOf(e.prototype), "unmaskedValue", t.replace(".", this.radix), this) } }, { key: "number", get: function() { return Number(this.unmaskedValue) }, set: function(t) { this.unmaskedValue = String(t) } }, { key: "typedValue", get: function() { return this.number }, set: function(t) { this.number = t } }, { key: "allowNegative", get: function() { return this.signed || null != this.min && this.min < 0 || null != this.max && this.max < 0 } }]), e
        }();
    Ct.DEFAULTS = { radix: ",", thousandsSeparator: "", mapToRadix: ["."], scale: 2, signed: !1, normalizeZeros: !0, padFractionalZeros: !1 };
    var bt = function(t) {
            function e() { return q(this, e), et(this, (e.__proto__ || Object.getPrototypeOf(e)).apply(this, arguments)) }
            return tt(e, pt), J(e, [{ key: "_update", value: function(t) { t.validate = function(e) { return e.search(t.mask) >= 0 }, Q(e.prototype.__proto__ || Object.getPrototypeOf(e.prototype), "_update", this).call(this, t) } }]), e
        }(),
        Bt = function(t) {
            function e() { return q(this, e), et(this, (e.__proto__ || Object.getPrototypeOf(e)).apply(this, arguments)) }
            return tt(e, pt), J(e, [{ key: "_update", value: function(t) { t.validate = t.mask, Q(e.prototype.__proto__ || Object.getPrototypeOf(e.prototype), "_update", this).call(this, t) } }]), e
        }(),
        Pt = function(t) {
            function e(t) { q(this, e); var u = et(this, (e.__proto__ || Object.getPrototypeOf(e)).call(this, K({}, e.DEFAULTS, t))); return u.currentMask = null, u }
            return tt(e, pt), J(e, [{ key: "_update", value: function(t) { Q(e.prototype.__proto__ || Object.getPrototypeOf(e.prototype), "_update", this).call(this, t), this.compiledMasks = Array.isArray(t.mask) ? t.mask.map(function(t) { return vt(t) }) : [] } }, {
                key: "_append",
                value: function(t) {
                    for (var e = arguments.length, u = Array(e > 1 ? e - 1 : 0), n = 1; n < e; n++) u[n - 1] = arguments[n];
                    t = this.doPrepare.apply(this, [t].concat(rt(u)));
                    var r, i = this._applyDispatch.apply(this, [t].concat(rt(u)));
                    this.currentMask && i.aggregate((r = this.currentMask)._append.apply(r, [t].concat(rt(u))));
                    return i
                }
            }, { key: "_applyDispatch", value: function() { for (var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "", e = this.value.length, u = this.rawInputValue, n = this.currentMask, r = new ft, i = arguments.length, s = Array(i > 1 ? i - 1 : 0), a = 1; a < i; a++) s[a - 1] = arguments[a]; return this.currentMask = this.doDispatch.apply(this, [t].concat(rt(s))), this.currentMask && this.currentMask !== n && (this.currentMask.reset(), this.currentMask._append(u, { raw: !0 }), r.shift = this.value.length - e), r } }, { key: "doDispatch", value: function(t) { var e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {}; return this.dispatch(t, this, e) } }, {
                key: "clone",
                value: function() {
                    var t = new e(this);
                    t._value = this.value;
                    var u = this.compiledMasks.indexOf(this.currentMask);
                    return this.currentMask && (t.currentMask = u >= 0 ? t.compiledMasks[u].assign(this.currentMask) : this.currentMask.clone()), t
                }
            }, { key: "reset", value: function() { this.currentMask && this.currentMask.reset(), this.compiledMasks.forEach(function(t) { return t.reset() }) } }, {
                key: "remove",
                value: function() {
                    var t, e = new ft;
                    this.currentMask && e.aggregate((t = this.currentMask).remove.apply(t, arguments)).aggregate(this._applyDispatch());
                    return e
                }
            }, { key: "extractInput", value: function() { var t; return this.currentMask ? (t = this.currentMask).extractInput.apply(t, arguments) : "" } }, { key: "_extractTail", value: function() { for (var t, u, n = arguments.length, r = Array(n), i = 0; i < n; i++) r[i] = arguments[i]; return this.currentMask ? (t = this.currentMask)._extractTail.apply(t, rt(r)) : (u = Q(e.prototype.__proto__ || Object.getPrototypeOf(e.prototype), "_extractTail", this)).call.apply(u, [this].concat(rt(r))) } }, { key: "_appendTail", value: function(t) { var u = new ft; return t && u.aggregate(this._applyDispatch(t.value)), u.aggregate(this.currentMask ? this.currentMask._appendTail(t) : Q(e.prototype.__proto__ || Object.getPrototypeOf(e.prototype), "_appendTail", this).call(this, t)) } }, { key: "doCommit", value: function() { this.currentMask && this.currentMask.doCommit(), Q(e.prototype.__proto__ || Object.getPrototypeOf(e.prototype), "doCommit", this).call(this) } }, { key: "nearestInputPos", value: function() { for (var t, u, n = arguments.length, r = Array(n), i = 0; i < n; i++) r[i] = arguments[i]; return this.currentMask ? (t = this.currentMask).nearestInputPos.apply(t, rt(r)) : (u = Q(e.prototype.__proto__ || Object.getPrototypeOf(e.prototype), "nearestInputPos", this)).call.apply(u, [this].concat(rt(r))) } }, { key: "value", get: function() { return this.currentMask ? this.currentMask.value : "" }, set: function(t) { ut(e.prototype.__proto__ || Object.getPrototypeOf(e.prototype), "value", t, this) } }, { key: "unmaskedValue", get: function() { return this.currentMask ? this.currentMask.unmaskedValue : "" }, set: function(t) { ut(e.prototype.__proto__ || Object.getPrototypeOf(e.prototype), "unmaskedValue", t, this) } }, {
                key: "typedValue",
                get: function() { return this.currentMask ? this.currentMask.typedValue : "" },
                set: function(t) {
                    var e = String(t);
                    this.currentMask && (this.currentMask.typedValue = t, e = this.currentMask.unmaskedValue), this.unmaskedValue = e
                }
            }, { key: "isComplete", get: function() { return !!this.currentMask && this.currentMask.isComplete } }]), e
        }();

    function wt(t) { var e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {}; return new Et(t, e) }
    return Pt.DEFAULTS = {
        dispatch: function(t, e, u) {
            if (e.compiledMasks.length) {
                var n = e.rawInputValue,
                    r = e.compiledMasks.map(function(e, r) { var i = e.clone(); return i.rawInputValue = n, i._append(t, u), { value: i.rawInputValue.length, index: r } });
                return r.sort(function(t, e) { return e.value - t.value }), e.compiledMasks[r[0].index]
            }
        }
    }, wt.InputMask = Et, wt.Masked = pt, wt.MaskedPattern = mt, wt.MaskedNumber = Ct, wt.MaskedDate = At, wt.MaskedRegExp = bt, wt.MaskedFunction = Bt, wt.MaskedDynamic = Pt, wt.createMask = vt, wt.MaskElement = Ft, wt.HTMLMaskElement = Dt, ht.IMask = wt, wt
});
//# sourceMappingURL=imask.min.js.map