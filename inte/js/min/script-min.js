"use strict";$(function(){function e(e){var t=e>b?-1:1;return b=e,t}function t(e){var t=e.html();return'<span class="before">'+t+'</span><span class="after">'+t+"</span>"}function i(e,t){if(N.length&&H.length&&!v.hasClass("menu-open")&&(e>N.offset().top-y-40?C.addClass("fixed"):C.removeClass("fixed"),C.hasClass("fixed")&&(0>t?C.addClass("on"):C.removeClass("on"))),q.length&&(M.hasClass("single-post")||M.hasClass("page-template-default"))){var i=(e-N.offset().top)/(N.innerHeight()-f);e>N.offset().top&&TweenMax.set(q,{scaleX:i})}}function n(){function e(){var e=0,i=t.length,n=t.eq(0).innerWidth();for(e;i>e;e++){var a=t.eq(e).offset().left+n;a>w||n>a?t.eq(e).addClass("off"):t.eq(e).removeClass("off")}}var t=D.find(".spotlight-post"),i=D.find(".container").innerWidth();e(),i>w?P?P[0].enable():P=Draggable.create("#spotlightDrag",{type:"x",bounds:D,cursor:"grab",throwProps:!0,edgeResistance:.65,onDrag:e,onDragStart:function(){D.find(".container").addClass("grabbing")},onDragEnd:function(){D.find(".container").removeClass("grabbing")}}):P&&(P[0].disable(),TweenMax.set(P,{x:"0px"}))}function a(e){var t=20,i=B.innerHeight(),n=N.offset().top,a=N.innerHeight();a+2*t>i&&f>i+y+t?e>=S-y-t?(e+i+y+t>n+a-t?B.css({top:a-t-i+20,width:k}).removeClass("fixed").addClass("fixedBot"):B.css({top:y+t,width:k}).removeClass("fixedBot").addClass("fixed"),e>(a+n)/2?(B.find("li").eq(0).find(".img").addClass("off"),B.find("li").eq(1).find(".img").addClass("on")):(B.find("li").eq(0).find(".img").removeClass("off"),B.find("li").eq(1).find(".img").removeClass("on"))):B.css({top:0,width:k}).removeClass("fixed fixedBot"):B.css({top:0}).removeClass("fixed fixedBot")}function o(e){var t=e.length,i=0;for(TweenMax.set(e,{opacity:0}),i;t>i;i++)new ScrollMagic.Scene({triggerElement:e[i]}).triggerHook(.7).setTween(TweenMax.to(e.eq(i),.25,{opacity:1})).addTo(u)}function s(){TweenMax.set([E.find(".menu-title"),E.find(".menu-subtitle")],{y:"-100%",opacity:0}),TweenMax.set(E.find("li"),{y:"-120%",opacity:0})}function l(e,t,i){function n(e){var i=Math.floor(Math.random()*t);$("a",m).removeClass("on"),setTimeout(function(){if(!$(".grid").hasClass("is-hovered")){var t=m.eq(e);$("a",t).addClass("on")}},1500),setTimeout(n,3500,i)}var a='<div class="grid">',o=0,s=0,l=0,d=0,r=.1,p=.4,c,h=0,m;t>37&&(r+=.02,p-=.02),t>60&&(r+=.05,p-=.05);var g,f=Math.ceil(r*t),w=Math.ceil(p*t),b=t-(f+w),x=[f,Math.floor(w/2),Math.ceil(w/2),Math.ceil(b/3),Math.ceil(b/3),Math.floor(b/3)];for(l;i>l;l++)s+=x[l];for(s>t&&(x[4]-=1),g=0,l=0;i>l;l++){for(a+='<div class="po-item-col col-2">',d=0;d<x[l];d++)3===l&&d===x[l]-1&&(a+='<div class="po-item cta">'+$("#ctaPortfolio").html()+"</div>"),a+=$("ul.grid > li").eq(g).hasClass("transfered")?'<div class="po-item transfered">'+F.find("li").eq(d+o).html()+"</div>":'<div class="po-item">'+F.find("li").eq(d+o).html()+"</div>",g++;o+=d,a+="</div>"}for(a+="</div>",F.find(".container").append(a),TweenMax.set(F.find(".po-item"),{opacity:0,y:"30%",scale:.8}),l=0;t+1>l;l++)new ScrollMagic.Scene({triggerElement:F.find(".po-item")[l]}).triggerHook(.9).setTween(TweenMax.to(F.find(".po-item").eq(l),.25,{opacity:1,y:"0%",scale:1})).addTo(u);c=F.find("div.grid").find(".transfered"),h=c.length,m=F.find(".po-item"),n(0)}function d(e){if(le=e.closest("li"),oe=$(".desc",le),se=oe.outerHeight(),!TweenMax.isTweening(R.find("li"))&&!TweenMax.isTweening(R.find(".desc"))&&!TweenMax.isTweening($(".wrapper-btn-glob")))if(R.hasClass("member-open"))if(le.hasClass("open")){h();var t=$(".team.member-open > li.open");pe=$(".desc",t),ce=new TimelineMax,$(window).width()>979?(ce.to(pe,.25,{opacity:0,visibility:"hidden"}),ce.to(t,.5,{paddingBottom:"0",ease:Cubic.easeInOut})):(ce.to(be,.25,{opacity:0}),ce.to(be,.5,{height:"0",visibility:"hidden",ease:Cubic.easeInOut})),ce.set(t,{className:"-=open"}),ce.set(R,{className:"-=member-open"}),TweenMax.to($(".wrapper-btn-glob"),.5,{height:"100%",ease:Cubic.easeInOut})}else{var t=$(".team.member-open > li.open");pe=$(".desc",t),ce=new TimelineMax,$(window).width()>979?(Q=t.offset().top<le.offset().top?R.offset().top+le.position().top-parseFloat(t.css("paddingBottom"))-120:R.offset().top+le.position().top-120,ce.to(pe,.25,{opacity:0,visibility:"hidden"}),ce.set(t,{className:"-=open"}),ce.set(le,{className:"+=open"}),ce.add("paddingAnimation").to(t,.5,{paddingBottom:"0",ease:Cubic.easeInOut},"paddingAnimation").to(le,.25,{paddingBottom:se+"px",ease:Cubic.easeIn},"paddingAnimation").to(window,.5,{scrollTo:{y:Q},ease:Cubic.easeOut},"paddingAnimation"),ce.to(oe,.25,{opacity:1,visibility:"visible"})):(Q=le.offset().top-120,ce.to(be,.25,{opacity:0,visibility:"hidden"}),ce.set(t,{className:"-=open"}),ce.set(le,{className:"+=open",onComplete:function(){be.html(oe.html()),TweenMax.set(be,{height:"auto",position:"absolute"}),xe=be.outerHeight(),TweenMax.set(be,{height:"0",position:"relative"})}}),ce.add("heightAnimation").to(be,.5,{height:xe+"px",ease:Cubic.easeInOut},"heightAnimation").to(window,.5,{scrollTo:{y:Q},ease:Cubic.easeOut},"heightAnimation"),ce.to(be,.25,{opacity:1,visibility:"visible"}),$e=le.position().left,Te=$(".container-team").width(),ve=$e-Te/2+le.outerWidth()/2,TweenMax.to(R,.5,{x:-ve,ease:Cubic.easeOut,onComplete:c}))}else if(Q=le.offset().top-120,TweenMax.set(R,{className:"+=member-open"}),de=new TimelineMax,de.set(le,{className:"+=open"}),c(),$(window).width()>979)de.add("paddingAnimation").to(le,.5,{paddingBottom:se+"px",ease:Cubic.easeOut},"paddingAnimation").to(window,.5,{scrollTo:{y:Q},ease:Cubic.easeOut},"paddingAnimation"),de.to(oe,.25,{opacity:1,visibility:"visible"});else{be.html(oe.html()),TweenMax.set(be,{height:"auto",position:"absolute"}),xe=be.outerHeight(),TweenMax.set(be,{height:"0",position:"relative"}),de.add("heightAnimation").to(be,.5,{height:xe+"px",ease:Cubic.easeInOut},"heightAnimation").to(window,.5,{scrollTo:{y:Q},ease:Cubic.easeOut},"heightAnimation"),de.to(be,.25,{opacity:1,visibility:"visible"});var i=Math.max.apply(null,R.find(".team-member").map(function(){return $(this).height()}).get());TweenMax.to($(".wrapper-btn-glob"),.5,{height:i+10+"px",ease:Cubic.easeInOut}),$e=le.position().left,Te=$(".container-team").width(),ve=$e-Te/2+le.outerWidth()/2,TweenMax.to(R,.5,{x:-ve,ease:Cubic.easeOut,onComplete:c})}}function r(){if(!TweenMax.isTweening(R.find("li"))&&!TweenMax.isTweening(R.find(".desc"))&&!TweenMax.isTweening($(".wrapper-btn-glob"))){var e=$(".team.member-open > li.open");pe=$(".desc",e),ce=new TimelineMax,ce.to(pe,.25,{opacity:0,visibility:"hidden"}),ce.set(e,{className:"-=open"}),he=$(this).hasClass("left")?e.prev().length?e.prev():R.find("> li").last():e.next().length?e.next():R.find("> li").first(),Q=e.offset().top<he.offset().top?R.offset().top+he.position().top-parseFloat(e.css("paddingBottom"))-120:he.offset().top-120,me=$(".desc",he),ge=me.outerHeight(),ce.set(he,{className:"+=open"}),ce.add("paddingAnimation").to(he,.25,{paddingBottom:ge+"px",ease:Cubic.easeIn},"paddingAnimation").to(e,.5,{paddingBottom:"0",ease:Cubic.easeOut},"paddingAnimation").to(window,.5,{scrollTo:{y:Q},ease:Cubic.easeOut},"paddingAnimation"),ce.to(me,.25,{opacity:1,visibility:"visible"})}}function p(e){if(!(TweenMax.isTweening(R.find("li"))||TweenMax.isTweening(R.find(".desc"))||TweenMax.isTweening($(".wrapper-btn-glob"))||TweenMax.isTweening(R)))if(c(),e.closest(".wrapper-btn-glob").hasClass("open")&&(e.hasClass("left")?TweenMax.to(R,.25,{x:"+="+X,ease:Cubic.easeInOut}):TweenMax.to(R,.25,{x:"-="+X,ease:Cubic.easeInOut})),$(window).width()<=979&&R.hasClass("member-open")&&e.closest(".wrapper-btn-glob").hasClass("open")){var t=$(".team.member-open > li.open");pe=$(".desc",t),ce=new TimelineMax,ce.to(be,.25,{opacity:0,visibility:"hidden"}),ce.set(t,{className:"-=open"}),he=e.hasClass("left")?t.prev():t.next(),Q=he.offset().top-120,me=$(".desc",he),ce.set(he,{className:"+=open",onComplete:function(){be.html(me.html()),TweenMax.set(be,{height:"auto",position:"absolute"}),xe=be.outerHeight(),TweenMax.set(be,{height:"0",position:"relative"})}}),ce.add("heightAnimation").to(be,.5,{height:xe+"px",ease:Cubic.easeInOut},"heightAnimation").to(window,.5,{scrollTo:{y:Q},ease:Cubic.easeOut},"heightAnimation"),ce.to(be,.25,{opacity:1,visibility:"visible",onComplete:c})}else h()}function c(){if($(window).width()<=979){var e=$(".team > li").length,t=R.offset().left-20,i=t+R.width(),n=$(".container-team").width(),a=0,o=0;R.find("li").hasClass("open")&&(a=R.find("> li.open").position().left,o=R.find("> li.open").offset().left),$(window).width()>767&&e>5?(TweenMax.set($(".wrapper-btn-glob.prev"),{className:"-=open"}),TweenMax.set($(".wrapper-btn-glob.next"),{className:"-=open"}),t<-Math.ceil(2*X)&&TweenMax.set($(".wrapper-btn-glob.prev"),{className:"+=open"}),Math.ceil(i+2*X)>n&&TweenMax.set($(".wrapper-btn-glob.next"),{className:"+=open"})):$(window).width()<=767&&e>3&&(TweenMax.set($(".wrapper-btn-glob.prev"),{className:"-=open"}),TweenMax.set($(".wrapper-btn-glob.next"),{className:"-=open"}),t<-Math.ceil(X)&&TweenMax.set($(".wrapper-btn-glob.prev"),{className:"+=open"}),Math.ceil(i+X)>n&&TweenMax.set($(".wrapper-btn-glob.next"),{className:"+=open"}))}else TweenMax.set($(".wrapper-btn-glob"),{className:"-=open"})}function h(){TweenMax.set($(".wrapper-btn-glob"),{className:"-=open"})}function m(){$(window).width()<=979?(K=R.find(".team-member img").eq(0).outerHeight(),TweenMax.set($(".wrapper-btn-glob a"),{top:K/2+"px"}),z?($(window).width()<=767?(X=$(".container-team").width()/3,j=X):(X=$(".container-team").width()/5,j=2*X),TweenMax.set($(".team > li"),{width:X+"px"}),G=0,$(".team > li").each(function(){G+=$(this).outerWidth()}),G+=2*j,TweenMax.set(R,{width:G+"px",padding:"0 "+j+"px",x:-j}),J=X,z=Draggable.create(".team",{type:"x",bounds:$(".container-team"),cursor:"grab",throwProps:!0,edgeResistance:.65,dragClickables:!0,snap:{x:function(e){return Math.round(e/J)*J}},onDragStart:function(){h();var e=$(".team.member-open > li.open");pe=$(".desc",e),ce=new TimelineMax,$(window).width()>979?(ce.to(pe,.25,{opacity:0,visibility:"hidden"}),ce.to(e,.5,{paddingBottom:"0",ease:Cubic.easeInOut})):(ce.to(be,.25,{opacity:0}),ce.to(be,.5,{height:"0",visibility:"hidden",ease:Cubic.easeInOut})),ce.set(e,{className:"-=open"}),ce.set(R,{className:"-=member-open"}),TweenMax.to($(".wrapper-btn-glob"),.5,{height:"100%",ease:Cubic.easeInOut})}})):($(window).width()<=767?(X=$(".container-team").width()/3,j=X):(X=$(".container-team").width()/5,j=2*X),TweenMax.set($(".team > li"),{width:X+"px"}),G=0,$(".team > li").each(function(){G+=$(this).outerWidth()}),G+=2*j,TweenMax.set(R,{width:G+"px",padding:"0 "+j+"px",x:-j}),J=X,z=Draggable.create(".team",{type:"x",bounds:$(".container-team"),cursor:"grab",throwProps:!0,edgeResistance:.65,dragClickables:!0,snap:{x:function(e){return Math.round(e/J)*J}},onDragStart:function(){h();var e=$(".team.member-open > li.open");pe=$(".desc",e),ce=new TimelineMax,$(window).width()>979?(ce.to(pe,.25,{opacity:0,visibility:"hidden"}),ce.to(e,.5,{paddingBottom:"0",ease:Cubic.easeInOut})):(ce.to(be,.25,{opacity:0}),ce.to(be,.5,{height:"0",visibility:"hidden",ease:Cubic.easeInOut})),ce.set(e,{className:"-=open"}),ce.set(R,{className:"-=member-open"}),TweenMax.to($(".wrapper-btn-glob"),.5,{height:"100%",ease:Cubic.easeInOut})}}))):z&&(TweenMax.set($(".team"),{clearProps:"all"}),TweenMax.set($(".team > li"),{clearProps:"width"}),z[0].disable())}var g=$(document).height(),f=$(window).height(),w=$(window).width(),u=new ScrollMagic.Controller,b=0,x=$(document).scrollTop(),T=0,v=$("html"),M=$("body"),C=$("#header"),y=C.innerHeight(),N=$("#mainContent"),O=$("#main"),q=$("#readIndicator"),I=$(".btn"),A=$(".btn-invert"),H=$("#contentHeader"),B=$("#postSidebar"),S=0,k=0,D=$("#spotlightPost"),P=!1,W=$("#related"),E=$("#menu-responsive"),F=$("#portfolio"),R=$(".team"),z=!1,X,j,G,J,K,L,Q,U=$(window).height(),V=$(window).width(),Y=$(window).height(),Z=$(window).width();if(v.addClass(isMobile.any?"is-mobile":"is-desktop"),i(x,T),I.length&&I.each(function(e){I.eq(e).html(t(I.eq(e)))}),A.length&&A.each(function(e){A.eq(e).html(t(A.eq(e)))}),N.length&&N.find("img").length){var _=N.find("img").not(".no-scroll");o(_)}if(B.length&&(S=B.offset().top,k=B.innerWidth()),D.length&&(n(),TweenMax.set(D.find(".spotlight-post"),{y:"-120%"}),new ScrollMagic.Scene({triggerElement:"#spotlightPost"}).triggerHook(.9).setTween(TweenMax.staggerTo(D.find(".spotlight-post"),.25,{y:"0%"},.1)).addTo(u)),W.length){var ee=W.find(".read-also-post");TweenMax.set(ee,{opacity:0}),new ScrollMagic.Scene({triggerElement:"#related"}).triggerHook(.7).setTween(TweenMax.staggerTo(ee,.25,{opacity:1},.1)).addTo(u)}if(F.length){var te=F.find("li"),ie=te.length,ne=6;ie>ne&&l(te,ie,ne),F.find(".po-item a").hover(function(){$(this).closest(".po-item").hasClass("cta")||($(this).closest(".grid").addClass("is-hovered"),$(this).closest(".po-item").addClass("link-hovered"),F.find(".po-item a").removeClass("on"))},function(){$(this).closest(".grid").removeClass("is-hovered"),$(this).closest(".po-item").removeClass("link-hovered")})}if(R.length){var ae=R.find(".team-member"),oe,se,le,de,re,pe,ce,he,me,ge,fe,we,ue,be=$(".content-desc-responsive"),xe,$e,Te,ve;m(),c(),ae.on("click",function(e){e.preventDefault(),d($(this))}),$(".btn-desc > li a").on("click",function(e){e.preventDefault(),r()}),$(".container-team .wrapper-btn-glob a").on("click",function(e){e.preventDefault(),p($(this))})}E.length&&s(),$("#burger").on("click",function(e){e.preventDefault(),v.toggleClass("menu-open"),v.hasClass("menu-open")?setTimeout(function(){var e=0,t=E.find(".menu-small").length;for(e;t>e;e++)TweenMax.to(E.find(".menu-title").eq(e),.25,{y:"0%",opacity:1}),TweenMax.to(E.find(".menu-subtitle").eq(e),.25,{y:"0%",opacity:1}).delay(.05),TweenMax.staggerTo(E.find(".menu-small").eq(e).find("li"),.25,{y:"0%",opacity:1},.08)},380):s()}),$("input").on("change",function(){$(this).val()?$(this).addClass("filled"):$(this).removeClass("filled")}),$(document).on("scroll",function(){var t=$(document).scrollTop(),n=e(t);i(t,n),H.length&&!isMobile.any&&(t>20?TweenMax.to(H.find("h1"),.2,{y:"-50px",opacity:0}):TweenMax.to(H.find("h1"),.2,{y:"0px",opacity:1}),H.find(".img").length&&TweenMax.set(H.find(".img"),{y:"-"+t/40+"%"}),H.find(".menu-home").length&&TweenMax.set(H.find(".menu-home"),{y:"-"+t/4+"px"})),B.length&&N.length&&!isMobile.any&&a(t)}),$(window).on("resize",function(){g=$(document).height(),f=$(window).height(),w=$(window).width(),w>979&&v.removeClass("menu-open"),O.length&&H.length&&O.css("marginTop",Math.floor(H.innerHeight())),B.length&&(B.css({top:0,width:"20%"}).removeClass("fixed fixedBot"),S=B.offset().top,k=B.innerWidth()),D.length&&n(),R.length&&(R.hasClass("member-open")&&(fe=$(".team.member-open > li.open"),we=$(".desc",fe),ue=we.outerHeight(),TweenMax.set(fe,{paddingBottom:ue+"px",ease:Cubic.easeInOut})),m(),c()),Y=$(window).height(),Z=$(window).width(),Z!=V&&R.length&&R.hasClass("member-open")&&(TweenMax.set($(".team.member-open > li.open .desc"),{clearProps:"all"}),TweenMax.set($(".team.member-open > li.open"),{className:"-=open",clearProps:"all"}),TweenMax.set($(".content-desc-responsive"),{clearProps:"all"}),TweenMax.set(R,{className:"-=member-open"}))})}),$(window).on("load",function(){function e(e){e.split({type:"words"}),TweenMax.staggerFrom(e.words,.3,{ease:Expo.easeInOut,opacity:0,y:100},.03)}var t=$("#main"),i=$("#contentHeader"),n=$(".team");if(i.length&&(t.length&&t.css("marginTop",Math.floor(i.innerHeight())),i.find("h1").length)){var a=new SplitText(i.find("h1"),{type:"words"});i.find("h1").css("opacity",1),e(a)}});