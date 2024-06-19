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
    
    if(name.value.length < 3 || name.value.length > 20 || phone.value.length != 15 || pass.value != rpass.value || pass.value.length < 5 && rpass.value.length < 5){
        if(name.value.length < 3){
            console.log('O nome precisa ter pelo menos 3 caracteres');
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
        if(pass.value != rpass.value || pass.value.length < 5 && rpass.value.length < 5){
            console.log('As senhas não coencidem ou estao vazias');
            pass.style.outline = '2px solid red';
            rpass.style.outline = '2px solid red';
            document.getElementById('passError').innerHTML = 'As senhas não coencidem ou tem menos de 5 caracteres ou mais de 30';
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
  //
function nameMsg(){
    var textName = document.getElementsByName('name')[0].value.length;
    var msgName = document.getElementById('nameError');
    msgName.innerHTML = textName + '/20';
    if(textName < 3 || textName > 20){
        msgName.style.color = 'red';
    } else {
        msgName.style.color = 'gray';
    }

}

  
