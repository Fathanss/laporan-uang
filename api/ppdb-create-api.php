<?php
header('Content-type: application/json');

require_once '../controller/PPDBController.php';

$ppdb = new PPDBController();
echo json_encode($ppdb->create($_POST));
die();