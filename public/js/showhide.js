  $(document).ready(function() {
    $(function() {
      $('.hide').hide().click(function(e) {
        e.stopPropagation();
      });      
    
    $("a.toggle").click(function(e) {
      $(this).next('.hide').slideToggle(200, 'swing');
      $('.hide').animate({ opacity: "toggle" });
      e.stopPropagation();
    });
    
    $(document).click(function() {
      $('.hide').fadeOut();
      });
    });

  });