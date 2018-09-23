<center>
<?php
  session_start();
  echo "berhasil <br>";
  echo "Selamat datang <b>".$_SESSION['nama']."&nbsp";
  echo "<a href='index.php'><button type='button' name='button' style='background-color:red'>Log Out</button></a><br>";

?>

<form method="post" enctype="multipart/form-data">
  Tambahkan Gambar: <input type="file" name="gambar">
  <input type="submit" name="submit">
</form>
<br>
<?php
  $koneksi = mysqli_connect('localhost','root','','aplikasi_album');
  $id = $_SESSION['id'];

if (isset($_GET['id'])) {
  $id_foto = $_GET['id'];
  mysqli_query($koneksi, "DELETE FROM foto WHERE id_foto = '$id_foto' ");
  // $hapus = mysqli_query($koneksi, "SELECT * FROM foto WHERE id_foto = '$id' ");
  // $hapus_file = mysqli_fetchrow($hapus);
  //unlink($foto['1']);
  header("Location: hal_utama.php");
}


if (isset($_POST['submit'])) {

  //$file_name = $_FILES['gambar']['name'];
  $tmp_name = $_FILES['gambar']['tmp_name'];
  $file_name = "gambar/".$_FILES['gambar']['name'];
  $is_success = move_uploaded_file($tmp_name, $file_name);
  if(!$is_success) echo "Gagal";

  mysqli_query($koneksi, "INSERT INTO foto (foto, id_akun) VALUES ('$file_name', '$id') ");
}

  $gambar = mysqli_query($koneksi, "SELECT * FROM foto WHERE id_akun = '$id' ORDER BY id_foto DESC");


  $count = 0;
  echo "<table width='900px' ";
  echo "<tr>";
  while($row=mysqli_fetch_row($gambar)){
    echo "<td><img src='".$row['1']."' width='300px'>";
    echo "<br><a href='edit.php?id=".$row['0']."'>Edit</a>&nbsp&nbsp<a href='hal_utama.php?id=".$row['0']."'>Hapus</a>";
    echo "</td>";
    $count++;
    if ($count==3) {
      echo "<tr></tr>";
      $count = 0;
    }
  }
  echo "</tr>";
  echo "</table>";


?>
</center>
