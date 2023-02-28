<div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
				        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				      </div>
					  <div class="modal-body">
							<form action="" method="post" enctype="multipart/form-data">
								<div class="mb-3">
									<label for="nama_lengkap" class="col-form-label">Nama Lengkap :</label>
									<input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap">
								</div>
								<div class="mb-3">
									<label for="email" class="col-form-label">Email :</label>
									<input type="email" class="form-control" id="email" name="email">
								</div>
								<div class="mb-3">
									<label for="image_profile" class="col-form-label">Profile :</label>
									<input type="file" class="form-control" id="image_profile" name="image_profile">
								</div>
								<div class="mb-3">
									<label for="id_role" class="col-form-label">Role :</label>
									<select class="form-select" id="id_role" name="id_role" required>
										<option selected>--Pilih Role--</option>
										<?php 
										$kuer4 = mysqli_query($conn, "SELECT * FROM tb_role"); 
										while ($data4 = mysqli_fetch_array($kuer4)) {
											echo '
											<option value="'.$data4["id_role"].'" id="id_role" name="id_role">'.$data4["nama_role"].'</option>';
										}
										?>
									</select>
								</div>
								<div class="mb-3">
									<label for="id_kelas" class="col-form-label">Kelas :</label>
									<select class="form-select"  id="id_kelas" name="id_kelas">
										<option selected>--Pilih Kelas--</option>
										<?php 
										$kuer2 = mysqli_query($conn, "SELECT * FROM tb_kelas"); 
										while ($data3 = mysqli_fetch_array($kuer2)) {
											echo '
											<option value="'.$data3["id_kelas"].'" id="id_kelas" name="id_kelas">'.$data3["nama_kelas"].'</option>';
										}
										?>
									</select>
								</div>
								<div class="mb-3">
									<label for="password" class="col-form-label">Password :</label>
									<input type="password" class="form-control" id="password" name="password">
								</div>
							
						</div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-warning" name="register">SignUp</button>
				      </div>
					  </form>
				    </div>
				  </div>