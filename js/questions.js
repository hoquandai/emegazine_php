$('#question-form button.submit').on('click', function() {
  let token = $('#question-form .token').val();

  let userId = $('#question-form .userid').val();
  let content = $('#question-form .content').val();
  let categoryId = $('#question-form #category').val();
  let tags = $('#question-form .tags').val();
  $.ajax({
    headers: { "Authorization": "Token " + token },
    method: 'POST',
    url: `${api_host}/questions`,
    data: {
      question: {
        content: content,
        category_id: categoryId,
        tag_list: tags,
        user_id: userId
      }
    },
    success: function(response) {
      console.log(response)
     console.log(response.data)
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
