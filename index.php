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
        $sql_link = mysqli_connect("localhost", "root", "", "sw_testdb");
        
        if($sql_link === false){
            die("Could not connect to the database!");
        }

        // function for displaying comments with param for what to search for in string
        function displayComments($toSearch){
            // $query = "SELECT * FROM sweetwater_test WHERE comments";
            
            // foreach($toSearch as $comment_includes){
            //     $query .= " LIKE "
            // }

            // if($results = mysqli_query($sql_link, $query))
            // get data from table with param in string
            // use data to display all comments that have the string to search
            // return 
            // run function that updates date by sending array of order numbers
        }

        // function to update shipdate_expected column
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