        <article>
          <h2><?= ucfirst($content['content']['vis_name']); ?> &#8212; <?= $content['content']['db_one'] . ' and ' . $content['content']['db_two']; ?></h2>
          <h4>Select attributes you wish to visualise.</h4>
<?php echo validation_errors(); ?>
          <form method="post" action="<?= base_url() . 'dashboard/select/' . $content['content']['uri'] . '/';?>">
            <div class="left">
              <label for="left">Attributes to select:</label>
              <select size="5" id="toSelect" multiple> 

<?php foreach ($content['attributes'] as $attribute): ?> 
                <option value="<?= $attribute; ?>"><?= ucfirst(str_replace('_', ' ', $attribute)); ?></option>
<?php endforeach; ?> 
              </select>
              <p><a href="#" class="btn add">Add</a></p>
            </div>
            <div class="right">
              <label for="right">Attributes to visualise:</label>
              <select size="5" name="selectedAtts[]" id="selectedAtts" multiple>
<?php foreach ($content['set_attributes'] as $attribute): if (empty($attribute)) {break;} ?> 
                <option selected value="<?= $attribute; ?>"><?= ucfirst(str_replace('_', ' ', $attribute)); ?></option>
<?php endforeach; ?>
              </select>
              <p><a href="#" class="btn remove">Remove</a></p>
            </div>
            <input type="submit" name="submit" value="Visualise!" />
          </form>
          <p>NOTE TO SELF: If the user is an "advanced" user, then instead of redirecting to another page and doing the recommended visualistion the user is presented with a list of options (the visualistions) to choose from.</p>
        </article>
