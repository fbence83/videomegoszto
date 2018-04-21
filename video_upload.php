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

$i = 1;
$categoryLength = 0;
foreach ($categories as $category){
    $categoryLength++;
}

$j = 1;
$newarray = array();
$newarray[0] = $categories[0];

//itt hagytam abba
    while($i <= $categoryLength) {
        if ($newarray[0] != $categories[$i]) {
            $newarray[$j] = $categories[$i];
            $j++;
        }
        $i++;
    }
    $i = 0;

?>

    <div class="oszlopok">

        <?php include ("menu.php"); ?>
        <div class="main">
            <div class ="felhasz">
                <h2><?php echo $nev; var_dump($categories); ?> </h2>
                <a href="user.php?id=<?php echo $nev; ?>">Vissza az előző oldalra</a>
            </div>
            <div class="feltöltés">
                <h4>Videó feltöltése</h4>
                <form method="post">
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