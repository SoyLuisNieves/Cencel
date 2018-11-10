<?php 
    require_once('../menu.php');

?> </section>


    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
             <div class="row clearfix">
                <div class="col-md-6">
                    <h2>
                        Proveedor
                    </h2>
                </div>
             </div>
            </div>
            <form id="form_validation">
            </form>

  <?php  if(isset($_POST['lock'])){
        // $Proveedor->new_proveedor();
       $pro = $Proveedor->proveedor_inactivo();
       print "<script>alert(\"Proveedor Inactivo.\");window.location='directorio.php';</script>";
    }
    if(isset($_POST['open'])){
        $Proveedor->proveedor_activo();
        print "<script>alert(\"Proveedor Activo.\");window.location='directorio.php';</script>";
    } ?>

<!-- INICIO FORMULARIO ACTUALIZAR -->

<form class="ui form" method="POST" action="directorio.php">
            <div class="seccion"><h3>Modificar <b>Proveedor</b></h3></div>
                <div class="ui">
                    <div class="ui form content">
                    <?php
                        $proveedores = $Proveedor->get_proveedor();
                        $row = mysqli_fetch_array($proveedores) ?>
                            <div class="fields borde">
                                <div class="two wide field">
                                    <input style="display:none;" type="text" class="" name="id_proveedor" value="<?php echo $row['id_proveedor'];?>" required>
                                    <div class="form-group form-float ">
                                        <label class="form-label">Clave</label>
                                        <input type="text" class="" name="clave" value="<?php echo $row['clave_prov']; ?>" required>
                                    </div>
                                </div>
                                <div class="six wide field">
                                    <div class="form-group form-float ">
                                        <label class="form-label">Proveedor</label>
                                        <input type="text" class="" name="proveedor" value="<?php echo $row['proveedor']; ?>" required>
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
                                        <label class="form-label">Sitio</label>
                                        <input type="text" class="" name="sitio" value="<?php echo $row['sitio']; ?>" required>
                                    </div>
                                </div>
                                
                                <div class="three wide field">
                                    <div class="form-group form-float ">
                                       <label class="form-label">Telefono 1</label>
                                        <input type="text" class="" name="telefono" value="<?php echo $row['telefono']; ?>" required>
                                    </div>
                                </div>
                                <div class="three wide field">
                                    <div class="form-group form-float ">
                                        <label class="form-label">Telefono 2</label>
                                        <input type="text" class="" name="telefono2" value="<?php echo $row['telefono2']; ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div><input type="radio" name="status" id="activo" class="with-gap" checked="" value="1">
                                    <label for="activo">Activo </label>
                                    <input type="radio" name="status" id="inactivo" class="with-gap" value="0">
                                    <label for="inactivo" class="m-l-20">Inactivo </label>
                                </div>
                            </div>
                            <div align="center">
                                <button name="act_proveedor" class=" ui submit button blue btn" type="submit">ACTUALIZAR</button>
                                <a href="directorio.php" class="ui submit button red">CANCELAR</a>
                            </div>
                            <hr>
                        <!-- Basic Validation -->
                    </div>
                </div></form>

    <!-- FIN FORMULARIO ACTUALIZAR-->


<script src="../../plugins/jquery/jquery.min.js"></script>
     
 <?php require_once('../footer.php');?>