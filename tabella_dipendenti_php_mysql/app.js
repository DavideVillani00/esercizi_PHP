const btn_agg = document.querySelector("#aggiungi");
let cont_agg = document.querySelector("#container_aggiungi");
// card visibile
btn_agg.addEventListener("click", () => {
  cont_agg.style.display = "flex";
  cont_agg.style.alignItems = "center";
  cont_agg.style.justifyContent = "center";
  btn_agg.style.display = "none";
});
