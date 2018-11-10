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
            <form class="ui form" id="form_validation" method="POST" action="http://localhost/cencel/export.php">
                    <div class="ui " style="display: ;"> <br>
                        <h4 class="ui horizontal divider header">.: Imprimir Remisión :. </h4>
                        <div align="ui form content center">
                        <div class="fields">
                            <div class="six wide field"></div>
                        <div class="borde esp">
                            <div class="fields">
                                    <div class="form-group form-float twelve wide field">
                                    <label for="folio">Folio</label>
                                        <input type="text" class="" name="folio" placeholder="Folio" id="folio_f">
                                    </div>
                                    <div class="form-group form-float"></div>
                                                               
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