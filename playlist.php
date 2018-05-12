<?php
session_name("video");
include('functions.php');
    include('header.php');
$uname = $_GET["id"];

if (isset($_POST["itemdelete"])){
	$vidi = $_POST["link"];
	$name = $uname;
	$lista = $_POST["list"];
	$q = "DELETE from ListabanVan where link = '$vidi' and felhasznalonev  ='$name' and lista_neve = '$lista'";
	$stmt = oci_parse($conn, $q);
    oci_execute($stmt);
	
}

if (isset($_POST["listdelete"])){
	$lista = $_POST["list"];
	$q = "DELETE from ListabanVan where lista_neve = '$lista'";
	$stmt = oci_parse($conn, $q);
    oci_execute($stmt);
	
}


?>



<div class="oszlopok6">
		
		<?php include ("menu.php"); ?>
    <div class="main6">

        <?php
        $stmt = oci_parse($conn,"Select distinct lista_neve from ListabanVan where felhasznalonev = '$uname'");
        oci_execute($stmt);

	
        while ($row = oci_fetch_assoc($stmt)) { ?>
			
            <div class="Listasor">
				<div class="kisoszlopok">
					<div class="bal">
						<div class="listanev">
							<h2>Lista neve: <?php echo $row["LISTA_NEVE"]; $list = $row["LISTA_NEVE"] ?> </h2>
							
							<?php if(isset($_SESSION["user"])){
										if ($_SESSION["user"][0] == $uname){
									?>
							<form action="" method="post">
                                        <input type="hidden" value="<?php echo $list;?>" name="list">
										<button class="listdeletebtn" type="submit" name="listdelete">Lista törlése</i></button>
										</form>
										
							<?php  } }?>
							
							<hr id ="listhr">
						</div>
						<div class="listanak">
						
						<?php
							$stmt2 = oci_parse($conn,"Select * from ListabanVan where felhasznalonev = '$uname' and lista_neve = '$list'");
							oci_execute($stmt2);
							$szam =0;
							while ($row = oci_fetch_assoc($stmt2)) { 
							$szam++;
							} ?>
							
						<?php
							$stmt7 = oci_parse($conn,"Select * from ListabanVan where felhasznalonev = '$uname' and lista_neve = '$list' and rownum < 2");
							oci_execute($stmt7);
							
							while ($row = oci_fetch_assoc($stmt7)) { ?>
							<?php $konvertal = konvertal($row["LINK"]); $videolink = $row["LINK"]; ?>
							<img src="<?php echo $konvertal ?>">
							<div class="gombok">
							<p id="listcount">A listában szereplő videók száma: <?php echo $szam ?></p>
							<a href="user.php?id=<?php echo $uname ?>" id="valt1" style="width:auto;">Vissza</a>
							</div>
						<?php } ?>
						</div>
						
					</div>

					<div class="jobb" id="jobb">
					<?php 
							oci_execute($stmt2);
							while ($row = oci_fetch_assoc($stmt2)) { ?>
								<?php $vid = $row["LINK"]; ?>
							<ul class="video-list-thumbs">
								<li class="videolista">
									<div class="haromresz">
									
									<?php if(isset($_SESSION["user"])){
										if ($_SESSION["user"][0] == $uname){
									?>
									
									<div class="közep">
										<form action="" method="post">
										<input type="hidden" value="<?php echo $row["LINK"]; ?>" name="link">
                                        <input type="hidden" value="<?php echo $list;?>" name="list">
										<button class="kozepbtn" type="submit" name="itemdelete"><i class="fa fa-close"></i></button>
										</form>
										
									</div>
										<?php }
									}
									?>
									<?php	
										$stmt3 = oci_parse($conn,"Select * from videok where link = '$vid'");
										oci_execute($stmt3);
										while ($row = oci_fetch_assoc($stmt3)) { ?>
									<div class="bal1">
									<a href="videos.php?id=<?php echo $vid ?>">
									<?php $thumbnail = konvertal($vid); ?>
									</a><div class="tarto">
									<a href = "videos.php?id=<?php echo $row["CIM"] ?>">
									<img src="<?php echo $thumbnail ?>" class="img-responsive" height="130px" /></a>
									<a href = "videos.php?id=<?php echo $row["CIM"] ?>"><img src="img/playicon.jpg" class="btn30" style="width:40px; height:40px;"></a>
									</div>
									</div>
									<div class="jobb1">
										
											<p> <?php echo $row["CIM"]  ?> </p>
											<a href="user.php?id=<?php echo $row["FELHASZNALONEV"] ?> "><?php echo $row["FELHASZNALONEV"] ?></a>
											<p id="megtekintesekszama6"><?php echo $row["MEGTEKINTESEK_SZAMA"] ?> Megtekintés</p>
											
										<?php }  ?>
									</div>
									
									</div>
								</li>
							</ul>

						<?php 
							}
						?>
					</div>
				</div>

			</div>
        <?php } ?>					
    </div>
</div>



<?php 
include('footer.php');
?>