document.querySelector('.icon').addEventListener('click', function() {
    document.querySelector('.menu').classList.toggle('show-menu');
});
//Form validation
function validateForm(){
    var name = document.getElementsByName('name')[0];
    var email = document.getElementsByName('email')[0];
    var phone = document.getElementsByName('phone')[0];
    var pass = document.getElementsByName('senha')[0];
    var rpass = document.getElementsByName('rsenha')[0];
    if(name.value.length < 3 || phone.value.length != 15 || pass.value != rpass.value){
        if(name.value.length < 3){
            console.log('O nome precisa ter pelo menos 3 caracteres');
            nameError.innerText = 'O nome precisa ter pelo menos 3 caracteres.';
            name.style.outline = '2px solid red';
        }else{
            name.style.outline = 'none';
            nameError.innerText = '';
        }
        if(phone.value.length != 15){
            console.log('O número do telefone precisa ter 11 caracteres');
            phone.style.outline = '2px solid red';
            phoneError.innerText = 'O número deve ter 11 caracteres.';
        }else{
            phone.style.outline = 'none';
            phoneError.innerText = '';
        }
        if(pass.value != rpass.value || pass.value.length === 0 || rpass.value.length === 0){
            console.log('As senhas nao coencidem ou estao vazias');
            passError.innerText = 'As senhas não coencidem.';
            rpassError.innerText = 'As senhas não coencidem.';
            pass.style.outline = '2px solid red';
            rpass.style.outline = '2px solid red';
        }else{
            pass.style.outline = 'none';
            rpass.style.outline = 'none';
            passError.innerText = '';
            rpassError.innerText = '';
        } 

        return false;

    } else{
            
        return true;
    }   
}
//formater input phone
document.querySelector('.tel').addEventListener('input', function (e) {
    let tel = e.target.value.replace(/\D/g, ''); //retira os espaços
    tel = tel.replace(/^(\d{2})(\d)/g, '($1) $2'); //coloca parenteses nos 2 primeiros números
    tel = tel.replace(/(\d)(\d{4})$/, '$1-$2'); //coloca o hífen depois de 5 números
    e.target.value = tel;
  });
  
