<html>
<head>
<link rel=stylesheet type="text/css" href="user.css" />
</head>
<body>
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
 
 
$nev = $_GET['id'];
 
$conn = oci_connect('system', 'root', $tns,'UTF8');


include('functions.php');				
include('header.php');?>



<div class="oszlopok">
		
		<div class= "side-menubar">
		<div class="side-menubar1">
		<p>Listák</p>
		<a href="#">Felkapott</a>
		<a href="#">Előzmények</a>
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
				<a href="#">Lejátszási listák</a>
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
						<a href = "videos.php?id=<?php echo $row["CIM"] ?>">
						<img src="<?php echo $konvertal ?>" style="width:264px;height:180px;"></a>
					 </div>
					<div class="cim-es-adatok">
					<a href= "videos.php?id=<?php echo $row["CIM"] ?>  "> <?php echo $row["CIM"] ?></a>
					<a href="user.php?id=<?php echo $row["FELHASZNALONEV"] ?> "><?php echo $row["FELHASZNALONEV"] ?></a>
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
</body>
</html>