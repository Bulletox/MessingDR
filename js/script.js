
  document.addEventListener("DOMContentLoaded", function () {
    // Oculta el segundo álbum al cargar la página
    document.getElementById("secondAlbum").style.display = "none";

    // Agrega un evento de clic al botón "Ver más"
    document.getElementById("verMasBtn").addEventListener("click", function () {
      // Muestra u oculta el segundo álbum cuando se hace click
      var secondAlbum = document.getElementById("secondAlbum");
      secondAlbum.style.display = (secondAlbum.style.display === "none") ? "block" : "none";
    });
  });
// A partir de aquí empieza la llamada para hacer que el buscador funcione mediante lo que se introduce en él
  document.addEventListener("keyup", e => {
    if (e.target.matches("#miInput")) {
        const term = e.target.value.toLowerCase();

        document.querySelectorAll(".nombrerestaurante").forEach(restaurante => {
            const restauranteText = restaurante.textContent.toLowerCase();
            const restauranteDiv = restaurante.closest('.col');  // Obtener el div padre del restaurante

            if (restauranteText.includes(term)) {
                restauranteDiv.classList.remove("filtro");
            } else {
                restauranteDiv.classList.add("filtro");
            }
        });
    }
});


