(window.webpackJsonp=window.webpackJsonp||[]).push([[7,0],{137:function(e,n){var t;(t=Element.prototype).after||(t.after=function(){var e,n=arguments,t=n.length,o=0,i=this,c=i.parentNode,a=Node,r=String,d=document;if(null!==c)for(;o<t;)(e=n[o])instanceof a?null!==(i=i.nextSibling)?c.insertBefore(e,i):c.appendChild(e):c.appendChild(d.createTextNode(r(e))),++o})},143:function(e,n,t){"use strict";t.r(n);t(137);var o=t(8),i=t(101),c=t(5);o.a.registerPlugin(i.a);n.default=function(){var e=document.getElementById("team");if(e){var n,t,i,a=e.querySelectorAll(".team-member"),r=a.length,d=document.createElement("div"),l=document.createElement("div"),s=0,p=5,u=0,f=0,m=function e(s){o.a.isTweening("#desc")||o.a.to(l,.3,{opacity:0,onComplete:function(){s.blur(),l.innerHTML="",s.classList.contains("on")?Object(c.b)(a,(function(e){e.classList.remove("off"),e.classList.remove("on")})):(Object(c.b)(a,(function(e){e.classList.add("off"),e.classList.remove("on")})),s.classList.remove("off"),s.classList.add("on"),n=s.parentElement,l.appendChild(n.querySelector(".name").cloneNode(!0)),l.appendChild(n.querySelector(".function").cloneNode(!0)),l.appendChild(n.querySelector(".team-desc").cloneNode(!0)),d.appendChild(l),u=[].indexOf.call(a,s),f=(Math.floor(u/p)+1)*p-1,a[f=f>=r?r-1:f].parentElement.after(d),l.querySelector(".next").addEventListener("click",(function(){t=a[u+1]?a[u+1]:a[0],e(t)}),!1),l.querySelector(".prev").addEventListener("click",(function(){i=a[u-1]?a[u-1]:a[r-1],e(i)}),!1),o.a.to(window,{duration:.5,scrollTo:s.parentElement}),o.a.to(l,.3,{opacity:1}))}})},w=function(){s=window.$stereorepo.superWindow.windowWidth,p=s>=960?5:s>=580?3:2};window.$stereorepo.superWindow.initializeWindow(),window.$stereorepo.superWindow.addResizeFunction(w),w(),d.className="wrapper-desc",l.className="container",l.id="desc",d.appendChild(l),Object(c.b)(a,(function(e){e.addEventListener("click",(function(){m(e)}),!1)}))}}}}]);