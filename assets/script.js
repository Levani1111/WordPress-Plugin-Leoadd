!function n(i,a,c){function o(t,e){if(!a[t]){if(!i[t]){var r="function"==typeof require&&require;if(!e&&r)return r(t,!0);if(u)return u(t,!0);throw(e=new Error("Cannot find module '"+t+"'")).code="MODULE_NOT_FOUND",e}r=a[t]={exports:{}},i[t][0].call(r.exports,function(e){return o(i[t][1][e]||e)},r,r.exports,n,i,a,c)}return a[t].exports}for(var u="function"==typeof require&&require,e=0;e<c.length;e++)o(c[e]);return o}({1:[function(e,t,r){"use strict";window.addEventListener("load",function(){for(var e=document.querySelectorAll("ul.nav-tabs > li"),t=0;t<e.length;t++)e[t].addEventListener("click",r);function r(e){e.preventDefault(),document.querySelector("ul.nav-tabs li.active").classList.remove("active"),document.querySelector(".tab-pane.active").classList.remove("active");var t=e.currentTarget,e=e.target.getAttribute("href");t.classList.add("active"),document.querySelector(e).classList.add("active")}});for(var n=0;n<tabs.length;n++)tabs[n].addEventListener("click",switchTab)},{}]},{},[1]);
//# sourceMappingURL=script.js.map
