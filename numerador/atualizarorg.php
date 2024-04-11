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

if ((isset($_GET["MM_update"])) && ($_GET["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE num_org SET org_Unidade=%s, org_descUnid=%s, org_CodSecao=%s, org_desc=%s, org_cidade=%s, org_uf=%s, org_Bairro=%s, org_via=%s, org_num=%s, org_ref=%s, org_tel=%s, org_fax=%s, org_email=%s, org_tp=%s, org_obs=%s WHERE org_id=%s",
                       GetSQLValueString($_GET['org_Unidade'], "int"),
                       GetSQLValueString($_GET['org_descUnid'], "text"),
                       GetSQLValueString($_GET['org_CodSecao'], "text"),
                       GetSQLValueString($_GET['org_desc'], "text"),
                       GetSQLValueString($_GET['org_cidade'], "text"),
                       GetSQLValueString($_GET['org_uf'], "text"),
                       GetSQLValueString($_GET['org_Bairro'], "text"),
                       GetSQLValueString($_GET['org_via'], "text"),
                       GetSQLValueString($_GET['org_num'], "text"),
                       GetSQLValueString($_GET['org_ref'], "text"),
                       GetSQLValueString($_GET['org_tel'], "text"),
                       GetSQLValueString($_GET['org_fax'], "text"),
                       GetSQLValueString($_GET['org_email'], "text"),
                       GetSQLValueString($_GET['org_tp'], "text"),
                       GetSQLValueString($_GET['org_obs'], "text"),
                       GetSQLValueString($_GET['org_id'], "int"));

  mysqli_select_db($conexao, $database_conexao);
  $Result1 = mysqli_query($conexao, $updateSQL);

  $updateGoTo = "acaook.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_secao = "1";
if (isset($_GET['org_id'])) {
  $colname_secao = $_GET['org_id'];
}
mysqli_select_db($conexao, $database_conexao);
$query_secao = sprintf("SELECT * FROM num_org WHERE org_id = %s", $colname_secao);
$secao = mysqli_query($conexao, $query_secao);
$row_secao = mysqli_fetch_assoc($secao);
$totalRows_secao = mysqli_num_rows($secao);
?>
<html>
<head>
<title>Numerador</title>
<link  href="file:///C|/xampp/htdocs/webcpi2/css/Geral.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="get" name="form1">
  <table width="655" align="center" bgcolor="#E2E2E2">
    <tr valign="baseline" bgcolor="#CCCCCC"> 
      <td colspan="4" align="right" nowrap> <div align="center"><font color="#000099" size="3">ATUALIZAR 
          CADASTRO DA SE&Ccedil;&Atilde;O</font></div></td>
    </tr>
    <tr valign="baseline"> 
      <td colspan="4" align="right" nowrap><table width="655" align="center">
          <tr valign="baseline"> 
            <td width="124" align="right" nowrap>COD DE OPM:</td>
            <td width="86"><input type="text" name="org_Unidade" value="<?php echo $row_secao['org_Unidade']; ?>" size="12"></td>
            <td width="129">DESCRI&Ccedil;&Atilde;O DE OPM:</td>
            <td width="296"><input type="text" name="org_descUnid" value="<?php echo $row_secao['org_descUnid']; ?>" size="45"></td>
          </tr>
          <tr valign="baseline"> 
            <td nowrap align="right">COD. DE DOC. SE&Ccedil;&Atilde;O:</td>
            <td><input type="text" name="org_CodSecao" value="<?php echo $row_secao['org_CodSecao']; ?>" size="12"></td>
            <td>DESCRI&Ccedil;&Atilde;O DA SE&Ccedil;&Atilde;O:</td>
            <td><input type="text" name="org_desc" value="<?php echo $row_secao['org_desc']; ?>" size="45"></td>
          </tr>
        </table></td>
    </tr>
    <tr valign="baseline" bgcolor="#CCCCCC"> 
      <td colspan="4" align="right" nowrap> <div align="center"><font color="#000099" size="3">ENDERE&Ccedil;O 
          DA SE&Ccedil;&Atilde;O</font></div></td>
    </tr>
    <tr valign="baseline"> 
      <td colspan="4" align="right" nowrap><table width="655" align="center">
          <tr valign="baseline"> 
            <td width="51" align="right" nowrap>CIDADE:</td>
            <td width="188"><input type="text" name="org_cidade" value="<?php echo $row_secao['org_cidade']; ?>" size="30"></td>
            <td width="342">BAIRRO: 
              <input type="text" name="org_Bairro" value="<?php echo $row_secao['org_Bairro']; ?>" size="45"></td>
            <td width="54">UF: 
              <input type="text" name="org_uf" value="<?php echo $row_secao['org_uf']; ?>" size="4"></td>
          </tr>
          <tr valign="baseline"> 
            <td nowrap align="right">VIA:</td>
            <td colspan="3"><input type="text" name="org_via" value="<?php echo $row_secao['org_via']; ?>" size="60">
              N&ordm;: 
              <input type="text" name="org_num" value="<?php echo $row_secao['org_num']; ?>" size="9"></td>
          </tr>
          <tr valign="baseline"> 
            <td nowrap align="right">REFERENCIA:</td>
            <td colspan="3"><input type="text" name="org_ref" value="<?php echo $row_secao['org_ref']; ?>" size="32"></td>
          </tr>
        </table></td>
    </tr>
    <tr valign="baseline" bgcolor="#CCCCCC"> 
      <td colspan="4" align="right" nowrap>
<div align="center"><font color="#000099" size="3">MEIOS 
          DE CONTATOS</font></div></td>
    </tr>
    <tr valign="baseline"> 
      <td colspan="4" align="right" nowrap><table width="655" align="center">
          <tr valign="baseline"> 
            <td width="126" align="right" nowrap>TELEFONE:</td>
            <td width="192" align="right" nowrap><div align="left"> 
                <input type="text" name="org_tel" value="<?php echo $row_secao['org_tel']; ?>" size="32">
              </div></td>
            <td width="69" align="right" nowrap>FAX:</td>
            <td width="248" align="right" nowrap><div align="left"> 
                <input type="text" name="org_fax" value="<?php echo $row_secao['org_fax']; ?>" size="32">
              </div></td>
          </tr>
          <tr valign="baseline"> 
            <td nowrap align="right">E-MAIL:</td>
            <td colspan="3"><input type="text" name="org_email" value="<?php echo $row_secao['org_email']; ?>" size="50"></td>
          </tr>
        </table></td>
    </tr>
    <tr valign="baseline"> 
      <td width="126" align="right" nowrap>OBSERVA&Ccedil;&Atilde;O: </td>
      <td colspan="3"><input type="text" name="org_obs" value="<?php echo $row_secao['org_obs']; ?>" size="60"></td>
    </tr>
    <tr valign="baseline"> 
      <td colspan="4" align="right" nowrap bgcolor="#CCCCCC"> <div align="center">
          <input type="hidden" name="org_tp" value="<?php echo $row_secao['org_tp']; ?>" size="32">
          <input name="submit" type="submit" value="Atualizar o registro">
        </div></td>
    </tr>
  </table>
  <input type="hidden" name="org_id" value="<?php echo $row_secao['org_id']; ?>">
  <input type="hidden" name="MM_update" value="form1">
</form>
<p>&nbsp;</p>
  </body>
</html>
<?php
mysqli_free_result($secao);
?>

