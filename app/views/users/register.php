<?php require_once(APPROOT.'/views/includes/header.php') ?>
<div class="row">
  <div class="col-md-6 mx-auto">
    <div class="card card-body bg-light mt-5">
      <h2>Create una cuenta</h2>
      <p>Rellena el formulario de registro</p>
      <form action="<?php echo URLROOT ?>/users/register" method="POST">
        <div class="form-group">
          <label for="name">Name: <sup>*</sup></label>
          <input
            type="text"
            name="name"
            class="form-control form-control-lg <?php if ($data['name_error']) echo 'is-invalid';?>"
            value="<?php echo isset($data['name'])? $data['name'] : ''?>"
          />
          <?php if($data['name_error']): ?>
            <?php echo $data['name_error']?>
          <?php endif; ?>
        </div>
        <div class="form-group">
          <label for="email">Email: <sup>*</sup></label>
          <input
            type="email"
            name="email"
            class="form-control form-control-lg"
            value="<?php echo isset($data['email'])? $data['email'] : ''?>"
          />
          <?php if($data['email_error']): ?>
            <span class="is-invalid">
              <?php echo $data['email_error']?>
            </span>
          <?php endif; ?>
        </div>
        <div class="form-group">
          <label for="password">Password: <sup>*</sup></label>
          <input
            type="password"
            name="password"
            class="form-control form-control-lg"
            value="<?php echo isset($data['password'])? $data['password'] : ''?>"
          />
          <?php if($data['password_error']): ?>
            <span class="is-invalid">
              <?php echo $data['password_error']?>
            </span>
          <?php endif; ?>
        </div>
        <div class="form-group">
          <label for="confirm_password">Confirm Password: <sup>*</sup></label>
          <input
            type="password"
            name="confirm_password"
            class="form-control form-control-lg"
            value=""
          />
          <?php if($data['confirm_password_error']): ?>
            <span class="is-invalid">
              <?php echo $data['confirm_password_error']?>
            </span>
          <?php endif; ?>
        </div>

        <div class="row">
          <div class="col">
            <input
              type="submit"
              value="Register"
              class="btn btn-success btn-block"
            />
          </div>
          <div class="col">
            <a href="<?php echo URLROOT ?>/users/login" class="btn btn-light btn-block"
              >¿Tiene una cuenta? Login</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require_once(APPROOT.'/views/includes/footer.php') ?>