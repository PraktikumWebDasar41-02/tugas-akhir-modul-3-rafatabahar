<b>Form Registrasi</b><br>
<form method="post" enctype="multipart/form-data">
  Nama Lengkap: <input type="text" name="name"><br>
  Username: <input type="text" name="username"><br>
  Password: <input type="password" name="pass"><br>
  <input type="submit" name="submit"><br>
</form>
<br>
<a href="index.php">Back</a>

<?php
  $koneksi = mysqli_connect('localhost','root','','aplikasi_album');

  if (isset($_POST['submit'])) {
    $nama = $_POST['name'];
    $usernm = $_POST['username'];
    $pass = md5($_POST['pass']);
    
    $res = mysqli_query($koneksi, "INSERT INTO akun (nama, username, password) VALUES ('$nama','$usernm', '$pass')");

    if($res){
      header("Location: index.php");
    }else{
      echo "Gagal";
    }
  }
?>
