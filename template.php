

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="author" content="Jack Skinner" />
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" href="style.css" type="text/css" />
    <title>Joe's Bacon Emporium</title>
</head>
<body>
<div id="page" align="center">
    <div id="content" style="width:800px">
        <div id="logo">
            <div style="margin-top:48px" class="whitetitle">Bacon<br>Emporium</div>
        </div>
        <div id="topheader">
            <div align="left" class="bodytext">
                <br />
                <strong>Joe's Bacon Emporium</strong><br />
                1 Piggy Terrace<br />
                Sydney<br />
                Phone: 1800 BACON<br />
            </div>
            <div id="toplinks" class="smallgraytext">
                <a href="/">Home</a> |  <a href="/contact">Contact Us</a>
            </div>
        </div>
        <div id="menu">
            <div align="right" class="smallwhitetext" style="padding:9px;">
                <a href="/">Home</a> | <a href="about">About Us</a> | <a href="/products">Products</a> | <a href="/contact">Contact Us</a>
            </div>
        </div>
        <div id="contenttext" style="min-height: 200px;">
            <?=$content;?>
        </div>
        <div id="leftpanel">
            <?php require 'sidebar.php'; ?>
        </div>
        <div id="footer" class="smallgraytext">
            <a href="/">Home</a> | <a href="/about">About Us</a> | <a href="/products">Products</a> |  <a href="/">Contact Us</a>
            | Joe's Bacon Emporium
            &copy; <?= date('Y');?>
        </div>
    </div>
</div>
</body>
</html>