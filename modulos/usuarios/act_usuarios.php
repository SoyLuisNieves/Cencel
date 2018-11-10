<?php require_once('../menu.php'); ?>  
    <style>
        .conv-upper{text-transform: uppercase;}
    </style>
    <script src="https://code.jquery.com/jquery-3.1.1.js"></script>


    <?php 
    $almacenes = $Almacen->get_almacenes();

    if (isset($_POST['bloq_usuario'])) { //Obtener datos almacen por id    
      $Usuario->block_user(); 
      print "<script>alert(\"Usuario Eliminado.\");window.location='directorio.php';</script>";
    }

?> </section>


    <section class="content">
        <div class="block">
             <div class="row clearfix">
                <div class="col-md-6">
                    <h2>
                        USUARIOS
                    </h2>
                </div>
             </div>
            </div>
            <form id="form_validation"></form>

<!-- INICIO FORMULARIO ACTUALIZAR -->
<?php
                        $usuarios = $Usuario->get_user();
                        $row = mysqli_fetch_array($usuarios) ?>
 <div id="form_registrar">
        <div class="seccion"><h3>Actualizar datos <b>de Usuario</b></h3></div>
            <!-- Input -->
            <div class="ui form"><br>

                <div class="body">                             
                    <form action="directorio.php" method="POST">
                        <div class="card borde ">
                                <h2 class="card-inside-title">Datos Personales</h2>
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="">
                                            <label for="">Nombre</label>
                                            <input type="text" name="id_usuario" value="<?php echo $row['id_usuario'];?>" class="" placeholder="" style="display: none;"/>
                                            <input type="text" onchange="calculaRFC();" id="nombre" name="nombre" value="<?php echo $row['nombre'];?>" class=" conv-upper" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="">
                                        <label for="">Apellido Paterno</label>
                                            <input type="text" onchange="calculaRFC();" id="ape_pat" name="ape_pat" value="<?php echo $row['ape_pat'];?>" class=" conv-upper" placeholder="" />
                                        </div>
                                    </div>
                                </div><div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="">
                                        <label for="">Apellido Materno</label>
                                            <input type="text" onchange="calculaRFC();" id="ape_mat" name="ape_mat" value="<?php echo $row['ape_mat'];?>" class=" conv-upper" placeholder="" />
                                        </div>
                                    </div>
                                </div><div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="">
                                        <label for="">Fecha Nacimiento</label>
                                            <input type="text" onchange="calculaRFC();" id="fecha_nac" name="fecha_nac" value="<?php echo $row['fecha_nac'];?>" class="" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                
                            </div>



                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="">
                                            <label for="">Población</label>
                                            <input type="text" name="poblacion" value="<?php echo $row['poblacion'];?>" class=" conv-upper" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="">
                                            <label for="">Código Postal</label>
                                            <input type="text" name="codigo_postal" value="<?php echo $row['codigo_postal'];?>" class="" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="">
                                            <label for="">Telefono 1</label>
                                            <input type="text" name="telefono1" value="<?php echo $row['telefono1'];?>" class="" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="">
                                            <label for="">Telefono 2</label>
                                            <input type="text" name="telefono2" value="<?php echo $row['telefono2'];?>" class="" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="">
                                            <label for="">Direccion</label>
                                            <input type="text" name="direccion" value="<?php echo $row['direccion'];?>" class=" conv-upper" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="">
                                            <label for="">Email</label>
                                            <input type="text" name="email" value="<?php echo $row['email'];?>" class="" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="">
                                        <label for="">RFC</label>
                                            <input type="text" name="rfc" id="rfc_generado" value="<?php echo $row['rfc'];?>" class=" conv-upper" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                            

                          
                        <div class="seccion"><h3>Modificar <b>Login</b></h3></div><br>
                        <div class="card borde">
                            <h2 class="card-inside-title">Datos Login</h2>
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="">
                                            <label for="">Username</label>
                                            <input type="text" name="login" value="<?php echo $row['login'];?>" class="" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="">
                                            <label for="">Password</label>
                                            <input type="text" name="pass" value="<?php echo $row['pass'];?>" class="" placeholder="" />
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-6 row clearfix">
                                      <div class="col-xs-6">
                                                    <div class="form-group form-float ">
                                                        <label for="">Perfil</label>
                                                        <select name="perfil" id="" class="ui fluid dropdown" required>
                                                            <option value="<?php echo $row['perfil']; ?>" selected><?php echo $row['perfil']; ?></option>
                                                            <option value="tienda">Tienda</option>
                                                            <option value="almacen">Almacen</option>
                                                            <option value="subadministrador">Subadministrador</option>
                                                            <option value="administrador">Administrador</option>
                                                        </select>
                                                    </div><br>
                                                    <div class="form-group form-float">
                                                <label for="">Precio Asignado</label>
                                                <select name="precio_asignado" id="" class="ui fluid dropdown" required>
                                                            <option value="<?php echo $row['precio_asignado']; ?>" selected><?php echo $row['precio_asignado']; ?></option>
                                                            <option value="publico">Publico</option>
                                                            <option value="subdistribuidor">Subdistribuidor</option>
                                                            <option value="distribuidor">Distribuidor</option>
                                                            <option value="medio mayoreo">Medio Mayoreo</option>
                                                            <option value="mayoreo">Mayoreo</option>
                                                            <option value="costo">Costo</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-float ">
                                                        <label for="">Almacen</label>
                                                        <select name="almacen" id="" class="ui fluid dropdown" required>
                                                            <option value="<?php echo $row['almacen']; ?>" selected><?php echo $row['almacen']; ?></option>
                                                            
                                                            <option value="san juan del rio">San Juan del Rio</option>
                                                        </select>
                                            </div><br>
                                            <div class="form-group form-float ">
                                                        <label for="">Tipo de cliente</label>
                                                        <select name="tipo_cliente" id="" class="ui fluid dropdown" required>
                                                            <option value="<?php echo $row['tipo_cliente']; ?>" selected><?php echo $row['tipo_cliente']; ?></option>
                                                             <?php
                                            while($row = mysqli_fetch_array($almacenes)){ ?>          
                                            <option value=<?php echo '"'.$row['almacen'].'"'; ?> ><?php echo $row['almacen']; ?></option> <?php }?>
                                                        </select>
                                                    </div>
                                        </div>
                                        </div>
                                    </div><br>
                                </div>
                                <div align="center">
                                    <button name="act_usuario" class=" ui submit button blue btn" type="submit">ACTUALIZAR</button>
                                    <a href="directorio.php" class="ui submit button red">CANCELAR</a>
                                </div>
                                    
                                <br>
                            </form>
                    </div>         
                </div>
            </div>

<!-- TERMINA FORMULARIO ACTUALIZAR -->


    <!-- FIN FORMULARIO ACTUALIZAR-->

<script type="text/javascript">
            function calculaRFC(){
                function Articulos(articulo){
                    return articulo.replace("DEL","").replace("LAS ", "").replace("DE ",
                "").replace("LA ", "").replace("Y ", "").replace("A ", "");
                }


            function vocal(letra){
                if (letra == 'A' || letra == 'E' || letra == 'I' || letra == 'O'
                || letra == 'U' || letra == 'a' || letra == 'e' || letra == 'i'
                || letra == 'o' || letra == 'u')
                    return true;
                else
                    return false;
            }

            nombre = $("#nombre").val();
            ape_pat = $("#ape_pat").val();
            ape_mat = $("#ape_mat").val();
            fecha_nac = $("#fecha_nac").val();
            var rfc = "";
            ape_pat = Articulos(ape_pat);
            ape_mat = Articulos(ape_mat);

            rfc += ape_pat.substr(0,1);

            var l = ape_pat.length;
            var c;
            for (i = 0; i < l; i++) {
        c = ape_pat.charAt(i);
        if (vocal(c)) {
            rfc += c;
            break;
        }
    }

    rfc += ape_mat.substr(0, 1);
    rfc += nombre.substr(0, 1);
    rfc += fecha_nac.substr(2, 4);
    rfc += fecha_nac.substr(4, 5).substr(5, 7);
    rfc += fecha_nac.substr(8, 10);

    $("#rfc_generado").val(rfc);


          }
        </script>

    <script src="../../plugins/jquery/jquery.min.js"></script>
     
 <?php require_once('../footer.php');?>