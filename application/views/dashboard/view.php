        <article>
          <h1>Visualistion of <?= $title; ?></h1>
          <p>Below are the types of graphs available for the chosen attributes:</p>
          <?php if (empty($recommendations)): ?>
            <p>No visualisations exist for those chosen data types. Redirecting to dashboard.</p>
            <?php $this->output->set_header('refresh:3; url=' . base_url() . 'dashboard'); ?> 
          <?php else: ?>
            <?php foreach ($recommendations as $index => $recommendation): ?>
            <?php if($index == 0): ?>
          
          <script>              
          <?= $recommendation . "(" . $content . ", " . "'100%', " . "350," . "'main_vis'" . ");" ?>

          </script>
    <?php else: ?>
        
          <script>
          <?= $recommendation . "(" . $content . ", " . "300, " . "150," . "'thumbnail" . $index . "'" . ");" ?>
       
          </script><?php endif; ?>
            <?php endforeach; ?>
          <?php endif; ?>
          
          <div id="main_vis"></div>
          <p>Click a thumbnail below to enlarge selected visualistion.</p>
          <ul id="thumbnails">
<?php foreach ($recommendations as $index => $recommendation): ?>
<?php if($index != 0): ?>
            <li><a id="thumbnail<?= $index?>" href="#"></a></li>
<?php endif; ?>
<?php endforeach; ?>
          </ul>
        </article>
