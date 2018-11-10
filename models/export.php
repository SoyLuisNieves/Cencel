<?php
include("models/pedidos.php");
$Pedido = new Pedidos();

/******************************************************************************** 
 * En el siguiente codigo se muestra el codigo de ejecucion para el boton expor-*
 * tar datos, que aparece en las diferentes paginas de catalogos                *
 ********************************************************************************/

    //obtencion de la variable por parametro de URL
    //$gs_varcat = filter_input(INPUT_GET,'cat');
    //Exportar datos de php a Excel
    header("Content-Type: application/vnd.ms-excel");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("content-disposition: attachment;filename=Reporte.xls");
?>
<HTML LANG="es">
    </head>
    <body>
        <!--CREACION DE LA TABLA CON LOS DATOS OBTENIDOS -->
        <?php $detalles_pedido = $Pedido->get_remision_folio($_POST['folio']); ?>
        <TABLE align="center" CELLPADDING=1 CELLSPACING=1>
         <!--   <tr>
            <td colspan="7">Folio <strong><?php $_POST['folio'];º ?></strong></td>
        </tr>
        <tr>
            <td colspan="7">TIE</td>
        </tr>-->
        <tr>
            <td colspan="7">Remision</td>
        </tr>
        <tr>
            <td colspan="3">Nombre</td>
            <td colspan="4">No REM <strong><?php echo $_POST['folio']; ?></strong></td>
        </tr>
        <tr>
            <td colspan="3">Direccion </td>
            <td colspan="4">C.P: 76800 </td>
        </tr>
        <tr>
            <td colspan="3">Poblacion</td>
            <td colspan="2">R.F.C</td>
            <td colspan="2">FECHA <strong><?php echo date("m/d/y"); ?></strong></td>
        </tr>
        <tr>
            <td width="200" align="left"><strong>CANT</strong></td>
            <td widtd="300"><strong>CLAVE <?php echo $_POST['folio'] ?></strong></td>
            <td widtd="300"><strong>PRODUCTO</strong></td>
            <td widtd="300"><strong>IMEI</strong></td>
            <td widtd="80"><strong>PRECIO</strong></td>
            <td widtd="80"><strong>IMPORTE</strong></td>
        </tr>
        
         <?php 
            $total=0;
            while($row = mysqli_fetch_array($detalles_pedido)){?>
                <tr>
                <td><?php echo $row['cant_solicitada']; ?></td>
                <td><?php echo $row['cve']; ?></td>
                <td><?php echo $row['catalogo'] ?></td>
                <td><?php echo $row['precio'] ?></td>
                <td><?php echo $row['co']; ?></td>
                <td><?php echo $row['co'] * $row['cant_solicitada']; ?></td>
                <?php $total = $total + $row['co'] * $row['cant_solicitada']; ?>
                </tr>
            <?php } ?>

        
        <tr>
            <td colspan="7"><strong>Subtotal</strong> <?php echo $total; ?></td>
        </tr>
        <tr>
            <td colspan="7"><strong>IVA</strong> 0.0</td>
        </tr>
        <tr>
            <td colspan="7"><strong>TOTAL</strong> <?php echo $total; ?></td>
        </tr>
        <tr>
            <td colspan="7">
                EN    SAN    JUAN    DEL    RIO,        QUERETARO   O    EN    CUALQUIER    OTRO    LUGAR    QUE    SE    ME(NOS)    REQUIERA    DE    PAGO    A     ELECCION EN    SAN    JUAN    DEL    RIO,        QUERETARO   O    EN    CUALQUIER    OTRO    LUGAR    QUE    SE    ME(NOS)    REQUIERA    DE    PAGO    A     ELECCION DEL ACREEDOR EL ____________________ LA CANTIDAD DE ______________ (                                                                                                                                   ) VALOR RECIBIDO A MI ENTERA SATISFACCION, DESDE LA FECHA DE VENCIMIENTO DE ESTE DOCUMENTO HASTA EL DIA DE SU LIQUIDACION CAUSA INTERES MORATORIO AL TIPO DE ______ % MENSUAL PAGADERO EN ESTA CIUDAD JURAMENTE CON EL PRINCIPAL
            </td>
        </tr>
        <tr>
            <td colspan="4">
                NOMBRE Y DATOS DEL DEUDOR
            </td>
            <td colspan="3">
                ACEPTO(AMOS)
            </td>
        </tr>
        <tr>
            <td colspan="7">
                FIRMA(S)___________________________
            </td>
        </tr>
        </table>
    </body>
</html>
