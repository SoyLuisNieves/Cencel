<?php 
    require_once('../menu.php'); 
    ?>

    <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
    
    <?php
    if(isset($_POST['n_proveedor'])){
        // $Proveedor->new_proveedor();
       $pro = $Proveedor->new_depa_prov();
    }
    if(isset($_POST['act_proveedor'])){
        $Proveedor->upt_proveedor();
    }
    
 ?>
</section>

    <section class="content">
        <div class="block">
               <div class="row clearfix">
                <div class="col-md-6">
                    <h2>
                        PROVEEDORES
                    </h2>
                </div>
                <div class="" align="right">
                    <div  id="enlaces">
                        <a class="" id="nuevo_proveedor">
                            <div class="info-box-3 hover-zoom-effect bg-cyan">
                                <div class="icon">
                                    <i class="material-icons">add_circle_outline</i>
                                </div>
                                <div class="bton">
                                    <div class="text">NUEVO PROVEEDOR</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <a href="prov_prod.php">
                    <div  id="enlaces">
                        <div class="info-box-3 bg-teal hover-zoom-effect">
                            <div class="icon">
                                <i class="material-icons">gps_fixed</i>
                            </div>
                            <div class="bton">
                                <div class="text">LIGAR PROVEEDOR </div>
                            </div>
                        </div>
                    </div>
               </a> 
                </div>
             </div>
            </div>

           <br>


            <form id="form_validation">
            </form>
            

              <!-- Fin formulario semantic -->
                <div class="ui" id="form_directorio">
                    <div class="seccion"><h3>LISTADO DE <b>PROVEEDORES</b></h3></div>
                <br>
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="body borde2">
                                    <div class="body table-responsive"><form method="POST" action="act_proveedor.php">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th>Clave</th>
                                                <th>Proveedor</th>
                                                <th>Telefono</th>
                                                <th>Sitio</th>
                                                <th>Status</th>
                                                <th><i class="material-icons">lock / lock_open</i></th>
                                                <th><i class="material-icons">edit</i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $proveedores = $Proveedor->get_proveedores(); 
                                         while($row = mysqli_fetch_array($proveedores)){ ?>
                                            <tr>
                                                <td><?php echo $row['clave_prov']; ?></td>
                                                <td><?php echo $row['proveedor']; ?></td>
                                                <td><?php echo $row['telefono']; ?></td>
                                                <td><?php echo $row['sitio']; ?></td>
                                                <td>
                                                    <?php
                                                        if ($row['status']==1) {
                                                            echo 'Activo';
                                                        }else{
                                                            echo "Inactivo";
                                                        }
                                                echo '</td>
                                                <td width="7px"><button name="lock" value="'.$row['id_proveedor'].'"><i class="material-icons">lock</i>
                                                </button>
                                                <button name="open" value="'.$row['id_proveedor'].'"><i class="material-icons">lock_open</i>
                                                </button>
                                                </td>
                                                <td width="7px"><button name="act_proveedor" value="'.$row['id_proveedor'].'"><i class="material-icons">edit</i></button></td>
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
                <div id="form_registrar">
                    <div class="seccion"><h3>Registrar <b>Proveedor</b></h3></div><br>
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="esp2"> 
                    <div class="ui form">
                        <div class="body">
                             <h4 class="card-inside-title">Datos Generales</h4>
                            <form action="" method="post">
                            <div class=" card borde row clearfix">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="">
                                            <label for="">Departamento</label>
                                            
                                            <select name="id_departamento" id="">
                                                <option value="">- Selecciona - </option>
                                                <?php $departamentos = $Departamento->get_departamentos();
                                            while($row = mysqli_fetch_array($departamentos)){ ?>          
                                            <option value=<?php echo '"'.$row['id_departamento'].'"'; ?> ><?php echo $row['departamento']; ?></option> <?php }?>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <div class="">
                                            <label for="">Clave</label>
                                            <input type="text" name="clave" class="" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="">
                                            <label for="">Proveedor</label>
                                            <input type="text" name="proveedor" class="" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="">
                                            <label for="">Telefono</label>
                                            <input type="text" name="telefono" class="" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" card borde row clearfix">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="">
                                            <label for="">Direccion</label>
                                            <input type="text" name="direccion" class="" placeholder="" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="">
                                            <label for="">Sitio</label>
                                            <input type="text" name="sitio" class="" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="">
                                            <label for="">Telefono 2</label>
                                            <input type="text" name="telefono2" class="" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <label for="">Status</label><br>
                                    <input type="radio" name="status" id="activo" class="with-gap" checked="" value="1">
                                    <label for="activo">Activo</label><br>
                                </div>
                            </div>

                                <div align="center">
                                    <input class="ui submit button green btn" name="n_proveedor" type="submit" value="Registrar">
                                    <button class="ui submit button red btn" id="cancelar_registrar">Cancelar</button>
                                </div>

                            </form>
                                            
                </div>
                
                </div>
                </div>
                
                <!-- Termina Formulario Registrar Usuario -->

           
                <!--Asociar PROVEEDOR - DEPARTAMENTO-->
               
                <!--TERMINA ASOCIAR PROVEEDOR DEPARTAMENTO-->


            </div>
    </div>            

            <!-- #END# Basic Validation -->
</div>

         

                
    <script type="text/javascript">

    $(document).ready(function(){

        // Inicializacion
        
        
        $("#form_directorio").show();
        $("#form_registrar").hide();


        // Funciones

        $("#nuevo_proveedor").on("click", function(){
            $("#form_registrar").show(400);
            $("#form_directorio").hide();
        });

    });

  


  </script>
   <script src="../../plugins/jquery/jquery.min.js"></script>
     <script src="../../js/pages/tables/jquery-datatable.js"></script>
     
 <?php require_once('../footer.php');?>