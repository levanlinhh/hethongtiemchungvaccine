<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên Hệ</title>
     <!-- bootstrap Lib -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- datatable lib -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
   <link rel="icon" href="img/logo.png" type="img/x-icon">
</head>
<body>
<?= $header ?>

<section class="contact" id="contact">

   <h1 class="heading">LIÊN HỆ BÁC SĨ</h1>

   <form action="col-md-12 jumbotron bg-light" method="get">
      
      <span>Họ tên:</span>
      <input type="text" name="name" placeholder="Nhập tên..." class="box" required>
      <span>Email :</span>
      <input type="email" name="email" placeholder="Nhập email..." class="box" required>
      <span>Số điện thoại:</span>
      <input type="text" name="text" placeholder="Nhập số điện thoại..." class="box" required>
      <span>Ngày liên hệ :</span>
      <input type="date" name="date" class="box" required>
      <input her="win.php" type="submit" value="Gửi" name="submit" class="link-btn">
   </form>  
   <div style="margin-bottom: 50px;"></div>
</section>
</body>
</html>