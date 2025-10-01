// Botón de alerta
document.getElementById("btnAlerta").addEventListener("click", () => {
  alert("¡Hola esta alerta se produce gracias a Java Script!");
});

// Botón de modo oscuro
document.getElementById("btnModo").addEventListener("click", () => {
  document.body.classList.toggle("dark");
});

// Función para mostrar secciones
function mostrarSeccion(seccion) {
  const contenido = document.getElementById("contenido");

  switch (seccion) {
    case "inicio":
      contenido.innerHTML = `
        <h2>Inicio</h2>
        <p>Este es el inicio</p>
      `;
      break;

    case "quienSoy":
      contenido.innerHTML = `
        <h2>Quién soy</h2>
        <p>Soy estudiante de Ingeniería de Sistemas y actualmente curso el IV ciclo. Me apasiona la tecnología, el desarrollo de software y la creación de soluciones innovadoras que faciliten la vida de las personas. En este momento estoy enfocándome en aprender desarrollo web full stack, adquiriendo habilidades tanto en el front-end como en el back-end para poder diseñar y construir aplicaciones completas y funcionales. Mi objetivo es seguir creciendo profesionalmente, desarrollar proyectos reales y contribuir al avance tecnológico con soluciones eficientes y creativas.</p>
      `;
      break;

    case "proyectos":
      contenido.innerHTML = `
        <h2>Proyectos</h2>
        <p>Esta es una página web desarrollada como parte del curso de Desarrollo Web Full Stack. Es un proyecto inicial que he creado aplicando los conocimientos básicos adquiridos hasta el momento, utilizando HTML para la estructura del contenido,  CSS para el diseño y la presentación visual y Java Script para ciertas funciones. Con esta práctica estoy dando mis primeros pasos en la construcción de sitios web, aprendiendo a organizar la información, crear interfaces atractivas y mejorar mis habilidades técnicas para futuros proyectos más avanzados en el ámbito del desarrollo web.</p>
      `;
      break;

    case "javascript":
      contenido.innerHTML = `
        <h2>JavaScript</h2>
        <p>JavaScript añade interactividad y dinamismo a las páginas web.</p>
      `;
      break;

    default:
      contenido.innerHTML = `
        <h2>Bienvenido</h2>
        <p>Selecciona una sección del menú para ver el contenido.</p>
      `;
  }
}
