(window.webpackJsonp=window.webpackJsonp||[]).push([[4],{135:function(e,t,n){"use strict";n.r(t);var l=n(39),a=n(50),c=n(11);l.a.registerPlugin(a.a);t.default=function(){var e=document.getElementById("slider"),t=document.getElementById("slider-nav");if(e&&t){var n,a,i=e.querySelectorAll(".slide"),o=t.querySelectorAll("button"),s=0,d=function(t){a.kill(),Object(c.b)(i,(function(e){e.classList.remove("on")})),e.querySelector('[data-startup="'+t.dataset.slide+'"').classList.add("on"),Object(c.b)(o,(function(e){e.classList.remove("on")})),t.classList.add("on"),t.blur(),a=l.a.delayedCall(5,r)},r=function(){s=[].indexOf.call(o,t.querySelector(".on")),n=o[s+1]?o[s+1]:o[0],d(n)};a=l.a.delayedCall(5,r),Object(c.b)(o,(function(e){e.addEventListener("click",(function(){d(e)}),!1)}))}}}}]);