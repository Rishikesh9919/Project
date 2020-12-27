<?php 
    include_once 'Profile.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Index</title>
    <script src="https://use.fontawesome.com/3caa8aa520.js"></script>
    <!-- Place your stylesheet here-->
    <link href="css/index.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="logo-box">
    <img src="img/logo.png" class="logo" alt="Zoeken">
</div>
<form action="Webpage-header.php" method="post" name="search">
<div class="main">
    <div class="search-box">
        <div class="searchbar">
            <input type="text" name="search-input" class="search-input" placeholder="Search...">
            <button type="submit" name="search-button" class="search-icon"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
    </div>
</div>
</form>
</body>
</html>


