<!DOCTYPE html>
<html lang="en">
<head>
  
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $naslovna; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="libs/css/custom.css" />
    <style>
        body {background-color: #FDF5E6;}
        
    </style>
   
</head>
<body>
  
    <div class="container">
  
        <?php
        // Prikazi naslovnu stranu
        echo "<div class='page-header'>
                <h1>{$naslovna}</h1>
            </div>";
        ?>