const pagesList = document.querySelectorAll(".item-pagina");
const itemsList = document.querySelectorAll(".item-paginacion");

document.querySelector("#inscripcionesPagina").addEventListener("click", () => {
  pagesList.item(0).style = "display:unset !important;";
  pagesList.item(1).style = "display:none !important;";
  pagesList.item(2).style = "display:none !important;";

  itemsList.item(0).classList.add("selected");
  itemsList.item(1).classList.remove("selected");
  itemsList.item(2).classList.remove("selected");
});

document.querySelector("#fichasPagina").addEventListener("click", () => {
  pagesList.item(0).style = "display:none !important;";
  pagesList.item(1).style = "display:unset !important;";
  pagesList.item(2).style = "display:none !important;";

  itemsList.item(0).classList.remove("selected");
  itemsList.item(1).classList.add("selected");
  itemsList.item(2).classList.remove("selected");
});

document.querySelector("#pendientesPagina").addEventListener("click", () => {
  pagesList.item(0).style = "display:none !important;";
  pagesList.item(1).style = "display:none !important;";
  pagesList.item(2).style = "display:unset !important;";

  itemsList.item(0).classList.remove("selected");
  itemsList.item(1).classList.remove("selected");
  itemsList.item(2).classList.add("selected");
});
