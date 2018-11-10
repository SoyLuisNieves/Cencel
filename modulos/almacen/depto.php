<?php 
    require_once('../menu.php');

    if (isset($_POST['new_depto'])) { //Agregar departamento
        $departamento = $Almacen->new_categoria(); }

    if (isset($_POST['act_depto'])) { //Obtener datos departamentos por id    
      $udp_departamento = $Almacen->upd_depto(); 
  } if (isset($_POST['act_catalogo'])) { //Obtener datos departamentos por id    
      $upd_catalog = $Almacen->upd_catalogo();
      $upd_catalogd = $Almacen->upd_catalogo_dep();
  }

?> </section>

    <section class="content">
           <div class="block">
             <div class="row clearfix">
                <div class="col-md-8 col-sm-8">
                    <h2>
                        PRODUCTOS
                    </h2>
                </div>             

            <div class="" align="right">
               <a href="productos.php">
                <div id="enlaces">
                    <div class="info-box-3 bg-cyan hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">gps_fixed</i>
                        </div>
                        <div class="bton">
                            <div class="text">VER PRODUCTOS</div>
                        </div>
                    </div>
                </div>
               </a>               
                <a onclick="mostrar()">
                <div id="enlaces">
                    <div class="info-box-3 bg-teal hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">gps_fixed</i>
                        </div>
                        <div class="bton">
                            <div class="text">AGREGAR CATEGORIA</div>
                        </div>
                    </div>
                </div></a>
            </div>
          </div>
        </div>

            <form id="form_validation">
            </form>
              <!-- Fin formulario semantic -->
            
            <form class="" id='formoculto' style='display:none;' method="POST">
            <div class="seccion"><h3>Registrar <b>Departamento / categoría</b></h3></div>            
                
                <div class="ui form">
                    <div class="content">
                    <br>
                        <div class="form-group row clearfix">
                                <div class="col-md-4">
                                    <input type="radio" name="nivel" id="activo" class="with-gap" checked="" value="1" onchange="niveld()">
                                    <label for="activo">Departamento</label>
                                    <input type="radio" name="nivel" id="inactivo" class="with-gap" value="2" onchange="nivelca()">
                                    <label for="inactivo" class="m-l-20">Catalogo </label>
                                </div>
                                <div class="col-md-6" id="subcat" style="display: none;">
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
                                <div class="ui submit button red" onclick="ocultard()">CANCELAR</div>
                            </div>
                        </div><br>
                    </div>
                </div>
            </form>
                      

                    <div class="seccion"><h3>Listado <b>Departamentos y Catalogo</b></h3></div>
                    <br>
                    <div class="" align="center">
                        <input type="radio" name="tipo" id="depa" class="with-gap" checked="" onchange="tipod()">
                        <label for="depa">Departamentos</label>
                        <input type="radio" name="tipo" id="cata" class="with-gap" onchange="tipoc()">
                        <label for="cata" class="m-l-20">Catalogo de Productos </label>
                    </div>
                    <br>
                      <!-- Tabla_DEPARTAMENTOS -->
                        <div class="row clearfix" id="departamentos" style="display:">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="body borde2"> 
                                        <div class="">                                        
                                    <div class="body table-responsive"><form method="POST" action="act_depto.php">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th>DEPARTAMENTO</th>
                                                <th>No. CATALOGOS</th>
                                                <th>Status</th>

                                                <th></th>
                                                <th width="5px"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $departamento = $Almacen->get_departamentos();
                                            while($row = mysqli_fetch_array($departamento)){ ?>
                                                <td><?php echo $row['departamento']; ?></td>
                                                <?php $id=$row['id_departamento'];
                                                $dep_cat = $Almacen->get_dep_cat($id);
                                                $row = mysqli_fetch_array($dep_cat); ?>
                                                <td><?php echo $row['num']; ?></td>
                                                <td><?php if ($row['status']==1) {
                                                    echo "Activo";
                                                    } else { echo "Inactivo";} ?></td>
                                                <?php echo '<td width="7px"><button name="act_depto" value="'.$row['id_departamento'].'"><i class="material-icons">edit</i>
                                                </button></td>
                                                <td><button name="del_depto" value="'.$row['id_departamento'].'"><i class="material-icons">clear</i>
                                                </button>
                                                </td>' ?>
                                            </tr><?php }?>
                                        </tbody>
                                    </table></form></div>
                                    </div>                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Tabla_CATALOGOS -->
                        <div class="row clearfix" id="catalogos" style="display:none;">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="body borde2"> 
                                        <div class="">                                        
                                    <div class="body table-responsive"><form method="POST" action="act_depto.php">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th>DEPARTAMENTO</th>
                                                <th>CATALOGO</th>
                                                <th>status</th>
                                                <th></th>
                                                <th width="5px"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $categorias = $Almacen->get_categorias();
                                            while($row = mysqli_fetch_array($categorias)){ ?>
                                                <td><?php echo $row['departamento']; ?></td>   
                                                <td><?php echo $row['catalogo']; ?></td>
                                                <td><?php if ($row['status']==1) {
                                                    echo "Activo";
                                                    } else { echo "Inactivo";} 
                                                echo '</td>
                                                <td width="7px"><button name="act_catalog" value="'.$row['id_catalogo'].'" ><i class="material-icons">edit</i>
                                                </button></td>
                                                <td><button name="del_catalog" value="'.$row['id_catalogo'].'"><i class="material-icons">clear</i>
                                                </button>
                                                </td>
                                            </tr>';  }?>
                                        </tbody>
                                    </table></form></div>
                                    </div>                        
                                    </div>
                                </div>
                            </div>
                        </div>



<script type="text/javascript">
function nivelca(){

    divT = document.getElementById("subcat");
    divT.style.display = "";
    divT = document.getElementById("tipo");
    divT.style.display = "";
}
</script>
<script type="text/javascript">
function niveld(){

    divT = document.getElementById("subcat");
    divT.style.display = "none";
    divT = document.getElementById("tipo");
    divT.style.display = "none";
}
</script>
<script type="text/javascript">
function tipoc(){

    divT = document.getElementById("departamentos");
    divT.style.display = "none";
    divT = document.getElementById("catalogos");
    divT.style.display = "";
}
</script>
<script type="text/javascript">
function tipod(){

    divT = document.getElementById("departamentos");
    divT.style.display = "";
    divT = document.getElementById("catalogos");
    divT.style.display = "none";
}
</script>

<script type="text/javascript">
function ocultard(){
    divT = document.getElementById("formoculto");
    divT.style.display = "none";
}
</script>

    <script src="../../plugins/jquery/jquery.min.js"></script>
     <script src="../../js/pages/tables/jquery-datatable.js"></script>
     
 <?php require_once('../footer.php');?>