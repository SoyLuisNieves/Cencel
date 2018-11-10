</section>




<script type="text/javascript">
!function ($) {
    
    // Le left-menu sign
    /* for older jquery version
    $('#left ul.nav li.parent > a > span.sign').click(function () {
        $(this).find('i:first').toggleClass("icon-minus");
    }); */
    
    $(document).on("click","#left ul.nav li.parent > a > span.sign", function(){          
        $(this).find('i:first').toggleClass("icon-minus");      
    }); 
    
    // Open Le current menu
    $("#left ul.nav li.parent.active > a > span.sign").find('i:first').addClass("icon-minus");
    $("#left ul.nav li.current").parents('ul.children').addClass("in");

}(window.jQuery);
</script>
                
<!-- ================= Mostrar Almacenes dependiendo de selección ===================== -->

<script type="text/javascript">
    function buscaralm(){
        var almacen = document.getElementById('almacen').value;
            // Creamos el formulario auxiliar
            var form = document.createElement( "form" );
            // Le añadimos atributos como el name, action y el method
            form.setAttribute( "name", "formulario" );
            form.setAttribute( "action", "" );
            form.setAttribute( "method", "post" );

            // Creamos un input para enviar el valor
            var input = document.createElement( "input" );

            // Le añadimos atributos como el name, type y el value
            input.setAttribute( "name", "almacen" );
            input.setAttribute( "type", "hidden" );
            input.setAttribute( "value", almacen );

            // Añadimos el input al formulario
            form.appendChild( input );
            // Añadimos el formulario al documento
            document.getElementsByTagName( "body" )[0].appendChild( form );

            // Hacemos submit
            document.formulario.submit();
        }
</script>
<!-- ================= Mostrar productos dependiendo de selección TRASPASOS ===================== -->
<script type="text/javascript">
    function buscar(){
        var depto = document.getElementById('depto').value;
            // Creamos el formulario auxiliar
            var form = document.createElement( "form" );
            // Le añadimos atributos como el name, action y el method
            form.setAttribute( "name", "formulario" );
            form.setAttribute( "action", "" );
            form.setAttribute( "method", "post" );

            // Creamos un input para enviar el valor
            var input = document.createElement( "input" );

            // Le añadimos atributos como el name, type y el value
            input.setAttribute( "name", "cat" );
            input.setAttribute( "type", "hidden" );
            input.setAttribute( "value", depto );

            // Añadimos el input al formulario
            form.appendChild( input );
            // Añadimos el formulario al documento
            document.getElementsByTagName( "body" )[0].appendChild( form );

            // Hacemos submit
            document.formulario.submit();
        }
</script>
<script type="text/javascript">
    function buscarc(){
        var cat = document.getElementById('catalogo').value;
        var depto = document.getElementById('depto').value;
        var marca = "todos";

            var form = document.createElement( "form" );
            form.setAttribute( "name", "formulario" );
            form.setAttribute( "action", "" );
            form.setAttribute( "method", "post" );

            // Creamos un input para enviar el valor
            var inputd = document.createElement( "input" );
            inputd.setAttribute( "name", "cat" );
            inputd.setAttribute( "type", "hidden" );
            inputd.setAttribute( "value", depto );
            // Creamos un input para enviar el valor
            var inputc = document.createElement( "input" );
            inputc.setAttribute( "name", "subcat" );
            inputc.setAttribute( "type", "hidden" );
            inputc.setAttribute( "value", cat );
            // Creamos un input para enviar el valor
            var inputm = document.createElement( "input" );
            inputm.setAttribute( "name", "marca" );
            inputm.setAttribute( "type", "hidden" );
            inputm.setAttribute( "value", marca );

            form.appendChild( inputd );
            form.appendChild( inputc );
            form.appendChild( inputm );
            document.getElementsByTagName( "body" )[0].appendChild( form );
            document.formulario.submit();              
    }
</script>
<!-- ================= Mostrar productos dependiendo de selección ===================== -->

<script type="text/javascript">
    function buscart(){
        var depto = document.getElementById('depto').value;
        var almacen = document.getElementById('almacen').value;
            // Creamos el formulario auxiliar
            var form = document.createElement( "form" );
            // Le añadimos atributos como el name, action y el method
            form.setAttribute( "name", "formulario" );
            form.setAttribute( "action", "" );
            form.setAttribute( "method", "post" );

            // Creamos un input para enviar el valor
            var input = document.createElement( "input" );

            // Le añadimos atributos como el name, type y el value
            input.setAttribute( "name", "cat" );
            input.setAttribute( "type", "hidden" );
            input.setAttribute( "value", depto );
            var inputal = document.createElement( "input" );
            inputal.setAttribute( "name", "almacen" );
            inputal.setAttribute( "type", "hidden" );
            inputal.setAttribute( "value", almacen );

            // Añadimos el input al formulario
            form.appendChild( input );
            form.appendChild( inputal );
            // Añadimos el formulario al documento
            document.getElementsByTagName( "body" )[0].appendChild( form );

            // Hacemos submit
            document.formulario.submit();
        }
</script>
<script type="text/javascript">
    function buscarc_traspaso(){
        var cat = document.getElementById('catalogo').value;
        var depto = document.getElementById('depto').value;
        var almacen = document.getElementById('almacen').value;
        var marca = "todos";

            var form = document.createElement( "form" );
            form.setAttribute( "name", "formulario" );
            form.setAttribute( "action", "" );
            form.setAttribute( "method", "post" );

            // Creamos un input para enviar el valor
            var inputd = document.createElement( "input" );
            inputd.setAttribute( "name", "cat" );
            inputd.setAttribute( "type", "hidden" );
            inputd.setAttribute( "value", depto );
            // Creamos un input para enviar el valor
            var inputc = document.createElement( "input" );
            inputc.setAttribute( "name", "subcat" );
            inputc.setAttribute( "type", "hidden" );
            inputc.setAttribute( "value", cat );
            // Creamos un input para enviar el valor
            var inputm = document.createElement( "input" );
            inputm.setAttribute( "name", "marca" );
            inputm.setAttribute( "type", "hidden" );
            inputm.setAttribute( "value", marca );
            var inputal = document.createElement( "input" );
            inputal.setAttribute( "name", "almacen" );
            inputal.setAttribute( "type", "hidden" );
            inputal.setAttribute( "value", almacen );

            form.appendChild( inputd );
            form.appendChild( inputc );
            form.appendChild( inputm );
            form.appendChild( inputal );
            document.getElementsByTagName( "body" )[0].appendChild( form );
            document.formulario.submit();              
    }
</script>
<script type="text/javascript">
    function buscarm_traspaso(){
        var cat = document.getElementById('catalogo').value;
        var depto = document.getElementById('depto').value;
        var marca = document.getElementById('marca').value;        
        var almacen = document.getElementById('almacen').value;

            var form = document.createElement( "form" );
            form.setAttribute( "name", "formulario" );
            form.setAttribute( "action", "" );
            form.setAttribute( "method", "post" );

            // Creamos un input para enviar el valor
            var inputd = document.createElement( "input" );
            inputd.setAttribute( "name", "cat" );
            inputd.setAttribute( "type", "hidden" );
            inputd.setAttribute( "value", depto );
            // Creamos un input para enviar el valor
            var inputc = document.createElement( "input" );
            inputc.setAttribute( "name", "subcat" );
            inputc.setAttribute( "type", "hidden" );
            inputc.setAttribute( "value", cat );
            // Creamos un input para enviar el valor
            var inputm = document.createElement( "input" );
            inputm.setAttribute( "name", "marca" );
            inputm.setAttribute( "type", "hidden" );
            inputm.setAttribute( "value", marca ); 
            var inputal = document.createElement( "input" );
            inputal.setAttribute( "name", "almacen" );
            inputal.setAttribute( "type", "hidden" );
            inputal.setAttribute( "value", almacen );           

            form.appendChild( inputd );
            form.appendChild( inputc );
            form.appendChild( inputm );
            form.appendChild( inputal );
            document.getElementsByTagName( "body" )[0].appendChild( form );
            document.formulario.submit();              
    }
</script>
<script type="text/javascript">
    function buscarm(){
        var cat = document.getElementById('catalogo').value;
        var depto = document.getElementById('depto').value;
        var marca = document.getElementById('marca').value;

            var form = document.createElement( "form" );
            form.setAttribute( "name", "formulario" );
            form.setAttribute( "action", "" );
            form.setAttribute( "method", "post" );

            // Creamos un input para enviar el valor
            var inputd = document.createElement( "input" );
            inputd.setAttribute( "name", "cat" );
            inputd.setAttribute( "type", "hidden" );
            inputd.setAttribute( "value", depto );
            // Creamos un input para enviar el valor
            var inputc = document.createElement( "input" );
            inputc.setAttribute( "name", "subcat" );
            inputc.setAttribute( "type", "hidden" );
            inputc.setAttribute( "value", cat );
            // Creamos un input para enviar el valor
            var inputm = document.createElement( "input" );
            inputm.setAttribute( "name", "marca" );
            inputm.setAttribute( "type", "hidden" );
            inputm.setAttribute( "value", marca );            

            form.appendChild( inputd );
            form.appendChild( inputc );
            form.appendChild( inputm );
            document.getElementsByTagName( "body" )[0].appendChild( form );
            document.formulario.submit();              
    }
</script>


<script type="text/javascript">
    function buscarastatus(){
        var estado = document.getElementById('status').value;
            // Creamos el formulario auxiliar
            var form = document.createElement( "form" );
            form.setAttribute( "name", "formulario" );
            form.setAttribute( "action", "" );
            form.setAttribute( "method", "post" );

            var input = document.createElement( "input" );

            input.setAttribute( "name", "estado" );
            input.setAttribute( "type", "hidden" );
            input.setAttribute( "value", estado );

            form.appendChild( input );
            // Añadimos el formulario al documento
            document.getElementsByTagName( "body" )[0].appendChild( form );

            // Hacemos submit
            document.formulario.submit();
        }
</script>

<!-- ================= Fin Mostrar productos dependiendo de selección ===================== -->

<script type="text/javascript">
function pago(){

    divT = document.getElementById("nuevo_pago");
    divT.style.display = "";
}
</script>
<script type="text/javascript">
function pago_ocultar(){

    divT = document.getElementById("nuevo_pago");
    divT.style.display = "none";
}
</script>

<script type="text/javascript">
function mostrar(){

    divT = document.getElementById("formoculto");
    divT.style.display = "";
    divT = document.getElementById("cat_prod");
    divT.style.display = "none";
    divT = document.getElementById("deptos");
    divT.style.display = "none";
    divT = document.getElementById("act");
    divT.style.display = "none";
    divT = document.getElementById("inactivos");
    divT.style.display = "none";
    divT = document.getElementById("activos");
    divT.style.display = "none";
}
</script>
<script type="text/javascript">
function mostrard(){

    divT = document.getElementById("deptos");
    divT.style.display = "";
     divT = document.getElementById("act");
    divT.style.display = "none";
    divT = document.getElementById("cat_prod");
    divT.style.display = "none";
}
</script>

<script type="text/javascript">
function ocultar(){
    divT = document.getElementById("deptos");
    divT.style.display = "none";
   divT = document.getElementById("cat_prod");
    divT.style.display = "";
    divT = document.getElementById("formoculto");
    divT.style.display = "none";

}
</script>

<!--SECCIÓN PRODUCTOS-->

<script type="text/javascript">
    function mostrarp(sel){

        if (sel.value=="0"){

    divT = document.getElementById("producto");
    divT.style.display = "none";
    divT = document.getElementById("buscar");
    divT.style.display = "none";

    }else{

    divT = document.getElementById("producto");
    divT.style.display = "";
    divB = document.getElementById("buscar");
    divB.style.display = "";
    }
}
</script>

<script type="text/javascript">
    function mostrartodo(sel){

        if (sel.value=="0"){

    divT = document.getElementById("catalogop");
    divT.style.display = "none";
    divT = document.getElementById("proveedor");
    divT.style.display = "none";
    divT = document.getElementById("clave");
    divT.style.display = "none";

    }else{

    divT = document.getElementById("catalogop");
    divT.style.display = "";
    divB = document.getElementById("proveedor");
    divB.style.display = "";
    }
}
</script>
<script type="text/javascript">
    function clave(sel){

        if (sel.value=="0"){
            divT = document.getElementById("clave");
            divT.style.display = "none";
    }else{
        divT = document.getElementById("clave");
        divT.style.display = "";
    }
}
</script>

<!--FIN SECCIÓN PRODUCTOS-->
<!-- SECCIÓN CATALOGOS-->
<script type="text/javascript">
function nivelc(){

    divT = document.getElementById("subcate");
    divT.style.display = "";
    divT = document.getElementById("tipo");
    divT.style.display = "";
}
</script>
<script type="text/javascript">
function nivelo(){

    divT = document.getElementById("subcate");
    divT.style.display = "none";
    divT = document.getElementById("tipo");
    divT.style.display = "none";
}
</script>
<!--FIN SECCIÓN CATALOGO-->





    <!-- Jquery Core Js -->
    <!--<script src="../../plugins/jquery/jquery.min.js"></script>-->
    <!-- Bootstrap Core Js -->
    <script src="../../plugins/bootstrap/js/bootstrap.js"></script>
    <!-- Select Plugin Js -->
    <script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>
    <!-- Slimscroll Plugin Js -->
    <script src="../../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>    
    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>   
    
    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>


    <!-- Jquery CountTo Plugin Js --> <!--
    <script src="plugins/jquery-countto/jquery.countTo.js"></script>
    <script src="plugins/raphael/raphael.min.js"></script>
    <script src="plugins/morrisjs/morris.js"></script>
    <script src="plugins/chartjs/Chart.bundle.js"></script>


    <script src="plugins/flot-charts/jquery.flot.js"></script>
    <script src="plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="plugins/flot-charts/jquery.flot.time.js"></script>
    <script src="plugins/jquery-sparkline/jquery.sparkline.js"></script>
    <script src="js/pages/index.js"></script>-->



    <script src="../../js/pages/forms/form-validation.js"></script>
    <!-- Jquery Validation Plugin Css -->
    <script src="../../plugins/jquery-validation/jquery.validate.js"></script>
    <!-- JQuery Steps Plugin Js -->
    <script src="../../plugins/jquery-steps/jquery.steps.js"></script>
    <!-- Sweet Alert Plugin Js -->
    <script src="../../plugins/sweetalert/sweetalert.min.js"></script>
    <script src="../../js/pages/forms/advanced-form-elements.js"></script>
    <!-- Select Plugin Js -->
    
    
    <script src="../../js/pages/forms/basic-form-elements.js"></script>
    <!-- Autosize Plugin Js -->
    <script src="../../plugins/autosize/autosize.js"></script>
    <!-- Moment Plugin Js -->
    <script src="../../plugins/momentjs/moment.js"></script>


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
   <!-- <script src="../../js/pages/tables/jquery-datatable.js"></script>-->

<!-- ======================================== -->

</body>

</html>