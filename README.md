SISTEMA DE NOTICIAS

Creación de un gestor y visualizador de noticias.
Requisitos

    PHP >= 5.4
    MySQL >= 5.5
    XAMPP (Entorno de desarrollo local)

Instalación

    Descarga e instala XAMPP desde el sitio web oficial: https://www.apachefriends.org/index.html.
    Inicia XAMPP y asegúrate de que los servicios de Apache y MySQL estén en ejecución.
    Clona o descarga el repositorio en el directorio htdocs de tu instalación de XAMPP.        
    Crea una base de datos MySQL para el proyecto.
    Ubicar el archivo de la base de datos ubicado en la carpeta db/noticias.sql e importa el archivo SQL proporcionado en la base de datos recién creada.
    Configura la conexión a la base de datos en el archivo de configuración config/global.php
    Abre tu navegador web y accede al proyecto en tu servidor local o en el entorno de producción (Administrador): http://localhost/noticias/view/login.html
    Abre tu navegador web y accede al proyecto en tu servidor local o en el entorno de producción (Visualizador): http://localhost/noticias/view/news.php

Funcionalidades

    Creación de categorías, usuarios, perfil, noticias.
    Visualizador de noricias con sus categorías.

Estructura de directorios

    /css: Contiene los archivos CSS utilizados en el proyecto.
    /js: Contiene los archivos JavaScript utilizados en el proyecto.
    /img: Contiene las imágenes utilizadas en el proyecto.
    /controller: Contiene los archivos PHP que se encargan de manejar las solicitudes del usuario.
    /model: Contiene los archivos PHP que representan la lógica del negocio y la interacción con la base de datos.
    /View: Contiene los archivos PHP o plantillas que se utilizan para presentar la interfaz de usuario al usuario final.
    /config/global.php: Archivo de configuración de la base de datos.
    /db/noticias.sql: Archivo de la base de datos.
    /view/login.html: Página de inicio del sistema (Administrador).
    /view/news.php: Página de inicio del sistema (Visualizador).

Accesos
    usuario y clave: admin
    usuario y clave: periodista

Autor

    David Ponce Caro
    dmep2012@gmail.com


