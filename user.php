<?php
session_name("video");
 
$nev = $_GET['id'];

include('functions.php');				
include('header.php');?>

<div class="oszlopok">

    <?php include ("menu.php"); ?>
    <div class="main">
        <div class ="felhasz">
            <h2><?php echo $nev ?> </h2>
        </div>
        <div class="newoszlop">

            <div class = "legnezettebb">
                <?php
                $stmt = oci_parse($conn,"Select link from videok where felhasznalonev = '$nev' and rownum < 2  order by megtekintesek_szama");
                oci_execute($stmt);

                while ($row = oci_fetch_assoc($stmt)) {?>
                    <div class="videonak">
                        <?php echo convertYoutube480($row["LINK"]);?>
                    </div>
                <?php } ?>

            </div>
            <div class="menubar">
                <a href="#">Videói</a>
                <hr>
                <a href="video_upload.php?id=<?php echo $nev; ?>">Videó feltöltése</a>
                <hr>
                <a href="#">Lejátszási listák</a>
                <hr>
                <a href="userdatas.php?id=<?php echo $nev; ?>">Adatok</a>
                <hr>
            </div>
        </div>
        <div class="Videoi">
            <h2>Videoi</h2>
        </div>
        <div class = "gridcontainer">
            <?php

            $stmt = oci_parse($conn,"Select link, cim, felhasznalonev from videok where felhasznalonev = '$nev' order by FELTOLTES_IDEJE");
            oci_execute($stmt);

            while ($row = oci_fetch_assoc($stmt)) {?>

                <div class="container">
                    <div class="videonak">
                        <?php $konvertal = konvertal($row["LINK"]); ?>
                        <a href = "videos.php?id=<?php echo $row["CIM"]; ?>">
                            <img src="<?php echo $konvertal; ?>" style="width:264px;height:180px;"></a>
                    </div>
                    <div class="cim-es-adatok">
                        <a href= "videos.php?id=<?php echo $row["CIM"]; ?>  "> <?php echo $row["CIM"]; ?></a>
                        <a href="user.php?id=<?php echo $row["FELHASZNALONEV"]; ?> " id="felhaszn"><?php echo $row["FELHASZNALONEV"]; ?></a>
                    </div>
                </div>
            <?php }


            ?>
        </div>
    </div>
</div>
<?php
include('footer.php');
?>