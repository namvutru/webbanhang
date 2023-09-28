<!doctype html>

<html lang="vi" class="no-js">

<head>
    <meta charset="UTF-8">
    <script>if (navigator.userAgent.match(/MSIE|Internet Explorer/i) || navigator.userAgent.match(/Trident\/7\..*?rv:11/i)) {
            var href = document.location.href;
            if (!href.match(/[?&]nowprocket/)) {
                if (href.indexOf("?") == -1) {
                    if (href.indexOf("#") == -1) {
                        document.location.href = href + "?nowprocket=1"
                    } else {
                        document.location.href = href.replace("#", "?nowprocket=1#")
                    }
                } else {
                    if (href.indexOf("#") == -1) {
                        document.location.href = href + "&nowprocket=1"
                    } else {
                        document.location.href = href.replace("#", "&nowprocket=1#")
                    }
                }
            }
        }</script>
    <script>class RocketLazyLoadScripts {
            constructor(e) {
                this.triggerEvents = e, this.userEventHandler = this.triggerListener.bind(this), this.touchStartHandler = this._onTouchStart.bind(this), this.touchMoveHandler = this._onTouchMove.bind(this), this.touchEndHandler = this._onTouchEnd.bind(this), this.clickHandler = this._onClick.bind(this), this.interceptedClicks = [], this.delayedScripts = {
                    normal: [],
                    async: [],
                    defer: []
                }, this.allJQueries = []
            }

            _addUserInteractionListener(e) {
                document.hidden ? e.triggerListener() : (this.triggerEvents.forEach((t => window.addEventListener(t, e.userEventHandler, {passive: !0}))), window.addEventListener("touchstart", e.touchStartHandler, {passive: !0}), window.addEventListener("mousedown", e.touchStartHandler), document.addEventListener("visibilitychange", e.userEventHandler))
            }

            _removeUserInteractionListener() {
                this.triggerEvents.forEach((e => window.removeEventListener(e, this.userEventHandler, {passive: !0}))), document.removeEventListener("visibilitychange", this.userEventHandler)
            }

            _onTouchStart(e) {
                window.addEventListener("touchend", this.touchEndHandler), window.addEventListener("mouseup", this.touchEndHandler), window.addEventListener("touchmove", this.touchMoveHandler, {passive: !0}), window.addEventListener("mousemove", this.touchMoveHandler), e.target.addEventListener("click", this.clickHandler), this._renameDOMAttribute(e.target, "onclick", "rocket-onclick")
            }

            _onTouchMove(e) {
                window.removeEventListener("touchend", this.touchEndHandler), window.removeEventListener("mouseup", this.touchEndHandler), window.removeEventListener("touchmove", this.touchMoveHandler, {passive: !0}), window.removeEventListener("mousemove", this.touchMoveHandler), e.target.removeEventListener("click", this.clickHandler), this._renameDOMAttribute(e.target, "rocket-onclick", "onclick")
            }

            _onTouchEnd(e) {
                window.removeEventListener("touchend", this.touchEndHandler), window.removeEventListener("mouseup", this.touchEndHandler), window.removeEventListener("touchmove", this.touchMoveHandler, {passive: !0}), window.removeEventListener("mousemove", this.touchMoveHandler)
            }

            _onClick(e) {
                e.target.removeEventListener("click", this.clickHandler), this._renameDOMAttribute(e.target, "rocket-onclick", "onclick"), this.interceptedClicks.push(e), e.preventDefault(), e.stopPropagation(), e.stopImmediatePropagation()
            }

            _replayClicks() {
                window.removeEventListener("touchstart", this.touchStartHandler, {passive: !0}), window.removeEventListener("mousedown", this.touchStartHandler), this.interceptedClicks.forEach((e => {
                    e.target.dispatchEvent(new MouseEvent("click", {view: e.view, bubbles: !0, cancelable: !0}))
                }))
            }

            _renameDOMAttribute(e, t, n) {
                e.hasAttribute(t) && (event.target.setAttribute(n, event.target.getAttribute(t)), event.target.removeAttribute(t))
            }

            triggerListener() {
                this._removeUserInteractionListener(this), "loading" === document.readyState ? document.addEventListener("DOMContentLoaded", this._loadEverythingNow.bind(this)) : this._loadEverythingNow()
            }

            async _loadEverythingNow() {
                this._delayEventListeners(), this._delayJQueryReady(this), this._handleDocumentWrite(), this._registerAllDelayedScripts(), this._preloadAllScripts(), await this._loadScriptsFromList(this.delayedScripts.normal), await this._loadScriptsFromList(this.delayedScripts.defer), await this._loadScriptsFromList(this.delayedScripts.async), await this._triggerDOMContentLoaded(), await this._triggerWindowLoad(), window.dispatchEvent(new Event("rocket-allScriptsLoaded")), this._replayClicks()
            }

            _registerAllDelayedScripts() {
                document.querySelectorAll("script[type=rocketlazyloadscript]").forEach((e => {
                    e.hasAttribute("src") ? e.hasAttribute("async") && !1 !== e.async ? this.delayedScripts.async.push(e) : e.hasAttribute("defer") && !1 !== e.defer || "module" === e.getAttribute("data-rocket-type") ? this.delayedScripts.defer.push(e) : this.delayedScripts.normal.push(e) : this.delayedScripts.normal.push(e)
                }))
            }

            async _transformScript(e) {
                return await this._requestAnimFrame(), new Promise((t => {
                    const n = document.createElement("script");
                    [...e.attributes].forEach((e => {
                        let t = e.nodeName;
                        "type" !== t && ("data-rocket-type" === t && (t = "type"), n.setAttribute(t, e.nodeValue))
                    })), e.hasAttribute("src") ? (n.addEventListener("load", t), n.addEventListener("error", t)) : (n.text = e.text, t()), e.parentNode.replaceChild(n, e)
                }))
            }

            async _loadScriptsFromList(e) {
                const t = e.shift();
                return t ? (await this._transformScript(t), this._loadScriptsFromList(e)) : Promise.resolve()
            }

            _preloadAllScripts() {
                var e = document.createDocumentFragment();
                [...this.delayedScripts.normal, ...this.delayedScripts.defer, ...this.delayedScripts.async].forEach((t => {
                    const n = t.getAttribute("src");
                    if (n) {
                        const t = document.createElement("link");
                        t.href = n, t.rel = "preload", t.as = "script", e.appendChild(t)
                    }
                })), document.head.appendChild(e)
            }

            _delayEventListeners() {
                let e = {};

                function t(t, n) {
                    !function (t) {
                        function n(n) {
                            return e[t].eventsToRewrite.indexOf(n) >= 0 ? "rocket-" + n : n
                        }

                        e[t] || (e[t] = {
                            originalFunctions: {add: t.addEventListener, remove: t.removeEventListener},
                            eventsToRewrite: []
                        }, t.addEventListener = function () {
                            arguments[0] = n(arguments[0]), e[t].originalFunctions.add.apply(t, arguments)
                        }, t.removeEventListener = function () {
                            arguments[0] = n(arguments[0]), e[t].originalFunctions.remove.apply(t, arguments)
                        })
                    }(t), e[t].eventsToRewrite.push(n)
                }

                function n(e, t) {
                    let n = e[t];
                    Object.defineProperty(e, t, {
                        get: () => n || function () {
                        }, set(i) {
                            e["rocket" + t] = n = i
                        }
                    })
                }

                t(document, "DOMContentLoaded"), t(window, "DOMContentLoaded"), t(window, "load"), t(window, "pageshow"), t(document, "readystatechange"), n(document, "onreadystatechange"), n(window, "onload"), n(window, "onpageshow")
            }

            _delayJQueryReady(e) {
                let t = window.jQuery;
                Object.defineProperty(window, "jQuery", {
                    get: () => t, set(n) {
                        if (n && n.fn && !e.allJQueries.includes(n)) {
                            n.fn.ready = n.fn.init.prototype.ready = function (t) {
                                e.domReadyFired ? t.bind(document)(n) : document.addEventListener("rocket-DOMContentLoaded", (() => t.bind(document)(n)))
                            };
                            const t = n.fn.on;
                            n.fn.on = n.fn.init.prototype.on = function () {
                                if (this[0] === window) {
                                    function e(e) {
                                        return e.split(" ").map((e => "load" === e || 0 === e.indexOf("load.") ? "rocket-jquery-load" : e)).join(" ")
                                    }

                                    "string" == typeof arguments[0] || arguments[0] instanceof String ? arguments[0] = e(arguments[0]) : "object" == typeof arguments[0] && Object.keys(arguments[0]).forEach((t => {
                                        delete Object.assign(arguments[0], {[e(t)]: arguments[0][t]})[t]
                                    }))
                                }
                                return t.apply(this, arguments), this
                            }, e.allJQueries.push(n)
                        }
                        t = n
                    }
                })
            }

            async _triggerDOMContentLoaded() {
                this.domReadyFired = !0, await this._requestAnimFrame(), document.dispatchEvent(new Event("rocket-DOMContentLoaded")), await this._requestAnimFrame(), window.dispatchEvent(new Event("rocket-DOMContentLoaded")), await this._requestAnimFrame(), document.dispatchEvent(new Event("rocket-readystatechange")), await this._requestAnimFrame(), document.rocketonreadystatechange && document.rocketonreadystatechange()
            }

            async _triggerWindowLoad() {
                await this._requestAnimFrame(), window.dispatchEvent(new Event("rocket-load")), await this._requestAnimFrame(), window.rocketonload && window.rocketonload(), await this._requestAnimFrame(), this.allJQueries.forEach((e => e(window).trigger("rocket-jquery-load"))), window.dispatchEvent(new Event("rocket-pageshow")), await this._requestAnimFrame(), window.rocketonpageshow && window.rocketonpageshow()
            }

            _handleDocumentWrite() {
                const e = new Map;
                document.write = document.writeln = function (t) {
                    const n = document.currentScript, i = document.createRange(), r = n.parentElement;
                    let o = e.get(n);
                    void 0 === o && (o = n.nextSibling, e.set(n, o));
                    const s = document.createDocumentFragment();
                    i.setStart(s, 0), s.appendChild(i.createContextualFragment(t)), r.insertBefore(s, o)
                }
            }

            async _requestAnimFrame() {
                return document.hidden ? new Promise((e => setTimeout(e))) : new Promise((e => requestAnimationFrame(e)))
            }

            static run() {
                const e = new RocketLazyLoadScripts(["keydown", "mousedown", "mousemove", "touchmove", "touchstart", "touchend", "wheel"]);
                e._addUserInteractionListener(e)
            }
        }

        RocketLazyLoadScripts.run();</script>


    <meta name="google-site-verification" content="MM_EcASgXNkmylALpmy1Zws7sK7DuX35jsMrhjbOxJ4"/>

    <link href="//www.google-analytics.com" rel="dns-prefetch">
    <!-- <link href="https://xedienvietthanh.com/favicon.png" rel="shortcut icon"> -->
    <meta name="description"
          content="Xe máy điện TAILG CONE là phiên bản mới được tích hợp nhiều công nghệ tiên tiến hiện đại của [&hellip;]">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="robots" content="noindex"/> -->
    <!-- <link rel="stylesheet" href="https://pc.baokim.vn/css/bk.css"> -->

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

    <script src="https://xedienvietthanh.com/wp-content/themes/auto/js/html5shiv.js"></script>

    <script src="https://xedienvietthanh.com/wp-content/themes/auto/js/respond.min.js"></script>

    <![endif]-->

    <style>
        .top-header {
            font-size: 13px;
            color: #aeaeae;
            background: #2cc332;
            line-height: 34px;
        }

        .top-header .sup-online a {
            color: #fff;
        }


        .container {
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto
        }

        @media (min-width: 768px) {
            .container {
                width: 750px
            }
        }

        @media (min-width: 992px) {
            .container {
                width: 970px
            }
        }

        @media (min-width: 1200px) {
            .container {
                width: 1170px
            }
        }

        .container-fluid {
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto
        }

        .align-midle {
            display: flex;
            align-items: center;
        }

        .d-flex {
            display: -webkit-box !important;
            display: -ms-flexbox !important;
            display: flex !important;
        }

        .flex-row {
            -webkit-box-orient: horizontal !important;
            -webkit-box-direction: normal !important;
            -ms-flex-direction: row !important;
            flex-direction: row !important;
        }

        .flex-row-reverse {
            -webkit-box-orient: horizontal !important;
            -webkit-box-direction: reverse !important;
            -webkit-flex-direction: row-reverse !important;
            -ms-flex-direction: row-reverse !important;
            flex-direction: row-reverse !important;
        }

        .flex-column {
            flex-direction: column !important;
        }

        .flex-row-center {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
        }

        .flex-justify {
            justify-content: space-between
        }

        .form-search {
            float: right;
            line-height: 39px
        }

        .form-search .txt_search {
            display: inline-block;
            background: 0 0;
            height: 27px;
            line-height: 27px;
            border: 1px solid #fff;
            padding: 0 10px;
            width: 100%;
            color: #fff
        }

        .top-header .search-form {
            position: relative;
            float: right
        }

        .top-header .search-form > a {
            text-align: center;
            padding: 0;
            line-height: 39px;
            margin: 0 12px;
            float: right
        }

        header {
            border-bottom: solid 2px #fe6702
        }

        .top-header {
            font-size: 13px;
            color: #aeaeae;
            background: #2cc332;
            line-height: 34px
        }

        .top-header .sup-online {
            float: right;
            line-height: 39px
        }

        .top-header .sup-online a {
            color: #fff
        }

        .mid-header {
            position: relative
        }

        .mid-header .logo {
            display: table;
            font-size: 0
        }

        .mid-header .logo .wrap-logo {
            display: table-cell;
            vertical-align: middle;
            height: 52px
        }

        .nav-menu li:hover a {
            color: #f36f20
        }

        .nav-menu {
            padding-left: 0;
            display: block
        }

        .nav-menu li {
            display: inline-block
        }

        .nav-menu li a {
            padding: 16px;
            font-size: 14px;
            font-weight: 700;
            color: #000;
            text-transform: uppercase;
            background-color: transparent !important;
            transition: all 1s ease 0s;
            -webkit-transition: all 1s ease 0s;
            -moz-transition: all 1s ease 0s;
            -o-transition: all 1s ease 0s
        }

        .nav-menu > li::before {
            content: "";
            background-color: #e1e1e1;
            float: left;
            width: 1px;
            height: 27px;
            margin-top: 14px
        }

        #mainSlide .carousel {
            width: 100%;
            background: #000;
            margin: 0
        }

        #mainSlide .carousel-indicators {
            bottom: 10px
        }

        #myCarousel .carousel-indicators li {
            width: 13px;
            height: 13px;
            margin: 0 7px;
            background-color: #fff;
            border-radius: 100%
        }

        #myCarousel .carousel-indicators li.active {
            background-color: #f60
        }

        #myCarousel img {
            max-height: 410px;
            margin: 0 auto;
            max-width: 1540px
        }

        .table-service {
            margin-top: 8px;
            margin-bottom: 8px
        }

        .service {
            width: 100%
        }

        .service .service-th {
            margin: 0 4px;
            text-align: center
        }

        .service .no-padding:last-child .service-th {
            padding-right: 0;
            margin-right: 0
        }

        .service .no-padding:first-child .service-th {
            margin-left: 0
        }

        .row {
            margin-right: -15px;
            margin-left: -15px
        }

        .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
            position: relative;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px
        }

        .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
            float: left
        }

        .col-xs-12 {
            width: 100%
        }

        .col-xs-11 {
            width: 91.66666667%
        }

        .col-xs-10 {
            width: 83.33333333%
        }

        .col-xs-9 {
            width: 75%
        }

        .col-xs-8 {
            width: 66.66666667%
        }

        .col-xs-7 {
            width: 58.33333333%
        }

        .col-xs-6 {
            width: 50%
        }

        .col-xs-5 {
            width: 41.66666667%
        }

        .col-xs-4 {
            width: 33.33333333%
        }

        .col-xs-3 {
            width: 25%
        }

        .col-xs-2 {
            width: 16.66666667%
        }

        .col-xs-1 {
            width: 8.33333333%
        }

        .col-xs-pull-12 {
            right: 100%
        }

        .col-xs-pull-11 {
            right: 91.66666667%
        }

        .col-xs-pull-10 {
            right: 83.33333333%
        }

        .col-xs-pull-9 {
            right: 75%
        }

        .col-xs-pull-8 {
            right: 66.66666667%
        }

        .col-xs-pull-7 {
            right: 58.33333333%
        }

        .col-xs-pull-6 {
            right: 50%
        }

        .col-xs-pull-5 {
            right: 41.66666667%
        }

        .col-xs-pull-4 {
            right: 33.33333333%
        }

        .col-xs-pull-3 {
            right: 25%
        }

        .col-xs-pull-2 {
            right: 16.66666667%
        }

        .col-xs-pull-1 {
            right: 8.33333333%
        }

        .col-xs-pull-0 {
            right: auto
        }

        .col-xs-push-12 {
            left: 100%
        }

        .col-xs-push-11 {
            left: 91.66666667%
        }

        .col-xs-push-10 {
            left: 83.33333333%
        }

        .col-xs-push-9 {
            left: 75%
        }

        .col-xs-push-8 {
            left: 66.66666667%
        }

        .col-xs-push-7 {
            left: 58.33333333%
        }

        .col-xs-push-6 {
            left: 50%
        }

        .col-xs-push-5 {
            left: 41.66666667%
        }

        .col-xs-push-4 {
            left: 33.33333333%
        }

        .col-xs-push-3 {
            left: 25%
        }

        .col-xs-push-2 {
            left: 16.66666667%
        }

        .col-xs-push-1 {
            left: 8.33333333%
        }

        .col-xs-push-0 {
            left: auto
        }

        .col-xs-offset-12 {
            margin-left: 100%
        }

        .col-xs-offset-11 {
            margin-left: 91.66666667%
        }

        .col-xs-offset-10 {
            margin-left: 83.33333333%
        }

        .col-xs-offset-9 {
            margin-left: 75%
        }

        .col-xs-offset-8 {
            margin-left: 66.66666667%
        }

        .col-xs-offset-7 {
            margin-left: 58.33333333%
        }

        .col-xs-offset-6 {
            margin-left: 50%
        }

        .col-xs-offset-5 {
            margin-left: 41.66666667%
        }

        .col-xs-offset-4 {
            margin-left: 33.33333333%
        }

        .col-xs-offset-3 {
            margin-left: 25%
        }

        .col-xs-offset-2 {
            margin-left: 16.66666667%
        }

        .col-xs-offset-1 {
            margin-left: 8.33333333%
        }

        .col-xs-offset-0 {
            margin-left: 0
        }

        @media (min-width: 768px) {
            .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9 {
                float: left
            }

            .col-sm-12 {
                width: 100%
            }

            .col-sm-11 {
                width: 91.66666667%
            }

            .col-sm-10 {
                width: 83.33333333%
            }

            .col-sm-9 {
                width: 75%
            }

            .col-sm-8 {
                width: 66.66666667%
            }

            .col-sm-7 {
                width: 58.33333333%
            }

            .col-sm-6 {
                width: 50%
            }

            .col-sm-5 {
                width: 41.66666667%
            }

            .col-sm-4 {
                width: 33.33333333%
            }

            .col-sm-3 {
                width: 25%
            }

            .col-sm-2 {
                width: 16.66666667%
            }

            .col-sm-1 {
                width: 8.33333333%
            }

            .col-sm-pull-12 {
                right: 100%
            }

            .col-sm-pull-11 {
                right: 91.66666667%
            }

            .col-sm-pull-10 {
                right: 83.33333333%
            }

            .col-sm-pull-9 {
                right: 75%
            }

            .col-sm-pull-8 {
                right: 66.66666667%
            }

            .col-sm-pull-7 {
                right: 58.33333333%
            }

            .col-sm-pull-6 {
                right: 50%
            }

            .col-sm-pull-5 {
                right: 41.66666667%
            }

            .col-sm-pull-4 {
                right: 33.33333333%
            }

            .col-sm-pull-3 {
                right: 25%
            }

            .col-sm-pull-2 {
                right: 16.66666667%
            }

            .col-sm-pull-1 {
                right: 8.33333333%
            }

            .col-sm-pull-0 {
                right: auto
            }

            .col-sm-push-12 {
                left: 100%
            }

            .col-sm-push-11 {
                left: 91.66666667%
            }

            .col-sm-push-10 {
                left: 83.33333333%
            }

            .col-sm-push-9 {
                left: 75%
            }

            .col-sm-push-8 {
                left: 66.66666667%
            }

            .col-sm-push-7 {
                left: 58.33333333%
            }

            .col-sm-push-6 {
                left: 50%
            }

            .col-sm-push-5 {
                left: 41.66666667%
            }

            .col-sm-push-4 {
                left: 33.33333333%
            }

            .col-sm-push-3 {
                left: 25%
            }

            .col-sm-push-2 {
                left: 16.66666667%
            }

            .col-sm-push-1 {
                left: 8.33333333%
            }

            .col-sm-push-0 {
                left: auto
            }

            .col-sm-offset-12 {
                margin-left: 100%
            }

            .col-sm-offset-11 {
                margin-left: 91.66666667%
            }

            .col-sm-offset-10 {
                margin-left: 83.33333333%
            }

            .col-sm-offset-9 {
                margin-left: 75%
            }

            .col-sm-offset-8 {
                margin-left: 66.66666667%
            }

            .col-sm-offset-7 {
                margin-left: 58.33333333%
            }

            .col-sm-offset-6 {
                margin-left: 50%
            }

            .col-sm-offset-5 {
                margin-left: 41.66666667%
            }

            .col-sm-offset-4 {
                margin-left: 33.33333333%
            }

            .col-sm-offset-3 {
                margin-left: 25%
            }

            .col-sm-offset-2 {
                margin-left: 16.66666667%
            }

            .col-sm-offset-1 {
                margin-left: 8.33333333%
            }

            .col-sm-offset-0 {
                margin-left: 0
            }
        }

        @media (min-width: 992px) {
            .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9 {
                float: left
            }

            .col-md-12 {
                width: 100%
            }

            .col-md-11 {
                width: 91.66666667%
            }

            .col-md-10 {
                width: 83.33333333%
            }

            .col-md-9 {
                width: 75%
            }

            .col-md-8 {
                width: 66.66666667%
            }

            .col-md-7 {
                width: 58.33333333%
            }

            .col-md-6 {
                width: 50%
            }

            .col-md-5 {
                width: 41.66666667%
            }

            .col-md-4 {
                width: 33.33333333%
            }

            .col-md-3 {
                width: 25%
            }

            .col-md-2 {
                width: 16.66666667%
            }

            .col-md-1 {
                width: 8.33333333%
            }

            .col-md-pull-12 {
                right: 100%
            }

            .col-md-pull-11 {
                right: 91.66666667%
            }

            .col-md-pull-10 {
                right: 83.33333333%
            }

            .col-md-pull-9 {
                right: 75%
            }

            .col-md-pull-8 {
                right: 66.66666667%
            }

            .col-md-pull-7 {
                right: 58.33333333%
            }

            .col-md-pull-6 {
                right: 50%
            }

            .col-md-pull-5 {
                right: 41.66666667%
            }

            .col-md-pull-4 {
                right: 33.33333333%
            }

            .col-md-pull-3 {
                right: 25%
            }

            .col-md-pull-2 {
                right: 16.66666667%
            }

            .col-md-pull-1 {
                right: 8.33333333%
            }

            .col-md-pull-0 {
                right: auto
            }

            .col-md-push-12 {
                left: 100%
            }

            .col-md-push-11 {
                left: 91.66666667%
            }

            .col-md-push-10 {
                left: 83.33333333%
            }

            .col-md-push-9 {
                left: 75%
            }

            .col-md-push-8 {
                left: 66.66666667%
            }

            .col-md-push-7 {
                left: 58.33333333%
            }

            .col-md-push-6 {
                left: 50%
            }

            .col-md-push-5 {
                left: 41.66666667%
            }

            .col-md-push-4 {
                left: 33.33333333%
            }

            .col-md-push-3 {
                left: 25%
            }

            .col-md-push-2 {
                left: 16.66666667%
            }

            .col-md-push-1 {
                left: 8.33333333%
            }

            .col-md-push-0 {
                left: auto
            }

            .col-md-offset-12 {
                margin-left: 100%
            }

            .col-md-offset-11 {
                margin-left: 91.66666667%
            }

            .col-md-offset-10 {
                margin-left: 83.33333333%
            }

            .col-md-offset-9 {
                margin-left: 75%
            }

            .col-md-offset-8 {
                margin-left: 66.66666667%
            }

            .col-md-offset-7 {
                margin-left: 58.33333333%
            }

            .col-md-offset-6 {
                margin-left: 50%
            }

            .col-md-offset-5 {
                margin-left: 41.66666667%
            }

            .col-md-offset-4 {
                margin-left: 33.33333333%
            }

            .col-md-offset-3 {
                margin-left: 25%
            }

            .col-md-offset-2 {
                margin-left: 16.66666667%
            }

            .col-md-offset-1 {
                margin-left: 8.33333333%
            }

            .col-md-offset-0 {
                margin-left: 0
            }
        }

        @media (min-width: 1200px) {
            .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9 {
                float: left
            }

            .col-lg-12 {
                width: 100%
            }

            .col-lg-11 {
                width: 91.66666667%
            }

            .col-lg-10 {
                width: 83.33333333%
            }

            .col-lg-9 {
                width: 75%
            }

            .col-lg-8 {
                width: 66.66666667%
            }

            .col-lg-7 {
                width: 58.33333333%
            }

            .col-lg-6 {
                width: 50%
            }

            .col-lg-5 {
                width: 41.66666667%
            }

            .col-lg-4 {
                width: 33.33333333%
            }

            .col-lg-3 {
                width: 25%
            }

            .col-lg-2 {
                width: 16.66666667%
            }

            .col-lg-1 {
                width: 8.33333333%
            }

            .col-lg-pull-12 {
                right: 100%
            }

            .col-lg-pull-11 {
                right: 91.66666667%
            }

            .col-lg-pull-10 {
                right: 83.33333333%
            }

            .col-lg-pull-9 {
                right: 75%
            }

            .col-lg-pull-8 {
                right: 66.66666667%
            }

            .col-lg-pull-7 {
                right: 58.33333333%
            }

            .col-lg-pull-6 {
                right: 50%
            }

            .col-lg-pull-5 {
                right: 41.66666667%
            }

            .col-lg-pull-4 {
                right: 33.33333333%
            }

            .col-lg-pull-3 {
                right: 25%
            }

            .col-lg-pull-2 {
                right: 16.66666667%
            }

            .col-lg-pull-1 {
                right: 8.33333333%
            }

            .col-lg-pull-0 {
                right: auto
            }

            .col-lg-push-12 {
                left: 100%
            }

            .col-lg-push-11 {
                left: 91.66666667%
            }

            .col-lg-push-10 {
                left: 83.33333333%
            }

            .col-lg-push-9 {
                left: 75%
            }

            .col-lg-push-8 {
                left: 66.66666667%
            }

            .col-lg-push-7 {
                left: 58.33333333%
            }

            .col-lg-push-6 {
                left: 50%
            }

            .col-lg-push-5 {
                left: 41.66666667%
            }

            .col-lg-push-4 {
                left: 33.33333333%
            }

            .col-lg-push-3 {
                left: 25%
            }

            .col-lg-push-2 {
                left: 16.66666667%
            }

            .col-lg-push-1 {
                left: 8.33333333%
            }

            .col-lg-push-0 {
                left: auto
            }

            .col-lg-offset-12 {
                margin-left: 100%
            }

            .col-lg-offset-11 {
                margin-left: 91.66666667%
            }

            .col-lg-offset-10 {
                margin-left: 83.33333333%
            }

            .col-lg-offset-9 {
                margin-left: 75%
            }

            .col-lg-offset-8 {
                margin-left: 66.66666667%
            }

            .col-lg-offset-7 {
                margin-left: 58.33333333%
            }

            .col-lg-offset-6 {
                margin-left: 50%
            }

            .col-lg-offset-5 {
                margin-left: 41.66666667%
            }

            .col-lg-offset-4 {
                margin-left: 33.33333333%
            }

            .col-lg-offset-3 {
                margin-left: 25%
            }

            .col-lg-offset-2 {
                margin-left: 16.66666667%
            }

            .col-lg-offset-1 {
                margin-left: 8.33333333%
            }

            .col-lg-offset-0 {
                margin-left: 0
            }
        }


        a, body {
            color: #000
        }

        a, a:hover {
            text-decoration: none
        }

        .font24, .font25, .font26, .font28, .font29, .font30, .font32, .font33 {
            line-height: 35px
        }

        .fullw, .txt-center {
            text-align: center
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box
        }

        body {
            background: #f7f8f7;
            font-size: 14px;
            font-family: Roboto, sans-serif
        }

        a:hover {
            color: #f36f20
        }

        .font12 {
            font-size: 12px
        }

        .font13 {
            font-size: 13px
        }

        .font14 {
            font-size: 14px
        }

        .font15 {
            font-size: 15px
        }

        .font16 {
            font-size: 16px
        }

        .font17 {
            font-size: 17px
        }

        .font18 {
            font-size: 18px
        }

        .font19 {
            font-size: 19px
        }

        .font20 {
            font-size: 20px
        }

        .font21 {
            font-size: 21px
        }

        .font22 {
            font-size: 22px
        }

        .font24 {
            font-size: 24px
        }

        .font25 {
            font-size: 25px
        }

        .font26 {
            font-size: 26px
        }

        .font29 {
            font-size: 29px
        }

        .font28 {
            font-size: 28px
        }

        .font30 {
            font-size: 30px
        }

        .font32 {
            font-size: 32px
        }

        .font33 {
            font-size: 33px
        }

        .font37, .font39, .font40 {
            line-height: 42px
        }

        .font37 {
            font-size: 37px
        }

        .font39 {
            font-size: 39px
        }

        .font40 {
            font-size: 40px
        }

        .font42 {
            font-size: 42px;
            line-height: 55px
        }

        .mart20 {
            margin-top: 20px
        }

        .mar10 {
            margin: 10px 0 !important
        }

        .mart10 {
            margin-top: 10px !important
        }

        .marb20 {
            margin-bottom: 20px
        }

        .marb10 {
            margin-bottom: 10px !important
        }

        .marb50 {
            margin-bottom: 50px
        }

        .space10 {
            height: 10px
        }

        .space15 {
            height: 15px
        }

        .space20 {
            height: 20px
        }

        .space30 {
            height: 30px
        }

        .no-margin {
            margin: 0 !important
        }

        .no-border {
            border: none !important
        }

        .bg_xanh6 {
            background: #67ad4a
        }

        .bg_white {
            background: #fff
        }

        .cl_white {
            color: #fff
        }

        .cl_666 {
            color: #666
        }

        .cl_nav a {
            color: #3e3e3e
        }

        .cl_xanh6 {
            color: #00a651
        }

        .cl_cam {
            color: #ff7200
        }

        .cl_f16f23 {
            color: #f16f23
        }

        .cl_cam2 {
            color: #fc6e0f
        }

        .cl_red, .cl_red a {
            color: red
        }

        .cl_tinnoibat {
            color: #282828 !important
        }

        .italic {
            font-style: italic
        }

        .clear {
            clear: both
        }

        .hamburger, .mobile, .none {
            display: none !important
        }

        .block {
            display: block
        }

        .left {
            float: left
        }

        .right {
            float: right
        }

        .fullw, .wrap_item {
            float: left
        }

        .fullw {
            width: 100%
        }

        .box, .full, .rows {
            float: left;
            width: 100%;
            margin: 0
        }

        .wd50 {
            width: 50%
        }

        .w100, .wd100, .wrap_item {
            width: 100%
        }

        .wd100 {
            display: inline-block
        }

        .relative {
            position: relative
        }

        .table-news td, .transition {
            -webkit-transition: all .3s;
            transition: all .3s
        }

        .border {
            border: 1px solid #e1e1e1
        }

        .bold {
            font-weight: 700
        }

        .h10 {
            height: 10px
        }

        .h20 {
            height: 20px
        }

        .h15 {
            height: 15px
        }

        .pad15 {
            padding: 15px
        }

        .pad30 {
            padding: 30px 0
        }

        .pad50 {
            padding: 50px 0
        }

        .padt50 {
            padding-top: 50px
        }

        .padb50 {
            padding-bottom: 50px
        }

        .space60 {
            height: 60px
        }

        ul {
            list-style: none
        }

        .txt_upcase {
            text-transform: uppercase
        }

        .no-padding {
            padding: 0
        }

        .over-hidden {
            overflow: hidden;
        }


        .bx-wrapper {
            margin-bottom: 0 !important;
        }


        /*search*/

        .form-search {
        + display: inline-block;
            float: right;
            line-height: 39px;
        }

        .form-search .txt_search {

            display: inline-block;

            background: none;

            height: 27px;

            line-height: 27px;

            border: 1px solid #fff;

            padding: 0 10px;

            width: 100%;

            color: #fff;

        }

        .top-header .search-form {
            position: relative;
            float: right;
        }

        .top-header .search-form > a {
            text-align: center;
            padding: 0;
            line-height: 39px;

            margin: 0 12px;

            float: right;

        + display: inline-block;

        }

        header {
            border-bottom: solid 2px #fe6702
        }

        .top-header {

            font-size: 13px;

            color: #aeaeae;

            background: #2cc332;

            line-height: 34px;

        }

        .top-header .sup-online {

            float: right;
            line-height: 39px;

        }

        .top-header .sup-online a {

            color: #fff

        }


        .mid-header {

            position: relative;

        }

        .mid-header .logo {

            display: table;

            font-size: 0;

        + width: calc(100 % - 40 px);

        }

        .mid-header .logo .wrap-logo {

            display: table-cell;

            vertical-align: middle;

            height: 52px;

        }


        .nav-menu li:hover a {
            color: #f36f20;
        }

        .nav-menu {

            padding-left: 0;

            display: block;

        }

        .nav-menu li {

            display: inline-block;

        }


        .nav-menu li a {

            padding: 16px;

            font-size: 14px;

            font-weight: 700;

            color: #000;

            text-transform: uppercase;

            background-color: transparent !important;

            transition: all 1s ease 0s;

            -webkit-transition: all 1s ease 0s;

            -moz-transition: all 1s ease 0s;

            -o-transition: all 1s ease 0s;

        }

        .nav-menu > li::before {

            content: "";

            background-color: #e1e1e1;

            float: left;

            width: 1px;

            height: 27px;

            margin-top: 14px;

        }

        #mainSlide .carousel {
            width: 100%;
            background: #000;
            margin: 0px
        }

        #mainSlide .carousel-indicators {
            bottom: 10px
        }

        /*#myCarousel .item{width:100%;height:518px;background-size:cover; background-position:center center}*/

        #myCarousel .carousel-indicators li {
            width: 13px;
            height: 13px;
            margin: 0 7px;
            background-color: #fff;
            border-radius: 100%
        }

        #myCarousel .carousel-indicators li.active {
            background-color: #ff6600
        }

        #myCarousel img {
            max-height: 410px;
            margin: 0 auto;
            max-width: 1540px;
        }

        .table-service {
            margin-top: 8px;
            margin-bottom: 8px;

        }

        .service {
            width: 100%;
        }

        .service .service-th {
            margin: 0 4px;
            text-align: center;
        }

        .service .no-padding:last-child .service-th {
            padding-right: 0px;
            margin-right: 0;
        }

        .service .no-padding:first-child .service-th {
            margin-left: 0;
        }

        .service .service-th-div {
            width: 100%;
            margin: auto;
            display: table;
            background-repeat: no-repeat;
            background-color: #dd321a;
        }

        .service .service-th-div-mask {
            width: 100%;
            height: 110px;
            display: table-cell;
            vertical-align: middle;
            padding-left: 112px;
            font-weight: 700;
            font-size: 18px
        }

        .service .service-th-div {
            width: 100%;
            position: relative;
            margin: auto;
            display: table;
            color: #f26e23;
            transition: all 0.21s ease 0s;
            background-color: #fff;
            border-radius: 4px;
        }

        .service .service-th-div:hover {
            background-color: #f26e23;
            color: #Fff;
        }

        .service .service-th-div:before {
            content: '';
            position: absolute;
            width: 70px;
            height: 70px;
            top: 18px;
            left: 20px;
            transition: all 0.21s ease 0s;
            background-image: url(https://xedienvietthanh.com/wp-content/themes/auto/images/2022/4icamketpc.png);
            background-repeat: no-repeat;
        }

        .service .service-th-1 .service-th-div:before {
            background-position: 0 0px;
        }

        .service .service-th-2 .service-th-div:before {
            background-position: 0 -70px;
        }

        .service .service-th-4 .service-th-div:before {
            background-position: 0 -140px;
        }

        .service .service-th-3 .service-th-div:before {
            background-position: 0 -210px;
        }

        .service .service-th-1:hover .service-th-div:before {
            background-position: -70px 0px;
        }

        .service .service-th-2:hover .service-th-div:before {
            background-position: -70px -70px;
        }

        .service .service-th-4:hover .service-th-div:before {
            background-position: -70px -140px;
        }

        .service .service-th-3:hover .service-th-div:before {
            background-position: -70px -210px;
        }

        .service .service-th-div-mask p {
            margin: 0;
        }

        .offer-banner-section {
            overflow: hidden;
            width: 100%;
        }

        .offer-banner-section ul li {
            margin-bottom: 8px;
        }

        .banner900x600.no-padding {
            padding-right: 3px !important;
        }

        .sb-fb-2qc.no-padding {
            padding-left: 5px !important;
        }

    </style>
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1'/>

    <!-- This site is optimized with the Yoast SEO plugin v19.11 - https://yoast.com/wordpress/plugins/seo/ -->
    <title>{{$shop_info->name}}</title>
    <link rel="stylesheet"
          href="https://xedienvietthanh.com/wp-content/cache/min/1/6cf9e88bd4569045586feeecd42b1539.css" media="all"
          data-minify="1"/>
    <link rel="canonical" href="{{env('APP_URL')}}"/>
    <link rel="next" href="{{env('APP_URL')}}"/>
    <meta property="og:locale" content="vi_VN"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title"
          content="{{$shop_info->name}}"/>
    <meta property="og:description"
          content="{{env('APP_URL')}}"/>
    <meta property="og:url" content="{{env('APP_URL')}}"/>
    <meta property="og:site_name"
          content="{{env('APP_URL')}}"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="google-site-verification" content="3nJMXEBYrR81OSurixmj5UuDl5wqdic8Tbq79DhoNMg"/>
    <!-- / Yoast SEO plugin. -->


    <link rel='dns-prefetch' href='//xedienvietthanh.com'/>

    <style id='global-styles-inline-css' type='text/css'>
        body {
            --wp--preset--color--black: #000000;
            --wp--preset--color--cyan-bluish-gray: #abb8c3;
            --wp--preset--color--white: #ffffff;
            --wp--preset--color--pale-pink: #f78da7;
            --wp--preset--color--vivid-red: #cf2e2e;
            --wp--preset--color--luminous-vivid-orange: #ff6900;
            --wp--preset--color--luminous-vivid-amber: #fcb900;
            --wp--preset--color--light-green-cyan: #7bdcb5;
            --wp--preset--color--vivid-green-cyan: #00d084;
            --wp--preset--color--pale-cyan-blue: #8ed1fc;
            --wp--preset--color--vivid-cyan-blue: #0693e3;
            --wp--preset--color--vivid-purple: #9b51e0;
            --wp--preset--gradient--vivid-cyan-blue-to-vivid-purple: linear-gradient(135deg, rgba(6, 147, 227, 1) 0%, rgb(155, 81, 224) 100%);
            --wp--preset--gradient--light-green-cyan-to-vivid-green-cyan: linear-gradient(135deg, rgb(122, 220, 180) 0%, rgb(0, 208, 130) 100%);
            --wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange: linear-gradient(135deg, rgba(252, 185, 0, 1) 0%, rgba(255, 105, 0, 1) 100%);
            --wp--preset--gradient--luminous-vivid-orange-to-vivid-red: linear-gradient(135deg, rgba(255, 105, 0, 1) 0%, rgb(207, 46, 46) 100%);
            --wp--preset--gradient--very-light-gray-to-cyan-bluish-gray: linear-gradient(135deg, rgb(238, 238, 238) 0%, rgb(169, 184, 195) 100%);
            --wp--preset--gradient--cool-to-warm-spectrum: linear-gradient(135deg, rgb(74, 234, 220) 0%, rgb(151, 120, 209) 20%, rgb(207, 42, 186) 40%, rgb(238, 44, 130) 60%, rgb(251, 105, 98) 80%, rgb(254, 248, 76) 100%);
            --wp--preset--gradient--blush-light-purple: linear-gradient(135deg, rgb(255, 206, 236) 0%, rgb(152, 150, 240) 100%);
            --wp--preset--gradient--blush-bordeaux: linear-gradient(135deg, rgb(254, 205, 165) 0%, rgb(254, 45, 45) 50%, rgb(107, 0, 62) 100%);
            --wp--preset--gradient--luminous-dusk: linear-gradient(135deg, rgb(255, 203, 112) 0%, rgb(199, 81, 192) 50%, rgb(65, 88, 208) 100%);
            --wp--preset--gradient--pale-ocean: linear-gradient(135deg, rgb(255, 245, 203) 0%, rgb(182, 227, 212) 50%, rgb(51, 167, 181) 100%);
            --wp--preset--gradient--electric-grass: linear-gradient(135deg, rgb(202, 248, 128) 0%, rgb(113, 206, 126) 100%);
            --wp--preset--gradient--midnight: linear-gradient(135deg, rgb(2, 3, 129) 0%, rgb(40, 116, 252) 100%);
            --wp--preset--duotone--dark-grayscale: url('#wp-duotone-dark-grayscale');
            --wp--preset--duotone--grayscale: url('#wp-duotone-grayscale');
            --wp--preset--duotone--purple-yellow: url('#wp-duotone-purple-yellow');
            --wp--preset--duotone--blue-red: url('#wp-duotone-blue-red');
            --wp--preset--duotone--midnight: url('#wp-duotone-midnight');
            --wp--preset--duotone--magenta-yellow: url('#wp-duotone-magenta-yellow');
            --wp--preset--duotone--purple-green: url('#wp-duotone-purple-green');
            --wp--preset--duotone--blue-orange: url('#wp-duotone-blue-orange');
            --wp--preset--font-size--small: 13px;
            --wp--preset--font-size--medium: 20px;
            --wp--preset--font-size--large: 36px;
            --wp--preset--font-size--x-large: 42px;
        }

        .has-black-color {
            color: var(--wp--preset--color--black) !important;
        }

        .has-cyan-bluish-gray-color {
            color: var(--wp--preset--color--cyan-bluish-gray) !important;
        }

        .has-white-color {
            color: var(--wp--preset--color--white) !important;
        }

        .has-pale-pink-color {
            color: var(--wp--preset--color--pale-pink) !important;
        }

        .has-vivid-red-color {
            color: var(--wp--preset--color--vivid-red) !important;
        }

        .has-luminous-vivid-orange-color {
            color: var(--wp--preset--color--luminous-vivid-orange) !important;
        }

        .has-luminous-vivid-amber-color {
            color: var(--wp--preset--color--luminous-vivid-amber) !important;
        }

        .has-light-green-cyan-color {
            color: var(--wp--preset--color--light-green-cyan) !important;
        }

        .has-vivid-green-cyan-color {
            color: var(--wp--preset--color--vivid-green-cyan) !important;
        }

        .has-pale-cyan-blue-color {
            color: var(--wp--preset--color--pale-cyan-blue) !important;
        }

        .has-vivid-cyan-blue-color {
            color: var(--wp--preset--color--vivid-cyan-blue) !important;
        }

        .has-vivid-purple-color {
            color: var(--wp--preset--color--vivid-purple) !important;
        }

        .has-black-background-color {
            background-color: var(--wp--preset--color--black) !important;
        }

        .has-cyan-bluish-gray-background-color {
            background-color: var(--wp--preset--color--cyan-bluish-gray) !important;
        }

        .has-white-background-color {
            background-color: var(--wp--preset--color--white) !important;
        }

        .has-pale-pink-background-color {
            background-color: var(--wp--preset--color--pale-pink) !important;
        }

        .has-vivid-red-background-color {
            background-color: var(--wp--preset--color--vivid-red) !important;
        }

        .has-luminous-vivid-orange-background-color {
            background-color: var(--wp--preset--color--luminous-vivid-orange) !important;
        }

        .has-luminous-vivid-amber-background-color {
            background-color: var(--wp--preset--color--luminous-vivid-amber) !important;
        }

        .has-light-green-cyan-background-color {
            background-color: var(--wp--preset--color--light-green-cyan) !important;
        }

        .has-vivid-green-cyan-background-color {
            background-color: var(--wp--preset--color--vivid-green-cyan) !important;
        }

        .has-pale-cyan-blue-background-color {
            background-color: var(--wp--preset--color--pale-cyan-blue) !important;
        }

        .has-vivid-cyan-blue-background-color {
            background-color: var(--wp--preset--color--vivid-cyan-blue) !important;
        }

        .has-vivid-purple-background-color {
            background-color: var(--wp--preset--color--vivid-purple) !important;
        }

        .has-black-border-color {
            border-color: var(--wp--preset--color--black) !important;
        }

        .has-cyan-bluish-gray-border-color {
            border-color: var(--wp--preset--color--cyan-bluish-gray) !important;
        }

        .has-white-border-color {
            border-color: var(--wp--preset--color--white) !important;
        }

        .has-pale-pink-border-color {
            border-color: var(--wp--preset--color--pale-pink) !important;
        }

        .has-vivid-red-border-color {
            border-color: var(--wp--preset--color--vivid-red) !important;
        }

        .has-luminous-vivid-orange-border-color {
            border-color: var(--wp--preset--color--luminous-vivid-orange) !important;
        }

        .has-luminous-vivid-amber-border-color {
            border-color: var(--wp--preset--color--luminous-vivid-amber) !important;
        }

        .has-light-green-cyan-border-color {
            border-color: var(--wp--preset--color--light-green-cyan) !important;
        }

        .has-vivid-green-cyan-border-color {
            border-color: var(--wp--preset--color--vivid-green-cyan) !important;
        }

        .has-pale-cyan-blue-border-color {
            border-color: var(--wp--preset--color--pale-cyan-blue) !important;
        }

        .has-vivid-cyan-blue-border-color {
            border-color: var(--wp--preset--color--vivid-cyan-blue) !important;
        }

        .has-vivid-purple-border-color {
            border-color: var(--wp--preset--color--vivid-purple) !important;
        }

        .has-vivid-cyan-blue-to-vivid-purple-gradient-background {
            background: var(--wp--preset--gradient--vivid-cyan-blue-to-vivid-purple) !important;
        }

        .has-light-green-cyan-to-vivid-green-cyan-gradient-background {
            background: var(--wp--preset--gradient--light-green-cyan-to-vivid-green-cyan) !important;
        }

        .has-luminous-vivid-amber-to-luminous-vivid-orange-gradient-background {
            background: var(--wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange) !important;
        }

        .has-luminous-vivid-orange-to-vivid-red-gradient-background {
            background: var(--wp--preset--gradient--luminous-vivid-orange-to-vivid-red) !important;
        }

        .has-very-light-gray-to-cyan-bluish-gray-gradient-background {
            background: var(--wp--preset--gradient--very-light-gray-to-cyan-bluish-gray) !important;
        }

        .has-cool-to-warm-spectrum-gradient-background {
            background: var(--wp--preset--gradient--cool-to-warm-spectrum) !important;
        }

        .has-blush-light-purple-gradient-background {
            background: var(--wp--preset--gradient--blush-light-purple) !important;
        }

        .has-blush-bordeaux-gradient-background {
            background: var(--wp--preset--gradient--blush-bordeaux) !important;
        }

        .has-luminous-dusk-gradient-background {
            background: var(--wp--preset--gradient--luminous-dusk) !important;
        }

        .has-pale-ocean-gradient-background {
            background: var(--wp--preset--gradient--pale-ocean) !important;
        }

        .has-electric-grass-gradient-background {
            background: var(--wp--preset--gradient--electric-grass) !important;
        }

        .has-midnight-gradient-background {
            background: var(--wp--preset--gradient--midnight) !important;
        }

        .has-small-font-size {
            font-size: var(--wp--preset--font-size--small) !important;
        }

        .has-medium-font-size {
            font-size: var(--wp--preset--font-size--medium) !important;
        }

        .has-large-font-size {
            font-size: var(--wp--preset--font-size--large) !important;
        }

        .has-x-large-font-size {
            font-size: var(--wp--preset--font-size--x-large) !important;
        }
    </style>

    <link rel="https://api.w.org/" href="https://xedienvietthanh.com/wp-json/"/>
    <link rel="alternate" type="application/json" href="https://xedienvietthanh.com/wp-json/wp/v2/categories/189"/>
    <!-- start Simple Custom CSS and JS -->
    <style type="text/css">
        /* Add your CSS code here.

        For example:
        .example {
            color: red;
        }

        For brushing up on your CSS knowledge, check out http://www.w3schools.com/css/css_syntax.asp

        End of comment */

        @media (max-width: 480px) {
            .navhome a, .more-menu-target {
                border: solid 1px #f26e23 !important;
            }

            footer .dongke1.pad15 {
                padding-bottom: 80px;
            }

            .diachi .footer-2 li.bando-maps {
                position: relative;
                padding: 5px 0 10px 22px !important;
            }

            .diachi .footer-2 .bando-maps a {
                color: #337ab7;
            }

            .diachi .footer-2 .bando-maps p {
                font-size: 15px;
                line-height: 1.4;
                height: auto;
                text-align: left !important;
                display: block;
            }

            .diachi .footer-2 li.bando-maps:before {
                position: absolute !important;
                left: 0 !important;
                top: 10px !important;
                transform: none !important;
            }

            .list-footer-fixed li a, p {
                height: auto;
                line-height: 1.5
            }

            .dongke1 ul li {
                position: relative;
                padding-left: 15px;
            }

            .dongke1 ul li:before {

            }

            .footer .lienhe label {
                font-size: 16px;
                margin-bottom: 15px;
                text-align: center;
                display: block;
            }

            .footer .lienhe p {
                flex-direction: row;
                height: auto;
                margin-bottom: 14px;
                font-size: 15px;
                text-align: left;
                font-weight: 700;
            }

            .footer .lienhe p a {
                font-weight: 400;
            }

            .footer .col-xs-6:first-child li, .footer .col-xs-6:nth-child(2) li {
                padding: 0;
            }

            .footer .col-xs-6:first-child li:first-child, .footer .col-xs-6:nth-child(2) li:first-child {
                text-align: center;
                font-size: 14px;
                font-weight: 700;
                margin-bottom: 10px;
            }

            .footer .col-xs-6:first-child li p, .footer .col-xs-6:nth-child(2) li p {
                height: auto;
                display: block;
                text-align: center;
                font-size: 14px;
            }
        }</style>
    <!-- end Simple Custom CSS and JS -->


    <script type="application/ld+json" class="saswp-schema-markup-output">
        [{"@context":"https://schema.org/","@type":"Product","@id":"189","url":"https://xedienvietthanh.com/xe-may-dien/xe-may-dien-tailg-cone/","name":"xe máy điện","sku":"","description":"Hệ thống xe điện Việt Thanh chuyên phân phối các loại xe máy điện của các hãng Yadea, Vinfast, Honda, Giant, Aima, Vespa, Zoomer, xe máy điện 3 bánh,...","brand":{"@type":"Brand","name":""},"offers":{"@type":"AggregateOffer","availability":"BackOrder","itemCondition":"NewCondition","price":"0","priceCurrency":"VND","url":"https://xedienvietthanh.com/xe-may-dien/xe-may-dien-tailg-cone/","priceValidUntil":"2023-01-30T00:00:00Z","highPrice":"0","lowPrice":"0","offerCount":"66","seller":{"@type":"Organization","name":""},"priceSpecification":{"@type":"priceSpecification","valueAddedTaxIncluded":""}},"gtin8":"","color":"","gtin13":"","gtin12":"","mpn":"","additionalType":"","image":[{"@type":"ImageObject","url":"https://xedienvietthanh.com/wp-content/uploads/2022/12/xe-may-dien-tailg-cone-1-1200x675.jpg","width":1200,"height":675,"@id":"https://xedienvietthanh.com/xe-may-dien/xe-may-dien-tailg-cone/#primaryimage"}]},

        {"@context":"https://schema.org/","@type":"Article","@id":"https://xedienvietthanh.com/xe-may-dien/xe-may-dien-tailg-cone/#Article","url":"https://xedienvietthanh.com/xe-may-dien/xe-may-dien-tailg-cone/","inLanguage":"vi","mainEntityOfPage":"https://xedienvietthanh.com/xe-may-dien/xe-may-dien-tailg-cone/","headline":"XE MÁY ĐIỆN TAILG CONE","description":"Xe máy điện TAILG CONE là mẫu xe máy điện được ưa chuộng hiện nay của nhà TAILG. Hãy cùng chúng tôi tìm hiểu về mẫu xe này nhé!","articleBody":"Xe máy điện TAILG CONE là phiên bản mới được tích hợp nhiều công nghệ tiên tiến hiện đại của nhà TAILG. Hôm nay, hãy đồng hành cùng Xe điện Việt Thanh khám phá những ưu điểm của mẫu xe này nhé!  Thiết kế xe máy điện TAILG CONE  Xe máy điện TAILG CONE được thiết kế vô cùng hiện đại và phong cách, phù hợp với giới trẻ hiện nay. Thiết kế độc đáo của xe điện sẽ khiến bạn luôn nổi bật và thu hút khi di chuyển.    Linh kiện đều được sản xuất độc quyền tại nhà TAILG, từng chi tiết đều được tỉ mỉ mà tạo thành. Nhựa xe có khả năng chống chọi với thời tiết cao. Có thể chịu nắng chịu mưa với thời tiết khắc nghiệt tại Việt Nam.    Xe được trang bị cốp siêu rộng, có thể để đồ thoải mái. Yên xe êm ái, giúp bạn thoải mái khi đi đường xa. Có thể rộng ngồi 2 người, cũng có thể dễ dàng để chở đồ hay thú cưng.     Xe máy điện TAILG CONE  Hệ thống đèn xe, đầu xe mới lạ  Toàn bộ hệ thống đèn xe đều được sử dụng đèn Led hiện đại, cho khả năng chiếu sáng tốt hơn với đèn Halogen hiện nay. Xe có thể chiếu sáng xuyên màn đêm, khiến bạn an tâm hơn khi di chuyển trên những cung đường tối.    TAILG còn thiết kế cho dòng xe máy điện CONE này một dải đèn Led ở ngay trên đầu xe khá bắt mắt và hiện đại. Vậy nên, xe sẽ được nổi bật hơn hẳn khi di chuyển vào buổi tối. Đây cũng là một điểm giúp xe khác biệt với những dòng xe khác.  Động cơ tiêu chuẩn, chất lượng, bền bỉ  Hệ thống động cơ của xe máy điện siêu bền bỉ, đạt tiêu chuẩn chất lượng. Xe có thể di chuyển ổn định ngay cả khi đi trời mưa hay đường ngập. Vận tốc tối đa 45km/h, rất an toàn khi di chuyển cho học sinh và sinh viên nhé. Quãng đường tối đa khi di chuyển khoảng 60km/ 1 lần sạc. Xe được trang bị bình ắc quy 72V-20Ah hiện đại.    Hiện tại, mẫu xe điện TAILG CONE đã có sẵn tại cửa hàng Xe điện Việt Thanh. Khách hàng muốn mua xe hãy liên hệ ngay hôm nay để rinh về em xe siêu chất nhé!","keywords":"","datePublished":"2022-12-15T09:05:24+07:00","dateModified":"2022-12-15T09:05:24+07:00","author":{"@type":"Person","name":"hapham","url":"https://xedienvietthanh.com/author/hapham/","sameAs":[],"image":{"@type":"ImageObject","url":"https://secure.gravatar.com/avatar/b1e5a0e0db74b9ff495e33d3ddd074b9?s=96&d=mm&r=g","height":96,"width":96}},"editor":{"@type":"Person","name":"hapham","url":"https://xedienvietthanh.com/author/hapham/","sameAs":[],"image":{"@type":"ImageObject","url":"https://secure.gravatar.com/avatar/b1e5a0e0db74b9ff495e33d3ddd074b9?s=96&d=mm&r=g","height":96,"width":96}},"publisher":{"@type":"Organization","name":"Hệ Thống Xe Điện Việt Thanh &#8211; Bán xe máy 50cc &#8211; Xe đạp điện &#8211; Xe máy điện chính hãng, nhập khẩu","url":"https://xedienvietthanh.com"},"image":[{"@type":"ImageObject","url":"https://xedienvietthanh.com/wp-content/uploads/2022/12/xe-may-dien-tailg-cone-1-1200x675.jpg","width":1200,"height":675,"@id":"https://xedienvietthanh.com/xe-may-dien/xe-may-dien-tailg-cone/#primaryimage"}]}]
    </script>

    <link rel="icon"
          href="https://xedienvietthanh.com/wp-content/uploads/2022/12/cropped-logo-xe-dien-viet-thanh-favicon-2-32x32.png"
          sizes="32x32"/>
    <link rel="icon"
          href="https://xedienvietthanh.com/wp-content/uploads/2022/12/cropped-logo-xe-dien-viet-thanh-favicon-2-192x192.png"
          sizes="192x192"/>
    <link rel="apple-touch-icon"
          href="https://xedienvietthanh.com/wp-content/uploads/2022/12/cropped-logo-xe-dien-viet-thanh-favicon-2-180x180.png"/>
    <meta name="msapplication-TileImage"
          content="https://xedienvietthanh.com/wp-content/uploads/2022/12/cropped-logo-xe-dien-viet-thanh-favicon-2-270x270.png"/>
    <style type="text/css" id="wp-custom-css">
        .top-header {
            background: #515154;
        }

        .old-price .price {
            color: #d6d6d6 !important;
        }

        .cl_2cc332, .regular-price .price, .product-box .product-price, .details-product .product-price {
            color: #f26e23 !important;
        }

        .btn-success {
            background-color: #fff !important;
            border-color: #999 !important;
            font-weight: bold !important;
            color: #f26e23 !important;
        }

        .bk-btn-installment-list {
            background-color: #fff !important;
            border-color: #999 !important;
            color: #4184e9 !important;
            font-weight: bold !important;
        }

        .btn-success:hover, .bk-btn-installment-list:hover {
            background-color: #f26e23 !important;
            border-color: #f26e23 !important;
            font-weight: bold !important;
            color: #000 !important;
        }

        .alm-btn-wrap .btn-show-more-2018 {
            background-color: #f26e23 !important;
        }

        .table-news, footer .payment_method label {
            background-color: #383838 !important;
        }

        footer .payment_method {
            border-top: solid 1px #fc6e0f !important;
            border-bottom: solid 1px #515154 !important;
        }

        .navhome a {
            border: solid 1px #f26e23 !important;
        }

        .table-news td {
            border-top: 0px !important;
        }

        .price-box .special-offers, .item .ico-moi, .subcribe_box input[type="submit"], .table-news td:nth-child(1):hover, .table-news td:nth-child(2):hover, .table-news td:nth-child(3):hover, .table-news td:nth-child(4):hover, .table-news td:nth-child(5):hover, .m--loop-special-offers, .product-show-more span, .diachi .khuvuc {
            background-color: #f26e23 !important;
        }

        #inline_content .wp-block-image img, .the_content img {
            width: auto !important;
            height: 100% !important;
        }

        .main_content p, #slide_about .intro {
            color: #000 !important;
        }

        .details-product .dathang {
            display: flex !important;
            justify-content: center;
        }

        .dathang .bk-btn-paynow, .dathang .bk-btn-installment {
        + height: 90 px;
        }        </style>
    <noscript>
        <style id="rocket-lazyload-nojs-css">.rll-youtube-player, [data-lazy-src] {
                display: none !important;
            }</style>
    </noscript>
    <meta property="fb:app_id" content="713800309118828"/>

    <!-- Google Tag Manager 29.01.2021 -->

    <script type="rocketlazyloadscript">(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-N7XLR8S');
    </script>
    <!-- End Google Tag Manager -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script type="rocketlazyloadscript" async src="https://www.googletagmanager.com/gtag/js?id=UA-173477638-1"></script>
    <!--  <script type="rocketlazyloadscript" data-minify="1" src="https://xedienvietthanh.com/wp-content/cache/min/1/jquery-3.5.1.min.js?ver=1694882034" crossorigin="anonymous" defer></script> -->
    <script type="rocketlazyloadscript">
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        gtag('config', 'UA-173477638-1');
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script type="rocketlazyloadscript" async src="https://www.googletagmanager.com/gtag/js?id=G-LRYXZXF44S"></script>
    <!--  <script type="rocketlazyloadscript" data-minify="1" src="https://xedienvietthanh.com/wp-content/cache/min/1/jquery-3.5.1.min.js?ver=1694882034" crossorigin="anonymous" defer></script> -->
    <script type="rocketlazyloadscript">
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        gtag('config', 'G-LRYXZXF44S');
    </script>
    <!-- Meta Pixel Code -->
    <script type="rocketlazyloadscript">
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1940869732771843');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=1940869732771843&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Meta Pixel Code -->
</head>

<style>#kinhnghiemhay {
        max-height: 40px;
        overflow: hidden;
    }</style>
<body class="archive category category-xe-may-dien category-189 category-template-category-products-php"
      data-spy="scroll" data-target=".navbar" data-offset="60">
<!-- Google Tag Manager (noscript) 29.01.2021-->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N7XLR8S"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

<header id="header">

    <div class="top-header">
        <div class="container">

            <div class="sup-online">

                <a href="tel:{{$shop_info->phone}}" title="Tổng Đài {{$shop_info->phone}}">Tổng Đài hỗ trợ {{$shop_info->phone}}</a>

            </div>
        </div>
    </div>

    <div class="mid-header over-hidden">

        <div class="container">
            <div class="d-flex w100">

                <div class=" wrlogo relative">

                    <div class="logo">

                        <div class="wrap-logo">

                            <a href="{{env('APP_URL')}}"
                               title="{{$shop_info->name}}">

                                <h1
                                    class="none">{{$shop_info->name}}</h1>
                                <img width="400" height="49"
                                     src="{{env('APP_URL').'/documents/website/'.$shop_info->logo}}"
                                     alt="{{$shop_info->description}}"
                                     class="+img-fix img-responsive"
                                     data-lazy-src="{{env('APP_URL').'/documents/website/'.$shop_info->logo}}">
                                <noscript><img width="400" height="49"
                                               src="{{env('APP_URL').'/documents/website/'.$shop_info->logo}}"
                                               alt="{{$shop_info->description}}"
                                               class="+img-fix img-responsive"></noscript>
                            </a>

                        </div>

                    </div>

                    <i class="fa fa-bars fa-lg m-nav-menu mobile"></i>

                </div>

                <div class=" wrmainnav xedien2018">

                    <div class="row">

                        <form class="search col-md-4 no-border form-inline" method="get"
                              action="{{route('tim-kiem')}}" role="search">

                            <input class="search-input form-control" type="search" name="search"
                                   placeholder="Tên sản phẩm bạn muốn tìm" style="width: 210px;">

                            <button class="search-submit fa fa-search btn cl_2cc332" type="submit"
                                    title="search"></button>

                        </form>


                        <div class="col-md-4 text-center">

                            <a href="#"
                               title="{{$shop_info->slogan}}"><span>{{$shop_info->slogan}}</span></a>

                        </div>


                        <style>#kinhnghiemhay .bx-wrapper {
                                background: transparent !important;
                                border: 0 !important;
                                box-shadow: none !important;
                            }</style>

                        <div class="col-md-4 text-left" id="kinhnghiemhay">




                            <ul class="slider-kinhnghiemhay">


                                <li>
                                    <a href="#"
                                       title="{{$shop_info->slogan2}}"><span>{{$shop_info->slogan2}}</span></a>
                                </li>




                            </ul>


                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>

    <nav class="text-center destop" style="border-top: 2px solid #fe6702">

        <ul id="mainnav" class="nav nav-menu destop">
            @foreach($shop_categorys as $key => $shop_cate)
                <li id="menu-item-2098"
                    class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-2098">
                    <a href="{{route('danh-muc-san-pham',$shop_cate->slug)}}">{{$shop_cate->title}}</a>
                    <ul class="sub-menu">
                        @foreach($shop_category_custom as $key1 => $shop_cate_cus)
                            @if($shop_cate_cus->shop_category_id == $shop_cate->id)
                                <li id="menu-item-28385"
                                    class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-28385">
                                    <a href="{{route('danh-muc-san-pham-con',$shop_cate_cus->slug)}}">{{$shop_cate_cus->title}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            @endforeach
            <li id="menu-item-2098"
                class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-2098">
                <a href="{{route('danh-sach-bai-viet')}}">Tin tức</a>
                <ul class="sub-menu">
                    @foreach($cms_category as $key1 => $cms_cate)

                        <li id="menu-item-28385"
                            class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-28385">
                            <a href="{{route('danh-muc-bai-viet',$cms_cate->uniquekey)}}">{{$cms_cate->title}}</a></li>

                    @endforeach
                </ul>
            </li>
        </ul>


    </nav>




</header>


<!-- <link rel="stylesheet" href="https://pc.baokim.vn/css/bk.css"> -->

@include('page.includes.narbar')
<section class="main">
    <div class="container">
        <div class="title2">
            <h1 class="tit">Kết quả tìm kiếm: {{$search}}</h1>
            <span class="gach"></span>
        </div>
        <div id="result_cate_page" class="cate-items-products row">

            @foreach($list_product as $key => $product)

                <!-- loop product -->
                <div class="col-xs-12 col-lg-4 col-md-4 display-pt10 item">
                    <div class="col-item">
                        <div class="item-inner">
                            <div class="product-wrapper transition">
                                <a href="{{route('thong-tin-san-pham',$product->slug)}}"
                                   title="{{$product->name}}">
                                    <img width="367" height="248" alt="{{$product->name}}"
                                         src="{{env('APP_URL') . '/documents/website/'.$product->imagemain}}"
                                         data-src="{{env('APP_URL') . '/documents/website/'.$product->imagemain}}"
                                         class="lazy lazyload transition">
                                </a>
                                <span class="icon ico-default ">Mặc định</span></div>
                            <div class="item-info">
                                <h5 class="item-title text-uppercase"><a class="bk-product-name"
                                                                         href="{{route('thong-tin-san-pham',$product->slug)}}"
                                                                         title="{{$product->name}}">{{$product->name}}</a></h5>
                                <input type="hidden" value="1" class="bk-product-qty">
                                <div class="item-price">
                                    <span class="old-price"><span class="price ">{{$product->price}}</span></span>
                                    <span class="regular-price"><span
                                            class="price bk-product-price">{{$product->price}}</span></span>
                                </div>
                            </div>
                            <div class="item-detail">
                                <!-- case: choose gift on product -->
                                <div class="item-offers">
                                    - Quà tặng trị giá tới 500K <br/> - Áp dụng giao hàng toàn quốc<br/>
                                </div>

                                <!-- case: choose gift on parent taxonomy -->


                                <div class="item-link">
                                    <button data-name="{{$product->name}}"
                                            data-image="{{env('APP_URL') . '/documents/website/'.$product->imagemain}}"
                                            data-price="{{$product->price}}"
                                            class="btn btn-success bk-btn-paynow-list" id="" type="button"
                                            style="width: 122px; height: 25px; margin-top: -3px; font-size: 11px;">MUA NGAY
                                    </button>
                                    <button data-name="{{$product->name}}"
                                            data-image="{{env('APP_URL') . '/documents/website/'.$product->imagemain}}"
                                            data-price="{{$product->price}}"
                                            class="btn bk-btn-installment-list" id="" type="button"
                                            style="width: 122px; height: 25px; margin-top: 5px; font-size: 11px; margin-left: 0px">
                                        MUA
                                        TRẢ GÓP
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
            <!-- loop product -->


            <!-- loop product -->

            <!-- loop product -->


            <!-- /article -->


        </div>
        <div class="clearfix"></div>
        <div class="text-center">
            {!!$list_product->appends(['search' => $search])->links("pagination::bootstrap-4")!!}
        </div>
    </div>
</section>
<!-- /main-content -->
<style>
    .overhiden {
        overflow: hidden
    }
</style>
<section class="acquy_phutung_2019">
    <div class="container">
        <div class="row">

            <div class="col-xs-12 ">
                <div class="head-title font30 text-uppercase h2"><a href="{{route('danh-muc-san-pham','ac-quy')}}">ắc quy
                        chính hãng</a>
                </div>
                <div class="owl-carousel overhiden" id="owl-acquy-2019">
                    <!-- loop product -->
                    @foreach($list_products_l2 as $key => $product_l2)

                        <div class="display-pt10 item-special">
                            <div class="col-item">
                                <div class="item-inner">
                                    <div class="product-wrapper">
                                        <a href="{{route('thong-tin-san-pham',$product_l2->slug)}}" title="{{$product_l2->name}}">
                                            <img src="{{env('APP_URL').'/documents/website/'.$product_l2->imagemain}}" data-src="{{env('APP_URL').'/documents/website/'.$product_l2->imagemain}}" class="lazyload img-full transition lazy lazyload wp-post-image" alt="" loading="lazy" /></a>
                                    </div>
                                    <div class="item-info">
                                        <h5 class="item-title text-uppercase"><a href="{{route('thong-tin-san-pham',$product_l2->slug)}}" title="{{$product_l2->name}}">{{$product_l2->name}}</a></h5>
                                        <div class="item-price">
                                            <span class="old-price"><span class="price">{{$product_l2->old_price}}</span></span>
                                            <span class="regular-price"><span class="price">{{$product_l2->price}}</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                    <!-- loop product -->
                    <!-- loop product -->

                    <!-- loop product -->
                </div>
            </div>

            <div class="col-xs-12 ">
                <div class="head-title font30 text-uppercase h2"><a
                        href="{{route('danh-muc-san-pham','phu-tung')}}">phụ tùng chính hãng</a>
                </div>
                <div class="owl-carousel overhiden" id="owl-phutung-2019">
                    <!-- loop product -->
                    @foreach($list_products_l3 as $key => $product_l3)
                        <div class="display-pt10 item-special">
                            <div class="col-item">
                                <div class="item-inner">
                                    <div class="product-wrapper">
                                        <a href="{{route('thong-tin-san-pham',$product_l3->slug)}}" title="{{$product_l3->name}}">
                                            <img src="{{env('APP_URL').'/documents/website/'.$product_l3->imagemain}}" data-src="{{env('APP_URL').'/documents/website/'.$product_l3->imagemain}}" class="lazyload img-full transition lazy lazyload wp-post-image" alt="" loading="lazy" /></a>
                                    </div>
                                    <div class="item-info">
                                        <h5 class="item-title text-uppercase"><a href="{{route('thong-tin-san-pham',$product_l3->slug)}}" title="{{$product_l3->name}}">{{$product_l3->name}}</a></h5>
                                        <div class="item-price">
                                            <span class="old-price"><span class="price">{{$product_l3->old_}}</span></span>
                                            <span class="regular-price"><span class="price">{{$product_l3->price}}</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                    <!-- loop product -->

                    <!-- loop product -->
                </div>
            </div>


        </div>
    </div>
</section>
<nav class="bottom-nav full text-center" style="background: #dfe6e9;">
    <ul id="mainnav" class="nav nav-menu destop">
        @foreach($shop_categorys as $key => $shop_cate)
            <li id="menu-item-2098"
                class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-2098">
                <a href="{{route('danh-muc-san-pham',$shop_cate->slug)}}">{{$shop_cate->title}}</a>
                <ul class="sub-menu">
                    @foreach($shop_category_custom as $key1 => $shop_cate_cus)
                        @if($shop_cate_cus->shop_category_id == $shop_cate->id)
                            <li id="menu-item-28385"
                                class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-28385">
                                <a href="{{route('danh-muc-san-pham-con',$shop_cate_cus->slug)}}">{{$shop_cate_cus->title}}</a></li>
                        @endif
                    @endforeach
                </ul>
            </li>
        @endforeach
        <li id="menu-item-2098"
            class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-2098">
            <a href="{{route('danh-sach-bai-viet')}}">Tin tức</a>
            <ul class="sub-menu">
                @foreach($cms_category as $key1 => $cms_cate)

                    <li id="menu-item-28385"
                        class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-28385">
                        <a href="{{route('danh-muc-bai-viet',$cms_cate->uniquekey)}}">{{$cms_cate->title}}</a></li>

                @endforeach
            </ul>
        </li>
    </ul>
</nav>
<!-- footer -->
<footer class="full" style="background-size: contain;">
    <div class="top_footer">
        <div class="z_container">
            <div class="row">
                <div class="col-xs-12 col-lg-4 col-md-4 widget">
                    <div class="head_widget">
                        <b>Về chúng tôi</b>
                    </div>
                    <ul id="menu-footer" class="list-unstyled">

                        @foreach($shop_policy as $key => $shop_poli)
                            <li id="menu-item-25685"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-25685"><a
                                    href="{{route('chinh-sach',$shop_poli->slug)}}">{{$shop_poli->title}}</a></li>
                        @endforeach
                    </ul>
                    <div class="subcribe_box">
                        <iframe name="hidden_iframe" id="hidden_iframe" style="display:none;"></iframe>
                        <form
                            action="https://docs.google.com/forms/d/e/1FAIpQLScqj-XLahRCGAXEUt_7lSD1eW_Y3IcIqoRwlVI2eu5ej0WPig/formResponse"
                            id="subcribe_box" method="POST" target="hidden_iframe">
                            <p>Đăng ký nhận tin khuyến mãi:</p>
                            <div class="wrap-form">
                                <input type="text" id="name_subcribe"
                                       class="input_subcribe quantumWizTextinputPaperinputInput exportInput"
                                       jsname="YPqjbf" autocomplete="off" tabindex="0" placeholder="Họ và tên"
                                       aria-label="Tên khách hàng" aria-describedby="i.desc.1974043757 i.err.1974043757"
                                       name="entry.792920454" value="" dir="auto" data-initial-dir="auto"
                                       data-initial-value="">
                                <input type="email" placeholder="Email"
                                       class="input_subcribe quantumWizTextinputPaperinputInput exportInput"
                                       jsname="YPqjbf" autocomplete="email" tabindex="0" aria-label="Email của bạn"
                                       name="emailAddress" id="email_subcribe" value="" required="" dir="auto"
                                       data-initial-dir="auto" data-initial-value="">
                                <input type="submit" name="submit" value="Đăng ký" id="ss-submit">
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-xs-12 col-lg-4 col-md-4 widget">
                    <div class="head_widget" style="margin-bottom: 30px;">
                        <a href="/he-thong-mua-hang/"><b>Điểm mua hàng</b></a>
                    </div>
                    <div class="panel-group full marb30 map-footer" id="map-footer">
                        <div class="panel">
                            <div class="panel-heading relative">
                                <div class="panel-title active transition">
                                    <a data-toggle="collapse" data-parent="#map-footer" href="#collapse-0"
                                       class="relative w100 font16 bold"></a>
                                </div>
                            </div>
                            <div id="collapse-0" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <ul class="tab-map-bottom abs list-unstyled">
                                        @foreach($shop_address as $key => $shop_add)
                                            <li class="bold" data-target="tab-00">
                                                <!-- <p class="mar0">Showroom 1: 76-78 Ô Chợ Dừa, Đống Đa, Hà Nội.</p> -->
                                                <p class="mar0"><img alt="{{$shop_add->address}}" width="22"
                                                                     height="22"
                                                                     src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2022%2022'%3E%3C/svg%3E"
                                                                     data-lazy-src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                    <noscript><img alt="{{$shop_add->address}}" width="22"
                                                                   height="22"
                                                                   src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                    </noscript>
                                                    {{$shop_add->address}}
                                                </p>
                                                <p class="mar0" style="padding-left: 22px;">Tư vấn : <a
                                                        href="tel:{{$shop_add->phone}}">{{$shop_add->phone}}</a> <a
                                                        href="{{$shop_add->linkmap}}" target="_blank"
                                                        class="pull-right" rel="nofollow">Xem bản đồ <i
                                                            class="fa fa-external-link"></i></a></p>
                                            </li>
                                        @endforeach


                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <span class="footer_hotline font20" style="display : flex">
              Hotline: <a href="tel:{{$shop_info->phone}}" title="Hotline"><b style="color:red">{{$shop_info->phone}}</b></a>

                          </span>
                <div class="clear"></div>
                <img class="dcma lazyload" width="100" height="32" alt="DCMA"
                     src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                     data-src="https://xedienvietthanh.com/wp-content/themes/auto/images/dmca.png"/> <a
                    target="_blank" rel="nofollow" href="http://online.gov.vn/Home/WebDetails/105086"
                    rel="nofollow"><img width="105" height="39" class="dcma lazyload" alt="bo-cong-thuong"
                                        src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                        data-src="https://xedienvietthanh.com/wp-content/themes/auto/images/bo-cong-thuong.png"/></a>
            </div>
        </div>

    </div>
    </div>
    </div>
    <div class="payment_method hidden-xs hidden-sm">
        <label>Nhận thanh toán</label>
        <img class="lazyload" width="970" height="52" alt="thanh toán"
             src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
             data-src="https://xedienvietthanh.com/wp-content/themes/auto/images/payment_act.jpg"/>
    </div>
    <div class="main_footer">
        <div class="z_container">
            <div class="row">
                <div class="col-xs-12 col-lg-6 col-md-6">
                    {!!$shop_info->footer!!}
                    <!-- <p><a href="http://online.gov.vn/Home/WebDetails/100389" rel="nofollow" target= "_blank"><img src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%200%200'%3E%3C/svg%3E" alt="da thong bao bo cong thuong" data-lazy-src="http://xedienvietthanh.com/wp-content/themes/auto/images/da-thong-bao-bo-cong-thuong-xedienvietthanh.png"><noscript><img src="http://xedienvietthanh.com/wp-content/themes/auto/images/da-thong-bao-bo-cong-thuong-xedienvietthanh.png" alt="da thong bao bo cong thuong"></noscript></a></p> -->
                </div>
                <div class="col-xs-12 col-lg-6 col-md-6 "></div>
            </div>
        </div>
    </div>
</footer>
<div class="call-mobile mobile">
    <a id="callnowbutton" href="tel:0903043333"> <i class="fa fa-phone"></i>0903043333</a>
</div>
<div id="modalVideo" class="modal fade" role="dialog"></div>
<div id="modal-success-subrice" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Đăng ký nhận tin khuyến mại</h4>
            </div>
            <div class="modal-body">
                <div class="text-center">Cảm ơn bạn đã đăng ký. Chúng tôi sẽ gửi bản tin khuyến mại mới nhất tới bạn.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Scrolling Nav JavaScript -->
<!-- <div id="call-hotline" class="">
  <div class="chat_fb transition "><i class="fa fa-comments animated infinite flash"></i> Hotline</div>
  <div class="clear"></div>
  <div id="fchat" class="body-hotline col-xs-12 bg_white">
    </div>
</div> -->

<style>
    #sp2022 {
        position: fixed;
        bottom: 0px;
        right: 15px;
        z-index: 99999999;
    }

    #sp2022 li img {
        width: 30px;
        margin-right: 10px;
    }

    #sp2022 li a {
        border-radius: 40px;
        padding: 2px 15px 2px 5px;
        margin-bottom: 5px;
        background: #fff;
        color: #0065BF;
        border: 1px solid #0065BF
    }

    #sp2022 li p {
        border-radius: 40px;
        padding: 2px 15px 2px 5px;
        margin-bottom: 5px;
        background: #fff;
        color: #0065BF;
        border: 1px solid #0065BF
    }

    #sp2022 a.ccall {
        background: #ff6a00;
        color: #fff;
    }

    #sp2022 p.ccall {
        background: #ff6a00;
        color: #fff;
    }

    #sp2022 li:hover a {
        background-color: rgb(255 255 255 / 80%);
    }

    #sp2022 li:hover p {
        background-color: rgb(255 255 255 / 80%);
        cursor: pointer;
    }

    #sp2022 li:hover a.ccall {
        background-color: rgb(255 106 0 / 80%);
    }

    #sp2022 li:hover p.ccall {
        background-color: rgb(255 106 0 / 80%);
    }

    #flipFlop .modal-dialog {
        max-width: 600px;
    }

    .cl_yellow {
        color: yellow;
    }

    @-webkit-keyframes tada {
        1% {
            -webkit-transform: scale(1);
            transform: scale(1);
        }

        10%, 20% {
            -webkit-transform: scale(0.9) rotate(-3deg);
            transform: scale(0.9) rotate(-3deg);
        }

        30%, 50%, 70%, 90% {
            -webkit-transform: scale(1.1) rotate(3deg);
            transform: scale(1.1) rotate(3deg);
        }

        40%, 60%, 80% {
            -webkit-transform: scale(1.1) rotate(-3deg);
            transform: scale(1.1) rotate(-3deg);
        }

        100% {
            -webkit-transform: scale(1) rotate(0);
            transform: scale(1) rotate(0);
        }
    }

    @keyframes tada {
        1% {
            -webkit-transform: scale(1);
            -ms-transform: scale(1);
            transform: scale(1);
        }

        10%, 20% {
            -webkit-transform: scale(0.9) rotate(-3deg);
            -ms-transform: scale(0.9) rotate(-3deg);
            transform: scale(0.9) rotate(-3deg);
        }

        30%, 50%, 70%, 90% {
            -webkit-transform: scale(1.1) rotate(3deg);
            -ms-transform: scale(1.1) rotate(3deg);
            transform: scale(1.1) rotate(3deg);
        }

        40%, 60%, 80% {
            -webkit-transform: scale(1.1) rotate(-3deg);
            -ms-transform: scale(1.1) rotate(-3deg);
            transform: scale(1.1) rotate(-3deg);
        }

        100% {
            -webkit-transform: scale(1) rotate(0);
            -ms-transform: scale(1) rotate(0);
            transform: scale(1) rotate(0);
        }
    }

    .tada {
        -webkit-animation-name: tada;
        animation-name: tada;
    }

    .animated {
        -webkit-animation-duration: 1.3s;
        animation-duration: 1.3s;
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both;
    }

    .animated.infinite {
        animation-iteration-count: infinite;
    }

    #sp2022 .wpcf7-spinner {
        display: none;
        margin: 0 auto
    }

    #sp2022 .sdt input {
        border-color: #ff6a00;
    }

    .btn-save-phone {
        max-width: 200px;
        margin: 0 auto;
        display: inline-block;
        height: 40px;
        line-height: 40px;
        padding: 0 20px;
        border-radius: 20px;
        -webkit-border-radius: 20px;
        -moz-border-radius: 20px;
        -ms-border-radius: 20px;
        -o-border-radius: 20px;
        background-color: #ff6a00;
        color: #ffffff;
        -webkit-box-shadow: 0 0 3px 3px #ccc;
        box-shadow: 0 0 3px 3px #ccc;
        border: none;
    }

    p.line-hoac::before {
        content: "";
        display: block;
        width: 100%;
        height: 2px;
        position: absolute;
        left: 0;
        top: calc(50% - 1px);
        background-color: #ff6a00;
    }

    p.line-hoac {
        position: relative;
    }

    p.line-hoac span {
        position: relative;
        padding: 0 10px;
        background-color: #fff;
    }

    .list-hotline li a {
        width: 100%;
        display: inline-block;
        background-color: #ff6a00;
        color: #ffffff;
        text-transform: uppercase;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        -ms-border-radius: 5px;
        -o-border-radius: 5px;
        -webkit-box-shadow: 0 0 3px 3px #ccc;
        box-shadow: 0 0 3px 3px #ccc;
        padding: 5px 10px;
    }

    .list-hotline li {
        margin-bottom: 10px;
        display: block;
        width: 100%;
        border-radius: 10px;
    }

    .list-hotline li a:hover {
        background-color: #aeaeae;
    }

    .list-hotline li a span.hotline-title {
        font-size: 11px;
        font-weight: normal;
        margin-bottom: 3px;
        text-transform: none;
    }

    .list-hotline li a span {
        display: block;
        width: 100%;
        line-height: 1.5;
        font-weight: bold;
        letter-spacing: 1px;
    }

    .list-hotline.abs {
        max-height: 190px;
        overflow-y: scroll !important;
    }
</style>
<div id="sp2022">
    <ul>
        <li>
            <p class="ccall d-flex align-items-center " data-toggle="modal" data-target="#flipFlop">
                <img width="30" height="30"
                     src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2030%2030'%3E%3C/svg%3E"
                     alt="19002082"
                     data-lazy-src="https://xedienvietthanh.com/wp-content/themes/auto/images/2022/telephone.png">
                <noscript><img width="30" height="30"
                               src="https://xedienvietthanh.com/wp-content/themes/auto/images/2022/telephone.png"
                               alt="{{$shop_info->phone}}"></noscript>
                <span class="d-flex flex-column "><span>Gọi miễn phí</span><span
                        class="cl_yellow animated infinite tada">{{$shop_info->phone}}</span></span>
            </p>
        </li>
        <li><a target="_blank" href="{{$shop_info->linkfacebook}}" rel="nofollow" class="cfb d-flex align-items-center">
                <img width="30" height="30"
                     src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2030%2030'%3E%3C/svg%3E"
                     alt="Chat FB"
                     data-lazy-src="https://xedienvietthanh.com/wp-content/themes/auto/images/2022/facebook.png">
                <noscript><img width="30" height="30"
                               src="https://xedienvietthanh.com/wp-content/themes/auto/images/2022/facebook.png"
                               alt="Chat FB"></noscript>
                <span>Chat FB</span>
            </a></li>
        <li><a target="_blank" href="{{$shop_info->linkzalo}}" rel="nofollow"
               class="czalo d-flex align-items-center">
                <img width="30" height="30"
                     src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2030%2030'%3E%3C/svg%3E"
                     alt="Chat Zalo"
                     data-lazy-src="https://xedienvietthanh.com/wp-content/themes/auto/images/2022/zalo-icon.png">
                <noscript><img width="30" height="30"
                               src="https://xedienvietthanh.com/wp-content/themes/auto/images/2022/zalo-icon.png"
                               alt="Chat Zalo"></noscript>
                <span>Chat Zalo</span>
            </a></li>
        {{--        <li><a href="https://xedienvietthanh.com/he-thong-mua-hang/" rel="nofollow"--}}
        {{--               class="cmap d-flex align-items-center">--}}
        {{--                <img width="30" height="30"--}}
        {{--                     src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2030%2030'%3E%3C/svg%3E"--}}
        {{--                     alt="Chỉ đường"--}}
        {{--                     data-lazy-src="https://xedienvietthanh.com/wp-content/themes/auto/images/2022/google-maps.png">--}}
        {{--                <noscript><img width="30" height="30"--}}
        {{--                               src="https://xedienvietthanh.com/wp-content/themes/auto/images/2022/google-maps.png"--}}
        {{--                               alt="Chỉ đường"></noscript>--}}
        {{--                <span>Chỉ đường</span>--}}
        {{--            </a></li>--}}
    </ul>
</div>
</body>
</html>


<style>

    /* cyrillic-ext */


    a {
        color: #000;
        text-decoration: none
    }

    a:hover, a:focus {
        color: #0066cc;
        text-decoration: none
    }

    article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary {
        display: block
    }

    img {
    + max-width: 100 %;
        border: none
    }


    h1, h2, h3, h4, h5, h6 {

        font-family: 'Roboto', sans-serif;

        margin: 0;

        font-size: inherit;

    }

    .wrap {
        width: 100%;
        display: inline-block
    }

    .container {
        width: 100%
    }

    .upper {
        text-transform: uppercase
    }

    .z_container {
        width: 100%;
        padding-left: 35px;
        padding-right: 35px
    }

    .nav-toogle {
        border-radius: 50%;
        color: #679818;
        cursor: pointer;
        position: absolute;
        top: 30px;
        left: 30px;
        font-size: 28px;
        text-align: center;
        z-index: 1;
        display: none
    }

    .clear5px {
        clear: both;
        height: 5px
    }

    .clear10px {
        clear: both;
        height: 10px
    }

    .clear20px {
        clear: both;
        height: 20px
    }

    .clear30px {
        clear: both;
        height: 30px
    }

    .mt10, .mv10, .ma10 {
        margin-top: 10px
    }

    .mb10, .mv10, .ma10 {
        margin-bottom: 10px
    }

    .ml10, .mh10, .ma10 {
        margin-left: 10px
    }

    .mr10, .mh10, .ma10 {
        margin-right: 10px
    }

    .old-price {

        display: inline;

        margin-right: 5px

    }

    .no-padding {
        padding: 0 !important;
    }

    .old-price .price {

        font-size: 16px;

        color: #666;

        text-decoration: line-through;

    }

    .regular-price {

        display: inline;

    }

    .regular-price .price {

        color: #ff0600;

        font-weight: 700;

        font-size: 20px;

    }


    .col-item {

        position: relative;

        background: #FFF;

    }

    .col-item {

        text-align: left;

        float: left;

    + margin-bottom: 30 px;

        width: 100%;

        padding: 8px 8px 25px 8px;

    }

    .col-item .product-wrapper {

        position: relative;

        margin-top: 10px;

        overflow: hidden;

        text-align: center;

        margin-bottom: 7px;

    }

    .col-item .product-wrapper i.icon {

        width: 41px;

        height: 21px;

        position: absolute;

        top: 0px;

        right: 0px;

    }

    .col-item .product-wrapper i.icon-hot {

        background: url(https://xedienvietthanh.com/wp-content/themes/auto/images/icon_hot.png) no-repeat

    }

    .col-item .product-wrapper i.icon-new,
    .col-item .product-wrapper i.icon-moi {

        background: url(https://xedienvietthanh.com/wp-content/themes/auto/images/icon_new.png) no-repeat

    }

    .col-item .product-wrapper i.icon-xa,
    .col-item .product-wrapper i.icon-thanh-ly {

        background: url(https://xedienvietthanh.com/wp-content/themes/auto/images/icon_xa.png) no-repeat

    }

    .col-item .item-title {

        margin-bottom: 5px;

        padding-top: 16px;

        font-size: 20px;

        font-weight: 700;

        white-space: nowrap;

        overflow: hidden;

        text-overflow: ellipsis;

    }

    .col-item .item-price {

        margin: 6px 0;

    }

    .col-item .item-detail {

        display: block;

        height: 65px;

        position: relative;

    }

    .col-item .item-detail .item-offers {

        font-size: 14px;

        height: 65px;

        color: #666;

        background: url(https://xedienvietthanh.com/wp-content/themes/auto/images/icon_offers.png) left 8px no-repeat;

        padding-left: 45px;

    + padding-top: 8 px;

        padding-right: 130px;

    }

    .col-item .item-detail .item-link {

        width: 122px;

        height: 65px;

        position: absolute;

        top: 0px;

        right: 0px;

        text-align: center;

    }


    .col-item .item-detail .item-link a {

        width: 100%;

        padding: 4px 0px;

        display: block;

        color: #fff;

        text-transform: uppercase;

        font-size: 11px;

        background-color: #fc6e0f;

    + border-radius: 0;

        margin-bottom: 7px;

    }

    .col-item .item-detail .item-link a.link-buy {

        background-color: #28b22d;

    }

    .product-show-more {

        text-align: center;

        margin: 10px 0;

    }

    .product-show-more span:hover {
        background: #ff7621;
        color: #fff;
    }


    .product-show-more span {

        cursor: pointer;

        display: inline-block;

        height: 50px;

        line-height: 50px;

        font-size: 24px;

        text-transform: uppercase;

        background: #28b22d;

        padding: 0 50px;

        color: #fff;

        text-align: center;

        white-space: nowrap;

        border-radius: 4px;

    }

    .table-news {

        width: 100%;

        height: 60px;

        background-color: #000000;

        margin-bottom: 15px;

    }

    .table-news td {

        height: 60px;

        text-align: center;

        border-top: 3px solid red;

        line-height: 60px;

    }

    .table-news td:nth-child(1) {

        border-color: #4285f4

    }

    .table-news td:nth-child(2) {

        border-color: #eeb715

    }

    .table-news td:nth-child(3) {

        border-color: #34a853

    }

    .table-news td:nth-child(4) {

        border-color: #ed008c

    }

    .table-news td:nth-child(5) {

        border-color: #ea4335

    }

    .table-news td + td::before {

        content: "";

        background-color: #9a9595;

        float: left;

        width: 2px;

        height: 41px;

        margin-top: 8px;

    }

    .table-news td a {

        color: #fff;

        text-transform: uppercase;

    }

    .box_news_home .col-ext {

        padding: 0 35px;

        margin: 0 4px;

        background: #fff;

    }

    .box_news_home .col-ext-left {
        margin-left: 0;
    }

    .box_news_home .col-ext-right {
        margin-right: 0;
    }

    .box_news_home .heading_box {

        text-align: center;

        text-transform: uppercase;

    }

    .box_news_home .heading_box .title2 {

        font-size: 30px;

        font-weight: 700;

        line-height: 63px;

    }

    .box_news_home .large_item img {

    + max-height: 370 px;

    + margin-bottom: 18 px;

    }

    .box_news_home .lst_item_ext {

        list-style: none;

        outline: medium none;

        margin: 0px;

        padding: 0px;

    }

    .box_news_home .lst_item_ext li {

        width: 100%;

        display: inline-block;

        margin-bottom: 20px;

        cursor: pointer;

        max-height: 470px;

    }

    .box_news_home .lst_item_ext li .photo {

        width: 130px;

        height: 80px;

        float: left;

    }

    .box_news_home .lst_item_ext li .photo img {
        max-width: 100%;
    }

    .box_news_home .lst_item_ext li .r {

        margin-left: 157px;

        vertical-align: top;

    }

    .box_news_home .lst_item_ext li .r h4.title {

        font-size: 14px;

        margin-bottom: 4px;

    }

    .box_news_home .lst_item_ext li .r .reg_date {

        font-size: 11px;

        color: #666

    }

    footer {

        width: 100%;

        background: url(https://xedienvietthanh.com/wp-content/themes/auto/images/footer.jpg) repeat-x;

    }

    .top_footer {

        padding-top: 35px;

        padding-bottom: 35px;

        position: relative;

    }

    .top_footer .head_widget {

        font-size: 30px;

        font-weight: 700;

        text-transform: uppercase;

        position: relative;

        margin-bottom: 55px;

    }

    .top_footer .head_widget:after {

        content: "";

        width: 30px;

        height: 2px;

        background: #fc6e0f;

        position: absolute;

        left: 0px;

        bottom: -15px;

    }

    .top_footer ul li {

        font-size: 14px;

        margin-bottom: 15px;

    }

    .top_footer .album-gallery {

        height: 171px;

        border: solid 1px #fc6e0f;

        overflow: hidden;

        display: inline-block;

        float: left;

    }

    .top_footer .company-map {

        height: 171px;

        border: solid 1px #fc6e0f;

        overflow: hidden;

        display: inline-block

    }

    .subcribe_box {

        margin-top: 10px;

    }

    .subcribe_box .input_subcribe {

        width: 136px;

        border: solid 1px #666;

        margin-right: 10px;

        outline: medium none;

        padding: 3px 5px;

        float: left;

        display: inline-block;

    }

    .subcribe_box input[type=submit] {

        border: none;

        outline: medium none;

        height: 28px;

        background-color: #2fbb04;

        color: #fff;

        padding: 2px 14px;

    }

    .top_footer .company_line {

        margin-top: 18px;

    }

    .top_footer .company_line img {

        vertical-align: top;

    }

    .top_footer .footer_hotline {

        height: 41px;

        line-height: 45px;

        display: inline-block;

        padding-left: 52px;

        margin-right: 10px;

        background: url(https://xedienvietthanh.com/wp-content/themes/auto/images/icon_hotline.png) left center no-repeat;

    }

    .top_footer .dcma {

        margin-right: 10px;

    }

    footer .payment_method {

        width: 100%;

        display: inline-block;

        height: 54px;

        border-top: solid 1px #2fbb04;

        border-bottom: solid 1px #fc6e0f

    }

    footer .payment_method label {

        width: 13%;

        float: left;

        height: 52px;

        line-height: 52px;

        text-align: right;

        background-color: #fc6e0f;

        color: #fff;

        font-weight: 700;

        padding-right: 4px;

        font-size: 16px;

        text-transform: uppercase;

        position: relative;

        margin: 0 50px 0 0;

    }

    footer .payment_method label:after {

        content: "";

        width: 50px;

        height: 52px;

        position: absolute;

        right: -49px;

        top: 0px;

        background: url(https://xedienvietthanh.com/wp-content/themes/auto/images/pm_after.png) no-repeat;

    }

    .main_footer {

        width: 100%;

        display: inline-block;

        background-color: #515154;

        padding-top: 15px;

    + padding-bottom: 35 px;

    }

    .main_footer h2.head {

        color: #fff;

        text-transform: uppercase;

        margin-bottom: 15px;

        font-size: 18px

    }

    .main_footer p {

        font-size: 14px;

        color: #fff;

        margin-bottom: 15px

    }

    .main_footer .statistic span {

        color: #fff;

        margin-right: 15px

    }

    .form-check-bao-hanh .wrap {

    + margin-top: 15 px;

        margin-bottom: 15px;

    }

    .form-check-bao-hanh input[type=text] {

        background-color: #fff;

        background-image: url(https://xedienvietthanh.com/wp-content/themes/auto/images/icon_tool.png);

        background-repeat: no-repeat;

        background-position: 16px center;

        padding-left: 48px;

        padding-right: 10px;

        border: none;

        outline: none;

        width: 272px;

        height: 33px;

        outline: medium none;

        display: inline-block;

        float: left;

    }

    .form-check-bao-hanh input[type=submit] {

        border: none;

        outline: medium none;

        height: 33px;

        background-color: #fff;

        color: #000;

        padding: 2px 14px;

        margin-left: 8px;

        display: inline-block;

        text-transform: uppercase;

        font-weight: 700

    }

    .share_link a {

        width: 24px;

        height: 24px;

        display: inline-block;

        margin-right: 3px;

        background: url(https://xedienvietthanh.com/wp-content/themes/auto/images/icon_fb.png);

    }

    .share_link a.google {

        background-image: url(https://xedienvietthanh.com/wp-content/themes/auto/images/icon_google.png);

    }

    .share_link a.youtube {

        background-image: url(https://xedienvietthanh.com/wp-content/themes/auto/images/icon_youtube.png);

    }


</style>


<script type="rocketlazyloadscript" data-minify="1"
        src="https://xedienvietthanh.com/wp-content/cache/min/1/jquery-3.5.1.min.js?ver=1694882034"
        crossorigin="anonymous" defer></script>

<!-- <script src="https://xedienvietthanh.com/wp-content/themes/auto/js/jquery.min.js"></script> -->
<script type="rocketlazyloadscript" src="https://xedienvietthanh.com/wp-content/themes/auto/js/bootstrap.min.js"
        defer></script>
<script type="rocketlazyloadscript" src="https://xedienvietthanh.com/wp-content/themes/auto/js/jquery.lazyload.min.js"
        defer></script>
<script type="rocketlazyloadscript"
        src="https://xedienvietthanh.com/wp-content/themes/auto/owl-carousel/owl.carousel.min.js" defer></script>

<script type="rocketlazyloadscript"
        src="https://xedienvietthanh.com/wp-content/themes/auto/bxslider/jquery.bxslider.min.js" defer></script>

<script type="rocketlazyloadscript" data-minify="1"
        src="https://xedienvietthanh.com/wp-content/cache/min/1/wp-content/themes/auto/js/scripts.js?ver=1694882037"
        defer></script>
<script type="rocketlazyloadscript" data-rocket-type="text/javascript">
    window.addEventListener("load", function (event) {
        lazyload();
    });

      window.onload = function() {


        function goToByScroll(id){
              id = id.replace("link", "");
            jQuery('html,body').animate({
                scrollTop: jQuery("#"+id).offset().top - 52},'slow');
        }

      }
        function showVideo(id,url){
          document.getElementById(id).removeAttribute('src');
          document.getElementById(id).setAttribute('src',url);
        }
        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
        }
</script>
<script type='text/javascript' src='https://xedienvietthanh.com/wp-content/plugins/ccodon-optimizer/lab.min.js'
        id='ccodon-lab-js'></script>
<script type="rocketlazyloadscript" data-minify="1" data-rocket-type='text/javascript'
        src='https://xedienvietthanh.com/wp-content/cache/min/1/wp-content/plugins/contact-form-7/includes/swv/js/index.js?ver=1694882034'
        id='swv-js' defer></script>
<script type='text/javascript' id='contact-form-7-js-extra'>
    /* <![CDATA[ */
    var wpcf7 = {
        "api": {"root": "https:\/\/xedienvietthanh.com\/wp-json\/", "namespace": "contact-form-7\/v1"},
        "cached": "1"
    };
    /* ]]> */
</script>
<script type="rocketlazyloadscript" data-minify="1" data-rocket-type='text/javascript'
        src='https://xedienvietthanh.com/wp-content/cache/min/1/wp-content/plugins/contact-form-7/includes/js/index.js?ver=1694882034'
        id='contact-form-7-js' defer></script>
<script type="rocketlazyloadscript" data-rocket-type='text/javascript'
        src='https://xedienvietthanh.com/wp-includes/js/jquery/jquery.min.js' id='jquery-core-js' defer></script>
<script type="rocketlazyloadscript" data-rocket-type='text/javascript'
        src='https://xedienvietthanh.com/wp-includes/js/jquery/jquery-migrate.min.js' id='jquery-migrate-js'
        defer></script>
<script type='text/javascript' id='loadmore-js-extra'>
    /* <![CDATA[ */
    var loadmore_params = {
        "ajaxurl": "https:\/\/xedienvietthanh.com\/wp-admin\/admin-ajax.php",
        "term_id": "189",
        "current_page": "1",
        "max_page": "1",
        "num_per_page": "12",
        "post_type": "products"
    };
    /* ]]> */
</script>
<script type="rocketlazyloadscript" data-minify="1" data-rocket-type='text/javascript'
        src='https://xedienvietthanh.com/wp-content/cache/min/1/wp-content/themes/auto/js/loadmore.js?ver=1694882037'
        id='loadmore-js' defer></script>
<script>window.lazyLoadOptions = {
        elements_selector: "img[data-lazy-src],.rocket-lazyload",
        data_src: "lazy-src",
        data_srcset: "lazy-srcset",
        data_sizes: "lazy-sizes",
        class_loading: "lazyloading",
        class_loaded: "lazyloaded",
        threshold: 300,
        callback_loaded: function (element) {
            if (element.tagName === "IFRAME" && element.dataset.rocketLazyload == "fitvidscompatible") {
                if (element.classList.contains("lazyloaded")) {
                    if (typeof window.jQuery != "undefined") {
                        if (jQuery.fn.fitVids) {
                            jQuery(element).parent().fitVids()
                        }
                    }
                }
            }
        }
    };
    window.addEventListener('LazyLoad::Initialized', function (e) {
        var lazyLoadInstance = e.detail.instance;
        if (window.MutationObserver) {
            var observer = new MutationObserver(function (mutations) {
                var image_count = 0;
                var iframe_count = 0;
                var rocketlazy_count = 0;
                mutations.forEach(function (mutation) {
                    for (var i = 0; i < mutation.addedNodes.length; i++) {
                        if (typeof mutation.addedNodes[i].getElementsByTagName !== 'function') {
                            continue
                        }
                        if (typeof mutation.addedNodes[i].getElementsByClassName !== 'function') {
                            continue
                        }
                        images = mutation.addedNodes[i].getElementsByTagName('img');
                        is_image = mutation.addedNodes[i].tagName == "IMG";
                        iframes = mutation.addedNodes[i].getElementsByTagName('iframe');
                        is_iframe = mutation.addedNodes[i].tagName == "IFRAME";
                        rocket_lazy = mutation.addedNodes[i].getElementsByClassName('rocket-lazyload');
                        image_count += images.length;
                        iframe_count += iframes.length;
                        rocketlazy_count += rocket_lazy.length;
                        if (is_image) {
                            image_count += 1
                        }
                        if (is_iframe) {
                            iframe_count += 1
                        }
                    }
                });
                if (image_count > 0 || iframe_count > 0 || rocketlazy_count > 0) {
                    lazyLoadInstance.update()
                }
            });
            var b = document.getElementsByTagName("body")[0];
            var config = {childList: !0, subtree: !0};
            observer.observe(b, config)
        }
    }, !1)</script>
<script data-no-minify="1" async
        src="https://xedienvietthanh.com/wp-content/plugins/wp-rocket/assets/js/lazyload/17.5/lazyload.min.js"></script>
<!-- Google Tag Manager 23-4-2020 -->
<!-- <script type="rocketlazyloadscript">(function(w,d,s,l,i){w[l]=w[l]||f[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-N7XLR8S');</script> -->
<!-- End Google Tag Manager -->
<!-- Vchat -->
<!-- <script type="rocketlazyloadscript" lang="javascript">var _vc_data = {id : 3314176, secret : 'c4d35761ff7f52a9bd393808b0186669'};(function() {var ga = document.createElement('script');ga.type = 'text/javascript';ga.async=true; ga.defer=true;ga.src = '//live.vnpgroup.net/client/tracking.js?id=3314176';var s = document.getElementsByTagName('script');s[0].parentNode.insertBefore(ga, s[0]);})();</script> -->
<!-- chat -->
<!-- <a href="https://m.me/tapdoanxedien" target="_blank" rel="nofollow" id="btn_messenger">
<svg width="60px" height="60px" viewBox="0 0 60 60"><svg x="0" y="0" width="60px" height="60px"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><circle fill="#25982B" cx="30" cy="30" r="30"></circle><svg x="10" y="10"><g transform="translate(0.000000, -10.000000)" fill="#FFFFFF"><g id="logo" transform="translate(0.000000, 10.000000)"><path d="M20,0 C31.2666,0 40,8.2528 40,19.4 C40,30.5472 31.2666,38.8 20,38.8 C17.9763,38.8 16.0348,38.5327 14.2106,38.0311 C13.856,37.9335 13.4789,37.9612 13.1424,38.1098 L9.1727,39.8621 C8.1343,40.3205 6.9621,39.5819 6.9273,38.4474 L6.8184,34.8894 C6.805,34.4513 6.6078,34.0414 6.2811,33.7492 C2.3896,30.2691 0,25.2307 0,19.4 C0,8.2528 8.7334,0 20,0 Z M7.99009,25.07344 C7.42629,25.96794 8.52579,26.97594 9.36809,26.33674 L15.67879,21.54734 C16.10569,21.22334 16.69559,21.22164 17.12429,21.54314 L21.79709,25.04774 C23.19919,26.09944 25.20039,25.73014 26.13499,24.24744 L32.00999,14.92654 C32.57369,14.03204 31.47419,13.02404 30.63189,13.66324 L24.32119,18.45264 C23.89429,18.77664 23.30439,18.77834 22.87569,18.45674 L18.20299,14.95224 C16.80079,13.90064 14.79959,14.26984 13.86509,15.75264 L7.99009,25.07344 Z"></path></g></g></svg></g></g></svg></svg>
</a> -->

<style>
    #btn_messenger {
        cursor: pointer;
        position: fixed;
        right: 18pt;
        bottom: 18pt;
        z-index: 2147483646;
        border-radius: 50%;
        height: 60px;
        width: 60px;
    }

    #btn_messenger:hover {
        box-shadow: 0 5px 24px rgba(0, 0, 0, .3);
    }
</style>

<div id="fb-root"></div>
<script type="rocketlazyloadscript" async defer crossorigin="anonymous"
        src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v5.0"></script>

<script type="rocketlazyloadscript" data-minify="1"
        src="https://xedienvietthanh.com/wp-content/cache/min/1/js/bk_plus_v2.popup.js?ver=1694882034" defer></script>
<script type="rocketlazyloadscript">
    window.onload = function() {
       // $('.bk-btn-paynow').html('');
       // $('.bk-btn-installment').html('');
       // $('.bk-btn-paynow').html('<strong>Mua ngay</strong>' +'<br>' + '<span>(Thanh toán qua Bảo Kim giảm 500k)</span>' + '<br>' +'<span>Giao hàng miễn phí</span>');
       // $('.bk-btn-installment').html('<strong>Mua trả góp 0%</strong>' + '<br>'+ '<span> Thủ tục đơn giản</span>' +' <br> '+'<span>Qua thẻ: Visa, Master, JCB</span>');

       // $('.item-link .bk-btn-paynow').html('');
       // $('.item-link .bk-btn-installment').html('');
       // $('.item-link .bk-btn-paynow').html('<strong>Mua ngay</strong>');
       // $('.item-link .bk-btn-installment').html('<strong>Mua trả góp 0%</strong>');

       var base_url = 'https://xedienvietthanh.com' ;
       function modal_video(that, id, id_youtube){

         jQuery.ajax({
             method: "POST",
             url: base_url+'/ajax-video' ,
             data: { id_prod : id, id_youtube: id_youtube }
           })

         .done(function( data ) {
             jQuery("#modalVideo").html(data);
           });
       }
   }
</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- BK MODAL -->
<!-- <div id='bk-modal'></div> -->
<!-- END BK MODAL -->


<script type="rocketlazyloadscript" data-minify="1"
        src="https://xedienvietthanh.com/wp-content/cache/min/1/jquery-3.5.1.min.js?ver=1694882034"
        crossorigin="anonymous" defer></script>
<script>
    <!-- This
    website
    is
    like
    a
    Rocket, isn
    't it? Performance optimized by WP Rocket. Learn more: https://wp-rocket.me - Debug: cached@1695610034 -->
