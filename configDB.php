<?php 

function connDB() {
   $dbServer = '217.21.74.95';
   $dbUser = 'u743710388_user';
   $dbPass = 'Rachmatte28';
   $dbName = "u743710388_bottelegram";
   $conn = mysqli_connect($dbServer, $dbUser, $dbPass);

   if(!$conn) {
         die('Koneksi gagal: ' . mysqli_error());
   }
   mysqli_select_db($conn, $dbName);
   return $conn;
}

?>