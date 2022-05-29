function check(event){
    const usr=document.getElementById("username");
    const psw=document.getElementById("password");
    if(usr.value.length==0 || psw.value.length==0){
        err.textContent=("Non hai riempito tutti i campi\n");
        event.preventDefault();
    }
}
//switch per vedere password in chiaro
function showPass(){
    const pass=document.getElementById('password');
    if(pass.type=== 'password'){
        pass.type='text';
    }
    else{
        pass.type='password';
    }
}
const form= document.forms["form"];
const err=document.getElementById('error');
err.innerHTML='';
form.addEventListener('submit',check);
document.getElementById('showpass').addEventListener('click',showPass);