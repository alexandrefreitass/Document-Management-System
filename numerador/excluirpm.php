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

if ((isset($_GET['rerg'])) && ($_GET['rerg'] != "")) {
  $deleteSQL = sprintf("DELETE FROM num_user WHERE rerg=%s",
                       GetSQLValueString($_GET['rerg'], "text"));

  mysqli_select_db($conexao, $database_conexao);
  $Result1 = mysqli_query($conexao, $deleteSQL);

  $deleteGoTo = "acaoexcluiruser.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_USER = "0";
if (isset($_GET['rerg'])) {
  $colname_USER = $_GET['rerg'];
}
mysqli_select_db($conexao, $database_conexao);
$query_USER = sprintf("SELECT * FROM num_user WHERE rerg = '%s'", $colname_USER);
$USER = mysqli_query($conexao, $query_USER);
$row_USER = mysqli_fetch_assoc($USER);
$totalRows_USER = mysqli_num_rows($USER);
?>
<html>
<head>
<title>Documento sem t&iacute;tulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<form name="form1" method="post" action="">
  <?php echo $row_USER['postfunc']; ?>&nbsp;&nbsp;<?php echo $row_USER['guerra']; ?><br>
  CONFIRME A EXCLUS&Atilde;O DO PM<br>
  <input type="submit" name="Submit" value="EXCLUIR USUARIO">
  <input name="RERG" type="text" id="RERG" value="<?php echo $row_USER['rerg']; ?>">
</form>
</body>
</html>
<?php
mysqli_free_result($USER);
?>

