const btn_agg = document.querySelector("#aggiungi");
const cont_agg = document.querySelector("#container_aggiungi");
// const modifica = document.querySelectorAll("a");
// card visibile
btn_agg.addEventListener("click", () => {
  cont_agg.style.display = "flex";
  cont_agg.style.alignItems = "center";
  cont_agg.style.justifyContent = "center";
  btn_agg.style.display = "none";
});
