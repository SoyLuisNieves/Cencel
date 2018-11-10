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
               <a href="n_depto.php">
                <div id="enlaces">
                    <div class="info-box-3 bg-teal hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">gps_fixed</i>
                        </div>
                        <div class="bton">
                            <div class="text">CREAR CATEGORIA</div>
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
            
  <!-- ==============================  ==================== -->

  <?php if (isset($_POST['reg_prod'])) { 
        $cate = $Almacen->reg_cat();
            $row = mysqli_fetch_array($cate);
            $cat=$row['catalogo'];
        $producto = $Almacen->new_producto($cat); }
    if (isset($_POST['delete'])) {   
      $prodcutodel = $Almacen->del_prod(); }
     if(isset($_POST['actualizar_prod'])){
            $cate = $Almacen->reg_cat();
            $row = mysqli_fetch_array($cate);
            $cat=$row['catalogo'];
             $prodcutoudp = $Almacen->upd_prod($cat);
            }
    if (isset($_POST['actualizar'])) {   
            ?>
    <!-- ============================== ACTUALIZAR PRODUCTOS ==================== -->
            
      <?php require_once('act_producto.php'); } else { ?> 
    
<!-- ============================== CATALOGO PRODUCTOS ==================== -->
<div id="cat_prod" style="display: ;">
<div class="seccion"><h3>Buscar Catalogo de Productos</h3></div>
                <div class="ui">
                    <div class="ui form content">
                        <div class="row clearfix " align="center">
                            <div class=" col-md-3">
                                <label>Departamento</label><br>
                                <select class="ui fluid dropdown" name="cat" onchange="return buscar()" id="depto">
                                    <?php $deptos = $Almacen->get_categorias_sel();
                                        $row = mysqli_fetch_array($deptos)?>
                                        <option value=<?php echo '"'.$row['id_departamento'].'"'; ?>><?php echo $row['departamento']; ?></option>
                                        <option value="0">TODOS</option>
                                          <?php  $depto = $Almacen->get_depto();
                                            while($row = mysqli_fetch_array($depto)){ ?>                            
                                            <option value=<?php echo '"'.$row['id_departamento'].'"'; ?>><?php echo $row['departamento']; ?></option>
                                        <?php }?>
                                </select>
                            </div>
                            <div class=" col-md-3">
                                   <label>Catalogo </label><br>
                                    <select class="ui fluid dropdown" name="subcat" onchange="return buscarc()" id="catalogo">
                                         <?php $categoriass = $Pedidos->get_catalogo_sel();
                                            $row = mysqli_fetch_array($categoriass) ?>
                                      <option value=<?php echo '"'.$row['id_catalogo'].'"'; ?>><?php echo $row['catalogo']; ?></option>
                                        <?php $categorias = $Almacen->get_categorias_dep();
                                            while($row = mysqli_fetch_array($categorias)){ ?>
                                      <option value=<?php echo '"'.$row['id_catalogo'].'"'; ?>><?php echo $row['catalogo']; ?></option> <?php }?>
                                    </select>
                            </div><br>
                            <div class=" col-md-4"></div>                          
                            <div class=" col-md-2" align="right"><br>
                                <a onclick="editar()" id="editar" style="display: ;">
                                   <div class="info-box-3 bg-blue-grey hover-zoom-effect" style="width: 100px; height: 35px;">
                                        <div class="icon">
                                            <i class="material-icons">edit</i>
                                        </div>
                                            <div class="btone">EDITAR</div>
                                    </div>
                                </a>
                                <a onclick="imprimirp()" id="imprimir" style="display: none;">
                                   <div class="info-box-3 bg-blue-grey hover-zoom-effect" style="width: 100px; height: 35px;">
                                        <div class="icon">
                                            <i class="material-icons">get_app</i>
                                        </div>
                                            <div class="btone">EXPORTAR</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                        
                                <div class="card">
                                    <div class="body borde2">
                                    <div class="body table-responsive">

                                    <div class="" style="display: ;" id="mostrarp">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <tr>
                                                <th>Clave</th>
                                                <th>Producto</th>
                                                <th>Marca</th>
                                                <th>Modelo</th>
                                                <th>Color</th>
                                                <th>Tamaño</th>
                                                <th>CO</th>
                                                <th>MA</th>
                                                <th>MM</th>
                                                <th>DS</th>
                                                <th>MB</th>
                                                <th>PB</th>
                                              </tr></thead>
                                              <tbody><div style="display: none;">
                                                <?php if (isset($_POST['subcat'])) { //Buscar prodcutos  
                                                 $productos = $Almacen->get_productos();
                                             }elseif (isset($_POST['cat'])) { //Buscar prodcutos  
                                                    if ($_POST['cat']==0) {
                                                        $productos = $Almacen->get_productos_all();
                                                    }else{$productos = $Almacen->get_productos_dep();}  
                                             }else{  $productos = $Almacen->get_productos_all();}
                                            while($row = mysqli_fetch_array($productos)){ ?>
                                                <tr class="">
                                                    <td><?php echo $row['cve'];?></td>
                                                    <td><?php echo $row['catalogo'];?></td>
                                                    <td><?php echo $row['marca']; ?></td>
                                                    <td><?php echo $row['modelo']; ?></td>
                                                    <td><?php echo $row['color']; ?></td>
                                                    <td><?php echo $row['tamano']; ?></td>
                                                    <td><?php echo $row['co']; ?></td>
                                                    <td><?php echo $row['ma']; ?></td>
                                                    <td><?php echo $row['mm']; ?></td>
                                                    <td><?php echo $row['ds']; ?></td>
                                                    <td><?php echo $row['mb']; ?></td>
                                                    <td><?php echo $row['pb'];  echo '</td>
                                            </tr>';  }?></div>
                                        </tbody>
                                    </table></div>
                        <!-- ====================== TABLA PARA EDITAR PRODUCTOS ===================== -->

                                    <div class="" style="display: none;" id="editarp">
                                    <form method="POST" action="productos.php">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th>Clave</th>
                                                <th>Producto</th>
                                                <th>Clase</th>
                                                <th>Marca</th>
                                                <th>Modelo</th>
                                                <th>Color</th>
                                                <th>Tamaño</th>
                                                <th width="5px"></th>
                                                <th width="5px"></th>
                                              </tr></thead>
                                              <tbody><div style="display: none;">
                                                <?php if (isset($_POST['subcat'])) { //Buscar prodcutos  
                                                 $productos = $Almacen->get_productos();
                                             }elseif (isset($_POST['cat'])) { //Buscar prodcutos  
                                                    if ($_POST['cat']==0) {
                                                        $productos = $Almacen->get_productos_all();
                                                    }else{$productos = $Almacen->get_productos_dep();}  
                                             }else{  $productos = $Almacen->get_productos_all();}
                                            while($row = mysqli_fetch_array($productos)){ ?>
                                                <tr class="">
                                                    <td><?php echo $row['cve'];?></td>
                                                    <td><?php echo $row['catalogo'];?></td>
                                                    <td><?php echo $row['clase'];?></td>
                                                    <td><?php echo $row['marca']; ?></td>
                                                    <td><?php echo $row['modelo']; ?></td>
                                                    <td><?php echo $row['color']; ?></td>
                                                    <td><?php echo $row['tamano'];  echo '</td>
                                                <td width="7px"><button name="actualizar" value="'.$row['cve'].'" onclick="mostraract()"><i class="material-icons">edit</i>
                                                </button></td>
                                                <td><button name="delete" value="'.$row['cve'].'"><i class="material-icons">delete</i>
                                                </button>
                                                </td>
                                            </tr>';  }?></div>
                                        </tbody>
                                    </table></form></div>
                                    </div></div>
                            </div>
                            
                          <!-- FIN TABLA PRODUCTOS -->
            </div><?php } ?>

   <script src="../../plugins/jquery/jquery.min.js"></script>



    <!-- Jquery DataTable Plugin Js -->
    <!--<script src="../../plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="../../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>-->

    <script src="../../js/pages/tables/jquery-datatable.js"></script>

    <script type="text/javascript">
function editar(){

    divT = document.getElementById("editarp");
    divT.style.display = "";
    divT = document.getElementById("mostrarp");
    divT.style.display = "none";
    divT = document.getElementById("imprimir");
    divT.style.display = "";    
    divT = document.getElementById("editar");
    divT.style.display = "none";
}
</script>
    <script type="text/javascript">
function imprimirp(){

    divT = document.getElementById("editarp");
    divT.style.display = "none";
    divT = document.getElementById("mostrarp");
    divT.style.display = "";
    divT = document.getElementById("imprimir");
    divT.style.display = "none";
    divT = document.getElementById("editar");
    divT.style.display = "";
}
</script>

    <?php require_once('../footer.php');?>