document.getElementById("input").addEventListener("change", (e) => {
  document.getElementById("span").innerText = e.target.files[0].name;
});
