 <!DOCTYPE html>
<html lang="pt">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content=	"IE=edge">
	<meta name="description" content="MVC completo usando php">
	<meta name="keywords" content="PHP,CODIGOS,DEVMEDIA,TREINO">
	<meta name="author" content="Pablo Weslly">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo TITLE; ?> 500</title>
	<link href="http://<?php echo APP_HOST; ?>/public/css/bootstrap.min.css" rel="stylesheet">
	<link href="http://<?php echo APP_HOST; ?>/public/css/error.css" rel="stylesheet">
</head>
<body>
<div class="container">
		<h1 class="error"><?php echo $varMessage; ?></h1>
</body>
</html> 