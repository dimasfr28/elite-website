<?php  
$batas = 20;
$halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	
 
$previous = $halaman - 1;
$next = $halaman + 1;
$data = mysqli_query($conn,"SELECT * FROM tb_post WHERE NOT id_kategori = 1");
$jumlah_data = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);
$nomor = $halaman_awal+1;
