<?php

    require(__DIR__ . "/../includes/config.php");

    // numerically indexed array of places
    $places = [];

    // TODO: search database for places matching $_GET["geo"], store in $places
    
    $location = $_GET["geo"];
    
    if (!empty($location))
    {
        $newLocation = explode(" ,", $location);
        if (is_numeric($newLocation[0]))
        {
            $places = CS50::query ("SELECT * FROM places WHERE postal_code LIKE ?", $newLocation[0]."%");
        }
        else
        {
            $places = CS50::query ("SELECT * FROM places WHERE MATCH (postal_code,place_name,admin_name1,admin_code1) AGAINST (?)", $location);
        }
      
    }
    
    
    
    
    // output places as JSON (pretty-printed for debugging convenience)
    header("Content-type: application/json");
    print(json_encode($places, JSON_PRETTY_PRINT));

?>