(function ($) {
    'use strict';
    
AOS.init({
    once: true
});

$(window).on ('load', function (){ 
        
    $('.progress-bar').each(function(){
            var width = $(this).data('percent');
            $(this).css({'transition': 'width 3s'});
            $(this).appear(function() {
                console.log('hello');
                $(this).css('width', width + '%');
                $(this).find('.count').countTo({
                    from: 0,
                    to: width,
                    speed: 3000,
                    refreshInterval: 50
                });
            });
        });
    }); 
    
var Shuffle = window.Shuffle;
var jQuery = window.jQuery;

var myShuffle = new Shuffle(document.querySelector('.shuffle-wrapper'), {
    itemSelector: '.shuffle-item',
    buffer: 1
});

jQuery('input[name="shuffle-filter"]').on('change', function (evt) {
    var input = evt.currentTarget;
    if (input.checked) {
        myShuffle.filter(input.value);
    }
});

})(jQuery);