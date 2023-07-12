

listarCategorias();

gallery();

$(document).ready(function() {    
    $(document).on("change", "input[name='shuffle-filter']", function() {
      var categoria = $(this).val();
  
      if (categoria === "all") {
        $(".shuffle-item").show();
      } else {
        $(".shuffle-item").hide();
        $(".shuffle-item[data-groups*='" + categoria + "']").show();
      }
    });
});



function listarCategorias(){
    $.ajax({
		url: "../controller/categoria.php?op=listarCategoriasActivas",
        type : "get",
        dataType : "json",		
        async: true,
        success: function(datos) {	
            var html = `
            <div class="btn-group btn-group-toggle " data-toggle="buttons">
                <label class="btn active ">
                    <input type="radio" name="shuffle-filter" value="all" checked="checked" />Todas las categorías
                </label>
            `;
            $.each(datos, function (i, w) {

                html += `
                    <label class="btn">
                        <input type="radio" name="shuffle-filter" value="${w.nombre}" />${w.nombre}
                    </label>
                `;

            });
            html += `
            </div>`;
            $("#category__buttons").append(html);
        }
    });    
}

function gallery(){
    var html = '';
    $.ajax({
		url: "../controller/noticia.php?op=listarNoticias",
        type : "get",
        dataType : "json",		
        async: true,
        success: function(datos) {	
            var multimedia = '';

            $.each(datos, function (i, w) {

                console.log(datos);

                if(w.tipo_multimedia == 'imagen'){
                    multimedia =  `<img width="350px" height="200px" class="img-fluid d-block" src="${w.multimedia}" alt="${w.titulo}">`;
                }else{
                    multimedia =  `<iframe width="350px" height="200px" src="https://www.youtube.com/embed/${w.multimedia}" title="${w.titulo}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; 
                        encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>`;
                }        
                    
                html += `                
                    <div class="col-xs-12 col-lg-4 mb-4 shuffle-item text-center" data-groups="[${w.categoria}]">
                        <div class="position-relative inner-box">
                            <div class="image position-relative ">
                                ${multimedia}
                            </div>
                            <div class="info_news">
                                <span class="artista">${w.titulo}</span>
                                <span class="lugar">${w.contenido}</span>
                                <span class="horario"><strong>Autor:</strong> ${w.nombre}</span>
                                <span class="horario"><strong>Fecha de publicación:</strong> ${w.fecha_publicacion}</span>
                            </div>
                        </div>
                    </div>`;
            });

        $("#portfolio__gallery").append(html);

        }
    });        
}

function filtrarPorCategoria(categoria) {
    if (categoria === "todos") {
        $(".shuffle-item").show(); 
    } else {
        $(".shuffle-item").hide(); 
        $(".shuffle-item[data-groups*='" + categoria + "']").show(); 
    }
}

$(document).on("click", ".filtro", function() {
    var categoria = $(this).data("categoria");
    filtrarPorCategoria(categoria);
});