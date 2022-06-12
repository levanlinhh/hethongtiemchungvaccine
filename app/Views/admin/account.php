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
    <link rel="stylesheet" href="/css/style.css">
    <link rel="icon" href="img/logo.png" type="img/x-icon">
</head>
<body>
<?= $header ?>
    <div style="margin-bottom: 10px;"></div>
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
    <table class="table table-striped table-bordered" >
        <h1 class="text-center">Danh sách người đăng ký tiêm</h1>
        <div style="margin-top: 30px;"></div>
                    <thead>
                        <tr>
                            <th style="white-space: nowrap;">Họ và tên</th>
                            <th style="white-space: nowrap;">CCCD/CMND</th>
                            <th style="white-space: nowrap;">Ngày sinh</th>
                            <th style="white-space: nowrap;">Giới tính</th>
                            <th style="white-space: nowrap;">Lần tiêm</th>
                            <th style="white-space: nowrap;">Tên Vaccine</th>
                            <th style="white-space: nowrap;">Địa điểm</th>
                            <th style="white-space: nowrap;">Ngày tiêm</th>
                            <th style="white-space: nowrap;">Lựa Chọn</th>

                        </tr>
                    </thead>
                    <tbody>
                            
                    </tbody>
                    
    </table>
    <script>    
            function changeConfirm(self, id) {
                console
                $.ajax({
                    url: "/admin/confirm",
                    method:'POST',
                    data:{ id, confirm: self.value },
                    dataType: "json",
                    success: function(result) {
                        if (result.data) {

                        } else {
                            alert(result.message);
                        }
                    }
                });
            }

            $(document).ready(function() {
                $.ajax({url: "/admin/api/list_people", success: function(result){
        
                    const data =  JSON.parse(result);
                    var body = ""; 
                    data.data.forEach(element => {
                        body += '<tr>' + 
                        '<td>' + element.name + '</td>' + 
                        '<td>'+ element.cccd + '</td>' + 
                        '<td>' + element.birthday + '</td>' +
                        '<td>' + (element.gender? 'Nam' : 'Nữ')+'</td>' +
                        '<td>' + element.injection_times +'</td>'+ 
                        '<td>' + element.name_vaccine+'</td>' +
                        '<td>' + element.address +'</td>' +
                        '<td>' + element.registration_date + '</td>' + 
                        '<td>'+ '<select name="confirm" onchange="changeConfirm(this, ' + element.id + ')"><option value="0" ' + (element.confirm == 0 ? 'selected' : '')+ '>Chưa tiêm</option><option value="1" ' + (element.confirm == 1 ? 'selected' : '')+ '>Đã tiêm</option></select>'+'</td>' + 
                        '</tr>';
                    });
                    $('table tbody').html(body);
                }}); 

                
            });
            
    </script>
</body>
</html>
