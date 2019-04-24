<?php
include_once('../koneksi.php');
include_once('../db_function/funct_org.php');

header('Content-type: application/json');
$returnData = array();
$result = viewOrgData();

$data = array();
foreach ($result as $key => $value) {
  $data[] = $value;
}

$returnData = array('status' => TRUE , 'data' => $data);

echo json_encode($returnData);
