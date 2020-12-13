<html>

<head>
    <title>Inventory Lab System</title>

    <!-- Login Form Style CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/styleForm.css">

    <!-- Style CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/style1.css">

    <!-- Font CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/font.css">

    <link rel="icon" href="assets/img/logo2.png" type="image/x-icon"/>
</head>

<body>

    
    
    <!-- Sing in  Form -->
    <section class="sign-in ptop">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="assets/img/logo.png"></figure>
                </div>

                <div class="signin-form font1">
                    <h2 class="form-title font1"><b>LOGIN</b></h2>
                    <form method="POST" class="register-form">
                        <div class="form-group">
                            <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="inputEmail" placeholder="Email"/>
                        </div>
                        <div class="form-group">
                            <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="inputPassword" placeholder="Password"/>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signin" id="signin" class="form-submit" value="LOG IN"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</body>
<?php
    include('connect.php');

    if(isset($_POST['signin']))
    {
        $email = $_POST['inputEmail'];
        $password = $_POST['inputPassword'];

        $query = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE email = '$email' AND kata_sandi = '$password' " );

        $check = mysqli_num_rows($query);

        if($check == "1")
        {
            //Ambil Nama Pengguna
            $queryAmbilNama = mysqli_query($koneksi, "SELECT nama_lengkap FROM pengguna WHERE email = '$email' " );
            $NamaPengguna = mysqli_fetch_assoc($queryAmbilNama);
            $hasil  = $NamaPengguna['nama_lengkap'];

            //Ambil ID Pengguna
            $queryAmbilID = mysqli_query($koneksi, "SELECT id_pengguna FROM pengguna WHERE email = '$email' " );
            $IDPengguna = mysqli_fetch_assoc($queryAmbilID);
            $hasil2  = $IDPengguna['id_pengguna'];

            //Ambil Status Pengguna

            $queryAmbilStatus = mysqli_query($koneksi, 
            "SELECT nama_status FROM status
            JOIN detail_pengguna ON
            status.id_status = detail_pengguna.id_status 
            JOIN pengguna ON
            detail_pengguna.id_pengguna = pengguna.id_pengguna
            WHERE email = '$email' " );
            $StatusPengguna = mysqli_fetch_assoc($queryAmbilStatus);
            $hasil3  = $StatusPengguna['nama_status'];

            SESSION_START();
            $_SESSION['myname'] = $hasil;
            $_SESSION['myid'] = $hasil2;
            $_SESSION['mystatus'] = $hasil3;

            if($hasil3 == "User")
            {
                header('location:assets/Admin/layout205.php');    
            }
            else
            {
            header('location:assets/Admin/dashboard.php');
        }
        }
        else  if($email == "" && $password == "" )
        {
            echo "<script>";
            echo "alert('Please Fill Email and Password')";
            echo "</script>";
        }
        else
        {
            echo "<script>";
            echo "alert('Email or Password Incorrect')";
            echo "</script>";
        }
  }
?>
</html>