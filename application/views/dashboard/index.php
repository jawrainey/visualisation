        <h1>Your visualizations</h1>
        <p>You can create, view, edit or delete your visualizations below:</p>
        <article>
          <h3 class="title"><a href="<?= base_url() . 'dashboard/create/'?>">Create a new visualization</a></h3>
        </article>
<?php foreach ($content as $row):?>
        <article>
          <h4 class="title"><a href="<?= base_url() . 'dashboard/view/' . $row['uri'] . '/';?>"><?= $row['vis_name'];?></a></h4>
          <ul class="crud">
            <li><a href="<?= base_url() . 'dashboard/select/' . $row['uri'] . '/';?>"><i class="icon-pencil"></i></a></li>
            <li><a href="<?= base_url() . 'dashboard/delete/' . $row['uri'] . '/';?>"><i class="icon-trash"></i></a></li>
          </ul>
        </article>
<?php endforeach; ?>