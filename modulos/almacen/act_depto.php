<?php 
    require_once('../menu.php');

    if (isset($_POST['del_depto'])) { 
        $categoria = $Almacen->del_depto(); 
        print "<script>alert(\"Registro Eliminado.\");window.location='depto.php';</script>";
    }
    if (isset($_POST['del_catalog'])) { 
        $categoria = $Almacen->del_cat(); 
        print "<script>alert(\"Registro Eliminado.\");window.location='depto.php';</script>";
    }
?> </section>

    <section class="content">
            <div class="block">
             <div class="row clearfix">
                <div class="col-md-6">
                    <h2>DEPARTAMENTO / CATALOGO</h2>
                </div>
             </div>
            </div>

            <form id="form_validation">
            </form>
              <!-- Fin formulario semantic -->
            
            <form class="" method="POST" action="depto.php">
            <div class="seccion"><h3>Modificar <b>Departamento / catalogo</b></h3></div>            
                <div class="ui form">
                    <div class="content">
                        <?php if (isset($_POST['act_depto'])) { 
                             $categoria = $Almacen->get_dep(); 
                            $row = mysqli_fetch_array($categoria) ?>
                            <input style="display:none;" type="text" class="" name="id" value="<?php echo $row['id_departamento'];?>" required>
                            <div class="form-group row clearfix"><br>
                                <div class="col-md-6">
                                    <input type="radio" name="nivel" id="activo" class="with-gap" value="1" checked="" onchange="nivelo()">
                                    <label for="activo">Departamento </label>
                                    <input type="radio" name="nivel" id="inactivo" class="with-gap" value="2" onchange="nivelc()" disabled>
                                    <label for="inactivo" class="m-l-20">Catalogo </label>
                                </div>
                                <div class="col-md-6" id="subcat" style="display: none;">         
                                    <select class="ui fluid dropdown" NAME="cat">
                                        <option value="<?php echo $row['id_departamento']; ?>"> <?php echo $row['departamento']; ?></option>
                                        <hr>
                                        <?php $depto = $Almacen->get_depto();
                                            while($row = mysqli_fetch_array($depto)){ ?>                                      
                                      <option value=<?php echo '"'.$row['id_departamento'].'"'; ?> ><?php echo $row['departamento']; ?></option> <?php }?>
                                    </select>
                                </div>
                            </div>
                            <?php
                            $depto = $Almacen->get_dep();
                            $row = mysqli_fetch_array($depto) ?>
                            <div class="row clearfix borde">
                                <div class="col-md-8">
                                    <div class="form-group form-float ">
                                        <label class="form-label">Nombre Categoría</label>
                                        <input type="text" class="" name="categoria" value="<?php echo $row['departamento']; ?>" required>
                                    </div>
                                </div>
                                <div align="right" class="col-md-4"><br>
                                    <button name="act_depto" class=" ui submit button Green btn" type="submit">ACTUALIZAR</button>
                                    <a href="depto.php" class="ui submit button red">CANCELAR</a>
                                </div>
                        </div><br>

                        <?php }
                             if (isset($_POST['act_catalog'])) { 
                             $categoria = $Almacen->get_catalog(); 
                            $row = mysqli_fetch_array($categoria) ?>
                            <input style="display:none;" type="text" class="" name="id" value="<?php echo $row['id_catalogo'];?>" required>
                            <div class="form-group row clearfix"><br>
                                <div class="col-md-4">
                                    <input type="radio" name="nivel" id="activo" class="with-gap" value="1" onchange="nivelo()" disabled="">
                                    <label for="activo">Departamento </label>
                                    <input type="radio" name="nivel" id="inactivo" class="with-gap" value="2" checked="" onchange="nivelc()">
                                    <label for="inactivo" class="m-l-20">Catalogo </label>
                                </div>
                                <div class="col-md-6" id="subcat" style="display: ;">               
                                    <select class="ui fluid dropdown" NAME="cat">
                                        <option value="<?php echo $row['id_departamento']; ?>"> <?php echo $row['departamento']; ?></option>
                                        <hr>
                                        <?php $depto = $Almacen->get_depto();
                                            while($row = mysqli_fetch_array($depto)){ ?>                                      
                                      <option value=<?php echo '"'.$row['id_departamento'].'"'; ?> ><?php echo $row['departamento']; ?></option> <?php }?>
                                    </select>
                                </div>
                            </div>
                            <?php
                            $depto = $Almacen->get_catalog();
                            $row = mysqli_fetch_array($depto) ?>
                            <div class="row clearfix borde">
                                <div class="col-md-8">
                                    <div class="form-group form-float ">
                                        <label class="form-label">Nombre Categoría</label>
                                        <input type="text" class="" name="categoria" value="<?php echo $row['catalogo']; ?>" required>
                                    </div>
                                     <div class="form-group form-float" >
                                     <?php if ($row['tipo']==2) {
                                         ?><input type="radio" name="tipo"  id="cantidades" value="0" class="with-gap">
                                        <label for="cantidades">Cantidades </label>
                                        <input type="radio" name="tipo" id="iccid" value="1" class="with-gap">
                                        <label for="iccid" class="m-l-20">ICCID </label>
                                        <input type="radio" name="tipo" id="imei" value="2" class="with-gap" checked>
                                        <label for="imei" class="m-l-20">IMEI </label>
                                     <?php } elseif ($row['tipo']==1) { ?>
                                         <input type="radio" name="tipo"  id="cantidades" value="0" class="with-gap">
                                        <label for="cantidades">Cantidades </label>
                                        <input type="radio" name="tipo" id="iccid" value="1" class="with-gap" checked>
                                        <label for="iccid" class="m-l-20">ICCID </label>
                                        <input type="radio" name="tipo" id="imei" value="2" class="with-gap">
                                        <label for="imei" class="m-l-20">IMEI </label>
                                     <?php }else{ ?>
                                        <input type="radio" name="tipo"  id="cantidades" value="0" class="with-gap" checked>
                                        <label for="cantidades">Cantidades </label>
                                        <input type="radio" name="tipo" id="iccid" value="1" class="with-gap" >
                                        <label for="iccid" class="m-l-20">ICCID </label>
                                        <input type="radio" name="tipo" id="imei" value="2" class="with-gap">
                                        <label for="imei" class="m-l-20">IMEI </label>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div align="right" class="col-md-4"><br>
                                    <button name="act_catalogo" class=" ui submit button Green btn" type="submit">ACTUALIZAR</button>
                                    <a href="depto.php" class="ui submit button red">CANCELAR</a>
                                </div>
                            </div><br>
                            <?php } ?>                       
                        
                    </div>
                </div>
            </form>
                        <!-- Basic Validation -->


<script type="text/javascript">
function nivelc(){

    divT = document.getElementById("subcat");
    divT.style.display = "";
}
</script>
<script type="text/javascript">
function nivelo(){

    divT = document.getElementById("subcat");
    divT.style.display = "none";
}
</script>
<script src="../../plugins/jquery/jquery.min.js"></script>
     
 <?php require_once('../footer.php');?>