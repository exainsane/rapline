<div class="row"> 
	<h5 class="">Biodata</h5> 
	<div class="col s12"> 
		<form method="POST" class="cardchild-padding-20" enctype="multipart/form-data"> 		
			<input type="hidden" name="table" value="<?php echo base64_encode("m_siswa") ?>">	
			<input type="hidden" name="id" value="<?php echo getValueEncoded("id",$data) ?>">		
			<div class="row">
				<div class="col s12 l6">
					<div class="card">
						<div class="input-field"> 
							<input value="<?php echo getValue("nama_siswa",$data) ?>" placeholder="input Nama Siswa" id="nama_siswa-field" type="text" name="nama_siswa" class="validate"> 
							<label for="nama_siswa-field">Nama Siswa</label> 
						</div>
						<div class="input-field"> 
							<input value="<?php echo getValue("kode_identitas",$data) ?>" placeholder="input Kode Identitas" id="kode_identitas-field" type="text" name="kode_identitas" class="validate"> 
							<label for="kode_identitas-field">Kode Identitas</label> 
						</div>
						<div class="input-field"> 
							<input value="<?php echo getValue("jenis_kelamin",$data) ?>" placeholder="input Jenis Kelamin" id="jenis_kelamin-field" type="text" name="jenis_kelamin" class="validate"> 
							<label for="jenis_kelamin-field">Jenis Kelamin</label> 
						</div>
						<div class="input-field"> 
							<input value="<?php echo getValue("agama",$data) ?>" placeholder="input Agama" id="agama-field" type="text" name="agama" class="validate"> 
							<label for="agama-field">Agama</label> 
						</div>
					</div>
				</div>
				<div class="col s12 l6">					
					<div class="card">				
						<div class="input-field"> 
							<input value="<?php echo getValue("status_dalam_keluarga",$data) ?>" placeholder="input Status Dalam Keluarga" id="status_dalam_keluarga-field" type="text" name="status_dalam_keluarga" class="validate"> 
							<label for="status_dalam_keluarga-field">Status Dalam Keluarga</label> 
						</div>
						<div class="input-field"> 
							<input value="<?php echo getValue("anak_ke",$data) ?>" placeholder="input Anak Ke" id="anak_ke-field" type="text" name="anak_ke" class="validate"> 
							<label for="anak_ke-field">Anak Ke</label> 
						</div>
						<div class="input-field"> 
							<input value="<?php echo getValue("alamat_siswa",$data) ?>" placeholder="input Alamat Siswa" id="alamat_siswa-field" type="text" name="alamat_siswa" class="validate"> 
							<label for="alamat_siswa-field">Alamat Siswa</label> 
						</div>
						<div class="input-field"> 
							<input value="<?php echo getValue("no_telp_rumah",$data) ?>" placeholder="input No Telp Rumah" id="no_telp_rumah-field" type="text" name="no_telp_rumah" class="validate"> 
							<label for="no_telp_rumah-field">No Telp Rumah</label> 
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col s12 l6">
					<div class="card">				
						<div class="input-field"> 
							<input value="<?php echo getValue("sekolah_asal",$data) ?>" placeholder="input Sekolah Asal" id="sekolah_asal-field" type="text" name="sekolah_asal" class="validate"> 
							<label for="sekolah_asal-field">Sekolah Asal</label> 
						</div>
						<div class="input-field"> 
							<input value="<?php echo getValue("di_terima_kelas",$data) ?>" placeholder="input Di Terima Kelas" id="di_terima_kelas-field" type="text" name="di_terima_kelas" class="validate"> 
							<label for="di_terima_kelas-field">Di Terima Kelas</label> 
						</div>
						<div class="input-field"> 
							<input value="<?php echo getValue("di_terima_tanggal",$data) ?>" placeholder="input Di Terima Tanggal" id="di_terima_tanggal-field" type="text" name="di_terima_tanggal" class="validate"> 
							<label for="di_terima_tanggal-field">Di Terima Tanggal</label> 
						</div>
					</div>
				</div>
				<div class="col s12 l6">
					<div class="card">				
						<div class="input-field" style="margin:10px 0px 30px">
							<span for="">Foto</span>
					     	<input type="file" name="photo" />
					     	
					    </div>			
						<div class="input-field"> 
							<input value="<?php echo getValue("email",$data) ?>" placeholder="input Email" id="email-field" type="text" name="email" class="validate"> 
							<label for="email-field">Email</label> 
						</div> 
					</div>					
				</div>
			</div>		
			<div class="row">
					<div class="col s12 l6">
						<div class="card">
							
							<div class="input-field"> 
								<input value="<?php echo getValue("nama_wali",$data) ?>" placeholder="input Nama Wali" id="nama_wali-field" type="text" name="nama_wali" class="validate"> 
								<label for="nama_wali-field">Nama Wali</label> 
							</div>
							<div class="input-field"> 
								<input value="<?php echo getValue("alamat_wali",$data) ?>" placeholder="input Alamat Wali" id="alamat_wali-field" type="text" name="alamat_wali" class="validate"> 
								<label for="alamat_wali-field">Alamat Wali</label> 
							</div>
							<div class="input-field"> 
								<input value="<?php echo getValue("no_telepon_wali",$data) ?>" placeholder="input No Telepon Wali" id="no_telepon_wali-field" type="text" name="no_telepon_wali" class="validate"> 
								<label for="no_telepon_wali-field">No Telepon Wali</label> 
							</div>
							<div class="input-field"> 
								<input value="<?php echo getValue("pekerjaan_wali",$data) ?>" placeholder="input Pekerjaan Wali" id="pekerjaan_wali-field" type="text" name="pekerjaan_wali" class="validate"> 
								<label for="pekerjaan_wali-field">Pekerjaan Wali</label> 
							</div>
						</div>
					</div>
					<div class="col s12 l6">
						<div class="card">				
							<div class="input-field"> 
								<input value="<?php echo getValue("nama_ibu",$data) ?>" placeholder="input Nama Ibu" id="nama_ibu-field" type="text" name="nama_ibu" class="validate"> 
								<label for="nama_ibu-field">Nama Ibu</label> 
							</div>
							<div class="input-field"> 
								<input value="<?php echo getValue("nama_ayah",$data) ?>" placeholder="input Nama Ayah" id="nama_ayah-field" type="text" name="nama_ayah" class="validate"> 
								<label for="nama_ayah-field">Nama Ayah</label> 
							</div>
							<div class="input-field"> 
								<input value="<?php echo getValue("alamat_orangtua",$data) ?>" placeholder="input Alamat Orangtua" id="alamat_orangtua-field" type="text" name="alamat_orangtua" class="validate"> 
								<label for="alamat_orangtua-field">Alamat Orangtua</label> 
							</div>
							<div class="input-field"> 
								<input value="<?php echo getValue("no_telepon_rumah",$data) ?>" placeholder="input No Telepon Rumah" id="no_telepon_rumah-field" type="text" name="no_telepon_rumah" class="validate"> 
								<label for="no_telepon_rumah-field">No Telepon Rumah</label> 
							</div>
							<div class="input-field"> 
								<input value="<?php echo getValue("pekerjaan_ayah",$data) ?>" placeholder="input Pekerjaan Ayah" id="pekerjaan_ayah-field" type="text" name="pekerjaan_ayah" class="validate"> 
								<label for="pekerjaan_ayah-field">Pekerjaan Ayah</label> 
							</div>
							<div class="input-field"> 
								<input value="<?php echo getValue("pekerjaan_ibu",$data) ?>" placeholder="input Pekerjaan Ibu" id="pekerjaan_ibu-field" type="text" name="pekerjaan_ibu" class="validate"> 
								<label for="pekerjaan_ibu-field">Pekerjaan Ibu</label> 
							</div>
						</div>
					</div>
				</div>						
			<button class="btn btn-flat red white-text right">Send</button> 
		</form> 
	</div> 
</div>