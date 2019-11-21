<div class="main">
<?php
$template = "<div style='text-align:center;'><h2>Hola Bienvenido a ObjetMVCX %s </h2></div>";
$template .= "<br><div style='text-align:center;'><img src='./statics/images/icon.png'></div>";
printf($template,$_SESSION['datalogin']['usuario']);
?>
</div>