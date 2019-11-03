<?php
$ini = parse_ini_file(__DIR__ ."/../system-configuration.ini");

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'bsVersion' => '4.x',
    'instansi' => $ini['instansi'],
    'nama_sistem' => $ini['nama_sistem'],
    'url_instansi' => $ini['url_instansi'],
    'author' => $ini['author'],
    'url_author' => $ini['url_author'],
    'maps_api'=>$ini['google_maps'],

];
