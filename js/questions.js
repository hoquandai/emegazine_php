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
