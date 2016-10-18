<div class="row fillarea">
	<div class="col s12 l12">
		<div class="card  padding20">
			<h5 class="right-align">Dapatkan Password</h5>
			<?php if (!isset($password_show)): ?>
				<small class="right">Silahkan input kode identitas anda terlebih dahulu, lalu sistem akan mengkonfirmasi identitas anda</small>
				<br>
				<div id="frmpst1">
					<div class="input-field">
			          <input placeholder="NIP/NIS" id="cred_id" type="text" class="validate">
			          <label for="cred_id">No. NIP/NIS anda</label>
			        </div>
			        <button class="btn right indigo darken-1" onclick="pwdpage.checkCredential('<?php echo site_url("home/credCheck") ?>')">Submit</button>
				</div>
				<div id="frmrst"></div>
			<?php else: ?>
				<p>Your password : </p>
				<h4><?php echo $password_show ?></h4>
			<?php endif ?>
		</div>
	</div>
</div>