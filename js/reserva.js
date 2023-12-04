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
  
  horaInput.addEventListener('input', function () {
    const horaSeleccionada = this.value;
    const horaMinima = '10:00';
    const horaMaxima = '22:00';
  
    if (horaSeleccionada < horaMinima || horaSeleccionada > horaMaxima) {
      this.value = '';
    }
  });
  //validar entrada 
  document.addEventListener('DOMContentLoaded', function () {
    const formulario = document.querySelector('form');

    formulario.addEventListener('submit', function (event) {
        event.preventDefault(); // Evitar el envío del formulario por defecto

        const nombre = document.getElementById('nombre').value;
        const fecha = document.getElementById('fecha').value;
        
        // Expresión regular para validar el nombre (solo letras y espacios)
        const nombreRegex = /^[a-zA-Z\sáéíóúÁÉÍÓÚüÜñÑ]+$/;

        // Expresión regular para validar el año actual y el siguiente
        const fechaRegex = new RegExp(`^${new Date().getFullYear()}|${new Date().getFullYear() + 1}-\\d{2}-\\d{2}$`);

        // Validación del nombre
        if (!nombre.match(nombreRegex)) {
            alert('El nombre no debe contener números ni caracteres especiales.');
            return;
        }

        // Validación de la fecha
        if (!fecha.match(fechaRegex)) {
            alert('Selecciona una fecha válida del año actual o siguiente.');
            return;
        }

        // Si la validación es exitosa, podrías enviar el formulario aquí
        // formulario.submit(); // Descomenta esta línea para enviar el formulario realmente
    });
});

  const cantidadInput = document.getElementById('cantidad');
  const message = document.querySelector('.message');
  
  cantidadInput.addEventListener('input', function () {
    const cantidad = parseInt(cantidadInput.value, 10);
    if (cantidad > 20) {
      message.style.display = 'block';
    } else {
      message.style.display = 'none';
    }
  });
  
  function showPopup(message) {
      const popup = document.getElementById('popup');
      const details = document.getElementById('reservationDetails');
      if (details) {
        details.textContent = message;
        popup.style.display = 'block';
    
        setTimeout(() => {
          document.querySelector('form').submit();
        }, 2000);
      } else {
        console.error('Elemento "reservationDetails" no encontrado');
      }
  }
  
  document.querySelector('form').addEventListener('submit', function (event) {
    event.preventDefault();

    const nombre = document.getElementById('nombre').value;
    const fecha = document.getElementById('fecha').value;
    const hora = document.getElementById('hora').value;
    const cantidad = document.getElementById('cantidad').value;
    const email = document.getElementById('email').value;

    if (nombre === '' || fecha === '' || hora === '' || cantidad === '' || email === '') {
        alert('Por favor, completa todos los campos.');
        return; // Evita que el formulario se envíe si los campos están vacíos
    }

    const mensaje = `Solicitud de reserva para el ${fecha} a las ${hora} para ${cantidad} personas, con correo ${email}.
    Se le confirmará con un correo electrónico.`;

    showPopup(mensaje);

    
    setTimeout(() => {
        window.location.href = 'index.html'; 
    }, 2000); 
});
