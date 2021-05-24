jQuery(document).ready(function($){var $timeline_block=$('.cd-timeline-block');$timeline_block.each(function(){if($(this).offset().top>$(window).scrollTop()+$(window).height()*0.75){$(this).find('.cd-timeline-img, .cd-timeline-content').addClass('hidden');}});$(window).on('scroll',function(){$timeline_block.each(function(){if($(this)
	.offset().top<=$(window).scrollTop()+$(window).height()*0.75&&$(this).find('.cd-timeline-img')
	.hasClass('hidden')){$(this).find('.cd-timeline-img, .cd-timeline-content').removeClass('hidden')
	.addClass('animation animated animation-bounce-in-down');}});});});