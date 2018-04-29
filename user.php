<?php
session_name("video");

$nev = $_GET['id'];
include('functions.php');
if ($_SESSION["user"][0] == "admin") {
    $_SESSION["admin"] = true;
}

if(($nev == "admin") && ($_SESSION["user"][0] != "admin")){
    header("Location: adminpanel.php");
    exit();
}

if($_SESSION["user"][0] == "admin"){
    header("Location: adminpanel.php");
    exit();
}
include('header.php');

if(isset($_POST["del"])){
    $link = $_POST["del"];

    $q = "DELETE FROM VIDEOK WHERE LINK='$link'";
    $stmt = oci_parse($conn, $q);
    oci_execute($stmt);
}

?>

<script>





</script>



<div class="oszlopok">

    <?php include ("menu.php"); ?>
    <div class="main">
        
        <div class="newoszlop">

            <div class = "legnezettebb">
				<p id="leginkabb">Legnézettebb videója</p>
                <?php
                $stmt = oci_parse($conn,"Select * from videok where felhasznalonev = '$nev' and rownum < 2  order by megtekintesek_szama");
                oci_execute($stmt);

                while ($row = oci_fetch_assoc($stmt)) { ?>
                    <div class="videonak10">
						<?php $konvertal = konvertal($row["LINK"]);  $felugrolink=$row["LINK"]?>
                        <div class="tarto">
                        <img src="<?php echo $konvertal ?>" onclick="document.getElementById('felugrik').style.display='block'" style="width460px;height:345px;">
						<img src="img/playicon.jpg" class="btn30" onclick="document.getElementById('felugrik').style.display='block'" style="width:80px; height:80px;"></a>
						</div><?php
                        $views = $row["MEGTEKINTESEK_SZAMA"];
                        ?>
						<p id="legtobbet"> Megtekintések száma: <?php echo $views ?></p>
                    </div>
                <?php }
                ?>

            </div>
			
			
            <div class="menubar10">
				<div class ="felhasz">
					<h2><?php echo $nev; ?> </h2>
				</div>
				<?php
				$stmt = oci_parse($conn,"Select * from felhasznalok where felhasznalonev = '$nev' ");
                oci_execute($stmt);

                while ($row = oci_fetch_assoc($stmt)) { ?>
				
			<img src="img/<?php echo $row["KEP"] ?>" id="avatar" style="width:200px;height:200px;">
				<?php } ?>
				
				<?php 
					if(isset($_SESSION["user"])){
						if (($_SESSION["user"][0]) == $nev ) {
					?>
					<a href="#" onclick ="document.getElementById('video1').style.display='block'; ">Videói</a>
                <hr>
                <a href="video_upload.php?id=<?php echo $nev; ?>">Videó feltöltése</a>
                <hr>
                <a href="playlist.php?id=<?php echo $nev; ?>">Lejátszási listák</a>
                <hr>
                <a href="userdatas.php?id=<?php echo $nev; ?>">Adatok</a>
                <hr>	
				<a href="#" onclick="document.getElementById('elozmeny').style.display='block'; " >Előzmények</a>

                <?php
                }	else { ?>
						<a href="#" onclick ="document.getElementById('video1').style.display='block';">Videói</a>
                <hr>
                <a href="playlist.php?id=<?php echo $nev; ?>">Lejátszási listák</a>
                <hr>
                <a href="userdatas.php?id=<?php echo $nev; ?>">Adatok</a>
                <hr>	
				<a href="#" onclick="document.getElementById('elozmeny').style.display='block'; " >Előzmények</a>
				<?php
						}
					} else {
				?>
				<a href="#" onclick ="document.getElementById('video1').style.display='block';">Videói</a>
                <hr>
                <a href="playlist.php?id=<?php echo $nev; ?>">Lejátszási listák</a>
                <hr>
				<a href="#" onclick="document.getElementById('elozmeny').style.display='block'; " >Előzmények</a>
					<?php } ?>
            </div>
        </div>
		<div class="Videoi1" id="video1">
        <div class="Videoi">
            <h2>Videói</h2>
			<img src = "img/bezaricon.png" onclick ="document.getElementById('video1').style.display='none';" style="height:30px;width:30px;">
        </div>
        <div class = "gridcontainer">
            <?php

            $stmt = oci_parse($conn,"Select *  from videok where felhasznalonev = '$nev' order by FELTOLTES_IDEJE");
            oci_execute($stmt);

            while ($row = oci_fetch_assoc($stmt)) {
                $link = $row["LINK"];
                ?>


                <div class="container3">
                    <div class="videonak3">
                        <?php $konvertal = konvertal($row["LINK"]); ?>
						<a href = "videos.php?id=<?php echo $row["CIM"] ?>">
						<div class="tarto">
						<img src="<?php echo $konvertal ?>" style="width:264px;height:180px;"></a>
						<a href = "videos.php?id=<?php echo $row["CIM"] ?>">
						<img src="img/playicon.jpg" class="btn30" style="width:40px; height:40px;"></a>
						 </div>
                    </div>
                    <div class="cim-es-adatok3">
                        <h3><?php echo $row["CIM"]; ?></h3>
                        <a href="user.php?id=<?php echo $row["FELHASZNALONEV"]; ?> "><?php echo $row["FELHASZNALONEV"]; ?></a>
						<p><?php echo $row["MEGTEKINTESEK_SZAMA"] ?> Megtekintés</p>
                        <?php if($_SESSION["user"][0] == $nev){ ?>
                        <form method="post">
                            <button type="submit" value="<?php echo $link; ?>" name="del">X</button>
                        </form>
                        <?php } ?>
                    </div>
                </div>
            <?php }


            ?>
        </div>
		</div>
		<div class="elozmenyek" id ="elozmeny">
		<div class="Videoi">
            <h2>Előzmények</h2>
			<img src = "img/bezaricon.png" onclick ="document.getElementById('video1').style.display='none';" style="height:30px;width:30px;">
        </div>
        <div class = "gridcontainer6">
            <?php

            $stmt2 = oci_parse($conn,"Select *  from megtekint where felhasznalonev = '$nev' and rownum < 9 order by megtekintes_ideje DESC");
            oci_execute($stmt2);
			
            while ($row1 = oci_fetch_assoc($stmt2)) {
			$linkes = $row1["LINK"];
			
			$stmt = oci_parse($conn,"Select *  from videok where link = '$linkes' ");
            oci_execute($stmt);
			
            while ($row = oci_fetch_assoc($stmt)) { ?>
			
                <div class="container3">
				
				  <?php /* echo date("Y-m-d h:i:s",strtotime($row1["MEGTEKINTES_IDEJE"])) */ ?> 
			
                    <div class="videonak3">
                        <?php $konvertal = konvertal($row["LINK"]); ?>
						<a href = "videos.php?id=<?php echo $row["CIM"] ?>">
						<div class="tarto">
						<img src="<?php echo $konvertal ?>" style="width:264px;height:180px;"></a>
						<a href = "videos.php?id=<?php echo $row["CIM"] ?>">
						<img src="img/playicon.jpg" class="btn30" style="width:40px; height:40px;"></a>
						 </div>
                    </div>
                    <div class="cim-es-adatok3">
                        <h3><?php echo $row["CIM"]; ?></h3>
                        <a href="user.php?id=<?php echo $row["FELHASZNALONEV"]; ?> "><?php echo $row["FELHASZNALONEV"]; ?></a>
						<p><?php echo $row["MEGTEKINTESEK_SZAMA"] ?> Megtekintés</p>
                    </div>
                </div>
            <?php }
			}

            ?>
        </div>
		
		
		
		</div>
    </div>
</div>
<?php
include('footer.php');
?>