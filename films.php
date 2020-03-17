<?php
$dbHost = 'localhost';
$dbName = 'netland';
$dbUser = 'root';
$dbPass = '';

function createConn() {
    try {
        $conn = new PDO("mysql:host=localhost;dbname=netland", 'root');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOExeption $e) {
        echo $e->getMessage();
    }

    return $conn;
}

function firedb($sql, $conn=null, $method="SELECT") {
    if ($conn == null) {
        $conn = createConn();
    }
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if ($method == "SELECT") {
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return array("result"=>$stmt->fetchAll(), "conn"=>$conn);
    } elseif ($method == "INSERT") {
        $id = $conn->lastInsertId();
        return array("conn" => $conn, "id" => $id);
    }
    else {
        return array("conn" => $conn);
    }
}

$result = firedb("SELECT * FROM FILMS WHERE ID =" . $_GET['id'])['result'];
echo $result[0]['title'] . '<br>';
echo '<br>';
echo $result[0]['datum'] . '<br>';
echo $result[0]['land van uitkomst'] . '<br>';
echo '<br>';
echo $result[0]['omschrijving'] . '<br>';
echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/yScObvtkU-8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
?>


