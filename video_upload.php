<?php
session_name("video");

$nev = $_GET['id'];

include('functions.php');

if(!isset($_SESSION["user"])){
    header("Location: index.php");
    exit();
}
include('header.php');

if(isset($_POST["upload"])){
    if(empty($_POST["link"]) || empty($_POST["cim"]) || empty($_POST["kategoria"])){
        echo "Hiba! Üres mező(k)!";
    }else{
        $link = $_POST["link"];
        $cim = $_POST["cim"];
        $kategoria = $_POST["kategoria"];
        $date = date("Y-m-d");
        $uname = $_SESSION["user"][0];

        $q = "INSERT INTO VIDEOK (LINK, CIM, KATEGORIA, FELTOLTES_IDEJE, FELHASZNALONEV) VALUES ('$link', '$cim', '$kategoria', TO_DATE('$date', 'YY-MM-DD'), '$uname')";
        $stmt = oci_parse($conn, $q);
        oci_execute($stmt);
    }

}

$categories = array();
$q = "SELECT KATEGORIA FROM VIDEOK";
$stmt = oci_parse($conn, $q);
oci_execute($stmt);

$i = 0;
while($rows = oci_fetch_assoc($stmt)){
    $categories[$i] = $rows["KATEGORIA"];
    $i++;
}

$categories = array_values($categories);
$categories = array_unique($categories);

?>

    <div class="oszlopok">

        <?php include ("menu.php"); ?>
        <div class="main">
            <div class ="felhaszn3">
                <h2>Video Feltöltés </h2>
                <a href="user.php?id=<?php echo $nev; ?>">Vissza az előző oldalra</a>
            </div>
			
            <div class="feltoltes4">
                <form method="post" class="aktual">
                    <table>
                        <tr><td><label for="link">Link:</label><input type="text" id="link" name="link"/></td></tr>
                        <tr><td><label for="cim">Cím:</label><input type="text" id="cim" name="cim"/></td></tr>
                        <tr><td><label for="kategoria">Kategória:</label><select id="kategoria" name="kategoria">
                                    <?php foreach ($categories as $one){ ?>
                                        <option value="<?php echo $one; ?>"><?php echo $one; ?></option>
                                    <?php } ?>
                                </select></td></tr>
                        <tr><td><button type="submit" name="upload">Feltöltés</button></td></tr>
                    </table>
                </form>
            </div>
			
        </div>
    </div>

<?php
include('footer.php');
?>