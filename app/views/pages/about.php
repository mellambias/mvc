<?php 
include_once(APPROOT.'/views/includes/header.php');
?>

<h1>Página about</h1>

<form action="<?php echo URLROOT.'/pages/sendEmail' ?>" method="POST">
    <button type="submit">Enviar un correo</button>
</form>

<?php 
include_once(APPROOT.'/views/includes/footer.php');
?>