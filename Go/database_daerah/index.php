<!DOCTYPE html>
<html>
<head>
	<title>Daerah</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
</head>
<body>
	<?php 
		
	include 'koneksi.php';
	?>

	<style type="text/css">
		body{
			font-family: "Roboto";
		}
	</style>



	<select id="form_prov">
		<option value="">Pilih Kelurahan</option>
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
				if($dart == 13)
				{
			?>
			<option value="<?php echo $kodex; ?>"><?php echo $namax; ?></option>
			<?php 
		}
	}
}

		?>
	</select>

	<select id="form_kab"></select>

	<select id="form_kec"></select>
		
	<select id="form_des"></select>


	<script type="text/javascript">
		$(document).ready(function(){

			// sembunyikan form kabupaten, kecamatan dan desa
			$("#form_kab").hide();
			$("#form_kec").hide();
			$("#form_des").hide();

			// ambil data kabupaten ketika data memilih provinsi
			$('body').on("change","#form_prov",function(){
				var id = $(this).val();
				var text = id;
				var myArray = text.split(".");
				var hasilx = myArray[0];
				var data = "id="+hasilx+"&data=kabupaten";
				$.ajax({
					type: 'POST',
					url: "get_daerah.php",
					data: data,
					success: function(hasil) {
						$("#form_kab").html(hasil);
						$("#form_kab").show();
						$("#form_kec").hide();
						$("#form_des").hide();
					}
				});
			});

			// ambil data kecamatan/kota ketika data memilih kabupaten
			$('body').on("change","#form_kab",function(){
				var id = $(this).val();
				var data = "id="+id+"&data=kecamatan";
				$.ajax({
					type: 'POST',
					url: "get_daerah.php",
					data: data,
					success: function(hasil) {
						$("#form_kec").html(hasil);
						$("#form_kec").show();
						$("#form_des").hide();
					}
				});
			});

			// ambil data desa ketika data memilih kecamatan/kota
			$('body').on("change","#form_kec",function(){
				var id = $(this).val();
				var data = "id="+id+"&data=desa";
				$.ajax({
					type: 'POST',
					url: "get_daerah.php",
					data: data,
					success: function(hasil) {
						$("#form_des").html(hasil);
						$("#form_des").show();
					}
				});
			});


		});
	</script>
</body>
</html>