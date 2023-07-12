<?php

ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';
?>
<!--Contenido-->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Noticia <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Titulo</th>
                            <th>Contenido</th>
                            <th>Categoría</th>
                            <th>Contenido multimedia</th>
                            <th>Autor</th>
                            <th>Fecha publicación</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Titulo</th>
                            <th>Contenido</th>
                            <th>Categoría</th>
                            <th>Contenido multimedia</th>
                            <th>Autor</th>
                            <th>Fecha publicación</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Titulo(*):</label>
                            <input type="hidden" name="id_noticia" id="id_noticia">
                            <input type="hidden" name="id_usuario" id="id_usuario" value="<?=$_SESSION['id_usuario']?>">
                            <input type="text" class="form-control" name="titulo" id="titulo" maxlength="100" autocomplete="off" placeholder="Nombre" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Categoría(*):</label>
                            <select id="id_categoria" name="id_categoria" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Contenido multimedia(*):</label>
                            <select id="tipo_multimedia" name="tipo_multimedia" class="form-control selectpicker" data-live-search="true" required>
                                <option value="0">Seleccione una opción</option>
                                <option value="imagen">Imagen Externa</option>
                                <option value="video">Video Youtube</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12 hide" id="box_imagen">
                            <label>Ingrese la url de la imagen</label>
                            <input type="text" class="form-control" name="multimedia_imagen" id="multimedia_imagen" autocomplete="off" placeholder="Ingrese la url de la imagen">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12 hide" id="box_video">
                            <label>Ingrese sólo el código del video, ej: https://www.youtube.com/watch?v=<span class="codigo_video">qgaRVvAKoqQ</span></label>
                            <input type="text" class="form-control" maxlength="15" name="multimedia_video" id="multimedia_video" autocomplete="off" placeholder="Ingrese sólo el código del video">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Contenido(*):</label>
                            <textarea class="form-control" id="contenido" name="contenido" placeholder="Descripción" required></textarea>
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>
                        </form>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<?php
require 'footer.php';
?>
<script type="text/javascript" src="../assets/js/noticia.js"></script>
<?php 
}
ob_end_flush();
?>