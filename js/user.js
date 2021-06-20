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
      console.log(response);
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
  let user_id = $('#user-form .id').val();
  let current_user_id = $('#user-form .current_id').val();
  let user_name = $('#user-form .name').val();
  let user_admin = $('#user-form .is-admin').length > 0 ? $('#user-form .is-admin')[0].checked : false;
  let user_password = $('#user-form .password').val();
  let user_email = $('#user-form .email').val();
  let user_for_admin = $('#user-form .admin_update').val();
  let user_avatar = $('#user-form .avatar')[0].files[0];
  let form_data = new FormData();
  form_data.append('user[id]', user_id);
  form_data.append('user[name]', user_name);
  form_data.append('user[is_admin]', user_admin);
  form_data.append('user[password]', user_password);
  form_data.append('user[email]', user_email);
  if (user_avatar) { form_data.append('user[avatar]', user_avatar); }
  $.ajax({
    method: 'PUT',
    url: `${api_host}/user`,
    headers: { "Authorization": "Token " + token },
    processData: false,
    enctype: 'multipart/form-data',
    contentType: false,
    data: form_data,
    success: function(response) {
      console.log(response.user);
      if (user_for_admin) {
        if (current_user_id == user_id) {
          window.location.href = `logout.php`
        } else {
          window.location.href = `manage_users.php`
        }
      } else {
        $.post('setsessionvariable.php', response.user);
        window.location.href = `profile.php?id=${response.user.id}`
      }
    },
    error: function(error) {
      console.log(error.responseJSON);
    }
  });
});
