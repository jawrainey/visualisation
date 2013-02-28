
      </section>
    </div>
  </div>
  <footer role="contentinfo">
    <p>&copy; 2013 Group 7 - Cardiff University</p>
  </footer>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="<?php echo $this->config->base_url() . '/public/js/select.js' ?>"></script>
  <script>
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
  </script>
</body>
</html>