(window.webpackJsonp=window.webpackJsonp||[]).push([[0],{129:function(e,t,o){"use strict";o.r(t);t.default=function(){var e=document.getElementById("history"),t=document.getElementById("periods");if(e&&t){var o=t.querySelectorAll("button");o.forEach((function(t){t.addEventListener("click",(function(){!function(t){if(t.classList.contains("on"))return e.querySelectorAll(".dates").forEach((function(e){e.classList.remove("off")})),void t.classList.remove("on");e.querySelectorAll(".dates").forEach((function(e){e.dataset.period===t.dataset.field?e.classList.remove("off"):e.classList.add("off")})),o.forEach((function(e){e.classList.remove("on")})),t.classList.add("on")}(t)}),!1)}))}}}}]);