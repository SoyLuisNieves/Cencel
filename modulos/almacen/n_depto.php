<?php 
    require_once('../menu.php');
    
    ?>

</section>

  <!-- ============================== OPCIONES  ==================== -->
            
<section class="content">
    <div class="block">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-2 col-sm-6 col-xs-12">
                    <h2>
                        PRODUCTOS
                    </h2>
            </div>                      
            <div class="" align="right">
                <a href="n_producto.php">
                <div  id="enlaces">
                    <div class="info-box-3 bg-cyan hover-zoom-effect green">
                        <div class="icon">
                            <i class="material-icons">gps_fixed</i>
                        </div>
                        <div class="bton">
                            <div class="text">AGREGAR PRODUCTO</div>
                        </div>
                    </div>
                </div></a>
               <a href="productos.php" ">
                <div id="enlaces">
                    <div class="info-box-3 bg-teal hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">gps_fixed</i>
                        </div>
                        <div class="bton">
                            <div class="text">BUSCAR PRODUCTO<</div>
                        </div>
                    </div>
                </div>
               </a>
               <a href="depto.php">
                <div  id="enlaces">
                    <div class="info-box-3 bg-teal hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">gps_fixed</i>
                        </div>
                        <div class="bton">
                            <div class="text">EDITAR CATEGORIA</div>
                        </div>
                    </div>
                </div>
               </a> 
            </div>
          </div>
        </div>
        <form id="form_validation"></form>
    <!-- ============================== CREAR CATEGORIA ==================== -->

            <form class="" method="POST" action="depto.php">            
            <div class="seccion"><h3>Registrar <b>Departamento / categoría</b></h3></div>            
                <div class="ui form">
                    <!--<div class="four wide field">
                        <br>
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Iasmani Pinazo </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Account Settings</a></li>
                                <li class="divider"></li>
                                <li><a href="#">User stats</a> </li>
                                <li class="divider"></li>
                                <li><a href="#">Messages</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Favourites Snippets </a></li>
                                <li class="divider"></li>
                                <li><a href="#">Sign Out</a></li>
                              </ul>
                            </li>
                          </ul>
                    </div>-->
                    <div class="content">
                        <div class="form-group row clearfix"><br>
                                <div class="col-md-6">
                                    <input type="radio" name="nivel" id="activo" class="with-gap" checked="" value="1" onchange="nivelo()">
                                    <label for="activo">Departamento</label>
                                    <input type="radio" name="nivel" id="inactivo" class="with-gap" value="2" onchange="nivelc()">
                                    <label for="inactivo" class="m-l-20">Catalogo </label>
                                </div>
                                <div class="col-md-6" id="subcate" style="display: none;">
                                    <select class="ui fluid dropdown" NAME="cat">
                                        <option value=""> - Selecciona Departamento - </option>
                                        <?php $depto = $Almacen->get_depto();
                                            while($row = mysqli_fetch_array($depto)){ ?>                                      
                                      <option value=<?php echo '"'.$row['id_departamento'].'"'; ?> ><?php echo $row['departamento']; ?></option> <?php }?>
                                    </select>
                                </div>
                        </div>
                        <div class="row clearfix borde">
                            <div class="col-md-8">
                                <div class="form-group form-float ">
                                    <label class="form-label">Nombre Categoría</label>
                                    <input type="text" class="" name="categoria" placeholder="Categoría" required>
                                </div>
                                <div class="form-group form-float" id="tipo" style="display: none;">
                                        <input type="radio" name="tipo"  id="cantidades" value="0" class="with-gap" checked>
                                        <label for="cantidades">Cantidades </label>
                                        <input type="radio" name="tipo" id="iccid" value="1" class="with-gap">
                                        <label for="iccid" class="m-l-20">ICCID </label>
                                        <input type="radio" name="tipo" id="imei" value="2" class="with-gap">
                                        <label for="imei" class="m-l-20">IMEI </label>
                                    </div>
                            </div>
                            <div  align="right" class="col-md-4"><br>
                                <input type="submit" name="new_depto" class=" ui submit button Green btn" value="REGISTRAR">
                                <a class="ui submit button red" href="productos.php">CANCELAR</a>
                            </div>
                        </div><br>
                    </div>
                </div>
            </form>

  <!-- ==============================  ==================== -->

 
<script src="../../plugins/jquery/jquery.min.js"></script>
     
 <?php require_once('../footer.php');?>