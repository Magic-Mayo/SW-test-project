<?php include 'functions.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <!-- Comments about candy --> 
    <h2>Comments about candy</h2>
    <?php displayComments(array('candy', 'smarties', 'cinnamon')); ?>
    
    <!-- Comments about call me / don't call me --> 
    <h2>Comments about call me / don't call me</h2>
    <?php displayComments(array('call')); ?>

    <!-- Comments about who referred me --> 
    <?php displayComments(array('referred')); ?>

    <!-- Comments about signature requirements upon delivery --> 
    <h2>Comments about signatures</h2>
    <?php displayComments(array('signature', 'sign')); ?>

    <!-- Miscellaneous comments (everything else) --> 
    <h2>Miscellaneous comments</h2>
    <?php displayComments(null); ?>

    <?php mysqli_close($sql_link); ?>
</body>
</html>
