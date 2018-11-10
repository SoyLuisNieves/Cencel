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
                <a href="productos.php">
                <div  id="enlaces">
                    <div class="info-box-3 bg-cyan hover-zoom-effect green">
                        <div class="icon">
                            <i class="material-icons">gps_fixed</i>
                        </div>
                        <div class="bton">
                            <div class="text">BUSCAR PRODUCTO</div>
                        </div>
                    </div>
                </div></a>
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
   
          <!-- ============================== AGREGAR NUEVOS PRODUCTOS ==================== -->


              <form class="" style='display:;' method="POST" action="productos.php">
              <div class="seccion"><h3>Registrar <b>Productos</b></h3></div>
                    <div class="ui form content">
                        <div class="row clearfix" align="center">
                            <div class="col-md-3">
                                <div class="form-group form-float ">
                                    <label class="form-label">Departamento</label><br>
                                    <select class="ui fluid dropdown" name="cat" onchange="return buscar()" id="depto">
                                    <?php $deptos = $Almacen->get_categorias_sel();
                                        $row = mysqli_fetch_array($deptos)?>
                                        <option value=<?php echo '"'.$row['id_departamento'].'"'; ?>><?php echo $row['departamento']; ?></option>
                                          <?php  $depto = $Almacen->get_depto();
                                            while($row = mysqli_fetch_array($depto)){ ?>                            
                                            <option value=<?php echo '"'.$row['id_departamento'].'"'; ?>><?php echo $row['departamento']; ?></option>
                                        <?php }?>
                                </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-float" id="catalogop" style="display:;" onChange="clave(this)">
                                        <label class="form-label">Catalogo </label><br>
                                            <select class="ui fluid dropdown" name="sub" onchange="return buscarc()" id="catalogo">
                                                 <?php $categoriass = $Pedidos->get_catalogo_sel();
                                                    $row = mysqli_fetch_array($categoriass) ?>
                                              <option value=<?php echo '"'.$row['id_catalogo'].'"'; ?>><?php echo $row['catalogo']; ?></option>
                                                <?php $categorias = $Almacen->get_categorias_dep();
                                                    while($row = mysqli_fetch_array($categorias)){ ?>
                                              <option value=<?php echo '"'.$row['id_catalogo'].'"'; ?>><?php echo $row['catalogo']; ?></option> <?php }?>
                                            </select>
                                    </div>
                            </div>
                            <?php 
                    if (isset($_POST['subcat'])) { ?>
                            <div class="col-md-2 ui form" >
                                    <label class="form-label">Clave de Producto</label>
                                    <div class="mini">
                                        <input type="text" class="" name="clave" placeholder="Clave producto" style="size: 20;" required>
                                    </div>
                            </div>
                            <div class="col-md-3 form">                               
                                <div class="form-group form-float" align="center">
                                    <label class="form-label">Clase</label>
                                    <div class="mini">
                                        <input type="text" class="" name="clase" placeholder="Clase" style="size: 20;">
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>        <br>                     
                                    <div class="esp2 ">                                        
                                        <div class="row clearfix borde">
                                            <div class="col-md-3">
                                                <div class="form-group form-float ">
                                                    <label class="form-label">Marca</label>
                                                    <input type="text" class="" name="marca" placeholder="Marca" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group form-float ">
                                                    <label class="form-label">Modelo</label>
                                                    <input type="text" class="" name="modelo" placeholder="Marca" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group form-float ">
                                                    <label class="form-label">Color</label>
                                                    <input type="text" class="" name="color" placeholder="Marca">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group form-float ">
                                                    <label class="form-label">Tamaño</label>
                                                    <input type="text" class="" name="tamano" placeholder="Modelo" >
                                                </div>
                                            </div>
                                        </div> 
                                        </div>                         
                                        <div class="demo-masked-input borde borde4">
                                            <div class="row clearfix">
                                                <div class="col-md-4 col-sm-4">
                                                    <div class="form-group form-float">
                                                        <label class="form-label">Precio Costo </label>
                                                        $ <input type="number" class="" name="co" placeholder="" required>
                                                    </div>
                                                </div>                                
                                                <div class="col-md-4 col-sm-4">
                                                    <div class="form-group form-float ">
                                                        <label class="form-label">Precio Mayoreo</label>
                                                        $ <input type="number" class="" name="ma" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-4">
                                                    <div class="form-group form-float ">
                                                        <label class="form-label">Precio Medio Mayoreo </label>
                                                        $ <input type="number" class="" name="mm" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-4">
                                                    <div class="form-group form-float">
                                                        <label class="form-label">Precio Distribuidor</label>
                                                        $ <input type="number" class="" name="ds" placeholder="" >
                                                    </div>
                                                </div>                                
                                                <div class="col-md-4 col-sm-4">
                                                    <div class="form-group form-float ">
                                                        <label class="form-label">Precio Mueblería</label>
                                                        $ <input type="number" class="" name="mb" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-4">
                                                    <div class="form-group form-float ">
                                                        <label class="form-label">Precio Público</label>
                                                        $ <input type="number" class="" name="pb" placeholder="" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
                                    <br>
                                    <div align="center">
                                        <button name="reg_prod" class=" ui submit button Green btn" type="submit">REGISTRAR</button>
                                        <a class="ui submit button red" href="productos.php">CANCELAR</a>
                                    </div><br>
                            
                </div>
            </form>

    <script src="../../plugins/jquery/jquery.min.js"></script>
     
 <?php require_once('../footer.php');?>