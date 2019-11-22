<div class="main">
  <div>
    <div class="login-title"><h1><?php echo self::APP; ?></h1></div>
    <div class="container-login">
      <div class="middle">
        <div id="login">
          <form action="index.php" method="POST">
            <fieldset class="clearfix">
              <p>
                <span class="fa fa-user"></span>
                <input type="text" name="user" Placeholder="Username" required>
              </p>
              <p>
                <span class="fa fa-lock"></span>
                <input type="password" name="pwd"  Placeholder="Password" required>
              </p>
              <div>
                  <span style="width:48%; text-align:left;  display: inline-block;">
                    <a class="small-text" href="#">Recuperar Clave</a>
                  </span>
                  <span style="width:50%; text-align:right;  display: inline-block;">
                    <input type="submit" value="Entrar" name="btn">
                  </span>
              </div>
            </fieldset>
            <div class="clearfix"></div>
          </form>
          <div class="clearfix"></div>
        </div>
        <div class="logo">
            <div style='text-align:center;'><img src='./statics/images/icon3.png' width="150px">
            <div class="clearfix"></div>
        </div>
      </div>
      <?php
        if(isset($_GET['error'])){
          echo "<div class='login-error'><p class='item error'>".$_GET['error']."</p></div>";
        }
      ?>
    </div>
  </div>
</div>