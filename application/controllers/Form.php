<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('Form_model');
	}

	function toBulan($string)
	{
		$tgl = explode('-', $string);
		return $tgl[0].' '.$this->bulan_indonesia($tgl[1]).' '.$tgl[2];
	}

	function integerToRoman($integer)
	{
		// Convert the integer into an integer (just to make sure)
		$integer = intval($integer);
		$result = '';

		// Create a lookup array that contains all of the Roman numerals.
		$lookup = array('M' => 1000,
		'CM' => 900,
		'D' => 500,
		'CD' => 400,
		'C' => 100,
		'XC' => 90,
		'L' => 50,
		'XL' => 40,
		'X' => 10,
		'IX' => 9,
		'V' => 5,
		'IV' => 4,
		'I' => 1);

		foreach($lookup as $roman => $value){
		// Determine the number of matches
		$matches = intval($integer/$value);

		// Add the same number of characters to the string
		$result .= str_repeat($roman,$matches);

		// Set the integer to be the remainder of the integer and the value
		$integer = $integer % $value;
		}

		// The Roman numeral should be built, return it
		return $result;
	}

	function bulan_indonesia($bln)
	{
		$bln = ltrim($bln, '0');
		if($bln == 1) return "Januari";
		else if($bln == 2) return "Februari";
		else if($bln == 3) return "Maret";
		else if($bln == 4) return "April";
		else if($bln == 5) return "Mei";
		else if($bln == 6) return "Juni";
		else if($bln == 7) return "Juli";
		else if($bln == 8) return "Agustus";
		else if($bln == 9) return "September";
		else if($bln == 10) return "Oktober";
		else if($bln == 11) return "November";
		else if($bln == 12) return "Desember";
		else return "bulan_sekarang";
	}

	public function index()
	{
		$this->load->view('dashboard');
	}

	public function pelepasan()
	{
		$this->load->view('pelepasan');
	}

	public function splp()
	{
		$kirim['pasal'] = $this->Form_model->get_pasal_splp();
		$this->load->view('splp', $kirim);
	}

	public function submit_splp()
	{
		$juml = $this->Form_model->get_juml_splp_bln(date('m'), date('Y'));
		$juml = $juml->juml + 1;
		$angka = str_pad($juml, 4, '0', STR_PAD_LEFT);
		$romawi = $this->integerToRoman(intval(date('m')));
		$kode_splp = $angka."/WNI/ATKUM/".$romawi."/".date('Y');
		
		$data = array(
			'kode_splp' => $kode_splp, 
			'nama' => $_POST['nama'],
			'jenis_kel' => $_POST['jenis_kel'],
			'id_pasal' => $_POST['pasal'],
			'tempat_lahir' => $_POST['tempat_lahir'],
			'tgl_lahir' => $this->toBulan($_POST['tanggal_lahir']),
			'nama_ibu' => $_POST['nama_ibu'],
			'tempat_lahir_ibu' => $_POST['tempat_lahir_ibu'],
			'tgl_lahir_ibu' => $this->toBulan($_POST['tanggal_lahir_ibu']),
			'kewarganegaraan_ibu' => $_POST['kewarganegaraan_ibu'],
			'alamat_indonesia' => $_POST['alamat_indonesia'],
			'alamat_ln' => $_POST['alamat_ln'],
			'nama_bapak' => $_POST['nama_bapak'],
			'tempat_lahir_bapak' => $_POST['tempat_lahir_bapak'],
			'kewarganegaraan_bapak' => $_POST['kewarganegaraan_bapak'],
			'tgl_lahir_bapak' => $this->toBulan($_POST['tanggal_lahir_bapak']),
			'created_by' => 2
		);
		$id = $this->Form_model->insert_splp($data);
		if($id)
			$kirim['sukses'] = "Atkum SPLP berhasil dibuat";
		else
			$kirim['error'] = "Atkum SPLP gagal dibuat";
		$kirim['pasal'] = $this->Form_model->get_pasal_splp();
		$this->load->view('splp', $kirim);

		if($id)
			$this->print_splp($id);
	}

	public function print_splp($id_splp)
	{
		$splp = $this->Form_model->get_splp_byId($id_splp);
		
		if(!empty($splp))
		{
			$this->load->library('pdf');
			$this->pdf->SetCreator(PDF_CREATOR);
			$this->pdf->SetAuthor('KBRI Kuala Lumpur');
			$this->pdf->SetTitle('SPLP Atkum');
			$this->pdf->SetSubject('Nomor : '.$splp[0]->kode_splp);
			 
			// remove default header/footer
			$this->pdf->setPrintHeader(false);
			$this->pdf->setPrintFooter(false);
			 
			// set default monospaced font
			$this->pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			 
			//set margins
			$this->pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			 
			//set auto page breaks
			$this->pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			 
			//set image scale factor
			$this->pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
			 
			//set some language-dependent strings
			//$this->pdf->setLanguageArray($l);
			 
			// ---------------------------------------------------------
			 
			// set font
			$this->pdf->SetFont('times', '', 12);
			 
			// add a page
			$this->pdf->AddPage();
	 		
	 		if($splp[0]->jenis_kel == 'L')
				$jenis_kel = "Laki-laki";
			else
				$jenis_kel = "Perempuan";

			$pasal = "Pasal 4 huruf b Undang - Undang Nomor 12 Tahun 2006";
			$getpasal = $this->Form_model->get_pasal_splp_byId($splp[0]->id_pasal);
			
			if(!empty($getpasal))
				$pasal = $getpasal[0]->value;

			$atase_hukum = "atase_hukum_sekarang";
			$sekretaris_tituler = "Sekretaris_Tituler_sekarang";

			$getconfig = $this->Form_model->get_config();
			if(!empty($getconfig))
			{
				foreach ($getconfig as $key) 
				{
					if($key->id_config == 1)
						$atase_hukum = $key->value;
					if($key->id_config == 2)
						$sekretaris_tituler = $key->value;
				}
			}
			// set some text to print

$html = '
<div style="text-align: center; font-size:17px;"><b><u>KETERANGAN STATUS KEWARGANEGARAAN REPUBLIK INDONESIA</u><br>
		NO. '.$splp[0]->kode_splp.'</b><br></div>
<div style="text-indent: 50px;">Berdasarkan pemeriksaan data pada berkas permohonan, menerangkan bahwa '.$jenis_kel.', yaitu :</div>

	<div style="text-align: left;">
		<table style="border: none;">
			<tr>
				<td style="white-space: nowrap; vertical-align: top; width:170px;">1. Nama</td>
				<td style="vertical-align: top; width:20px;">:</td>
				<td style="vertical-align: top; width:600px;"><b>'.$splp[0]->nama.'</b></td>
			</tr>
			<tr>
				<td style="white-space: nowrap; vertical-align: top; width:170px;">&nbsp;&nbsp;&nbsp;&nbsp;Tempat, Tanggal Lahir</td>
				<td style="vertical-align: top; width:20px;">:</td>
				<td style="vertical-align: top; width:600px;">'.$splp[0]->tempat_lahir.', '.$splp[0]->tgl_lahir.'</td>
			</tr>
			<tr>
				<td style="white-space: nowrap; vertical-align: top; width:170px;">&nbsp;&nbsp;&nbsp;&nbsp;Jenis Kelamin</td>
				<td style="vertical-align: top; width:20px;">:</td>
				<td style="vertical-align: top; width:600px;">'.$jenis_kel.'</td>
			</tr>
		</table>
	</div>

	<div style="text-align: left; width: 100%; overflow: auto;">
		<table style="border: none;">
			<tr>
				<td style="white-space: nowrap; vertical-align: top; width:170px;">Alamat di Indonesia</td>
				<td style="vertical-align: top; width:20px;">:</td>
				<td style="vertical-align: top; width:600px;">'.$splp[0]->alamat_indonesia.'</td>
			</tr>
			<tr>
				<td style="white-space: nowrap; vertical-align: top; width:170px;">Alamat di Luar Negeri</td>
				<td style="vertical-align: top; width:20px;">:</td>
				<td style="vertical-align: top; width:600px;">'.$splp[0]->alamat_ln.'</td>
			</tr>
		</table>		
	</div>

<b>ORANG TUA</b><br>
<br>
<b>Data Ibu</b>
<div style="text-align: left; width: 100%; overflow: auto;">
	<table style="border: none;">
		<tr>
			<td style="white-space: nowrap; vertical-align: top; width:170px;">Nama</td>
			<td style="vertical-align: top; width:20px;">:</td>
			<td style="vertical-align: top; width:600px;"><b>'.$splp[0]->nama_ibu.'</b></td>
		</tr>
		<tr>
			<td style="white-space: nowrap; vertical-align: top; width:170px;">Tempat, Tanggal Lahir</td>
			<td style="vertical-align: top; width:20px;">:</td>
			<td style="vertical-align: top; width:600px;">'.$splp[0]->tempat_lahir_ibu.', '.$splp[0]->tgl_lahir_ibu.'</td>
		</tr>
		<tr>
			<td style="white-space: nowrap; vertical-align: top; width:170px;">Kewarganegaraan</td>
			<td style="vertical-align: top; width:20px;">:</td>
			<td style="vertical-align: top; width:600px;"><b>'.$splp[0]->kewarganegaraan_ibu.'</b></td>
		</tr>
	</table>
</div>
<br>
<b>Data Ayah</b>
<div style="text-align: left; width: 100%; overflow: auto;">
	<table style="border: none;">
		<tr>
			<td style="white-space: nowrap; vertical-align: top; width:170px;">Nama</td>
			<td style="vertical-align: top; width:20px;">:</td>
			<td style="vertical-align: top; width:600px;"><b>'.$splp[0]->nama_bapak.'</b></td>
		</tr>
		<tr>
			<td style="white-space: nowrap; vertical-align: top; width:170px;">Tempat, Tanggal Lahir</td>
			<td style="vertical-align: top; width:20px;">:</td>
			<td style="vertical-align: top; width:600px;">'.$splp[0]->tempat_lahir_bapak.', '.$splp[0]->tgl_lahir_bapak.'</td>
		</tr>
		<tr>
			<td style="white-space: nowrap; vertical-align: top; width:170px;">Kewarganegaraan</td>
			<td style="vertical-align: top; width:20px;">:</td>
			<td style="vertical-align: top; width:600px;"><b>'.$splp[0]->kewarganegaraan_bapak.'</b></td>
		</tr>
	</table>
</div>

<div style="text-indent: 50px;">adalah Warga Negara Indonesia, <b>berdasarkan '.$pasal.'</b> tentang Kewarganegaraan Republik Indonesia.</div>
<div style="text-indent: 50px;">Apabila di kemudian hari ternyata data tersebut tidak benar / palsu, maka berdasarkan <b>Pasal 28 Undang - Undang Tahun 2006</b> tentang Kewarganegaraan Republik Indonesia, Keterangan Status Kewarganegaraan Republik Indonesia menjadi batal dan tidak berlaku.</div>
<br>
<div style="text-align: right; width: 230px; float: right;">
	Kuala Lumpur, '.ltrim(date('d'), '0').' '.$this->bulan_indonesia(date('m')).' '.date('Y').'<br>
		  A.n Perwakilan R.I<br>
<br>
<br>
<br>
<br>
	  <u><b>'.$atase_hukum.'</b></u><br>
	  	Atase Hukum<br>
</div>';

$this->pdf->writeHTML($html, true, false, true, false, '');
$this->pdf->lastPage();


$this->pdf->AddPage();
$html = '<div style="text-align: center; font-size:17px;"><b><u>Sket No. '.$splp[0]->kode_splp.'</u></b><br></div>
	<br>
	Kedutaan Besar Republik Indonesia dengan ini menerangkan bahwa :
	<br><br>
<b><u>Keterangan Anak</u></b>
	<div style="text-align: left; width: 600px; overflow: auto;">
		<table style="border: none;">
			<tr>
				<td style="white-space: nowrap; vertical-align: top; width:170px;">1. Nama</td>
				<td style="vertical-align: top; width:20px;">:</td>
				<td style="vertical-align: top; width:600px;"><b>'.$splp[0]->nama.'</b></td>
			</tr>
			<tr>
				<td style="width:170px; white-space: nowrap; vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp;Tempat, Tanggal Lahir</td>
				<td style="width:20px; vertical-align: top;">:</td>
				<td style="width:600px; vertical-align: top;">'.$splp[0]->tempat_lahir.', '.$splp[0]->tgl_lahir.'</td>
			</tr>
			<tr>
				<td style="width:170px; white-space: nowrap; vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp;Jenis Kelamin</td>
				<td style="width:20px; vertical-align: top;">:</td>
				<td style="width:600px; vertical-align: top;">'.$jenis_kel.'</td>
			</tr>
		</table>
	</div>

	adalah anak dari orang tua dengan identitas sebagai berikut:<br><br>

<b><u>Keterangan Ibu</u></b>

	<div style="text-align: left; width: 600px; overflow: auto;">
		<table style="border: none;">
			<tr>
				<td style="width:170px; white-space: nowrap; vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp;Nama</td>
				<td style="width:20px; vertical-align: top;">:</td>
				<td style="width:600px; vertical-align: top;"><b>'.$splp[0]->nama_ibu.'</b></td>
			</tr>
			<tr>
				<td style="width:170px; white-space: nowrap; vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp;Tempat, Tanggal Lahir</td>
				<td style="width:20px; vertical-align: top;">:</td>
				<td style="width:600px; vertical-align: top;">'.$splp[0]->tempat_lahir_ibu.', '.$splp[0]->tgl_lahir_ibu.'</td>
			</tr>
		</table>
	</div>

<b><u>Keterangan Bapak</u></b>

	<div style="text-align: left; width: 600px; overflow: auto;">
		<table style="border: none;">
			<tr>
				<td style="width:170px; white-space: nowrap; vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp;Nama</td>
				<td style="width:20px; vertical-align: top;">:</td>
				<td style="width:600px; vertical-align: top;"><b>'.$splp[0]->nama_bapak.'</b></td>
			</tr>
			<tr>
				<td style="width:170px; white-space: nowrap; vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp;Tempat, Tanggal Lahir</td>
				<td style="width:20px; vertical-align: top;">:</td>
				<td style="width:600px; vertical-align: top;">'.$splp[0]->tempat_lahir_bapak.', '.$splp[0]->tgl_lahir_bapak.'</td>
			</tr>
			
		</table>
	</div>


<b><u>Alamat</u></b>

	<div style="text-align: left; width: 600px; overflow: auto;">
		<table style="border: none;">
			<tr>
				<td style="width:170px; white-space: nowrap; vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp;Alamat di Indonesia</td>
				<td style="width:20px; vertical-align: top;">:</td>
				<td style="width:600px; vertical-align: top;">'.$splp[0]->alamat_indonesia.' </td>
			</tr>
			<tr>
				<td style="width:170px; white-space: nowrap; vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp;Alamat di Luar Negeri</td>
				<td style="width:20px; vertical-align: top;">:</td>
				<td style="width:600px; vertical-align: top;">'.$splp[0]->alamat_ln.'</td>
			</tr>
			
		</table>
	</div>


Surat Keterangan ini hanya digunakan sebagai syarat pembuatan Memo Periksa Keluar (COM) untuk kepulangan anak ke Indonesia.
<br>
<br>
<br>
<div style="text-align: right; width: 230px; float: right;">
	Kuala Lumpur, '.ltrim(date('d'), '0').' '.$this->bulan_indonesia(date('m')).' '.date('Y').'<br>
		  A.n Perwakilan R.I<br>
<br>
<br>
<br>
<br>
	  <u><b>'.$sekretaris_tituler.'</b></u><br>
	  	Sekretaris Kedua Tituler<br>
</div>';

$this->pdf->writeHTML($html, true, false, true, false, '');
$this->pdf->lastPage();


$this->pdf->AddPage();
$html = '<div style="text-align:center; font-size:17px;"><b><u>Sket No. '.$splp[0]->kode_splp.'</u></b><br></div><br>
	Kedutaan Besar Republik Indonesia dengan ini menerangkan bahwa :
	<br><br>
<b><u>Keterangan Anak</u></b>

	<div style="text-align: left; width: 600px; overflow: auto;">
		<table style="border: none;">
			<tr>
				<td style="width:170px; white-space: nowrap; vertical-align: top;">1. Nama</td>
				<td style="width:20px; vertical-align: top;">:</td>
				<td style="width:600px; vertical-align: top;"><b>'.$splp[0]->nama.'</b></td>
			</tr>
			<tr>
				<td style="width:170px; white-space: nowrap; vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp;Tempat, Tanggal Lahir</td>
				<td style="width:20px; vertical-align: top;">:</td>
				<td style="width:600px; vertical-align: top;">'.$splp[0]->tempat_lahir.', '.$splp[0]->tgl_lahir.'</td>
			</tr>
			<tr>
				<td style="width:170px; white-space: nowrap; vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp;Jenis Kelamin</td>
				<td style="width:20px; vertical-align: top;">:</td>
				<td style="width:600px; vertical-align: top;">'.$jenis_kel.'</td>
			</tr>
		</table>
	</div>
	
	adalah anak dari orang tua dengan identitas sebagai berikut:<br><br>

<b><u>Keterangan Ibu</u></b>

	<div style="text-align: left; width: 600px; overflow: auto;">
		<table style="border: none;">
			<tr>
				<td style="width:170px; white-space: nowrap; vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp;Nama</td>
				<td style="width:20px; vertical-align: top;">:</td>
				<td style="width:600px; vertical-align: top;"><b>'.$splp[0]->nama_ibu.'</b></td>
			</tr>
			<tr>
				<td style="width:170px; white-space: nowrap; vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp;Tempat, Tanggal Lahir</td>
				<td style="width:20px; vertical-align: top;">:</td>
				<td style="width:600px; vertical-align: top;">'.$splp[0]->tempat_lahir_ibu.', '.$splp[0]->tgl_lahir_ibu.'</td>
			</tr>
		</table>
	</div>

<b><u>Keterangan Bapak</u></b>

	<div style="text-align: left; width: 600px; overflow: auto;">
		<table style="border: none;">
			<tr>
				<td style="width:170px; white-space: nowrap; vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp;Nama</td>
				<td style="width:20px; vertical-align: top;">:</td>
				<td style="width:600px; vertical-align: top;"><b>'.$splp[0]->nama_bapak.'</b></td>
			</tr>
			<tr>
				<td style="width:170px; white-space: nowrap; vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp;Tempat, Tanggal Lahir</td>
				<td style="width:20px; vertical-align: top;">:</td>
				<td style="width:600px; vertical-align: top;">'.$splp[0]->tempat_lahir_bapak.', '.$splp[0]->tgl_lahir_bapak.'</td>
			</tr>
			
		</table>
	</div>


<b><u>Alamat</u></b>

	<div style="text-align: left; width: 600px; overflow: auto;">
		<table style="border: none;">
			<tr>
				<td style="width:170px; white-space: nowrap; vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp;Alamat di Indonesia</td>
				<td style="width:20px; vertical-align: top;">:</td>
				<td style="width:600px; vertical-align: top;">'.$splp[0]->alamat_indonesia.' </td>
			</tr>
			<tr>
				<td style="width:170px; white-space: nowrap; vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp;Alamat di Luar Negeri</td>
				<td style="width:20px; vertical-align: top;">:</td>
				<td style="width:600px; vertical-align: top;">'.$splp[0]->alamat_ln.'</td>
			</tr>
			
		</table>
	</div>


Surat Keterangan ini digunakan untuk pengurusan dokumen kependudukan dan Catatan Sipil di lndonesia. Demikian Surat Keterangan lni dibuat agar dapat digunakan seperlunya. 
<br>
<br>
<br>
<div style="text-align: right; width: 230px; float: right;">
	Kuala Lumpur, '.ltrim(date('d'), '0').' '.$this->bulan_indonesia(date('m')).' '.date('Y').'<br>
		  A.n Perwakilan R.I<br>
<br>
<br>
<br>
<br>
	  <u><b>'.$sekretaris_tituler.'</b></u><br>
	  	Sekretaris Kedua Tituler<br>
</div>';
	
 		$this->pdf->writeHTML($html, true, false, true, false, '');
 		$this->pdf->lastPage();

		// print a block of text using Write()
		/*$this->pdf->Write($h=0, $txt, $link='', $fill=0, $align='C', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);*/
		 
		// ---------------------------------------------------------		
		//Close and output PDF document
		$this->pdf->Output('Berkas_SPLP_Nomor_'.$splp[0]->kode_splp.'.pdf', 'I');
		 
		//============================================================+
		// END OF FILE
		//============================================================+
	}
	}

	public function submit_pelepasan()
	{
		$juml = $this->Form_model->get_juml_pelepasan_bln(date('m'), date('Y'));
		$juml = $juml->juml + 1;
		$angka = str_pad($juml, 4, '0', STR_PAD_LEFT);
		$romawi = $this->integerToRoman(intval(date('m')));
		$kode_pelepasan = $angka."/MWNI.ATKUM/".$romawi."/".date('Y');

		$data = array(
			'kode_pelepasan' => $kode_pelepasan,
			'tipe_surat_sijil' => $_POST['tipe_surat_sijil'],
			'no_surat_sijil' => $_POST['no_surat_sijil'],
			'tgl_surat_sijil' => $this->toBulan($_POST['tgl_surat_sijil']),
			'nama' => $_POST['nama'],
			'no_paspor' => $_POST['no_paspor'],
			'tgl_paspor' => $this->toBulan($_POST['tgl_terbit_paspor']),
			'diterbitkan_oleh' => $_POST['diterbitkan_oleh'],
			'no_telp' => $_POST['no_telp'],
			'tipe_kehilangan_menyerahkan' => $_POST['tipe_kehilangan_menyerahkan'],
			'tempat_lahir' => $_POST['tempat_lahir'],
			'tgl_lahir' => $this->toBulan($_POST['tgl_lahir']),
			'alamat_indonesia' => $_POST['alamat_indonesia'],
			'alamat_malaysia' => $_POST['alamat_malaysia'],
			'no_pengenalan' =>$_POST['no_pengenalan'],
			'alasan' =>$_POST['alasan']
		);
		$id = $this->Form_model->insert_pelepasan($data);

		if($id)
			$kirim['sukses'] = "Atkum Pelepasan WN berhasil dibuat";
		else
			$kirim['error'] = "Atkum Pelepasan WN gagal dibuat";

		$this->load->view('pelepasan', $kirim);

		if($id)
			$this->print_pelepasan($id);
	}

	public function print_pelepasan($id)
	{
		$pelepasan = $this->Form_model->get_pelepasan_byId($id);

		$this->load->library('pdf');
		$this->pdf->SetCreator(PDF_CREATOR);
		$this->pdf->SetAuthor('KBRI Kuala Lumpur');
		$this->pdf->SetTitle('Pelepasan Atkum');
		$this->pdf->SetSubject('Nomor : '.$pelepasan[0]->kode_pelepasan);
		 
		// remove default header/footer
		$this->pdf->setPrintHeader(false);
		$this->pdf->setPrintFooter(false);
		 
		// set default monospaced font
		$this->pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		 
		//set margins
		$this->pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		 
		//set auto page breaks
		$this->pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		 
		//set image scale factor
		$this->pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		 
		//set some language-dependent strings
		//$this->pdf->setLanguageArray($l);
		 
		// ---------------------------------------------------------
		 
		// set font
		$this->pdf->SetFont('times', '', 12);
		 
		// add a page
		$this->pdf->AddPage();

		$atase_hukum = "atase_hukum_sekarang";
		$sekretaris_tituler = "Sekretaris_Tituler_sekarang";

		$getconfig = $this->Form_model->get_config();
		if(!empty($getconfig))
		{
			foreach ($getconfig as $key) 
			{
				if($key->id_config == 1)
					$atase_hukum = $key->value;
				if($key->id_config == 2)
					$sekretaris_tituler = $key->value;
			}
		}
			// set some text to print

		$html = '<div style="text-align: right;">
		REG : <u>'.$pelepasan[0]->kode_pelepasan.'</u>
	</div>
	
		Kepada Yth<br>
		Kepala Perwakilan RI<br>
		Kedutaan Besar Republik Indonesia Kuala Lumpur<br>
	
<p>Dengan hormat,<br>
Bersama dengan ini, saya :
</p>
<br>
	<div style="text-align: left;">
		<table style="border: none;">
			<tr>
				<td style="white-space: nowrap; vertical-align: top; width:270px;">Nama</td>
				<td style="vertical-align: top; width:20px;">:</td>
				<td style="vertical-align: top;">'.$pelepasan[0]->nama.'</td>
			</tr>
			<tr>
				<td style="white-space: nowrap; vertical-align: top; width:270px;">Tempat, Tanggal Lahir</td>
				<td style="vertical-align: top; width:20px;">:</td>
				<td style="vertical-align: top;">'.$pelepasan[0]->tempat_lahir.', '.$pelepasan[0]->tgl_lahir.'</td>
			</tr>
			<tr>
				<td style="white-space: nowrap; vertical-align: top; width:270px;">No. Sijil Warganegara Malaysia</td>
				<td style="vertical-align: top; width:20px;">:</td>
				<td style="vertical-align: top;">'.$pelepasan[0]->no_pengenalan.'</td>
			</tr>
			<tr>
				<td style="white-space: nowrap; vertical-align: top; width:270px;">Alamat di Malaysia</td>
				<td style="vertical-align: top; width:20px;">:</td>
				<td style="vertical-align: top;">'.$pelepasan[0]->alamat_malaysia.'</td>
			</tr>
			<tr>
				<td style="white-space: nowrap; vertical-align: top; width:270px;">Alamat di Indonesia</td>
				<td style="vertical-align: top; width:20px;">:</td>
				<td style="vertical-align: top;">'.$pelepasan[0]->alamat_indonesia.'</td>
			</tr>
			<tr>
				<td style="white-space: nowrap; vertical-align: top; width:270px;">No Telepon</td>
				<td style="vertical-align: top; width:20px;">:</td>
				<td style="vertical-align: top;">'.$pelepasan[0]->no_telp.'</td>
			</tr>
			<tr>
				<td style="white-space: nowrap; vertical-align: top; width:270px;">Alasan Menjadi WN Malaysia</td>
				<td style="vertical-align: top; width:20px;">:</td>
				<td style="vertical-align: top;">'.$pelepasan[0]->alasan.'</td>
			</tr>
		</table>
	</div>
<p>Dengan ini secara sukarela menyerahkan paspor Indonesia milik saya dan melepaskan Kewarganegaraan Indonesia karena telah mendapatkan Kewarganegaraan Malaysia.
	<br><br>
	Demikin Surat Pernyataan ini dibuat dalam keadaan sadar dan sebenar-benarnya. Saya bertanggungjawab atas segala akibat hukum yang terjadi di kemudian hari.
	<br><br>
	Atas perhatian dan kerjasamanya diucapkan terima kasih. <br>
</p>

<div style="text-align: right; width: 230px; float: right;">
	Kuala Lumpur, '.ltrim(date('d'), '0').' '.$this->bulan_indonesia(date('m')).' '.date('Y').'<br>
<br>
<br>
<br>
<br>
	  <u><b>'.$pelepasan[0]->nama.'</b></u><br>
</div>';
		$this->pdf->writeHTML($html, true, false, true, false, '');
 		$this->pdf->lastPage();

 		$this->pdf->AddPage();

 		$pembukaan = '';
 		if($pelepasan[0]->tipe_surat_sijil == 0)
 			$pembukaan = 'Merujuk pada Surat Kewarganegaraan Malaysia dengan Nomor <b>'.$pelepasan[0]->no_surat_sijil.'</b> tanggal '.$pelepasan[0]->tgl_surat_sijil.' bersama ini dengan hormat disampaikan bahwa :';
 		else if($pelepasan[0]->tipe_surat_sijil == 1)
 			$pembukaan = 'Merujuk pada Sijil Kewarganegaraan Malaysia Kementerian Dalam Negeri Malaysia Nomor Bil JPN.KP: '.$pelepasan[0]->no_surat_sijil.' tanggal '.$pelepasan[0]->tgl_surat_sijil.', bersama ini dengan hormat disampaikan bahwa: ';

 		$status_hilang = '';
 		if($pelepasan[0]->tipe_kehilangan_menyerahkan == 0)
 			$status_hilang = 'Adalah benar yang bersangkutan telah menyerahkan kepada Perwakilan RI Kuala Lumpur sebuah PASPOR atas namanya sendiri nomor '.$pelepasan[0]->no_paspor.' yang diterbitkan oleh '.$pelepasan[0]->diterbitkan_oleh.' tanggal '.$pelepasan[0]->tgl_paspor.' karena telah mendapatkan kewarganegaraan Malaysia.';

 		else if($pelepasan[0]->tipe_kehilangan_menyerahkan == 1)
 			$status_hilang = 'Telah melaporkan kehilangan paspor Republik Indonesia dengan menunjukkan fotokopi paspor atas nama <b>'.$pelepasan[0]->nama.', </b>No. Paspor : <b>'.$pelepasan[0]->no_paspor.'</b> yang diterbitkan oleh '.$pelepasan[0]->diterbitkan_oleh.' pada tanggal '.$pelepasan[0]->tgl_paspor.'. Maksud kedatangan saudara <b>'.$pelepasan[0]->nama.'</b> untuk melaporkan bahwa yang bersangkutan telah mendapatkan kewarganegaraan Malaysia.';

$html = '<br><br><div style="text-align: center; font-size:17px; margin-bottom:3px;"><b><u>SURAT KETERANGAN</u></b>
		<div style="font-size:14px;">NOMOR : '.$pelepasan[0]->kode_pelepasan.'</div></div>
<div style="text-indent: 100px;">'.$pembukaan.'</div>
	<div style="text-align: left;">
		<table style="border: none;">
			<tr>
				<td style="width:50px;"></td>
				<td style="white-space: nowrap; vertical-align: top; width:170px;">Nama</td>
				<td style="vertical-align: top; width:20px;">:</td>
				<td style="vertical-align: top;"><b>'.$pelepasan[0]->nama.'</b></td>
			</tr>
			<tr>
				<td style="width:50px;"></td>
				<td style="white-space: nowrap; vertical-align: top; width:170px;">Tempat, Tanggal Lahir</td>
				<td style="vertical-align: top; width:20px;">:</td>
				<td style="vertical-align: top;">'.$pelepasan[0]->tempat_lahir.', '.$pelepasan[0]->tgl_lahir.'</td>
			</tr>
			<tr>
				<td style="width:50px;"></td>
				<td style="white-space: nowrap; vertical-align: top; width:170px;">Nomor Pengenalan/Sijil</td>
				<td style="vertical-align: top; width:20px;">:</td>
				<td style="vertical-align: top;">'.$pelepasan[0]->no_pengenalan.'</td>
			</tr>
		</table>
	</div>
<div style="text-indent:50px; text-align:justify;">'.$status_hilang.'</div>
<div style="text-indent: 50px;">Demikian, untuk dapat digunakan sebagaimana mestinya.</div>
<br>
<br>
<div style="text-align: right; width: 230px; float: right;">
	Kuala Lumpur, '.ltrim(date('d'), '0').' '.$this->bulan_indonesia(date('m')).' '.date('Y').'<br>
		  A.n Perwakilan R.I<br>
<br>
<br>
<br>
<br>
	  <u><b>'.$sekretaris_tituler.'</b></u><br>
	  	Sekretaris Kedua Tituler<br>
</div>
<p>Tembusan:<br>Yth. Duta Besar LBBP Malaysia (Sebagai Laporan)</p>';
		$this->pdf->writeHTML($html, true, false, true, false, '');
 		$this->pdf->lastPage();

		// print a block of text using Write()
		/*$this->pdf->Write($h=0, $txt, $link='', $fill=0, $align='C', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);*/
		 
		// ---------------------------------------------------------		
		//Close and output PDF document
		$this->pdf->Output('Berkas_Pelepasan_WNI_Nomor_'.$pelepasan[0]->kode_pelepasan.'.pdf', 'I');
		 
		//============================================================+
		// END OF FILE
		//============================================================+
	}

	public function upload()
	{
		$this->load->view('upload');
	}

	public function upload_berkas()
	{
		$configu['upload_path']          = './berkas/';
		$configu['allowed_types']        = 'pdf';
		$configu['max_size']             = 20000;
 
		$this->load->library('upload', $configu);

 		$ext = strtolower(pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION));
		if($ext != "pdf")
		{
			$kirim['error'] = "File harus berupa pdf.";
		}
		else
		{
			if ( ! $this->upload->do_upload('files')){
				$kirim['error'] = $this->upload->display_errors();
			}else{
				$uploaded_file = $this->upload->data();

				$data = array(
					'no_berkas' => $_POST['no_berkas'],
					'tipe_berkas' => $_POST['tipe_berkas'],
					'path_berkas' => $uploaded_file['file_name']
					);
				if($this->Form_model->insert_berkas($data))
					$kirim['sukses'] = "Berkas berhasil tersimpan.";	
				else
					$kirim['error'] = "Berkas gagal tersimpan.";
			}
		}

		$this->load->view('upload',$kirim);
	}

	public function cari_berkas()
	{
		$this->load->view('search');
	}

	public function search()
	{
		$get = $this->Form_model->get_berkas_byNomor($_POST['no_berkas'], $_POST['tipe_berkas']);
		if(empty($get))
			$kirim['error'] = "Berkas tidak bisa ditemukan. Mohon cek kembali penulisan nomor berkas dan tipe berkas.";
		else
		{
			$kirim['result'] = $get[0];
			$kirim['sukses'] = "Kami menemukan berkas yang anda cari.";
		}
		$this->load->view('search',$kirim);
	}
}	



