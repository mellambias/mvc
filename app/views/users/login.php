<?php require_once(APPROOT.'/views/includes/header.php') ?>
    <div class="container">
      <div class="row">
        <div class="col-md-6 mx-auto">
          <div class="card card-body bg-light mt-5">
            <h2>Login</h2>
            <p>Por favor ponga sus credenciales para entrar</p>
            <form action = '<?php echo URLROOT?>/users/login' method='POST'>
              <div class="form-group">
                <label for="email">Email: <sup>*</sup></label>
                <input
                  type="email"
                  name="email"
                  class="form-control form-control-lg <?php if($data['email_err']!='') echo 'is-invalid';?>"
                  value="<?php echo $data['email']; ?>"
                />
                <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
              </div>
              <div class="form-group">
                <label for="password">Password: <sup>*</sup></label>
                <input
                  type="password"
                  name="password"
                  class="form-control form-control-lg <?php if($data['password_err']!='') echo 'is-invalid';?>"
                  value=""
                />
                <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
              </div>
              <div class="row">
                <div class="col">
                  <input
                    type="submit"
                    value="Login"
                    class="btn btn-success btn-block"
                  />
                </div>
                <div class="col">
                  <a href="<?php echo URLROOT ?>/users/register" class="btn btn-light btn-block"
                    >¿No tiene cuenta? Registrese</a
                  >
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
<?php require_once(APPROOT.'/views/includes/footer.php') ?>