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
            die("Could not connect to the database!" . mysqli_connect_error());
        }

        // function for displaying comments with param for what to search for in string
        function displayComments($toSearch){
            global $sql_link;
            if($toSearch !== null){
                $query = "SELECT * FROM sweetwater_test WHERE";
                
                for($i = 0; $i < count($toSearch); $i++){
                    if($i !== 0) $query .= " OR ";
                    $current_search = $toSearch[$i];
                    $query .= " comments LIKE '% $current_search%'";
                }
            } else if($toSearch === null){
                $query = "SELECT * FROM sweetwater_test WHERE comments NOT LIKE '%candy%' AND NOT LIKE '%deliver%' AND NOT LIKE '%call%' AND NOT LIKE '%referred%'";
            }
            
            // get data from table with param in string
            if($results = mysqli_query($sql_link, $query)){
                if(mysqli_num_rows($results) > 0){
                    echo "<h2>Comments about $toSearch[0]";
                    if(count($toSearch) > 1){
                        for($i = 0; $i < count($toSearch); $i++){
                            echo $toSearch[$i];
                            if($i !== count($toSearch) - 1){
                                echo ', ';
                                if($i === count($toSearch) - 2){
                                    echo 'and ';
                                }
                            }
                        }
                    }
                    echo "</h2>";

                    // use data to display all comments that have the string to search
                    while($row = mysqli_fetch_array($results)){
                        if($row["shipdate_expected"] === "0000-00-00 00:00:00"){
                            if($expectedShipDate = explode('Expected Ship Date: ', $row["comments"])){
                                if(isset($expectedShipDate[1])){
                                    $expectedShipDate = str_split($expectedShipDate[1], 8);
                                    $year = explode('/', $expectedShipDate[0])[2];
                                    $month = explode('/', $expectedShipDate[0])[0];
                                    $day = explode('/', $expectedShipDate[0])[1];
                                    updateShipDate($row["orderid"], $year.'/'.$month.'/'.$day);
                                }
                            }
                        }
                        echo "<br>";
                        echo "<p>";
                        echo $row["comments"];
                        echo "</p>";
                    }
                }
            }
        }

        // function to update shipdate_expected column
        function updateShipDate($order, $date){
            global $sql_link;
            $query = "UPDATE sweetwater_test SET shipdate_expected='$date' WHERE orderid=$order";

            if(!mysqli_query($sql_link, $query)){
                echo "Could not update selected data! " . mysqli_error($$sql_link);
            }
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
        displayComments(array('deliver'));
        // Miscellaneous comments (everything else)
        displayComments(null);

        mysqli_close($sql_link);
    ?>
</body>
</html>