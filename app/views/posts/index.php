<?php 
include_once(APPROOT.'/views/includes/header.php');
?>

<h1>Página index</h1>
<?php 
echo $data['title'].'<br>';
foreach($data['posts'] as $clave => $valor){
    echo $valor->idpost.' ';
    echo $valor->titulo.' ';
    echo $valor->contenido.'<br>';
}
?>
<?php 
include_once(APPROOT.'/views/includes/footer.php');
?>