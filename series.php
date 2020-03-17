<?php
// $db_Type = "mysql";
// $host = "localhost";
// $dbName = "netland";
// $userName = "root";
// $password = "";

// $id = $_GET['id'];

// try {
//     $conn = new PDO("mysql:host=$host;dbname=$dbName", $userName, $password);
// } catch(PDOExeption $e) {
//     echo $e->getMessage();
// }

// // $sql = "SELECT * FROM series WHERE id=1";
// $sql = 'SELECT * FROM `series`';
// $stmt = $conn->prepare($sql);
// // $result = $stmt->execute([$id]);

// print_r($stmt->execute());


// foreach ($result as $key => $value) {
//     print_r('Key: ' . $key);
//     print_r('value: '. $value);
//     print_r('-----------------------');
// }

// // while($row=$result->fetch()){
// //     echo "Title: ".$row['title']. '    '; 

// }

$dbHost = 'localhost';
$dbName = 'netland';
$dbUser = 'root';
$dbPass = '';

function createConn() {
    try {
        $conn = new PDO("mysql:host=localhost;dbname=netland", 'root');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOExeption $a) {
        echo $a->getMessage();
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
        $stmt->setFetchMode(PDO::FETCH_DESC);
        return array("result"=>$stmt->fetchAll(), "conn"=>$conn);
    } elseif ($method == "INSERT") {
        $id = $conn->lastInsertId();
        return array("conn" => $conn, "id" => $id);
    }
    else {
        return array("conn" => $conn);
    }
}

$result = firedb("SELECT * FROM SERIES WHERE ID =" . $_GET['id'])['result'];
echo $result[0]['title'] . '<br>';
echo '<br>';
echo "Seasons: " . $result[0]['seasons']  . '<br>';
echo "Country: " . $result[0]['country'] . '<br>';
echo "Language: " . $result[0]['language'] . '<br>';
echo '<br>';
echo  $result[0]['description'];
?>



