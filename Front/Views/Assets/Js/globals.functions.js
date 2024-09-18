import { SetModal, ShowModal } from './modal.js';
//settings
const GetHost = () => {
    return window.location.origin + '/spa';
};
const SetTitle = (title) => {
    document.title = 'Spa | ' + title;
};
const SetIcon = (url) => {
    var link = document.createElement('link');
    link.rel = 'icon';
    link.type = 'image/png';
    link.href = url;
    document.head.appendChild(link);
};
//create
const CreateCss = (url) => {
    var link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = url;
    document.head.appendChild(link);
};
const CreateScript = (url) => {
    var script = document.createElement('script');
    script.src = url;
    document.body.appendChild(script);
};
//components
const SetHeader = (selector) => {
    document.querySelector(selector).innerHTML = `
    <div class="col-auto mx-auto">
        <a class="logo-icon" href="${GetHost()}/Front/Views/Inicio/">
            <img width="180px" src="${GetHost()}/Front/Views/Assets/Img/Spa_Logo.webp" alt="Spa_Logo">
        </a>
    </div>
    `;
};
const SetNavBar = (selector) => {
    var validLogin = window.localStorage.getItem('validLogin');
    let navContent = '';
    if (validLogin) {
        navContent = validLogin;
    } else {
        navContent = `
        <div class="col col-md-auto ms-auto align-content-center mt-2 mt-md-0">
            <div class="btn-group">
                <a class="btn btn-lg btn-outline-primary" href="${GetHost()}/Front/Views/Registrarse/">Registrarse</a>
                <a class="btn btn-lg btn-primary" href="${GetHost()}/Front/Views/Ingresar/">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Ingresar
                </a>
            </div>
        </div>
        `;
    };
    document.querySelector(selector).innerHTML = `
    <div class="container-fluid px-3 px-md-4">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <div class="container-fluid py-2">
                <div class="row flex-column flex-md-row">
                    <div class="col-auto">
                        <a class="nav-link link-dark text-center fs-5 p-2" href="${GetHost()}/Front/Views/Inicio/">Inicio</a>
                    </div>
                    ${navContent}
                </div>
            </div>
        </div>
    </div>
    `;
};
const SetSocialMedia = (selector) => {
    document.querySelector(selector).innerHTML = `
    <div class="row pt-5">
        <div class="col-auto mx-auto">
            <ul class="nav">
                <li class="nav-item">
                    <a class="btn btn-light rounded-circle d-flex align-items-center justify-content-center p-2" href="" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                        </svg>
                    </a>
                </li>
                <li class="nav-item mx-3">
                    <a class="btn btn-light rounded-circle d-flex align-items-center justify-content-center p-2" href="" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                        </svg>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-light rounded-circle d-flex align-items-center justify-content-center p-2" href="" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                        </svg>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    `;
};
const SetFooter = (selector) => {
    document.querySelector(selector).innerHTML = `
    <div class="col mt-5">
        <div class="row d-flex justify-content-between py-2 px-4">
            <div class="col-auto">
                <p class="fw-bold mb-0">Front-end by <a class="fw-semibold link-dark text-decoration-none link-opacity-75 link-opacity-100-hover" href="https://github.com/JohnFRivera" target="_blank">John Freddy Rivera Ayala &copy;</a></p>
            </div>
            <div class="col-auto">
                <p class="fw-bold mb-0">Back-end by <a class="fw-semibold link-dark text-decoration-none link-opacity-75 link-opacity-100-hover" href="https://github.com/JohnFRivera" target="_blank">Kevinn Andrés Álzate Pino &copy;</a></p>
            </div>
        </div>
    </div>
    `;
};
const SetError = (id, message) => {
    let lblErr = document.getElementById(id);
    if (message.length > 0) {
        lblErr.className = 'text-danger pb-3 mb-0';
        lblErr.innerHTML = `
        <i class="bi bi-exclamation-circle-fill"></i>
        ${message}
        `;
    } else {
        lblErr.innerHTML = '';
    };
};
const SetCatchModal = (err) => {
    SetModal(
        `
        <div class="text-danger">
            <i class="bi bi-emoji-frown-fill"></i>
            ERROR 
        </div>
        `,
        `<h5>${err}</h5>`,
        `<button type="button" class="btn btn-primary" id="btnReload">Aceptar</button`
    );
    document.getElementById('btnReload').addEventListener('click', () => {
        window.location.reload();
    });
};
function SetSucessModal(message) {
    SetModal(
        `
        <div class="text-success">
            <i class="bi bi-emoji-smile-fill"></i>
            ¡Felicidades!
        </div>
        `,
        message,
        `
        <button type="button" class="btn btn-primary" id="btnReload">Aceptar</button>
        `
    );
    document.getElementById('btnReload').addEventListener('click', () => {
        window.location.reload();
    })
};
//functions
const FillSelect = (id, json) => {
    var select = document.getElementById(id);
    select.innerHTML = `<option value="">Seleccionar...</option>`;
    json.forEach(item => {
        var arrayValues = [];
        Object.keys(item).forEach(key => {
            arrayValues.push(item[key]);
        });
        select.innerHTML += `
        <option value="${arrayValues[0]}">${arrayValues[1]}</option>
        `;
    });
};
const SetSelectOpt = (id, opt) => {
    var select = document.getElementById(id);
    select.childNodes.forEach(item => {
        if (opt == item.innerText) {
            select.selectedIndex = item.index;
        };
    });
};
const ValidForm = (id) => {
    var form = document.getElementById(id);
    return form.reportValidity();
};
const ConfirmPass = (passValue, confirmPass) => {
    if (passValue.length > 0) {
        if (passValue == confirmPass.value) {
            confirmPass.classList.remove('is-invalid');
            confirmPass.classList.add('is-valid');
            SetError('');
        } else {
            confirmPass.classList.remove('is-valid');
            confirmPass.classList.add('is-invalid');
            SetError('Las contraseñas no coinciden');
        };
    };
};
const SetLoading = (btn) => {
    btn.innerHTML = `
    <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
    <span role="status">Cargando...</span>
    `;
};
//events
export {
    GetHost,
    SetTitle,
    SetIcon,
    CreateCss,
    CreateScript,
    SetHeader,
    SetNavBar,
    SetSocialMedia,
    SetFooter,
    SetError,
    SetCatchModal,
    SetSucessModal,
    FillSelect,
    SetSelectOpt,
    ValidForm,
    ConfirmPass,
    SetLoading
};