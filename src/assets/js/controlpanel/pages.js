const pageChange = (n) => {
  document.querySelectorAll(".page").forEach((e) => {
    e.classList.add("page-hide");
    e.classList.remove("page-show");
  });
  document.querySelector(".page-" + n).classList.remove("page-hide");
  document.querySelector(".page-" + n).classList.add("page-show");
  resetTables();
  const carpets = [
    "Administrador",
    "Administrador",
    "Data",
    "Data",
    "Data",
    "Data",
  ];
  const actionTarget = [
    "usersinfo.php",
    "therapistsinfo.php",
    "clientsinfo.php",
    "servicesinfo.php",
    "productsinfo.php",
    "appointmentsinfo.php",
  ];

  if (document.querySelector("#datatable" + n)) {
    $("#datatable" + n).dataTable(
      returnDatatableOption(n, `../controller/${carpets[n]}/${actionTarget[n]}`)
    );
  } else {
    switch (n) {
      case 5:
        cargar();
        break;
      case 6:
        "";
    }
  }
};
