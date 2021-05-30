$('.login-form #login-btn').on('click', function() {
  let user_email = $('.login-form .email').val();
  let user_password = $('.login-form .password').val();
  $.ajax({
    method: 'POST',
    url: `${api_host}/users/login`,
    data: {
      user: {
        email: user_email,
        password: user_password,
      }
    },
    success: function(response) {
     $.post('setsessionvariable.php', response.user);
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
      window.location.href = 'index.php'
    },
    error: function(error) {
      console.log(error.responseJSON);
    }
  });
});

$('#user-form #btn-submit').on('click', function() {
  let token = $('#user-form .token').val();
  let user_name = $('#user-form .name').val();
  let user_password = $('#user-form .password').val();
  let user_email = $('#user-form .email').val();
  $.ajax({
    method: 'PUT',
    url: `${api_host}/user`,
    headers: { "Authorization": "Token " + token },
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
      window.location.href = `profile.php?id=${response.user.id}`
    },
    error: function(error) {
      console.log(error.responseJSON);
    }
  });
});
