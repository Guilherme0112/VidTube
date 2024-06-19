document.querySelector('.icon').addEventListener('click', function() {
    document.querySelector('.menu').classList.toggle('show-menu');
});

//validation video

function verification(){
    var title = document.getElementById("title").value;
    if(title.length <= 2 || title.length > 50){
        document.getElementById("title").style.outline = "2px solid red";
        return false;
    } else {
        document.getElementById("title").style.outline = "none";
    }
    const videoLabel = document.querySelector('#videoLabel');
    const video = document.querySelector('#video');
    if(video.files.length === 0){
        videoLabel.style.outline = "2px solid red";
        return false;
    } else {
        videoLabel.style.outline = 'none';
    }
    //
    const thumbLabel = document.querySelector('#thumbLabel');
    const thumb = document.querySelector('#thumb');
    if(thumb.files.length === 0){
        thumbLabel.style.outline = "2px solid red";
        return false;
    } else {
        thumbLabel.style.outline = 'none';
    }   
}

// Video loading 

const videoInput = document.getElementById('video');
const progressBar = document.getElementById('progress');

videoInput.addEventListener('change', function() {
    const file = this.files[0];
    const formData = new FormData();
    formData.append('file', file);

    const xhr = new XMLHttpRequest();

    xhr.upload.onprogress = function(event) {
        if (event.lengthComputable) {
            document.getElementById("videoLabel").innerHTML = 'Fazendo upload do vídeo...'
            const percentLoaded = Math.round((event.loaded / event.total) * 100);
            progressBar.value = percentLoaded;
        }
    };
    xhr.upload.onload = function() {
        document.getElementById("videoLabel").innerHTML = 'Vídeo carregado com sucesso!'
    };
    xhr.open('POST', 'uploadVideo.php', true);
    xhr.send(formData);
});

//Image Preview

const fileInput = document.getElementById('thumb');
const imagePreview = document.getElementById('img-preview');

fileInput.addEventListener('change', function() {
    const file = this.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function(event) {
            imagePreview.src = event.target.result;
            document.querySelector('#thumbLabel').innerHTML = 'Arquivo carregado com sucesso!';
        };
        reader.readAsDataURL(file);
    }
});

//

function text(){
    var msg = document.getElementById('msg-error');
    var title = document.getElementById('title').value.length;
    msg.innerHTML = title + '/50';
    if(title < 2 || title > 50){
        msg.style.color = 'red';
    } else {
        msg.style.color = 'gray';
    }

}