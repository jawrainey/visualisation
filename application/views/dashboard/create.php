        <article>
          <h1>Create a new visualistion</h1>
          <p>Enter the name of your visualistion and select two datasets you wish to compare. You can also <a href="<?= base_url() . 'dashboard/upload/';?>">upload</a> your own dataset for visualistion with the other datasets.</p>
<?php echo validation_errors(); ?>
          <form method="post" action="<?= base_url() . 'dashboard/create/'; ?>">
            <label for="visname">Name of visualistion:</label>
            <input name="visname" type="text" placeholder="Enter your visualistion name" value=""/>
            <p>Select two datasets to compare:</p>
            <div class="left">
              <select name="datasetOne">
                <option value="0">Dataset one</option>
<?php foreach ($content as $attribute): ?> 
                <option value="<?= $attribute; ?>"><?= $attribute; ?></option>  
<?php endforeach; ?> 
              </select>
            </div>
            <div class="right">
              <select name="datasetTwo">     
                <option value="0">Dataset two</option>
 <?php foreach ($content as $attribute): ?> 
                <option value="<?= $attribute; ?>"><?= $attribute; ?></option>  
<?php endforeach; ?>              
              </select>
            </div>
            <input type="submit" name="create" value="Create" />
          </form>
        </article>