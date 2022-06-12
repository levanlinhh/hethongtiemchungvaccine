<!DOCTYPE html>
<html>
<head>
    <title>Admin Quản Lý Địa Điểm Tiêm</title>

    <!-- bootstrap Lib -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- datatable lib -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style type="text/css">
        .content{
            max-width: 800px;
            margin: auto;
        }

        h1{
            text-align: center;
            padding-bottom: 60px;
        }
    </style>

</head>
<body>
<div class="content">

     <h1>Quản Lý Địa Điểm Tiêm</h1>
     <div align="right">
        <button type="button" id="add_button" data-toggle="modal" data-target="#addressModel" class="btn btn-success">Thêm Địa Điểm Tiêm</button>
        </div>
    </br>
        <table id="address_table" class="table table-striped table-bordered">
            <thead bgcolor="#6cd8dc">
                <tr class="table-primary">
                    <th width="30%">Id</th>
                    <th width="50%">Tên Địa Điểm</th>
                    <th scope="col" width="5%">Sửa</th>
                    <th scope="col" width="5%">Xóa</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        
       
</div>
</body>
</html>

<div id="addressModel" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="address_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Thêm Địa Điểm Tiêm</h4>
                </div>
                <div class="modal-body">
                    <label>Tên Địa Điểm Tiêm</label>
                    <input type="text" name="address" id="address" class="form-control"/><br>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="address_id" id="address_id"/>
                    <input type="hidden" name="operation" id="operation"/>
                    <input type="submit" name="action" id="action" class="btn btn-primary" value="Thêm" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    function loadList() {
        $.ajax({url: "/admin/address/list", success: function(result){
            
            const data =  JSON.parse(result);
            var body = ""; 
            data.data.forEach(element => {
                body += '<tr>' + 
                '<td>' + element.id + '</td>'
                + '<td>'+ element.address + '</td>'
                + '<td><a href="javascript:void(0)" onclick="editAddress(' +  element.id + ')"> Sửa</a> </td>'
                + '<td><a href="javascript:void(0)" onclick="deleteAddress(' +  element.id + ')"> Xóa</a> </td>'
                + '</tr>';
            });
            $('#address_table tbody').html(body);
        }}); 
    }

    function editAddress(id) {
        $('#add_button').trigger('click');
        $('.modal-title').text("Sửa Địa Điểm ");
        $('#action').val("Lưu");
        $('#operation').val("update");

        $.ajax({url: "/admin/address/get-by-id?id=" + id,
            success: function(result){
            
            const data =  JSON.parse(result);
            const address = data.data[0];
            console.log(address);
            $('#addressModel #address_id').val(address.id);
            $('#addressModel #address').val(address.address);
            
        }});
    }

    function deleteAddress(id) {
        $.ajax({
            url: "/admin/address/delete",
            method:'POST',
            data:{ id },
            dataType: "json",
            success: function(result) {
                if (result.data) {
                    loadList();
                } else {
                    alert(result.message);
                }
            }
        });
    }

    $(document).ready(function(){
        loadList();
      
        $('#add_button').click(function() {
            $('#address_form')[0].reset();
            $('.modal-title').text("Thêm Dia Diem ");
            $('#action').val("Add");
            $('#operation').val("add")
        });

        $(document).on('submit', '#address_form', function(event){
            event.preventDefault();
            var address= $('#address').val();

            if(address != '')
            {
                $.ajax({
                    url:"/admin/address/save",
                    method:'POST',
                    data: new FormData(this),
                    contentType:false,
                    processData:false,
                    success:function(data)
                    {
                        $('#address_form')[0].reset();
                        $('#addressModel').modal('hide');
                        loadList();
                    }
                });
            }
            else
            {
                alert("Vui lòng nhập đầy đủ thông tin");
            }
        });
    });
</script>
      