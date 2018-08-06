$(document).ready(function(){
	// shrink expend sidebar pageview
	let sideBar = $(".nv__sidebar"), pageView = $('.nv__pageview');
	let x_nav = $('nav.x_nav');
	if(bd.getCookie('shrink-sidebar')){
		sideBar.addClass('shrink-sidebar');
		pageView.addClass('expend-pageview')
	}
	$('#btnExpandSidebar').click(function(){
		if(!sideBar.hasClass('shrink-sidebar')){
			sideBar.addClass('shrink-sidebar');
			pageView.addClass('expend-pageview');
			bd.setCookie('shrink-sidebar', true);
		} else {
			sideBar.removeClass('shrink-sidebar');
			pageView.removeClass('expend-pageview')
			bd.removeCookie('shrink-sidebar');
		}
	 });
	 
	 $('a#btn_sidebar').click(function(e){
		e.preventDefault();
		sideBar.toggleClass('open');
		sideBar.removeClass('shrink-sidebar');
		$('.opacity-layer').toggleClass('layer-active');
	 });
	 $('.sr-btn-sidebar').click(function(){
		sideBar.toggleClass('open');
		$('.opacity-layer').toggleClass('layer-active');
	 });
 
	$('.opacity-layer').bind('click', function(){
		$('.opacity-layer').toggleClass('layer-active');
		sideBar.toggleClass('open');
	});

	// remove popup notifications 
	if($('div.notification').hasClass('notification')){
		setTimeout(function(){
			$('.notification').fadeOut(1000).remove();
		}, 5000);
	};
});


document.addEventListener("DOMContentLoaded", function(){
	var __dl;
    $('.delete-modal').on('click',function (e) {
        var __df = $('#delete_form')[0];
        // Save form action initial value
        if (!__dl) {__dl = __df.action;}
        __df.action = __dl.match(/\/[0-9]+$/) ? __dl.replace(/([0-9]+$)/, $(this).data('id')) : __dl + '/' + $(this).data('id');
	});

	$('.delete-paginate').on('click', function (e) {
		$('#delete_form')[0].action = bd.getFullUrl() + '/__id'.replace('__id', $(this).data('id'));
		if(!$('#delete_form input[name="page"]').length){
			 $('<input>').attr({
				type: 'hidden',
				name: 'page',
				value: bd.getUrlPrmVal('page')
			}).appendTo($('#delete_form'));
		}
	});


});



// (function($){
// $.fn.snackBar = function(str){
// 	this.html(str).fadeIn(400).delay(300000).fadeOut(400);
// };
// }(jQuery));