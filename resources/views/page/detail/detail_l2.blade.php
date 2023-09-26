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
          content="Ắc quy xe máy điện Yadea 60V &#8211; 22Ah được sản xuất và phân phối bởi hãng Yadea. Ắc quy [&hellip;]">
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
    <title>ẮC QUY XE ĐIỆN YADEA 60V - 22AH TTFAR - Chính hãng</title>
    <link rel="stylesheet"
          href="https://xedienvietthanh.com/wp-content/cache/min/1/7b6c40c842192a3528da105e3f8af942.css" media="all"
          data-minify="1"/>
    <link rel="canonical" href="https://xedienvietthanh.com/ac-quy-yadea-60v-22ah-ttfar/"/>
    <meta property="og:locale" content="vi_VN"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="ẮC QUY XE ĐIỆN YADEA 60V - 22AH TTFAR - Chính hãng"/>
    <meta property="og:description"
          content="Ắc quy xe máy điện Yadea 60V - 22Ah được sản xuất và phân phối bởi hãng Yadea, được nhập khẩu chính hãng và phân phối tại hệ thống xe điện Việt Thanh."/>
    <meta property="og:url" content="https://xedienvietthanh.com/ac-quy-yadea-60v-22ah-ttfar/"/>
    <meta property="og:site_name"
          content="Hệ Thống Xe Điện Việt Thanh - Bán xe máy 50cc - Xe đạp điện - Xe máy điện chính hãng, nhập khẩu"/>
    <meta property="article:publisher" content="https://www.facebook.com/tapdoanxedien"/>
    <meta property="article:modified_time" content="2023-08-29T03:35:22+00:00"/>
    <meta property="og:image"
          content="https://xedienvietthanh.com/wp-content/uploads/2023/04/ac-quy-xe-dien-yadea-60v-22ah.jpg"/>
    <meta property="og:image:width" content="370"/>
    <meta property="og:image:height" content="240"/>
    <meta property="og:image:type" content="image/jpeg"/>
    <meta name="twitter:card" content="summary_large_image"/>
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
    <link rel="alternate" type="application/json" href="https://xedienvietthanh.com/wp-json/wp/v2/products/8616"/>
    <link rel="alternate" type="application/json+oembed"
          href="https://xedienvietthanh.com/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fxedienvietthanh.com%2Fac-quy-yadea-60v-22ah-ttfar%2F"/>
    <link rel="alternate" type="text/xml+oembed"
          href="https://xedienvietthanh.com/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fxedienvietthanh.com%2Fac-quy-yadea-60v-22ah-ttfar%2F&#038;format=xml"/>
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
        [{"@context":"https://schema.org/","@type":"Product","@id":"https://xedienvietthanh.com/ac-quy-yadea-60v-22ah-ttfar/#Product","name":"ẮC QUY XE ĐIỆN YADEA 60V &#8211; 22AH TTFAR","offers":{"price":"4000000","priceCurrency":"VND","url":null,"@type":"AggregateOffer","highPrice":"4600000","lowPrice":"4000000","offerCount":"10"},"image":[{"@type":"ImageObject","@id":"https://xedienvietthanh.com/ac-quy-yadea-60v-22ah-ttfar/#primaryimage","url":"https://xedienvietthanh.com/wp-content/uploads/2023/04/ac-quy-xe-dien-yadea-60v-22ah-1200x778.jpg","width":"1200","height":"778"},{"@type":"ImageObject","url":"https://xedienvietthanh.com/wp-content/uploads/2023/04/ac-quy-xe-dien-yadea-60v-22ah-1200x900.jpg","width":"1200","height":"900"},{"@type":"ImageObject","url":"https://xedienvietthanh.com/wp-content/uploads/2023/04/ac-quy-xe-dien-yadea-60v-22ah-1200x675.jpg","width":"1200","height":"675"},{"@type":"ImageObject","url":"https://xedienvietthanh.com/wp-content/uploads/2019/10/ac-quy-yadea-72v-22ah-chi-tiet.jpg","width":650,"height":500},{"@type":"ImageObject","url":"https://xedienvietthanh.com/wp-content/uploads/2022/11/xe-may-dien-yadea-vigor-trang-2.jpg","width":950,"height":520}]},

        {"@context":"https://schema.org/","@type":"Article","@id":"https://xedienvietthanh.com/ac-quy-yadea-60v-22ah-ttfar/#Article","url":"https://xedienvietthanh.com/ac-quy-yadea-60v-22ah-ttfar/","inLanguage":"vi","mainEntityOfPage":"https://xedienvietthanh.com/ac-quy-yadea-60v-22ah-ttfar/","headline":"ẮC QUY XE ĐIỆN YADEA 60V - 22AH TTFAR - Chính hãng","description":"Ắc quy xe máy điện Yadea 60V - 22Ah được sản xuất và phân phối bởi hãng Yadea, được nhập khẩu chính hãng và phân phối tại hệ thống xe điện Việt Thanh.","articleBody":"Ắc quy xe máy điện Yadea 60V - 22Ah được sản xuất và phân phối bởi hãng Yadea.         Ắc quy xe máy điện Yadea 60V - 22Ah loại 5 bình, là sản phẩm của thương hiệu hàng đầu trong ngành công nghiệp xe điện Trung Quốc - Yadea. Do Yadea cam kết luôn cung cấp các sản phẩm tốt nhất đến người tiêu dùng. Đảm bảo sự hài lòng của mọi khách hàng. Nên hãng Yadea đã nghiên cứu và phát triển đột phá trong công nghệ cốt lõi của xe điện. Đó chính là bộ phận ắc quy.        Yadea cho ra mắt sản phẩm ắc quy Graphene TTFAR. Từ đó, thể hiện khâu cuối cùng trong chuỗi công nghiệp hoàn chỉnh của hãng. Tạo những lợi thế độc lập. Góp phần thúc đẩy sự đổi mới và phát triển công nghệ ắc quy trong ngành xe điện. Giúp Yadea mang lại trải nghiệm tốt hơn và hoàn hảo cho người tiêu dùng.              Công nghệ Graphene composite siêu dẫn dán, tuổi thọ pin dài         Ắc quy Graphene TTFAR sử dụng miếng dán siêu dẫn graphene, tính dẫn điện mạnh, truyền nhiệt nhanh. Và có thể hỗ trợ sạc và xả dòng cao 20Ah. Bên cạnh đó, graphene hoàn nguyên cấu trúc vi mô của điện cực. Ắc quy Yadea có khả năng đảo ngược của điện tích và phóng điện lặp lại là tốt.        Ắc quy Graphene của Yadea hỗ trợ sạc nhanh, sạc 80% trong 1 giờ        Do tính siêu dẫn của graphene mà ắc quy Yadea hỗ trợ sạc dòng điện cao 10Ah - 22Ah. Và có thể sạc 80% điện trong một giờ (với việc sử dụng bộ sạc nhanh chuyên nghiệp). Từ đó, giải quyết vấn đề thời gian sạc dài của xe điện. Bởi vì ắc quy xe máy điện Yadea có thể chịu được dòng xả lớn. Nên nó có thể đáp ứng công việc của động cơ công suất cao.        Dung lượng ắc quy Yadea lớn hơn và tuổi thọ ắc quy được cải thiện rất nhiều        Miếng dán siêu dẫn graphene sử dụng trong ắc quy xe máy điện Yadea có mật độ năng lượng cao hơn và khả năng lưu trữ được tăng cường đáng kể. Ngay cả trong môi trường nhiệt độ thấp, khả năng xả cường độ cao có thể được duy trì để đáp khả năng vận hành trong mùa lạnh.        Công nghệ hợp kim pin công nghiệp cao cấp, chống ăn mòn được cải thiện đáng kể        Lưới điện cực của ắc quy xe máy điện Yadea graphene áp dụng công nghệ hợp kim ắc quy công nghiệp cao cấp. Không chỉ xanh và thân thiện với môi trường. Mà còn ức chế hiệu quả sự ăn mòn của ma trận và ranh giới hạt. Cải thiện đáng kể khả năng chống ăn mòn.        Viên nang chống biến dạng chịu nhiệt độ cao đặc biệt        Vỏ ắc quy xe máy điện Yadea chịu được nhiệt độ cao và thấp. Hiệu suất ổn định, chống va đập và không rò rỉ. Điều này không chỉ có thể kéo dài tuổi thọ ắc quy một cách hiệu quả mà còn đảm bảo an toàn cho mọi người.        Trong một thời gian dài, tuổi thọ ắc quy và tốc độ sạc của xe điện đã gây khó khăn cho ngành công nghiệp xe điện và người tiêu dùng. Giờ đây, Yadea đã chính thức đưa ra giải pháp cho các nhược điểm nói trên.     Thời gian bảo hành dài nhất thị trường  Chưa có hãng xe nào áp dụng thời gian bảo hành ắc quy dài như YADEA hiện nay. Hãng cho phép lỗi 1 bình đổi nguyên 1 bộ trong vào 18 tháng đầu tiên. Cộng thêm 6 tháng tiếp theo lỗi bình nào đổi bình ắc quy đó. Tổng cộng, thời gian bảo hành ắc quy xe dài tới 2 năm. Như vậy trong suốt 2 năm, bạn cứ yên tâm vận hành xe mà không phải lo sợ bị chai bình, phải thay bình mới.   Hiện ắc quy Graphene của YADEA đang có sẵn tại tất cả hơn 20 cửa hàng của Xe điện Việt Thanh trên toàn quốc. Bạn đang đi xe máy điện YADEA mà muốn sửa chữa, thay bình ắc quy mới. Hoặc sử dụng xe của hãng khác nhưng yêu thích dòng ắc quy chất lượng này. Hãy ghé Xe điện Việt Thanh đều được phục vụ chu đáo nhé. Đặc biệt, Xe điện Việt Thanh còn áp dụng thay ắc quy tại nhà, cứu hộ tận nơi các xe điện gặp vấn đề về ắc quy. Gọi ngay hotline: 1900 2082 để được hỗ trợ nhé. ","keywords":"","datePublished":"2023-04-18T05:22:45+07:00","dateModified":"2023-08-29T10:35:22+07:00","author":{"@type":"Person","name":"Dory","url":"https://xedienvietthanh.com/author/sonnguyen/","sameAs":[],"image":{"@type":"ImageObject","url":"https://secure.gravatar.com/avatar/7bba63e63dc46006040beef3da6dddb1?s=96&d=mm&r=g","height":96,"width":96}},"editor":{"@type":"Person","name":"Dory","url":"https://xedienvietthanh.com/author/sonnguyen/","sameAs":[],"image":{"@type":"ImageObject","url":"https://secure.gravatar.com/avatar/7bba63e63dc46006040beef3da6dddb1?s=96&d=mm&r=g","height":96,"width":96}},"publisher":{"@type":"Organization","name":"Hệ Thống Xe Điện Việt Thanh &#8211; Bán xe máy 50cc &#8211; Xe đạp điện &#8211; Xe máy điện chính hãng, nhập khẩu","url":"https://xedienvietthanh.com"},"image":[{"@type":"ImageObject","@id":"https://xedienvietthanh.com/ac-quy-yadea-60v-22ah-ttfar/#primaryimage","url":"https://xedienvietthanh.com/wp-content/uploads/2023/04/ac-quy-xe-dien-yadea-60v-22ah-1200x778.jpg","width":"1200","height":"778"},{"@type":"ImageObject","url":"https://xedienvietthanh.com/wp-content/uploads/2023/04/ac-quy-xe-dien-yadea-60v-22ah-1200x900.jpg","width":"1200","height":"900"},{"@type":"ImageObject","url":"https://xedienvietthanh.com/wp-content/uploads/2023/04/ac-quy-xe-dien-yadea-60v-22ah-1200x675.jpg","width":"1200","height":"675"},{"@type":"ImageObject","url":"https://xedienvietthanh.com/wp-content/uploads/2019/10/ac-quy-yadea-72v-22ah-chi-tiet.jpg","width":650,"height":500},{"@type":"ImageObject","url":"https://xedienvietthanh.com/wp-content/uploads/2022/11/xe-may-dien-yadea-vigor-trang-2.jpg","width":950,"height":520}]}]
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
<body class="products-template-default single single-products postid-8616 ac-quy-yadea-60v-22ah-ttfar" data-spy="scroll"
      data-target=".navbar" data-offset="60">
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

                <a href="tel:{{$shop_info->phone}}" title="Tổng Đài 19002082">Tổng Đài hỗ trợ {{$shop_info->phone}}</a>

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
                              action="https://xedienvietthanh.com" role="search">

                            <input class="search-input form-control" type="search" name="s"
                                   placeholder="Tên sản phẩm bạn muốn tìm" style="width: 210px;">

                            <button class="search-submit fa fa-search btn cl_2cc332" type="submit"
                                    title="search"></button>

                        </form>


                        <div class="col-md-4 text-center">

                            <a href="https://xedienvietthanh.com/mau-xe-dien-xe-may-50cc-ban-chay-nhat-cho-hoc-sinh/"
                               title="{{$shop_info->slogan}}"><span>{{$shop_info->slogan}}</span></a>

                        </div>


                        <style>#kinhnghiemhay .bx-wrapper {
                                background: transparent !important;
                                border: 0 !important;
                                box-shadow: none !important;
                            }</style>

                        <div class="col-md-4 text-left" id="kinhnghiemhay">

                            <span class="bold">Kinh nghiệm hay</span><br>


                            <ul class="slider-kinhnghiemhay">


                                <li>
                                    <a href="https://xedienvietthanh.com/mau-xe-dien-xe-may-50cc-ban-chay-nhat-cho-hoc-sinh/"
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
                            <a href="{{route('danh-muc-san-pham-con',$cms_cate->uniquekey)}}">{{$cms_cate->title}}</a></li>

                    @endforeach
                </ul>
            </li>
        </ul>



    </nav>




</header>

<!--  -->
<div class="hidden" id="cr_sanpham">
    <img src="{{env('APP_URL').'/documents/website/'.$product->imagemain}}"
         data-src="{{env('APP_URL').'/documents/website/'.$product->imagemain}}"
         class="lazyload +img-full transition wp-post-image" alt="" loading="lazy"/> <span class="id-sp">{{$product->id}}</span>
    <span class="url-sp">{{env('APP_URL') . '/chi-tiet-san-pham/'.$product->slug}}}</span>
</div>
<section id="slide_child">
    <div class="slide_child">
        <span class="h1 cl_white">CHI TIẾT SẢN PHẨM</span>
        <div class="breadcrumb_wrapper">
            <div class="brcrumb"><span><span><a href="{{env('APP_URL')}}"><i
                                class="fa fa-home"></i></a>  <span class="breadcrumb_last" aria-current="page">{{$product->name}}</span></span></span>
            </div>
        </div>
    </div>
</section>
<div class="table-service destop ipad-mini wrap-camket">
    <div class="container service">
        <div class="+row ">
            <div class="no-padding col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="service-th service-th-1">
                    <a href="https://xedienvietthanh.com/cam-ket-chat-luong-hang-chinh-hang/" class="service-th-div">
                        <div class="service-th-div-mask"><p>CAM KẾT CHẤT LƯỢNG<br/>
                                CHÍNH HÃNG</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="no-padding col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="service-th service-th-2">
                    <a href="https://xedienvietthanh.com/giao-hang-mien-phi-nhanh-uy-tin/" class="service-th-div">
                        <div class="service-th-div-mask"><p>GIAO HÀNG MIỄN PHÍ<br/>
                                NHANH &#8211; UY TÍN</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="no-padding col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="service-th service-th-3">
                    <a href="https://xedienvietthanh.com/mua-hang-tra-gop-thu-tuc-nhanh-gon/" class="service-th-div">
                        <div class="service-th-div-mask"><p>MUA HÀNG TRẢ GÓP<br/>
                                THỦ TỤC NHANH GỌN</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="no-padding col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="service-th service-th-4">
                    <a href="https://xedienvietthanh.com/sua-chua/" class="service-th-div">
                        <div class="service-th-div-mask"><p>SỬA CHỮA TẬN NƠI<br/>
                                CỨU HỘ KHẨN CẤP</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    #quick-buy .none {
        display: none !important;
    }

    #quick-buy .infopromotion ul {
        float: left;
        list-style: none;
        outline: medium none;
        padding: 0px;
        margin: 0px;
    }

    #quick-buy .infopromotion ul li i.fa-gift {
        margin-right: 5px;
        color: #ffb546;
        font-size: 15px
    }

    #quick-buy .infopromotion ul li {
        margin-bottom: 10px;
        font-size: 14px;
        color: #666
    }
</style>
<div class="modal fade  font16" id="quick-buy" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="ss-form" class="form-quickbuy">
                <div class="modal-header">
                    <h4 class="row text-center title_form text-uppercase">{{$product->name}}
                        </h4>
                </div>
                <div class="modal-body">
                    <table class="table bold">
                        <thead class="thead-inverse">
                        <tr>
                            <th class="hidden-xs hidden-sm">Hình ảnh</th>
                            <th class="hidden-xs hidden-sm">Sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th class="hidden-xs hidden-sm">Thành tiền</th>
                            <th>Hủy</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="hidden-xs hidden-sm">
                                <img src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                     data-src="https://xedienvietthanh.com/wp-content/uploads/2023/04/ac-quy-xe-dien-yadea-60v-22ah.jpg"
                                     class="lazyload thumb-prod wp-post-image" alt=""/></td>
                            <td class="hidden-xs hidden-sm" id="qb_name">{{$product->name}}
                            </td>
                            <td id="qb_don_gia">{{$product->price}}</td>
                            <td>
                                <input id="qb_quantity" type="number" step="1" min="1" max="" name="po_quantity"
                                       value="1" size="4" pattern="[0-9]*" inputmode="numeric">
                            </td>
                            <td class="hidden-xs hidden-sm" id="qb_thanh_tien">{{$product->price}}</td>
                            <td><span class="del" data-dismiss="modal">Hủy</span></td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <div class="infopromotion">
                                    <ul>
                                        <li><i class="fa fa-gift"></i></li>
                                        <li><i class="fa fa-gift"></i></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" class="">Tổng tiền: <span class="cl_red"><span
                                        id="tongtien">4.000.000</span> VNĐ</span></td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="wd100 khach-hang">
                        <h4 class="row text-center title_form bold text-uppercase">Chọn phương thức thanh toán</h4>
                        <div class="space20"></div>
                        <p>Quý khách vui lòng chọn một hình thức thanh toán trong số các hình thức bên dưới phù hợp
                            nhất.</p>

                        <table width="100%" cellpadding="0" cellspacing="0" class="conTable">
                            <tbody>
                            <tr>
                                <td width="20">
                                    <input type="radio" id="pay_bank" name="paytype" value="3"
                                           onclick="change_paytype(3)"></td>
                                <td valign="top">
                                    <label for="pay_bank"><strong class="payTitle">Chuyển khoản ngân hàng</strong>
                                    </label>
                                    <br>
                                    <div class="bankInfo" style="padding-top: 5px;display: none; ">
                                        <p><strong>Ngân hàng Techcombank</strong>
                                            <br>Chủ tài khoản LE HONG THANH
                                            <br>STK: 19132176668886
                                            <br>SĐT: 0903043333
                                            <br>Ngân hàng techcombank chi nhánh cầu giấy, Hà Nội</p>
                                        Sau khi chuyển khoản, để việc gửi hàng được tiến hành nhanh chóng, Quý khách vui
                                        lòng mail hóa đơn đã chuyển tiền hoặc điện thoại 090 304 3333. Xin cảm ơn Quý
                                        khách.
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="20">
                                    <input type="radio" id="pay_cod" name="paytype" value="1"
                                           onclick="change_paytype(1)"></td>
                                <td valign="top">
                                    <label for="pay_cod"><strong class="payTitle">Trả tiền mặt trực tiếp ngay khi nhận
                                            hàng</strong>
                                    </label>
                                    <div class="compInfo" style="margin-top: 25px; display: none;">
                                        <p>Nhân viên của chúng tôi sẽ thu tiền khi giao nhận hàng hóa.</p>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>


                        <h4 class="row text-center title_form text-uppercase">Nhập thông tin đơn hàng</h4>
                        <div class="space20"></div>
                        <div class="form-group">
                            <label for="contact-name" class="col-sm-2 control-label">Họ tên</label>
                            <div class="col-sm-10">
                                <input type="text" name="hoten" value="" class="ss-q-short form-control"
                                       id="entry_1918389590" dir="auto" aria-label="Họ tên  " title="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="contact-email" class="col-sm-2 control-label">Số điện thoại</label>
                            <div class="col-sm-10">
                                <input type="number" name="sdt" value="" class="ss-q-short form-control"
                                       id="entry_1974945640" dir="auto" aria-label="Điện thoại  Phải là một số nguyên."
                                       aria-required="true" required="" step="1"
                                       title="Nhập đúng số điện thoại của bạn">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="contact-email" class="col-sm-2 control-label">Địa chỉ</label>
                            <div class="col-sm-10">
                                <input type="text" name="diachi" value="" class="ss-q-short form-control"
                                       id="entry_638975727" dir="auto" aria-label="Địa chỉ  " title="">
                            </div>
                        </div>
                        <div class="form-group none">
                            <label for="contact-email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" name="email" value="" class="ss-q-short form-control"
                                       id="entry_589038675" dir="auto" aria-label="Email  Phải chứa @" pattern=".*@.*"
                                       title="Ph&#7843;i ch&#7913;a @">
                            </div>
                        </div>
                        <div class="form-group none">
                            <label for="contact-email" class="col-sm-2 control-label">Yêu cầu</label>
                            <div class="col-sm-10">
                                <textarea name="yeucau" rows="2" cols="0" class="ss-q-long form-control"
                                          id="entry_1997209857" dir="auto" aria-label="Nội dung yêu cầu  "></textarea>
                            </div>
                        </div>
                        <div class="none">
                            <input type="text" name="tensanpham" value="ẮC QUY XE ĐIỆN YADEA 60V &#8211; 22AH TTFAR"
                                   class="ss-q-short form-control" id="entry_100017905" dir="auto"
                                   aria-label="Tên sản phẩm  " title="">
                            <input type="text" name="dongia" value="4.000.000" class="ss-q-short form-control"
                                   id="entry_1558387368" dir="auto" aria-label="Đơn giá hiện tại  " title="">
                            <input type="text" name="soluong" value="" class="ss-q-short form-control"
                                   id="entry_1568021111" dir="auto" aria-label="Số lượng đặt mua  " title="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer wd100">
                    <!-- <a class="btn btn-default" data-dismiss="modal">Close</a> -->
                    <input type="submit" class="btn btn-primary" name="submit" value="Đặt hàng">
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    .khach-hang table {
        line-height: 20px
    }

    .khach-hang p {
        margin-bottom: 20px;
    }

    .bankInfo {
        line-height: 1.5
    }

    .khach-hang table tr {
        border-bottom: 1px dashed #dfdfdf;
    }

    .khach-hang table tr th, .khach-hang table tr td {
        padding: 10px;
        vertical-align: top
    }
</style>

<style>
</style>
<section class="main">
    <div class="container details-product">
        <div class="row details-pro">
            <div class="col-sm-6 ">

                <div id="gallery">
                    <div class="fotorama text-center" data-nav="thumbs">

                            @foreach($shop_image_product as $key => $image_product)
                                @if($image_product->type==1)
                                    <a href="{{env('APP_URL').'/documents/website/'.$image_product->image}}"
                                       data-full="{{env('APP_URL').'/documents/website/'.$image_product->image}}"><img
                                            src="{{env('APP_URL').'/documents/website/'.$image_product->image}}"
                                            alt=""
                                            data-lazy-src="{{env('APP_URL').'/documents/website/'.$image_product->image}}">
                                        <noscript><img
                                                src="{{env('APP_URL').'/documents/website/'.$image_product->image}}"
                                                alt=""></noscript>
                                    </a>
                                @endif
                            @endforeach


                    </div>
                </div>


                <div class="the_content">

                    {!! $product->review !!}

                </div>

            </div>

            <div class="col-sm-6">
                <h1 class="product-name">{{$product->name}}</h1>
                <div class="price-box mart20">


                    <span class="old-price"><span
                            class="price product-price-old">{{$product->price}}</span>
                    </span> <!-- Giá gốc -->

                    <span class="special-price"><span
                            class="price product-price">{{$product->price}}</span> </span>
                    <!-- Giá Khuyến mại -->

                    <span class="special-offers">-0 %</span>


                </div>
                <div class="clear"></div>

                <div class="comfortable_buy">
                    <ul>
                        <li>

                            <i class="grid grid-cog"></i>

                            <p>
                                Bảo hành 18 tháng </p>

                        </li>

                        <li>

                            <i class="grid grid-car"></i>

                            <p>
                                Vận chuyển miễn phí 30km </p>

                        </li>

                        <li>

                            <i class="grid grid-star"></i>

                            <p>
                                Hỗ trợ lắp đặt </p>

                        </li>

                        <li>

                            <i class="grid grid-doi"></i>

                            <p>
                                Hỗ trợ sửa chữa tận nhà bán kính 15km </p>

                        </li>

                    </ul>
                </div>

                <div class="clear"></div>

                <div class="dathang">
                    <div class="cart w-100">
                        <a href="#quick-buy" data-toggle="modal" style="background-color: orange; padding: 10px 0;">
                            <p class="p1"><span>Đặt hàng</span></p>
                            <p>(Đặt trước để nhận ưu đãi)</p>
                        </a>
                    </div>
                </div>
                <div class="clearfix"></div>


                <div class="tuvan_hot">
                    <!-- <div class="w100 text-center p" style="padding-left: 40px;">Hotline: <a class="cl_cam2" title="19002082" href="tel:19002082">19002082</a> &#8211; <a class="cl_cam2" title="0904.998899" href="tel:0904998899">0904.998899</a></div>
<div class="w100 text-center p">Kinh Doanh: <a class="cl_cam2" title="0975.66.8386" href="tel:0975668386">0916.055588</a> &#8211; <a class="cl_cam2" title="0984.44.3388" href="tel:0984443388">0986.06.3888</a></div>
 -->
                    <div class="w100 text-center p" style="padding-left: 40px;">Hotline: <a class="cl_cam2"
                                                                                            title="{{$shop_info->phone}}"
                                                                                            href="tel:{{$shop_info->phone}}">{{$shop_info->phone}}</a>
                        </div>
                    <div class="w100 text-center p"></div>
                </div>

                <style>
                    .wrap_box {
                        background: transparent;
                    }

                    .wrap_box .thongso {
                        background: transparent;
                    }

                    .wrap_box .thongso .abs {
                        overflow-y: auto;
                        /* width: 122%; */
                    }
                </style>

                @php
                    $current_url= Request::url();
                @endphp
                <div class="comment_danhgia wrbox" id="contact">
                    <div class="row">
                        <div >
                            <div class="fb-comments" data-href="{{$current_url}}" data-width="100%"  data-numposts="5"></div>
                        </div>
                    </div>
                </div>

                <div class="ads_467_466" id="text-3">
                    <a href="https://xedienvietthanh.com/xe-may-dien-yadea-v002-vfv/" title="">
                        <img class="img-responsive lazyload lazy"
                             src="data:image/gif;base64,R0lGODdhAQABAPAAAMPDwwAAACwAAAAAAQABAAACAkQBADs="
                             data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/xe-dien-viet-thanh-banner-doc.jpg"
                             alt=""/>
                    </a>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

</section>


<!-- /main-content -->
<script type="rocketlazyloadscript">
    function showVideo(id,url){
        //alert('showVideo');
        document.getElementById(id).removeAttribute('src');
        document.getElementById(id).setAttribute('src',url);
    }

    function goToByScroll(id){
        //alert(123);
        id = id.replace("link", "");
        jQuery('html,body').animate({
            scrollTop: jQuery("#"+id).offset().top - 52},
            'slow');
    }

    function change_paytype(val){
        $('.compInfo, .bankInfo').hide();
        if(val==3){
            $('.bankInfo').show();
            $('#pay_bank').attr('checked',true);
        }

        if(val==1){
            $('.compInfo').show();
            $('#pay_cod').attr('checked',true);
        }
    }
window.onload = function() {
}
</script>
<style>
    .overhiden {
        overflow: hidden
    }
</style>
<section class="acquy_phutung_2019">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 ">
                <div class="head-title font30 text-uppercase h2"><a href="https://xedienvietthanh.com/ac-quy/">ắc quy
                        chính hãng</a>
                </div>
                <div class="owl-carousel overhiden" id="owl-acquy-2019">
                    <!-- loop product -->
                    <div class="owl-item active" style="width: 257.5px; margin-right: 10px;"><div class="display-pt10 item-special">
                            <div class="col-item">
                                <div class="item-inner">
                                    <div class="product-wrapper">
                                        <a href="https://xedienvietthanh.com/ac-quy-yadea-60v-22ah-ttfar/" title="ẮC QUY XE ĐIỆN YADEA 60V – 22AH TTFAR">
                                            <img src="https://xedienvietthanh.com/wp-content/uploads/2023/04/ac-quy-xe-dien-yadea-60v-22ah.jpg" data-src="https://xedienvietthanh.com/wp-content/uploads/2023/04/ac-quy-xe-dien-yadea-60v-22ah.jpg" class="lazyload img-full transition lazy lazyload wp-post-image" alt="" loading="lazy"></a>
                                    </div>
                                    <div class="item-info">
                                        <h5 class="item-title text-uppercase"><a href="https://xedienvietthanh.com/ac-quy-yadea-60v-22ah-ttfar/" title="ẮC QUY XE ĐIỆN YADEA 60V – 22AH TTFAR">ẮC QUY XE ĐIỆN YADEA 60V – 22AH TTFAR</a></h5>
                                        <div class="item-price">
                                            <span class="old-price"><span class="price">4.600.000 đ</span></span>
                                            <span class="regular-price"><span class="price">4.000.000 đ</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- loop product -->
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
                        <a href="{{route('danh-muc-san-pham-con',$cms_cate->uniquekey)}}">{{$cms_cate->title}}</a></li>

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
                        <b>Về chúng tôi<b>
                    </div>
                    <ul id="menu-footer" class="list-unstyled">
                        <li id="menu-item-25685"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-25685"><a
                                href="https://xedienvietthanh.com/chinh-sach-thanh-toan/">Chính sách thanh toán</a></li>
                        <li id="menu-item-25680"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-25680"><a
                                href="https://xedienvietthanh.com/chinh-sach-kiem-hang/">Chính sách kiểm hàng</a></li>
                        <li id="menu-item-32849"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-32849"><a
                                href="https://xedienvietthanh.com/chinh-sach-bao-hanh/">Chính sách bảo hành</a></li>
                        <li id="menu-item-25682"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-25682"><a
                                href="https://xedienvietthanh.com/chinh-sach-doi-tra-hoan-tien/">Chính sách đổi trả hoàn
                                tiền</a></li>
                        <li id="menu-item-25683"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-25683"><a
                                href="https://xedienvietthanh.com/chinh-sach-van-chuyen-va-giao-nhan/">Chính sách vận
                                chuyển và giao nhận</a></li>
                        <li id="menu-item-25684"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-25684"><a
                                href="https://xedienvietthanh.com/chinh-sach-xu-ly-khieu-nai/">Chính sách xử lý khiếu
                                nại</a></li>
                        <li id="menu-item-25679"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-25679"><a
                                href="https://xedienvietthanh.com/chinh-sach-bao-mat-thong-tin/">Chính sách bảo mật
                                thông tin</a></li>
                        <li id="menu-item-3963"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3963"><a
                                href="https://xedienvietthanh.com/gioi-thieu/">Giới thiệu</a></li>
                        <li id="menu-item-4002"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4002"><a
                                href="https://xedienvietthanh.com/xe-dien-viet-thanh-tuyen-dung-nhan-su/">Tuyển dụng</a>
                        </li>
                        <li id="menu-item-290"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-290"><a
                                href="https://xedienvietthanh.com/tu-van-mien-phi-247/">Tư vấn miễn phí 24/7</a></li>
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
                                       class="relative w100 font16 bold">Hà Nội</a>
                                </div>
                            </div>
                            <div id="collapse-0" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <ul class="tab-map-bottom abs list-unstyled">

                                        <li class="bold" data-target="tab-00">
                                            <!-- <p class="mar0">Showroom 1: 76-78 Ô Chợ Dừa, Đống Đa, Hà Nội.</p> -->
                                            <p class="mar0"><img alt="76-78 Ô Chợ Dừa, Đống Đa, Hà Nội." width="22"
                                                                 height="22"
                                                                 src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2022%2022'%3E%3C/svg%3E"
                                                                 data-lazy-src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                <noscript><img alt="76-78 Ô Chợ Dừa, Đống Đa, Hà Nội." width="22"
                                                               height="22"
                                                               src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                </noscript>
                                                76-78 Ô Chợ Dừa, Đống Đa, Hà Nội.
                                            </p>
                                            <p class="mar0" style="padding-left: 22px;">Tư vấn : <a
                                                    href="tel:0904.998899">0904.998899</a> <a
                                                    href="https://goo.gl/maps/ckzibfjdjZbzsrHD6" target="_blank"
                                                    class="pull-right" rel="nofollow">Xem bản đồ <i
                                                        class="fa fa-external-link"></i></a></p>
                                        </li>

                                        <li class="bold" data-target="tab-01">
                                            <!-- <p class="mar0">Showroom 2: 196 Cầu Giấy, Cầu Giấy, Hà Nội</p> -->
                                            <p class="mar0"><img alt="196 Cầu Giấy, Cầu Giấy, Hà Nội" width="22"
                                                                 height="22"
                                                                 src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2022%2022'%3E%3C/svg%3E"
                                                                 data-lazy-src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                <noscript><img alt="196 Cầu Giấy, Cầu Giấy, Hà Nội" width="22"
                                                               height="22"
                                                               src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                </noscript>
                                                196 Cầu Giấy, Cầu Giấy, Hà Nội
                                            </p>
                                            <p class="mar0" style="padding-left: 22px;">Tư vấn : <a
                                                    href="tel:0986.06.3888">0986.06.3888</a> <a
                                                    href="https://goo.gl/maps/BRJktbNWEvDqcgFR8" target="_blank"
                                                    class="pull-right" rel="nofollow">Xem bản đồ <i
                                                        class="fa fa-external-link"></i></a></p>
                                        </li>

                                        <li class="bold" data-target="tab-02">
                                            <!-- <p class="mar0">Showroom 3: 165 Xuân Thuỷ, Cầu Giấy, Hà Nội</p> -->
                                            <p class="mar0"><img alt="165 Xuân Thuỷ, Cầu Giấy, Hà Nội" width="22"
                                                                 height="22"
                                                                 src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2022%2022'%3E%3C/svg%3E"
                                                                 data-lazy-src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                <noscript><img alt="165 Xuân Thuỷ, Cầu Giấy, Hà Nội" width="22"
                                                               height="22"
                                                               src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                </noscript>
                                                165 Xuân Thuỷ, Cầu Giấy, Hà Nội
                                            </p>
                                            <p class="mar0" style="padding-left: 22px;">Tư vấn : <a
                                                    href="tel:0988.47.6336">0988.47.6336</a> <a
                                                    href="https://goo.gl/maps/9FrmYaLatV2zwog17" target="_blank"
                                                    class="pull-right" rel="nofollow">Xem bản đồ <i
                                                        class="fa fa-external-link"></i></a></p>
                                        </li>

                                        <li class="bold" data-target="tab-03">
                                            <!-- <p class="mar0">Showroom 4: 127 Phạm Văn Đồng, Cầu Giấy, Hà Nội.</p> -->
                                            <p class="mar0"><img alt="127 Phạm Văn Đồng, Cầu Giấy, Hà Nội." width="22"
                                                                 height="22"
                                                                 src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2022%2022'%3E%3C/svg%3E"
                                                                 data-lazy-src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                <noscript><img alt="127 Phạm Văn Đồng, Cầu Giấy, Hà Nội." width="22"
                                                               height="22"
                                                               src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                </noscript>
                                                127 Phạm Văn Đồng, Cầu Giấy, Hà Nội.
                                            </p>
                                            <p class="mar0" style="padding-left: 22px;">Tư vấn : <a
                                                    href="tel:0986.91.5959">0986.91.5959</a> <a
                                                    href="https://goo.gl/maps/jNo7hQCtWzGWvYEw5" target="_blank"
                                                    class="pull-right" rel="nofollow">Xem bản đồ <i
                                                        class="fa fa-external-link"></i></a></p>
                                        </li>

                                        <li class="bold" data-target="tab-04">
                                            <!-- <p class="mar0">Showroom 5: 521 Nguyễn Trãi, Thanh Xuân, Hà Nội</p> -->
                                            <p class="mar0"><img alt="521 Nguyễn Trãi, Thanh Xuân, Hà Nội" width="22"
                                                                 height="22"
                                                                 src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2022%2022'%3E%3C/svg%3E"
                                                                 data-lazy-src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                <noscript><img alt="521 Nguyễn Trãi, Thanh Xuân, Hà Nội" width="22"
                                                               height="22"
                                                               src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                </noscript>
                                                521 Nguyễn Trãi, Thanh Xuân, Hà Nội
                                            </p>
                                            <p class="mar0" style="padding-left: 22px;">Tư vấn : <a
                                                    href="tel:0916.87.2266">0916.87.2266</a> <a
                                                    href="https://goo.gl/maps/rDQmp7rbWe1qYZRF6" target="_blank"
                                                    class="pull-right" rel="nofollow">Xem bản đồ <i
                                                        class="fa fa-external-link"></i></a></p>
                                        </li>

                                        <li class="bold" data-target="tab-05">
                                            <!-- <p class="mar0">Showroom 6: 603 Nguyễn Trãi, Thanh Xuân, Hà Nội</p> -->
                                            <p class="mar0"><img alt="603 Nguyễn Trãi, Thanh Xuân, Hà Nội" width="22"
                                                                 height="22"
                                                                 src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2022%2022'%3E%3C/svg%3E"
                                                                 data-lazy-src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                <noscript><img alt="603 Nguyễn Trãi, Thanh Xuân, Hà Nội" width="22"
                                                               height="22"
                                                               src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                </noscript>
                                                603 Nguyễn Trãi, Thanh Xuân, Hà Nội
                                            </p>
                                            <p class="mar0" style="padding-left: 22px;">Tư vấn : <a
                                                    href="tel:0984.44.3388">0984.44.3388</a> <a
                                                    href="https://goo.gl/maps/NWD8pj4mYfdDkvBS8" target="_blank"
                                                    class="pull-right" rel="nofollow">Xem bản đồ <i
                                                        class="fa fa-external-link"></i></a></p>
                                        </li>

                                        <li class="bold" data-target="tab-06">
                                            <!-- <p class="mar0">Showroom 7: 150 Phạm Văn Đồng, Cầu Giấy, Hà Nội.</p> -->
                                            <p class="mar0"><img alt="150 Phạm Văn Đồng, Cầu Giấy, Hà Nội." width="22"
                                                                 height="22"
                                                                 src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2022%2022'%3E%3C/svg%3E"
                                                                 data-lazy-src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                <noscript><img alt="150 Phạm Văn Đồng, Cầu Giấy, Hà Nội." width="22"
                                                               height="22"
                                                               src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                </noscript>
                                                150 Phạm Văn Đồng, Cầu Giấy, Hà Nội.
                                            </p>
                                            <p class="mar0" style="padding-left: 22px;">Tư vấn : <a
                                                    href="tel:091.162.3388">091.162.3388</a> <a
                                                    href="https://goo.gl/maps/K13pV7NhgbmgYaVU8" target="_blank"
                                                    class="pull-right" rel="nofollow">Xem bản đồ <i
                                                        class="fa fa-external-link"></i></a></p>
                                        </li>

                                        <li class="bold" data-target="tab-07">
                                            <!-- <p class="mar0">Showroom 8: 75 Đại Cồ Việt, Hai Bà Trưng, Hà Nội</p> -->
                                            <p class="mar0"><img alt="75 Đại Cồ Việt, Hai Bà Trưng, Hà Nội" width="22"
                                                                 height="22"
                                                                 src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2022%2022'%3E%3C/svg%3E"
                                                                 data-lazy-src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                <noscript><img alt="75 Đại Cồ Việt, Hai Bà Trưng, Hà Nội" width="22"
                                                               height="22"
                                                               src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                </noscript>
                                                75 Đại Cồ Việt, Hai Bà Trưng, Hà Nội
                                            </p>
                                            <p class="mar0" style="padding-left: 22px;">Tư vấn : <a
                                                    href="tel:0981319559">0981319559</a> <a
                                                    href="https://goo.gl/maps/pe4zyJAwsbXZSeTd8" target="_blank"
                                                    class="pull-right" rel="nofollow">Xem bản đồ <i
                                                        class="fa fa-external-link"></i></a></p>
                                        </li>

                                        <li class="bold" data-target="tab-08">
                                            <!-- <p class="mar0">Showroom 9: 252R Minh Khai, Hai Bà Trưng, Hà Nội</p> -->
                                            <p class="mar0"><img alt="252R Minh Khai, Hai Bà Trưng, Hà Nội" width="22"
                                                                 height="22"
                                                                 src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2022%2022'%3E%3C/svg%3E"
                                                                 data-lazy-src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                <noscript><img alt="252R Minh Khai, Hai Bà Trưng, Hà Nội" width="22"
                                                               height="22"
                                                               src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                </noscript>
                                                252R Minh Khai, Hai Bà Trưng, Hà Nội
                                            </p>
                                            <p class="mar0" style="padding-left: 22px;">Tư vấn : <a
                                                    href="tel:0973572233">0973572233</a> <a
                                                    href="https://goo.gl/maps/ZkWzhntrTvX7vKxF9" target="_blank"
                                                    class="pull-right" rel="nofollow">Xem bản đồ <i
                                                        class="fa fa-external-link"></i></a></p>
                                        </li>

                                        <li class="bold" data-target="tab-09">
                                            <!-- <p class="mar0">Showroom 10: 4B, Tân Mai, Hoàng Mai, HN</p> -->
                                            <p class="mar0"><img alt="4B, Tân Mai, Hoàng Mai, HN" width="22" height="22"
                                                                 src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2022%2022'%3E%3C/svg%3E"
                                                                 data-lazy-src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                <noscript><img alt="4B, Tân Mai, Hoàng Mai, HN" width="22" height="22"
                                                               src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                </noscript>
                                                4B, Tân Mai, Hoàng Mai, HN
                                            </p>
                                            <p class="mar0" style="padding-left: 22px;">Tư vấn : <a
                                                    href="tel:0931824888">0931824888</a> <a
                                                    href="https://goo.gl/maps/r7Gjo5fK2Aquk6NB7" target="_blank"
                                                    class="pull-right" rel="nofollow">Xem bản đồ <i
                                                        class="fa fa-external-link"></i></a></p>
                                        </li>

                                        <li class="bold" data-target="tab-010">
                                            <!-- <p class="mar0">Showroom 11: 665 Nguyễn Văn Cừ, Long Biên, Hà Nội.</p> -->
                                            <p class="mar0"><img alt="665 Nguyễn Văn Cừ, Long Biên, Hà Nội." width="22"
                                                                 height="22"
                                                                 src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2022%2022'%3E%3C/svg%3E"
                                                                 data-lazy-src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                <noscript><img alt="665 Nguyễn Văn Cừ, Long Biên, Hà Nội." width="22"
                                                               height="22"
                                                               src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                </noscript>
                                                665 Nguyễn Văn Cừ, Long Biên, Hà Nội.
                                            </p>
                                            <p class="mar0" style="padding-left: 22px;">Tư vấn : <a
                                                    href="tel:0916.05.5588">0916.05.5588</a> <a
                                                    href="https://goo.gl/maps/RD8aQjg3XLyqdVvq8" target="_blank"
                                                    class="pull-right" rel="nofollow">Xem bản đồ <i
                                                        class="fa fa-external-link"></i></a></p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <div class="panel-heading relative">
                                <div class="panel-title  transition">
                                    <a data-toggle="collapse" data-parent="#map-footer" href="#collapse-1"
                                       class="relative w100 font16 bold">Bắc Ninh</a>
                                </div>
                            </div>
                            <div id="collapse-1" class="panel-collapse collapse ">
                                <div class="panel-body">
                                    <ul class="tab-map-bottom  list-unstyled">

                                        <li class="bold" data-target="tab-10">
                                            <!-- <p class="mar0">Showroom 1: 1A Nguyễn Trãi, Ninh Xá, TP Bắc Ninh, Bắc Ninh</p> -->
                                            <p class="mar0"><img alt="1A Nguyễn Trãi, Ninh Xá, TP Bắc Ninh, Bắc Ninh"
                                                                 width="22" height="22"
                                                                 src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2022%2022'%3E%3C/svg%3E"
                                                                 data-lazy-src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                <noscript><img alt="1A Nguyễn Trãi, Ninh Xá, TP Bắc Ninh, Bắc Ninh"
                                                               width="22" height="22"
                                                               src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                </noscript>
                                                1A Nguyễn Trãi, Ninh Xá, TP Bắc Ninh, Bắc Ninh
                                            </p>
                                            <p class="mar0" style="padding-left: 22px;">Tư vấn : <a
                                                    href="tel:0987.97.2299">0987.97.2299</a> <a
                                                    href="https://goo.gl/maps/oNp6WBFCk13mmaUS7" target="_blank"
                                                    class="pull-right" rel="nofollow">Xem bản đồ <i
                                                        class="fa fa-external-link"></i></a></p>
                                        </li>

                                        <li class="bold" data-target="tab-11">
                                            <!-- <p class="mar0">Showroom 2: Phố Mới, Trần Phú, Đình Bảng, Từ Sơn, Bắc Ninh</p> -->
                                            <p class="mar0"><img alt="Phố Mới, Trần Phú, Đình Bảng, Từ Sơn, Bắc Ninh"
                                                                 width="22" height="22"
                                                                 src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2022%2022'%3E%3C/svg%3E"
                                                                 data-lazy-src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                <noscript><img alt="Phố Mới, Trần Phú, Đình Bảng, Từ Sơn, Bắc Ninh"
                                                               width="22" height="22"
                                                               src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                </noscript>
                                                Phố Mới, Trần Phú, Đình Bảng, Từ Sơn, Bắc Ninh
                                            </p>
                                            <p class="mar0" style="padding-left: 22px;">Tư vấn : <a
                                                    href="tel:0985.79.2299">0985.79.2299</a> <a
                                                    href="https://goo.gl/maps/8oNq9HLHsiEkZ3n69" target="_blank"
                                                    class="pull-right" rel="nofollow">Xem bản đồ <i
                                                        class="fa fa-external-link"></i></a></p>
                                        </li>

                                        <li class="bold" data-target="tab-12">
                                            <!-- <p class="mar0">Showroom 3: 713 Ngô Gia Tự, Ninh Xá, TP Bắc Ninh, Bắc Ninh</p> -->
                                            <p class="mar0"><img alt="713 Ngô Gia Tự, Ninh Xá, TP Bắc Ninh, Bắc Ninh"
                                                                 width="22" height="22"
                                                                 src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2022%2022'%3E%3C/svg%3E"
                                                                 data-lazy-src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                <noscript><img alt="713 Ngô Gia Tự, Ninh Xá, TP Bắc Ninh, Bắc Ninh"
                                                               width="22" height="22"
                                                               src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                </noscript>
                                                713 Ngô Gia Tự, Ninh Xá, TP Bắc Ninh, Bắc Ninh
                                            </p>
                                            <p class="mar0" style="padding-left: 22px;">Tư vấn : <a
                                                    href="tel:0982.51.3399">0982.51.3399</a> <a
                                                    href="https://goo.gl/maps/2WZ8ksRASWdzoPAz6" target="_blank"
                                                    class="pull-right" rel="nofollow">Xem bản đồ <i
                                                        class="fa fa-external-link"></i></a></p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <div class="panel-heading relative">
                                <div class="panel-title  transition">
                                    <a data-toggle="collapse" data-parent="#map-footer" href="#collapse-2"
                                       class="relative w100 font16 bold">Bắc Giang</a>
                                </div>
                            </div>
                            <div id="collapse-2" class="panel-collapse collapse ">
                                <div class="panel-body">
                                    <ul class="tab-map-bottom abs list-unstyled">

                                        <li class="bold" data-target="tab-20">
                                            <!-- <p class="mar0">Showroom 1: Lô 01-02 Đại Hoàng Sơn, Xương Giang, Bắc Giang</p> -->
                                            <p class="mar0"><img alt="Lô 01-02 Đại Hoàng Sơn, Xương Giang, Bắc Giang"
                                                                 width="22" height="22"
                                                                 src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2022%2022'%3E%3C/svg%3E"
                                                                 data-lazy-src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                <noscript><img alt="Lô 01-02 Đại Hoàng Sơn, Xương Giang, Bắc Giang"
                                                               width="22" height="22"
                                                               src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                </noscript>
                                                Lô 01-02 Đại Hoàng Sơn, Xương Giang, Bắc Giang
                                            </p>
                                            <p class="mar0" style="padding-left: 22px;">Tư vấn : <a
                                                    href="tel:0985.95.9339">0985.95.9339</a> <a
                                                    href="https://goo.gl/maps/o3ChYRy1kFU6wsXg7" target="_blank"
                                                    class="pull-right" rel="nofollow">Xem bản đồ <i
                                                        class="fa fa-external-link"></i></a></p>
                                        </li>

                                        <li class="bold" data-target="tab-21">
                                            <!-- <p class="mar0">Showroom 2: Lô G6.1-G6.2 KĐT Rùa Vàng, TT Vôi - Lạng Giang - Bắc Giang</p> -->
                                            <p class="mar0"><img
                                                    alt="Lô G6.1-G6.2 KĐT Rùa Vàng, TT Vôi - Lạng Giang - Bắc Giang"
                                                    width="22" height="22"
                                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2022%2022'%3E%3C/svg%3E"
                                                    data-lazy-src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                <noscript><img
                                                        alt="Lô G6.1-G6.2 KĐT Rùa Vàng, TT Vôi - Lạng Giang - Bắc Giang"
                                                        width="22" height="22"
                                                        src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                </noscript>
                                                Lô G6.1-G6.2 KĐT Rùa Vàng, TT Vôi - Lạng Giang - Bắc Giang
                                            </p>
                                            <p class="mar0" style="padding-left: 22px;">Tư vấn : <a
                                                    href="tel:0967.07.9898">0967.07.9898</a> <a
                                                    href="https://goo.gl/maps/iVSbT9GFFowuBEe49" target="_blank"
                                                    class="pull-right" rel="nofollow">Xem bản đồ <i
                                                        class="fa fa-external-link"></i></a></p>
                                        </li>

                                        <li class="bold" data-target="tab-22">
                                            <!-- <p class="mar0">Showroom 3: 372 Thân Nhân Trung, Việt Yên, Bắc Giang</p> -->
                                            <p class="mar0"><img alt="372 Thân Nhân Trung, Việt Yên, Bắc Giang"
                                                                 width="22" height="22"
                                                                 src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2022%2022'%3E%3C/svg%3E"
                                                                 data-lazy-src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                <noscript><img alt="372 Thân Nhân Trung, Việt Yên, Bắc Giang" width="22"
                                                               height="22"
                                                               src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                </noscript>
                                                372 Thân Nhân Trung, Việt Yên, Bắc Giang
                                            </p>
                                            <p class="mar0" style="padding-left: 22px;">Tư vấn : <a
                                                    href="tel:0966.888.372">0966.888.372</a> <a
                                                    href="https://goo.gl/maps/JtEAFJe5vfasqBDv8" target="_blank"
                                                    class="pull-right" rel="nofollow">Xem bản đồ <i
                                                        class="fa fa-external-link"></i></a></p>
                                        </li>

                                        <li class="bold" data-target="tab-23">
                                            <!-- <p class="mar0">Showroom 4: Ngã Tư Cầu Lường, Quang Thịnh, Lạng Giang, Bắc Giang</p> -->
                                            <p class="mar0"><img
                                                    alt="Ngã Tư Cầu Lường, Quang Thịnh, Lạng Giang, Bắc Giang"
                                                    width="22" height="22"
                                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2022%2022'%3E%3C/svg%3E"
                                                    data-lazy-src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                <noscript><img
                                                        alt="Ngã Tư Cầu Lường, Quang Thịnh, Lạng Giang, Bắc Giang"
                                                        width="22" height="22"
                                                        src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                </noscript>
                                                Ngã Tư Cầu Lường, Quang Thịnh, Lạng Giang, Bắc Giang
                                            </p>
                                            <p class="mar0" style="padding-left: 22px;">Tư vấn : <a
                                                    href="tel:0979.550.668">0979.550.668</a> <a
                                                    href="https://goo.gl/maps/aStCBQvCJrAGfFy28" target="_blank"
                                                    class="pull-right" rel="nofollow">Xem bản đồ <i
                                                        class="fa fa-external-link"></i></a></p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <div class="panel-heading relative">
                                <div class="panel-title  transition">
                                    <a data-toggle="collapse" data-parent="#map-footer" href="#collapse-3"
                                       class="relative w100 font16 bold">TP. Hồ Chí Minh</a>
                                </div>
                            </div>
                            <div id="collapse-3" class="panel-collapse collapse ">
                                <div class="panel-body">
                                    <ul class="tab-map-bottom abs list-unstyled">

                                        <li class="bold" data-target="tab-30">
                                            <!-- <p class="mar0">Showroom 1: 660 Âu Cơ, Tân Bình, TP. HCM</p> -->
                                            <p class="mar0"><img alt="660 Âu Cơ, Tân Bình, TP. HCM" width="22"
                                                                 height="22"
                                                                 src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2022%2022'%3E%3C/svg%3E"
                                                                 data-lazy-src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                <noscript><img alt="660 Âu Cơ, Tân Bình, TP. HCM" width="22" height="22"
                                                               src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                </noscript>
                                                660 Âu Cơ, Tân Bình, TP. HCM
                                            </p>
                                            <p class="mar0" style="padding-left: 22px;">Tư vấn : <a
                                                    href="tel:093.843.5959">093.843.5959</a> <a
                                                    href="https://goo.gl/maps/gzMzVdQ2BxbcV3pg6" target="_blank"
                                                    class="pull-right" rel="nofollow">Xem bản đồ <i
                                                        class="fa fa-external-link"></i></a></p>
                                        </li>

                                        <li class="bold" data-target="tab-31">
                                            <!-- <p class="mar0">Showroom 2: 920-922 Kha Vạn Cân, TP.Thủ Đức - TP.HCM</p> -->
                                            <p class="mar0"><img alt="920-922 Kha Vạn Cân, TP.Thủ Đức - TP.HCM"
                                                                 width="22" height="22"
                                                                 src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2022%2022'%3E%3C/svg%3E"
                                                                 data-lazy-src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                <noscript><img alt="920-922 Kha Vạn Cân, TP.Thủ Đức - TP.HCM" width="22"
                                                               height="22"
                                                               src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                </noscript>
                                                920-922 Kha Vạn Cân, TP.Thủ Đức - TP.HCM
                                            </p>
                                            <p class="mar0" style="padding-left: 22px;">Tư vấn : <a
                                                    href="tel:090.429.3399">090.429.3399</a> <a
                                                    href="https://goo.gl/maps/ybW5qgyWkaQQExVE9" target="_blank"
                                                    class="pull-right" rel="nofollow">Xem bản đồ <i
                                                        class="fa fa-external-link"></i></a></p>
                                        </li>

                                        <li class="bold" data-target="tab-32">
                                            <!-- <p class="mar0">Showroom 3: 222 Phạm Hùng, H. Bình Chánh, TP.HCM</p> -->
                                            <p class="mar0"><img alt="222 Phạm Hùng, H. Bình Chánh, TP.HCM" width="22"
                                                                 height="22"
                                                                 src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2022%2022'%3E%3C/svg%3E"
                                                                 data-lazy-src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                <noscript><img alt="222 Phạm Hùng, H. Bình Chánh, TP.HCM" width="22"
                                                               height="22"
                                                               src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                </noscript>
                                                222 Phạm Hùng, H. Bình Chánh, TP.HCM
                                            </p>
                                            <p class="mar0" style="padding-left: 22px;">Tư vấn : <a
                                                    href="tel:0919.86.2929">0919.86.2929</a> <a
                                                    href="https://goo.gl/maps/jZ5XPMjjvszFLrw98" target="_blank"
                                                    class="pull-right" rel="nofollow">Xem bản đồ <i
                                                        class="fa fa-external-link"></i></a></p>
                                        </li>

                                        <li class="bold" data-target="tab-33">
                                            <!-- <p class="mar0">Showroom 4: 968 Quang Trung, Gò Vấp, HCM</p> -->
                                            <p class="mar0"><img alt="968 Quang Trung, Gò Vấp, HCM" width="22"
                                                                 height="22"
                                                                 src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2022%2022'%3E%3C/svg%3E"
                                                                 data-lazy-src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                <noscript><img alt="968 Quang Trung, Gò Vấp, HCM" width="22" height="22"
                                                               src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                </noscript>
                                                968 Quang Trung, Gò Vấp, HCM
                                            </p>
                                            <p class="mar0" style="padding-left: 22px;">Tư vấn : <a
                                                    href="tel:091.454.8338">091.454.8338</a> <a
                                                    href="https://goo.gl/maps/QZtDjhVeK9PNuEXe9" target="_blank"
                                                    class="pull-right" rel="nofollow">Xem bản đồ <i
                                                        class="fa fa-external-link"></i></a></p>
                                        </li>

                                        <li class="bold" data-target="tab-34">
                                            <!-- <p class="mar0">Showroom 5: 489-491 Lê Trọng Tấn, Sơn Kỳ, Tân Phú, TP.HCM</p> -->
                                            <p class="mar0"><img alt="489-491 Lê Trọng Tấn, Sơn Kỳ, Tân Phú, TP.HCM"
                                                                 width="22" height="22"
                                                                 src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2022%2022'%3E%3C/svg%3E"
                                                                 data-lazy-src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                <noscript><img alt="489-491 Lê Trọng Tấn, Sơn Kỳ, Tân Phú, TP.HCM"
                                                               width="22" height="22"
                                                               src="https://xedienvietthanh.com/wp-content/themes/auto/home.png"/>
                                                </noscript>
                                                489-491 Lê Trọng Tấn, Sơn Kỳ, Tân Phú, TP.HCM
                                            </p>
                                            <p class="mar0" style="padding-left: 22px;">Tư vấn : <a
                                                    href="tel:0915.36.9229">0915.36.9229</a> <a
                                                    href="https://maps.app.goo.gl/Did6k2rojdD3PW5H6" target="_blank"
                                                    class="pull-right" rel="nofollow">Xem bản đồ <i
                                                        class="fa fa-external-link"></i></a></p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-xs-12 col-lg-4 col-md-4 widget">
                    <div class="tab-content-map-bottom tab-content">
                        <div class="tab-pane fade active in" id="tab-00">
                            <div class="album-gallery">
                                <a href="https://goo.gl/maps/ckzibfjdjZbzsrHD6" target="_blank"
                                   title="76-78 Ô Chợ Dừa, Đống Đa, Hà Nội.">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/01/xe-dien-viet-thanh-80-o-cho-dua-dong-da-ha-noi-394x222.jpg"
                                         alt="76-78 Ô Chợ Dừa, Đống Đa, Hà Nội."/>
                                </a>
                            </div>
                            <div class="company-map">
                                <a href="https://goo.gl/maps/ckzibfjdjZbzsrHD6" target="_blank"
                                   title="76-78 Ô Chợ Dừa, Đống Đa, Hà Nội.">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/xe-dien-viet-thanh-78ocd-394x222.jpg"
                                         alt="76-78 Ô Chợ Dừa, Đống Đa, Hà Nội."/>
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="tab-01">
                            <div class="album-gallery">
                                <a href="https://goo.gl/maps/BRJktbNWEvDqcgFR8" target="_blank"
                                   title="196 Cầu Giấy, Cầu Giấy, Hà Nội">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/330287320_2192728344233383_7828883219350771513_n-min-394x222.jpg"
                                         alt="196 Cầu Giấy, Cầu Giấy, Hà Nội"/>
                                </a>
                            </div>
                            <div class="company-map">
                                <a href="https://goo.gl/maps/BRJktbNWEvDqcgFR8" target="_blank"
                                   title="196 Cầu Giấy, Cầu Giấy, Hà Nội">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2017/02/ban-do-cau-giay--394x222.jpg"
                                         alt="196 Cầu Giấy, Cầu Giấy, Hà Nội"/>
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="tab-02">
                            <div class="album-gallery">
                                <a href="https://goo.gl/maps/9FrmYaLatV2zwog17" target="_blank"
                                   title="165 Xuân Thuỷ, Cầu Giấy, Hà Nội">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/Vinfast-Xuan-Thuy-394x222.png"
                                         alt="165 Xuân Thuỷ, Cầu Giấy, Hà Nội"/>
                                </a>
                            </div>
                            <div class="company-map">
                                <a href="https://goo.gl/maps/9FrmYaLatV2zwog17" target="_blank"
                                   title="165 Xuân Thuỷ, Cầu Giấy, Hà Nội">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/vinfast-viet-thanh-xuan-thuy-cau-giay-ha-noi-394x222.jpg"
                                         alt="165 Xuân Thuỷ, Cầu Giấy, Hà Nội"/>
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="tab-03">
                            <div class="album-gallery">
                                <a href="https://goo.gl/maps/jNo7hQCtWzGWvYEw5" target="_blank"
                                   title="127 Phạm Văn Đồng, Cầu Giấy, Hà Nội.">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/125-127-pham-van-dong-1-394x222.jpg"
                                         alt="127 Phạm Văn Đồng, Cầu Giấy, Hà Nội."/>
                                </a>
                            </div>
                            <div class="company-map">
                                <a href="https://goo.gl/maps/jNo7hQCtWzGWvYEw5" target="_blank"
                                   title="127 Phạm Văn Đồng, Cầu Giấy, Hà Nội.">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/xe-dien-viet-thanh-127-pham-van-dong-394x222.jpg"
                                         alt="127 Phạm Văn Đồng, Cầu Giấy, Hà Nội."/>
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="tab-04">
                            <div class="album-gallery">
                                <a href="https://goo.gl/maps/rDQmp7rbWe1qYZRF6" target="_blank"
                                   title="521 Nguyễn Trãi, Thanh Xuân, Hà Nội">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/brandshop-yadea-nguyen-trai-394x222.jpg"
                                         alt="521 Nguyễn Trãi, Thanh Xuân, Hà Nội"/>
                                </a>
                            </div>
                            <div class="company-map">
                                <a href="https://goo.gl/maps/rDQmp7rbWe1qYZRF6" target="_blank"
                                   title="521 Nguyễn Trãi, Thanh Xuân, Hà Nội">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/yadea-viet-thanh-nguyen-trai-ha-noi-394x222.jpg"
                                         alt="521 Nguyễn Trãi, Thanh Xuân, Hà Nội"/>
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="tab-05">
                            <div class="album-gallery">
                                <a href="https://goo.gl/maps/NWD8pj4mYfdDkvBS8" target="_blank"
                                   title="603 Nguyễn Trãi, Thanh Xuân, Hà Nội">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/xe-dien-viet-thanh-603-nguyen-trai-ha-noi-394x222.jpg"
                                         alt="603 Nguyễn Trãi, Thanh Xuân, Hà Nội"/>
                                </a>
                            </div>
                            <div class="company-map">
                                <a href="https://goo.gl/maps/NWD8pj4mYfdDkvBS8" target="_blank"
                                   title="603 Nguyễn Trãi, Thanh Xuân, Hà Nội">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/xe-dien-viet-thanh-nguyen-trai-394x222.jpg"
                                         alt="603 Nguyễn Trãi, Thanh Xuân, Hà Nội"/>
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="tab-06">
                            <div class="album-gallery">
                                <a href="https://goo.gl/maps/K13pV7NhgbmgYaVU8" target="_blank"
                                   title="150 Phạm Văn Đồng, Cầu Giấy, Hà Nội.">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/125-127-pham-van-dong-394x222.jpg"
                                         alt="150 Phạm Văn Đồng, Cầu Giấy, Hà Nội."/>
                                </a>
                            </div>
                            <div class="company-map">
                                <a href="https://goo.gl/maps/K13pV7NhgbmgYaVU8" target="_blank"
                                   title="150 Phạm Văn Đồng, Cầu Giấy, Hà Nội.">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/xe-dien-viet-thanh-150-pham-van-dong-394x222.jpg"
                                         alt="150 Phạm Văn Đồng, Cầu Giấy, Hà Nội."/>
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="tab-07">
                            <div class="album-gallery">
                                <a href="https://goo.gl/maps/pe4zyJAwsbXZSeTd8" target="_blank"
                                   title="75 Đại Cồ Việt, Hai Bà Trưng, Hà Nội">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/xe-dien-viet-thanh-75-dai-co-viet-394x222.jpg"
                                         alt="75 Đại Cồ Việt, Hai Bà Trưng, Hà Nội"/>
                                </a>
                            </div>
                            <div class="company-map">
                                <a href="https://goo.gl/maps/pe4zyJAwsbXZSeTd8" target="_blank"
                                   title="75 Đại Cồ Việt, Hai Bà Trưng, Hà Nội">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/xe-dien-viet-thanh-75-dai-co-viet-ban-do-394x222.jpg"
                                         alt="75 Đại Cồ Việt, Hai Bà Trưng, Hà Nội"/>
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="tab-08">
                            <div class="album-gallery">
                                <a href="https://goo.gl/maps/ZkWzhntrTvX7vKxF9" target="_blank"
                                   title="252R Minh Khai, Hai Bà Trưng, Hà Nội">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2022/11/xe-dien-viet-thanh-252R-Minh-Khai-Hai-Ba-Trung-Ha-Noi-394x222.jpg"
                                         alt="252R Minh Khai, Hai Bà Trưng, Hà Nội"/>
                                </a>
                            </div>
                            <div class="company-map">
                                <a href="https://goo.gl/maps/ZkWzhntrTvX7vKxF9" target="_blank"
                                   title="252R Minh Khai, Hai Bà Trưng, Hà Nội">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/xe-dien-viet-thanh-252-minh-khai-ha-noi-394x222.jpg"
                                         alt="252R Minh Khai, Hai Bà Trưng, Hà Nội"/>
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="tab-09">
                            <div class="album-gallery">
                                <a href="https://goo.gl/maps/r7Gjo5fK2Aquk6NB7" target="_blank"
                                   title="4B, Tân Mai, Hoàng Mai, HN">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/4b-tan-mai-xe-dien-viet-thanh-394x222.jpg"
                                         alt="4B, Tân Mai, Hoàng Mai, HN"/>
                                </a>
                            </div>
                            <div class="company-map">
                                <a href="https://goo.gl/maps/r7Gjo5fK2Aquk6NB7" target="_blank"
                                   title="4B, Tân Mai, Hoàng Mai, HN">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2017/02/4b-tanmai-394x222.png"
                                         alt="4B, Tân Mai, Hoàng Mai, HN"/>
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="tab-010">
                            <div class="album-gallery">
                                <a href="https://goo.gl/maps/RD8aQjg3XLyqdVvq8" target="_blank"
                                   title="665 Nguyễn Văn Cừ, Long Biên, Hà Nội.">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/665-nguyen-van-cu-21-394x222.jpg"
                                         alt="665 Nguyễn Văn Cừ, Long Biên, Hà Nội."/>
                                </a>
                            </div>
                            <div class="company-map">
                                <a href="https://goo.gl/maps/RD8aQjg3XLyqdVvq8" target="_blank"
                                   title="665 Nguyễn Văn Cừ, Long Biên, Hà Nội.">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/xe-dien-viet-thanh-665-nguyen-van-cu-long-bien-394x222.jpg"
                                         alt="665 Nguyễn Văn Cừ, Long Biên, Hà Nội."/>
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="tab-10">
                            <div class="album-gallery">
                                <a href="https://goo.gl/maps/oNp6WBFCk13mmaUS7" target="_blank"
                                   title="1A Nguyễn Trãi, Ninh Xá, TP Bắc Ninh, Bắc Ninh">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/xe-dien-viet-thanh-bac-ninh-3-394x222.jpg"
                                         alt="1A Nguyễn Trãi, Ninh Xá, TP Bắc Ninh, Bắc Ninh"/>
                                </a>
                            </div>
                            <div class="company-map">
                                <a href="https://goo.gl/maps/oNp6WBFCk13mmaUS7" target="_blank"
                                   title="1A Nguyễn Trãi, Ninh Xá, TP Bắc Ninh, Bắc Ninh">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/xe-dien-viet-thanh-1a-nguyen-trai-ninh-xa-bac-ninh-394x222.jpg"
                                         alt="1A Nguyễn Trãi, Ninh Xá, TP Bắc Ninh, Bắc Ninh"/>
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="tab-11">
                            <div class="album-gallery">
                                <a href="https://goo.gl/maps/8oNq9HLHsiEkZ3n69" target="_blank"
                                   title="Phố Mới, Trần Phú, Đình Bảng, Từ Sơn, Bắc Ninh">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/xe-dien-viet-thanh-tu-son-5-394x222.jpg"
                                         alt="Phố Mới, Trần Phú, Đình Bảng, Từ Sơn, Bắc Ninh"/>
                                </a>
                            </div>
                            <div class="company-map">
                                <a href="https://goo.gl/maps/8oNq9HLHsiEkZ3n69" target="_blank"
                                   title="Phố Mới, Trần Phú, Đình Bảng, Từ Sơn, Bắc Ninh">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/xe-dien-viet-thanh-tu-son-bac-ninh-394x222.jpg"
                                         alt="Phố Mới, Trần Phú, Đình Bảng, Từ Sơn, Bắc Ninh"/>
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="tab-12">
                            <div class="album-gallery">
                                <a href="https://goo.gl/maps/2WZ8ksRASWdzoPAz6" target="_blank"
                                   title="713 Ngô Gia Tự, Ninh Xá, TP Bắc Ninh, Bắc Ninh">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/yadea-bac-ninh-2-394x222.jpg"
                                         alt="713 Ngô Gia Tự, Ninh Xá, TP Bắc Ninh, Bắc Ninh"/>
                                </a>
                            </div>
                            <div class="company-map">
                                <a href="https://goo.gl/maps/2WZ8ksRASWdzoPAz6" target="_blank"
                                   title="713 Ngô Gia Tự, Ninh Xá, TP Bắc Ninh, Bắc Ninh">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/xe-dien-viet-thanh-713-ngo-gia-tu-ninh-xa-bac-ninh-394x222.jpg"
                                         alt="713 Ngô Gia Tự, Ninh Xá, TP Bắc Ninh, Bắc Ninh"/>
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="tab-20">
                            <div class="album-gallery">
                                <a href="https://goo.gl/maps/o3ChYRy1kFU6wsXg7" target="_blank"
                                   title="Lô 01-02 Đại Hoàng Sơn, Xương Giang, Bắc Giang">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/dai-hoang-son-xuong-giang-394x222.jpg"
                                         alt="Lô 01-02 Đại Hoàng Sơn, Xương Giang, Bắc Giang"/>
                                </a>
                            </div>
                            <div class="company-map">
                                <a href="https://goo.gl/maps/o3ChYRy1kFU6wsXg7" target="_blank"
                                   title="Lô 01-02 Đại Hoàng Sơn, Xương Giang, Bắc Giang">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/xe-dien-viet-thanh-xuong-giang-bac-giang-394x222.jpg"
                                         alt="Lô 01-02 Đại Hoàng Sơn, Xương Giang, Bắc Giang"/>
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="tab-21">
                            <div class="album-gallery">
                                <a href="https://goo.gl/maps/iVSbT9GFFowuBEe49" target="_blank"
                                   title="Lô G6.1-G6.2 KĐT Rùa Vàng, TT Vôi - Lạng Giang - Bắc Giang">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/tt-voi-bac-giang-394x222.jpg"
                                         alt="Lô G6.1-G6.2 KĐT Rùa Vàng, TT Vôi - Lạng Giang - Bắc Giang"/>
                                </a>
                            </div>
                            <div class="company-map">
                                <a href="https://goo.gl/maps/iVSbT9GFFowuBEe49" target="_blank"
                                   title="Lô G6.1-G6.2 KĐT Rùa Vàng, TT Vôi - Lạng Giang - Bắc Giang">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/xe-dien-viet-thanh-voi-lang-giang-bac-giang-394x222.jpg"
                                         alt="Lô G6.1-G6.2 KĐT Rùa Vàng, TT Vôi - Lạng Giang - Bắc Giang"/>
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="tab-22">
                            <div class="album-gallery">
                                <a href="https://goo.gl/maps/JtEAFJe5vfasqBDv8" target="_blank"
                                   title="372 Thân Nhân Trung, Việt Yên, Bắc Giang">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/372-than-nhan-trung-bich-dong-viet-yen-bac-giang-2-394x222.jpg"
                                         alt="372 Thân Nhân Trung, Việt Yên, Bắc Giang"/>
                                </a>
                            </div>
                            <div class="company-map">
                                <a href="https://goo.gl/maps/JtEAFJe5vfasqBDv8" target="_blank"
                                   title="372 Thân Nhân Trung, Việt Yên, Bắc Giang">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/xe-dien-viet-thanh-viet-yen-bac-giang-394x222.jpg"
                                         alt="372 Thân Nhân Trung, Việt Yên, Bắc Giang"/>
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="tab-23">
                            <div class="album-gallery">
                                <a href="https://goo.gl/maps/aStCBQvCJrAGfFy28" target="_blank"
                                   title="Ngã Tư Cầu Lường, Quang Thịnh, Lạng Giang, Bắc Giang">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif" data-src=""
                                         alt="Ngã Tư Cầu Lường, Quang Thịnh, Lạng Giang, Bắc Giang"/>
                                </a>
                            </div>
                            <div class="company-map">
                                <a href="https://goo.gl/maps/aStCBQvCJrAGfFy28" target="_blank"
                                   title="Ngã Tư Cầu Lường, Quang Thịnh, Lạng Giang, Bắc Giang">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif" data-src=""
                                         alt="Ngã Tư Cầu Lường, Quang Thịnh, Lạng Giang, Bắc Giang"/>
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="tab-30">
                            <div class="album-gallery">
                                <a href="https://goo.gl/maps/gzMzVdQ2BxbcV3pg6" target="_blank"
                                   title="660 Âu Cơ, Tân Bình, TP. HCM">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/xe-dien-viet-thanh-sai-gon-394x222.jpg"
                                         alt="660 Âu Cơ, Tân Bình, TP. HCM"/>
                                </a>
                            </div>
                            <div class="company-map">
                                <a href="https://goo.gl/maps/gzMzVdQ2BxbcV3pg6" target="_blank"
                                   title="660 Âu Cơ, Tân Bình, TP. HCM">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/yadea-viet-thanh-sai-gon-394x222.png"
                                         alt="660 Âu Cơ, Tân Bình, TP. HCM"/>
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="tab-31">
                            <div class="album-gallery">
                                <a href="https://goo.gl/maps/ybW5qgyWkaQQExVE9" target="_blank"
                                   title="920-922 Kha Vạn Cân, TP.Thủ Đức - TP.HCM">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/920-kha-van-can-51-394x222.jpg"
                                         alt="920-922 Kha Vạn Cân, TP.Thủ Đức - TP.HCM"/>
                                </a>
                            </div>
                            <div class="company-map">
                                <a href="https://goo.gl/maps/ybW5qgyWkaQQExVE9" target="_blank"
                                   title="920-922 Kha Vạn Cân, TP.Thủ Đức - TP.HCM">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/920-kha-van-can-394x222.jpg"
                                         alt="920-922 Kha Vạn Cân, TP.Thủ Đức - TP.HCM"/>
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="tab-32">
                            <div class="album-gallery">
                                <a href="https://goo.gl/maps/jZ5XPMjjvszFLrw98" target="_blank"
                                   title="222 Phạm Hùng, H. Bình Chánh, TP.HCM">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/xe-dien-viet-thanh-222-pham-hung-394x222.jpg"
                                         alt="222 Phạm Hùng, H. Bình Chánh, TP.HCM"/>
                                </a>
                            </div>
                            <div class="company-map">
                                <a href="https://goo.gl/maps/jZ5XPMjjvszFLrw98" target="_blank"
                                   title="222 Phạm Hùng, H. Bình Chánh, TP.HCM">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/xe-dien-viet-thanh-222-pham-hung-binh-chanh-hcm-394x222.jpg"
                                         alt="222 Phạm Hùng, H. Bình Chánh, TP.HCM"/>
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="tab-33">
                            <div class="album-gallery">
                                <a href="https://goo.gl/maps/QZtDjhVeK9PNuEXe9" target="_blank"
                                   title="968 Quang Trung, Gò Vấp, HCM">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif" data-src=""
                                         alt="968 Quang Trung, Gò Vấp, HCM"/>
                                </a>
                            </div>
                            <div class="company-map">
                                <a href="https://goo.gl/maps/QZtDjhVeK9PNuEXe9" target="_blank"
                                   title="968 Quang Trung, Gò Vấp, HCM">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/968-quang-trung-go-vap-hcm-394x222.jpg"
                                         alt="968 Quang Trung, Gò Vấp, HCM"/>
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="tab-34">
                            <div class="album-gallery">
                                <a href="https://maps.app.goo.gl/Did6k2rojdD3PW5H6" target="_blank"
                                   title="489-491 Lê Trọng Tấn, Sơn Kỳ, Tân Phú, TP.HCM">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/489-le-trong-tan-son-ky-tan-phu-hcm-394x222.jpg"
                                         alt="489-491 Lê Trọng Tấn, Sơn Kỳ, Tân Phú, TP.HCM"/>
                                </a>
                            </div>
                            <div class="company-map">
                                <a href="https://maps.app.goo.gl/Did6k2rojdD3PW5H6" target="_blank"
                                   title="489-491 Lê Trọng Tấn, Sơn Kỳ, Tân Phú, TP.HCM">
                                    <img width="394" height="222" class="lazyload"
                                         src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif"
                                         data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/xe-dien-viet-thanh-489-le-trong-tan-tan-phu-hcm-394x222.jpg"
                                         alt="489-491 Lê Trọng Tấn, Sơn Kỳ, Tân Phú, TP.HCM"/>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="company_line">
            <span class="footer_hotline font20" style="display : flex">
              Hotline: <a href="tel:1900 2082" title="Hotline"><b style="color:red">1900 2082</b></a> -
                                                        <a class="tab-pane fade active in" id="phone-tab-00"
                                                           href="tel:0904.998899" title="Hotline 2"><b
                                                                style="color:red">0904.998899</b></a>
                                          <a class="tab-pane fade " id="phone-tab-01" href="tel:0986.06.3888"
                                             title="Hotline 2"><b style="color:red">0986.06.3888</b></a>
                                          <a class="tab-pane fade " id="phone-tab-02" href="tel:0988.47.6336"
                                             title="Hotline 2"><b style="color:red">0988.47.6336</b></a>
                                          <a class="tab-pane fade " id="phone-tab-03" href="tel:0986.91.5959"
                                             title="Hotline 2"><b style="color:red">0986.91.5959</b></a>
                                          <a class="tab-pane fade " id="phone-tab-04" href="tel:0916.87.2266"
                                             title="Hotline 2"><b style="color:red">0916.87.2266</b></a>
                                          <a class="tab-pane fade " id="phone-tab-05" href="tel:0984.44.3388"
                                             title="Hotline 2"><b style="color:red">0984.44.3388</b></a>
                                          <a class="tab-pane fade " id="phone-tab-06" href="tel:091.162.3388"
                                             title="Hotline 2"><b style="color:red">091.162.3388</b></a>
                                          <a class="tab-pane fade " id="phone-tab-07" href="tel:0981319559"
                                             title="Hotline 2"><b style="color:red">0981319559</b></a>
                                          <a class="tab-pane fade " id="phone-tab-08" href="tel:0973572233"
                                             title="Hotline 2"><b style="color:red">0973572233</b></a>
                                          <a class="tab-pane fade " id="phone-tab-09" href="tel:0931824888"
                                             title="Hotline 2"><b style="color:red">0931824888</b></a>
                                          <a class="tab-pane fade " id="phone-tab-010" href="tel:0916.05.5588"
                                             title="Hotline 2"><b style="color:red">0916.05.5588</b></a>
                                                        <a class="tab-pane fade " id="phone-tab-10"
                                                           href="tel:0987.97.2299" title="Hotline 2"><b
                                                                style="color:red">0987.97.2299</b></a>
                                          <a class="tab-pane fade " id="phone-tab-11" href="tel:0985.79.2299"
                                             title="Hotline 2"><b style="color:red">0985.79.2299</b></a>
                                          <a class="tab-pane fade " id="phone-tab-12" href="tel:0982.51.3399"
                                             title="Hotline 2"><b style="color:red">0982.51.3399</b></a>
                                                        <a class="tab-pane fade " id="phone-tab-20"
                                                           href="tel:0985.95.9339" title="Hotline 2"><b
                                                                style="color:red">0985.95.9339</b></a>
                                          <a class="tab-pane fade " id="phone-tab-21" href="tel:0967.07.9898"
                                             title="Hotline 2"><b style="color:red">0967.07.9898</b></a>
                                          <a class="tab-pane fade " id="phone-tab-22" href="tel:0966.888.372"
                                             title="Hotline 2"><b style="color:red">0966.888.372</b></a>
                                          <a class="tab-pane fade " id="phone-tab-23" href="tel:0979.550.668"
                                             title="Hotline 2"><b style="color:red">0979.550.668</b></a>
                                                        <a class="tab-pane fade " id="phone-tab-30"
                                                           href="tel:093.843.5959" title="Hotline 2"><b
                                                                style="color:red">093.843.5959</b></a>
                                          <a class="tab-pane fade " id="phone-tab-31" href="tel:090.429.3399"
                                             title="Hotline 2"><b style="color:red">090.429.3399</b></a>
                                          <a class="tab-pane fade " id="phone-tab-32" href="tel:0919.86.2929"
                                             title="Hotline 2"><b style="color:red">0919.86.2929</b></a>
                                          <a class="tab-pane fade " id="phone-tab-33" href="tel:091.454.8338"
                                             title="Hotline 2"><b style="color:red">091.454.8338</b></a>
                                          <a class="tab-pane fade " id="phone-tab-34" href="tel:0915.36.9229"
                                             title="Hotline 2"><b style="color:red">0915.36.9229</b></a>
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
                    <p class="head text-uppercase">Công ty TNHH Xe Máy Xe Điện Việt Thanh</p>
                    <p>GPKD số 0110285252 do Sở KH và ĐT TP Hà Nội cấp ngày 23/09/2022</p>
                    <p>Địa chỉ: 127 Phạm Văn Đồng, P. Mai Dịch, Q. Cầu Giấy, Tp. Hà Nội</p>
                    <p>Hotline: 0904998899</p>
                    <p>Email: xedienvietthanh@gmail.com </p>
                    <!-- <p><a href="http://online.gov.vn/Home/WebDetails/100389" rel="nofollow" target= "_blank"><img src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%200%200'%3E%3C/svg%3E" alt="da thong bao bo cong thuong" data-lazy-src="http://xedienvietthanh.com/wp-content/themes/auto/images/da-thong-bao-bo-cong-thuong-xedienvietthanh.png"><noscript><img src="http://xedienvietthanh.com/wp-content/themes/auto/images/da-thong-bao-bo-cong-thuong-xedienvietthanh.png" alt="da thong bao bo cong thuong"></noscript></a></p> -->
                </div>
                <div class="col-xs-12 col-lg-6 col-md-6 ">
                    <div class="form-check-bao-hanh hidden-xs hidden-sm">
                        <p class="head">KIỂM TRA THỜI HẠN BẢO HÀNH</p>
                        <div class="wrap">
                            <form method="post" action="">
                                <input type="text" name="motor" id="motor" placeholder="Nhập thông tin motor ..."/>
                                <input type="submit" value="Kiểm tra"/>
                            </form>
                        </div>
                    </div>
                    <div class="statistic">
                        <div class="pull-left"><span><i class="fa fa-rss"></i>&nbsp; Đã truy câp: 595792</span>
                            <span><i class="fa fa-users"></i>&nbsp;283 Đang online</span>
                        </div>
                        <div class="share_link">
                            <a class="fb" href="https://www.facebook.com/tapdoanxedien" rel="nofollow" title="associal"
                               target="_blank"></a>
                            <a class="google" href="https://plus.google.com/+xedienvietthanh" rel="nofollow"
                               title="associal" target="_blank"></a>
                            <a class="youtube" href="https://www.youtube.com/xedienvietthanh" rel="nofollow"
                               title="associal" target="_blank"></a>
                        </div>
                    </div>
                </div>
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
                               alt="19002082"></noscript>
                <span class="d-flex flex-column "><span>Gọi miễn phí</span><span
                        class="cl_yellow animated infinite tada">19002082</span></span>
            </p>
        </li>
        <li><a target="_blank" href="https://m.me/tapdoanxedien" rel="nofollow" class="cfb d-flex align-items-center">
                <img width="30" height="30"
                     src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2030%2030'%3E%3C/svg%3E"
                     alt="Chat FB"
                     data-lazy-src="https://xedienvietthanh.com/wp-content/themes/auto/images/2022/facebook.png">
                <noscript><img width="30" height="30"
                               src="https://xedienvietthanh.com/wp-content/themes/auto/images/2022/facebook.png"
                               alt="Chat FB"></noscript>
                <span>Chat FB</span>
            </a></li>
        <li><a target="_blank" href="https://zalo.me/4331786281350876766" rel="nofollow"
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
        <li><a href="https://xedienvietthanh.com/he-thong-mua-hang/" rel="nofollow"
               class="cmap d-flex align-items-center">
                <img width="30" height="30"
                     src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2030%2030'%3E%3C/svg%3E"
                     alt="Chỉ đường"
                     data-lazy-src="https://xedienvietthanh.com/wp-content/themes/auto/images/2022/google-maps.png">
                <noscript><img width="30" height="30"
                               src="https://xedienvietthanh.com/wp-content/themes/auto/images/2022/google-maps.png"
                               alt="Chỉ đường"></noscript>
                <span>Chỉ đường</span>
            </a></li>
    </ul>
</div>

<!-- The modal -->
<div class="modal fade" id="flipFlop" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalLabel">Nhập số điện thoại để được gọi lại ngay</h4>
            </div>
            <div class="modal-body text-center">
                <div role="form" class="wpcf7" id="wpcf7-f19666-o1" lang="vi" dir="ltr">
                    <div class="screen-reader-response"><p role="status" aria-live="polite" aria-atomic="true"></p>
                        <ul></ul>
                    </div>
                    <form action="/ac-quy-yadea-60v-22ah-ttfar/#wpcf7-f19666-o1" method="post" class="wpcf7-form init"
                          novalidate="novalidate" data-status="init">
                        <div style="display: none;">
                            <input type="hidden" name="_wpcf7" value="19666"/>
                            <input type="hidden" name="_wpcf7_version" value="5.6.4"/>
                            <input type="hidden" name="_wpcf7_locale" value="vi"/>
                            <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f19666-o1"/>
                            <input type="hidden" name="_wpcf7_container_post" value="0"/>
                            <input type="hidden" name="_wpcf7_posted_data_hash" value=""/>
                        </div>
                        <div class="form-group">
                            <span class="wpcf7-form-control-wrap" data-name="sdt"><input type="text" name="sdt" value=""
                                                                                         size="40"
                                                                                         class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control text-center"
                                                                                         aria-required="true"
                                                                                         aria-invalid="false"
                                                                                         placeholder="Nhập số điện thoại"/></span>
                        </div>
                        <div class="form-group text-center justify-content-between">
                            <span class="wpcf7-form-control-wrap" data-name="chon_ho_tro"><span
                                    class="wpcf7-form-control wpcf7-radio"><span
                                        class="wpcf7-list-item first"><label><input type="radio" name="chon_ho_tro"
                                                                                    value="Hỗ trợ mua hàng"
                                                                                    checked="checked"/><span
                                                class="wpcf7-list-item-label">Hỗ trợ mua hàng</span></label></span><span
                                        class="wpcf7-list-item"><label><input type="radio" name="chon_ho_tro"
                                                                              value="Hỗ trợ kỹ thuật"/><span
                                                class="wpcf7-list-item-label">Hỗ trợ kỹ thuật</span></label></span><span
                                        class="wpcf7-list-item last"><label><input type="radio" name="chon_ho_tro"
                                                                                   value="Hỗ trợ bảo hành"/><span
                                                class="wpcf7-list-item-label">Hỗ trợ bảo hành</span></label></span></span></span>
                        </div>
                        <div class="form-group text-center d-flex flex-column justify-content-center">
                            <input type="submit" value="Gửi yêu cầu"
                                   class="wpcf7-form-control has-spinner wpcf7-submit btn-save-phone"/>
                        </div>
                        <div class="wpcf7-response-output" aria-hidden="true"></div>
                    </form>
                </div>
                <p class="line-hoac text-center"><span>Hoặc</span></p>
                <p class=" text-center">Gọi ngay với chúng tôi qua hotline</p>
                <ul class="list-hotline abs">
                    <li><a rel="nofollow" href="tel:19002082"><span class="hotline-title">Miễn phí cước gọi</span><span>1900.2082</span></a>
                    </li>
                    <li><a rel="nofollow" href="tel:0904.998.899"><span
                                class="hotline-title">Mua hàng miền bắc</span><span>0904.998.899</span></a></li>
                    <li><a rel="nofollow" href="tel:0919.862.929"><span
                                class="hotline-title">Mua hàng miền nam</span><span>0919.862.929</span></a></li>
                    <li><a rel="nofollow" href="tel:0988.862.386"><span class="hotline-title">Bảo hành</span><span>0988.862.386</span></a>
                    </li>
                    <li><a rel="nofollow" href="tel:0988.862.386"><span class="hotline-title">Kỹ thuật</span><span>0988.862.386</span></a>
                    </li>
                    <li><a rel="nofollow" href="tel:0986.915.959"><span class="hotline-title">Zalo</span><span>0986.915.959</span></a>
                    </li>
                    <li><a rel="nofollow" href="tel:0903.043.333"><span class="hotline-title">Khiếu nại</span><span>0903.043.333</span></a>
                    </li>

                    <!-- <li><a rel="nofollow" href="0904.998899"><span class="hotline-title">Mua hàng miền Bắc</span><span>0904.998899</span></a></li><li><a rel="nofollow" href="0919.86.2929"><span class="hotline-title">Mua hàng miền Nam</span><span>0919.86.2929</span></a></li><li><a rel="nofollow" href="0988.862386"><span class="hotline-title">Bảo hành</span><span>0988.862386</span></a></li><li><a rel="nofollow" href="098.131.9559"><span class="hotline-title">Kỹ Thuật</span><span>098.131.9559</span></a></li><li><a rel="nofollow" href="0986.91.5959"><span class="hotline-title">Zalo</span><span>0986.91.5959</span></a></li><li><a rel="nofollow" href="0903.04.3333"><span class="hotline-title">Khiếu nại </span><span>0903.04.3333</span></a></li> -->
                </ul>
            </div>
        </div>
    </div>
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
        src="https://xedienvietthanh.com/wp-content/cache/min/1/wp-content/themes/auto/fotorama/fotorama.js?ver=1694882061"
        data-rocket-type="text/javascript" defer></script>

<script type="rocketlazyloadscript" data-minify="1"
        src="https://xedienvietthanh.com/wp-content/cache/min/1/wp-content/themes/auto/js/jquery_tdxd.js?ver=1694882061"
        defer></script>
<script type="rocketlazyloadscript" data-minify="1"
        src="https://xedienvietthanh.com/wp-content/cache/min/1/wp-content/themes/auto/js/detail-prod.js?ver=1694882061"
        defer></script>
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
<script type="rocketlazyloadscript" data-rocket-type="text/javascript">
    window.onload = function() {
      $( "#qb_quantity" ).blur(function() {

          qualty = $('#qb_quantity').val();

          tongtien = qualty * 4000000 ;

          $('#tongtien, #qb_thanh_tien').html(formatNumber(tongtien));

        });

    }
</script>

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

<!-- BK MODAL -->
<!-- <div id='bk-modal'></div> -->
<!-- END BK MODAL -->

<!-- This website is like a Rocket, isn't it? Performance optimized by WP Rocket. Learn more: https://wp-rocket.me - Debug: cached@1695613711 -->