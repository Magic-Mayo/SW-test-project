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
                $query = "SELECT * FROM sweetwater_test WHERE comments NOT LIKE '%candy%' AND comments NOT LIKE '%signature%' AND comments NOT LIKE '% call%' AND comments NOT LIKE '%referred%' AND comments NOT LIKE '%sign%' AND comments NOT LIKE '%smarties%' AND comments NOT LIKE '%cinnamon%'";
            }
            
            // get data from table with param in string
            $results = mysqli_query($sql_link, $query);

            if(mysqli_num_rows($results) > 0){
                // use data to display all comments that have the string to search
                while($row = mysqli_fetch_array($results)){
                    $expectedShipDate = explode('Expected Ship Date: ', $row["comments"]);

                    if($row["shipdate_expected"] === "0000-00-00 00:00:00" && isset($expectedShipDate[1])){
                        $expectedShipDate = str_split($expectedShipDate[1], 8);
                        $year = explode('/', $expectedShipDate[0])[2];
                        $month = explode('/', $expectedShipDate[0])[0];
                        $day = explode('/', $expectedShipDate[0])[1];
                        updateShipDate($row["orderid"], $year.'/'.$month.'/'.$day);
                    }

                    echo "<br>";
                    echo "<p>";
                    echo $row["comments"];
                    echo "</p>";
                }
                echo "<br>";
            }
        }

        // function to update shipdate_expected column
        function updateShipDate($order, $date){
            global $sql_link;
            $query = "UPDATE sweetwater_test SET shipdate_expected='$date' WHERE orderid=$order";

            if(!mysqli_query($sql_link, $query)){
                echo "Could not update selected data! " . mysqli_error($$sql_link);
            }
        }


        // Comments about candy
        echo "<h2>Comments about candy</h2>";
        displayComments(array('candy', 'smarties', 'cinnamon'));
        
        // Comments about call me / don't call me
        echo "<h2>Comments about call me / don't call me</h2>";
        displayComments(array('call'));

        // Comments about who referred me
        echo "<h2>Comments about referrals</h2>";
        displayComments(array('referred'));

        // Comments about signature requirements upon delivery
        echo "<h2>Comments about signatures</h2>";
        displayComments(array('signature', 'sign'));

        // Miscellaneous comments (everything else)
        echo "<h2>Miscellaneous comments</h2>";
        displayComments(null);

        mysqli_close($sql_link);
    ?>
</body>
</html>