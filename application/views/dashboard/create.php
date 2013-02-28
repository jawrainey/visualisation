        <article>
          <p><b>STAGE ONE</b></p>
          <h1>Create a new visualistion</h1>
          <p>Enter the name of your visualistion and select two datasets you wish to compare. You can also <a href="<?php echo $this->config->base_url() . 'dashboard/upload/'?>">upload</a> your own dataset for visualistion with the other datasets.</p>
          <?php echo validation_errors() ?>
          <form method="post" action="<?php echo $this->config->base_url() . 'dashboard/create/' ?>">
            <label for="visname">Name of visualistion:</label>
            <input name="visname" type="text" placeholder="Enter your visualistion name" value=""/>
            <p>Select two datasets to compare:</p>
            <div class="left">
              <select name="datasetOne">
                <option>Dataset One</option> 
                <option value="cosmos">Cosmos</option>  
                <option value="crimes">Crimes</option>  
                <option value="food">Food</option>
              </select>
            </div>
            <div class="right">
              <select name="datasetTwo">
                <option>Dataset Two</option>
                <option value="cosmos">Cosmos</option>  
                <option value="crimes">Crimes</option>  
                <option value="food">Food</option>
              </select>
            </div>
            <input type="submit" value="Create" />
          </form>
        </article>