<?php
//<!--Clement Kwa 20002694-->
include "dbFunction.php";

if (isset($_GET['userID'])) {
    $userID = $_GET['userID'];

    // SQL query returns multiple database records.
    $query = "SELECT * FROM sugarreading WHERE userID = " . $userID . " ORDER BY readingID";

    $result = mysqli_query($link, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $entries[] = $row;
    }
    mysqli_close($link);

    echo json_encode($entries);
}
?>

