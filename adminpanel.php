<?php 
session_name("video");


include('functions.php');
if ($_SESSION["user"][0] == "admin") {
    $_SESSION["admin"] = true;
}else{
    header("Location: index.php");
    exit();
}
include ('header.php');

if (isset($_POST["delete_fiok"])){
	$user = $_POST["delete_fiok"];
    echo $user;
    $stmt = oci_parse($conn, "DELETE from felhasznalok where felhasznalonev = '$user'");
	oci_execute($stmt);
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
						
							while ($row = oci_fetch_assoc($stmt)) {
							    if($row["FELHASZNALONEV"] != "admin") {
                                    ?>
                                    <div class="sor">
                                        <div class="profil">
                                            <img src="img/<?php echo $row["KEP"] ?>" id="avatar"
                                                 style="width:200px;height:200px;">
                                        </div>
                                        <div class="szemelyesadatok">
                                            <?php $user2 = $row["FELHASZNALONEV"]; ?>
                                            <p class="neves"><?php echo $user2; ?></p>

                                            <hr>
                                            <?php
                                            $stmt7 = oci_parse($conn, "select COUNT(LINK) from videok where felhasznalonev = '$user2'");
                                            oci_execute($stmt7);
                                            while ($row = oci_fetch_assoc($stmt7)) { ?>
                                                <p>Összesen <?php echo $row["COUNT(LINK)"] ?> feltöltött videó</p>
                                            <?php } ?>
                                            <?php
                                            $stmt4 = oci_parse($conn, "select COUNT(LINK) from hozzaszolasok where felhasznalonev = '$user2'");
                                            oci_execute($stmt4);
                                            while ($row = oci_fetch_assoc($stmt4)) { ?>
                                            <p>Összesen <?php echo $row["COUNT(LINK)"] ?> hozzászólás</p>
                                            <hr>
                                        </div>
                                        <hr>
                                        <?php } ?>
                                        <div class="gombs">
                                            <form method="post">
                                                <button type="submit" value="<?php echo $user2; ?>" name="delete_fiok"
                                                        class="donebutton">Fiók törlése
                                                </button>
                                            </form>
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