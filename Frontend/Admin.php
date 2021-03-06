<?php
    session_start();
    if($_SESSION["isAdmin"] != 1){
        header("Location: index.html");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&family=Radio+Canada&family=Raleway:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./admin.css">
    <title>Home</title>
</head>
<body>
    <nav>
        <ul id="navlist">
            <li><a href="index.html">Home</a></li>
            <li id="space"></li>
            <li id="admin-element"><a href="Admin.php">Admin</a></li>
            <li><a id="login-element"></a></li>
        </ul>
        <ul id="sublist">
        </ul>
    </nav>


    <div class="container">
        <h1>Manage Pages</h1>
        <div class="inputs" style="padding: 30px;">

            <textarea id="title" class="input" type="text" placeholder="Title"></textarea>
            <textarea id="body" class="input" type="text" placeholder="Body"></textarea>
            <textarea id="footer" class="input" type="text" placeholder="Footer"></textarea>
            <input type="radio" id="isVisible" name="visible" value="isVisible" checked>
            <label for="isVisible">Visible</label>
            <input type="radio" id="notVisible" name="visible" value="notVisible">
            <label for="notVisible">Not Visible</label>
            
            <textarea id="belongsTo" class="input" type="text" placeholder="Belongs to"></textarea>

        </div>
      

        
        <div class="buttons">
            <button id="getAllPages" class="btn"> Get all pages</button>
            <button id="getAllSubPages" class="btn" style="background-color: orange;">Get all sub pages</button>
            <button id="addBtn" class="btn" style="background-color: red;">Add Page</button>
            <button id="styleBtn" class="btn" style="background-color: rgb(205, 249, 124);">Update Style</button>
        </div>

        <div id="outputDiv" class="output"></div>

        <div id="styleUpdater" style='margin-bottom: 2em;'>
            <input id="styleText" type="text" placeholder="Style Name">

        </div>

    </div>
    
    <script src="load_style.js"></script>
    <script src="navbar.js"></script>
</body>

<script lang="js" src="./admin.js"></script>
</html>
