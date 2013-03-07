      </section>
    </div>
  </div>
  <footer role="contentinfo">
    <p>&copy; 2013 Group 7 - Cardiff University</p>
  </footer>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="<?= base_url() . '/public/js/select.js' ?>"></script>
  <?php if (current_url() == 'http://localhost/viz/settings'): ?>
<?= '<script src="' . base_url() . '/public/js/showhide.js"></script>'; ?>
  <?php endif; ?>
</body>
</html>
