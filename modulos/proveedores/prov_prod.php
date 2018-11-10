<?php 
    require_once('../menu.php'); ?>

    <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
    
<?php 

    if(isset($_POST['prov_producto'])){
        echo $Proveedor->new_liga_proveedor();
    }
    if(isset($_POST['del_registro'])){
        $Proveedor->delete_prov_prod();
    }
    
 ?>
?> </section>

    <section class="content">
            <div class="block">
               <div class="row clearfix">
                <div class="col-md-6">
                    <h2>
                        PROVEEDORES Y PRODUCTOS
                    </h2>
                </div>
                <div class="" align="right">
                    <a class="" href="directorio.php" ">
                        <div  id="enlaces">                       
                            <div class="info-box-3 hover-zoom-effect bg-cyan">
                                <div class="icon">
                                    <i class="material-icons">add_circle_outline</i>
                                </div>
                                <div class="bton">
                                    <div class="text">VER PROVEEDORES</div>
                                </div>
                            </div>                        
                        </div>
                    </a>
                    <a id="ligar">
                    <div  id="enlaces">
                        <div class="info-box-3 bg-teal hover-zoom-effect">
                            <div class="icon">
                                <i class="material-icons">gps_fixed</i>
                            </div>
                            <div class="bton">
                                <div class="text">ASOCIAR</div>
                            </div>
                        </div>
                    </div>
               </a> 
                </div>
             </div>
            </div>
            <form id="form_validation">
            </form>
            


            <!-- LIGAR formulario para relacionar al proveedor con sus productos -->

                <div class="ui" id="form_ligar">
                    <div class="seccion"><h3>Asociar Proveedor-Departamento</b></h3></div>
                    <br>
                    <form action="prov_prod.php" method="POST">
                    <div class="esp2">                    
                        <div class="ui form">
                            <div class="body">                        
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                </div>
                                <div class="col-sm-3">
                                    <label class="form-label">Proveedor</label><br>
                                    <select class="ui fluid dropdown" NAME="proveedor">
                                        <option value=""> - Selecciona Proveedor- </option>
                                        <?php $prov = $Proveedor->get_proveedores();
                                            while($row = mysqli_fetch_array($prov)){ ?>                                      
                                      <option value=<?php echo '"'.$row['id_proveedor'].'"'; ?> ><?php echo $row['proveedor']; ?></option> <?php }?>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label class="form-label">Departamento</label><br>
                                    <select class="ui fluid dropdown" NAME="cat">
                                        <option value=""> - Selecciona categoría- </option>
                                        <?php $depto = $Almacen->get_depto();
                                            while($row = mysqli_fetch_array($depto)){ ?>                                      
                                      <option value=<?php echo '"'.$row['id_departamento'].'"'; ?> ><?php echo $row['departamento']; ?></option> <?php }?>
                                    </select>
                                </div>                                
                            </div><br>

                                </div>
                            </div>
                        </div>
                        <div align="center">
                            <input class="ui submit button green btn" name="prov_producto" type="submit" value="Asociar">
                            <button class="ui submit button red btn" id="cancelar_registrar">Cancelar</button>
                        </div>
                    </form>
                </div><br>


              <!-- Fin formulario semantic -->

                <div class="ui" id="form_directorio">
                    <div class="seccion"><h3>Productos y <b>Proveedores</b></h3></div>
                <br>
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="body borde2">
                                    <div class="body table-responsive"><form method="POST" action="prov_prod.php">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th width="10px">Clave</th>
                                                <th>Proveedor</th>
                                                <th>Departamento</th>
                                                <th>Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $proveedores = $Proveedor->get_prov_prod(); 
                                         while($row = mysqli_fetch_array($proveedores)){ ?>
                                            <tr>
                                                <td align="center"><?php echo $row['clave_prov']; ?></td>
                                                <td><?php echo $row['proveedor']; ?></td>
                                                <td><?php echo $row['departamento']; 
                                                echo '</td>                                                
                                                <td width="7px" align="center">
                                                <button name="del_registro"><i class="material-icons">delete</i>
                                                    <input name="id_prov" value="'.$row['id_proveedor'].'" style="display: none">
                                                    <input name="id_prod" value="'.$row['id_departamento'].'" style="display: none">
                                                </button>
                                                </td>
                                            </tr>';  }?>
                                        </tbody>
                                    </table>

                                    </form>
                                </div></div>
                        </div>
                            
                            </div>
                        </div>
                </div>

                

                <!-- Formulario Registrar Proveedor -->

    </section>
    <script type="text/javascript">

    $(document).ready(function(){

        // Inicializacion
        $("#form_registrar").hide();
        $("#form_buscar").hide();
        $("#form_bloquear").hide();
        $("#form_modificar").hide();
        $("#form_ligar").hide();

        // Funciones
        $("#nuevo_usuario").on("click", function(){
            $("#form_registrar").show(400);
            $("#principal").hide();
            $("#form_directorio").hide();
            $("#form_modificar").hide();
            $("#form_ligar").hide();
        });

        $("#buscar_usuario").on("click", function(){
            $("#form_buscar").show(400);
            $("#principal").hide();
            $("#form_registrar").hide();
            $("#form_modificar").hide();
        });

        $("#ligar").on("click", function(){
            $("#form_ligar").show(400);
            $("#principal").hide();
            $("#form_registrar").hide();
            $("#form_modificar").hide();
        });

        $("#bloquear_usuario").on("click", function(){
            $("#form_bloquear").show(400);
            $("#principal").hide(400);
            $("#form_registrar").hide();
            $("#form_modificar").hide();

        })



        // Cancelar
        $("#cancelar_registrar").on("click", function(){
            $("#form_registrar").hide();
            $("#principal").show(400);
            $("#form_directorio").show(400)
        });
        $("#cancelar_buscar").on("click", function(){
            $("#form_buscar").hide();
            $("#principal").show();
        });
        
        $("#cancelar_bloquear").on("click", function(){
            $("#form_bloquear").hide();
            $("#form_directorio").hide()
            $("#form_registrar").hide();
            $("#principal").show(400);
        });
    });

  


  </script>

   <script src="../../plugins/jquery/jquery.min.js"></script>
     <script src="../../js/pages/tables/jquery-datatable.js"></script>
     
 <?php require_once('../footer.php');?>
    