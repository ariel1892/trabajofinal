window.onload = function () {

  const name = prompt("¡Hola! ¿Cuál es tu nombre?");

  
  if (name && name.trim() !== "") {
    // Enviar el nombre al servidor para guardarlo
    fetch('Datos.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: 'name=' + encodeURIComponent(name.trim()), // Codificar el nombre para evitar problemas
    })
      .then(response => response.text())
      .then(data => {
       
        alert('¡Gracias, ' + name + '! Tu nombre ha sido guardado.');
      })
      .catch(error => {
        console.error('Error al guardar el nombre:', error);
      });
  } else {
   
    alert("Por favor, ingresa un nombre válido.");
  }

  
  fetch('get_names.php') 
    .then(response => response.json())
    .then(data => {
      const namesUl = document.getElementById('names-ul');
      namesUl.innerHTML = ''; 

     
      if (data.names.length === 0) {
        namesUl.innerHTML = '<li>No hay nombres registrados aún.</li>';
      } else {
        // Agregar cada nombre a la lista
        data.names.forEach(name => {
          const li = document.createElement('li');
          li.textContent = name;
          namesUl.appendChild(li);
        });
      }
    })
    .catch(error => console.error('Error al cargar los nombres:', error));

  // Paso 3: Mostrar u ocultar la lista de nombres al hacer clic en el botón
  document.getElementById('show-names-btn').onclick = function () {
    const namesList = document.getElementById('names-list');
    // Alternar la visibilidad de la lista de nombres
    namesList.style.display = (namesList.style.display === 'none' || namesList.style.display === '') ? 'block' : 'none';
  };
};
