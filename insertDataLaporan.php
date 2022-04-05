<?php 
require_once 'database/configDB.php';


function insertDataLaporan ($nama, $jurusan, $nim, $nomor, $tanggal, $alamat){
    $type = "**Laporan Baru Kasus Covid-19**";
    $apiToken = "5104627636:AAFYK_9jCOkproO7dtRN4VP-4hx1TtaItN0";
    $time = strtotime($tanggal);
    if(empty($time))
    {
    $message = "Pelaporan Gagal, Silahkan Cek Kembali";
    }
    else{
    $date = date('Y-m-d',$time);
    $queryInsertCatatan = "INSERT INTO laporan_covid (nama, jurusan, nim, alamat, nomor_hp, tanggal_pelaporan) VALUES ('$nama', '$jurusan', '$nim', '$alamat', '$nomor', '$date')";
    $resultQueryInsert  = mysqli_query(connDB(), $queryInsertCatatan);
    if ($resultQueryInsert) {
    	$message = "**Pelaporan Kasus Covid-19 Berhasil**\n\n". $nama . "\n" . $jurusan. "\n" . $nim. "\n" . $nomor. "\n" . $tanggal. "\n" . $alamat;
    	
    	$data = [
            'chat_id' => '-797192102', 
            'text' => $type
        ];
           $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) . "%0A". "%0A" . "+" . $nama . "%0A" . "+" . $jurusan . "%0A" . "+". $nim . "%0A" . "+". $nomor . "%0A" . "+". $date . "%0A" . "+". $alamat );
    }
    else{
    	$message = "Pelaporan Gagal, Silahkan Cek Kembali";
    }
    
    }
    
    return $message;
}

?>