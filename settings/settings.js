document.querySelector('.icon').addEventListener('click', function () {
    document.querySelector('.menu').classList.toggle('show-menu');
});

//update name validation

document.getElementsByName('updateName')[0].addEventListener('click', function(e){
    var nameUser = document.getElementsByName('name')[0];
    if(nameUser.value.length < 3){
        e.preventDefault();
        nameUser.style.outline = '2px solid red';
        document.getElementsByClassName('msg-error')[0].innerHTML = 'O nome precisa ter pelo menos 3 caracteres'
    } else {
        nameUser.style.outline = 'none';
        document.getElementsByClassName('msg-error')[0].innerHTML = ''
    }

})

// event close session

const email = document.getElementById('email').disabled = true;
document.getElementsByName('deleteUser')[0].addEventListener('click', function(evento){
    const confirmation = confirm('Você realmente deseja excluir a conta?');
    if(!confirmation){
        evento.preventDefault();
    }
});

//links of pages update

function photo(){
    location.href = 'PassAndPhoto/photo.php';
}
function phone(){
    location.href = 'nameAndPhone/phone.php';
};
function restorePass(){
    location.href = 'PassAndPhoto/restorePass.php';
};

// format input phone

document.querySelector('.tel').addEventListener('input', function(e){
    let tel = e.target.value.replace(/\D/g, '');
    tel = tel.replace(/^(\d{2})(\d)/g, '($1) $2');
    tel = tel.replace(/(\d)(\d{4})$/, '$1-$2');
    e.target.value = tel;
});