<?php require_once('../Connections/conexao.php'); ?>
<?php
$colname_user = "0";
if (isset($_GET['re'])) {
  $colname_user = $_GET['re'];
}
mysqli_select_db($conexao, $database_conexao);
$query_user = sprintf("SELECT * FROM num_user WHERE rerg = '%s'", $colname_user);
$user = mysqli_query($conexao, $query_user);
$row_user = mysqli_fetch_assoc($user);
$totalRows_user = mysqli_num_rows($user);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sem título</title>
</head>

<body>
passagem 
<?php echo $row_user['situacao']; ?> 
<script language="JavaScript" type="text/JavaScript">
           		location.href="direcionar.php?re=<?php echo $row_user['rerg']; ?>&org_id=<?php echo $row_user['Org_id']; ?>"
	   	 	    </script>
</body>
</html>

<?php
mysqli_free_result($user);
?>
