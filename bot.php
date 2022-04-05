<?php

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Telegram\TelegramDriver;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Attachments\Video;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use BotMan\Drivers\Telegram\Extensions\Keyboard;
use BotMan\Drivers\Telegram\Extensions\KeyboardButton;

require_once 'vendor/autoload.php';
require_once 'database/configDB.php';

$configs = [
    "telegram" => [
        "token" => file_get_contents("private/token.txt")
    ]
];

DriverManager::loadDriver(TelegramDriver::class);

$botman = BotManFactory::create($configs); 
// Keyboard


// Command no @ to bot
$botman->hears("/start", function (BotMan $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $lastname = $user->getLastName();
    $id_user = $user->getId();

    $bot->reply("Selamat Datang $firstname $lastname (ID:$id_user), pada Bot MBKM SPI 4.\n \nKetikkan /help untuk mengetahui perintah yang terdapat pada Bot");
    include "command/requestChat.php";
});

$botman->hears("/help", function (Botman $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();
    
    include "command/requestChat.php";

    $bot->reply("1. /Data_presensi : Untuk melihat data presensi \n\n2. /Data_covid : Untuk melihat data laporan Covid-19 \n\n3. /Data_penyintas : Untuk melihat data penyintas Covid-19 \n\n4. /Saran : Untuk melihat saran \n\n5. /Pelaporan_covid : Untuk melaporkan kasus Covid-19 \n\n6. /Pelaporan_penyintas : Untuk melaporkan penyintas Covid-19 ");

});

$botman->hears("/Saran", function (Botman $bot) {
    include "command/requestChat.php";
    $message = "https://bit.ly/MBKMSPI4Saran";
    $bot->reply($message);

});

$botman->hears("/Data_penyintas", function (Botman $bot) {
    include "command/requestChat.php";
    $message = "https://bit.ly/MBKMSPI4Penyintas";
    $bot->reply($message);

});

$botman->hears("/Data_covid", function (Botman $bot) {
    include "command/requestChat.php";
    $message = "https://bit.ly/MBKMSPI4Laporan";
    $bot->reply($message);

});

$botman->hears("/Data_presensi", function (Botman $bot) {
    include "command/requestChat.php";
    $message = "https://bit.ly/PresensiMBKMSPI4";
    $bot->reply($message);

});


$botman->hears("/Pelaporan_covid", function (BotMan $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();

    include "command/requestChat.php";
    $bot->reply("Format pelaporan kasus Covid-19 :\n\n/Lapor_covid Nama Lengkap-Jurusan-Nim-Nomor HP-Tanggal Terinfeksi (Bln/Tgl/Tahun)-Alamat\n");
});

$botman->hears("/Lapor_covid {nama}-{jurusan}-{nim}-{nomor}-{tanggal}-{alamat}", function (Botman $bot, $nama, $jurusan, $nim, $nomor, $tanggal, $alamat) {
    $user = $bot->getUser();
    $id_user = $user->getId();
    $nama = $nama;
    $jurusan = $jurusan;
    $nim = $nim;
    $nomor = $nomor;
    $tanggal = $tanggal;
    $alamat = $alamat;
    
    include "command/requestChat.php";
    include "command/insertDataLaporan.php";

    $message = insertDataLaporan($nama, $jurusan, $nim, $nomor ,$tanggal, $alamat);
    $bot->reply($message);

});

$botman->hears("/Pelaporan_penyintas", function (BotMan $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();

    include "command/requestChat.php";
    $bot->reply("Format pelaporan penyintas Covid-19 :\n\n/Lapor_penyintas Nama Lengkap-Nomor HP-Tanggal Sembuh (Bln/Tgl/Tahun)-Alamat");
});

$botman->hears("/Lapor_penyintas {nama}-{nomor}-{tanggal}-{alamat}", function (Botman $bot, $nama, $nomor,$tanggal, $alamat) {
    $user = $bot->getUser();
    $id_user = $user->getId();
    $nama = $nama;
    $nomor = $nomor;
    $tanggal = $tanggal;
    $alamat = $alamat;
    
    include "command/requestChat.php";
    include "command/insertDataPenyintas.php";

    $message = insertDataPenyintas($nama, $nomor, $tanggal, $alamat);
    $bot->reply($message);

});

// ------------------------------------------------------------pembatas---------------------------------------------------------- 
// @

$botman->hears("/start@mbkmspi4_bot", function (BotMan $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $lastname = $user->getLastName();
    $id_user = $user->getId();

    $bot->reply("Selamat Datang $firstname $lastname (ID:$id_user), pada Bot MBKM SPI 4.\n \nKetikkan /help untuk mengetahui perintah yang terdapat pada Bot");
    include "command/requestChat.php";
});

$botman->hears("/help@mbkmspi4_bot", function (Botman $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();
    
    include "command/requestChat.php";

    $bot->reply("1. /Data_presensi : Untuk melihat data presensi \n\n2. /Data_covid : Untuk melihat data laporan Covid-19 \n\n3. /Data_penyintas : Untuk melihat data penyintas Covid-19 \n\n4. /Saran : Untuk melihat saran \n\n5. /Pelaporan_covid : Untuk melaporkan kasus Covid-19 \n\n6. /Pelaporan_penyintas : Untuk melaporkan penyintas Covid-19 ");

});

$botman->hears("/Saran@mbkmspi4_bot", function (Botman $bot) {
    include "command/requestChat.php";
    $message = "https://bit.ly/MBKMSPI4Saran";
    $bot->reply($message);

});

$botman->hears("/Data_penyintas@mbkmspi4_bot", function (Botman $bot) {
    include "command/requestChat.php";
    $message = "https://bit.ly/MBKMSPI4Penyintas";
    $bot->reply($message);

});

$botman->hears("/Data_covid@mbkmspi4_bot", function (Botman $bot) {
    include "command/requestChat.php";
    $message = "https://bit.ly/MBKMSPI4Laporan";
    $bot->reply($message);

});

$botman->hears("/Data_presensi@mbkmspi4_bot", function (Botman $bot) {
    include "command/requestChat.php";
    $message = "https://bit.ly/AbsensiMBKMSPI4";
    $bot->reply($message);

});


$botman->hears("/Pelaporan_covid@mbkmspi4_bot", function (BotMan $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();

    include "command/requestChat.php";
    $bot->reply("Format pelaporan kasus Covid-19 :\n\n/Lapor_covid Nama Lengkap-Jurusan-Nim-Nomor HP-Tanggal Terinfeksi (Bln/Tgl/Tahun)-Alamat\n");
});


$botman->hears("/Pelaporan_penyintas@mbkmspi4_bot", function (BotMan $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $id_user = $user->getId();

    include "command/requestChat.php";
    $bot->reply("Format pelaporan penyintas Covid-19 :\n\n/Lapor_penyintas Nama Lengkap-Nomor HP-Tanggal Sembuh (Bln/Tgl/Tahun)-Alamat");
});

// command not found

$botman->listen();