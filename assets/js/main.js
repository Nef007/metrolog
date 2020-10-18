/*
    Авторизация
 */

$(".login-btn").click(function (e) {
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
          data.fields.forEach(function (field) {
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

let pasport = false;

$('input[name="pasport"]').change(function (e) {
  pasport = e.target.files[0];
});

// функция гифки крутящейся
function funcBefore() {
  $(".msg").removeClass("none").text("");
  $(".gifload").removeClass("none");
}

// добавление устройства

$(".add-btn").click(function (e) {
  e.preventDefault();

  $(`input`).removeClass("error");

  let name = $('input[name="name"]').val(),
    marka = $('input[name="marka"]').val(),
    zav_number = $('input[name="zav_number"]').val(),
    dev_data_release = $('input[name="dev_data_release"]').val();
  dev_data_pred_poverki = $('input[name="dev_data_pred_poverki"]').val();
  dev_data_poverki = $('input[name="dev_data_poverki"]').val();

  let formData = new FormData();
  formData.append("name", name);
  formData.append("marka", marka);
  formData.append("zav_number", zav_number);
  formData.append("pasport", pasport);
  formData.append("dev_data_release", dev_data_release);
  formData.append("dev_data_pred_poverki", dev_data_pred_poverki);
  formData.append("dev_data_poverki", dev_data_poverki);

  $.ajax({
    url: "bd/add.php",
    type: "POST",
    dataType: "json",
    processData: false,
    contentType: false,
    beforeSend: funcBefore,
    cache: false,
    data: formData,
    success(data) {
      if (data.status) {
        $(".gifload").addClass("none");
        $(".msg").removeClass("none").text(data.message);
        document.location.href = "../profile.php";
      } else {
        if (data.type === 1) {
          data.fields.forEach(function (field) {
            $(`input[name="${field}"]`).addClass("error");
          });
        }
        $(".gifload").addClass("none");
        $(".msg").removeClass("none").text(data.message);
      }
    },
  });
});

// выборка усройств
$(".select-btn").click(function (e) {
  e.preventDefault();

 

  $(`input`).removeClass("error");

  let name = $('input[name="name2"]').val(),
    marka = $('input[name="marka2"]').val(),
    zav_number = $('input[name="zav_number2"]').val(),
    dev_data_release = $('input[name="dev_data_release2"]').val();
  dev_data_pred_poverki = $('input[name="dev_data_pred_poverki2"]').val();
  dev_data_poverki = $('input[name="dev_data_poverki2"]').val();

  let formData = new FormData();
  formData.append("name", name);
  formData.append("marka", marka);
  formData.append("zav_number", zav_number);
  formData.append("dev_data_release", dev_data_release);
  formData.append("dev_data_pred_poverki", dev_data_pred_poverki);
  formData.append("dev_data_poverki", dev_data_poverki);

  $.ajax({
    url: "bd/select.php",
    type: "POST",
    dataType: "json",
    processData: false,
    contentType: false,
    beforeSend: funcBefore,
    cache: false,
    data: formData,
    success(data) {
      if (data.status) {
        $(".gifload").addClass("none");
        $(".msg").removeClass("none").text(data.message);
       // $(".popup-select-btn").addClass("select-color");

        document.location.href = "../profile.php";
      } else {
        if (data.type === 1) {
          data.fields.forEach(function (field) {
            $(`input[name="${field}"]`).addClass("error");
          });
        }
        $(".gifload").addClass("none");
        $(".msg").removeClass("none").text(data.message);
      }
    },
  });
});