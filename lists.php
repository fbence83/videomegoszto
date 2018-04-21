<html>
<head>
<link rel=stylesheet type="text/css" href="lists.css" />
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
 
 
$conn = oci_connect('Gac_Pet', '5bsxou30v7s', $tns,'UTF8');


include('header.php');
include('functions.php');
$kat = $_GET['cat'];

?>
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
		
			<?php 
			$stmt = oci_parse($conn,"Select * from videok where kategoria = '$kat'");
				oci_execute($stmt);
				
				while ($row = oci_fetch_assoc($stmt)) {
			?>
				<div class = "sor">
				<div class = "videonak">
					<?php $konvertal = konvertal480($row["LINK"]); ?>
						<a href = "videos.php?id=<?php echo $row["CIM"] ?>">
						<img src="<?php echo $konvertal ?>"></a>
				</div>
				<div class = "cim-es-adatok">
					<a href= "videos.php?id=<?php echo $row["CIM"] ?>  "> <?php echo $row["CIM"] ?></a>
					<hr>
					<a href="user.php?id=<?php echo $row["FELHASZNALONEV"] ?> "><?php echo $row["FELHASZNALONEV"] ?></a>
				</div>
				
				</div>
				<?php } ?>
			
		</div>
		</div>
<?php 
include('footer.php');
?>
</body>
</html>