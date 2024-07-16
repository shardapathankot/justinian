jQuery( document ).ready(function($) {
    "use strict";

$(".responsive-desktop-slider").show();
$(".responsive-tablet-slider").hide();
$(".responsive-mobile-slider").hide();

$('.select-devices-preview').find('button').on('click', function (event) {
    var $this = $(this);
    if ($this.hasClass('preview-desktop')) {
    $('.select-devices-preview').find('.preview-desktop').addClass('active');
    $('.select-devices-preview').find('.preview-tablet').removeClass('active');
    $('.select-devices-preview').find('.preview-mobile').removeClass('active');
    $('.responsive-desktop-slider').addClass('active');
    $('.responsive-tablet-slider').removeClass('active');
    $('.responsive-mobile-slider').removeClass('active');
    $(".responsive-desktop-slider").show();
    $(".responsive-tablet-slider").hide();
    $(".responsive-mobile-slider").hide();
    document.querySelector('.devices button[data-device="desktop"]').click();
    } else if ($this.hasClass('preview-tablet')) {
    $('.select-devices-preview').find('.preview-tablet').addClass('active');
    $('.select-devices-preview').find('.preview-desktop').removeClass('active');
    $('.select-devices-preview').find('.preview-mobile').removeClass('active');
    $('.responsive-desktop-slider').removeClass('active');
    $('.responsive-tablet-slider').addClass('active');
    $('.responsive-mobile-slider').removeClass('active');
    $(".responsive-desktop-slider").hide();
    $(".responsive-tablet-slider").show();
    $(".responsive-mobile-slider").hide();
    document.querySelector('.devices button[data-device="tablet"]').click();
    } else {
    $('.select-devices-preview').find('.preview-mobile').addClass('active');
    $('.select-devices-preview').find('.preview-desktop').removeClass('active');
    $('.select-devices-preview').find('.preview-tablet').removeClass('active');
    $('.responsive-desktop-slider').removeClass('active');
    $('.responsive-tablet-slider').removeClass('active');
    $('.responsive-mobile-slider').addClass('active');
    $(".responsive-desktop-slider").hide();
    $(".responsive-tablet-slider").hide();
    $(".responsive-mobile-slider").show();
    document.querySelector('.devices button[data-device="mobile"]').click();
    }
});
$(' .wp-full-overlay-footer .devices button ').on('click', function () {
    var device = $(this).attr('data-device');
    document.querySelector('.select-devices-preview .preview-' + device).click();
});

var elements = document.querySelectorAll(".maincls .responsive_slider");    
var elementloop = Array.from(elements);    
elementloop.forEach(myFunction); 
    
    function myFunction(currentValue) { 
        var pp = currentValue.querySelector('.reset-default');
        var slider = currentValue.querySelector('input.slider');
        var number_in = currentValue.querySelector('input.number-in');

        function slider_to_num(){
            var slider_val = currentValue.querySelector('input.slider').value;
            currentValue.querySelector('input.number-in').value = slider_val;
            $(currentValue).find('input.slider').trigger('change');
        }
        
        function num_to_slider(){
            var num_val = currentValue.querySelector('input.number-in').value;
            currentValue.querySelector('input.slider').value = num_val;
            $(currentValue).find('input.slider').trigger('change');
        }
        
        function control_reset($reset){
            var $reset_val = $($reset).attr('reset-value');
            currentValue.querySelector('input.number-in').value = $reset_val;
            currentValue.querySelector('input.slider').value = $reset_val;
            $(currentValue).find('input.slider').trigger('change');
        }
        
        slider_to_num();
        slider.addEventListener("change", function(){
            slider_to_num();
        }); 
        
        number_in.addEventListener("change", function(){
            num_to_slider();
        }); 

        number_in.addEventListener("keyup", function(){
            num_to_slider();
        }); 

        pp.addEventListener("click", function(){
            control_reset(pp);
        }); 
    }
});