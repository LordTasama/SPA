import { SetTitle, ValidForm, ConfirmPass, SetLoading, SetError } from '../Assets/Js/globals.functions.js';
import {} from '../Assets/Helper/layout.js';
import { SetModal, ShowModal } from '../Assets/Js/modal.js';
SetTitle('Registrarse');
//objs
const txtPass = document.getElementById('password');
const txtConfirmPass = document.getElementById('confirmPass');
const btnRegistrarme = document.getElementById('btnRegistrarme');
//events
txtConfirmPass.addEventListener('focusout', ()=>{
    ConfirmPass(txtPass.value, txtConfirmPass);
    txtPass.addEventListener('focusout', ()=>{
        ConfirmPass(txtPass.value, txtConfirmPass);
    });
});
btnRegistrarme.addEventListener('click', ()=>{
    SetLoading(btnRegistrarme);
    let nombre_Completo = document.getElementById('nombres').value ;
    let telefono = document.getElementById('telefono').value;
    let correo = document.getElementById('email').value;
    let apellidos = document.getElementById('apellidos').value;
    let password = document.getElementById('password').value;
    var datos = {
        nombres: nombre_Completo,
        apellidos: apellidos,
        telefono: telefono,
        email: correo,
        password: password 
    };
    $.ajax({
        data: datos,
        url: `../../../Back/Controllers/registrarse/registrarse.php`,
        method: 'POST',
        success: function (data) {
            var message = JSON.parse(data)
            if ( message.message == "Correo ya existe") {
                window.location.href = "../Ingresar/index.php"
            }else{
                // ? Mostrar la modal
            }
        },
        error: function (err) {
            console.log(err);
        }
    });

});