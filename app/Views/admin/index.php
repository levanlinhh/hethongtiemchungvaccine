<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Địa Điểm Tiêm</title>
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
   
    <div class="navigation">
            
            <ul>
            <div style="margin-bottom: 20px;"></div>
                <li>
                    <a href="./admin/index">
                        <span class="icon"></span>
                        <span class="title">Trang Chủ</span>
                    </a>
                </li>
                <div style="margin-bottom: 20px;"></div>
                <li>
                    <a href="./admin/account">
                        <span class="icon"><i class="fa-solid fa-bed"></i></span>
                        <span class="title">Quản lý người tiêm</span>
                    </a>
                </li>
                <div style="margin-bottom: 20px;"></div>
                <li>
                    <a href="/admin/vaccine">
                        <span class="icon"><i class="fa fa-home" aria-hiden="true"></i></span>
                        <span class="title">Quản Quản lý vaccine</span>
                    </a>
                </li>
                <div style="margin-bottom: 20px;"></div>
                <li>
                    <a href="/admin/address">
                        <span class="icon"></span>
                        <span class="title">Quản lý địa điểm tiêm</span>
                    </a>
                </li>
                <div style="margin-bottom: 20px;"></div>
                <li>
                    <a href="#">
                        <span class="icon"></span>
                        <span class="title">Thống kê</span>
                    </a>
                </li>

            </ul>
        </div>
  
    </body>
</html>
</html>