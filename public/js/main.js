var left_cover = document.getElementById("left-cover");
var left_form = document.getElementById("left-form");

var right_cover = document.getElementById("right-cover");
var right_form = document.getElementById("right-form");

function switchSignup() {
    right_form.classList.add("fade-in-element");
    left_cover.classList.add("fade-in-element");

    left_form.classList.add("form-hide");
    left_cover.classList.remove("cover-hide");
    right_cover.classList.add("cover-hide");
    right_form.classList.remove("form-hide");
}

$(document).ready(function () {
    $('#signup-btn').click(function () { 
        let user = $('#user-name').val();
        let email = $('#user-email').val();
        let pass = $('#user-pass').val();

        let data = {
            'user' : user,
            'pass' : pass,
            'email' : email
        };

        $.post("./api/register", data,
            function (data, textStatus, jqXHR) {
                let json = JSON.parse(data);
                if (json['status'])
                {
                    alert(json['message']);
                    window.location = './';
                }
                else 
                {
                    alert(json['message']);
                }
            }
        );
    });

    $('#login-btn').click(function () { 
        let user = $('#login-user-name').val();
        let pass = $('#login-user-pass').val();

        let data = {
            'user' : user,
            'pass' : pass
        };

        $.post("./api/login", data,
            function (data, textStatus, jqXHR) {
                let json = JSON.parse(data);
                if (json['status'])
                {
                    alert(json['message']);
                    window.location = './';
                }
                else 
                {
                    alert(json['message']);
                }
            }
        );
    });

    $('#btn-registration').click(function () { 
        let name = $('#fullname').val();
        let cccd = $('#cccd').val();
        let birthday = $('#birthday').val();
        let gender = $("input[name='gender']:checked").val();
        let injection_times = $('#muitiem').val();
        let vaccine_id = $('#vaccine').val();
        let place_id = $('#address').val();
        let registration_date = $('#date').val();

        let data = {
            'name' : name,
            'cccd' : cccd,
            'birthday' : birthday,
            'gender' : gender,
            'injection_times' : injection_times,
            'vaccine_id' : vaccine_id,
            'place_id' : place_id,
            'registration_date' : registration_date,
        };


        $.post("./api/registration", data,
            function (data, textStatus, jqXHR) {
                let json = JSON.parse(data);
                if (json['status'])
                {
                    alert(json['message']);
                    window.location = './';
                }
                else 
                {
                    alert(json['message']);
                }
            }
        );
    });

    $('#btn-search-vaccine').click(function () { 
        let cccd = $('#cccd').val();

        let data = {
            'cccd' : cccd,
        };


        $.post("./api/search", data,
            function (data, textStatus, jqXHR) {
                let json = JSON.parse(data);
                if (json['status'])
                {
                    $('.not-found').css('display', 'none');
                    $('#tb-vaccine').css('display', 'block');
                    let html = "";
                    json['data'].forEach(item => {
                        html += "<tr><td>"+item['name']+"</td><td>"+item['cccd']+"</td><td>"+item['birthday']+"</td><td>"+(item['gender'] == "1" ? 'Nam' : 'Nữ')+"</td><td>"+item['injection_times']+"</td><td>"+item['name_vaccine']+"</td><td>"+item['address']+"</td><td>"+item['registration_date']+"</td><td>"+(item['confirm'] == "1" ? "Đã tiêm" : "Chưa tiêm")+"</td></tr>";
                    });
                    $('#data-vaccine').html(html);
                    alert(json['message']);
                }
                else 
                {
                    $('.not-found').css('display', 'block');
                    $('#tb-vaccine').css('display', 'none');
                    alert(json['message']);
                }
            }
        );
    });
});