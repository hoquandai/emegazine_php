$('#question-form button.submit').on('click', function() {
  let token = $('#question-form .token').val();

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
  form_data.append('question[image]', image);
  $.ajax({
    headers: { "Authorization": "Token " + token },
    method: 'POST',
    url: `${api_host}/questions`,
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
