
<html>
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel=stylesheet type="text/css" href="videos.css" />
	<title>Videomegoszto</title>
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
 
 
$conn = oci_connect('system', 'root', $tns,'UTF8');

if(!isset($_GET['id'])){
	header('location:megoszt.php');
}
else if (isset($_GET['id'])) {
	echo "Link: " .$_GET['id']. "<br>ˇ";
}
include('functions.php');
	
?>
<?php 
	include('header.php');
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
			<div class ="videonak">
			<?php
				$k = $_GET['id'];
				$stmt1 = oci_parse($conn,"Select * from videok where cim = '$k'");
				oci_execute($stmt1);
				
				while ($row = oci_fetch_assoc($stmt1)){ ?>
				<div class= "video">
					
							<?php echo convertYoutubenagy($row["LINK"]); $vidi = $row["LINK"];?>
						
				</div>
				<div class ="cim">
					<h2><?php echo $row["CIM"] ?></h2>
					<h3><?php echo $row["MEGTEKINTESEK_SZAMA"]?></h3>
					
				</div>
				<div class ="iconbar">
					<a href= "user.php?id=<?php echo $row["FELHASZNALONEV"] ?>"><?php echo $row["FELHASZNALONEV"] ?> </a>
					<?php $usern = $row["FELHASZNALONEV"];  $kat = $row["KATEGORIA"]; ?>
				<?php } ?>
					<img src="kamera.jpg" style="width:40px;height:40px;">
					<img src="kamera.jpg" style="width:40px;height:40px;">
					<img src="kamera.jpg" style="width:40px;height:40px;">
				</div>
			</div>
			<div class= "hozzaszolasok">
			<?php 
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
					<p><?php echo $row["KOMMENT"] ?></p>
					</div>
				</div>
			<?php }	?>
			
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
					<a href= "user.php?id=<?php echo $row["FELHASZNALONEV"] ?>"><?php echo $row["FELHASZNALONEV"] ?> </a>
						</div>
				</div>
			<?php } ?>
			</div>
			<hr>
			<p id="tobb" onclick="novel()" >Több</p>
		</div>
		
	</div>
	<?php 
	include('footer.php');
	?>
</body>
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

</html>