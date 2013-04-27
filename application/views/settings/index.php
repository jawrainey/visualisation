        <article>
          <h1>Settings</h1>
    <?php if(!empty($errors)): ?>
<ul class="error">
      <?= $errors; ?>
</ul>
    <?php endif; ?>
      <p><a href="#change-password" class="show_hide">Change password?</a></p>
          <div class="slidingDiv">
            <form name="change_password" method="post" action="<?= base_url() . 'settings/change-password/'; ?>">
              <label>Current password</label>
              <input name="curpassword" type="password" placeholder="Enter your current password" />
              <label>New password</label>
              <input name="newpassword" type="password" placeholder="Enter a new password" />
              <input type="hidden" name="user_id" value="<?= 2; ?>" id="user_id"  />
              <input type="submit" name="update" value="Update" />
            </form>
          </div>
          <p><a href="#change-type" class="toggle">Change user type?</a></p>
          <div class="hide">  
            <form name="" method="post" action="<?= base_url() . 'settings/level/'?>">
              <div class="left">
                <label for="beginner">Beginner</label>
                <input type="radio" id="beginner" name="usertype" value="beginner" />
              </div>
              <div class="right">
                <label for="advanced">Advanced</label>
                <input type="radio" id="advanced" name="usertype" value="advanced" />
              </div>
              <input type="submit" name="change" value="Change" />
            </form>
          </div>
        </article>
