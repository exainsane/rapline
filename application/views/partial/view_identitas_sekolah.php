<div class="col s12">
	<h3>Data Sekolah</h3>
	<form method="POST">
		<input type="hidden" name="save" value="1">
		<div class="row">
			<div class="col s12 l6">
				<div class="input-field"> 
					<input value="<?php echo getValue("nama_sekolah",$data) ?>" placeholder="Nama Sekolah" id="nama_sekolah-field" type="text" name="dct-nama_sekolah" class="validate"> 
					<label for="nama_siswa-field">Nama Sekolah</label> 
				</div>
				<div class="input-field"> 
					<input value="<?php echo getValue("npsn",$data) ?>" placeholder="NPSN" id="npsn-field" type="text" name="dct-npsn" class="validate"> 
					<label for="nama_siswa-field">NPSN</label> 
				</div>
				<div class="input-field"> 
					<input value="<?php echo getValue("nis_nss_nds",$data) ?>" placeholder="NIS/NSS/NDS" id="nis_nss_nds-field" type="text" name="dct-nis_nss_nds" class="validate"> 
					<label for="nama_siswa-field">NIS/NSS/NDS</label> 
				</div>
				<div class="input-field"> 
					<input value="<?php echo getValue("alamat",$data) ?>" placeholder="Alamat Sekolah" id="alamat-field" type="text" name="dct-alamat" class="validate"> 
					<label for="nama_siswa-field">Alamat Sekolah</label> 
				</div>
				<div class="input-field"> 
					<input value="<?php echo getValue("kode_pos",$data) ?>" placeholder="Kode Pos" id="kode_pos-field" type="text" name="dct-kode_pos" class="validate"> 
					<label for="nama_siswa-field">Kode Pos</label> 
				</div>
				<div class="input-field"> 
					<input value="<?php echo getValue("telepon",$data) ?>" placeholder="Telepon" id="telepon-field" type="text" name="dct-telepon" class="validate"> 
					<label for="nama_siswa-field">Telepon</label> 
				</div>
			</div>
			<div class="col s12 l6">
				
				<div class="input-field"> 
					<input value="<?php echo getValue("kelurahan",$data) ?>" placeholder="Kelurahan" id="kelurahan-field" type="text" name="dct-kelurahan" class="validate"> 
					<label for="nama_siswa-field">Kelurahan</label> 
				</div>
				<div class="input-field"> 
					<input value="<?php echo getValue("kecamatan",$data) ?>" placeholder="Kecamatan" id="kecamatan-field" type="text" name="dct-kecamatan" class="validate"> 
					<label for="nama_siswa-field">Kecamatan</label> 
				</div>
				<div class="input-field"> 
					<input value="<?php echo getValue("kota_kabupaten",$data) ?>" placeholder="Kota/Kabupaten" id="kota_kabupaten-field" type="text" name="dct-kota_kabupaten" class="validate"> 
					<label for="nama_siswa-field">Kota/Kabupaten</label> 
				</div>
				<div class="input-field"> 
					<input value="<?php echo getValue("provinsi",$data) ?>" placeholder="Provinsi" id="provinsi-field" type="text" name="dct-provinsi" class="validate"> 
					<label for="nama_siswa-field">Provinsi</label> 
				</div>
				<div class="input-field"> 
					<input value="<?php echo getValue("website",$data) ?>" placeholder="Website" id="website-field" type="text" name="dct-website" class="validate"> 
					<label for="nama_siswa-field">Website</label> 
				</div>
				<div class="input-field"> 
					<input value="<?php echo getValue("email",$data) ?>" placeholder="E-Mail" id="email-field" type="text" name="dct-email" class="validate"> 
					<label for="nama_siswa-field">E-Mail</label> 
				</div>
			</div>
		</div>
		
		<button class="btn btn-flat red white-text right">Save</button>
	</form>
	
</div>