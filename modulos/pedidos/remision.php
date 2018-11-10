<?php 
    require_once('../menu.php');
?> </section>

    <section class="content">
            <div class="block row clearfix">               
                <div class="col-md-1" align="center"><a href="pedidos.php"><img src="../../images/img/regresar.png" width="40px"></a></div>
                <div class="col-md-2"><h2>
                    IMPRIMIR REMISIÓN
                </h2></div>
            </div>       
        
            <form id="form_validation">
            </form>
              <!-- =============================== Formulario Nuevo Pago ============================== -->
        <div style="display: ;">
              <div class="seccion">------</div>
            <form class="ui form" id="form_validation" method="POST">
                    <div class="ui " style="display: ;"> <br>
                        <h4 class="ui horizontal divider header">.: Imprimir Factura/Remisión :. </h4>
                        <div align="ui form content center">
                        <div class="fields">
                            <div class="two wide field"></div>
                        <div class="borde esp">
                            <div class="fields">
                                    <div class="form-group form-float seven wide field">
                                        <input type="radio" name="origen" id="folio" class="with-gap" value="1" onclick="factura()">
                                    <label for="folio">Folio</label>
                                        <input type="text" class="" name="" placeholder="Folio" id="folio_f" disabled="true">
                                    </div>
                                    <div class="form-group form-float seven wide field">
                                        <input type="radio" name="origen" id="remision" class="with-gap" value="2">
                                        <label for="remision" class="form-label">Remisión</label>
                                        <input type="text" class="" name="" placeholder="Folio" id="remision_imp" disabled="true">
                                    </div>
                                    <div class="form-group form-float"></div>
                                    <div class="form-group form-float five wide field" align="right">
                                        <label class="form-label">Destino</label>
                                        <select>
                                            <option>REMISIÓN</option>
                                            <option>FACTURA</option>
                                        </select>
                                    </div>                           
                            </div>
                            <div class="fields">
                                    <div class="form-group form-float">
                                        <input type="checkbox" name="" id="comisiones"><label for="comisiones">Imprimir Comisiones/Ganancias</label>
                                    </div>
                                    <div class="form-group three wide field form-float"></div> 
                                    <div class="form-group form-float  six wide field" align="right">
                                        <input type="date" class=" date" value="<?php echo date("Y-m-d"); ?>" name="fecha">
                                    </div>
                                                            
                            </div>
                            
                            <div class="fields" align="center"> 
                                    <div class="form-group form-float">
                                        <select>
                                            <option>Cliente1</option>
                                        </select>
                                    </div><div class="two wide field"></div>
                            </div>                           
                        </div><div class="two wide field"></div></div>
                        <div align="center"><button class="ui blue button" name="new_pago">VER</button>
                            <a name="pagos" class="ui red button" href="npedido.php">CANCELAR</a>
                            </div><br>
                        </div>
                    </div>
                </form>
            </div>
                <!--=============================================================-->
                
            <!-- #END# Basic Validation -->
<script languaje="Javascript">  
<!-- 
document.write('<style type="text/css">div.cp_oculta{display: none;}</style>'); 
function MostrarOcultar(capa,enlace) 
{ 
    if (document.getElementById) 
    { 
        var aux = document.getElementById(capa).style; 
        aux.display = aux.display? "":"block"; 
    } 
} 
  
//--> 
</script>
    <script type="text/javascript">
function factura(){

    divT = document.getElementById("folio_f");
    divT.disabled="true";
    divT = document.getElementById("remision_imp");
    divT.disabled="false";
}
</script>

    <script src="../../plugins/jquery/jquery.min.js"></script>
     
 <?php require_once('../footer.php');?>