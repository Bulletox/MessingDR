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

    // Agregar un tiempo de espera antes de redirigir para asegurar que se muestre el mensaje
    setTimeout(() => {
        window.location.href = 'index.html'; // Reemplaza 'ruta_a_tu_index.html' con la ruta correcta
    }, 2000); // Espera 2 segundos antes de redirigir (ajusta según sea necesario).
});
