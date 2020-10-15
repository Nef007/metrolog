/*
    Авторизация
 */

$(".login-btn").click(function(e) {
    e.preventDefault();

    $(`input`).removeClass("error");

    let login = $('input[name="login"]').val(),
        password = $('input[name="password"]').val();

    $.ajax({
        url: "vendor/signin.php",
        type: "POST",
        dataType: "json",
        data: {
            login: login,
            password: password,
        },
        success(data) {
            if (data.status && data.access == 1) {
                document.location.href = "/admin.php";
            } else if (data.status && data.access == 0) {
                document.location.href = "/profile.php";
            } else {
                if (data.type === 1) {
                    data.fields.forEach(function(field) {
                        $(`input[name="${field}"]`).addClass("error");
                    });
                }

                $(".msg").removeClass("none").text(data.message);
            }
        },
    });
});

/*
    Получение аватарки с поля
 */

let avatar = false;

$('input[name="avatar"]').change(function(e) {
    avatar = e.target.files[0];
});