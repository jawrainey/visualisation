        <article>
          <h1>Settings</h1>
          <p><a href="#" class="toggle">Change password?</a></p>
          <div class="hide">
            <form>
              <label>Current password</label>
              <input name="curpassword" type="password" placeholder="Enter your current password" />
              <label>New password</label>
              <input name="newpassword" type="password" placeholder="Enter a new password" />
              <input type="submit" name="update" value="Update" />
            </form>
          </div>
          <p><a href="#" class="toggle">Change user type?</a></p>
          <div class="hide">  
            <form>
              <label for="beginner">Beginner</label>
              <input type="radio" id="beginner" name="usertype" value="beginner" />
              <label for="advanced">Advanced</label>
              <input type="radio" id="advanced" name="usertype" value="advanced" />
              <input type="submit" name="change" value="Change" />
            </form>
          </div>
        </article>