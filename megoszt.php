<?php 
  $tns = "
(DESCRIPTION =
    (ADDRESS_LIST =
      (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521))
    )
    (CONNECT_DATA =
      (SID = xe)
    )
  )";
 
 
$conn = oci_connect('system', 'root', $tns,'UTF8');
?>


<html>
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel=stylesheet type="text/css" href="megoszt.css" />
	<title>Videomegoszto</title>
</head>
<body>

	<?php 
	include('functions.php');
	include('header.php');	
	?>
	
	<div class="oszlopok">
		
		<div class= "side-menubar">
		<div class="side-menubar1">
		<p>Listák</p>
		<a href="#">Felkapott</a>
		<a href="#">Népszerűek</a>
		<a href="#">Listák</a>
		</div>
		<hr>
		<div class="side-menubar1">
		<p>Kategóriák</p>
			<div class="side-menubar2">
				<?php
				$stmt = oci_parse($conn,"Select distinct kategoria from videok");
				oci_execute($stmt);
				
				while ($row = oci_fetch_assoc($stmt)) {?>
				<a href="lists.php?cat=<?php echo $row["KATEGORIA"] ?> "> <?php echo $row["KATEGORIA"] ?></a>
				
				<?php } ?>
			</div>
		</div>
		</div>
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
	include('footer.php');
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
	
	<?php
	oci_close($conn);
	?>
</body>
</html>