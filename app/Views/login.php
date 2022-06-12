<?php

    if ($isLogin)
    {
        ?>
            <script>
                window.location = './';
            </script>
        <?php
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <base href='<?php echo base_url(); ?>'>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- bootstrap cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">

    <!-- jQuery cdn link -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="icon" href="img/logo.png" type="img/x-icon">


</head>

<body>
    <?= $header ?>
    <section class="left-section">
        <div style="margin-bottom: 50px;"></div>
        <div id="left-cover" class="cover cover-hide">
            <img src="img/treem.png" alt="">
            <h1>Chào Mừng Bạn Đến</h1>
            <h3>CỔNG THÔNG TIN TIÊM CHỦNG COVID-19</h3>
            <button type="button" class="switch-btn" onclick="location.reload()">Đăng Nhập</button>
        </div>

        <div id="left-form" class="form fade-in-element">
            <form>
                 <h1 class="text-center">Đăng Nhập</h1>
                <input type="text" id="login-user-name" class="input-box" placeholder="Nhập tài khoản...">
                <input type="password" id="login-user-pass" class="input-box" placeholder="Nhập mật khẩu...">
                <input type="button" id="login-btn" class="btn" value="Đăng Nhập">
            </form>
        </div>
    </section>

    <section class="right-section">

        <div id="right-cover" class="cover fade-in-element">
            <img src="img/treem.png" alt="">
            <h1>Chào Mừng Bạn Đến</h1>
            <h3>CỔNG THÔNG TIN TIÊM CHỦNG COVID-19</h3>
            <button type="button" class="switch-btn" onclick="switchSignup()">Đăng Ký</button>
        </div>

        <div style="margin-bottom: 1000px;"></div>
        <div id="right-form" class="form form-hide">

           
            <form>
                 <h1 class="text-center">Đăng Ký Tài Khoản</h1>
                <input type="text" id="user-name" class="input-box" placeholder="Nhập tài khoản...">
                <input type="email" id="user-email" class="input-box" placeholder="Nhập Emaill...">
                <input type="password" id="user-pass" class="input-box" placeholder="Nhập mật khẩu...">
                <input type="button" id="signup-btn" class="btn" value="Đăng Ký">
            </form>
        </div>

    </section>

    <script src="js/main.js"></script>

</body>

</html>