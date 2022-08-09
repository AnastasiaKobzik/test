$('.form-signup').submit(function(e){
  e.preventDefault();

  $.ajax({
    url:     "page/ajax_signup.php", //url страницы
    type:     "POST", //метод отправки
    dataType: "json", //формат данных
    data: $('.form-signup').serialize(),
    success: function(response){
      location.reload();
      //console.log(response);
    },
    error: function(response, status, error){
      //console.log(response.responseJSON);
      var errors = response.responseJSON;
      $('.form-control-feedback').text("");
      if (errors.errors) {
        errors.errors.forEach(function(data, index) {
          var field = Object.getOwnPropertyNames (data);
          var value = data[field];
          var div = $("#"+field[0]).closest('div');
          div.children('.form-control-feedback').text(value);
        });
      }
    }
  });
});

$('.form-login').submit(function(e){
  e.preventDefault();

  $.ajax({
    url:     "page/ajax_login.php", //url страницы
    type:     "POST", //метод отправки
    dataType: "json", //формат данных
    data: $('.form-login').serialize(),
    success: function(response){
      location.reload();
    },
    error: function(response, status, error){
      var errors = response.responseJSON;
      $('.form-feedback').text("");
      if (errors.errors) {
        errors.errors.forEach(function(data, index) {
          var field = Object.getOwnPropertyNames (data);
          var value = data[field];
          var div = $("#"+field[0]).closest('div');

          console.log(field[0]);
          div.children('.form-feedback').text(value);
        });
      }
    }
  });
});

$('.goOut').on('click', function(){
  var request = new XMLHttpRequest();
  request.onreadystatechange = function(){
    if((request.readyState==4) && (request.status==200)){
      location.reload();
    }
  }
  request.open('GET','page/goOut.php?', true);
  request.send();
});