<?php 
session_name("video");


include('functions.php');
if ($_SESSION["user"][0] == "admin") {
    $_SESSION["admin"] = true;
}else{
    header("Location: index.php");
    exit();
}
include ('header.php');

if (isset($_POST["delete_fiok"])){
	$user = $_POST["delete_fiok"];
    echo $user;
    $stmt = oci_parse($conn, "DELETE from felhasznalok where felhasznalonev = '$user'");
	oci_execute($stmt);
}

if(isset($_POST["delete_video"])){
    $link = $_POST["delete_video"];
    echo $link;

    $q = "DELETE FROM VIDEOK WHERE LINK='$link'";
    $stmt = oci_parse($conn, $q);
    oci_execute($stmt);
}


?>
<div class="oszlopok21">
		
	<?php include ("menu.php"); ?>
    <div class="main21">
        <div id="tabs2">
            <ul>
                <li><a style="background: #4CAF50;" href="#tabs2-1">Felhasználók</a></li>
                <li><a style="background: #4CAF50;" href="#tabs2-2">Videók</a></li>
            </ul>
            <div id="tabs2-1">
                <div class="baloszlop">
                    <h1>Felhasználók listája</h1>

                    <div class = "felhasznaloklista">

                        <?php
                        $stmt = oci_parse($conn,"select * from felhasznalok");
                        oci_execute($stmt);

                        while ($row = oci_fetch_assoc($stmt)) {
                            if($row["FELHASZNALONEV"] != "admin") {
                                ?>
                                <div class="sor">
                                    <div class="profil">
                                        <img src="img/<?php echo $row["KEP"] ?>" id="avatar"
                                             style="width:200px;height:200px;">
                                    </div>
                                    <div class="szemelyesadatok">
                                        <?php $user2 = $row["FELHASZNALONEV"]; ?>
                                        <p class="neves"><?php echo $user2; ?></p>

                                        <hr>
                                        <?php
                                        $stmt7 = oci_parse($conn, "select COUNT(LINK) from videok where felhasznalonev = '$user2'");
                                        oci_execute($stmt7);
                                        while ($row = oci_fetch_assoc($stmt7)) { ?>
                                            <p>Összesen <?php echo $row["COUNT(LINK)"] ?> feltöltött videó</p>
                                        <?php } ?>
                                        <?php
                                        $stmt4 = oci_parse($conn, "select COUNT(LINK) from hozzaszolasok where felhasznalonev = '$user2'");
                                        oci_execute($stmt4);
                                        while ($row = oci_fetch_assoc($stmt4)) { ?>
                                        <p>Összesen <?php echo $row["COUNT(LINK)"] ?> hozzászólás</p>
                                        <hr>
                                    </div>
                                    <hr>
                                    <?php } ?>
                                    <div class="gombs">
                                        <form method="post">
                                            <button type="submit" value="<?php echo $user2; ?>" name="delete_fiok"
                                                    class="donebutton">Fiók törlése
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>

                    </div>

                </div>
            </div>
            <div id="tabs2-2">
                <div class="baloszlop">
                    <h1>Videók listája</h1>

                    <div class = "felhasznaloklista">
                        <?php
                        $stmt = oci_parse($conn,"select * from videok");
                        oci_execute($stmt);

                        while ($row = oci_fetch_assoc($stmt)) {
                            $link = $row["LINK"];
                            ?>
                        <div class="sor">
                            <div class="videonak13">
                                <?php $konvertal = konvertal($row["LINK"]); ?>
                                <a href = "videos.php?id=<?php echo $row["CIM"] ?>">
                                <div class="tarto">
                                <img src="<?php echo $konvertal ?>" style="width:264px;height:180px;"></a>
                                <a href = "videos.php?id=<?php echo $row["CIM"] ?>">
                                    <img src="img/playicon.jpg" class="btn30" style="width:40px; height:40px;"></a>
                                </div>
                            </div>
                            <div class="szemelyesadatok">
                                <?php $cim = $row["CIM"]; ?>
                                <p class="neves"><?php echo $cim; ?></p>
                                <hr>
                                <p><?php echo $row["MEGTEKINTESEK_SZAMA"]; ?> megtekintés</p>
                                <p>Kategória: <?php echo $row["KATEGORIA"]; ?></p>
                                <hr>
                            </div>
                            <div class="gombs">
                                <form method="post">
                                    <button type="submit" value="<?php echo $link; ?>" name="delete_video"
                                            class="donebutton">Videó törlése </button>
                                </form>
                            </div>
                        </div>
                            <?php } ?>
                    </div>
                </div>
            </div>
        </div>

</div>
</div>
<?php 
include('footer.php');
?>