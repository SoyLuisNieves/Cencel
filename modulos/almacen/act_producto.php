<form class="ui form" method="POST" action="productos.php" id="act" style="display: ;">
              <div class="seccion"><h3>Actualizar <b>Productos</b></h3></div>
                <?php

                        $producto = $Almacen->get_producto();
                        $row = mysqli_fetch_array($producto) ?>
                    <div class="content">
                        <input style="display:none;" type="text" class="" name="id" value="<?php echo $row['cve'];?>" required>
                        <div class="row clearfix">
                            <div class="col-md-3">
                                <div class="ten wide field form-group form-float" align="center">
                                    <label class="form-label">Clave de Producto</label>
                                    <input type="text" class="" name="clave" value="<?php echo $row['cve']; ?>" required>
                                </div>
                            </div>
                            <div class=" col-md-3 " align="center">
                                <div class="form-group form-float">
                                    <label class="form-label">Departamento</label><br>
                                    <select class="ui dropdown" name="cat">
                                    <?php $productos = $Almacen->get_dep_prod(); $row = mysqli_fetch_array($productos); ?>
                                    <option> <?php echo $row['departamento']; ?></option>
                                      <?php $depto = $Almacen->get_depto();
                                            while($row = mysqli_fetch_array($depto)){ ?>
                                      <option ><?php echo $row['departamento']; ?></option> <?php }?>
                                </select>
                                </div>
                            </div>
                            <div class="col-md-3 " align="center">
                                <div class="form-group form-float">
                                    <label class="form-label">Producto</label><br>
                                    <select name="sub" class="ui dropdown">
                                        <?php $producto = $Almacen->get_categoria_prod(); $row = mysqli_fetch_array($producto); ?>
                                              <option value="<?php echo $row['id_catalogo']; ?>"> <?php echo $row['catalogo']; ?></option>
                                              <?php $categorias = $Almacen->get_categorias_dep();
                                            while($row = mysqli_fetch_array($categorias)){ ?>                                      
                                            <option value=<?php echo '"'.$row['id_catalogo'].'"'; ?>><?php echo $row['catalogo']; ?></option> <?php }?>
                                        </select>
                                </div>
                            </div>
                            <?php
                        $producto = $Almacen->get_producto();
                        $row = mysqli_fetch_array($producto) ?>
                            <div class="col-md-3">
                                <div class="ten wide field form-group form-float" align="center">
                                    <label class="form-label">Clase</label>
                                    <input type="text" class="" name="clase" value="<?php echo $row['clase']; ?>" >
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                
                                
                                <div class="">
                                    <div class="body">
                                        <div class="ui form">
                                        <div class="esp2">
                                        <div class="row clearfix borde">
                                            <div class="col-md-3">
                                                <div class="form-group form-float ">
                                                    <label class="form-label">Marca</label>
                                                    <input type="text" class="" name="marca" value="<?php echo $row['marca']; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group form-float ">
                                                    <label class="form-label">Modelo</label>
                                                    <input type="text" class="" name="modelo" value="<?php echo $row['modelo']; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group form-float ">
                                                    <label class="form-label">Color</label>
                                                    <input type="text" class="" name="color" value="<?php echo $row['color']; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group form-float ">
                                                    <label class="form-label">Tamaño</label>
                                                    <input type="text" class="" name="tamano" value="<?php echo $row['tamano']; ?>" >
                                                </div>
                                            </div>
                                        </div>
                                        </div>                          
                                        <div class="demo-masked-input borde">
                                            <div class="row clearfix">
                                                <div class="col-md-4">
                                                    <div class="form-group form-float">
                                                        <label class="form-label">Precio Costo </label>
                                                        $ <input type="number" class="" name="co" value="<?php echo $row['co']; ?>" required>
                                                    </div>
                                                </div>                                
                                                <div class="col-md-4">
                                                    <div class="form-group form-float ">
                                                        <label class="form-label">Precio Mayoreo</label>
                                                        $ <input type="number" class="" name="ma" value="<?php echo $row['ma']; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-float ">
                                                        <label class="form-label">Precio Medio Mayoreo </label>
                                                        $ <input type="number" class="" name="mm" value="<?php echo $row['mm']; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-float">
                                                        <label class="form-label">Precio Distribuidor</label>
                                                        $ <input type="number" class="" name="ds" value="<?php echo $row['ds']; ?>" >
                                                    </div>
                                                </div>                                
                                                <div class="col-md-4">
                                                    <div class="form-group form-float ">
                                                        <label class="form-label">Precio Mueblería</label>
                                                        $ <input type="number" class="" name="mb" value="<?php echo $row['mb']; ?>" >
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-float ">
                                                        <label class="form-label">Precio Público</label>
                                                        $ <input type="number" class="" name="pb" value="<?php echo $row['pb']; ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                
                                    </div><br>
                                    <div align="center">
                                        <button name="actualizar_prod" class=" ui submit button Green btn" type="submit">ACTUALIZAR</button>
                                        <a href="productos.php" class="ui submit button red">CANCELAR</a>
                                    </div><br></div>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </form>