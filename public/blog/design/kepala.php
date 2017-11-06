<?php
if(count(get_included_files()) ==1)exit("<meta http-equiv='refresh' content='0;url="."http://".$_SERVER['SERVER_NAME']."'>");
?>
<html>
	<head>
		<title></title>
	</head>
	<body>
    <?php
    	echo $this->html->b($nama)."<br />";
    	echo $alamat;
    ?>
	</body>
</html>