function jsonCheckUsername(json) {
    if (formStatus.username = !json.exists) {
        document.querySelector('.username').classList.remove('errorj');
        document.querySelector('.username').classList.add('normal');
        document.querySelector('.username span').textContent = "";
        document.querySelector('.username span').classList.remove('errorj');
        document.querySelector('.username span').classList.add('normal');
    } else {
        document.querySelector('.username span').textContent = "Nome utente già utilizzato";
        document.querySelector('.username').classList.add('errorj');
        document.querySelector('.username').classList.remove('normal');
        document.querySelector('.username span').classList.add('errorj');
        document.querySelector('.username span').classList.remove('normal');
    }
}

function jsonCheckEmail(json) {
    if (formStatus.email = !json.exists) {
        document.querySelector('.email').classList.remove('errorj');
        document.querySelector('.email').classList.add('normal');
        document.querySelector('.email span').textContent = "";
        document.querySelector('.email span').classList.remove('errorj');
        document.querySelector('.email span').classList.add('normal');
    } else {
        document.querySelector('.email span').textContent = "Email già utilizzata";
        document.querySelector('.email').classList.add('errorj');
        document.querySelector('.email').classList.remove('normal');
        document.querySelector('.email span').classList.add('errorj');
        document.querySelector('.email span').classList.remove('normal');
    }
}

function fetchResponse(response) {
    return response.json();
}

function checkUsername(event) {
    const usr = document.querySelector('.username input');

    if(!/^[a-zA-Z0-9_]{1,15}$/.test(usr.value)) {
        usr.parentNode.parentNode.querySelector('span').textContent = "Sono ammesse lettere, numeri e underscore. Max. 15";
        document.querySelector('.username').classList.add('errorj');
        document.querySelector('.username').classList.remove('normal');
        document.querySelector('.username span').classList.add('errorj');
        document.querySelector('.username span').classList.remove('normal');
        formStatus.username = false;
    } else {
        fetch("check_usr.php?q="+encodeURIComponent(usr.value)).then(fetchResponse).then(jsonCheckUsername);
        document.querySelector('.username').classList.remove('errorj');
        document.querySelector('.username').classList.add('normal');
        document.querySelector('.username span').classList.remove('errorj');
        document.querySelector('.username span').classList.add('normal');
    }    
}

function checkEmail(event) {
    const email = document.querySelector('.email input');
    if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(email.value).toLowerCase())) {
        document.querySelector('.email span').textContent = "Email non valida";
        document.querySelector('.email').classList.add('errorj');
        document.querySelector('.email').classList.remove('normal');
        document.querySelector('.email span').classList.add('errorj');
        document.querySelector('.email span').classList.remove('normal');
        formStatus.email = false;
    } else {
        fetch("check_email.php?q="+encodeURIComponent(String(email.value).toLowerCase())).then(fetchResponse).then(jsonCheckEmail);
        document.querySelector('.email span').textContent = "";
        document.querySelector('.email').classList.remove('errorj');
        document.querySelector('.email').classList.add('normal');
        document.querySelector('.email span').classList.remove('errorj');
        document.querySelector('.email span').classList.add('normal');
    }
}


function checkPassword(event) {
    const pass = document.querySelector('.password input');
    const regularExpression = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,20}$/; 
    if (formStatus.password = (pass.value.length >= 8 && pass.value.length <=20 && regularExpression.test(pass.value))){
        document.querySelector('.password').classList.remove('errorj');
        document.querySelector('.password').classList.add('normal');
        document.querySelector('.password span').textContent = "";

    } else {
        document.querySelector('.password').classList.add('errorj');
        document.querySelector('.password').classList.remove('normal');
        document.querySelector('.password span').textContent = "Password non valida, fornisci tra 8 e 20 caratteri con almeno un numero, una maiuscola, una minuscola e un simbolo";
    }
}
function showPass(){
    const pass=document.getElementById('password');
    if(pass.type=== 'password'){
        pass.type='text';
    }
    else{
        pass.type='password';
    }
}

const formStatus = {'upload': true};
document.querySelector('.username input').addEventListener('blur', checkUsername);
document.querySelector('.email input').addEventListener('blur', checkEmail);
document.querySelector('.password input').addEventListener('blur', checkPassword);
document.getElementById('showpass').addEventListener('click',showPass);