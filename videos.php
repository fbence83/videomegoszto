<?php
session_name("video");

if(!isset($_GET['id'])){
	header('Location: index.php');
}else if (isset($_GET['id'])) {
	echo "Link: " .$_GET['id']. "<br>ˇ";
}
include('functions.php');

include('header.php');
/*if(isset($_POST["list_button"])){
	$videolink = $vidi;
	$user = $session["user"][0];
	$listnev = $_POST["list_name"];
	$q = "INSERT INTO ListabanVan VALUES('$videolink', '$user', '$listnev')";
	$stmt = oci_parse($conn, $q);
    oci_execute($stmt);
}

if(isset($_POST["list_button1"])){
	$videolink = $vidi;
	$user = $session["user"][0];
	$listnev = $_POST["list_name"];
	$q = "INSERT INTO ListabanVan VALUES('$videolink', '$user', '$listnev')";
	$stmt = oci_parse($conn, $q);
    oci_execute($stmt);
}*/




//komment törlés
if(isset($_POST["delete_comment"])){
    $comment = $_POST["comment"];
    $user = $_SESSION["user"][0];
    $link = $_POST["link"];
    $date = $_POST["date"];

    $q = "DELETE FROM HOZZASZOLASOK WHERE LINK='$link' AND FELHASZNALONEV='$user' AND MIKOR='$date' AND KOMMENT='$comment'";
    $stmt = oci_parse($conn, $q);
    oci_execute($stmt);

}

//komment törlés admin
if(isset($_POST["delete_comment_admin"])){
    $comment = $_POST["comment"];
    $user = $_POST["user"];
    $link = $_POST["link"];
    $date = $_POST["date"];

    $q = "DELETE FROM HOZZASZOLASOK WHERE LINK='$link' AND FELHASZNALONEV='$user' AND MIKOR='$date' AND KOMMENT='$comment'";
    $stmt = oci_parse($conn, $q);
    oci_execute($stmt);

}

?>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
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
	<script type="text/javascript">
	$(".myselect").select2();
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
                    $views = 0;

                    while ($row = oci_fetch_assoc($stmt1)){ ?>
                    <div class= "video8">
						
                        <?php echo convertYoutubenagy($row["LINK"]); $vidi = $row["LINK"]; $views = $row["MEGTEKINTESEK_SZAMA"]; ?>

                    </div>
                    <hr id = "hr5">
                    <div class ="cim8">
                        <h2><?php echo $row["CIM"] ?></h2>
                        <h3 id ="megtekint"><?php echo $row["MEGTEKINTESEK_SZAMA"]?> megtekintés</h3>

                    </div>
                    <div class ="iconbar8">
						<img src="img/default.png" id="kisavatar2" style="width:50px;height:50px;">
                        <a href= "user.php?id=<?php echo $row["FELHASZNALONEV"] ?>"><?php echo $row["FELHASZNALONEV"] ?> </a>
                        <?php $usern = $row["FELHASZNALONEV"];  $kat = $row["KATEGORIA"]; ?>
                        <?php }
                        $views++;
                        $q = "UPDATE VIDEOK SET MEGTEKINTESEK_SZAMA='$views' WHERE LINK='$vidi'";
                        $stmt = oci_parse($conn, $q);
                        oci_execute($stmt);

                        //hozzászólás felviele db-be
                        if(isset($_POST["submit"])){
                            $comment = $_POST["search3"];
                            $date = date("Y-m-d");
                            $user = $_SESSION["user"][0];
                            $q = "INSERT INTO HOZZASZOLASOK (LINK, FELHASZNALONEV, MIKOR, KOMMENT) VALUES ('$vidi', '$user', TO_DATE('$date', 'YY-MM-DD'), '$comment')";
                            $stmt = oci_parse($conn, $q);
                            oci_execute($stmt);

                        }
                        ?>
						
						
					<button class="btn" onclick = "document.getElementById('addtolist').style.display='block'" style="width:40px;height:40px"><i class="fa fa-bars"></i></button>
                    </div>
					<p id="felhaszn-megjegyzes" onclick="megjelen(this)">Több</p>
					<div class="usermegjegyzes" id="usermegjegyzes">
					
						
						<h1>Ide kell t</h1>
						<h1>Feltöltő</h1>
						<h1>megjegyzése</h1>
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
                    $stmt2=oci_parse($conn, "select * from hozzaszolasok where link= '$vidi' order by mikor");
                    oci_execute($stmt2);
                    while ($row = oci_fetch_assoc($stmt2)){
                        ?>
                        <div class = "hozzaszolas">
						
                            <div class="feltolto-nev8">
								<img src="img/default.png" id="kisavatar" style="width:50px;height:50px;">
                                <a href ="user.php?id=<?php echo $row["FELHASZNALONEV"] ?>"><?php echo $row["FELHASZNALONEV"] ?></a>
                                <p><?php echo $row["MIKOR"]?> </p>
                            </div>
                            <div class = "komment">
                                <table>
                                    <tr>
                                        <td>
                                            <p><?php echo $row["KOMMENT"] ?></p>
                                        </td>
                                        <td>
                                            <?php
                                            if(isset($_SESSION["user"])){
                                                foreach ($comments as $one) {
                                                    if($row["KOMMENT"] == $one["KOMMENT"]){
                                                        ?>
                                                        <form action="" method="post">
                                                            <input type="hidden" value="<?php echo $one["LINK"]; ?>" name="link">
                                                            <input type="hidden" value="<?php echo $one["MIKOR"]; ?>" name="date">
                                                            <input type="hidden" value="<?php echo $one["KOMMENT"];?>" name="comment">
                                                            <button type="submit" name="delete_comment">Törlés</button>
                                                        </form>
                                                        <?php
                                                    }
                                                }
                                            }if(ADMIN){ ?>
                                            <form action="" method="post">
                                                <input type="hidden" value="<?php echo $row["FELHASZNALONEV"]; ?>" name="user">
                                                <input type="hidden" value="<?php echo $row["LINK"]; ?>" name="link">
                                                <input type="hidden" value="<?php echo $row["MIKOR"]; ?>" name="date">
                                                <input type="hidden" value="<?php echo $row["KOMMENT"];?>" name="comment">
                                                <button type="submit" name="delete_comment_admin">Törlés</button>
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
                        <input type="text" placeholder="Hozzaszol.." name="search3">
                        <button type="submit" name="submit"><i class="fa fa-search"></i></button>
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="feltolto8">
            <h3 id="nah">Hasonlo Videok</h3>
            <hr>
            <div class="hasonlo" id="01">
                <?php
                $stmt4=oci_parse($conn, "select * from videok where kategoria= '$kat' ");
                oci_execute($stmt4);
                while ($row = oci_fetch_assoc($stmt4)){
                    ?>
                    <div class="container8">
                        <div class="videonak8">
                            <?php $konvertal = konvertal($row["LINK"]); ?>
                            <a href = "videos.php?id=<?php echo $row["CIM"] ?>">
                                <img src="<?php echo $konvertal ?>" style="width:264px;height:180px;"></a>
                        </div>
                        <div class="cim-es-adatok8">
                            <h3 class="jah"><?php echo $row["CIM"] ?></h3>
                            <a href= "user.php?id=<?php echo $row["FELHASZNALONEV"] ?>" id ="felhaszn"><?php echo $row["FELHASZNALONEV"] ?> </a>
                        </div>
                    </div>
                    <hr>
                <?php } ?>
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
			<select>
				<option value="0">Válassz listát:</option>
			<?php
			$szamol=1;
			$stmt6=oci_parse($conn, "select distinct lista_neve from ListabanVan where felhasznalonev= '$user' ");
                oci_execute($stmt6);
                while ($row = oci_fetch_assoc($stmt6)){
                    ?>
			
				<option value="<?php echo $szamol ?>"><?php echo $row["LISTA_NEVE"] ?></option>
				<?php $szamol++;
				} ?>
			</select>
			<button type="submit" id="submitlist1" name="list_button1" class="submitbutton">Listába!</button>
				</div>
				</form>
			</div>
			<div class="newlist">
			<h1>Új lista létrehozása</h1>
			<form class="listaletrehoz" method="POST" action="videos.php">
			 <p>Adja meg a lejátszási lista nevét</p>
				<input type="text" placeholder="Lista neve" name="listname" required>
				<button type="submit" id="submitlist" name="list_button" class="submitbutton">Listába!</button>
				<button type="button" onclick="document.getElementById('addtolist').style.display='none'" class="cancelbtn10">Cancel</button>
			<form>
			</div>
		</div>
	</div>
		
	<?php 
	include('footer.php');
	?>