<?php 
session_name("video");


include('functions.php');
include ('header.php');


if (isset($_POST["delete_fiok"])){
	$user = $_POST["felhasznev"];
	echo $user;
	/*$stmt = oci_parse($conn, "DELETE from felhasznalok where felhasznalonev = '$user'");
	oci_execute($stmt);*/
	
}



?>
<div class="oszlopok21">
		
	<?php include ("menu.php"); ?>
    <div class="main21">
		
			<div class="baloszlop">
			<h1>Felhasznalok Listája</h1>
					
			<div class = "felhasznaloklista">
						
						<?php 
						$stmt = oci_parse($conn,"select * from felhasznalok");
							oci_execute($stmt);
						
							while ($row = oci_fetch_assoc($stmt)) { ?>
							<?php  if ($row["FELHASZNALONEV"] == 'admin'){} else
								{
							?>
						<div class="sor">
							<div class="profil">
							<img src="img/<?php echo $row["KEP"] ?>" id="avatar" style="width:200px;height:200px;">
							</div>
							<div class="szemelyesadatok">
							<?php $user2 = $row["FELHASZNALONEV"]; ?>
							<p class="neves"><?php echo $row["FELHASZNALONEV"];?></p>
							<div class="modal2" id ="modal2">
													<div class="torloform">
														<h2>Biztosan törlöd a fiókot?<h2>
														<h2>Minden ehhez a fiókhoz kapcsolódó videó és hozzászólás törlődik</h2>
														<form action="" method="post">
														<!-- itt mindig a legelső felhasználóat adja vissza akármire kattintok -->
                                                            <input type="hidden" value="<?php echo $user2;?>" name="felhasznev">
															<div class="gombtarto">
                                                            <button type="submit" name="delete_fiok" class="donebutton">Véglegesít</button>
															<button class = "cancelbuttontorol" onclick="document.getElementById('modal2').style.display='none';")>Mégse</button>
															</div>
                                                        </form>
													</div>
										</div>
							<hr>
							<?php
							$stmt7 = oci_parse($conn,"select COUNT(LINK) from videok where felhasznalonev = '$user'");
							oci_execute($stmt7);
							while ($row = oci_fetch_assoc($stmt7)) {?>
							<p>Összesen <?php echo $row["COUNT(LINK)"] ?> feltöltött videó</p>
							<?php } ?>
							<?php
							$stmt4 = oci_parse($conn,"select COUNT(LINK) from hozzaszolasok where felhasznalonev = '$user'");
							oci_execute($stmt4);
							while ($row = oci_fetch_assoc($stmt4)) {?>
							<p>Összesen <?php echo $row["COUNT(LINK)"] ?> hozzászólás</p>
							<hr>
							</div>
							<hr>
							<?php } ?>
							<div class="gombs">
									<button onclick="document.getElementById('modal2').style.display = 'block';">Felhaszáló törlése</button>
										
							</div>
						</div>
						<?php 
								}
							} 
							 ?>
						
		</div>
			
    </div>
</div>
</div>
<?php 
include('footer.php');
?>