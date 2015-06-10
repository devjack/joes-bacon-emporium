<?php
if(!empty($_REQUEST) && array_key_exists('user', $_REQUEST)) {
    // we have a login attempt!
    $user = $_REQUEST['user'];
    $pass = $_REQUEST['password'];
    $sql = "SELECT * FROM users WHERE `user`='$user' and `password`=md5('$pass')";
    if(array_key_exists('reveal', $_REQUEST)) { echo $sql; }
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

if(!empty($_REQUEST) && array_key_exists('logout', $_REQUEST)) {
    session_destroy();
    if(array_key_exists('destination', $_REQUEST)) {
        header('Location:' . $_REQUEST['destination']);
    }
}

?>


<h1>Admin your baconz</h1>
<form method="post" action="/login?destination=/">
    <?=(isset($message) ? $message : "");?>
    <p><input type="text" name="user" value="" placeholder="Username"></p>
    <p><input type="password" name="password" value="" placeholder="Password"></p>
    <?php
    if(array_key_exists('reveal', $_REQUEST)) {
        echo '<input type="hidden" name="reveal" value="1">';
    }
    ?>
    <p class="submit"><input type="submit" name="commit" value="Login"></p>
</form>