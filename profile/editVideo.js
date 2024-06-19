document.querySelector('.icon').addEventListener('click', function() {
    document.querySelector('.menu').classList.toggle('show-menu');
});
function delet(){
   
    if(confirm("Você realmente deseja apagar este vídeo?")){
        return true;
    } else{
        return false;
    }
}
function vali(){
    var title = document.querySelector('#title');
    if(title.value.length < 3 || title.value.length > 50){
        document.getElementById('title').style.outline = "2px solid red";
        return false;
    } else {
        document.getElementById('title').style.outline = "none";
        return true;
    }
}
//img preview
const fileInput = document.getElementById('thumb');
const imagePreview = document.getElementById('img-preview');

fileInput.addEventListener('change', function() {
    const file = this.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function(event) {
            imagePreview.src = event.target.result;
            };

    reader.readAsDataURL(file);
    }
})

// 
    var title = document.getElementById('title').value.length;
    var msg = document.getElementsByClassName('msg-error')[0];
    msg.innerHTML = title + '/50'
function txt(){
    var title = document.getElementById('title').value.length;
    var msg = document.getElementsByClassName('msg-error')[0];
    msg.innerHTML = title + '/50';
    if(title < 50 && title > 2){
        msg.style.color = 'gray';
    } else {
        msg.style.color = 'red';
    }
    
}