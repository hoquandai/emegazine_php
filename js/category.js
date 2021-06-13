$('#category-form button.submit').on('click', function() {
  let token = $('#category-form .token').val();

  let id = $('#category-form .id').val();
  let method = id ? 'PUT' : 'POST';
  let name = $('#category-form .name').val();
  let description = $('#category-form .description').val();

  $.ajax({
    headers: { "Authorization": "Token " + token },
    method: method,
    url: `${api_host}/categories/${id}`,
    data: {
      category: {
        name: name,
        description: description
      }
    },
    success: function(response) {
     window.location.href = `manage_categories.php`

    },
    error: function(error) {
      console.log(error.responseJSON);
    }
  });
});

$('.category_remove').on('click', function(e) {
  e.preventDefault();

  let token = $('#user_token').val();
  let id = $(this).data('id');
  $.ajax({
    headers: { "Authorization": "Token " + token },
    method: 'DELETE',
    url: `${api_host}/categories/${id}`,
    success: function(response) {
     window.location.href = `manage_categories.php`

    },
    error: function(error) {
      console.log(error.responseJSON);
    }
  });
})

$('form#reply .submit').on('click', function() {
  let token = $('form#reply .token').val();
  let userId = $('form#reply .userid').val();
  let userName = $('form#reply .user_name').val();
  let message = $('form#reply .message').val();
  let questionId = $('form#reply .question').val();

  if (!token) {
    window.location.href = 'login.php'
  }

  $.ajax({
    headers: { "Authorization": "Token " + token },
    method: 'POST',
    url: `${api_host}/comments`,
    data: {
      comment: {
        content: message,
        question_id: questionId,
        user_id: userId
      }
    },
    success: function(response) {
      $('.comment-list').append(
        `<div class="item">
          <div class="user">                                
            <figure>
              <img src="images/img01.jpg">
            </figure>
            <div class="details">
              <h5 class="name">${userName}</h5>
              <div class="time">${response.data.created_at}</div>
              <div class="description">
                ${response.data.content}
              </div>
            </div>
          </div>
        </div>`
      );
      $('form#reply .message').val('');
      var prevCnt = parseInt($('#comments_count').text());
      $('#comments_count').text(prevCnt + 1);
    },
    error: function(error) {
      console.log(error.responseJSON);
    }
  });
});
