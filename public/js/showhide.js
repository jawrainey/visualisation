$(document).ready(function() {
    $(function() {
        $('.hide').hide().click(function(e) {
            e.stopPropagation();
        });
    
        $("a.toggle").click(function(e) {
            $(this).next('.hide').slideToggle();
            $('.hide').animate({ opacity: "toggle" });
            e.stopPropagation();
        });
    
        $(document).click(function() { $('.hide').fadeOut(); }); 
    });
});

$(document).ready(function() {
    $(function() {
        $('.slidingDiv').hide().click(function(e) {
            e.stopPropagation();
        });
    
        $("a.show_hide").click(function(e) {
            $(this).next('.slidingDiv').slideToggle();
            $('.slidingDiv').animate({ opacity: "toggle" });
            e.stopPropagation();
        });
    
        $(document).click(function() { $('.slidingDiv').fadeOut(); }); 
    });
});