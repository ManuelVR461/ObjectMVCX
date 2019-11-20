<div class="main">
<?php
$template = "<h2>Hola Bienvenido a ObjetMVCX %s </h2>";
$template .= "<br><img src='./statics/images/icon.png'>";
printf($template,$_SESSION['datalogin']['usuario']);
?>
</div>