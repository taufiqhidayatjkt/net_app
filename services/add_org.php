<?php
include_once('../koneksi.php');
include_once('../db_function/funct_org.php');

$nama = filter_input(INPUT_GET,'nama');
header('Content-type: application/json');
$returnData = array();
if (isset($nama) && trim($nama) != '' ) {
  addOrgData($nama);
  $returnData = array('status' => TRUE , 'msg' => 'Data telah ditambahkan' );
}else {
  $returnData = array('status' => FALSE , 'msg' => 'empty data' );
}

echo json_encode($returnData);
