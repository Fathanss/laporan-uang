<?php
header('Content-type: application/json');

require_once '../controller/LaporanUangController.php';

$laporanUang = new LaporanUangController();
echo json_encode($laporanUang->create($_GET));
die();
