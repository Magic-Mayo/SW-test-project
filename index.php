<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        // connection to mysql db
        $sql_link = mysqli_connect("hostname", "username", "password", "database");

        // function displayComments($toSearch) for displaying comments with param for what to search for in string
        function displayComments($toSearch){
            // get data from table with param in string
            // use data to display all comments that have the string to search
            // return 
            // run function that updates date by sending array of order numbers
        }

        // function updateShipDate($orders) to update shipdate_expected column
        function updateShipDate($orders){
            // loop param and check:
                // shipdate_expected column and update only if it is set to (0000-00-00 00:00:00), continue loop if already set
                // check comment for expected shipdate. if exists, set update query to new date
        }


        // Comments about candy
        displayComments('candy');

        // Comments about call me / don't call me
        // Comments about who referred me
        // Comments about signature requirements upon delivery
        // Miscellaneous comments (everything else)
    ?>
</body>
</html>