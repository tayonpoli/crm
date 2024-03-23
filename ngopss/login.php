 <!-- Eksekusi Form Login -->
 <?php 
 include 'koneksi.php';
 session_start();
      if(isset($_SESSION['login_user'])) {
        header("location: index.php");
      }
 
        if(isset($_POST['login'])) {
          $user = $_POST['email'];
          $password = $_POST['password'];
        $password = md5($password);

          // Query untuk memilih tabel
          $cek_data = mysqli_query($koneksi, "SELECT * FROM users WHERE email = '$user' AND password = '$password'");
          $hasil = mysqli_fetch_array($cek_data);
          $status = $hasil['user_type'];
          $login_user = $hasil['id'];
          $row = mysqli_num_rows($cek_data);

          // Pengecekan Kondisi Login Berhasil/Tidak
            if ($row > 0) {
                session_start();   
                $_SESSION['login_user'] = $login_user;

                if ($status == 'admin') {
                  header('location: admin/index.php');
                }elseif ($status == 'user') {
                  header('location: index.php'); 
                }
            }else{
                echo "<script>
                alert('Incorrect email or password!');
                document.location='login.php';
                </script>";
            }
        }

        if(isset($_POST['register'])) {
            $username=$_POST["username"];
            $email=$_POST["emaill"];
            $password=$_POST["pass"];
            $password = md5($password);//untuk password digunakan enskripsi md5

            //Menginput data ke tabel
            $hasil=mysqli_query($koneksi, "INSERT INTO users (name,email, password) VALUES('$username','$email','$password')");

            //Kondisi apakah berhasil atau tidak
            if ($hasil) 
            {
                echo "<script>
                            alert('You are Registered Sucessfully !');
                            document.location='login.php';
                    </script>";
            }
            else 
            {
                echo "<script>
                            alert('Your registration is fail');
                            document.location='login.php';
                    </script>";
            }
          }
       ?>
    </div>
  <!-- Akhir Eksekusi Form Login -->
<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- ===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="login.css">
         
    <title>Login & Registration Form</title> 
</head>
<body>
    
    <div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Login</span>

                <form action="" method="POST">
                    <div class="input-field">
                        <input type="text" name="email" placeholder="Enter your email" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password" class="password" placeholder="Enter your password" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>

                    <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" id="logCheck">
                            <label for="logCheck" class="text">Remember me</label>
                        </div>
                        
                        <a href="#" class="text">Forgot password?</a>
                    </div>

                    <div class="input-field button">
                        <input type="submit" name="login" value="Login">
                    </div>
                </form>

                <div class="login-signup">
                    <span class="text">Not a member?
                        <a href="#" class="text signup-link">Signup Now</a>
                    </span>
                </div>
            </div>

            <!-- Registration Form -->
            <div class="form signup">
                <span class="title">Registration</span>

                <form action="" method="POST">
                    <div class="input-field">
                        <input type="text" name="username" placeholder="Enter your name" required>
                        <i class="uil uil-user"></i>
                    </div>
                    <div class="input-field">
                        <input type="text" name="emaill" placeholder="Enter your email" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" name="pass" class="password" placeholder="Create a password" required>
                        <i class="uil uil-lock icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" class="password" name="passc" placeholder="Confirm a password" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>

                    <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" id="termCon">
                            <label for="termCon" class="text">I accepted all terms and conditions</label>
                        </div>
                    </div>

                    <div class="input-field button">
                        <input type="submit" name="register" value="Signup">
                    </div>
                </form>

                <div class="login-signup">
                    <span class="text">Already a member?
                        <a href="#" class="text login-link">Login Now</a>
                    </span>
                </div>
            </div>
        </div>
    </div>

     <script src="login.js"></script> 
</body>
</html>