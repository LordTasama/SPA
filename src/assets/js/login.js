alertMessage = document.getElementById("alertMessage");

const login = () => {
  let rol = document.getElementById("rol").value;
  let user = document.getElementById("user").value;
  let password = document.getElementById("password").value;

  if (user.length > 0 && password.length > 0) {
    const frmData = new FormData();
    frmData.append("rol", rol);
    frmData.append("user", user);
    frmData.append("password", password);
    fetch("../controller/Login/login.php", {
      method: "POST",
      body: frmData,
    })
      .then((response) => {
        return response.json();
      })
      .then((response) => {
        const res = response.response;
        console.log(res);
        switch (res) {
          case "success":
            location.href = "./controlpanel.php";
            break;
          default:
            alertMessage.innerHTML = `<div  class="alert alert-warning alert-dismissible fade show" role="alert">
                        ${response.data}.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`;
            break;
        }
      });
  } else {
    alertMessage.innerHTML = `<div  class="alert alert-warning alert-dismissible fade show" role="alert">
        Verifica si hay campos vacíos
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>`;
  }
};
document.getElementById("btnLogin").addEventListener("click", login);
document.addEventListener("keypress", (e) => {
  if (e.key == "Enter") {
    login();
  }
});
// -- FIN EVENTO --
