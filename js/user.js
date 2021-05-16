$('#login-form').on('click', function() {
  let user_name = $('.login-form #name').value();
  let user_password = $('.login-form #password').value();
  $.ajax({
    method: 'POST',
    url: `${api_host}/users`,
    data: {
      user: {
        name: user_name,
        password: user_password,
      }
    },
    success: function(response) {
     $.post('setsessionvariable.php', response.user);
      localStorage.setItem("user_name", response.user.name);
      window.location.href = 'index.php'
    },
    error: function(error) {
      console.log(error.responseJSON);
    }
  });
});

$('#register-form #btn-submit').on('click', function() {
  let user_name = $('#register-form .name').val();
  let user_password = $('#register-form .password').val();
  let user_email = $('#register-form .email').val();
  $.ajax({
    method: 'POST',
    url: `${api_host}/users`,
    async: false,
    data: {
      user: {
        name: user_name,
        password: user_password,
        email: user_email
      }
    },
    success: function(response) {
      console.log(response.user);
      $.post('setsessionvariable.php', response.user);
      localStorage.setItem("user_name", response.user.name);
      window.location.href = 'index.php'
    },
    error: function(error) {
      console.log(error.responseJSON);
    }
  });
});
