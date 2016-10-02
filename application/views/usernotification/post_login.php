<div class="col s12 filler">
	<div class="card centernotif padding20">
		<blockquote class="quote-green"><h4>Login berhasil</h4></blockquote>
		<p>Anda terdaftar sebagai : </p>
		<ul class="collection">
			<li class="collection-item"><strong>Tipe User</strong> : <i><?php echo $level ?></i></li>
			<li class="collection-item"><strong>Kode Indentitas</strong> : <i><?php echo $id_code ?></i></li>
			<li class="collection-item"><strong>Nama</strong> : <i><?php echo $name ?></i></li>
		</ul>
		<small>Silahkan tunggu beberapa saat...</small>
		<script>
		setTimeout(function(){
			document.location = "<?php echo $redir ?>";
		},<?php echo $time ?>*1000);
		</script>
	</div>
</div>