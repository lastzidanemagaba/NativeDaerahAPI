<?php 
include 'koneksi.php';

$data = $_POST['data'];
$id = $_POST['id'];

$n=strlen($id);
$m=($n==2?5:($n==5?8:13));
// $wil=($n==2?'Kota/Kab':($n==5?'Kecamatan':'Desa/Kelurahan'));
?>
<?php 
if($data == "kabupaten"){
	?>
	Kabupaten/Kota
	<select id="form_kab">
		<option value="">Pilih Kabupaten/Kota</option>
		<?php 
		$daerah = mysqli_query($koneksi,"SELECT kode,nama FROM wilayah_2020 WHERE LEFT(kode,'$n')='$id' AND CHAR_LENGTH(kode)=$m ORDER BY nama");

		while($d = mysqli_fetch_array($daerah)){
			?>
			<option value="<?php echo $d['kode']; ?>"><?php echo $d['nama']; ?></option>
			<?php 
		}
		?>
	</select>

	<?php 
}else if($data == "kecamatan"){ 
	?>
	<select id="form_kec">
		<option value="">Pilih Kecamatan</option>
		<?php 
		$daerah = mysqli_query($koneksi,"SELECT kode,nama FROM wilayah_2020 WHERE LEFT(kode,'$n')='$id' AND CHAR_LENGTH(kode)=$m ORDER BY nama");

		while($d = mysqli_fetch_array($daerah)){
			?>
			<option value="<?php echo $d['kode']; ?>"><?php echo $d['nama']; ?></option>
			<?php 
		}
		?>
	</select>

	<?php 
}else if($data == "desa"){ 
	?>
	<select id="form_kel">
		<option value="">Pilih Provinsi</option>
		<?php 
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, "http://localhost/FixAPI/DaftarDaerah.php?kode=");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch); 
		$data =  json_decode($output);
		if (count($data->data)) {
			foreach ($data->data as $idx => $data) {
				$kodex = $data->kode;
				$namax = $data->nama;
				$dart = strlen($kodex);
				//echo $data->nama;
				if($dart == 2)
				{
			?>
			<option value="<?php echo $kodex; ?>"><?php echo $namax; ?></option>
			<?php 
		}
	}
}

		?>
	</select>
		
	<?php 
		
}
?>