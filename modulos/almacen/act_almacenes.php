<?php 
    require_once('../menu.php');
    
     if (isset($_POST['delete'])) { //Obtener datos almacen por id    
      $del_almacenes = $Almacen->del_almacen(); 
      print "<script>alert(\"Registro Eliminado.\");window.location='almacenes.php';</script>";
    }

?> </section>


    <section class="content">
        <div class="container-fluid">
            <div class="block">
             <div class="row clearfix">
                <div class="col-md-6">
                    <h2>
                        ALMACENES
                    </h2>
                </div>
             </div>
            </div>
            <form id="form_validation">
            </form>

<!-- INICIO FORMULARIO ACTUALIZAR -->

<form class="ui form" method="POST" action="almacenes.php">
            <div class="seccion"><h3>Modificar <b>Almacen</b></h3></div>
                <div class="ui">
                    <div class="ui form content">
                    <?php
                        $almacenes = $Almacen->get_almacen();
                        $row = mysqli_fetch_array($almacenes) ?>
                            <div class="fields borde">
                                <div class="two wide field">
                                    <input style="display:none;" type="text" class="" name="id" value="<?php echo $row['id_almacen'];?>" required>
                                    <div class="form-group form-float ">
                                        <label class="form-label">Clave</label>
                                        <input type="text" class="" name="clave" value="<?php echo $row['clave']; ?>" required>
                                    </div>
                                </div>
                                <div class="six wide field">
                                    <div class="form-group form-float ">
                                        <label class="form-label">Almacén</label>
                                        <input type="text" class="" name="almacen" value="<?php echo $row['almacen']; ?>" required>
                                    </div>
                                </div>
                                <div class="nine wide field">
                                    <div class="form-group form-float">
                                        <label class="form-label">Dirección</label>
                                        <input type="text" class="" name="direccion" value="<?php echo $row['direccion']; ?>" required>
                                    </div>
                                </div>                                
                            </div>
                            <div class="fields borde">
                                <div class="nine wide field">
                                    <div class="form-group form-float">
                                        <label class="form-label">Contacto</label>
                                        <input type="text" class="" name="contacto" value="<?php echo $row['contacto']; ?>" required>
                                    </div>
                                </div>
                                <div class="three wide field">
                                    <div class="form-group form-float ">
                                        <label class="form-label">Telefono 1</label>
                                        <input type="text" class="" name="tel1" value="<?php echo $row['telefono1']; ?>" required>
                                    </div>
                                </div>
                                <div class="three wide field">
                                    <div class="form-group form-float ">
                                        <label class="form-label">Telefono 2</label>
                                        <input type="text" class="" name="tel2" value="<?php echo $row['telefono2']; ?>">
                                    </div>
                                </div>
                            </div>
                            <!--<div class="form-group">
                                <div><input type="radio" name="status" id="activo" class="with-gap" checked="" value="1">
                                    <label for="activo">Activo </label>
                                    <input type="radio" name="status" id="inactivo" class="with-gap" value="0">
                                    <label for="inactivo" class="m-l-20">Inactivo </label>
                                </div>
                            </div>-->
                            <div align="center">
                                <button name="act_almacen" class=" ui submit button Green btn" type="submit">ACTUALIZAR</button>
                                <a href="almacenes.php" class="ui submit button red">CANCELAR</a>
                            </div>
                            <hr>
                        <!-- Basic Validation -->
                    </div>
                </div></form>

    <!-- FIN FORMULARIO ACTUALIZAR-->


<script src="../../plugins/jquery/jquery.min.js"></script>
     
 <?php require_once('../footer.php');?>