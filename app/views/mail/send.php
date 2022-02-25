<?php require APPROOT . '/views/includes/header.php'; ?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<div class="card card-body bg-light mt-5">
    <h2>Send Mail</h2>
    <p>Enviar un correo</p>
    <form action="<?php echo URLROOT; ?>/mail/send" method="post">
        <div class="form-group">
            <label for="from">From: <sup>*</sup></label>
            <input type="email" name="from"
                class="form-control form-control-lg <?php echo (!empty($data['Error']['from_err'])) ? 'is-invalid' : ''; ?>"
                value="<?php echo $data['Data']['from']; ?>">
            <span class="invalid-feedback"><?php echo $data['Error']['from_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="to">To: <sup>*</sup></label>
            <input type="email" name="to"
                class="form-control form-control-lg <?php echo (!empty($data['to_err'])) ? 'is-invalid' : ''; ?>"
                value="<?php echo $data['Data']['to']; ?>">
            <span class="invalid-feedback"><?php echo $data['Error']['to_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="asunto">Asunto: <sup>*</sup></label>
            <input type="text" name="asunto"
                class="form-control form-control-lg <?php echo (!empty($data['Error']['asunto_err'])) ? 'is-invalid' : ''; ?>"
                value="<?php echo $data['Data']['asunto']; ?>">
            <span class="invalid-feedback"><?php echo $data['Error']['asunto_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="body">Body: <sup>*</sup></label>
            <textarea rows="10" name="body"
                class="form-control form-control-lg <?php echo (!empty($data['Error']['body_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['Data']['body']; ?></textarea>
            <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
        </div>
        <input type="submit" class="btn btn-success" value="Enviar">
    </form>
</div>
<?php require APPROOT . '/views/includes/footer.php'; ?>