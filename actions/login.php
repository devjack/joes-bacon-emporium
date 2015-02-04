<?php
if(!empty($_REQUEST)) {
    // we have a login attempt!
    $user = $_REQUEST['user'];
    $pass = $_REQUEST['password'];
    $sql = "SELECT * FROM users WHERE `user`='$user' and `password`=md5('$pass')";
    echo $sql;
    $query = $db->query($sql);
    var_dump($query);
    if($query && $query->num_rows>0) {
        // user exists with that user and pass
        $_SESSION['user'] = $query->fetch_assoc()['user'];
        header('Location:'.$_REQUEST['destination']);
        exit; // let the header do its magic.
    } else {
        // user or pass mismatch
        $error = "Login attempt failed.";
        var_dump($db->error);
    }
}

?>


<h1>Admin your baconz</h1>
<form method="post" action="/login?destination=/">
    <?=(isset($error) ? $error : "");?>
    <p><input type="text" name="user" value="" placeholder="Username"></p>
    <p><input type="password" name="password" value="" placeholder="Password"></p>
    <p class="submit"><input type="submit" name="commit" value="Login"></p>
</form>