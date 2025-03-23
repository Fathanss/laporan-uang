<?php
header('Content-type: application/json');

require_once '../controller/PPDBController.php';

$ppdb = new PPDBController();
echo json_encode($ppdb->delete($_POST));
die();


