<?php 
    require_once('../menu.php');
?> </section>

    <section class="content">
        <div class="block row clearfix">
            <div class="col-md-1" align="center"><a href="traspasos.php"><img src="../../images/img/regresar.png" width="40px"></a></div>
             <div class="col-md-2"><h2>
                    TRASPASOS
                </h2></div>
                <?php $pagos = $Traspasos->pagos_sum();
                    $row1 = mysqli_fetch_array($pagos);
                    $importe = $Traspasos->importe();
                    $row2 = mysqli_fetch_array($importe);
                    if ($row1['pago']!=$row2['importe']) { ?>
                        <div align="right"><a name="pagos" class="ui blue button" onclick="pago()">AGREGAR PAGO</a></div>
                    <?php }else { ?>
                        <div align="right"><a class="ui button">PAGADO</a></div>
                    <?php } ?>
        </div>

        <?php if (isset($_POST['act_pagos'])) { 
                $pagos = $Traspasos->udp_pagos();
                 $pagos = $Traspasos->pagos_sum();
                    $row1 = mysqli_fetch_array($pagos);
                    $importe = $Traspasos->importe();
                    $row2 = mysqli_fetch_array($importe);
                    if ($row1['pago']==$row2['importe']) {
                        $pagado = $Traspasos->importe_pago();
                    }else{
                        $pagado = $Traspasos->importe_p();
                    }
                }
                if (isset($_POST['new_pago'])) { 
                $pagos = $Traspasos->new_pago();
                $pagos = $Traspasos->pagos_sum();
                    $row1 = mysqli_fetch_array($pagos);
                    $importe = $Traspasos->importe();
                    $row2 = mysqli_fetch_array($importe);
                if ($row1['pago']==$row2['importe']) {
                        $pagado = $Traspasos->importe_pago();
                    }
                }?>

            <form id="form_validation">
            </form>

            <?php if (isset($_POST['bpagos'])) { ?>
                <div class="seccion"><h3>.: Detalles de Traspasos <b>- Pagos :.</b></h3></div>
            <form class="ui form" id="form_validation" method="POST">
                    <div class="ui " style="display: ;"> <br>
                        <h4 class="ui horizontal divider header">.: Depositos :. </h4>
                        <div align="ui form content center">
                        <div class="fields">
                            <div class="two wide field"></div>
                        <div class="borde esp">
                            <div class="fields">
                                <?php $pagos = $Traspasos->get_pagos_folio();
                                $row = mysqli_fetch_array($pagos) ?>
                                    <div class="form-group form-float four wide field">
                                        <label class="form-label">Folio</label>
                                        <input type="text" class="" name="id" hidden value="<?php echo $row['id']; ?>" required>
                                        <input type="text" class="" name="folio" placeholder="Folio" value="<?php echo $row['folio']; ?>" required >
                                    </div>
                                    <div class="form-group form-float"></div>
                                    <div class="form-group form-float five wide field" align="right">
                                        <label class="form-label">Fecha</label>
                                        <input type="date" class=" date" value="<?php echo date("Y-m-d"); ?>" name="fecha" required>
                                    </div>                           
                            </div>
                            <div class="fields" align="center"> 
                                    <div class="form-group form-float">
                                        <label class="form-label">Efectivo</label>
                                        <input type="number" class="" name="efectivo" value="<?php echo $row['efectivo']; ?>" required>
                                    </div><div class="two wide field"></div>
                                    <div class="form-group form-float">
                                        <label class="form-label">Cheque</label>
                                        <input type="number" class="" name="cheque" value="<?php echo $row['cheque']; ?>" required>
                                    </div><div class="two wide field"></div>
                                    <div class="form-group form-float">
                                        <label class="form-label">Nota de crédito</label>
                                        <input type="number" class="" name="credito" value="<?php echo $row['nota_credito']; ?>" required>
                                    </div>
                            </div>
                            <div align="right">
                                <div class="four wide field">
                                    <label class="form-label">Total $ <?php $suma=$row['efectivo']+$row['cheque']+$row['nota_credito']; echo $suma; ?></label>
                                </div><br>
                            </div>                            
                        </div><div class="two wide field"></div></div>
                        <div align="center"><button class="ui blue button" name="act_pagos">ACTUALIZAR</button>
                            <button name="pagos" class="ui red button" value="<?php echo $row['folio']; ?>">CANCELAR</button>
                            </div><br>
                        </div>
                    </div>
                </form>
                <?php } ?>


              <!-- =============================== Formulario Nuevo Pago ============================== -->
        <div id="nuevo_pago" style="display: none;">
              <div class="seccion"><h3>.: Detalles de Pedidos <b>- Pagos :.</b></h3></div>
            <form class="ui form" id="form_validation" method="POST">
                    <div class="ui " > <br>
                        <h4 class="ui horizontal divider header">.: Depositos :. </h4>
                        <div align="ui form content center">
                        <div class="fields">
                            <div class="two wide field"></div>
                        <div class="borde esp">
                            <div class="fields">
                                    <div class="form-group form-float four wide field">
                                        <label class="form-label">Folio</label>
                                        <input type="text" class="" name="folio" placeholder="Folio" value="<?php echo $_POST['pagos']; ?>" required>
                                    </div>
                                    <div class="form-group form-float"></div>
                                    <div class="form-group form-float five wide field" align="right">
                                        <label class="form-label">Fecha</label>
                                        <input type="date" class=" date" value="<?php echo date("Y-m-d"); ?>" name="fecha" required>
                                    </div>                           
                            </div>
                            <div class="fields" align="center"> 
                                    <div class="form-group form-float">
                                        <label class="form-label">Efectivo</label>
                                        <input type="number" class="" name="efectivo" value="0" >
                                    </div><div class="two wide field"></div>
                                    <div class="form-group form-float">
                                        <label class="form-label">Cheque</label>
                                        <input type="number" class="" name="cheque" value="0" >
                                    </div><div class="two wide field"></div>
                                    <div class="form-group form-float">
                                        <label class="form-label">Nota de crédito</label>
                                        <input type="number" class="" name="credito" value="0" >
                                    </div>
                            </div>                           
                        </div><div class="two wide field"></div></div>
                        <div align="center"><button class="ui blue button" name="new_pago">AGREGAR</button>
                            <a name="pagos" class="ui red button" onclick="pago_ocultar()">CANCELAR</a>
                            </div><br>
                        </div>
                    </div>
                </form>
            </div>
                <!--=============================================================-->
                <hr>
            <div class="seccion"><h3>.: Pagos Realizados :.</h3></div><br>
              <!-- Fin formulario semantic -->
            <form class="ui form" id="form_validation" method="POST">
                <div class="ui">
                    <div class="ui form content">
                        <!-- Basic Validation -->
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="">
                                        <h4 class="ui horizontal divider header">: Pagos Realizados :.</h4>
                                    <div class="body"> 
                                        <div class="">
                                            <div class="form-group form-float">
                                                <div class="">
                                                    <label class="form-label">Productos</label>
                                                    <div class="body table-responsive">
                                                    <table class="borde2 table table-hover table-bordered" border="0">
                                                      <thead align="center">
                                                        <tr>
                                                            <th>Editar</th>
                                                            <th>Folio</th>
                                                            <th>Efectivo</th>
                                                            <th>Cheque</th>                 
                                                            <th>Nota de Crédito</th>
                                                            <th>Suma</th>
                                                            <th>Fecha</th>                          
                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                                        <?php $pagos = $Traspasos->get_pagos_folio();
                                                            while($row = mysqli_fetch_array($pagos)){ ?>
                                                        <tr class="" align="center">
                                                            <td><form method="POST" action=""><button class="boton" name="bpagos" value="<?php echo $row['id']; ?>"><a>Editar</a></button>
                                                            <input type="number" class="" name="pago" value="<?php echo $row['folio']; ?>" hidden></form></td>
                                                            <td><?php echo $row['folio']; ?></td>
                                                            <td><?php echo $row['efectivo']; ?></td>
                                                            <td><?php echo $row['cheque']; ?></td>
                                                            <td><?php echo $row['nota_credito']; ?></td>
                                                            <td><?php $suma=$row['efectivo']+$row['cheque']+$row['nota_credito']; echo $suma; ?></td>
                                                            <?php $total=$total+$suma;?>
                                                            <td><?php echo $row['fecha']; ?></td>
                                                        </tr><?php }  ?>
                                                        <tr id="totales">
                                                            <td colspan="5" align="right">Total Depositos</td>
                                                            <th align="center"><?php echo "$ ".$total; ?></th>
                                                            <tH align="center">Importe: <?php echo "$ ".$row2['importe']; ?></tH>
                                                        </tr>
                                                      </tbody>
                                                    </table></div>
                                                </div>
                                            </div>
                                        </div>                                
                                    </div></div>
                            
                            </div>
                        </div>
                    </div>
                </div></form>
            <!-- #END# Basic Validation -->
        </div>
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

    <script src="../../plugins/jquery/jquery.min.js"></script>
     
 <?php require_once('../footer.php');?>