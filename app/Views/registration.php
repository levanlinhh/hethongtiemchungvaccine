<?php
    if (!$isLogin) {
    ?>
        <script>
            alert('Vui lòng đăng nhập và thực hiện lại');
            window.location = './login';
        </script>
    <?php
    }
?>

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
                            <h1 class="text-center text-uppercase">Nhập thông tin người tiêm</h1>
                            <form method="gest" class="col-md-12 jumbotron bg-light">
                                <div class="form-group">
                                    <div class="from-group">
                                        <label for="fullname">Họ và tên</label>
                                        <input type="text" name="fullname" id="fullname" class="form-control">
                                    </div>
                                    <div style="margin-bottom: 20px;"></div>
                                    <div class="form-group">
                                        <div class="from-group">
                                            <label for="cccd">Số CCCD/CMND</label>
                                            <input type="text" name="cccd" id="cccd" class="form-control">
                                        </div>
                                        <div style="margin-bottom: 20px;"></div>

                                        <div class="form-group">
                                            <div class="from-group">
                                                <label for="birthday">Ngày sinh</label>
                                                <input type="date" name="birthday" id="birthday" class="form-control">
                                            </div>
                                            <div style="margin-bottom: 20px;"></div>
                                            <div class="form-group">
                                                <div class="from-group">
                                                    <label for="muitiem">Mũi tiêm thứ</label>
                                                    <input type="number" name="muitiem" id="muitiem" class="form-control">
                                                </div>
                                                <div style="margin-bottom: 20px;"></div>
                                                <div class="form-group">
                                                    <div class="from-group">
                                                        <label for="vaccine">Loại Vaccine</label>
                                                        <select name="vaccine" id="vaccine" class="form-control">
                                                            <?php foreach ($listVaccine as $item): ?>
                                                                <option value="<?= $item['id'] ?>"><?= $item['name_vaccine'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div style="margin-bottom: 20px;"></div>
                                                    <div class="form-group">
                                                        <div class="from-group">
                                                            <label for="address">Địa chỉ</label>
                                                            <select name="address" id="address" class="form-control">
                                                                <?php foreach ($listPlace as $item): ?>
                                                                    <option value="<?= $item['id'] ?>"><?= $item['address'] ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div style="margin-bottom: 20px;"></div>
                                                        <div class="form-group">
                                                            <div class="from-group">
                                                                <label for="date">Ngày đăng ký tiêm</label>
                                                                <input type="date" name="date" id="date" class="form-control">
                                                            </div>
                                                            <div style="margin-bottom: 20px;"></div>
                                                            <div class="from-group">
                                                                <label for="gender">Giới tính</label>
                                                                <div>
                                                                    <div class="from-check form-check-inline">
                                                                        <input type="radio" name="gender" id="male" value="1" class="form-check-input">
                                                                        <label for="male" class="form-check-label">Nam</label>
                                                                    </div>

                                                                    <div class="from-check form-check-inline">
                                                                        <input type="radio" name="gender" id="famale" value="0" class="form-check-input">
                                                                        <label for="male" class="form-check-label">Nữ</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div style="margin-bottom: 20px;"></div>
                                                            <input type="button" id="btn-registration" class="btn-primary btn btn-block" value="Đăng ký">

                                                        </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




</body>

</html>