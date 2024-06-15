document.querySelector('.icon').addEventListener('click', function () {
    document.querySelector('.menu').classList.toggle('show-menu');
  });  

// verification if email exist

$(function(){
    $('#submit').submit(function(e){
        e.preventDefault();
        var email = $('.email').val();
        $.ajax({
            url: 'login.php',
            method: 'POST',
            data: {emailUser: email},
            success: function(e){
                console.log(e)
            }, error: function(e){
                console.log(e)
            }
        })
    })
})