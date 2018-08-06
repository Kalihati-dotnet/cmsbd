(function(global, factory) {
    typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
        typeof define === 'function' && define.amd ? define(factory) :
            (global.bd = factory());
}(this, (function() {
    'use strict';
    var bd = {};
    bd.hide = function(s) {
        var e = bd.selectElements(s), i, l = e.length;
        for (i = 0; i < l; i++) {
            bd.hideElement(e[i])
        }
    };
    bd.show = function(s) {
        var e = bd.selectElements(s);
        bd.showElements(e);
    };
    bd.showElements = function(e) {
        var i, l = e.length;
        for (i = 0; i < l; i++) {
            bd.showElement(e[i])
        }
    };
    bd.selectElements = function(id) {
        if (typeof id == "object") {
            return [id];
        } else {
            return document.querySelectorAll(id);
        }
    };
    bd.styleElement = function(e, p, v) {
        e.style.setProperty(p, v);
    };
    bd.hideElement = function(e) {
        bd.styleElement(e, "display", "none");
    };
    bd.showElement = function(e) {
        bd.styleElement(e, "display", "block");
    };
    bd.showTime = function(e) {
        var today = new Date(),
            hours = today.getHours(),
            minutes = today.getMinutes(),
            //seconds = today.getSeconds(),
            ampm = hours >= 12 ? 'pm' : 'am';

        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        hours = hours < 10 ? '0' + hours : hours; // leading '02'
        minutes = minutes < 10 ? '0' + minutes : minutes; // leading '02
        //document.getElementById(e).innerHTML = hours + ':' + minutes + ':' + seconds;
        document.getElementById(e).innerHTML = hours + ' : ' + minutes + ' ' + ampm;

        setTimeout(function() {
            bd.showTime(e);
        }, 60000);
    };

    bd.setCookie = function(name, value, days = null, path = '/', domain = null, secure = false) {
        const date = new Date();
        const type = typeof (value);
        let expires = '', valueToUse = '', secureFlag = '', domainFlag = '';

        if (days) {
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = `; expires=${date.toUTCString()}`;
        }
        if (type === 'object' && type !== 'undefined') {
            valueToUse = encodeURIComponent(JSON.stringify({ value }));
        } else {
            valueToUse = encodeURIComponent(value);
        }
        if (secure) {
            secureFlag = '; secure';
        }
        if (domain) {
            domainFlag = `; domain=${encodeURIComponent(domain)}`;
        }
        document.cookie = `${name}=${valueToUse}${expires}; path=${path}${secureFlag}${domainFlag}`;
    };

    bd.getCookie = function(name) {
        const nameEQ = `${name}=`;
        const split = document.cookie.split(';');
        let value = null;
        split.forEach(item => {
            const cleaned = item.trim();
            if (cleaned.indexOf(nameEQ) === 0) {
                value = decodeURIComponent(cleaned.substring(nameEQ.length, cleaned.length));
                if (value.substring(0, 1) === '{') {
                    try {
                        value = JSON.parse(value);
                        value = value.value || null;
                    } catch (e) {
                        return;
                    }
                }
                if (value === 'undefined') {
                    value = undefined;
                }
            }
        });
        return value;
    };
    bd.removeCookie = function(name) {
        this.setCookie(name, '', -1);
    };

    bd.getHttp = function(url) {
        var xhr, token = document.querySelector('meta[name="csrf-token"]').content;
        try {
            if (window.XMLHttpRequest) { // Mozilla, Safari, IE7+ ...
                xhr = new XMLHttpRequest();
            } else if (window.ActiveXObject) { // IE 6 and older
                xhr = new ActiveXObject("MSXML2.XMLHTTP.3.0");
            }
            xhr.open("GET", url, true);
            xhr.setRequestHeader('X-CSRF-TOKEN', token);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        console.log(xhr.responseType);
                    } else {
                        console.log(xhr.status);
                        // alert('something went wrong!');
                    }
                }
            };
            xhr.send(null);
        } catch (e) {
            console.log(e);
        }
    };

    bd.getFullUrl = function(){
        return decodeURIComponent(window.location.origin + window.location.pathname);
    };

    bd.getUrlPrmVal = function(prm){
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),sParameterName,i;
        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] === prm) {
                return sParameterName[1] === undefined ? true : sParameterName[1];
            }
        }
    };

    bd.alertConfirm = function(){
        
    };
    return bd;
})));