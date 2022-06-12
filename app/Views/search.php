<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng ký tiêm</title>

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

    <script src="js/main.js"></script>
</head>

<body>
    <?= $header ?>
    
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <section>
        <div style="margin-bottom: 50px;"></div>
        <div class="wrapper">
            <div class="container">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <h1 class="text-center text-uppercase">Tra cứu thông tin</h1>
                            <form class="col-md-13 jumbotron bg-light">
                                <div class="from-group">
                                    <label for="cccd">CCCD/CMND</label>
                                    <input type="text" id="cccd" class="form-control">
                                </div>
                            <input type="button" id="btn-search-vaccine" class="btn-primary btn btn-block" value="Tìm">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="data-result container">
            <div class="not-found">Không tìm thấy thông tin</div>
            <table class="table table-striped table-bordered" id="tb-vaccine">
                <thead>
                    <tr>
                        <th>Họ và tên</th>
                        <th>CCCD/CMND</th>
                        <th>Ngày sinh</th>
                        <th>Giới tính</th>
                        <th>Lần tiêm</th>
                        <th>Tên Vaccine</th>
                        <th>Địa điểm</th>
                        <th>Ngày tiêm</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody id="data-vaccine">
                   
                </tbody>
            </table>
        </div>
    </section>




</body>

</html>