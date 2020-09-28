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
        $sql_link = mysqli_connect("localhost", "root", "1fafp404", "sw_testdb");
        
        if($sql_link === false){
            die("Could not connect to the database!");
        }

        // function for displaying comments with param for what to search for in string
        function displayComments($toSearch){
            global $sql_link;
            $query = "SELECT * FROM sweetwater_test WHERE";
            
            for($i = 0; $i < count($toSearch); $i++){
                if($i !== 0) $query .= " OR ";
                $current_search = $toSearch[$i];
                $query .= " comments LIKE %$current_search%";
            }

            // get data from table with param in string
            
            // use data to display all comments that have the string to search
            // loop returned data and add to variable
            // return echo statement with all comments
            // run function that updates date by sending array of order numbers
        }

        // function to update shipdate_expected column
        function updateShipDate($orders){
            // loop param and check:
                // shipdate_expected column and update only if it is set to (0000-00-00 00:00:00), continue loop if already set
                // check comment for expected shipdate. if exists, set update query to new date
        }


        // Comments about candy
        displayComments(array('candy'));
        
        // Comments about call me / don't call me
        displayComments(array('call'));
        // Comments about who referred me
        displayComments(array('referred'));
        // Comments about signature requirements upon delivery
        displayComments(array('deliver', 'ship'));
        // Miscellaneous comments (everything else)
        // displayComments(null);
    ?>
</body>
</html>