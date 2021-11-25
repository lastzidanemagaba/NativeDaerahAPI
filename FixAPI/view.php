<?php
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, "http://localhost/FixAPI/mahasiswa.php?kode=");
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
            echo( $data->kode ."<br>");
            echo( $data->nama ."<br>");
        }
        
    }
}
?>