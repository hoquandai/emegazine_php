$('#question-form button.submit').on('click', function() {
  let token = $('#question-form .token').val();
  let id = $('#question-form .id').val();
  let method = id != '' ? 'PUT' : 'POST';

  let userId = $('#question-form .userid').val();
  let excerpt = $('#question-form .excerpt').val();
  let content = $('#question-form .content').val();
  let categoryId = $('#question-form #category').val();
  let image = $('#question-form .image')[0].files[0];
  let tags = $('#question-form .tags').val();
  let form_data = new FormData();

  form_data.append('question[excerpt]', excerpt);
  form_data.append('question[content]', content);
  form_data.append('question[category_id]', categoryId);
  form_data.append('question[tag_list]', tags);
  form_data.append('question[user_id]', userId);
  if (image) { form_data.append('question[image]', image); }

  $.ajax({
    headers: { "Authorization": "Token " + token },
    method: method,
    url: `${api_host}/questions/${id}`,
    processData: false,
    enctype: 'multipart/form-data',
    contentType: false,
    data: form_data,
    success: function(response) {
     window.location.href = `question.php?id=${response.data.id}`

    },
    error: function(error) {
      console.log(error.responseJSON);
    }
  });
});

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

$('.manage.visibility').on('click', function(e) {
  let token = $('#user_token').val();
  let id = $(this).data('id');
  let checked = $(this)[0].checked ? 1 : 0;
  $.ajax({
    headers: { "Authorization": "Token " + token },
    method: 'PUT',
    url: `${api_host}/questions/${id}`,
    data: {
      question: {
        visible: checked
      }
    },
    success: function(response) {
     // window.location.href = `manage_questions.php`

    },
    error: function(error) {
      console.log(error.responseJSON);
    }
  });
})

$('.manage.question_remove').on('click', function(e) {
  e.preventDefault();
  e.stopPropagation();
  let token = $('#user_token').val();
  let id = $(this).data('id');
  $.ajax({
    headers: { "Authorization": "Token " + token },
    method: 'DELETE',
    url: `${api_host}/questions/${id}`,
    success: function(response) {
     $(`#question-${id}`).remove();

    },
    error: function(error) {
      console.log(error.responseJSON);
    }
  });
})
