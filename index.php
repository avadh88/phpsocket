<?php
require_once __DIR__.'/vendor/autoload.php';
use \ebl\TcpSocketConnection;

$data = new TcpSocketConnection('0.0.0.0',45123);
$data->socketWrite('Hello Server');
// echo $data->SocketConnect();
