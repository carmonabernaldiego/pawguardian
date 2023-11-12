/*-------------------------------------------
    userUpdatePass.js
    By  CBDX
    
    
-------------------------------------------*/

const label = document.getElementById('labelError');
const label2 = document.getElementById('labelHide');

label.style.display = 'none';

function confirmPass() {
    pass1 = document.getElementById('txtnewpassword');
    pass2 = document.getElementById('txtconfirmnewpassword');

    if (pass1.value != pass2.value) {
        label.style.display = 'block';
        label2.style.display = 'none';

        return false;
    } else {
        return true;
    }
}