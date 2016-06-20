"use strict";$(function(){function e(e){var t=e>w?-1:1;return w=e,t}function t(e){var t=e.html();return'<span class="before">'+t+'</span><span class="after">'+t+"</span>"}function i(e,t){if(M.length&&q.length&&!b.hasClass("menu-open")&&(e>M.offset().top-v-40?T.addClass("fixed"):T.removeClass("fixed"),T.hasClass("fixed")&&(0>t?T.addClass("on"):T.removeClass("on"))),y.length&&(x.hasClass("single-post")||x.hasClass("page-template-default"))){var i=(e-M.offset().top)/(M.innerHeight()-h);e>M.offset().top&&TweenMax.set(y,{scaleX:i})}}function n(){function e(){var e=0,i=t.length,n=t.eq(0).innerWidth();for(e;i>e;e++){var a=t.eq(e).offset().left+n;a>m||n>a?t.eq(e).addClass("off"):t.eq(e).removeClass("off")}}var t=B.find(".spotlight-post"),i=B.find(".container").innerWidth();e(),i>m?S?S[0].enable():S=Draggable.create("#spotlightDrag",{type:"x",bounds:B,cursor:"grab",throwProps:!0,edgeResistance:.65,onDrag:e,onDragStart:function(){B.find(".container").addClass("grabbing")},onDragEnd:function(){B.find(".container").removeClass("grabbing")}}):S&&(S[0].disable(),TweenMax.set(S,{x:"0px"}))}function a(e){var t=20,i=I.innerHeight(),n=M.offset().top,a=M.innerHeight();a+2*t>i&&h>i+v+t?e>=A-v-t?(e+i+v+t>n+a-t?I.css({top:a-t-i+20,width:H}).removeClass("fixed").addClass("fixedBot"):I.css({top:v+t,width:H}).removeClass("fixedBot").addClass("fixed"),e>(a+n)/2?(I.find("li").eq(0).find(".img").addClass("off"),I.find("li").eq(1).find(".img").addClass("on")):(I.find("li").eq(0).find(".img").removeClass("off"),I.find("li").eq(1).find(".img").removeClass("on"))):I.css({top:0,width:H}).removeClass("fixed fixedBot"):I.css({top:0}).removeClass("fixed fixedBot")}function o(e){var t=e.length,i=0;for(TweenMax.set(e,{opacity:0}),i;t>i;i++)new ScrollMagic.Scene({triggerElement:e[i]}).triggerHook(.7).setTween(TweenMax.to(e.eq(i),.25,{opacity:1})).addTo(g)}function s(){TweenMax.set([D.find(".menu-title"),D.find(".menu-subtitle")],{y:"-100%",opacity:0}),TweenMax.set(D.find("li"),{y:"-120%",opacity:0})}function l(e,t,i){function n(e){var i=Math.floor(Math.random()*t);$("a",m).removeClass("on"),setTimeout(function(){if(!$(".grid").hasClass("is-hovered")){var t=m.eq(e);$("a",t).addClass("on")}},1500),setTimeout(n,3500,i)}var a='<div class="grid">',o=0,s=0,l=0,d=0,r=.1,p=.4,c,h=0,m;t>37&&(r+=.02,p-=.02),t>60&&(r+=.05,p-=.05);var w,f=Math.ceil(r*t),u=Math.ceil(p*t),b=t-(f+u),x=[f,Math.floor(u/2),Math.ceil(u/2),Math.ceil(b/3),Math.ceil(b/3),Math.floor(b/3)];for(l;i>l;l++)s+=x[l];for(s>t&&(x[4]-=1),w=0,l=0;i>l;l++){for(a+='<div class="po-item-col col-2">',d=0;d<x[l];d++)3===l&&d===x[l]-1&&(a+='<div class="po-item cta">'+$("#ctaPortfolio").html()+"</div>"),a+=$("ul.grid > li").eq(w).hasClass("transfered")?'<div class="po-item transfered">'+P.find("li").eq(d+o).html()+"</div>":'<div class="po-item">'+P.find("li").eq(d+o).html()+"</div>",w++;o+=d,a+="</div>"}for(a+="</div>",P.find(".container").append(a),TweenMax.set(P.find(".po-item"),{opacity:0,y:"30%",scale:.8}),l=0;t+1>l;l++)new ScrollMagic.Scene({triggerElement:P.find(".po-item")[l]}).triggerHook(.9).setTween(TweenMax.to(P.find(".po-item").eq(l),.25,{opacity:1,y:"0%",scale:1})).addTo(g);c=P.find("div.grid").find(".transfered"),h=c.length,m=P.find(".po-item"),n(0)}function d(){if($(window).width()<=979){var e=$(".team > li").length,t=W.offset().left-20,i=t+W.width(),n=$(".container-team").width(),a=0,o=0;W.find("li").hasClass("open")&&(a=W.find("> li.open").position().left,o=W.find("> li.open").offset().left),e>5?(TweenMax.set($(".wrapper-btn-glob.prev"),{className:"-=open"}),TweenMax.set($(".wrapper-btn-glob.next"),{className:"-=open"}),0>t&&o>F&&TweenMax.set($(".wrapper-btn-glob.prev"),{className:"+=open"}),i>n&&o+F<$(window).width()-F&&TweenMax.set($(".wrapper-btn-glob.next"),{className:"+=open"})):$(window).width()<=767&&e>3&&(TweenMax.set($(".wrapper-btn-glob.prev"),{className:"-=open"}),TweenMax.set($(".wrapper-btn-glob.next"),{className:"-=open"}),0>t&&o>F&&TweenMax.set($(".wrapper-btn-glob.prev"),{className:"+=open"}),i>n&&o+F<$(window).width()-F&&TweenMax.set($(".wrapper-btn-glob.next"),{className:"+=open"}))}else TweenMax.set($(".wrapper-btn-glob"),{className:"-=open"})}function r(){TweenMax.set($(".wrapper-btn-glob"),{className:"-=open"})}function p(){$(window).width()<=979?(j=W.find(".team-member img").eq(0).outerHeight(),TweenMax.set($(".wrapper-btn-glob a"),{top:j/2+"px"}),E?($(window).width()<=767?(F=$(".container-team").width()/3,R=F):(F=$(".container-team").width()/5,R=2*F),TweenMax.set($(".team > li"),{width:F+"px"}),z=0,$(".team > li").each(function(){z+=$(this).outerWidth()}),z+=2*R,TweenMax.set(W,{width:z+"px",padding:"0 "+R+"px",x:-R}),X=F,E=Draggable.create(".team",{type:"x",bounds:$(".container-team"),cursor:"grab",throwProps:!0,edgeResistance:.65,dragClickables:!0,snap:{x:function(e){return Math.round(e/X)*X}},onDragStart:function(){r();var e=$(".team.member-open > li.open");le=$(".desc",e),de=new TimelineMax,$(window).width()>979?(de.to(le,.25,{opacity:0,visibility:"hidden"}),de.to(e,.5,{paddingBottom:"0",ease:Cubic.easeInOut})):(de.to(we,.25,{opacity:0}),de.to(we,.5,{height:"0",visibility:"hidden",ease:Cubic.easeInOut})),de.set(e,{className:"-=open"}),de.set(W,{className:"-=member-open"}),TweenMax.to($(".wrapper-btn-glob"),.5,{height:"100%",ease:Cubic.easeInOut})}})):($(window).width()<=767?(F=$(".container-team").width()/3,R=F):(F=$(".container-team").width()/5,R=2*F),TweenMax.set($(".team > li"),{width:F+"px"}),z=0,$(".team > li").each(function(){z+=$(this).outerWidth()}),z+=2*R,TweenMax.set(W,{width:z+"px",padding:"0 "+R+"px",x:-R}),X=F,E=Draggable.create(".team",{type:"x",bounds:$(".container-team"),cursor:"grab",throwProps:!0,edgeResistance:.65,dragClickables:!0,snap:{x:function(e){return Math.round(e/X)*X}},onDragStart:function(){r();var e=$(".team.member-open > li.open");le=$(".desc",e),de=new TimelineMax,$(window).width()>979?(de.to(le,.25,{opacity:0,visibility:"hidden"}),de.to(e,.5,{paddingBottom:"0",ease:Cubic.easeInOut})):(de.to(we,.25,{opacity:0}),de.to(we,.5,{height:"0",visibility:"hidden",ease:Cubic.easeInOut})),de.set(e,{className:"-=open"}),de.set(W,{className:"-=member-open"}),TweenMax.to($(".wrapper-btn-glob"),.5,{height:"100%",ease:Cubic.easeInOut})}}))):E&&(TweenMax.set($(".team"),{clearProps:"all"}),TweenMax.set($(".team > li"),{clearProps:"width"}),E[0].disable())}var c=$(document).height(),h=$(window).height(),m=$(window).width(),g=new ScrollMagic.Controller,w=0,f=$(document).scrollTop(),u=0,b=$("html"),x=$("body"),T=$("#header"),v=T.innerHeight(),M=$("#mainContent"),C=$("#main"),y=$("#readIndicator"),N=$(".btn"),O=$(".btn-invert"),q=$("#contentHeader"),I=$("#postSidebar"),A=0,H=0,B=$("#spotlightPost"),S=!1,k=$("#related"),D=$("#menu-responsive"),P=$("#portfolio"),W=$(".team"),E=!1,F,R,z,X,j,G,J,K=$(window).height(),L=$(window).width(),Q=$(window).height(),U=$(window).width();if(b.addClass(isMobile.any?"is-mobile":"is-desktop"),i(f,u),N.length&&N.each(function(e){N.eq(e).html(t(N.eq(e)))}),O.length&&O.each(function(e){O.eq(e).html(t(O.eq(e)))}),M.length&&M.find("img").length){var V=M.find("img").not(".no-scroll");o(V)}if(I.length&&(A=I.offset().top,H=I.innerWidth()),B.length&&(n(),TweenMax.set(B.find(".spotlight-post"),{y:"-120%"}),new ScrollMagic.Scene({triggerElement:"#spotlightPost"}).triggerHook(.9).setTween(TweenMax.staggerTo(B.find(".spotlight-post"),.25,{y:"0%"},.1)).addTo(g)),k.length){var Y=k.find(".read-also-post");TweenMax.set(Y,{opacity:0}),new ScrollMagic.Scene({triggerElement:"#related"}).triggerHook(.7).setTween(TweenMax.staggerTo(Y,.25,{opacity:1},.1)).addTo(g)}if(P.length){var Z=P.find("li"),_=Z.length,ee=6;_>ee&&l(Z,_,ee),P.find(".po-item a").hover(function(){$(this).closest(".po-item").hasClass("cta")||($(this).closest(".grid").addClass("is-hovered"),$(this).closest(".po-item").addClass("link-hovered"),P.find(".po-item a").removeClass("on"))},function(){$(this).closest(".grid").removeClass("is-hovered"),$(this).closest(".po-item").removeClass("link-hovered")})}if(W.length){var te=W.find(".team-member"),ie,ne,ae,oe,se,le,de,re,pe,ce,he,me,ge,we=$(".content-desc-responsive"),fe,ue,be,$e;p(),d(),te.on("click",function(e){if(e.preventDefault(),ae=$(this).closest("li"),ie=$(".desc",ae),ne=ie.outerHeight(),!TweenMax.isTweening(W.find("li"))&&!TweenMax.isTweening(W.find(".desc"))&&!TweenMax.isTweening($(".wrapper-btn-glob")))if(W.hasClass("member-open"))if(ae.hasClass("open")){r();var t=$(".team.member-open > li.open");le=$(".desc",t),de=new TimelineMax,$(window).width()>979?(de.to(le,.25,{opacity:0,visibility:"hidden"}),de.to(t,.5,{paddingBottom:"0",ease:Cubic.easeInOut})):(de.to(we,.25,{opacity:0}),de.to(we,.5,{height:"0",visibility:"hidden",ease:Cubic.easeInOut})),de.set(t,{className:"-=open"}),de.set(W,{className:"-=member-open"}),TweenMax.to($(".wrapper-btn-glob"),.5,{height:"100%",ease:Cubic.easeInOut})}else{var t=$(".team.member-open > li.open");le=$(".desc",t),de=new TimelineMax,$(window).width()>979?(J=t.offset().top<ae.offset().top?W.offset().top+ae.position().top-parseFloat(t.css("paddingBottom"))-120:W.offset().top+ae.position().top-120,de.to(le,.25,{opacity:0,visibility:"hidden"}),de.set(t,{className:"-=open"}),de.set(ae,{className:"+=open"}),de.add("paddingAnimation").to(t,.5,{paddingBottom:"0",ease:Cubic.easeInOut},"paddingAnimation").to(ae,.25,{paddingBottom:ne+"px",ease:Cubic.easeIn},"paddingAnimation").to(window,.5,{scrollTo:{y:J},ease:Cubic.easeOut},"paddingAnimation"),de.to(ie,.25,{opacity:1,visibility:"visible"})):(J=ae.offset().top-120,de.to(we,.25,{opacity:0,visibility:"hidden"}),de.set(t,{className:"-=open"}),de.set(ae,{className:"+=open",onComplete:function(){we.html(ie.html()),TweenMax.set(we,{height:"auto",position:"absolute"}),fe=we.outerHeight(),TweenMax.set(we,{height:"0",position:"relative"})}}),de.add("heightAnimation").to(we,.5,{height:fe+"px",ease:Cubic.easeInOut},"heightAnimation").to(window,.5,{scrollTo:{y:J},ease:Cubic.easeOut},"heightAnimation"),de.to(we,.25,{opacity:1,visibility:"visible"}),ue=ae.position().left,be=$(".container-team").width(),$e=ue-be/2+ae.outerWidth()/2,TweenMax.to(W,.5,{x:-$e,ease:Cubic.easeOut}))}else if(J=ae.offset().top-120,TweenMax.set(W,{className:"+=member-open"}),oe=new TimelineMax,oe.set(ae,{className:"+=open"}),d(),$(window).width()>979)oe.add("paddingAnimation").to(ae,.5,{paddingBottom:ne+"px",ease:Cubic.easeOut},"paddingAnimation").to(window,.5,{scrollTo:{y:J},ease:Cubic.easeOut},"paddingAnimation"),oe.to(ie,.25,{opacity:1,visibility:"visible"});else{we.html(ie.html()),TweenMax.set(we,{height:"auto",position:"absolute"}),fe=we.outerHeight(),TweenMax.set(we,{height:"0",position:"relative"}),oe.add("heightAnimation").to(we,.5,{height:fe+"px",ease:Cubic.easeInOut},"heightAnimation").to(window,.5,{scrollTo:{y:J},ease:Cubic.easeOut},"heightAnimation"),oe.to(we,.25,{opacity:1,visibility:"visible"});var i=Math.max.apply(null,W.find(".team-member").map(function(){return $(this).height()}).get());TweenMax.to($(".wrapper-btn-glob"),.5,{height:i+10+"px",ease:Cubic.easeInOut}),ue=ae.position().left,be=$(".container-team").width(),$e=ue-be/2+ae.outerWidth()/2,TweenMax.to(W,.5,{x:-$e,ease:Cubic.easeOut})}}),$(".btn-desc > li a").on("click",function(e){if(e.preventDefault(),!TweenMax.isTweening(W.find("li"))&&!TweenMax.isTweening(W.find(".desc"))&&!TweenMax.isTweening($(".wrapper-btn-glob"))){var t=$(".team.member-open > li.open");le=$(".desc",t),de=new TimelineMax,de.to(le,.25,{opacity:0,visibility:"hidden"}),de.set(t,{className:"-=open"}),re=$(this).hasClass("left")?t.prev().length?t.prev():W.find("> li").last():t.next().length?t.next():W.find("> li").first(),J=t.offset().top<re.offset().top?W.offset().top+re.position().top-parseFloat(t.css("paddingBottom"))-120:re.offset().top-120,pe=$(".desc",re),ce=pe.outerHeight(),de.set(re,{className:"+=open"}),de.add("paddingAnimation").to(re,.25,{paddingBottom:ce+"px",ease:Cubic.easeIn},"paddingAnimation").to(t,.5,{paddingBottom:"0",ease:Cubic.easeOut},"paddingAnimation").to(window,.5,{scrollTo:{y:J},ease:Cubic.easeOut},"paddingAnimation"),de.to(pe,.25,{opacity:1,visibility:"visible"})}}),$(".container-team .wrapper-btn-glob a").on("click",function(e){if(e.preventDefault(),!(TweenMax.isTweening(W.find("li"))||TweenMax.isTweening(W.find(".desc"))||TweenMax.isTweening($(".wrapper-btn-glob"))||TweenMax.isTweening(W)))if($(this).closest(".wrapper-btn-glob").hasClass("open")&&($(this).hasClass("left")?TweenMax.to(W,.25,{x:"+="+F,ease:Cubic.easeInOut}):TweenMax.to(W,.25,{x:"-="+F,ease:Cubic.easeInOut})),$(window).width()<=979&&W.hasClass("member-open")){var t=$(".team.member-open > li.open");le=$(".desc",t),de=new TimelineMax,de.to(we,.25,{opacity:0,visibility:"hidden"}),de.set(t,{className:"-=open"}),re=$(this).hasClass("left")?t.prev():t.next(),J=re.offset().top-120,pe=$(".desc",re),de.set(re,{className:"+=open",onComplete:function(){we.html(pe.html()),TweenMax.set(we,{height:"auto",position:"absolute"}),fe=we.outerHeight(),TweenMax.set(we,{height:"0",position:"relative"})}}),de.add("heightAnimation").to(we,.5,{height:fe+"px",ease:Cubic.easeInOut},"heightAnimation").to(window,.5,{scrollTo:{y:J},ease:Cubic.easeOut},"heightAnimation"),de.to(we,.25,{opacity:1,visibility:"visible",onComplete:d})}else r()})}D.length&&s(),$("#burger").on("click",function(e){e.preventDefault(),b.toggleClass("menu-open"),b.hasClass("menu-open")?setTimeout(function(){var e=0,t=D.find(".menu-small").length;for(e;t>e;e++)TweenMax.to(D.find(".menu-title").eq(e),.25,{y:"0%",opacity:1}),TweenMax.to(D.find(".menu-subtitle").eq(e),.25,{y:"0%",opacity:1}).delay(.05),TweenMax.staggerTo(D.find(".menu-small").eq(e).find("li"),.25,{y:"0%",opacity:1},.08)},380):s()}),$("input").on("change",function(){$(this).val()?$(this).addClass("filled"):$(this).removeClass("filled")}),$(document).on("scroll",function(){var t=$(document).scrollTop(),n=e(t);i(t,n),q.length&&!isMobile.any&&(TweenMax.set(q.find("h1"),{y:"-"+t/4+"px"}),q.find(".img").length&&TweenMax.set(q.find(".img"),{y:"-"+t/40+"%"}),q.find(".menu-home").length&&TweenMax.set(q.find(".menu-home"),{y:"-"+t/4+"px"})),I.length&&M.length&&!isMobile.any&&a(t)}),$(window).on("resize",function(){c=$(document).height(),h=$(window).height(),m=$(window).width(),m>979&&b.removeClass("menu-open"),C.length&&q.length&&C.css("marginTop",Math.floor(q.innerHeight())),I.length&&(I.css({top:0,width:"20%"}).removeClass("fixed fixedBot"),A=I.offset().top,H=I.innerWidth()),B.length&&n(),W.length&&(W.hasClass("member-open")&&(he=$(".team.member-open > li.open"),me=$(".desc",he),ge=me.outerHeight(),TweenMax.set(he,{paddingBottom:ge+"px",ease:Cubic.easeInOut})),p(),d()),Q=$(window).height(),U=$(window).width(),U!=L&&W.length&&W.hasClass("member-open")&&(TweenMax.set($(".team.member-open > li.open .desc"),{clearProps:"all"}),TweenMax.set($(".team.member-open > li.open"),{className:"-=open",clearProps:"all"}),TweenMax.set($(".content-desc-responsive"),{clearProps:"all"}),TweenMax.set(W,{className:"-=member-open"}))})}),$(window).on("load",function(){function e(e){e.split({type:"words"}),TweenMax.staggerFrom(e.words,.3,{ease:Expo.easeInOut,opacity:0,y:100},.03)}var t=$("#main"),i=$("#contentHeader"),n=$(".team");if(i.length&&(t.length&&t.css("marginTop",Math.floor(i.innerHeight())),i.find("h1").length)){var a=new SplitText(i.find("h1"),{type:"words"});i.find("h1").css("opacity",1),e(a)}});