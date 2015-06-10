<div align="justify" class="graypanel">
    <?php
    if(array_key_exists('user', $_SESSION )) {
        echo "<h4> You are now logged in as user #{$_SESSION['user']}!</h4>";
        echo "<a href='/login?logout=1&destination=/login'>logout?</a><br><br>";
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