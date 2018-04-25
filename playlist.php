<?php
session_name("video");
include('functions.php');
    include('header.php');
$uname = $_GET["id"];
?>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>



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
									
									<?php if(isset($_SESSION["user"])){ ?>
									
									<div class="közep">
										<button class="kozepbtn"><i class="fa fa-close"></i></button>
									</div>	
									<div class="bal1">
									<a href="videos.php?id=<?php echo $vid ?>">
									<?php $thumbnail = konvertal($vid); ?>
									<img src="<?php echo $thumbnail ?>" class="img-responsive" height="130px" />
									</a>
									</div>
									<div class="jobb1">
										<?php	
										$stmt3 = oci_parse($conn,"Select * from videok where link = '$vid'");
										oci_execute($stmt3);
										while ($row = oci_fetch_assoc($stmt3)) { ?>
											<p> <?php echo $row["CIM"]  ?> </p>
											<a href="user.php?id=<?php echo $row["FELHASZNALONEV"] ?> "><?php echo $row["FELHASZNALONEV"] ?></a>
											<p id="megtekintesekszama6"><?php echo $row["MEGTEKINTESEK_SZAMA"] ?> Megtekintés</p>
											
										<?php }  ?>
									</div>
									<?php } else { ?>
									<div class="bal1">
									<a href="videos.php?id=<?php echo $vid ?>">
									<?php $thumbnail = konvertal($vid); ?>
									<img src="<?php echo $thumbnail ?>" class="img-responsive" height="130px" />
									</a>
									</div>
									<div class="jobb1">
										<?php	
										$stmt3 = oci_parse($conn,"Select * from videok where link = '$vid'");
										oci_execute($stmt3);
										while ($row = oci_fetch_assoc($stmt3)) { ?>
											<p> <?php echo $row["CIM"]  ?> </p>
											<a href="user.php?id=<?php echo $row["FELHASZNALONEV"] ?> "><?php echo $row["FELHASZNALONEV"] ?></a>
											<p id="megtekintesekszama6"><?php echo $row["MEGTEKINTESEK_SZAMA"] ?> Megtekintés</p>
											
										<?php }  ?>
									</div>
									<?php } ?>
									
									
									
									
									</div>
								</li>
							</ul>

						<?php } ?>
					</div>
				</div>

			</div>
        <?php } ?>					
    </div>
</div>



<?php 
include('footer.php');
?>