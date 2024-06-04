document.querySelector('.icon').addEventListener('click', function() {
    document.querySelector('.menu').classList.toggle('show-menu');
});
//validation video
const submit = document.getElementsByName("submit")[0];
submit.addEventListener("click", function(){
    var title = document.getElementById("title").value;
    if(title.length < 2){
        document.getElementById("title").style.outline = "2px solid red";
        document.getElementById("msg-error").innerHTML = "O título precisa ter pelo menos 3 caracteres";
        return false;
    } else {
        document.getElementById("title").style.outline = "none";
        document.getElementById("msg-error").innerHTML = "";
        return true;
    }
})
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