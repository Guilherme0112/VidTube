// Show and Hide menu

document.querySelector('.icon').addEventListener('click', function () {
    document.querySelector('.menu').classList.toggle('show-menu');
});

//settings comments
  
  $(function () {
    $('.comments').submit(function (e) {
      e.preventDefault();
  
      var comentario = $('.inputComment').val();
  
      $.ajax({
        url: '../routes/comments.php',
        type: 'POST',
        data: {
          comment: comentario,
          idVideo: array.idVideo
        },
        success: function (response) {
          if (response.success) { 
            
            $('input').val('');
          } else {
            console.error('Server error:', response.error);
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.error('Error:', textStatus, errorThrown);
        }
      }).done(function () {
        $('.comments').children().eq(0).after("<div class='box-comments'><img src='" + array.photoComment + "' alt=''><a href='../profile/outherProfile.php?id=" + array.userId + "' class='nameComment text-line-effect'>" + array.nameComment + "</a><p class='timeComment'>Preview do comentário</p><span style='width: 100%;'></span><p class='comment'>" + comentario + "</p></div>");
        $('.submitComment').val('');
    });
    });
});

// delete comment

document.querySelectorAll('#deleteComment').forEach(button => {
    button.addEventListener('click', function(event) {
      var dComment = $('.none').val()
        $.ajax({
            url: '../routes/comments.php',
            method: 'POST',
            data: {deleteComment: dComment},
            success: function(e){
              const targetDiv = event.target.closest('.box-comments');
              targetDiv.remove();
            }, error: function(e){
              console.log('Error: ' + e);
            }
        })
     
    });
  });

//settings follow

$(function () {
    $('.btn').click(function () {
        var profile = array.createVideoId
        $.ajax({
            url: '../routes/follow.php',
            type: 'POST',
            data: {
                follow: profile
            },
            success: function (e) {
                console.log('Sucesso:')
                if ($('.btn').val() === 'Seguir') {
                    $('.btn').val("Deixar de Seguir")
                } else {
                    $('.btn').val("Seguir")
                }
            },
            error: function (e) {
                console.log('Error: ' + e)
            }
        });
    });
});

//settings likes

$(function () {
    $('#like').click(function (e) {
        $.ajax({
            url: '../routes/likes.php',
            type: 'POST',
            data: {
                like: array.idVideo
            },
            success: function (e) {
                document.getElementById("like").classList.toggle("fa-regular");
                document.getElementById("like").classList.toggle("fa-solid");

            }
        })
    })
})