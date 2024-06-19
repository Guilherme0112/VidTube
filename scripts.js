document.querySelector('.icon').addEventListener('click', function () {
    document.querySelector('.menu').classList.toggle('show-menu');
});

// search

/*$(function(){
    $('.search').click(function(){
        var busca = $('#search').val()
        $.ajax({
            url: 'index.php',
            method: 'GET',
            data: {search: busca},
            success: function(e){
                console.log('Success ' + e)
            }, error: function(e){
                console.log('Error ' + e)
            }
        })
    })
}) */