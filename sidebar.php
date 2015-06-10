<div align="justify" class="graypanel">
    <?php
    if($_SESSION['user']) {
        echo "<h4> You are now logged in!</h4>";
    }
    ?>

    <span class="smalltitle">Products</span><br /><br />

<?php
$sidebarSql = "SELECT * from products order by id desc limit 3";
$sidebarQuery = $db->query($sidebarSql);
while($sidebarItem = $sidebarQuery->fetch_assoc()): ?>

    <span class="smallredtext"><?=$sidebarItem['title'];?></span><br />
    <span class="bodytext"><?=$sidebarItem['description'];?></span><br />
    <a href="/product?p=<?=$sidebarItem['id'];?>" class="smallgraytext">More...</a><br /><br />

<?php
endwhile;
?>

</div>