<?php 
 require 'connectDB.php';
  if (isset($_POST['lapor'])) {
    $type = "**Laporan Baru Penyintas Covid-19**";
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $nama = $fname.' '.$lname;
    $hp = $_POST['hp'];
    $alamat = $_POST['alamat'];
    $tanggal = $_POST['tanggal'];
      $sql = "INSERT INTO penyintas ( nama, no_hp, alamat, tanggal_sembuh) VALUES (? ,?, ?, ?)";
      $result = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($result, $sql)) {
        echo "SQL_Error_input_saran";
        exit();
      }
      else{
        mysqli_stmt_bind_param($result, "ssss", $nama, $hp, $alamat, $tanggal);
        mysqli_stmt_execute($result);
      }
      $apiToken = "5104627636:AAFYK_9jCOkproO7dtRN4VP-4hx1TtaItN0";
      $data = [
            'chat_id' => '-797192102', 
            'text' => $type
        ];
        $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) . "%0A". "%0A" . "+" . $nama . "%0A" . "+" . $tanggal . "%0A" . "+". $hp . "%0A" . "+". $alamat );
  }
?>