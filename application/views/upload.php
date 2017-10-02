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
			<h1 class="header-w3ls">Upload Berkas</h1><br>
			<center><a class="btn-db" href="<?php echo base_url()?>">
				Kembali ke dashboard
			</a></center>
			<?php
				if(!empty($error))
				{
					echo "<div style='margin: auto; padding: 2%;'>";
					echo "<center><p style='padding:15px; font-family: sans-serif; background-color:#f2dede; color: black;'>$error</p></center>";
					echo "</div>";
				}
				else if(!empty($sukses))
				{
					echo "<div style='margin: auto; padding: 2%;'>";
					echo "<center><p style='padding:15px; font-family: sans-serif; background-color:#dff0d8; color: black;'>$sukses</p></center>";
					echo "</div>";
				}
			?>
			<div class="content-top">
				<div class="content-w3ls">
					<form action="<?php echo base_url()?>index.php/form/upload_berkas" enctype="multipart/form-data" method="post">
						<div class="form-w3ls">
							<div class="content-wthree1">
								<div class="grid-agileits1">
									<div class="form-control"> 
										<label class="header">Nomor Berkas<span>*</span></label>
										<input type="text" id="name" name="no_berkas" placeholder="" title="Masukkan Nomor Berkas" required="">
									</div>
									<div class="form-control"> 
										<label class="header">Pilih Berkas<span>*</span></label>
										<input type="file" id="files" name="files" />
									</div>
								</div>
								
							</div>
					</div>
					
					<div class="form-w3ls-1">
						<div class="grid-w3layouts1" style="margin-top: 10px; margin-bottom: 50px;">
							<div class="w3-agile1">
								<label class="rating">Tipe Berkas<span>*</span></label>
								<ul>
									<li>
										<input type="radio" id="a-option" name="tipe_berkas" value="splp" checked="">
										<label for="a-option">Atkum SPLP </label>
										<div class="check"></div>
									</li>
									<li>
										<input type="radio" id="b-option" name="tipe_berkas" value="pelepasan">
										<label for="b-option">Atkum Pelepasan WNI</label>
										<div class="check"><div class="inside"></div></div>
									</li>
								</ul>
							</div>	
						</div>
					</div>
					
				  <input type="submit" value="Upload Berkas">

				</form>
					<div class="clear"></div>
				</div>
				
			</div>	
				
				<p class="copyright" style="margin-top: 140px;">© 2017 Kedutaan Besar Republik Indonesia Kuala Lumpur | Design by <a href="#" >Intersys</a></p>
		</div>
	</div>

<!-- Calendar -->
				<link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery-ui.css" />
				<script src="<?php echo base_url()?>assets/js/jquery-ui.js"></script>

</body>
</html>
