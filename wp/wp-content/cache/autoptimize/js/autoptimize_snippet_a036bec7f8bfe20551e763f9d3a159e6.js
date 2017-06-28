jQuery(document).ready(function($)
{$('.subscribe-form').submit(function(e)
{e.preventDefault();var $el=$(this);var loading='<p><img src="'+WPMailjet.loadingImg+'" alt="Please wait..."></p>';var $res=$el.parent().find(".response").html(loading);$.post(WPMailjet.ajaxurl,$el.serialize(),function(data)
{$res.html(data);});})
$('.widget-control-close').click(function(e)
{var $res=$(this).closest('form').find(".mailjet_subscribe_response");if(jQuery.type($res.html())!==undefined)
{$res.hide();}})});