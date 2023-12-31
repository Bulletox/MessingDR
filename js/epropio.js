/*
function fechaAleatoria() {
    const today = new Date();
    const daysToAdd = Math.floor(Math.random() * 5) + 1;
    const date = new Date(today.getTime() + daysToAdd * 24 * 60 * 60 * 1000);
    return date;
}

function generarDatos() {
    const reservas = 500;
    const nombresLista = ["Juan", "María", "Pedro", "Ana", "Luis", "José", "Carmen", "David", "Marta", "Antonio", "Paula", "Francisco", "Isabel", "Miguel", "Laura", "Daniel", "Elena", "Jorge", "Sara", "Álvaro", "Cristina", "Iván", "Andrea", "Pablo", "Teresa", "Alejandro", "Sandra", "Daniela", "Sergio", "Noelia", "Jonathan", "Raquel", "Carlos", "Alba", "Adrián", "Lucía", "Javier", "Eva", "Óscar", "Marta", "Diego", "Beatriz", "Gonzalo", "Elena", "Rodrigo", "Alba", "Jonathan", "Raquel", "Carlos", "Alba", "Adrián", "Lucía", "Javier", "Eva", "Óscar", "Marta", "Diego", "Beatriz", "Gonzalo", "Elena", "Rodrigo", "Alba", "Jonathan", "Raquel", "Carlos", "Alba", "Adrián", "Lucía", "Javier", "Eva", "Óscar", "Marta", "Diego", "Beatriz", "Gonzalo", "Elena", "Rodrigo"]; // Lista de nombres

    const personas = [];
    const fechas = [];
    const horas = [];
    const estados = ["Terraza", "Comedor"];

    for (let i = 0; i < reservas; i++) {
        personas.push(Math.floor(Math.random() * 10 + 1));
        fechas.push(fechaAleatoria());
        horas.push(Math.floor(Math.random() * (24 - 12) + 12));
    }

    const nombres = nombresAleatorios();

    for (let i = 0; i < reservas; i++) {
        const fila = document.createElement("item");
        fila.innerHTML = `
 
         <id_usuario>${i+1}</id_usuario>
         <nombre>${nombres[i] + " " + nombres[Math.floor(Math.random() * nombres.length)]}</nombre>
         <apellidos>${nombres[i] + " " + nombres[Math.floor(Math.random() * nombres.length)]}</apellidos> 
         <correo>${nombres[i]+nombres[Math.floor(Math.random() * nombres.length)]+"@gmail.com"}</correo>
         <telefono>${i}</telefono>
         <id_reserva></id_reserva>
         <fecha_reserva>${fechas[i].toLocaleDateString()}</fecha_reserva>
         <num_personas>${personas[i]}</num_personas>
         <estado>TRUE</estado> 

          `;

        //document.querySelector("table tbody").appendChild(fila);
        document.querySelector("items").appendChild(fila);
    }

    function nombresAleatorios() {
        const nombres = [];
        for (let i = 0; i < reservas; i++) {
            nombres.push(nombresLista[Math.floor(Math.random() * nombresLista.length)]);
        }
        return nombres;
    }

    function generarEstado() {
        const estados = ["Confirmado", "En espera", "Pendiente"];
        return estados[Math.floor(Math.random() * estados.length)];
    }
}

//generarDatos();

$('#dataTableSaA').dataTable({
    "order": [[3, 'asc'], [4, 'asc']]
});

function formatDate(date) {
    return moment(date).format('DD/MM/YY');
}
// NO tiene sentido hasta que no funcione la BBDD
/*function contarReservasPendientes(idTabla) {
    console.log("chack1")
    // Obtener el elemento de la tabla
    const table = document.getElementById(idTabla);

    // Obtener las filas de la tabla
    const rows = table.querySelectorAll("tr");

    // Contar las reservas pendientes
    let contador = 0;
    for (const row of rows) {
        // Obtener el valor de la columna estado
        const estado = row.querySelector("td:nth-child(5)").textContent;

        // Si el estado es pendiente, aumentar el contador
        if (estado === "Pendiente") {
            contador++;
        }
    }

    // Asignar el valor del contador al elemento con el ID contadorPendiente
    document.getElementById("contadorPendiente").textContent = contador;
}
contarReservasPendientes('#dataTable');
*/
/*----------------------------------------------------- */
/*function borrarFilasAntiguas(tabla) {
    // Obtenemos la fecha y hora actuales
    console.log("chack2")
    const fechaActual = new Date();
    const horaActual = fechaActual.getHours() + ":" + fechaActual.getMinutes() + ":" + fechaActual.getSeconds();
    
    // Recorremos las filas de la tabla
    for (const fila of tabla.querySelectorAll("tr")) {
      // Obtenemos la hora de la cuarta columna
      if (fila.querySelectorAll("td").length >= 4 && fila.querySelectorAll("td")[3].textContent !== "") {
        console.log("La fila tiene cuatro columnas y la cuarta columna no está vacía")
      } else {
        console.log("La fila no tiene cuatro columnas o la cuarta columna está vacía")
      }
      const hora = fila.querySelectorAll("td")[4].textContent
      // Si la hora es anterior a la fecha y hora en curso, borramos la fila
      if (hora < horaActual) {
        fila.remove();
      }
      console.log("chack3")
    }
  }
 
  const tabla = document.querySelector("#dataTableSaA");
  
  // Borramos las filas antiguas
  borrarFilasAntiguas(tabla);*/

$('#dataTable').dataTable({
    "order": [[3, 'asc'], [4, 'asc']]
});