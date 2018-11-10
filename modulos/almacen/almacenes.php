<?php 
    
    require_once('../menu.php');
    
    if (isset($_POST['n_almacen'])) { //Agregar nuevo almacen
        $almacenes = $Almacen->new_almacen(); }
    
    if (isset($_POST['act_almacen'])) { //Obtener datos almacen por id    
      $almacenes = $Almacen->upt_almacen(); }
    if (isset($_POST['activar_alm'])) { //Obtener datos almacen por id    
      $almacenes = $Almacen->act_almacen(); }
    
?> </section>
<style>
        .conv-upper{text-transform: uppercase;}
    </style>

    <section class="content">
            <div class="block">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-2 col-sm-6 col-xs-12">
                    <h2>
                        ALMACENES
                    </h2>
            </div>                      
            <div class="" align="right">
                <a onclick="mostrar()">
                <div  id="enlaces">
                    <div class="info-box-3 bg-cyan hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">gps_fixed</i>
                        </div>
                        <div class="bton">
                            <div class="text">NUEVO ALMACEN</div>
                        </div>
                    </div>
                </div></a>
                <a onclick="ocultar()">
                <div  id="enlaces">
                    <div class="info-box-3 bg-teal hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">gps_fixed</i>
                        </div>
                        <div class="bton">
                            <div class="text">VER ALMACENES</div>
                        </div>
                    </div>
                </div></a>
                <a onclick="inactivos()">
                <div  id="enlaces">
                    <div class="info-box-3 bg-red hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">gps_fixed</i>
                        </div>
                        <div class="bton">
                            <div class="text">VER INACTIVOS</div>
                        </div>
                    </div>
                </div></a>
            </div>
          </div>
        </div>

            <form id="form_validation">
            </form>
            <div >
            <form class="ui form" id='formoculto' style='display:none;' method="POST" action="almacenes.php">
            <div class="seccion"><h3>Agregar <b>Almacen</b></h3></div>
                <div class="ui">
                    <div class="ui form content">
                            <div class="fields borde">
                                <div class="two wide field">
                                    <div class="form-group form-float ">
                                        <label class="form-label">Clave</label>
                                        <input type="text" class="" name="clave" placeholder="Clave" required>
                                    </div>
                                </div>
                                <div class="six wide field">
                                    <div class="form-group form-float ">
                                        <label class="form-label">Almacén</label>
                                        <input type="text" class="" name="almacen" placeholder="Almacén" required>
                                    </div>
                                </div>
                                <div class="nine wide field">
                                    <div class="form-group form-float">
                                        <label class="form-label">Dirección</label>
                                        <input type="text" class="" name="direccion" placeholder="Dirección de Almacén" required>
                                    </div>
                                </div>                                
                            </div>
                            <div class="fields borde">
                                <div class="nine wide field">
                                    <div class="form-group form-float">
                                        <label class="form-label">Contacto</label>
                                        <input type="text" class="" name="contacto" placeholder="Contacto Almacén" required>
                                    </div>
                                </div>
                                <div class="three wide field">
                                    <div class="form-group form-float ">
                                        <label class="form-label">Telefono 1</label>
                                        <input type="text" class="" name="tel1" placeholder="" required>
                                    </div>
                                </div>
                                <div class="three wide field">
                                    <div class="form-group form-float ">
                                        <label class="form-label">Telefono 2</label>
                                        <input type="text" class="" name="tel2" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div align="center">
                                <button name="n_almacen" class="ui submit button Green btn" type="submit">REGISTRAR</button>
                                <div class="ui submit button red" onclick="ocultar()">CANCELAR</div>
                            </div>
                            <hr>
                        <!-- Basic Validation -->
                    </div>
                </div></form></div>
<!-- FIN FORMULARIO AGREGAR -->

                <div style="display: none;" id="inactivos">
                    <?php require_once('almacenes_inactivos.php'); ?>
                </div>
              <!-- Fin formulario semantic -->
                <div class="" id="activos">
                <div class="seccion"><h3>Listado <b>Almacenes</b></h3></div>
                <br>
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="body borde2">
                                    <div class="body table-responsive"><form method="POST" action="act_almacenes.php">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th>Clave</th>
                                                <th>Almacén</th>
                                                <th>Dirección</th>
                                                <th>Contacto</th>
                                                <th>Telefono</th>
                                                <th>status</th>
                                                <th>Modificar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $almacenes = $Almacen->get_almacenes();
                                            while($row = mysqli_fetch_array($almacenes)){ ?>
                                            <tr>
                                                <th scope="row"><?php echo $row['clave']; ?></th>
                                                <td><?php echo $row['almacen']; ?></td>
                                                <td><?php echo $row['direccion']; ?></td>
                                                <td><?php echo $row['contacto']; ?></td>
                                                <td><?php echo $row['telefono1']; ?></td>
                                                <td><?php if ($row['status']==1) {
                                                    echo "Activo";
                                                } else { echo "Inactivo";}
                                                echo '</td>
                                                <td><button name="act_alm" value="'.$row['id_almacen'].'" onclick="mostraract()"><i class="material-icons">edit</i>
                                                </button>
                                                <button name="delete" value="'.$row['id_almacen'].'"><i class="material-icons">delete</i>
                                                </button>
                                                </td>
                                            </tr>';  }?>
                                        </tbody>
                                    </table></form>
                                </div></div>
                        </div>
                            
                            </div>
                        </div>
                </div>

</section>

<!-- Ocultar formulario -->
<script type="text/javascript">
function mostrar(){

    divT = document.getElementById("formoculto");
    divT.style.display = "";
    divT = document.getElementById("inactivos");
    divT.style.display = "none";
    divT = document.getElementById("activos");
    divT.style.display = "none";
}
</script>

<script type="text/javascript">
function inactivos(){
    divT = document.getElementById("inactivos");
    divT.style.display = "";
    divT = document.getElementById("formoculto");
    divT.style.display = "none";
    divT = document.getElementById("activos");
    divT.style.display = "none";
}
</script>
<script type="text/javascript">
function ocultar(){
    divT = document.getElementById("formoculto");
    divT.style.display = "none";
    divT = document.getElementById("inactivos");
    divT.style.display = "none";
        divT = document.getElementById("activos");
    divT.style.display = "";

}
</script>

    <script src="../../plugins/jquery/jquery.min.js"></script>

    <script src="../../plugins/bootstrap/js/bootstrap.js"></script>

    <script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <script src="../../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <script src="../../plugins/node-waves/waves.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="../../plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="../../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/tables/jquery-datatable.js"></script>

    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>

</body>

</html>