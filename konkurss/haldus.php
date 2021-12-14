<?php
require_once ('conf.php');
global $yhendus;
//punktide nulliks UPDATE https://m.media-amazon.com/images/I/91QrEVmkKlL._AC_SX569_.jpg
if (isset($_REQUEST['kommentaar'])){
    $kask=$yhendus->prepare("UPDATE konkurss set kommentaar=' ' where id=?");
    $kask->bind_param("i",$_REQUEST['kommentaar']);
    $kask->execute();
    header("Location: $_SERVER[PHP_SELF]");
}
if(isset($_REQUEST['punkt'])){
    $kask=$yhendus->prepare("UPDATE konkurss SET punktrid=0 WHERE id=?");
    $kask->bind_param("i",$_REQUEST['punkt']);
    $kask->execute();
    header("Location:$_SERVER[PHP_SELF]");
}
//nimi lisamine konkurssi
if(isset($_REQUEST['peitmine'])){
    $kask=$yhendus->prepare("UPDATE konkurss SET avalik=0 WHERE id=?");
    $kask->bind_param("i",$_REQUEST['peitmine']);
    $kask->execute();
}
if(isset($_REQUEST['avamine'])){
    $kask=$yhendus->prepare("UPDATE konkurss SET avalik=1 WHERE id=?");
    $kask->bind_param("i",$_REQUEST['avamine']);
    $kask->execute();
}
if(!empty($_REQUEST['nimi'])){
    $kask=$yhendus->prepare("INSERT INTO konkurss(nimi,pilt,lisamiseaeg) VALUES(?,?,NOW())");
    $kask->bind_param("ss",$_REQUEST['nimi'],$_REQUEST['pilt']);
    $kask->execute();
    header("Location:$_SERVER[PHP_SELF]");
}
//nimi näitamine avalik=1 update
if(isset($_REQUEST['kustuta'])){
    $kask=$yhendus->prepare("DELETE FROM  konkurss WHERE id=?");
    $kask->bind_param("i",$_REQUEST['kustuta']);
    $kask->execute();
}
//nimi peitmine avalik=0 UPDATE

//kustutamine
?>
<!Doctype html>
<html lang="et">
<head>
    <title>Foto konkurss halduse leht</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav>
    <a href="haldus.php">Administreteerimise leht</a>
    <br>
    <a href="konkurss.php">Kasutaja leht</a>
    <a href="link">Git hub</a>
</nav>
<h1>Fotokonkurssi halduseleht</h1>
<?php
$kask=$yhendus->prepare("SELECT id,nimi,pilt,lisamiseaeg,punktrid,avalik FROM konkurss");
$kask->bind_result($id,$nimi,$pilt,$aeg,$punktid,$avalik);
$kask->execute();
echo"<table><tr><td>Nimi</td><td>Pilt</td><td>Lisamiseaeg</td><td>Punktid</td></tr>";
while($kask->fetch()){
    $avatekst="Ava";
    $param="avamine";
    $seisund="Peidetud";
    if($avalik==1){
        $avatekst="Peida";
        $param="peitmine";
        $seisund="Avatud";
    }
    echo"<tr><td>$nimi</td>";
    echo"<td><img src='$pilt' alt='pilt'></td>";
    echo"<td>$aeg</td>";
    echo"<td>$punktid</td>";
    echo"<td><a href='?punkt=$id'>Punktid nulliks</a></td>";
    echo"<td><a href='?kommentaar=$id'>Kommentaride nulliks</a></td>";

    // Peida-näita


    echo"<td>$seisund</td>";
    echo "<td><a href='?$param=$id'>$avatekst</a></td>";
    echo"<td><a href='?kustuta=$id'>Kustuta</a></td>";
    echo"</tr>";
}
echo"<table>";
?>
<h2>Uue pilti lisamine konkurssi</h2>
<form action="?">
    <input type="text" name="nimi" placeholder="uus nimi">
    <br>
    <textarea name="pilt">pildi linki aadress</textarea>
    <br>
    <input type="submit" value="Lisa">
</form>
</body>
</html>
