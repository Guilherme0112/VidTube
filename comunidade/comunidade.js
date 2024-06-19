function amountTxt(){
    var post = document.getElementById('txt1');
    var msg = document.getElementById('msg');
    msg.innerHTML = post.value.length + '/200';

    if(post.value.length > 200){
        msg.style.color = 'red';    
    } else {
        msg.style.color = 'gray';
    }
}
function vali(){
    var post = document.getElementById('txt1');
    if(post.value.length > 200){
        document.getElementById('txt1').style.outline = '2px solid red';
        return false;
    } else {
        document.getElementById('txt1').style.outline = 'none';
    }
    const postImg = document.getElementById('post-img');
    if(postImg.files.length > 0){
        return true;
    } else {
        document.getElementById('post-img').style.outline = '2px solid red';
        return false;
    }
}