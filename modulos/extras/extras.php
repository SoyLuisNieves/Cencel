<?php 
    require_once('../menu.php');
?> </section>
<section class="content">
    <div class="block">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-2 col-sm-6 col-xs-12">
                    <h2> EXTRAS  </h2>
            </div>                      
            <div class="" align="right">
                <a href="inventario.php">
                <div  id="enlaces">
                    <div class="info-box-3 bg-blue-grey hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">gps_fixed</i>
                        </div>
                        <div class="bton">
                            <div class="text">Liberar Folio Pedido</div>
                        </div>
                    </div>
                </div></a>
                <a href="almacen_global.php">
                <div  id="enlaces">
                    <div class="info-box-3 bg-teal hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">gps_fixed</i>
                        </div>
                        <div class="bton">
                            <div class="text">Editar Factura/Ticket</div>
                        </div>
                    </div>
                </div></a>
                <a >
                </a>
            </div>
          </div>
    </div>
    <form id="form_validation"></form>

<div class="seccion"><h3>Extras</h3></div><br>




	<div id='formoculto' style='display:none;'>
		<form class="ui form" id="form_validation" method="POST">
            <div class="ui">
                <div class="ui form content">
                    <div class="row clearfix">
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <div class="card">
                              <div class="body borde">
                                 <div class="borde3">
                                   <div class="body table-responsive">
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Folio</th>
                                                <th>Clave</th>
                                                <th>Producto</th>
                                                <th>Precio</th>
                                                <th>Cantidad solicitada</th>
                                                <th>Cantidad asignada</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>cl34s</td>
                                                <td>Celular</td>
                                                <td>1500</td>
                                                <td>20</td>
                                                <td>20</td>
                                            </tr>
                                        </tbody>
                                    </table></div>
                                </div><br>
                                <div align="center">
                                    <div class="ui submit button blue">LIBERAR</div>
                                    </div><br></div>
                        	</div>
                            
                            </div>
                        </div>
                    </div>
                </div>
      </form> </div>




            <form class="" id="form_validation" method="POST">
                <div class="ui form">
                    <div class="content">
                        <!-- Basic Validation -->
                        <div class="row clearfix borde" id="oculto" style="display:'';">
                            <div class="body"> 
                                <div class="row clearfix">
                                    <div class="col-md-12" align="center">
                                        <div class="col-md-5">
                                            <div class="form-group form-float">
                                                <label class="form-label"></label><br>
                                                    <img src="excel.png" width="50px" height="50px"><a href="NUEVAS_CLAVES_DE_ACTIVACION_CENCEL.xls" download="Nuevas Claves de Activacion.xls">Descargar Nuevas Claves</a>
                                            </div>
                                        </div><br>
                                        <img src="excel.png" width="50px" height="50px"><a href="" download="Lista de Precios">Descargar Listas de Precios</a>
                                        
                                    </div>
                                </div>                                
                            </div><br>
                        </div>
                    </div>
                </div>
            </form>
     	  

<!-- desocultar formulario -->

<script type="text/javascript">
function mostrar(){
	divC = document.getElementById("oculto");
	divC.style.display="none";

	divT = document.getElementById("formoculto");
	divT.style.display = "";
}
</script>

<script type="text/javascript">
function ocultar(){
	divC = document.getElementById("oculto");
	divC.style.display="";

	divT = document.getElementById("formoculto");
	divT.style.display = "none";
}
</script>

        <script src="../../plugins/jquery/jquery.min.js"></script>
     <script src="../../js/pages/tables/jquery-datatable.js"></script>
     
 <?php require_once('../footer.php');?>
	

