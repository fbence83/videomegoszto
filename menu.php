<div class= "side-menubar">
    <div class="side-menubar1">
        <p>Listák</p>
        <a href="#">Felkapott</a>
        <a href="#">Népszerűek</a>
        <a href="#">Listák</a>
    </div>
    <hr>
    <div class="side-menubar1">
        <p>Kategóriák</p>
        <div class="side-menubar2">
            <?php
            $stmt = oci_parse($conn,"Select distinct kategoria from videok");
            oci_execute($stmt);

            while ($row = oci_fetch_assoc($stmt)) {?>
                <a href="lists.php?cat=<?php echo $row["KATEGORIA"] ?> "> <?php echo $row["KATEGORIA"] ?></a>

            <?php } ?>
        </div>
    </div>
</div>