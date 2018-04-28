<?php
session_name("video");
    include('functions.php');

if(isset($_POST["login_button"])) {
    if(empty($_POST["uname"]) || empty($_POST["psw"])){
        echo "Hiba! Üres mező(k)!";
    }else{
        $username = $_POST["uname"];
        if(!empty($_POST["psw"])){
            $password = md5($_POST["psw"]);
        }

        $q = "SELECT * FROM FELHASZNALOK WHERE FELHASZNALONEV = '$username' AND JELSZO = '$password'";
        $stmt = oci_parse($conn, $q);
        oci_execute($stmt);

        if ($rows = oci_fetch_array($stmt)) {
            $_SESSION["user"] = (array)$rows;
            header("Location: user.php?id=" . $username);
            exit();
        } else {
			echo $username;
            echo "Hibás felhasználónév vagy jelszó!";
        }
    }

}

if(isset($_POST["logout_button"])){
    unset($_SESSION["user"]);
    session_destroy();
    header("Location: index.php");
    exit();
}

if(isset($_POST["registration"])){
    if($_POST["pass"] != $_POST["passa"]){
        echo "Hiba! Nem egyezik meg a két jelszó!";
    }else if(empty($_POST["username"]) || empty($_POST["pass"]) || empty($_POST["passa"]) || empty($_POST["email"]) || empty($_POST["gender"]) || empty($_POST["bday"])){
        echo "Hiba! Üresen maradt mező(k)!";
    }else{
        $uname = $_POST["username"];
        if(!empty($_POST["pass"])){
            $pass = md5($_POST["pass"]);
        }
        $email = $_POST["email"];
        $gender = $_POST["gender"];
        $bday = $_POST["bday"];

        $q = "INSERT INTO FELHASZNALOK (FELHASZNALONEV, JELSZO, EMAIL, SZULETESI_IDO, NEM) VALUES ('$uname', '$pass', '$email', TO_DATE('$bday', 'YY-MM-DD'), '$gender')";
        $stmt = oci_parse($conn, $q);
        oci_execute($stmt);

    }
}

if(isset($_SESSION["uname"])){
    header("Location: Location: user.php?id=".$username);
    exit();
}

include('header.php');
?>
<script>
    function expand(x){
        if (x == 3){
            var a = document.getElementById('3').innerHTML;
            if (a == 'Több'){
                document.getElementById('napi').style.height = '634px';
                document.getElementById('3').innerHTML = 'Vissza';
            } else if (a == 'Vissza'){
                document.getElementById('napi').style.height = '350px';
                document.getElementById('3').innerHTML = 'Több';
            }
        }
        if (x == 2){
            var a = document.getElementById('2').innerHTML;
            if (a == 'Több'){
                document.getElementById('heti').style.height = '634px';
                document.getElementById('2').innerHTML = 'Vissza';
            } else if (a == 'Vissza'){
                document.getElementById('heti').style.height = '350px';
                document.getElementById('2').innerHTML = 'Több';
            }
        }
        if (x == 1){
            var a = document.getElementById('1').innerHTML;
            if (a == 'Több'){
                document.getElementById('havi').style.height = '634px';
                document.getElementById('1').innerHTML = 'Vissza';
            } else if (a == 'Vissza'){
                document.getElementById('havi').style.height = '350px';
                document.getElementById('1').innerHTML = 'Több';
            }
        }


    }
</script>

	<div class="oszlopok3">

    <?php include ("menu.php"); ?>
		<div class="main3">
			
			
				
					<div class="oszlopos">
						<div class="legnezetebbvideo">
						<h2 class="fejlec">Legnézettebb videó</h2>
						<?php
						$stmt = oci_parse($conn,"select * from (Select * from videok order by MEGTEKINTESEK_SZAMA desc)where rownum =1");
							oci_execute($stmt);
				
							while ($row = oci_fetch_assoc($stmt)) {?>
						
						<div class="container-legnezetebb">
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
					<h3><?php echo $row["CIM"] ?></h3>
					<a href="user.php?id=<?php echo $row["FELHASZNALONEV"] ?> "><?php echo $row["FELHASZNALONEV"] ?></a>
					<p><?php echo $row["MEGTEKINTESEK_SZAMA"] ?> Megtekintés</p>
						</div>
						</div>
							<?php } 
							?>
						
						</div>
						<div class="legtobbetfeltolto">
						<h2 class="fejlec">Legaktívabb feltöltő</h2>
						<?php 
						$stmt3 = oci_parse($conn,"Select * from felhasznalok where felhasznalonev = (select felhasznalonev from (select felhasznalonev from videok group by felhasznalonev  order by COUNT(link) DESC) where rownum = 1)");
							oci_execute($stmt3);
				
							while ($row = oci_fetch_assoc($stmt3)) {?>
							<div class="tarolo">
							<div class="profilkep-tarolo">
								<img src="img/<?php echo $row["KEP"] ?>"  style="width:200px;height:200px;">
								
							</div>
							<div class="adatok-tarolo">
								<a href = "user.php?id=<?php echo $row["FELHASZNALONEV"]; ?>"> <?php echo $row["FELHASZNALONEV"]; ?></a>
							<?php
							$stmt31 = oci_parse($conn,"select * from (select * from (select felhasznalonev, COUNT(link)from videok group by felhasznalonev  order by COUNT(link) DESC)) where rownum = 1");
							oci_execute($stmt31);
				
							while ($row = oci_fetch_assoc($stmt31)) {?>	
								<p><?php echo $row["COUNT(LINK)"] ?> Feltöltés</p>
							<?php } ?>
							</div>	
							</div>
						</div>
							<?php } ?>
						<div class="legaktivabbkomment">
						 <h2 class="fejlec">Legaktívabb hozzászóló</h2>
						<?php
						$stmt6 = oci_parse($conn,"select * from felhasznalok where felhasznalonev = (select * from (select felhasznalonev from hozzaszolasok group by felhasznalonev  order by COUNT(link) DESC) where rownum = 1)");
							oci_execute($stmt6);
				
							while ($row = oci_fetch_assoc($stmt6)) {?>
							<div class="tarolo">
							<div class="profilkep-tarolo">
								<img src="img/<?php echo $row["KEP"] ?>"  style="width:200px;height:200px;">
								
							</div>
							<div class="adatok-tarolo">
								<a href = "user.php?id=<?php echo $row["FELHASZNALONEV"]; ?>"> <?php echo $row["FELHASZNALONEV"]; ?></a>
								<?php
							$stmt61 = oci_parse($conn,"select * from (select * from (select felhasznalonev, COUNT(link)from hozzaszolasok group by felhasznalonev  order by COUNT(link) DESC)) where rownum = 1");
							oci_execute($stmt61);
				
							while ($row = oci_fetch_assoc($stmt61)) {?>	
								<p><?php echo $row["COUNT(LINK)"] ?> Hozzászólás</p>
							<?php } ?>
							</div>	
							</div>
						
						
							<?php } ?>
							</div>
						</div>




			<div class="ido">
				<div class="more3">
				<div class="sorok3" id = "havi">
				<h2>Havonta</h2>
				<div class="gridcontainer3">
				<?php
				

				$stmt = oci_parse($conn,"Select * from videok where rownum < 9 order by FELTOLTES_IDEJE");
				oci_execute($stmt);
				
				while ($row = oci_fetch_assoc($stmt)) {?>
				
				<div class="container3">
					<div class="videonak3">
					<div class="tarto">
						<?php $konvertal = konvertal($row["LINK"]); ?>
					</div>
						<a href = "videos.php?id=<?php echo $row["CIM"] ?>">
						<div class="tarto">
						<img src="<?php echo $konvertal ?>" style="width:264px;height:180px;"></a>
						<a href = "videos.php?id=<?php echo $row["CIM"] ?>">
						<img src="img/playicon.jpg" class="btn30" style="width:40px; height:40px;"></a>
						</div>
					 </div>
					<div class="cim-es-adatok3">
					<h3><?php echo $row["CIM"] ?></h3>
					<a href="user.php?id=<?php echo $row["FELHASZNALONEV"] ?> "><?php echo $row["FELHASZNALONEV"] ?></a>
					<p><?php echo $row["MEGTEKINTESEK_SZAMA"] ?> Megtekintés</p>
						</div>
				</div>
				<?php } 
				
				oci_free_statement($stmt);
				?>
				</div>
				</div>
				<p class="moregomb" onclick="expand(1)" id = "1">Több</p>
				</div>
			
				<div class="more3">
				<div class="sorok3" id="heti">
				<h2>Heti</h2>
				<div class="gridcontainer3">
				<?php
				

				$stmt = oci_parse($conn,"Select * from videok where rownum < 9 order by FELTOLTES_IDEJE");
				oci_execute($stmt);
				
				while ($row = oci_fetch_assoc($stmt)) {?>
				
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
					<h3><?php echo $row["CIM"] ?></h3>
					<a href="user.php?id=<?php echo $row["FELHASZNALONEV"] ?> "><?php echo $row["FELHASZNALONEV"] ?></a>
					<p><?php echo $row["MEGTEKINTESEK_SZAMA"] ?> Megtekintés</p>
						</div>
				</div>
				<?php } 
				
				oci_free_statement($stmt);
				?>
				</div>
				</div>
				<p class="moregomb" onclick="expand(2)" id = "2">Több</p>
				</div>
				<div class="more3">
				<div class="sorok3" id="napi">
				<h2>Napi</h2>
				<div class="gridcontainer3">
				<?php
				

				$stmt = oci_parse($conn,"Select * from videok where rownum < 9 order by FELTOLTES_IDEJE");
				oci_execute($stmt);
				
				while ($row = oci_fetch_assoc($stmt)) {?>
				
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
					<h3><?php echo $row["CIM"] ?></h3>
					<a href="user.php?id=<?php echo $row["FELHASZNALONEV"] ?> "><?php echo $row["FELHASZNALONEV"] ?></a>
					<p><?php echo $row["MEGTEKINTESEK_SZAMA"] ?> Megtekintés</p>
						</div>
				</div>
				<?php } 
				
				oci_free_statement($stmt);
				?>
				</div>
				</div>
				<p class="moregomb" onclick="expand(3)" id = "3">Több</p>
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
