<?php 

$role = $_SESSION['login']['id_role'];

$cari_data_user = mysqli_query($conn, "SELECT * FROM tb_role where id_role='$role'");
$jumlah_data = mysqli_num_rows($cari_data_user);
$data_user = mysqli_fetch_array($cari_data_user);

$nama_role = $data_user['nama_role'];

?>


<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar bg-dark">
				<a class="sidebar-brand">
          <span class="align-middle">Elite </span>
        </a>

		<!-- dashboard menu admin -->
		<?php 
	        if ($_SESSION['login']['id_role'] === "1") {
	            echo '
	            		<li class="sidebar-header">
							Admin Page
						</li>
	            		<li class="sidebar-item" style="list-style:none;">
							<a class="sidebar-link bg-dark" href="../admin-page/">
			              		<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
			            	</a>
						</li>
						</li>
						<li class="sidebar-item" style="list-style:none;">
							<a class="sidebar-link bg-dark" href="../admin-page/post-admin.php">
			             		 <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Post</span>
			            	</a>
						</li>
						<li class="sidebar-header">
							User Control
						</li>
						<li class="sidebar-item" style="list-style:none;">
							<a class="sidebar-link bg-dark" href="../admin-page/class_controll.php">
			             		 <i class="align-middle" data-feather="fast-forward"></i> <span class="align-middle">Student Class</span>
			            	</a>
						</li>
						<li class="sidebar-item" style="list-style:none;">
							<a class="sidebar-link bg-dark" href="../admin-page/pendaftaran.php">
			             		 <i class="align-middle" data-feather="list"></i> <span class="align-middle">Pendaftaran</span>
			            	</a>
						</li>
						<li class="sidebar-header">
							Report Role
						</li>
						<li class="sidebar-item" style="list-style:none;">
							<a class="sidebar-link bg-dark" href="../admin-page/report_kas.php">
			             		 <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Bendahara Report</span>
			            	</a>
							<a class="sidebar-link bg-dark" href="../admin-page/report_inventory.php">
			             		 <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Inventaris Report</span>
			            	</a>
						</li>
						';
	        } 
        ?>
        <!-- dashboard menu admin -->

        <!-- menu user -->
		<?php 
	        if ($_SESSION['login']['id_role'] == "4") {
	            echo '<li class="sidebar-header">
							Member Page
						</li>
						<li class="sidebar-item" style="list-style:none;">
							<a class="sidebar-link bg-dark" href="../member-page/index.php">
			             		 <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
			            	</a>
						</li>
						<li class="sidebar-item" style="list-style:none;">
							<a class="sidebar-link bg-dark" href="../member-page/return_items.php">
			             		 <i class="align-middle" data-feather="clipboard"></i> <span class="align-middle">Borrowing Stuff</span>
			            	</a>
						</li>
						';
	        } 
        ?>
        <!-- menu user -->
		
        <!-- sidebar inventaris -->
		<?php 
	        if ($_SESSION['login']['id_role'] === "2") {
	            echo '
	            		<li class="sidebar-header">
							Inventory Page
						</li>
						<li class="sidebar-item" style="list-style:none;">
							<a class="sidebar-link bg-dark" href="../inventaris-page/index.php">
			             		 <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
			            	</a>
						</li>
						<li class="sidebar-item" style="list-style:none;">
							<a class="sidebar-link bg-dark" href="../inventaris-page/in_pending.php">
			             		 <i class="align-middle" data-feather="share"></i> <span class="align-middle">Pending Checking</span>
			            	</a>
						</li>
						<li class="sidebar-item" style="list-style:none;">
							<a class="sidebar-link bg-dark" href="../inventaris-page/peminjaman.php">
			             		 <i class="align-middle" data-feather="inbox"></i> <span class="align-middle">Peminjaman</span>
			            	</a>
						</li>
						<li class="sidebar-item" style="list-style:none;">
							<a class="sidebar-link bg-dark" href="../inventaris-page/report_inventory.php">
			             		 <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Inventaris Report</span>
			            	</a>
						</li>
						<li class="sidebar-header">
							Peminjaman
						</li>
						<li class="sidebar-item" style="list-style:none;">
							<a class="sidebar-link bg-dark" href="../inventaris-page/inventory.php">
			             		 <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Inventory</span>
			            	</a>
						</li>
						<li class="sidebar-item" style="list-style:none;">
							<a class="sidebar-link bg-dark" href="../inventaris-page/return_items.php">
			             		 <i class="align-middle" data-feather="archive"></i> <span class="align-middle">Pengembalian</span>
			            	</a>
						</li>
	            ';
	        } 
        ?>

		
		<!-- bendahara -->

		<?php 
	        if ($_SESSION['login']['id_role'] === "3") {
	            echo '
	            		<li class="sidebar-header">
							Financial Page
						</li>
						<li class="sidebar-item" style="list-style:none;">
							<a class="sidebar-link bg-dark" href="../bendahara-page/index.php">
			             		 <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Dashboard</span>
			            	</a>
						</li>
						<li class="sidebar-item" style="list-style:none;">
							<a class="sidebar-link bg-dark" href="../bendahara-page/pengeluaran.php">
			             		 <i class="align-middle" data-feather="clipboard"></i> <span class="align-middle">Pengeluaran</span>
			            	</a>
						</li>
						<li class="sidebar-item" style="list-style:none;">
							<a class="sidebar-link bg-dark" href="../bendahara-page/report_kas.php">
			             		 <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Kas Report</span>
			            	</a>
						</li>
						<li class="sidebar-header">
							Peminjaman Page
						</li>
						<li class="sidebar-item" style="list-style:none;">
							<a class="sidebar-link bg-dark" href="../bendahara-page/inventory.php">
			             		 <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Inventory</span>
			            	</a>
						</li>
						<li class="sidebar-item" style="list-style:none;">
							<a class="sidebar-link bg-dark" href="../bendahara-page/return_items.php">
			             		 <i class="align-middle" data-feather="archive"></i> <span class="align-middle">Pengembalian</span>
			            	</a>
						</li>

	            ';
	        } 
        ?>

<?php 
	        if ($_SESSION['login']['id_role'] == "5") {
	            echo '<li class="sidebar-header">
							Member Page
						</li>
						<li class="sidebar-item" style="list-style:none;">
							<a class="sidebar-link bg-dark" href="../alumni-page/index.php">
			             		 <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
			            	</a>
						</li>
						<li class="sidebar-item" style="list-style:none;">
							<a class="sidebar-link bg-dark" href="../alumni-page/return_items.php">
			             		 <i class="align-middle" data-feather="clipboard"></i> <span class="align-middle">Borrowing Stuff</span>
			            	</a>
						</li>';
	        } 
        ?>
				<br>
			</div>
		</nav>