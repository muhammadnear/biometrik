<!doctype html>
<html lang="en">
<head>
<title>Aplikasi Biometrik</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="<?php echo base_url()?>assets/images/lambang-pancasila.png">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- font files -->
<link href="//fonts.googleapis.com/css?family=Spectral" rel="stylesheet">
<!-- /font files -->
<!-- css files -->
<link href="<?php echo base_url()?>assets/css/style.css" rel='stylesheet' type='text/css' media="all" />
<!-- /css files -->
<link href="<?php echo base_url()?>assets/css/font-awesome.css" rel="stylesheet">		<!-- font-awesome icons-css-file -->

<link href="<?php echo base_url()?>assets/css/wickedpicker.css" rel="stylesheet" type='text/css' media="all" />

<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-2.1.4.min.js"></script>
<style type="text/css">
	.btn-db {
    text-transform: uppercase;
    background: #fcf8e3;
    color: #111111;
    padding: .8em .8em .8em .8em;
    border: none;
    font-size: 1em;
    outline: none;
    width: 43%;	
    letter-spacing: 1px;
    font-weight: 600;
    cursor: pointer;
    -webkit-transition: 0.5s all;
    -moz-transition: 0.5s all;
    -o-transition: 0.5s all;
    -ms-transition: 0.5s all;
    font-family: 'Open Sans', sans-serif;
}
</style>
</head>
<body>
	<div class="w3-banner-main">
		<div class="center-container">
			<h1 class="header-w3ls">Form Pelepasan WNI</h1><br>
			<center><a class="btn-db" href="<?php echo base_url()?>">
				Kembali ke dashboard
			</a></center>
			<div class="content-top">
				<div class="content-w3ls">
					<form action="<?php echo base_url()?>index.php/form/submit_pelepasan" method="post">
						<div class="form-w3ls">
							<div class="content-wthree1">
								<div class="grid-agileits1">
									<div class="form-control"> 
										<label class="header">Nama Pemohon<span>*</span></label>
										<input type="text" id="name" name="nama" placeholder="" title="Masukkan Nama Pemohon" required="">
									</div>
									<!-- <div class="grid-w3layouts1" style="margin-top: 10px; margin-bottom: 30px;">
										<div class="w3-agile1">
											<label class="rating">Rujukan<span>*</span></label>
											<ul>
												<li>
													<input type="radio" id="a-option" name="rujukan" value="0" checked="">
													<label for="a-option">Surat Kewarganegaraan </label>
													<div class="check"></div>
												</li>
												<li>
													<input type="radio" id="b-option" name="rujukan" value="1">
													<label for="b-option">Sijil Kewarganegaraan</label>
													<div class="check"><div class="inside"></div></div>
												</li>
												
											</ul>
										</div>	
									</div> -->
									<div class="form-control"> 
										<label class="header">Tempat Lahir<span>*</span></label>
										<input type="text" id="name" name="tempat_lahir" placeholder="" title="Masukkan Tempat Lahir Pemohon" >
									</div>
									<div class="form-control">
										<label class="header">Tanggal Lahir<span>*</span></label>	
										<input  id="datepicker" name="tgl_lahir" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'dd-mm-yyyy';}">
									</div>
									<div class="form-control"> 
										<label class="header">Nomor Telepon<span>*</span></label>
										<input type="text" id="name" name="no_telp" placeholder="" title="Masukkan Nomor Telepon" required="">
									</div>
									<div class="form-control">
										<label class="header">Rujukan<span>*</span></label>		
										<select class="form-control" name="tipe_surat_sijil">
											<option value="0">Surat Kewarganegaraan</option>
											<option value="1">Sijil Kewarganegaraan</option>
										</select>
									</div>
									<div class="form-control"> 
										<label class="header">Nomor Surat / Sijil<span>*</span></label>
										<input type="text" id="name" name="no_surat_sijil" placeholder="" title="Masukkan Nomor Surat / Sijil Kewarganegaraan" required="">
									</div>
									<div class="form-control">
										<label class="header">Tanggal Terbit Surat / Sijil <span>*</span></label>	
										<input  id="datepicker1" name="tgl_surat_sijil" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'dd-mm-yyyy';}" required="">
									</div>
									

									<div class="form-control" style="margin-top: 40px;"> 
										<label class="header">Nomor Paspor<span>*</span></label>
										<input type="text" id="name" name="no_paspor" placeholder="" title="Masukkan Nomor Paspor" required="">
									</div>
									<div class="form-control">
										<label class="header">Tanggal Terbit Paspor<span>*</span></label>	
										<input  id="datepicker2" name="tgl_terbit_paspor" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'dd-mm-yyyy';}" required="">
									</div>
									<div class="form-control"> 
										<label class="header">Diterbitkan Oleh<span>*</span></label>
										<input type="text" id="name" name="diterbitkan_oleh" placeholder="" title="Masukkan Penerbit Paspor" required="">
									</div>
									<div class="form-control"> 
										<label class="header">Nomor Pengenalan / IC<span>*</span></label>
										<input type="text" id="name" name="no_pengenalan" placeholder="" title="Masukkan Kewarganegaraan Bapak">
									</div>
								</div>
								
							</div>
					</div>
					
					<div class="form-w3ls-1">
						<div class="grid-w3layouts1" style="margin-top: 10px; margin-bottom: 30px;">
							<div class="w3-agile1">
								<label class="rating">Status Paspor<span>*</span></label>
								<ul>
									<li>
										<input type="radio" id="a-option" name="tipe_kehilangan_menyerahkan" value="0" checked="">
										<label for="a-option">Hilang </label>
										<div class="check"></div>
									</li>
									<li>
										<input type="radio" id="b-option" name="tipe_kehilangan_menyerahkan" value="1">
										<label for="b-option">Diserahkan</label>
										<div class="check"><div class="inside"></div></div>
									</li>
									
								</ul>
							</div>	
						</div>
						<div class="form-control w3-visit"> 
							<label class="header">Alamat di Indonesia <span>*</span></label>
							<textarea  name="alamat_indonesia" placeholder="" title="Mohon Masukkan Alamat Pemohon di Indonesia" required=""></textarea>
						</div>
						<div class="form-control w3-visit"> 
							<label class="header">Alamat di Malaysia <span>*</span></label>
							<textarea  name="alamat_malaysia" placeholder="" title="Mohon Masukkan Alamat Pemohon di Malaysia" required=""></textarea>
						</div>
						<div class="form-control w3-visit" style="height: 270px;"> 
							<label class="header">Alasan Menjadi WN Malaysia<span>*</span></label>
							<textarea  name="alasan" placeholder="" title="Mohon Masukkan Alasan Menjadi WN Malaysia" required=""></textarea>
						</div>
					</div>
					
				  <input type="submit" value="Buat Atkum Pelepasan WN">

				</form>
					<div class="clear"></div>
				</div>
				
			</div>	
				
				<p class="copyright">© 2017 Kedutaan Besar Republik Indonesia Kuala Lumpur | Design by <a href="#" >Intersys</a></p>
		</div>
	</div>

<!-- Calendar -->
				<link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery-ui.css" />
				<script src="<?php echo base_url()?>assets/js/jquery-ui.js"></script>
				  <script>
						  $(function() {
								$( "#datepicker,#datepicker1,#datepicker2,#datepicker3" ).datepicker({dateFormat:"dd-mm-yy"});
						  });
				  </script>
			<!-- //Calendar -->
			<script type="text/javascript" src="<?php echo base_url()?>assets/js/wickedpicker.js"></script>
			<script type="text/javascript">
				$('.timepicker').wickedpicker({twentyFour: false});
			</script>


</body>
</html>
