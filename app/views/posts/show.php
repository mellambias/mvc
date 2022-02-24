<?php require APPROOT . '/views/includes/header.php'; ?>
<?php //echo "<pre>";print_r($data);echo "</pre>"; ?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<br>
<h1><?php echo $data['post']->titulo; ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
  Written by <?php echo $data['post']->name; ?> on <?php echo $data['post']->postCreated; ?>
</div>
<p><?php echo $data['post']->body; ?></p>


<?php if($data['post']->iduser == $_SESSION['user_id']) : ?>
  <hr>
  <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->idpost; ?>" class="btn btn-dark">Edit</a> 

  <form class="pull-right" action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->idpost; ?>" method="post">
    <input type="submit" value="Delete" class="btn btn-danger">
  </form>
<?php endif; ?>

<?php require APPROOT . '/views/includes/footer.php'; ?>