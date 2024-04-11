<?php
// technocurve arc 3 php mv block1/3 start
$mocolor1 = "#FFFFFF";
$mocolor2 = "#CCCCCC";
$mocolor3 = "#FFFFCC";
$mocolor = $mocolor1;
// technocurve arc 3 php mv block1/3 end
?> 
<?php require_once('../Connections/conexao.php'); ?>
<?php
$colname_faltaelab = "1";
if (isset($_GET['org_id'])) {
  $colname_faltaelab = $_GET['org_id'];
}
mysqli_select_db($conexao, $database_conexao);
$query_faltaelab = sprintf("SELECT num_org.org_id     , num_doc.Id_Num     , num_doc.Tipo_Doc     , num_tipodoc.DescTipo_Doc     , num_doc.Num_Doc     , num_doc.Cod_Sec     , num_doc.Ano_Doc     , num_doc.ASSUNTO     , num_doc.ELABORADO     , num_doc.ASSINADO     , num_doc.ENCAMINHADO     , num_org.org_descUnid     , num_org.org_desc FROM num_doc     INNER JOIN num_org          ON (num_doc.Cod_Org = num_org.org_id)     INNER JOIN num_tipodoc          ON (num_tipodoc.Tipo_Doc = num_doc.Tipo_Doc) WHERE (num_org.org_id = '%s'     AND num_doc.ELABORADO = '0'  )", $colname_faltaelab);
$faltaelab = mysqli_query($conexao, $query_faltaelab);
$row_faltaelab = mysqli_fetch_assoc($faltaelab);
$totalRows_faltaelab = mysqli_num_rows($faltaelab);

$colname_faltaassinar = "0";
if (isset($_GET['org_id'])) {
  $colname_faltaassinar = $_GET['org_id'];
}
mysqli_select_db($conexao, $database_conexao);
$query_faltaassinar = sprintf("SELECT num_org.org_id     , num_doc.Id_Num     , num_doc.Tipo_Doc     , num_tipodoc.DescTipo_Doc     , num_doc.Num_Doc     , num_doc.Cod_Sec     , num_doc.Ano_Doc     , num_doc.ASSUNTO     , num_doc.ELABORADO     , num_doc.ASSINADO     , num_doc.ENCAMINHADO     , num_org.org_descUnid     , num_org.org_desc FROM num_doc     INNER JOIN num_org          ON (num_doc.Cod_Org = num_org.org_id)     INNER JOIN num_tipodoc          ON (num_tipodoc.Tipo_Doc = num_doc.Tipo_Doc) WHERE (num_org.org_id = '%s'    AND num_doc.ELABORADO = '1'  AND num_doc.ASSINADO= '0')", $colname_faltaassinar);
$faltaassinar = mysqli_query($conexao, $query_faltaassinar);
$row_faltaassinar = mysqli_fetch_assoc($faltaassinar);
$totalRows_faltaassinar = mysqli_num_rows($faltaassinar);

$colname_faltaEnviar = "1";
if (isset($_GET['org_id'])) {
  $colname_faltaEnviar = $_GET['org_id'];
}
mysqli_select_db($conexao, $database_conexao);
$query_faltaEnviar = sprintf("SELECT num_org.org_id     , num_doc.Id_Num     , num_doc.Tipo_Doc     , num_tipodoc.DescTipo_Doc     , num_doc.Num_Doc     , num_doc.Cod_Sec     , num_doc.Ano_Doc     , num_doc.ASSUNTO     , num_doc.ELABORADO     , num_doc.ASSINADO     , num_doc.ENCAMINHADO     , num_org.org_descUnid     , num_org.org_desc FROM num_doc     INNER JOIN num_org          ON (num_doc.Cod_Org = num_org.org_id)     INNER JOIN num_tipodoc          ON (num_tipodoc.Tipo_Doc = num_doc.Tipo_Doc) WHERE (num_org.org_id = '%s'    AND num_doc.ELABORADO = '1'  AND num_doc.ASSINADO= '1'  AND num_doc.ENCAMINHADO = '0')", $colname_faltaEnviar);
$faltaEnviar = mysqli_query($conexao, $query_faltaEnviar);
$row_faltaEnviar = mysqli_fetch_assoc($faltaEnviar);
$totalRows_faltaEnviar = mysqli_num_rows($faltaEnviar);
?>
<html>
<head>
<title>WEb CPI-2</title>
<link  href="../logar/css/Geral.css" rel="stylesheet" type="text/css">

<link  href="../css/Geral.css" rel="stylesheet" type="text/css">

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">

body,td,th {
	color: #900;
}

</style></head>

<body>
<?php if ($totalRows_faltaelab > 0) { // Show if recordset not empty ?>
<div align="center"><br>
  FALTA CONFIRMAR A ELABORA&Ccedil;&Atilde;O</div>
<?php do { ?>
<table width="98%" border="0" align="center">
  <tr <?php 
// technocurve arc 3 php mv block2/3 start
echo " style=\"background-color:$mocolor\" onMouseOver=\"this.style.backgroundColor='$mocolor3'\" onMouseOut=\"this.style.backgroundColor='$mocolor'\"";
// technocurve arc 3 php mv block2/3 end
?>> 
    <td height="13" colspan="2"><font size="2"><strong><?php echo $row_faltaelab['DescTipo_Doc']; ?> N&ordm; <?php echo $row_faltaelab['Num_Doc']; ?> / <?php echo $row_faltaelab['Cod_Sec']; ?> / <?php echo $row_faltaelab['Ano_Doc']; ?> - <?php echo $row_faltaelab['ASSUNTO']; ?> </strong></font></td>
    <td width="10%" height="13"><div align="center"><a href="atualiassi.php?Id_Num=<?php echo $row_faltaelab['Id_Num']; ?>">ATUALIZAR</a></div></td>
  </tr>
  <?php 
// technocurve arc 3 php mv block3/3 start
if ($mocolor == $mocolor1) {
	$mocolor = $mocolor2;
} else {
	$mocolor = $mocolor1;
}
// technocurve arc 3 php mv block3/3 end
?>
</table>
<?php } while ($row_faltaelab = mysqli_fetch_assoc($faltaelab)); ?>
<?php } // Show if recordset not empty ?>
<?php if ($totalRows_faltaassinar > 0) { // Show if recordset not empty ?>
<div align="center"><br>
  FALTA ASSINAR</div>
<?php do { ?>
<table width="98%" border="0" align="center">
  <tr <?php 
// technocurve arc 3 php mv block2/3 start
echo " style=\"background-color:$mocolor\" onMouseOver=\"this.style.backgroundColor='$mocolor3'\" onMouseOut=\"this.style.backgroundColor='$mocolor'\"";
// technocurve arc 3 php mv block2/3 end
?>> 
    <td height="13" colspan="2"><?php echo $row_faltaassinar['DescTipo_Doc']; ?> 
      N&ordm; <?php echo $row_faltaassinar['Num_Doc']; ?> / <?php echo $row_faltaassinar['Cod_Sec']; ?> / <?php echo $row_faltaassinar['Ano_Doc']; ?> - <?php echo $row_faltaassinar['ASSUNTO']; ?> </td>
    <td width="13%" height="13"><div align="center"><a href="atualiassi.php?Id_Num=<?php echo $row_faltaassinar['Id_Num']; ?>">Confirmar 
        assinatura</a></div></td>
  </tr>
  <?php 
// technocurve arc 3 php mv block3/3 start
if ($mocolor == $mocolor1) {
	$mocolor = $mocolor2;
} else {
	$mocolor = $mocolor1;
}
// technocurve arc 3 php mv block3/3 end
?>
</table>
<?php } while ($row_faltaassinar = mysqli_fetch_assoc($faltaassinar)); ?>
<?php } // Show if recordset not empty ?>
<?php if ($totalRows_faltaEnviar > 0) { // Show if recordset not empty ?>
<div align="center"><br>
  FALTA ENVIAR</div>
<?php do { ?>
<table width="98%" border="0" align="center">
  <tr <?php 
// technocurve arc 3 php mv block2/3 start
echo " style=\"background-color:$mocolor\" onMouseOver=\"this.style.backgroundColor='$mocolor3'\" onMouseOut=\"this.style.backgroundColor='$mocolor'\"";
// technocurve arc 3 php mv block2/3 end
?>> 
    <td height="13" colspan="2"><?php echo $row_faltaEnviar['DescTipo_Doc']; ?> 
      N&ordm; <?php echo $row_faltaEnviar['Num_Doc']; ?> / <?php echo $row_faltaEnviar['Cod_Sec']; ?> / <?php echo $row_faltaEnviar['Ano_Doc']; ?> - <?php echo $row_faltaEnviar['ASSUNTO']; ?> </td>
    <td width="10%" height="13"><div align="center"><a href="atualiassi.php?Id_Num=<?php echo $row_faltaEnviar['Id_Num']; ?>">Confirmar 
        envio</a></div></td>
  </tr>
  <?php 
// technocurve arc 3 php mv block3/3 start
if ($mocolor == $mocolor1) {
	$mocolor = $mocolor2;
} else {
	$mocolor = $mocolor1;
}
// technocurve arc 3 php mv block3/3 end
?>
</table>
<?php } while ($row_faltaEnviar = mysqli_fetch_assoc($faltaEnviar)); ?>
<?php } // Show if recordset not empty ?>
<p>&nbsp;</p>
</body>
</html>
<?php
mysqli_free_result($faltaelab);

mysqli_free_result($faltaassinar);

mysqli_free_result($faltaEnviar);
?>
