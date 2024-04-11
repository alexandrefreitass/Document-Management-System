
<?php require_once('../Connections/conexao.php'); ?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . $_SERVER['QUERY_STRING'];
}

if ((isset($_GET["MM_insert"])) && ($_GET["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO num_user (rerg, postfunc, guerra, senha, Org_id, Nivel, situacao) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_GET['rerg'], "text"),
                       GetSQLValueString($_GET['postfunc'], "text"),
                       GetSQLValueString($_GET['guerra'], "text"),
                       GetSQLValueString(md5($_GET['senha']), "text"),
                       GetSQLValueString($_GET['org_id'], "int"),
                       GetSQLValueString($_GET['Nivel'], "text"),
                       GetSQLValueString($_GET['situacao'], "text"));

  mysqli_select_db($conexao, $database_conexao);
  $Result1 = mysqli_query($conexao, $insertSQL);

  $insertGoTo = "acaookuser.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<?php require_once('../Connections/conexao.php'); ?>
<?php
mysqli_select_db($conexao, $database_conexao);
$query_posto = "SELECT * FROM sai_posto ORDER BY CodPosto ASC";
$posto = mysqli_query($conexao, $query_posto);
$row_posto = mysqli_fetch_assoc($posto);
$totalRows_posto = mysqli_num_rows($posto);

$colname_Recordset1 = "1";
if (isset($_GET['org_id'])) {
  $colname_Recordset1 = $_GET['org_id'];
}
mysqli_select_db($conexao, $database_conexao);
$query_Recordset1 = sprintf("SELECT * FROM num_org WHERE org_id = %s", $colname_Recordset1);
$Recordset1 = mysqli_query($conexao, $query_Recordset1);
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);

mysqli_select_db($conexao, $database_conexao);
$query_nivel = "SELECT * FROM num_nivel WHERE num_nivel.cod_nivel <> 'm' and num_nivel.cod_nivel <> 'c'  ORDER BY nivel_id ASC";
$nivel = mysqli_query($conexao, $query_nivel);
$row_nivel = mysqli_fetch_assoc($nivel);
$totalRows_nivel = mysqli_num_rows($nivel);

?>
<html>
<head>
<title>Numerador</title>
<link  href="../css/Geral.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="get" name="form1">
  <table align="center" bgcolor="#E6E6E6">
    <tr valign="baseline" bgcolor="#CCCCCC"> 
      <td colspan="2" align="right" nowrap> <div align="center"><font color="#000099" size="3">CADASTRO 
          DE USU&Aacute;RIO</font></div></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right">RE:</td>
      <td><input type="text" name="rerg" value="" size="9">
        <font color="#990000">Obs: sem d&iacute;gito</font></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right">POSTO / FUN&Ccedil;&Atilde;O:</td>
      <td> <select name="postfunc" id="postfunc">
          <option value="">Selecionar</option>
          <?php
do {  
?>
          <option value="<?php echo $row_posto['Posto']?>"><?php echo $row_posto['Posto']?></option>
          <?php
} while ($row_posto = mysqli_fetch_assoc($posto));
  $rows = mysqli_num_rows($posto);
  if($rows > 0) {
      mysqli_data_seek($posto, 0);
	  $row_posto = mysqli_fetch_assoc($posto);
  }
?>
        </select></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right">NOME DE GUERRA:</td>
      <td><input type="text" name="guerra" value="" size="32"></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right">SELECIONE A SE&Ccedil;&Atilde;O:</td>
      <td> <select name="org_id" id="org_id">
          <?php
do {  
?>
          <option value="<?php echo $row_Recordset1['org_id']?>"><?php echo $row_Recordset1['org_desc']?> <?php echo $row_Recordset1['org_descUnid']; ?></option>
          <?php
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  $rows = mysqli_num_rows($Recordset1);
  if($rows > 0) {
      mysqli_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysqli_fetch_assoc($Recordset1);
  }
?>
        </select> </td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right">SELECIONE O NIVELl:</td>
      <td> <select name="Nivel" id="Nivel">
          <option value="">Selecione</option>
          <?php
do {  
?>
          <option value="<?php echo $row_nivel['cod_nivel']?>"><?php echo $row_nivel['desc_nivel']?></option>
          <?php
} while ($row_nivel = mysqli_fetch_assoc($nivel));
  $rows = mysqli_num_rows($nivel);
  if($rows > 0) {
      mysqli_data_seek($nivel, 0);
	  $row_nivel = mysqli_fetch_assoc($nivel);
  }
?>
        </select> </td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right">FUN&Ccedil;&Atilde;O:</td>
      <td><input type="text" name="situacao" value="" size="32"></td>
    </tr>
    <tr valign="baseline"> 
      <td colspan="2" align="right" nowrap bgcolor="#CCCCCC"> <div align="center"> 
          <input type="submit" value="INSERIR REGISTRO">
          <input type="hidden" name="senha" value="senhas" size="32">
        </div></td>
    </tr>
  </table>
  
  <input type="hidden" name="MM_insert" value="form1">
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
  

</body>
</html>
<?php
mysqli_free_result($posto);

mysqli_free_result($Recordset1);

mysqli_free_result($nivel);
?>

