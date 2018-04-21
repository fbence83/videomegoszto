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

?>

    <div class="oszlopok">

        <?php include ("menu.php"); ?>
        <div class="main">
            <div class ="felhasz">
                <h2><?php echo $nev; ?> </h2>
                <a href="user.php?id=<?php echo $nev; ?>">Vissza az előző oldalra</a>
            </div>
            <div class="feltöltés">
                <h4>Videó feltöltése</h4>
                <form method="post">
                    <table>
                        <tr><td><label for="link">Link:</label><input type="text" id="link" name="link"/></td></tr>
                        <tr><td><label for="cim">Cím:</label><input type="text" id="cim" name="cim"/></td></tr>
                        <tr><td><label for="kategoria">Kategória:</label><input type="text" id="kategoria" name="kategoria"/></td></tr>
                        <tr><td><button type="submit" name="upload">Feltöltés</button></td></tr>
                    </table>
                </form>
            </div>
        </div>
    </div>

<?php
include('footer.php');
?>