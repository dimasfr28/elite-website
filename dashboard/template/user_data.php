<?php  
include "../../koneksi/conn.php";
$user = mysqli_query($conn, "SELECT * FROM tb_kas_siswa WHERE id_user = $user_id");
$saldouser = mysqli_fetch_assoc($user);

$peminjaman_pribadi = mysqli_query($conn, "SELECT * FROM tb_peminjaman_detail LEFT JOIN tb_peminjaman ON tb_peminjaman.id_peminjaman = tb_peminjaman_detail.id_peminjaman WHERE tb_peminjaman.id_user = $user_id");
$peminjamanmu = mysqli_num_rows($peminjaman_pribadi);

$nor = mysqli_query($conn, "SELECT * FROM tb_peminjaman_detail LEFT JOIN tb_peminjaman ON tb_peminjaman_detail.id_peminjaman = tb_peminjaman.id_peminjaman WHERE id_status_p = 0 AND tb_peminjaman.id_user = $user_id");
$youno = mysqli_num_rows($nor);

$detail_peminjamanu = mysqli_query($conn, "SELECT * FROM tb_peminjaman_detail LEFT JOIN tb_inventory ON tb_inventory.id_barang = tb_peminjaman_detail.id_barang LEFT JOIN tb_peminjaman ON tb_peminjaman.id_peminjaman = tb_peminjaman_detail.id_peminjaman WHERE tb_peminjaman_detail.id_status_p = 0 AND tb_peminjaman.id_user = $user_id");
$belum = mysqli_num_rows($detail_peminjamanu);

$kembali = mysqli_query($conn, "SELECT * FROM tb_peminjaman_detail LEFT JOIN tb_inventory ON tb_inventory.id_barang = tb_peminjaman_detail.id_barang LEFT JOIN tb_peminjaman ON tb_peminjaman.id_peminjaman = tb_peminjaman_detail.id_peminjaman WHERE tb_peminjaman_detail.id_status_p = 2 AND tb_peminjaman.id_user = $user_id");
$sudah = mysqli_num_rows($kembali);

?>
<div class="col-xl-6 col-xxl-6 d-flex">
                            <div class="w-100">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col mt-0">
                                                        <h5 class="card-title">Saldo KAS</h5>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="stat text-primary">
                                                            <i class="align-middle" data-feather="dollar-sign"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h1 class="mt-1 mb-3"><?php
                                                                        $saldoo = (int)$saldouser['saldo'];
                                                                        $saldos = (int)$saldoo;
                                                                        echo rupiah($saldos);
                                                                        ?></h1>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col mt-0">
                                                        <h5 class="card-title">Total Peminjaman</h5>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="stat text-primary">
                                                            <i class="align-middle" data-feather="archive"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h1 class="mt-1 mb-3"><?= $peminjamanmu; ?> <span style="color: #717171;">Peminjaman</span></h1>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-xxl-6 d-flex">
                            <div class="w-100">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col mt-0">
                                                        <h5 class="card-title">Items Belum Dikembalikan</h5>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="stat text-primary">
                                                            <i class="align-middle" data-feather="alert-octagon"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h1 class="mt-1 mb-3"><?= $belum; ?><span style="color: #717171;"> Items</span></h1>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col mt-0">
                                                        <h5 class="card-title">Items Dikembalikan</h5>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="stat text-primary">
                                                            <i class="align-middle" data-feather="check-square"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h1 class="mt-1 mb-3"><?= $sudah; ?> <span style="color: #717171;"> Items</span></h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>