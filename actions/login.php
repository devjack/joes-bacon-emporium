<?php
if(!empty($_REQUEST) && array_key_exists('user', $_REQUEST)) {
    // we have a login attempt!
    $user = $_REQUEST['user'];
    $pass = $_REQUEST['password'];
    $sql = "SELECT * FROM users WHERE `user`='$user' and `password`=md5('$pass')";
    if($_GET['reveal'] == 1) { echo $sql; }
    $query = $db->query($sql);

    if($query && $query->num_rows>0) {
        // user exists with that user and pass
        $_SESSION['user'] = $query->fetch_assoc()['id'];
        header('Location:'.$_REQUEST['destination']);
        exit; // let the header do its magic.
    } else {
        // user or pass mismatch
        $message = "Login attempt failed.";
    }
}

?>


<h1>Admin your baconz</h1>
<form method="post" action="/login?destination=/">
    <?=(isset($message) ? $message : "");?>
    <p><input type="text" name="user" value="" placeholder="Username"></p>
    <p><input type="password" name="password" value="" placeholder="Password"></p>
    <p class="submit"><input type="submit" name="commit" value="Login"></p>
</form>