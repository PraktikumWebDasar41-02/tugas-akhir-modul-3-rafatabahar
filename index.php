<b>Form Login</b><br>
<form action="index.php" method="post" enctype="multipart/form-data">
  Username: <input type="text" name="username"><br>
  Password: <input type="password" name="pass"><br>
  <input type="submit" name="submit"><br>
</form>

<a href="regis.php">Belum Memiliki akun</a>

<?php
  $koneksi = mysqli_connect('localhost','root','','aplikasi_album');
  //if (!$koneksi) die("Connection failed: " . mysqli_connect_error());

  if (isset($_POST['submit'])) {
    $usernm = $_POST['username'];
    $pass = md5($_POST['pass']);

    $result = mysqli_query($koneksi, "SELECT * FROM akun WHERE username = '$usernm' AND password = '$pass' ");

    while ($row=mysqli_fetch_row($result)) {
        session_start();
        $_SESSION['nama'] = $row['1'];
        $_SESSION['id'] = $row['0'];
        header("Location: hal_utama.php");
    }

    echo "Username atau Password tidak sesuai";


  }


?>
