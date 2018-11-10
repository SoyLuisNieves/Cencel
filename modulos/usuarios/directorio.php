<?php 
    require_once('../menu.php'); ?>
    <style>
        .conv-upper{text-transform: uppercase;}
    </style>

    <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
    
<?php 
    $almacenes = $Almacen->get_almacenes();
    $usuarios = $Usuario->get_userslogin();


    

    if(isset($_POST['n_user'])){
        $datos_usuario = $_POST['n_user'];
        if(in_array($datos_usuario['login'], $usuarios)){
        echo "<script type=\"text/javascript\">alert(\"Fotos guardadas\");</script>"; 
    }
    else{
        echo $datos_usuario;
        $usuarios = $Usuario->new_user();
    }
    }

    if(isset($_POST['act_usuario'])){
        $Usuario->upt_user();
    }
    
 ?>
?> </section>

    <section class="content">
        <div class="block">
            <div class="row clearfix">
                <div class="col-md-6">
                    <h2>
                        USUARIOS
                    </h2>
                </div>

                <div class="" align="right">
                    <a onclick="mostrar()">
                        <div  id="enlaces">
                            <a class="" id="nuevo_usuario">
                            <div class="info-box-3 hover-zoom-effect bg-cyan">
                                <div class="icon">
                                    <i class="material-icons">add_circle_outline</i>
                                </div>
                                <div class="bton">
                                    <div class="text">REGISTRAR USUARIO</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <form id="form_validation"> </form>
            

              <!-- Fin formulario semantic -->
                <div class="ui" id="form_directorio">
                    <div class="seccion"><h3>LISTADO DE <b>USUARIOS</b></h3></div>
                <br>
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="body borde2">
                                    <div class="body table-responsive">
                                    <form method="POST" action="act_usuarios.php">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Ape Pat</th>
                                                <th>Ape Mat</th>
                                                <th>Fecha Nac</th>
                                                <th>CP</th>
                                                <th>Telefono</th>
                                                <th>Email</th>
                                                <th>RFC</th>
                                                <th>Usuario</th>
                                                <th>Acceso</th>
                                                <th>Precio Asignado</th>
                                                <th>Almacen</th>
                                                <th><i class="material-icons">lock / lock_open</i></th>
                                                <th><i class="material-icons">edit</i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $usuarios = $Usuario->get_users(); 
                                        while($row = mysqli_fetch_array($usuarios)){ ?>
                                            <tr>
                                                <td><?php echo $row['nombre']; ?></td>
                                                <td><?php echo $row['ape_pat']; ?></td>
                                                <td><?php echo $row['ape_mat']; ?></td>
                                                <td><?php echo $row['fecha_nac']; ?></td>
                                                <td><?php echo $row['codigo_postal']; ?></td>
                                                <td><?php echo $row['telefono1']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['rfc']; ?></td>
                                                <td><?php echo $row['login']; ?></td>
                                                <td><?php echo $row['precio_asignado']; ?></td>
                                                <td><?php echo $row['precio_asignado']; ?></td>
                                                <td><?php echo $row['almacen']; echo '</td>
                                                <td width="7px"><button name="bloq_usuario" value="'.$row['id_usuario'].'"><i class="material-icons">lock</i>
                                                </button>
                                                </td>
                                                <td width="7px">
                                                <button name="act_usuario" value="'.$row['id_usuario'].'"><i class="material-icons">edit</i></button></td>
                                            </tr>';  }?>
                                        </tbody>
                                    </table>
                                    <div class="results">
                                    <?php while($row = mysqli_fetch_array($usuarios)){ ?>
                                        <span><?php echo $row['nombre'];  ?></span>
                                        <?php } ?>      
                                </div>

                                    </form>
                                </div></div>
                        </div>
                            
                            </div>
                        </div>
                </div>

                

    <!-- ==============================Formulario REGISTRAR USUARIO===================================== -->
        <div id="form_registrar">
            <div class="seccion"><h3>Registrar <b>Usuario</b></h3></div>
            <!-- Input -->
                <div class="ui form"><br>
                    <div class="body">                            
                        <form action="directorio.php" method="POST">
                            <div class="borde card">
                                <h2 class="card-inside-title">Datos Personales</h2>
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <div class="form-group ">
                                        <div class="">
                                            <label for="">Nombre</label>
                                            <input type="text" name="nombre" id="nombre" onchange="calculaRFC();" class=" conv-upper" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="">
                                            <label for="">Apellido Paterno</label>
                                            <input type="text" name="ape_pat" class=" conv-upper" id="ape_pat" onchange="calculaRFC();" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="">
                                            <label for="">Apellido Materno</label>
                                            <input type="text" name="ape_mat" class=" conv-upper" id="ape_mat" onchange="calculaRFC();" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="">
                                            <label for="">Fecha de Nacimiento</label>
                                            <input type="date" name="fecha_nac" class=" date" id="fecha_nac" onchange="calculaRFC();" placeholder="Fecha" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                            <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="">
                                        <label for="">Direccion</label>
                                            <input type="text" name="direccion" class=" conv-upper" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="">
                                            <label for="">Población</label>
                                            <input type="text" name="poblacion" class=" conv-upper" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="">
                                            <label for="">Código Postal</label>
                                            <input type="number" name="codigo_postal" maxlength="5" class="" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                            <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="">
                                            <label for="">Telefono 1</label>
                                            <input type="number" name="telefono1" class="" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="">
                                            <label for="">Telefono 2</label>
                                            <input type="number" name="telefono2" class="" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="">
                                            <label for="">Email</label>
                                            <input type="email" name="email" class="" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="">
                                        <label for="">RFC</label>
                                            <input type="text" name="rfc" id="rfc_generado" class=" conv-upper" maxlength="13" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            


                        <div class="ui form">
                        <div class="seccion"><h3>Registrar <b>Datos Logeo</b></h3></div><br>
                            <div class="card borde">
                                <h2 class="card-inside-title">Datos Login</h2>
                                <div class="row clearfix">
                                    <div class="col-sm-5">
                                        <div class="form-group ">
                                            <div class="">
                                                <label for="">Username</label>
                                                <input type="text" name="login" class="" placeholder="" />
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-6">
                                                <div class="form-group ">
                                                    <div class="">
                                                        <label for="">Password</label>
                                                        <input type="password" name="pass" class="" placeholder="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group ">
                                                    <div class="">
                                                        <label for="">Confirmar Password</label>
                                                        <input type="password" class="" placeholder="" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-3">
                                        <div class="form-group form-float ">
                                            <label for="">Perfil</label>
                                            <select name="perfil" id="" class="ui fluid dropdown" required>
                                                <option value="">Perfil</option>
                                                <option value="tienda">Tienda</option>
                                                <option value="almacen">Almacen</option>
                                                <option value="subadministrador">Subadministrador</option>
                                                <option value="administrador">Administrador</option>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="form-group form-float">
                                            <label for="">Precio Asignado</label>
                                                <select name="precio_asignado" id="" class="ui fluid dropdown" required>
                                                    <option value="">Precio Asignado</option>
                                                    <option value="publico">Publico</option>
                                                    <option value="subdistribuidor">Subdistribuidor</option>
                                                    <option value="distribuidor">Distribuidor</option>
                                                    <option value="medio mayoreo">Medio Mayoreo</option>
                                                    <option value="mayoreo">Mayoreo</option>
                                                    <option value="costo">Costo</option>
                                                </select>
                                        </div>

                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group form-float ">
                                            <label for="">Almacen</label>
                                           <select name="almacen" id="" class="ui fluid dropdown" required>
                                                <option value="">-- Selecciona --</option>
                                                    <?php
                                                    while($row = mysqli_fetch_array($almacenes)){ ?>          
                                                    <option value=<?php echo '"'.$row['almacen'].'"'; ?> ><?php echo $row['almacen']; ?></option> <?php }?>
                                            </select>
                                        </div><br>
                                        <div class="form-group form-float ">
                                            <label for="">Tipo de cliente</label>
                                            <select name="tipo_cliente" id="" class="ui fluid dropdown" required>
                                                <option value="">Tipo de cliente</option>
                                                <option value="subdistribuidor">Subdistribuidor</option>
                                                <option value="tienda propia">Tienda Propia</option>
                                                <option value="almacen mayorista">Almacen Mayorista</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div align="center">
                                <input name="n_user" class="ui submit button green btn" type="submit" value="REGISTRAR">
                                <a class="ui submit button red btn" id="cancelar_registrar">CANCELAR</a>
                            </div>
                            <br>

                        </form>             
                </div>
              
                <!-- Termina Formulario Registrar Usuario -->

           
                



                <!-- Boquear/Deslboquear Usuario -->
                <div class="ui" id="form_bloquear">
                <div class="column">
                        <form action="" method="POST">
                    <br>
                    <div class="ui big fluid category search" style="margin-left: 20px;">
                        <div class="ui icon input">
                            <input type="text" class="prompt" name="usuarios" placeholder="Clave Usuario">
                            <button class="circular ui teal icon button">
                            <i class="material-icons">search</i>
                        </button>
                        </div>
                        
                    </div>

                </form>     
                    </div>
                    <div class="ui form content">

                        <div class="row clearfix">

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                <div class="card">

                                    <div class="body borde">
                                    <div class="">
                                    <div class="body table-responsive">

                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Clave</th>
                                                <th>Nombre</th>
                                                <th>Direccion</th>
                                                <th>Poblacion</th>
                                                <th>CP</th>
                                                <th>Telefono</th>
                                                <th>Email</th>
                                                <th>RFC</th>
                                                <th>Usuario</th>
                                                <th>Nivel de Acceso</th>
                                                <th>Precio Asignado</th>
                                                <th>Almacen</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php while($row = mysqli_fetch_array($usuarios)){ ?>
                                            <tr>
                                                <td><?php echo $row['id_usuario']; ?></td>
                                                <td><?php echo $row['nombre']; ?></td>
                                                <td><?php echo $row['direccion']; ?></td>
                                                <td><?php echo $row['poblacion']; ?></td>
                                                <td><?php echo $row['codigo_postal']; ?></td>
                                                <td><?php echo $row['telefono1']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['rfc']; ?></td>
                                                <td><?php echo $row['login']; ?></td>
                                                <td><?php echo $row['precio_asignado']; ?></td>
                                                <td><?php echo $row['precio_asignado']; ?></td>
                                                <td><?php echo $row['almacen']; ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <div class="results">
                                    <?php while($row = mysqli_fetch_array($usuarios)){ ?>
                                        <span><?php echo $row['nombre'];  ?></span>
                                        <?php } ?>      
                                </div>
                                    </div>
                                </div><br>
                                <div align="center">
                                    <div class="ui submit button blue">Bloquear</div>
                                    <button class="ui submit button orange btn" id="cancelar_bloquear">Cancelar</button>
                                    </div><br></div>
                                

                        </div>
                            
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Termina Bloquear/Desbloquear Usuario -->

            <!-- #END# Basic Validation -->
        </div>
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
    <script type="text/javascript">

    $(document).ready(function(){

        // Inicializacion
        $("#form_registrar").hide();
        $("#form_buscar").hide();
        $("#form_bloquear").hide();
        $("#form_modificar").hide();


        // Funciones
        $("#nuevo_usuario").on("click", function(){
            $("#form_registrar").show(400);
            $("#principal").hide();
            $("#form_directorio").hide();
            $("#form_modificar").hide();
        });

        $("#buscar_usuario").on("click", function(){
            $("#form_buscar").show(400);
            $("#principal").hide();
            $("#form_registrar").hide();
            $("#form_modificar").hide();
        });

        $("#bloquear_usuario").on("click", function(){
            $("#form_bloquear").show(400);
            $("#principal").hide(400);
            $("#form_registrar").hide();
            $("#form_modificar").hide();

        })



        // Cancelar
        $("#cancelar_registrar").on("click", function(){
            $("#form_registrar").hide();
            $("#principal").show(400);
            $("#form_directorio").show(400)
        });
        $("#cancelar_buscar").on("click", function(){
            $("#form_buscar").hide();
            $("#principal").show();
        });
        
        $("#cancelar_bloquear").on("click", function(){
            $("#form_bloquear").hide();
            $("#form_directorio").hide()
            $("#form_registrar").hide();
            $("#principal").show(400);
        });

    });

  </script>

   <script src="../../plugins/jquery/jquery.min.js"></script>
     <script src="../../js/pages/tables/jquery-datatable.js"></script>
     
 <?php require_once('../footer.php');?>