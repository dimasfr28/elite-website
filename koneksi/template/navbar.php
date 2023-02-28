  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <!-- Uncomment below if you prefer to use an image logo -->
       <a href="index.php" class="logo"><img src="assets/img/logoutama1.png" alt="" width="120px"></a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link <?php if ($title == 'ELITE') {
            echo "active";
          } ?>" href="./">Home</a></li>
          <li><a class="nav-link <?php if ($title == 'History') {
            echo "active";
          } ?>" href="history.php">History</a></li>
          <li><a class="nav-link <?php if ($title == 'Achievement') {
            echo "active";
          } ?>" href="achievement.php">Achievement</a></li>
          <li><a class="nav-link <?php if ($title == 'Post') {
            echo "active";
          } ?>
          " href="post.php">Post</a></li>

          <li><a class="nav-link <?php if ($title == 'Login') {
            echo "active";
          } ?>
          " href="login/">Login</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header>