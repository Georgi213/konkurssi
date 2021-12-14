<?php
require_once ('conf.php');
global $yhendus;
//punktide lisamine UPDATE https://m.media-amazon.com/images/I/91QrEVmkKlL._AC_SX569_.jpg
if(isset($_REQUEST['punkt'])){
    $kask=$yhendus->prepare("UPDATE konkurss SET punktrid=punktrid+1 WHERE id=?");
    $kask->bind_param("i",$_REQUEST['punkt']);
    $kask->execute();
    header("Location:$_SERVER[PHP_SELF]");
}
//uue kommentaari lisamine
if(isset($_REQUEST['uus_komment'])){
    $kask=$yhendus->prepare("UPDATE konkurss SET kommentaar=CONCAT(kommentaar,?) WHERE id=?");
    $kommentlisa=$_REQUEST['komment']."\n";
    $kask->bind_param("si",$kommentlisa,$_REQUEST['uus_komment']);
    $kask->execute();
    header("Location:$_SERVER[PHP_SELF]");
}
?>
<!Doctype html>
<html lang="et">
<head>
    <title>Foto konkurss</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav>
    <a href="haldus.php">Administreteerimise leht</a>
    <br>
    <a href="konkurss.php">Kasutaja leht</a>
</nav>
<h1>Fotokonkurss ""</h1>
<?php
$kask=$yhendus->prepare("SELECT id,nimi,pilt,kommentaar,punktrid FROM konkurss WHERE avalik=1");
$kask->bind_result($id,$nimi,$pilt,$kommentaar,$punktid);
$kask->execute();
echo"<table><tr><td>Nimi</td><td>Pilt</td><td>Kommentaarid</td><td>Lisa kommentaar</td><td>Punktid</td></tr>";
while($kask->fetch()){
    echo"<tr><td>$nimi</td>";
    echo"<td><img src='$pilt' alt='pilt'></td>";
    echo "<td>".nl2br($kommentaar)."</td>";
    echo "<td>
    <form action='?'>
    <input type='hidden' name='uus_komment' value='$id'>
    <input type='text' name='komment'>
    <input type='submit' value='OK'>
</form></td
<br>";

    echo"<td>$punktid</td>";
    echo"<td><a href='?punkt=$id'>+1punkt</a></td>";
    echo"</tr>";
}
echo"<table>";
?>
</body>
</html>
