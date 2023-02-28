<?php  

$id = $_SESSION['login']['id_user'];
$sel = mysqli_query($conn, "SELECT * FROM tb_user WHERE id_user = $id");
$your = mysqli_fetch_assoc($sel);
?>


	<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">

							<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                <img src="../../profile/<?= $your['image_profile'] ?>" class="avatar img-fluid rounded me-1" style="width: 40px;
								height: 40px;
								object-fit: cover;
								object-position: center;"/> <span class="text-dark"><?= $your['nama_lengkap'] ?></span>
              </a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="../template/profile.php"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
								
								<a class="dropdown-item" href="../template/logout.php"><i class="align-middle me-1" data-feather="log-out"></i>Log out</a>
							</div>
						</li>
					</ul>
				</div>