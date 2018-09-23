<?php

  $koneksi = mysqli_connect('localhost','root','','aplikasi_album');

  $id = $_GET['id'];
  $preview = mysqli_query($koneksi, "SELECT * FROM foto WHERE id_foto= '$id' ");
  $foto = mysqli_fetch_row($preview);
  echo "Preview : <img src='".$foto['1']."' width='240px'>";
  //unlink($foto['1']);
?>

<form method="post" enctype="multipart/form-data">
  Unggah Gambar: <input type="file" name="gambar">
  <input type="submit" name="submit" value="Edit">
</form>

<?php
  if (isset($_POST['submit'])) {
    $file_name = $_FILES['gambar']['name'];
    $tmp_name = $_FILES['gambar']['tmp_name'];

    $new_pict = "gambar/".$file_name;
    $is_success = move_uploaded_file($tmp_name, $new_pict);
    if(!$is_success) echo "Gagal";

    mysqli_query($koneksi, "UPDATE foto SET foto = '$new_pict' where id_foto = $id");

    header("Location: hal_utama.php");
  }
?>
<br>
<a href="hal_utama.php">back</a>
