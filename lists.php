<?php
    include('header.php');
    include('functions.php');
    $kat = $_GET['cat'];
?>
<div class="oszlopok">
		
		<?php include ("menu.php"); ?>
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