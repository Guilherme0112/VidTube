// Show and Hide menu

document.querySelector('.icon').addEventListener('click', function () {
    document.querySelector('.menu').classList.toggle('show-menu');
});

//update likes for user

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
            success: function (e) {
                console.log('Success')
            },
            error: function (e) {
                console.log('Error: ' + e)
            }
        }).done(function () {
            $('.comments').children().eq(0).after("<div class='box-comments'><img src='" + array.photoComment + "' alt=''><a href='../profile/outherProfile.php?id=" + array.userId + "' class='nameComment text-line-effect'>" + array.nameComment + "</a><span style='width: 100%;'></span><p class='comment'>" + comentario + "</p></div>");
            $('input').val('');
        });
    });
});

//settings follow

$(function () {
    $('.btn').click(function (e) {
        var profile = array.userId
        $.ajax({
            url: '../routes/follow.php',
            type: 'POST',
            data: {
                follow: profile
            },
            success: function (e) {
                console.log('Sucesso: ' + e)
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