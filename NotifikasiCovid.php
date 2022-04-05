<?php 
  require 'connectDB.php';
  date_default_timezone_set(Asia/Jakarta);
  $date= date("Y-m-d");
  $type = "**Laporan Baru Kasus Covid-19**";
  if (isset($_POST['lapor'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $nama = $fname.' '.$lname;
    $jurusan = $_POST['jurusan'];
    $nim = $_POST['nim'];
    $hp = $_POST['hp'];
    $tanggal = $_POST['tanggal'];
    $alamat = $_POST['alamat'];
      $sql = "INSERT INTO laporan_covid ( nama, jurusan, nim, alamat, nomor_hp, tanggal_pelaporan) VALUES (? ,?, ?, ?, ?, ?)";
      $result = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($result, $sql)) {
        echo "SQL_Error_input_saran";
        exit();
      }
      else{
        mysqli_stmt_bind_param($result, "ssssss", $nama, $jurusan, $nim, $alamat, $hp, $tanggal);
        mysqli_stmt_execute($result);
        include "bottelegram/command/laporan.php";
      }
     $apiToken = "5104627636:AAFYK_9jCOkproO7dtRN4VP-4hx1TtaItN0";
    	$data = [
            'chat_id' => '-797192102', 
            'text' => $type
        ];
           $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) . "%0A". "%0A" . "+" . $nama . "%0A" . "+" . $jurusan . "%0A" . "+". $nim . "%0A" . "+". $hp . "%0A" . "+". $tanggal . "%0A" . "+". $alamat );
  }
  
?>