<?php
	if(!defined ("INC")){
		
		header("location:index.php");
		exit;
	}
<?php
$passwd= hash("whirlpool", '1zA$' . 'superpizza' . '%yU1');
echo $passwd;
?>
