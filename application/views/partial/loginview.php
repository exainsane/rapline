<div class="col s12 l3">
	<?php if (!$status): ?>
		<div class="card  padding20">
			<h5 class="left-align">Login</h5>
			<br>
			<form action="<?php echo site_url("home/login/verify") ?>" method="POST">
				<div class="input-field">
		          <input placeholder="NIP/NIS" id="login_username" type="text" name="username" class="validate">
		          <label for="login_username">Username</label>
		        </div>
		        <div class="input-field">
		          <input placeholder="Password" id="login_password" type="password" name="password" class="validate">
		          <label for="login_password">Password</label>
		        </div>
		        <?php if (isset($failed) && $failed == true): ?>
		        	<p class="red-text">Login gagal! Silahkan cek username dan password anda</p>
		        <?php endif ?>
		        <button class="btn right indigo darken-1">Submit</button>
			</form>
		</div>
	<?php else: ?>	
		<div class="card  padding20">
				<h5 class="left-align">Welcome</h5>
				<br>
				<?php  
				$udt = getUserData();                                
				if(isset($udt->nama_guru)){
                                    $udt->nama = $udt->nama_guru;
                                }else if(isset($udt->nama_siswa)){
                                    $udt->nama = $udt->nama_siswa;
                                }
				?>
				<ul class="collection with-header">
					<li class="collection-header">Your Account Info</li>
					<li class="collection-item">Nama : <b><?php echo $udt->nama ?></b></li>
					<li class="collection-item">Status Login : <b><?php echo getUserType() ?></b></li>					
					<li class="collection-item"><a href="<?php echo site_url("home/logout") ?>">Logout</a></li>
				</ul>
			</div>
	<?php endif ?>
</div>