<?php
session_name("video");
    include('functions.php');
    include('header.php');

if(isset($_POST["login_button"])) {
    $username = $_POST["uname"];
    $password = $_POST["psw"];

    $q = "SELECT * FROM FELHASZNALOK WHERE FELHASZNALONEV = '$username' AND JELSZO = '$password'";
    $stmt = oci_parse($conn, $q);
    oci_execute($stmt);

    if($rows = oci_fetch_array($stmt)){
        $_SESSION["user"] = (array)$rows;
        header("Location: user.php?id=" . $rows["FELHASZNALONEV"]);
        exit();
    }else{
        echo "Nem létezik ilyen felhasználónév vagy jelszó!";
    }

}

if(isset($_POST["logout_button"])){
    unset($_SESSION["user"]);
    session_destroy();
    header("Location: index.php");
    exit();
}
?>
<script>
    function expand(x){
        if (x == 3){
            var a = document.getElementById('3').innerHTML;
            if (a == 'Több'){
                document.getElementById('napi').style.height = '630px';
                document.getElementById('3').innerHTML = 'Vissza';
            } else if (a == 'Vissza'){
                document.getElementById('napi').style.height = '350px';
                document.getElementById('3').innerHTML = 'Több';
            }
        }
        if (x == 2){
            var a = document.getElementById('2').innerHTML;
            if (a == 'Több'){
                document.getElementById('heti').style.height = '630px';
                document.getElementById('2').innerHTML = 'Vissza';
            } else if (a == 'Vissza'){
                document.getElementById('heti').style.height = '350px';
                document.getElementById('2').innerHTML = 'Több';
            }
        }
        if (x == 1){
            var a = document.getElementById('1').innerHTML;
            if (a == 'Több'){
                document.getElementById('havi').style.height = '630px';
                document.getElementById('1').innerHTML = 'Vissza';
            } else if (a == 'Vissza'){
                document.getElementById('havi').style.height = '350px';
                document.getElementById('1').innerHTML = 'Több';
            }
        }


    }
</script>

	<div class="oszlopok">

    <?php include ("menu.php"); ?>
		<div class="main">





			<div class="ido">
				<div class="more">
				<div class="sorok" id = "havi">
				<h2>Havonta</h2>
				<div class="gridcontainer">
				<?php
				

				$stmt = oci_parse($conn,"Select link, cim, felhasznalonev from videok where rownum < 9 order by FELTOLTES_IDEJE");
				oci_execute($stmt);
				
				while ($row = oci_fetch_assoc($stmt)) {?>
				
				<div class="container">
					<div class="videonak">
						<?php $konvertal = konvertal($row["LINK"]); ?>
						<a href = "videos.php?id=<?php echo $row["CIM"] ?>">
						<img src="<?php echo $konvertal ?>" style="width:264px;height:180px;"></a>
					 </div>
					<div class="cim-es-adatok">
					<h3><?php echo $row["CIM"] ?></h3>
					<a href="user.php?id=<?php echo $row["FELHASZNALONEV"] ?> "><?php echo $row["FELHASZNALONEV"] ?></a>
						</div>
				</div>
				<?php } 
				
				oci_free_statement($stmt);
				?>
				</div>
				</div>
				<p onclick="expand(1)" id = "1">Több</p>
				</div>
			
				<div class="more">
				<div class="sorok" id="heti">
				<h2>Heti</h2>
				<div class="gridcontainer">
				<?php
				

				$stmt = oci_parse($conn,"Select link, cim, felhasznalonev from videok where rownum < 9 order by FELTOLTES_IDEJE");
				oci_execute($stmt);
				
				while ($row = oci_fetch_assoc($stmt)) {?>
				
				<div class="container">
					<div class="videonak">
						<?php $konvertal = konvertal($row["LINK"]); ?>
						<a href = "videos.php?id=<?php echo $row["CIM"] ?>">
						<img src="<?php echo $konvertal ?>" style="width:264px;height:180px;"></a>
					 </div>
					<div class="cim-es-adatok">
					<h3><?php echo $row["CIM"] ?></h3>
					<a href="user.php?id=<?php echo $row["FELHASZNALONEV"] ?> "><?php echo $row["FELHASZNALONEV"] ?></a>
						</div>
				</div>
				<?php } 
				
				oci_free_statement($stmt);
				?>
				</div>
				</div>
				<p onclick="expand(2)" id = "2">Több</p>
				</div>
				<div class="more">
				<div class="sorok" id="napi">
				<h2>Napi</h2>
				<div class="gridcontainer">
				<?php
				

				$stmt = oci_parse($conn,"Select link, cim, felhasznalonev from videok where rownum < 9 order by FELTOLTES_IDEJE");
				oci_execute($stmt);
				
				while ($row = oci_fetch_assoc($stmt)) {?>
				
				<div class="container">
					<div class="videonak">
						<?php $konvertal = konvertal($row["LINK"]); ?>
						<a href = "videos.php?id=<?php echo $row["CIM"] ?>">
						<img src="<?php echo $konvertal ?>" style="width:264px;height:180px;"></a>
					 </div>
					<div class="cim-es-adatok">
					<h3><?php echo $row["CIM"] ?></h3>
					<a href="user.php?id=<?php echo $row["FELHASZNALONEV"] ?> "><?php echo $row["FELHASZNALONEV"] ?></a>
						</div>
				</div>
				<?php } 
				
				oci_free_statement($stmt);
				?>
				</div>
				</div>
				<p onclick="expand(3)" id = "3">Több</p>
				</div>
		</div>
		</div>
	</div>
	<?php
	oci_close($conn);
	?>
<?php
include('footer.php');
?>
