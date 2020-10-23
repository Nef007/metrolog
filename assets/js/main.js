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

// добавление устройства пользователь

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

// добавление устройства admin

$(".add-btn-adm").click(function (e) {
  e.preventDefault();

  $(`input`).removeClass("error");

  let name = $('input[name="name"]').val(),
    marka = $('input[name="marka"]').val(),
    zav_number = $('input[name="zav_number"]').val(),
    dist_id = $('select[name="dist_id"]').val(),
    dev_data_release = $('input[name="dev_data_release"]').val();
  dev_data_pred_poverki = $('input[name="dev_data_pred_poverki"]').val();
  dev_data_poverki = $('input[name="dev_data_poverki"]').val();

  let formData = new FormData();

  formData.append("dist_id", dist_id);
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

        document.location.href = "../admin.php";
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

// выборка усройств пользователь
$(".select-btn").click(function (e) {
  e.preventDefault();

  $(`input`).removeClass("error");

  let name = $('input[name="name2"]').val(),
    marka = $('input[name="marka2"]').val(),
    zav_number = $('input[name="zav_number2"]').val(),
    dev_data_release_start = $('input[name="dev_data_release2_start"]').val();
  dev_data_release_end = $('input[name="dev_data_release2_end"]').val();
  dev_data_pred_poverki_start = $(
    'input[name="dev_data_pred_poverki2_start"]'
  ).val();
  dev_data_pred_poverki_end = $(
    'input[name="dev_data_pred_poverki2_end"]'
  ).val();
  dev_data_poverki_start = $('input[name="dev_data_poverki2_start"]').val();
  dev_data_poverki_end = $('input[name="dev_data_poverki2_end"]').val();

  let formData = new FormData();
  formData.append("name", name);
  formData.append("marka", marka);
  formData.append("zav_number", zav_number);
  formData.append("dev_data_release_start", dev_data_release_start);
  formData.append("dev_data_release_end", dev_data_release_end);
  formData.append("dev_data_pred_poverki_start", dev_data_pred_poverki_start);
  formData.append("dev_data_pred_poverki_end", dev_data_pred_poverki_end);
  formData.append("dev_data_poverki_start", dev_data_poverki_start);
  formData.append("dev_data_poverki_end", dev_data_poverki_end);

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

// выборка усройств админ
$(".select-btn-adm").click(function (e) {
  e.preventDefault();

  $(`input`).removeClass("error");

  let name = $('input[name="name2"]').val(),
    marka = $('input[name="marka2"]').val(),
    distr_name = $('input[name="distr_name"]').val(),
    zav_number = $('input[name="zav_number2"]').val(),
    dev_data_release_start = $('input[name="dev_data_release2_start"]').val();
  dev_data_release_end = $('input[name="dev_data_release2_end"]').val();
  dev_data_pred_poverki_start = $(
    'input[name="dev_data_pred_poverki2_start"]'
  ).val();
  dev_data_pred_poverki_end = $(
    'input[name="dev_data_pred_poverki2_end"]'
  ).val();
  dev_data_poverki_start = $('input[name="dev_data_poverki2_start"]').val();
  dev_data_poverki_end = $('input[name="dev_data_poverki2_end"]').val();

  let formData = new FormData();
  formData.append("name", name);
  formData.append("marka", marka);
  formData.append("distr_name", distr_name);
  formData.append("zav_number", zav_number);
  formData.append("dev_data_release_start", dev_data_release_start);
  formData.append("dev_data_release_end", dev_data_release_end);
  formData.append("dev_data_pred_poverki_start", dev_data_pred_poverki_start);
  formData.append("dev_data_pred_poverki_end", dev_data_pred_poverki_end);
  formData.append("dev_data_poverki_start", dev_data_poverki_start);
  formData.append("dev_data_poverki_end", dev_data_poverki_end);

  $.ajax({
    url: "bd/select_adm.php",
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

        document.location.href = "../admin.php";
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

//чистка названий

$(".clean-btn").click(function (e) {
  e.preventDefault();

  $(`input`).removeClass("error");

  $.ajax({
    url: "../../vendor/reset.php",
    type: "POST",
    dataType: "json",
    processData: false,
    contentType: false,
    beforeSend: funcBefore,
    cache: false,
    success(data) {
      if (data.status) {
        $(".gifload").addClass("none");

        $('form input[type="text"]').val("");
        // document.getElementById("myForm").reset();
        $(".msg").removeClass("none").text(data.message);
        document.location.href = "../profile.php";
      }
    },
  });
});
//чистка названий admin

$(".clean-btn-adm").click(function (e) {
  e.preventDefault();

  $(`input`).removeClass("error");

  $.ajax({
    url: "../../vendor/reset.php",
    type: "POST",
    dataType: "json",
    processData: false,
    contentType: false,
    beforeSend: funcBefore,
    cache: false,
    success(data) {
      if (data.status) {
        $(".gifload").addClass("none");

        $('form input[type="text"]').val("");
        // document.getElementById("myForm").reset();
        $(".msg").removeClass("none").text(data.message);
        document.location.href = "../admin.php";
      }
    },
  });
});

// изменение устройства

$(".change-btn").click(function (e) {
  e.preventDefault();

  $(`input`).removeClass("error");

  let name = $('input[name="name3"]').val(),
    dev_id = $('input[name="dev_id"]').val(),
    marka = $('input[name="marka3"]').val(),
    zav_number = $('input[name="zav_number3"]').val(),
    dev_data_release = $('input[name="dev_data_release3"]').val();
  dev_data_pred_poverki = $('input[name="dev_data_pred_poverki3"]').val();
  dev_data_poverki = $('input[name="dev_data_poverki3"]').val();

  let formData = new FormData();
  formData.append("dev_id", dev_id);
  formData.append("name", name);
  formData.append("marka", marka);
  formData.append("zav_number", zav_number);
  formData.append("pasport", pasport);
  formData.append("dev_data_release", dev_data_release);
  formData.append("dev_data_pred_poverki", dev_data_pred_poverki);
  formData.append("dev_data_poverki", dev_data_poverki);

  $.ajax({
    url: "../../bd/change.php",
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
// удаление паспорта

$(".del-btn").click(function (e) {
  e.preventDefault();

  $(`input`).removeClass("error");

  dev_id = $('input[name="dev_id"]').val();
  href1 = document.getElementById("seatch_bt").getAttribute("href");

  let formData = new FormData();
  formData.append("dev_id", dev_id);
  formData.append("href", href1);

  $.ajax({
    url: "../../bd/del.php",
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

// списание устройства

// получение картинки
let akt = false;

$('input[name="akt"]').change(function (e) {
  akt = e.target.files[0];
});
$(".spisat-btn").click(function (e) {
  e.preventDefault();

  $(`input`).removeClass("error");

  let status = $('input[name="status]').val();
  dev_id = $('input[name="dev_id"]').val();

  let formData = new FormData();
  formData.append("dev_id", dev_id);
  formData.append("status", status);
  formData.append("akt", akt);

  $.ajax({
    url: "../../bd/spisat.php",
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

// удаление акта списания

$(".del-btn").click(function (e) {
  e.preventDefault();

  $(`input`).removeClass("error");

  dev_id = $('input[name="dev_id"]').val();
  href1 = document.getElementById("akt_bt").getAttribute("href");

  let formData = new FormData();
  formData.append("dev_id", dev_id);
  formData.append("href", href1);

  $.ajax({
    url: "../../bd/del_akt.php",
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

// добавление  пользователей админом

$(".add-btn-adm-user").click(function (e) {
  e.preventDefault();

  $(`input`).removeClass("error");

  let first_name = $('input[name="first_name"]').val(),
  last_name = $('input[name="last_name"]').val(),
    patronymic = $('input[name="patronymic"]').val(),
    distr = $('input[name="distr"]').val();
    login = $('input[name="login"]').val();
  password = $('input[name="password"]').val();
  access = $('input[name="access"]').val();

  let formData = new FormData();

  formData.append("first_name", first_name);
  formData.append("last_name", last_name);
  formData.append("patronymic", patronymic);
  formData.append("distr", distr);
  formData.append("login", login);
  formData.append("password", password);
  formData.append("access", access);

  $.ajax({
    url: "bd/add_user.php",
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

        document.location.href = "../users.php";
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
