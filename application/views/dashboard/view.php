        <article>
          <h1>Visualistion of <?= $title; ?></h1>
          <p>Below are the types of graphs available for the chosen attributes</p>
          <?php if (empty($recommendations)): ?>
            <p>NO VISUALISATION EXISTS FOR THOSE CHOSEN DATA TYPES!!</p>   
          <?php else: ?>
  <ul>
            <?php foreach ($recommendations as $recommendation): ?>
  <li><?= $recommendation; ?></li>
            <?php endforeach; ?>
</ul>
          <?php endif; ?>
<hr>
          <div id="main_vis">
<!--             <p>If no visualistions can be made from the data, output an error? We're sorry, but those visualisations are not compatable...</p>
            <p>Perhaps if the datatypes chosen CAN NOT make a visualistion, then say to the user, then take them back to the previous page?</p>
            <p>On this page IF the user is advanced it will simply display a dropdown box to allow them to select the visualistion...</p>
            <p>On the other hand, if they're a noob, the main vis will be here, and UP TO three thumbnails below.</p> -->
          </div>
          <p>Click a thumbnail below to view alternative visualistions.</p>
          <ul id="thumbnails">
            <li><a href="#"><img src="http://donsmaps.com/clickphotos/dolnivi200x100.jpg" width="200" height="100"></img></a></li>
            <li><a href="#"><img src="http://donsmaps.com/clickphotos/dolnivi200x100.jpg" width="200" height="100"></img></a></li>
            <li><a href="#"><img src="http://donsmaps.com/clickphotos/dolnivi200x100.jpg" width="200" height="100"></img></a></li>
          </ul>
        </article>
