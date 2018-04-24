<?php
session_name("video");

$nev = $_GET['id'];

include('functions.php');
include('header.php');

$userarray = array();
$q = "SELECT * FROM FELHASZNALOK WHERE FELHASZNALONEV = '$nev'";
$stmt = oci_parse($conn, $q);
oci_execute($stmt);

if($rows = oci_fetch_array($stmt)){
    $userarray = (array)$rows;
}

if(isset($_POST["modify_pass"])) {
    if (empty($_POST["oldpass"])) {
        echo "Nem adtad meg a régi jelszót!";
    } else if ($_POST["oldpass"] != $_SESSION["user"][1]) {
        echo "Rossz jelszót adtál meg!";
    } else {
        if ($_POST['password'] != $_POST['password2']) {
            echo "Hiba! Nem egyezik meg a két jelszó!";
        } else if (empty($_POST["password"]) || empty($_POST["password2"])) {
            echo "Hiba! Üres mező(k)!";
        } else {
            $pass = $_POST["password"];
            $uname = $_SESSION["user"][0];

            $q = "UPDATE FELHASZNALOK SET JELSZO='$pass' WHERE FELHASZNALONEV='$uname'";
            $stmt = oci_parse($conn, $q);
            oci_execute($stmt);
        }
    }
}

if(isset($_POST["modify_email"])){
    if(empty($_POST["email"])){
        echo "Nem adtál meg e-mail címet!";
    }else{
        $email = $_POST["email"];
        $old = $_SESSION["user"][0];

        $q = "UPDATE FELHASZNALOK SET EMAIL='$email' WHERE FELHASZNALONEV='$old'";
        $stmt = oci_parse($conn, $q);
        oci_execute($stmt);
    }
}

if(isset($_POST["upload"])){
        $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOK = 1;
        $check = getimagesize($_FILES["image"]["tmp_name"]);

        if ($uploadOK == 0) {
            echo "shit";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $img = "Sikeres képfeltöltés:  " . basename($_FILES["image"]["name"]);
                $uname = $_SESSION["user"][0];
                $image_name = basename($_FILES["image"]["name"]);
                $q = "UPDATE FELHASZNALOK SET KEP='$image_name' WHERE FELHASZNALONEV='$uname'";
                $stmt = oci_parse($conn, $q);
                oci_execute($stmt);
                $userarray[5] = $image_name;
                $_SESSION["user"][5] = $image_name;
            } else {
                $img = "Nem sikerült feltölteni a képet.";
            }
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
        <div class="adatok">
            <h4>Adatok</h4>
            <table>
                <tr>
                    <td>Felhasználónév:</td>
                    <td><label><?php echo $userarray[0]; ?></label></td>
                </tr>
                <?php if($nev == $_SESSION["user"][0]){ ?>
                <tr>
                    <td>Jelszó:</td>
                    <td><label><?php echo $userarray[1]; ?></label></td>
                </tr>
                <?php } ?>
                <tr>
                    <td>Email cím:</td>
                    <td><label><?php echo $userarray[2]; ?></label></td>
                </tr>
                <?php if(!ADMIN){ ?>
                <tr>
                    <td>Születési idő:</td>
                    <td><label><?php echo $userarray[3]; ?></label></td>
                </tr>
                <tr>
                    <td>Nem:</td>
                    <td><label><?php echo $userarray[4]; ?></label></td>
                </tr>
                <?php } ?>
            </table>
        </div>
        <?php if($nev == $_SESSION["user"][0]){ ?>
        <div class="jelszo">
            <form method="post">
                <table>
                    <tr><td><input type="password" name="oldpass" placeholder="Régi jelszó" /> </td></tr>
                    <tr><td><input type="password" name="password" placeholder="Jelszó"/></td></tr>
                    <tr><td><input type="password" name="password2" placeholder="Jelszó újra"/></td></tr>
                    <tr><td><button type="submit" name="modify_pass">Módosít</button></td></tr>
                </table>
            </form>
        </div>
            <div class="email">
                <form method="post">
                    <table>
                        <tr><td><input type="email" name="email" placeholder="E-mail cím"/></td></tr>
                        <tr><td><button type="submit" name="modify_email">Módosít</button></td></tr>
                    </table>
                </form>
            </div>
            <?php if(!ADMIN){ ?>
            <div class="profilepic">
                <img src="img/<?php echo $userarray[5]; ?>" id="avatar" style="width:200px;height:200px;">
                <form method="post" enctype="multipart/form-data">
                    <label for="image">Kép:</label><input type="file" id="image" name="image"  accept=".jpg, .jpeg, .png" multiple>
                    <button type="submit" name="upload" >Csere</button>
                </form>
            </div>
                <?php } ?>
        <?php } ?>
    </div>
</div>
<?php
include('footer.php');
?>
