<?php 
    session_start();
    include "koneksi.php"; 

    if (isset($_POST['signup'])) {
        $query = "INSERT INTO tbl_pelanggan (username, password, email, dob, gender, address, city, phone, paypal) 
                  VALUES ('$_POST[username]', '$_POST[password]', '$_POST[email]', '$_POST[dob]', '$_POST[gender]', 
                          '$_POST[address]', '$_POST[city]', '$_POST[phone]', '$_POST[paypal]')";
        $exec = mysqli_query($db, $query);

        echo "<script type='text/javascript'>swal('Selamat', 'Anda Sudah Terdaftar', 'success');</script>";
        echo "<meta http-equiv='refresh' content='1;url=login.php'>";
    }
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="assets/img/icon/favicon.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        body {
            color: #fff;
            background: #19aa8d;
            font-family: 'Source Sans Pro', sans-serif;
            background: url(assets/img/bg-login-customer.jpg) no-repeat center center fixed;
            background-size: cover;
        }

        .form-control,
        .form-control:focus,
        .input-group-addon {
            border-color: #e1e1e1;
        }

        .form-control,
        .btn {
            border-radius: 5px;
        }

        .signup-form {
            width: 450px;
            margin: 0 auto;
            padding: 30px 0;
        }

        .signup-form form {
            color: #999;
            border-radius: 3px;
            margin-bottom: 15px;
            background: #fff;
            background-color: rgba(0, 0, 0, 0.8);
            padding-top: 30px;
            padding-left: 30px;
            padding-right: 30px;
            padding-bottom: 1px;
        }

        .signup-form h2 {
            color: white;
            font-weight: bold;
            margin-top: 0;
            text-align: center;
        }

        .signup-form p {
            text-align: center;
        }

        .signup-form hr {
            border: 1px solid #3498db;
        }

        .signup-form .form-group {
            margin-bottom: 20px;
        }

        .signup-form label {
            font-weight: normal;
            font-size: 13px;
        }

        .signup-form .form-control {
            min-height: 38px;
            box-shadow: none !important;
            background-color: rgba(105, 105, 105, 0.6);
            color: white;
            border: none;
        }

        .signup-form .input-group-addon {
            max-width: 42px;
            text-align: center;
            color: white;
            background-color: #3498db;
            border: none;
        }

        .signup-form .btn {
            font-size: 16px;
            font-weight: bold;
            background: #3498db;
            border: none;
            width: 100%;
        }

        .signup-form .btn:hover,
        .signup-form .btn:focus {
            background: #0e6caa;
            outline: none;
        }

        .down {
            margin-top: 30px;
        }
    </style>
    <title>Sign Up</title>
</head>

<body>
    <div class="signup-form">
    <form action="" method="post">
    <h2>Form Registrasi</h2>
    <p>Please fill in this form to create an account!</p>
    <hr>
    
    <!-- Field Nama Lengkap -->
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap" required="required">
        </div>
    </div>

    <!-- Field Username -->
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input type="text" class="form-control" name="username" id="username" placeholder="Username" required="required">
        </div>
    </div>

    <!-- Field Email -->
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-paper-plane"></i></span>
            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required="required">
        </div>
    </div>

    <!-- Field Password -->
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required="required">
        </div>
    </div>

    <!-- Field Retype Password -->
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
            <input type="password" class="form-control" name="retype_password" id="retype_password" placeholder="Retype Password" required="required">
        </div>
    </div>

    <!-- Field Date of Birth -->
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" required="required">
        </div>
    </div>

    <!-- Field Gender -->
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
            <select class="form-control" name="gender" id="gender" required="required">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>
    </div>

    <!-- Field Address -->
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-home"></i></span>
            <input type="text" class="form-control" name="address" id="address" placeholder="Address" required="required">
        </div>
    </div>

    <!-- Field City -->
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-building"></i></span>
            <input type="text" class="form-control" name="city" id="city" placeholder="City" required="required">
        </div>
    </div>

    <!-- Field No. HP -->
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
            <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No. HP" required="required">
        </div>
    </div>

    <!-- Field PayPal ID -->
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-paypal"></i></span>
            <input type="text" class="form-control" name="paypal_id" id="paypal_id" placeholder="PayPal ID" required="required">
        </div>
    </div>

    <!-- Terms of Use -->
    <div class="form-group">
        <label class="checkbox-inline"><input type="checkbox" required="required"> I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
    </div>

    <!-- Submit Button -->
    <button class="btn btn-success btn-lg" name="signup" id="submit">Sign Up</button>
    <div class="form-group text-right down">
        <label class="checkbox-inline">Already have an account? <a href="login.php">Log In</a></label>
    </div>
</form>

    </div>

    <?php
    if (isset($_POST['signup'])) {
        $query = "INSERT INTO tbl_pelanggan (username, password, email, dob, gender, address, city, phone, paypal) 
                  VALUES ('$_POST[username]', '$_POST[password]', '$_POST[email]', '$_POST[dob]', '$_POST[gender]', 
                          '$_POST[address]', '$_POST[city]', '$_POST[phone]', '$_POST[paypal]')";
        $exec = mysqli_query($db, $query);

        echo "<script type='text/javascript'>swal('Selamat', 'Anda Sudah Terdaftar', 'success');</script>";
        echo "<meta http-equiv='refresh' content='1;url=login.php'>";
    }
    ?>
</body>

</html>
