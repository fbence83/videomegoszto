<?php
session_name("video");

if(!isset($_GET['id'])){
	header('Location: index.php');
}else if (isset($_GET['id'])) {
	echo "Link: " .$_GET['id']. "<br>ˇ";
}
include('functions.php');
include('header.php');

//komment törlés
if(isset($_POST["delete_comment"])){
    $comment = $_POST["comment"];
    $user = $_SESSION["user"][0];
    $link = $_POST["link"];
    $date = $_POST["date"];

    $q = "DELETE FROM HOZZASZOLASOK WHERE LINK='$link' AND FELHASZNALONEV='$user' AND MIKOR='$date' AND KOMMENT='$comment'";
    $stmt = oci_parse($conn, $q);
    oci_execute($stmt);

}
?>
    <script>
        function novel(){
            var x = document.getElementById('tobb').innerHTML;
            if (x == 'Több'){
                document.getElementById('01').style.height = '318%';
                document.getElementById('tobb').innerHTML = 'Vissza';
            }
            else {
                document.getElementById('01').style.height = '136%';
                document.getElementById('tobb').innerHTML = 'Több';
            }
        }
    </script>
	
	<div class="oszlopok">
        <?php include ("menu.php"); ?>
        <div class="main">
            <div class="video">
                <div class ="videonak">
                    <?php
                    $k = $_GET['id'];
                    $stmt1 = oci_parse($conn,"Select * from videok where cim = '$k'");
                    oci_execute($stmt1);
                    $vidi = '';
                    $views = 0;

                    while ($row = oci_fetch_assoc($stmt1)){ ?>
                    <div class= "video">

                        <?php echo convertYoutubenagy($row["LINK"]); $vidi = $row["LINK"]; $views = $row["MEGTEKINTESEK_SZAMA"]; ?>

                    </div>
                    <hr id = "nahh">
                    <div class ="cim">
                        <h2><?php echo $row["CIM"] ?></h2>
                        <h3 id ="megtekint"><?php echo $row["MEGTEKINTESEK_SZAMA"]?> megtekintés</h3>

                    </div>
                    <div class ="iconbar">
                        <a href= "user.php?id=<?php echo $row["FELHASZNALONEV"] ?>"><?php echo $row["FELHASZNALONEV"] ?> </a>
                        <?php $usern = $row["FELHASZNALONEV"];  $kat = $row["KATEGORIA"]; ?>
                        <?php }
                        $views++;
                        $q = "UPDATE VIDEOK SET MEGTEKINTESEK_SZAMA='$views' WHERE LINK='$vidi'";
                        $stmt = oci_parse($conn, $q);
                        oci_execute($stmt);

                        //hozzászólás felviele db-be
                        if(isset($_POST["submit"])){
                            $comment = $_POST["search3"];
                            $date = date("Y-m-d");
                            $user = $_SESSION["user"][0];
                            $q = "INSERT INTO HOZZASZOLASOK (LINK, FELHASZNALONEV, MIKOR, KOMMENT) VALUES ('$vidi', '$user', TO_DATE('$date', 'YY-MM-DD'), '$comment')";
                            $stmt = oci_parse($conn, $q);
                            oci_execute($stmt);

                        }
                        ?>
                        <img src="img/kamera.jpg" style="width:40px;height:40px;">
                        <img src="img/kamera.jpg" style="width:40px;height:40px;">
                        <img src="img/kamera.jpg" style="width:40px;height:40px;">
                    </div>
                    <hr>
                </div>
            </div>
            <div class="comment">
                <div class= "hozzaszolasok">
                    <?php
                    //kiszedtem a bejelentkezett user kommentjeit amelyek kapcsolódnak ehhez a videóhoz
                    if(isset($_SESSION["user"])) {
                        $user = $_SESSION["user"][0];
                        $q = "SELECT * FROM HOZZASZOLASOK WHERE FELHASZNALONEV='$user' AND LINK='$vidi' ORDER BY MIKOR";
                        $stmt5 = oci_parse($conn, $q);
                        oci_execute($stmt5);
                        $i = 0;
                        $comments = array();
                        while ($row2 = oci_fetch_assoc($stmt5)) {
                            $comments[$i] = $row2;
                            $i++;
                        }
                    }
                    //listázzuk az összes hozzászólást
                    $stmt2=oci_parse($conn, "select * from hozzaszolasok where link= '$vidi' order by mikor");
                    oci_execute($stmt2);
                    while ($row = oci_fetch_assoc($stmt2)){
                        ?>
                        <div class = "hozzaszolas">
                            <div class="feltolto-nev">
                                <a href ="user.php?id=<?php echo $row["FELHASZNALONEV"] ?>"><?php echo $row["FELHASZNALONEV"] ?></a>
                                <p><?php echo $row["MIKOR"]?> </p>
                            </div>
                            <div class = "komment">
                                <table>
                                    <tr>
                                        <td>
                                            <p><?php echo $row["KOMMENT"] ?></p>
                                        </td>
                                        <td>
                                            <?php
                                            if(isset($_SESSION["user"])){
                                                foreach ($comments as $one) {
                                                    if($row["KOMMENT"] == $one["KOMMENT"]){
                                                        ?>
                                                        <form action="" method="post">
                                                            <input type="hidden" value="<?php echo $one["LINK"]; ?>" name="link">
                                                            <input type="hidden" value="<?php echo $one["MIKOR"]; ?>" name="date">
                                                            <input type="hidden" value="<?php echo $one["KOMMENT"];?>" name="comment">
                                                            <button type="submit" name="delete_comment">Törlés</button>
                                                        </form>
                                                        <?php
                                                    }
                                                }
                                            } ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <hr id="comment">
                        </div>
                    <?php }	?>
                </div>
                <div class = "hozzaszol">
                    <p>Megjegyzés</p>
                    <form class="megjegyzes" action="" method="POST">
                        <input type="text" placeholder="Hozzaszol.." name="search3">
                        <button type="submit" name="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="feltolto">
            <h3 id="nah">Hasonlo Videok</h3>
            <hr>
            <div class="hasonlo" id="01">
                <?php
                $stmt4=oci_parse($conn, "select * from videok where kategoria= '$kat' ");
                oci_execute($stmt4);
                while ($row = oci_fetch_assoc($stmt4)){
                    ?>
                    <div class="container">
                        <div class="videonak">
                            <?php $konvertal = konvertal($row["LINK"]); ?>
                            <a href = "videos.php?id=<?php echo $row["CIM"] ?>">
                                <img src="<?php echo $konvertal ?>" style="width:264px;height:180px;"></a>
                        </div>
                        <div class="cim-es-adatok">
                            <h3 class="jah"><?php echo $row["CIM"] ?></h3>
                            <a href= "user.php?id=<?php echo $row["FELHASZNALONEV"] ?>" id ="felhaszn"><?php echo $row["FELHASZNALONEV"] ?> </a>
                        </div>
                    </div>
                    <hr>
                <?php } ?>
            </div>
            <hr>
            <p id="tobb" onclick="novel()" >Több</p>
        </div>

    </div>
	<?php 
	include('footer.php');
	?>