!function r(o,i,d){function u(t,e){if(!i[t]){if(!o[t]){var n="function"==typeof require&&require;if(!e&&n)return n(t,!0);if(c)return c(t,!0);throw(e=new Error("Cannot find module '"+t+"'")).code="MODULE_NOT_FOUND",e}n=i[t]={exports:{}},o[t][0].call(n.exports,function(e){return u(o[t][1][e]||e)},n,n.exports,r,o,i,d)}return i[t].exports}for(var c="function"==typeof require&&require,e=0;e<d.length;e++)u(d[e]);return u}({1:[function(e,t,n){"use strict";document.addEventListener("DOMContentLoaded",function(e){var t=document.getElementById("leoadd-show-auth-form"),n=document.getElementById("leoadd-auth-container"),r=document.getElementById("leoadd-auth-close");t.addEventListener("click",function(){n.classList.add("show"),t.parentElement.classList.add("hide")}),r.addEventListener("click",function(){n.classList.remove("show"),t.parentElement.classList.remove("hide")})})},{}]},{},[1]);
//# sourceMappingURL=auth.js.map
