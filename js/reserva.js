document.addEventListener("DOMContentLoaded", () => {
  let currentView = 1; // Establece la vista inicial
  const screens = document.querySelectorAll('.carrousel .screens li');
  const pagination = document.querySelector('.carrousel .pagination');
  const countViews = screens.length;

  const switchView = (id) => {
      if (id >= 1 && id <= countViews)
          currentView = id;
      updateView();
  };

  const initPagination = () => {
      for (let i = 1; i <= countViews; i++) {
          let page = document.createElement('li');
          page.addEventListener('click', () => switchView(i));
          pagination.appendChild(page);
      }
  };

  const updateView = () => {
      screens.forEach((el) => {
          el.classList.remove('left', 'right', 'active');
      });
      pagination.childNodes.forEach((el) => {
          el.classList.remove('active');
      });

      let view0 = currentView - 1;
      let view1 = currentView;
      let view2 = currentView + 1;

      if (view0 <= 0) view0 = countViews;
      if (view2 > countViews) view2 = 1;

      screens[view1 - 1].classList.add('active');
      screens[view0 - 1].classList.add('left');
      screens[view2 - 1].classList.add('right');
      pagination.childNodes[view1 - 1].classList.add('active');
  };

  screens.forEach((screen, index) => {
      screen.addEventListener('click', () => {
          if (!screen.classList.contains('left') && !screen.classList.contains('right')) {
              if (index === currentView - 1) {
                  if (currentView === countViews)
                      currentView = 1;
                  else
                      currentView++;
                  updateView();
              }
          } else if (screen.classList.contains('left')) {
              if (currentView === 1)
                  currentView = countViews;
              else
                  currentView--;
              updateView();
          } else if (screen.classList.contains('right')) {
              if (currentView === countViews)
                  currentView = 1;
              else
                  currentView++;
              updateView();
          }
      });
  });

  initPagination();
  updateView();
});
const horaInput = document.getElementById('hora');

  // Restringir las horas disponibles
  horaInput.addEventListener('input', function () {
    const horaSeleccionada = this.value;
    const horaMinima = '13:00';
    const horaMaxima = '15:30';

    // Si la hora seleccionada está fuera del rango, restablécela
    if (horaSeleccionada < horaMinima || horaSeleccionada > horaMaxima) {
      this.value = ''; // Limpiar el valor
    }
  });
  // Seleccionar el input de cantidad de personas y el mensaje
const cantidadInput = document.getElementById('cantidad');
const message = document.querySelector('.message');

// Escuchar el evento de cambio en el campo de cantidad
cantidadInput.addEventListener('input', function () {
  const cantidad = parseInt(cantidadInput.value, 10); // Obtener el valor como número
  if (cantidad > 20) {
    message.style.display = 'block'; // Mostrar el mensaje si la cantidad es mayor a 20
  } else {
    message.style.display = 'none'; // Ocultar el mensaje si la cantidad es 20 o menos
  }
});
