<?php
$db_Type = "mysql";
$host = "localhost";
$dbName = "netland";
$userName = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbName", $userName, $password);
    echo "<h1> Welkom op het netland beheerderspaneel </h1>";
} catch(PDOExeption $a) {
    echo $a->getMessage();
}


$result = $conn->query('select * from series');

while($row=$result->fetch()){
  
    echo "Rating: ".$row['rating'].'    ';
    echo "<a href='series.php?id=$row[id]'>Bekijk detais</a>" . '<br>';

}

echo '<br>';
$result = $conn->query('select * from films');

while($row=$result->fetch()){
    echo "Title: ".$row['title']. '     ';
    echo "Duur: ".$row['duur'] . '    ';
    echo "<a href='films.php?id=$row[id]'>Bekijk detais</a>" . '<br>';

}

?>

