<?php require_once('../menu.php'); 
session_start();
$_SESSION['id_almacen']=1; ?>
</section>

    <section class="content">
           <div class="block">
             <div class="row clearfix">
                <div class="col-md-6">
                    <h2>
                        INGRESAR PRODUCTOS
                    </h2>
                </div>               
             </div>
          </div>
            <form id="form_validation">
            </form>
            <?php
            if (isset($_POST['guardar'])&& !empty($_POST['imei'])) {
                $id_factura= $Productos->get_factura();
                $row=mysqli_fetch_array($id_factura);
                $almacen= $Productos->get_almacen_central();
                $row2=mysqli_fetch_array($almacen);
                $regSerie= $Productos->insert_casar($row['id_factura'],$row2['clave']);
            }
            if (isset($_POST['guardar'])&& empty($_POST['imei']) && !empty($_POST['iccid'])) {
                $id_factura= $Productos->get_factura();
                $row=mysqli_fetch_array($id_factura);
                $almacen= $Productos->get_almacen_central();
                $row2=mysqli_fetch_array($almacen);
                $regSerie= $Productos->insert_serie_ind($row['id_factura'],$row2['clave']);
            }
            if (isset($_POST['guardar'])&& !empty($_POST['iccids']) && !empty($_POST['inicial']) & !empty($_POST['final'])) {
                    $id_factura= $Productos->get_factura();
                    $row=mysqli_fetch_array($id_factura);

                    //total del producto por ingresar serie
                    $id_factura= $Productos->get_factura();
                    $rowf=mysqli_fetch_array($id_factura);
                    $cantcasada= $Productos->get_casados($rowf['id_factura']);
                    $rowc=mysqli_fetch_array($cantcasada);
                    $cantingre= $Productos->get_productos_fac();
                    $row=mysqli_fetch_array($cantingre);
                    $total=$row['cant_ingresada']-$rowc['count(cve)'];

                    $almacen= $Productos->get_almacen_central();
                    $row2=mysqli_fetch_array($almacen);
                    $validarango=$_POST['final']-$_POST['inicial'];
                    if ($_POST['inicial']<=$_POST['final']) {
                    
                        if ($validarango<$total) {
                            for ($i=$_POST['inicial']; $i <=$_POST['final'] ; $i++) { 
                                $regSerie= $Productos->insert_serie($rowf['id_factura'],$row2['clave'],$i);
                            }
                        }else{
                            $validarango=$validarango+1;
                            echo '<script>alert("la muestra inicial y final contiene un mayor numero del permitido, intento ingresar '.$validarango.' de '.$total.' permitidos")</script>';
                        }
                  }else{
                    echo '<script>alert("No se pudo registrar porque, la muestra inicial de '.$_POST['inicial'].' es mayor que la muestra final de '.$_POST['final'].'")</script>';
                  }
                    
                }
            ?>

            
      <!-- ============================== FACTURA ==================== -->
              <form class="ui form" method="POST" action="capturar.php">
              <div class="seccion"><h3>Capturar <b>Equipos/Chips</b></h3></div>
                    <div class="ui form content">
                        <div class="fields" align="right">
                            <div class="form-group form-float two fields">
                                <div class="field" align="left">
                                    <label class="text">No. de Factura</label>
                                    <div class="row clearfix col-md-6">
                                        <input type="text" class="" onfocus="selecciona_value(this)" name="factura" placeholder="No.de factura" required list="busfacturas" value="<?php if(isset($_POST['factura'])){echo $_POST['factura'];} ?>">
                                        <datalist id="busfacturas">
                                        <?php $fac = $Productos ->get_facturas();
                                            while ($row=mysqli_fetch_array($fac)) {
                                                echo '<option label="$ '.$row['monto'].'" value="'.$row['n_factura'].'" />';
                                            }
                                        ?>
                                        </datalist>
                                    </div>
                                    <div class="row clearfix col-md-2">
                                        <input type="image" width="50%" name="load" value="1" src="../../images/img/buscar.png">
                                    </div>
                                </div>
                                <div class="field" align="right">
                                    <div class="row clearfix col-md-6"></div>
                                    <label class="text">Fecha Facturación</label>
                                    <div class=""><div class="" id="caja"><label>
                                    <?php if(isset($_POST['factura'])){
                                            $fecha = $Productos->get_factura();
                                            $row=mysqli_fetch_array($fecha);
                                            echo $row['fecha_factura'];
                                        }else{?>
                                        Fecha
                                    <?php } ?>
                                    </label></div></div>
                                </div>
                            </div>                               
                        </div>

                        <div class="two fields borde">
                            <div class="field">
                                <div class="form-group form-float ">
                                    <label class="form-label">Clave</label>
                                    <select class="" name="clave"  placeholder="Clave chip">
                                        <option><?php if(isset($_POST['clave']) && empty($_POST['load'])){ echo $_POST['clave'];}?></option>
                                        <?php
                                        $prod_fac= $Productos->get_factura_prod();
                                        //compara con los catalogos series editar para agregar mas catalogos con serie
                                        while ($row=mysqli_fetch_array($prod_fac)) {
                                            $seriespro= $Productos->get_catalogo_serie($row['catalogo']);
                                            $rowsp = mysqli_fetch_array($seriespro);
                                            if ($rowsp['tipo']==1 || $rowsp['tipo']==2) {
                                                echo '<option>'.$row['cve'].'</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="field"><br><input type="submit" name="buscar" class=" ui submit button blue btn" value="BUSCAR"></div>
                            <?php
                            if (isset($_POST['buscar'])||isset($_POST['guardar'])) {
                                $busprod = $Productos->get_producto_id();
                                $row = mysqli_fetch_array($busprod);
                            }
                            ?>
                            <div class="field">
                                <div class="form-group form-float ">
                                    <label class="form-label">Marca</label><br>
                                    <input type="text" readonly="readonly" name="marca" value="<?php if(isset($_POST['buscar'])&&  empty($_POST['load'])||isset($_POST['guardar'])&&  empty($_POST['load'])){echo $row['marca'];} ?>" placeholder="Marca">
                                </div>
                            </div>
                                <div class="field">
                                    <label>Modelo</label>
                                    <input type="text" readonly="readonly" name="modelo" value="<?php if(isset($_POST['buscar'])&&  empty($_POST['load'])||isset($_POST['guardar'])&&  empty($_POST['load'])){echo $row['modelo'];} ?>" placeholder="Modelo">
                                </div>
                            </div>

                            <div class="form-group" align="center">
                                <input type="radio" name="tipo" <?php if(isset($_POST['guardar'])&& !empty($_POST['tipo'])){ if($_POST['tipo']==1){echo "checked";}} ?> id="casarr" value="1" class="with-gap" onchange="casar()">
                                <label for="casarr">Casar / Individual </label>
                                <input type="radio" name="tipo" <?php if(isset($_POST['guardar'])&& !empty($_POST['tipo'])){ if($_POST['tipo']==2){echo "checked";}} ?>  id="bloquer" value="2" class="with-gap" onchange="bloque()">
                                <label for="bloquer" class="m-l-20">Bloques </label>
                            </div>


                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="body">  

                        <div id="casar" style="display: <?php if(empty($_POST['tipo'])){ echo "none";}else{ if(isset($_POST['guardar'])&&$_POST['tipo']==1){echo "";}else{echo "none";}}?>;"><div class="seccion">CASAR CHIPS</div><br>

                        <div class="row clearfix">
                            <div class="col-md-2"></div>
                            <div class="body table-responsive col-md-8">
                                    <div class="caja2">Restantes: <?php 
                                    if(isset($_POST['buscar'])&& empty($_POST['load'])||isset($_POST['guardar'])&&empty($_POST['load'])){ 
                                        $id_factura= $Productos->get_factura();
                                        $rowf=mysqli_fetch_array($id_factura);
                                        $cantcasada= $Productos->get_casados($rowf['id_factura']);
                                        $rowc=mysqli_fetch_array($cantcasada);
                                        $cantingre= $Productos->get_productos_fac();
                                        $row=mysqli_fetch_array($cantingre);
                                        $total=$row['cant_ingresada']-$rowc['count(cve)'];
                                        echo $total;}else{ echo "numero";} ?></div>
                                <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>IMEI</th>
                                                <th>ICCID</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" <?php if (!empty($_POST['factura'])) {
                                                    $prodfact=$Productos->get_factura_prod();
                                                    $rowfp = mysqli_fetch_array($prodfact);
                                                    
                                                    $seriespro= $Productos->get_catalogo_serie($rowfp['catalogo']);
                                                    $rowsp = mysqli_fetch_array($seriespro);
                                                }
                                                
                                                if(empty($total)){echo "readonly";}else{
                                                    if ($total==0) {
                                                        echo "readonly";
                                                    }} ?> maxlength="15" name="imei"></td>
                                                <td><input type="text" <?php 
                                                if(empty($total)){echo "readonly";}else{
                                                    if ($total==0) {
                                                        echo "readonly";
                                                    }} ?> maxlength="19" name="iccid"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div><</div>

                        <div id="bloque" style="display: <?php if(empty($_POST['tipo'])){ echo "none";}else{ if(isset($_POST['guardar'])&&$_POST['tipo']==2){echo "";}else{echo "none";}}?>;"><div class="seccion">CAPTURAR EQUIPOS/CHIPS MULTIPLE</div><br>

                        <div class="row clearfix">
                            <div class="col-md-2"></div>
                            <div class="body table-responsive col-md-8">
                                <div class="caja2">Restantes: <?php 
                                    if(isset($_POST['buscar'])&& empty($_POST['load'])){ 
                                        $id_factura= $Productos->get_factura();
                                        $rowf=mysqli_fetch_array($id_factura);
                                        $cantcasada= $Productos->get_casados($rowf['id_factura']);
                                        $rowc=mysqli_fetch_array($cantcasada);
                                        $cantingre= $Productos->get_productos_fac();
                                        $row=mysqli_fetch_array($cantingre);
                                        $total=$row['cant_ingresada']-$rowc['count(cve)'];
                                        echo $total;}else{ echo "numero";} ?></div>
                                <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th colspan="3">ICCID</th>
                                                <?php if(!empty($serie)){echo $serie;}?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (!empty($_POST['factura'])) {
                                                    $prodfact=$Productos->get_factura_prod();
                                                    $rowfp = mysqli_fetch_array($prodfact);
                                                }
                                                $equipos = "equipos";
                                                $equipo = "equipo" ?>
                                            <tr>
                                                <td><input type="text" <?php 
                                                if(empty($total)||strcasecmp($rowfp['catalogo'], $equipos)==0||strcasecmp($rowfp['catalogo'], $equipo)==0){echo "readonly";}else{
                                                    if ($total==0) {
                                                        echo "readonly";
                                                    }} ?> maxlength="14" name="iccids">
                                                </td>
                                                <td width="100px"><input type="text" <?php 
                                                if(empty($total)||strcasecmp($rowfp['catalogo'], $equipos)==0||strcasecmp($rowfp['catalogo'], $equipo)==0){echo "readonly";}else{
                                                    if ($total==0) {
                                                        echo "readonly";
                                                    }} ?> maxlength="5" name="inicial">
                                                </td>
                                                <td width="100px"><input type="text" <?php 
                                                if(empty($total)||strcasecmp($rowfp['catalogo'], $equipos)==0||strcasecmp($rowfp['catalogo'], $equipo)==0){echo "readonly";}else{
                                                    if ($total==0) {
                                                        echo "readonly";
                                                    }} ?> maxlength="5" name="final">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div></div>

                        <div align="center">
                            <button name="guardar" class=" ui submit button green btn" type="submit">GUARDAR</button>
                            <a type="submit" href="altas_productos.php" class="ui submit button red">CANCELAR</a>
                        </div><br></div>
                            
                        </div>
                    </div>
                </div>
            </form>


<script type="text/javascript">
function casar(){

    divT = document.getElementById("casar");
    divT.style.display = "";
    divT = document.getElementById("bloque");
    divT.style.display = "none";
}
</script>
<script type="text/javascript">
    function selecciona_value(objInput) { 
        var valor_input = objInput.value; 
        var longitud = valor_input.length; 

        if (objInput.setSelectionRange) { 
            objInput.focus(); 
            objInput.setSelectionRange (0, longitud); 
        } 
        else if (objInput.createTextRange) { 
            var range = objInput.createTextRange() ; 
            range.collapse(true); 
            range.moveEnd('character', longitud); 
            range.moveStart('character', 0); 
            range.select(); 
        } 
    } 
</script>
<script type="text/javascript">
function bloque(){

    divT = document.getElementById("casar");
    divT.style.display = "none";

    divB = document.getElementById("bloque");
    divB.style.display = "";
}
</script>


    <script src="../../plugins/jquery/jquery.min.js"></script>
     
 <?php require_once('../footer.php');?>