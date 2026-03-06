<?php
$conn = new mysqli("localhost","root","","retsept_db");

if ($conn->connect_error) {
die("Ulanishda xatolik: ".$conn->connect_error);
}

if(isset($_POST['add_chef'])){
$ism=$_POST['ism'];
$tajriba=$_POST['tajriba'];
$restoran=$_POST['restoran'];

$conn->query("INSERT INTO oshpazlar (ism,tajriba,restoran) VALUES ('$ism','$tajriba','$restoran')");
}

if(isset($_POST['add_recipe'])){
$nomi=$_POST['nomi'];
$tayyorlash=$_POST['tayyorlash'];
$kaloriya=$_POST['kaloriya'];
$oshpaz_id=$_POST['oshpaz_id'];

$conn->query("INSERT INTO retseptlar (nomi,tayyorlash,kaloriya,oshpaz_id) VALUES ('$nomi','$tayyorlash','$kaloriya','$oshpaz_id')");
}
?>

<!DOCTYPE html>

<html>
<head>
<title>Retseptlar va Oshpazlar</title>

<style>

body{
font-family:Arial;
background:#f2f2f2;
margin:40px;
}

h2{
color:#333;
}

form{
background:white;
padding:20px;
margin-bottom:20px;
border-radius:5px;
}

input, textarea{
width:100%;
padding:8px;
margin:5px 0;
}

button{
padding:10px;
background:green;
color:white;
border:none;
}

table{
width:100%;
background:white;
border-collapse:collapse;
}

th,td{
padding:10px;
border:1px solid #ccc;
}

th{
background:#eaeaea;
}

</style>

</head>

<body>

<h2>Oshpaz qo'shish</h2>

<form method="post">

Ism: <input type="text" name="ism" required>

Tajriba (yil): <input type="number" name="tajriba" required>

Restoran: <input type="text" name="restoran" required>

<button type="submit" name="add_chef">Saqlash</button>

</form>

<h2>Retsept qo'shish</h2>

<form method="post">

Retsept nomi: <input type="text" name="nomi" required>

Tayyorlash:

<textarea name="tayyorlash"></textarea>

Kaloriya: <input type="number" name="kaloriya" required>

Oshpaz ID: <input type="number" name="oshpaz_id" required>

<button type="submit" name="add_recipe">Qo'shish</button>

</form>

<h2>Retseptlar ro'yxati</h2>

<table>

<tr>
<th>Retsept</th>
<th>Tayyorlash</th>
<th>Kaloriya</th>
<th>Oshpaz</th>
<th>Restoran</th>
</tr>

<?php

$result=$conn->query("SELECT retseptlar.nomi, retseptlar.tayyorlash, retseptlar.kaloriya, oshpazlar.ism, oshpazlar.restoran
FROM retseptlar
JOIN oshpazlar ON retseptlar.oshpaz_id = oshpazlar.id");

while($row=$result->fetch_assoc()){

echo "<tr>";
echo "<td>".$row['nomi']."</td>";
echo "<td>".$row['tayyorlash']."</td>";
echo "<td>".$row['kaloriya']."</td>";
echo "<td>".$row['ism']."</td>";
echo "<td>".$row['restoran']."</td>";
echo "</tr>";

}

?>

</table>

</body>
</html>
