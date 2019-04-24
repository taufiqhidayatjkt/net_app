<?php
include_once("koneksi.php");
$mn = filter_input(INPUT_GET,'mn');
?>
<!DOCTYPE html>
<html>
  <head>
      <title>Website Pelatihan Native Enterprise</title>
      <script type="text/javascript" src="jquery-3.3.1.js"></script>
      <link rel="stylesheet" href="styles/bootstrap-3.3.6/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="styles/bootstrap-3.3.6/dist/css/bootstrap-theme.min.css">
      <link rel="stylesheet" type="text/css" href="styles/DataTables/datatables.min.css"/>
      <script src="styles/bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="styles/DataTables/datatables.min.js"></script>

      <link rel="stylesheet" href="styles/style.css">

  </head>
  <body>
  <div class="page">
    <div class="content">
    <nav>
        <a href="?mn=home" <?=((!isset($mn) || (isset($mn) && $mn=='home') ) ? 'style="background:brown;"' : '');?>>Home</a>
        <a href="?mn=org" <?=((isset($mn) && $mn=='org') ? 'style="background:brown;"' : '');?>>Organisasi</a>
        <a href="?mn=pns" <?=((isset($mn) && $mn=='pns') ? 'style="background:brown;"' : '');?>>Pegawai</a>
        <a href="?mn=about" <?=((isset($mn) && $mn=='about') ? 'style="background:brown;"' : '');?>>About</a>
    </nav>
    <main>
    <?php
      $menu = filter_input(INPUT_GET,'mn');
      switch ($menu) {
        case 'home':
          // code...
          include_once('home.php');
          break;
        case 'org':
          // code...
          include_once('manage_org.php');
          break;
        case 'pns':
          // code...
          include_once('manage_pegawai.php');
          break;
        case 'about':
          // code...
          include_once('about.php');
          break;

        default:
          // code...
          echo "Selamat Datang... ";
          break;
      }
    ?>
   </main>
   <footer>created by. opick</footer>
  </div>
  </div>
  </body>
</html>

<script>
$(document).ready(function() {
    $('#example').DataTable();
} );

function delOrgData(id){
  var txt;
  var r = confirm("Apakah anda yakin menghapus data ini?");
  if (r == true) {
    window.location= "index.php?mn=org&act=del&id="+id;
  }
}
function delPegawaiData(id){
  var txt;
  var r = confirm("Apakah anda yakin menghapus data ini?");
  if (r == true) {
    window.location= "index.php?mn=pns&act=del&id="+id;
  }
}

</script>
