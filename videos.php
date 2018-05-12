<?php
session_name("video");

if(!isset($_GET['id'])){
	header('Location: index.php');
}else if (isset($_GET['id'])) {
	echo "Link: " .$_GET['id']. "<br>ˇ";
}


include('functions.php');
include('header.php');

if(isset($_POST["list_button"])){
	$videolink = $_POST["linkes"];
	$usern = $_POST["user1"];
	$listnev = $_POST["listname"];
	$q = "INSERT INTO ListabanVan VALUES('$videolink', '$usern', '$listnev')";
	$stmt = oci_parse($conn, $q);
    oci_execute($stmt);
	oci_free_statement($stmt);
}

if(isset($_POST["list_button1"])){
	$videolink = $_POST["linkes"];
	$usern = $_POST["user1"];
	$listnev = $_POST['listname1'];
	$q = "INSERT INTO ListabanVan VALUES('$videolink', '$usern', '$listnev')";
	$stmt = oci_parse($conn, $q);
    oci_execute($stmt);
	oci_free_statement($stmt);
}

if(isset($_POST["kommentel"])){
	$videolink = $_POST["linkes1"];
	$usern = $_POST["user2"];
	$komment= $_POST["komment"];
	$date = date("Y-m-d h:i:s");	
	echo $date;
	$q = "INSERT INTO HOZZASZOLASOK VALUES('$videolink', '$usern', TO_DATE('$date', 'YY-MM-DD HH24:MI:SS'), '$komment')";
	$stmt = oci_parse($conn, $q);
    oci_execute($stmt);	
	oci_free_statement($stmt);	
}


//komment törlés
if(isset($_POST["delete_comment"])){
    $comment = $_POST["comment"];
    $user = $_SESSION["user"][0];
    $link = $_POST["link"];
    $date = $_POST["date"];
	
	
  
	$q = "DELETE FROM HOZZASZOLASOK WHERE LINK='$link' AND FELHASZNALONEV='$user' AND MIKOR=TO_DATE('$date', 'dd-MON-yyyy hh24:mi:ss') AND KOMMENT='$comment'";
    $stmt = oci_parse($conn, $q);
    oci_execute($stmt);
	oci_free_statement($stmt);

}

//komment törlés admin
if(isset($_POST["delete_comment_admin"])){
    $comment = $_POST["comment2"];
    $user = $_POST["user2"];
    $link = $_POST["link2"];
    $date = $_POST["date2"];

	
	
    $q = "DELETE FROM HOZZASZOLASOK WHERE LINK='$link' AND FELHASZNALONEV='$user' AND MIKOR=TO_DATE('$date', 'dd-MON-yyyy hh24:mi:ss') AND KOMMENT='$comment'";
    $stmt = oci_parse($conn, $q);
    oci_execute($stmt);
	oci_free_statement($stmt);
}

//megjegyzés változtatása a videó alatt
if(isset($_POST["megjegyzes"])){
    $text = $_POST["text"];
    $link = $_POST["link"];

    $q = "UPDATE VIDEOK SET MEGJEGYZES='$text' WHERE LINK='$link'";
    $stmt = oci_parse($conn, $q);
    oci_execute($stmt);
	oci_free_statement($stmt);
}

//cimke hozzáadása a videóhoz
if(isset($_POST["cimke_hozzaadas"])){
    $cimke = $_POST["cimke"];
    $vidi = $_POST["cimke_hozzaadas"];

    $q = "INSERT INTO CIMKEK (LINK, CIMKE) VALUES ('$vidi', '$cimke')";
    $stmt = oci_parse($conn, $q);
    oci_execute($stmt);
	oci_free_statement($stmt);
}

//cimke törlése a videó alól
if(isset($_POST["cimketorol"])){
    $cimke = $_POST["cimketorol"];
    $link = $_POST["link"];

    $q = "DELETE FROM CIMKEK WHERE LINK='$link' AND CIMKE='$cimke'";
    $stmt = oci_parse($conn, $q);
    oci_execute($stmt);
    
}

?>



<script>
function novel(){
            var x = document.getElementById('tobb').innerHTML;
            if (x == 'Több'){
                document.getElementById('01').style.height = '330%';
                document.getElementById('tobb').innerHTML = 'Vissza';
            }
            else {
                document.getElementById('01').style.height = '140%';
                document.getElementById('tobb').innerHTML = 'Több';
            }
        }
</script>
<script>
function megjelen(id){
            var x = id.innerHTML;
            if (x == 'Több'){
                document.getElementById('usermegjegyzes').style.display = 'block';
                document.getElementById('felhaszn-megjegyzes').innerHTML = 'Kevesebb';
            }
            else {
                document.getElementById('usermegjegyzes').style.display = 'none';
                document.getElementById('felhaszn-megjegyzes').innerHTML = 'Több';
            }
        }
    </script>
	
	
<script>
var modal = document.getElementById('felugrik');

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
</script>
	
	
	<div class="oszlopok8">
        <?php include ("menu.php"); ?>
        <div class="main8">
            <div class="video">
                <div class ="videonak8">
                    <?php
                    $k = $_GET['id'];
                    $stmt1 = oci_parse($conn,"Select * from videok where cim = '$k'");
                    oci_execute($stmt1);
                    $vidi = '';
                    $megjegyzes = '';
					
					$vidicimke = $row["LINK"];
					
					
					
					
					
                    while ($row = oci_fetch_assoc($stmt1)){ ?>
                    <div class= "video8">
						
                        <div class="container3" id="videotbehoz">
                            <?php $konvertal = konvertal($row["LINK"]);  $vidi=$row["LINK"];?>
							<div class="tarto">
                            <img src="<?php echo $konvertal; ?>" onclick="document.getElementById('felugrik').style.display='block'" style="width720px;height:480px;">
							<img src="img/playicon.jpg" class="btn30" onclick="document.getElementById('felugrik').style.display='block'" style="width:80px; height:80px;">
							</div>
						</div>

                    </div>
                    <hr id = "hr5">
					
					
                    <div class ="cim8">
                        <h2><?php echo $row["CIM"]; ?></h2>
                        <h3 id ="megtekint"><?php echo $row["MEGTEKINTESEK_SZAMA"];?> megtekintés</h3>
                        
						
                    </div>
					
					<div class="tags">
					<h5>Feltöltés ideje: <?php echo $row["FELTOLTES_IDEJE"]; ?></h5>
						<?php
						$stmt4 = oci_parse($conn,"Select cimke from cimkek where link = '$vidi'");
                    oci_execute($stmt4);
					while ($row3 = oci_fetch_assoc($stmt4)){ ?>	
						<a href="lists.php?id=<?php echo $row3["CIMKE"]; ?>"><?php echo $row3["CIMKE"]; ?></a>
						
					<?php } ?>
					<?php oci_free_statement($stmt4); ?>
					</div>
					
					
                    <div class ="iconbar8">
						<img src="img/default.png" id="kisavatar2" style="width:50px;height:50px;">
                        <a href= "user.php?id=<?php echo $row["FELHASZNALONEV"]; ?>"><?php echo $row["FELHASZNALONEV"]; ?> </a>
                        <?php $usern = $row["FELHASZNALONEV"];  $kat = $row["KATEGORIA"]; $views = $row["MEGTEKINTESEK_SZAMA"]; $megjegyzes = $row["MEGJEGYZES"]; ?>
                        <?php }
                        $views=$views+1;
                        $q = "UPDATE VIDEOK SET MEGTEKINTESEK_SZAMA='$views' WHERE LINK='$vidi'";
                        $stmt = oci_parse($conn, $q);
                        oci_execute($stmt);

                        if(isset($_SESSION["user"])) {
                            $username = $_SESSION["user"][0];
                            $date = date("Y-m-d h:i:s");
							
							
							
                            $q2 = "INSERT INTO MEGTEKINT (LINK, FELHASZNALONEV, MEGTEKINTES_IDEJE) VALUES ('$vidi', '$username', TO_DATE('$date', 'YY-MM-DD HH24:MI:SS'))";
                            $stmt2 = oci_parse($conn, $q2);
                            oci_execute($stmt2);
                        }

                        ?>
						
					<?php if(isset($_SESSION["user"])) { ?>
					<button class="btn" onclick = "document.getElementById('addtolist').style.display='block'" style="width:40px;height:40px"><i class="fa fa-bars"></i></button>
					<?php } else {} ?> 
						
					</div>
					<p id="felhaszn-megjegyzes" onclick="megjelen(this)">Több</p>
					<div class="usermegjegyzes" id="usermegjegyzes">
                        <div id="tabs">
                            <ul>
                                <li><a href="#tabs-1" style="background: #4CAF50;">Részletek</a></li>
                                <?php if($_SESSION["user"][0] == $usern){ ?>
                                <li><a href="#tabs-2" style="background: #4CAF50;">Megjegyzés módosítása</a></li>
                                <li><a href="#tabs-3" style="background: #4CAF50;">Címkék</a></li>
                                <?php } ?>
                            </ul>
                            <div id="tabs-1">
                                <h1><?php echo $megjegyzes; ?></h1>
                            </div>
                            <?php if($_SESSION["user"][0] == $usern){ ?>
                            <div id="tabs-2">
                                <form method="post">
                                    <input type="text" name="text" placeholder="Ide írd a megjegyzést.">
                                    <input type="hidden" name="link" value="<?php echo $vidi; ?>">
                                    <button type="submit" name="megjegyzes">Módosít</button>
                                </form>
                            </div>
                            <div id="tabs-3">
                                <div class="tags">
                                    <?php
                                    $stmt4 = oci_parse($conn,"Select cimke from cimkek where link = '$vidi'");
                                    oci_execute($stmt4);
                                    while ($row3 = oci_fetch_assoc($stmt4)){ ?>
                                        <table>
                                            <tr>
                                                <td><?php echo $row3["CIMKE"]; ?></td>
                                                <td><form action="" method="post">
                                                        <input type="hidden" name="link" value="<?php echo $vidi; ?>">
                                                        <button type="submit" value="<?php echo $row3["CIMKE"]; ?>" name="cimketorol">X</button>
                                                    </form></td>
                                            </tr>
                                        </table>
                                    <?php } ?>
                                    <?php oci_free_statement($stmt4); ?>
                                </div>
                                <div class="addcimke">
                                    <form action="" method="post">
                                        <input type="text" name="cimke" placeholder="Címke hozzáadása">
                                        <button type="submit" value="<?php echo $vidi; ?>" name="cimke_hozzaadas">Hozzáad</button>
                                    </form>
                                </div>
                            </div>
                            <?php } ?>
					</div>
                    </div>
                    <hr id="hr6">
                </div>
            </div>
            <div class="comment">
			
                <div class= "hozzaszolasok">
                    <?php
                    //kiszedtem a bejelentkezett user kommentjeit amelyek kapcsolódnak ehhez a videóhoz
                    if(isset($_SESSION["user"])) {
                        $user = $_SESSION["user"][0];
                        $q = "SELECT * FROM HOZZASZOLASOK WHERE FELHASZNALONEV='$user' AND LINK='$vidi' ORDER BY MIKOR";
                        $stmt5 = oci_parse($conn, $q);
                        oci_execute($stmt5);
                        $i = 0;
                        $comments = array();
                        while ($row2 = oci_fetch_assoc($stmt5)) {
                            $comments[$i] = $row2;
                            $i++;
                        }
                    }
                    //listázzuk az összes hozzászólást
                    $stmt2=oci_parse($conn, "select felhasznalonev, komment, link, TO_CHAR(MIKOR , 'dd-MON-yyyy hh24:mi:ss') as ido  from hozzaszolasok where link= '$vidi' order by mikor");
                    oci_execute($stmt2);
                    while ($row = oci_fetch_assoc($stmt2)){
                        ?>
                        <div class = "hozzaszolas">
						
                            <div class="feltolto-nev8">
								<img src="img/default.png" id="kisavatar" style="width:50px;height:50px;">
                                <a href ="user.php?id=<?php echo $row["FELHASZNALONEV"] ?>"><?php echo $row["FELHASZNALONEV"] ?></a>
                                <p><?php 
								echo ($row["IDO"]); $datestring = $row["IDO"];
								?> </p>
								
								
								
								
								
                            </div>
                            <div class = "komment">
                                <table>
                                    <tr>
                                        <td>
                                            <p class="kommentenbelul"><?php echo $row["KOMMENT"] ?></p>
                                        </td>
                                        <td>
                                            <?php
                                            if(isset($_SESSION["user"])){
                                                foreach ($comments as $one) {
                                                    if($row["KOMMENT"] == $one["KOMMENT"]){
                                                        ?>
                                                        <form action="" method="post" id="komment2">
                                                            <input type="hidden" value="<?php echo $one["LINK"]; ?>" name="link">
                                                            <input type="hidden" value="<?php echo $datestring; ?>" name="date">
                                                            <input type="hidden" value="<?php echo $one["KOMMENT"];?>" name="comment">
                                                            <button type="submit" name="delete_comment" class="torlesgomb" id="button2">Törlés</button>
                                                        </form>
                                                        <?php
                                                    }
                                                }
                                            }if(ADMIN){ ?>
                                            <form action="" method="post">
                                                <input type="hidden" value="<?php echo $row["FELHASZNALONEV"]; ?>" name="user2">
                                                <input type="hidden" value="<?php echo $row["LINK"]; ?>" name="link2">
                                                <input type="hidden" value="<?php echo $datestring; ?>" name="date2">
                                                <input type="hidden" value="<?php echo $row["KOMMENT"];?>" name="comment2">
												<button type="submit" name="delete_comment_admin" class="torlesgomb">Törlés</button>
                                            </form>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <hr id="comment">
                        </div>
                    <?php }	?>
                </div>
                <div class = "hozzaszol">
                    <?php if(!ADMIN){ ?>
                    <p>Megjegyzés</p>
                    <form class="megjegyzes" action="" method="POST">
						<input type="hidden" value="<?php echo $vidi; ?>" name="linkes1">
						<input type="hidden" value="<?php echo $user; ?>" name="user2">
                        <input type="text" placeholder="Hozzaszol.." name="komment">
                        <button type="submit" name="kommentel"><i class="fa fa-search"></i></button>
                    </form>
                    <?php } ?>
                </div>
            </div>
			
			<div class="felhasznegyeb">
			<hr class="elvalaszt">
				<h2><?php echo $usern ?> egyéb videói</h2>
			<hr class="elvalaszt">
				
				<?php	
				$stmt4=oci_parse($conn, "select * from videok where felhasznalonev= '$usern' and rownum < 9");
                oci_execute($stmt4);
				
                while ($row = oci_fetch_assoc($stmt4)){ ?>
                    
					
					
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
                            <h3 class="jah"><?php echo $row["CIM"] ?></h3>
                            <a href= "user.php?id=<?php echo $row["FELHASZNALONEV"] ?>" id ="felhaszn"><?php echo $row["FELHASZNALONEV"] ?> </a>
							<p id=><?php echo $row["MEGTEKINTESEK_SZAMA"] ?> Megtekintés</p>
                        </div>
                    </div>
					
					<?php } 
				
					oci_free_statement($stmt);
					?>
					
                    
               
				
				
				
			</div>
			
			
			
        </div>
        <div class="feltolto8">
            <h3 id="nah">Hasonlo Videok</h3>
            <hr>
            <div class="hasonlo" id="01">
                <?php
				
				
				$sql = 'BEGIN HASONLOHOZ.hasonlo(:keres, :keres_cursor); END;';

				$stmt = oci_parse($conn, $sql);
					$max_entries = $kat;
					oci_bind_by_name($stmt,":keres",$max_entries,32);

					$keres_cursor = oci_new_cursor($conn);
					oci_bind_by_name($stmt,":keres_cursor",$keres_cursor,-1,OCI_B_CURSOR);

					oci_execute($stmt);

					oci_execute($keres_cursor);
				
				
					while ($entry = oci_fetch_assoc($keres_cursor)) {
					 $kell = $entry["LINK"]; 
						$stmt2 = oci_parse($conn,"select * from videok where link = '$kell' ");
							oci_execute($stmt2);
				
							while ($row = oci_fetch_assoc($stmt2)) {?>
						
	 
						
              <?php /* $stmt4=oci_parse($conn, "select * from videok where kategoria= '$kat' ");
                oci_execute($stmt4);
                while ($row = oci_fetch_assoc($stmt4)){*/ ?>
					
					
					
					
                   
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
                            <h3 class="jah"><?php echo $row["CIM"] ?></h3>
                            <a href= "user.php?id=<?php echo $row["FELHASZNALONEV"] ?>" id ="felhaszn"><?php echo $row["FELHASZNALONEV"] ?> </a>
							<p id=><?php echo $row["MEGTEKINTESEK_SZAMA"] ?> Megtekintés</p>
                        </div>
                    </div>
                    <hr>
						<?php } } ?>
            </div>
            <hr>
            <p id="tobb" onclick="novel()" >Több</p>
        </div>

    </div>
	<div class="modal3" id="addtolist">
		<div class="addtolist">
		<div class="listexist">
			<h1>Hozzáadás listához</h1>
			<?php 
			$user = $_SESSION["user"][0];
			
			?>
			<form action="videos.php" method ="POST">
			<div class="myselect" style="width:200px;">
			<select name="listname1">
				
			<?php 
			
			$stmt6=oci_parse($conn, "select distinct lista_neve from ListabanVan where felhasznalonev= '$user' 
									minus 
									select lista_neve  from ListabanVan where felhasznalonev= '$user' and link = '$vidi'");
                oci_execute($stmt6);
				while ($row = oci_fetch_assoc($stmt6)){
					?>
					<option value="<?php echo $row["LISTA_NEVE"] ?>"><?php echo $row["LISTA_NEVE"] ?></option>
				<?php  }  ?>
			
			</select>
			<input type="hidden" value="<?php echo $vidi; ?>" name="linkes">
            <input type="hidden" value="<?php echo $user; ?>" name="user1">
			<button type="submit" id="submitlist1" name="list_button1" class="submitbutton">Listába!</button>
				</div>
				</form>
			</div>
			<div class="newlist">
			<h1>Új lista létrehozása</h1>
			<form class="listaletrehoz" method="POST" action="videos.php">
			 <p>Adja meg a lejátszási lista nevét</p>
				<input type="hidden" value="<?php echo $vidi; ?>" name="linkes">
                <input type="hidden" value="<?php echo $user; ?>" name="user1">
				<input type="text" placeholder="Lista neve" name="listname" required>
				<button type="submit" id="submitlist" name="list_button" class="submitbutton">Listába!</button>
				<button type="button" onclick="document.getElementById('addtolist').style.display='none'" class="cancelbtn10">Cancel</button>
			<form>
			</div>
		</div>
	</div>
		
	<div class="videofelugro" id="felugrik">
		<button class="close" onclick="document.getElementById('felugrik').style.display='none'"><i class="fa fa-close" ></i></button>
		<div class="nagyvideo">
		<?php echo convertYoutubenagy($vidi)?>
		</div>
	</div>
		
	<?php 
	include('footer.php');
	?>