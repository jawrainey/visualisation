//Enables the content from the left multiple option box to be moved into the right ~ user friendly.
$().ready(function() {
    $('.add').click(function() {  
      return !$('#toSelect option:selected').remove().appendTo('#selectedAtts');  
    });  
    $('.remove').click(function() {  
      return !$('#selectedAtts option:selected').remove().appendTo('#toSelect');  
    });
});
//Shows & hides the change password div on the settings page.
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
//Shows & hides the change level div on the settings page.
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