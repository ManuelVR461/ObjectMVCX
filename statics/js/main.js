'use strict'

$(document).ready(function(){

    $('.menu > ul > li > a').click(function(e) {        
        e.preventDefault();
        const element = $(this).next();

        $('.menu li').removeClass('activado');
        $(this).closest('li').addClass('activado');
        
        if((element.is('ul')) && (element.is(':visible'))) {
            $(this).closest('li').removeClass('activado');
            element.slideUp();
        }
        if((element.is('ul')) && (!element.is(':visible'))) {
            $('.menu ul ul:visible').slideUp();
            element.slideDown();
        }
    });

    $('.menu > ul > li > ul > li > a').click(function() {
        
        var element = $(this).next();
        $('.menu ul ul li').removeClass('activado');
        $(this).closest('ul ul li').addClass('activado');
        if((element.is('ul ul')) && (element.is(':visible'))) {
           $(this).closest('ul ul li').removeClass('activado');
           element.slideUp('normal');
        }
        if((element.is('ul ul')) && (!element.is(':visible'))) {
           $('.menu ul ul ul:visible').slideUp('normal');
           element.slideDown('normal');
        }
    });
	
    $('.menu li a').click(function(e){
        e.preventDefault();
        let press1 = $(this).closest('li').attr('class').split(' ');
        if(press1[0]!='parent' && press1[0]!='subparent'){
            window.location.href=$(this).attr('href');
        }
    });



});
