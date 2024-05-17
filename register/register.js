document.querySelector('.icon').addEventListener('click', function() {
    document.querySelector('.menu').classList.toggle('show-menu');
});
function validateForm(){

    var name = document.getElementsByName('name')[0];
    var email = document.getElementsByName('email')[0];
    var phone = document.getElementsByName('phone')[0];
    var pass = document.getElementsByName('senha')[0];
    var rpass = document.getElementsByName('rsenha')[0];

    if(name.value.length < 3 || phone.value.length != 10 || pass.value != rpass){
        if(name.value.length < 3){
            console.log('O nome precisa ter pelo menos 3 caracteres');
            nameError.innerText = 'O nome precisa ter pelo menos 3 caracteres.';
            name.style.outline = '2px solid red';
        }else{
            name.style.outline = 'none'
            nameError.innerText = '';
        }
        if(phone.value.length != 10){
            console.log('O número do telefone é necessário ter 10 caracteres');
            phone.style.outline = '2px solid red';
            phoneError.innerText = 'O número deve ter 10 caracteres.'
        }else{
            phone.style.outline = 'none'
            phoneError.innerText = '';
        }
        if(pass.value != rpass.value || pass.value.length === 0 || rpass.value.length === 0){
            console.log('As senhas nao coencidem ou estao vazias');
            passError.innerText = 'As senhas nao coencidem.'
            rpassError.innerText = 'As senhas nao coencidem.'
            pass.style.outline = '2px solid red';
            rpass.style.outline = '2px solid red';
        }else{
            pass.style.outline = 'none'
            rpass.style.outline = 'none'
            passError.innerText = '';
            rpassError.innerText = '';
        } 

        return false;

    } else{
            
        return true;
    }
    
}