<!DOCTYPE html>
<html>
<head>
    <title>Admin Quản Lý Vaccine</title>

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

     <h1>Quản Lý Vaccine</h1>
     <div align="right">
        <button type="button" id="add_button" data-toggle="modal" data-target="#vaccineModel" class="btn btn-success">Thêm Vaccine</button>
        </div>
    </br>
        <table id="course_table" class="table table-striped table-bordered">
            <thead bgcolor="#6cd8dc">
                <tr class="table-primary">
                    <th width="30%">Id</th>
                    <th width="50%">Tên Vaccine</th>
                    <th width="30%">Quốc Gia</th>
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

<div id="vaccineModel" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="vaccine_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Thêm Vaccine</h4>
                </div>
                <div class="modal-body">
                    <label>Tên Vaccine</label>
                    <input type="text" name="name_vaccine" id="name_vaccine" class="form-control"/><br>
                    <label>Quốc Gia</label>
                    <input type="text" name="quoc_gia" id="quoc_gia" class="form-control"/><br>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="vaccine_id" id="vaccine_id"/>
                    <input type="hidden" name="operation" id="operation"/>
                    <input type="submit" name="action" id="action" class="btn btn-primary" value="Add" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    function loadList() {
        $.ajax({url: "/admin/vaccine/list", success: function(result){
            
            const data =  JSON.parse(result);
            var body = ""; 
            data.data.forEach(element => {
                body += '<tr>' + 
                '<td>' + element.id + '</td>'
                + '<td>'+ element.name_vaccine + '</td>'
                + '<td>' + element.quoc_gia + '</td>'
                + '<td><a href="javascript:void(0)" onclick="editVaccine(' +  element.id + ')"> Sửa</a> </td>'
                + '<td><a href="javascript:void(0)" onclick="deleteVaccine(' +  element.id + ')"> Xóa</a> </td>'
                + '</tr>';
            });
            $('#course_table tbody').html(body);
        }}); 
    }

    function editVaccine(id) {
        $('#add_button').trigger('click');
        $('.modal-title').text("Sửa Vaccine ");
        $('#action').val("Lưu");
        $('#operation').val("update");

        $.ajax({url: "/admin/vaccine/get-by-id?id=" + id,
            success: function(result){
            
            const data =  JSON.parse(result);
            const vaccine = data.data[0];

            $('#vaccineModel #vaccine_id').val(vaccine.id);
            $('#vaccineModel #quoc_gia').val(vaccine.quoc_gia);
            $('#vaccineModel #name_vaccine').val(vaccine.name_vaccine);

        }});
    }

    function deleteVaccine(id) {
        $.ajax({
            url: "/admin/vaccine/delete",
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
            $('#vaccine_form')[0].reset();
            $('.modal-title').text("Thêm Vaccine ");
            $('#action').val("Add");
            $('#operation').val("add")
        });

        $(document).on('submit', '#vaccine_form', function(event){
            event.preventDefault();
            var id = $('#id').val();
            var course = $('#course').val();
            var students = $('#students').val();

            if(course != '' && students != '')
            {
                $.ajax({
                    url:"/admin/vaccine/save",
                    method:'POST',
                    data: new FormData(this),
                    contentType:false,
                    processData:false,
                    success:function(data)
                    {
                        $('#vaccine_form')[0].reset();
                        $('#vaccineModel').modal('hide');
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
      