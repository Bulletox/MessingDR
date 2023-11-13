document.addEventListener("DOMContentLoaded", function () {
    // Oculta el segundo álbum al cargar la página
    document.getElementById("secondAlbum").style.display = "none";

    // Agrega un evento de clic al botón "Ver más"
    document.getElementById("verMasBtn").addEventListener("click", function () {
      // Muestra el segundo álbum cuando se hace clic
      document.getElementById("secondAlbum").style.display = "block";
    });
  });