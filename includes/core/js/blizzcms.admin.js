$(function() {
    // Counter
    $('.counter').each(function() {
        var $this = $(this),
        countTo = $this.attr('data-count');

        $({countNum: $this.text()}).animate({
            countNum: countTo
        },
        {
            duration: 1200,
            easing:'linear',
            step: function() {
                $this.text(Math.floor(this.countNum));
            },
            complete: function() {
                $this.text(this.countNum);
                //alert('finished');
            }
        });  
    });
})
