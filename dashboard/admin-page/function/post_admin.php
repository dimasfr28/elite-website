<?php 
if (isset($_POST['select'])) {
    if ($_POST['select'] == 'all') {
        $isi = '';
    }elseif ($_POST['select'] == 1) {
        $isi = 'WHERE tb_post.id_kategori = 1';
    }elseif ($_POST['select'] == 2) {
        $isi = 'WHERE tb_post.id_kategori = 2';
    }elseif ($_POST['select'] == 3) {
        $isi = 'WHERE tb_post.id_kategori = 3';
    }
}elseif (@$_POST['select'] == null) {
    $isi = '';
}
$select = query("SELECT * FROM tb_post LEFT JOIN tb_kategori_post ON tb_post.id_kategori = tb_kategori_post.id_kategori $isi");
?>