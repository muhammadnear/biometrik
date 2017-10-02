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

<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-2.1.4.min.js"></script>
</head>
<body>
	<div class="w3-banner-main">
		<div class="center-container">
			<h1 class="header-w3ls">Form SPLP</h1><br>
			<center><a class="btn-db" href="<?php echo base_url()?>">
				Kembali ke dashboard
			</a></center>
			<div class="content-top">
				<div class="content-w3ls">
					<form action="<?php echo base_url()?>index.php/form/submit_splp" method="post">
						<div class="form-w3ls">
							<div class="content-wthree1">
								<div class="grid-agileits1">
									<div class="form-control"> 
										<label class="header">Nama Anak<span>*</span></label>
										<input type="text" id="name" name="nama" placeholder="" title="Masukkan Nama Anak" required="">
									</div>
									<div class="grid-w3layouts1" style="margin-top: 10px; margin-bottom: 30px;">
										<div class="w3-agile1">
											<label class="rating">Jenis Kelamin Anak<span>*</span></label>
											<ul>
												<li>
													<input type="radio" id="a-option" name="jenis_kel" value="L" checked="">
													<label for="a-option">Laki-laki </label>
													<div class="check"></div>
												</li>
												<li>
													<input type="radio" id="b-option" name="jenis_kel" value="P">
													<label for="b-option">Perempuan</label>
													<div class="check"><div class="inside"></div></div>
												</li>
												
											</ul>
										</div>	
									</div>
									<div class="form-control">
										<label class="header">Pasal <span>*</span></label>		
										<select class="form-control" name="pasal">
											<?php 
												foreach ($pasal as $key) {
													echo "<option value='$key->id_pasal_splp'>$key->value</option>";
												}
											?>
											
										</select>
									</div>
									<div class="form-control"> 
										<label class="header">Tempat Lahir Anak <span>*</span></label>
										<input type="text" id="name" name="tempat_lahir" placeholder="" title="Masukkan Tempat Lahir Pemohon" required="">
									</div>
									<div class="form-control">
										<label class="header">Tanggal Lahir Anak <span>*</span></label>	
										<input  id="datepicker1" name="tanggal_lahir" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'dd-mm-yyyy';}" required="">
									</div>
									

									<div class="form-control" style="margin-top: 40px;"> 
										<label class="header">Nama Ibu<span>*</span></label>
										<input type="text" id="name" name="nama_ibu" placeholder="" title="Masukkan Nama Ibu" required="">
									</div>
									<div class="form-control"> 
										<label class="header">Tempat Lahir Ibu<span>*</span></label>
										<input type="text" id="name" name="tempat_lahir_ibu" placeholder="" title="Masukkan Tempat Lahir Pemohon" required="">
									</div>
									<div class="form-control">
										<label class="header">Tanggal Lahir Ibu<span>*</span></label>	
										<input  id="datepicker2" name="tanggal_lahir_ibu" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'dd-mm-yyyy';}" required="">
									</div>
									<div class="form-control"> 
										<label class="header">Kewarganegaraan Ibu<span>*</span></label>
										<input type="text" id="name" name="kewarganegaraan_ibu" placeholder="" title="Masukkan Kewarganegaraan Ibu" required="">
									</div>
								</div>
								
							</div>
					</div>
					
					<div class="form-w3ls-1">
						<div class="form-control"> 
							<label class="header">Alamat di Indonesia <span>*</span></label>
							<textarea  name="alamat_indonesia" placeholder="" title="Mohon Masukkan Alamat Pemohon di Indonesia" required=""></textarea>
						</div>
						<div class="form-control w3-visit"> 
							<label class="header">Alamat di Luar Negeri <span>*</span></label>
							<textarea  name="alamat_ln" placeholder="" title="Mohon Masukkan Alamat Pemohon di Luar Negeri" required=""></textarea>
						</div>
						<div class="form-control" style="margin-top: 47px;"> 
							<label class="header">Nama Bapak<span>*</span></label>
							<input type="text" id="name" name="nama_bapak" placeholder="" title="Masukkan Nama Bapak">
						</div>
						<div class="form-control"> 
							<label class="header">Tempat Lahir Bapak<span>*</span></label>
							<input type="text" id="name" name="tempat_lahir_bapak" placeholder="" title="Masukkan Tempat Lahir Bapak" >
						</div>
						<div class="form-control">
							<label class="header">Tanggal Lahir Bapak<span>*</span></label>	
							<input  id="datepicker" name="tanggal_lahir_bapak" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'dd-mm-yyyy';}">
						</div>
						<div class="form-control"> 
							<label class="header">Kewarganegaraan Bapak<span>*</span></label>
							<input type="text" id="name" name="kewarganegaraan_bapak" placeholder="" title="Masukkan Kewarganegaraan Bapak">
						</div>
					</div>
					
				  <input type="submit" value="Buat Atkum SPLP">

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
