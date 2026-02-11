<?php
/* Template Name: Custom Login */

if ( is_user_logged_in() ) {
  wp_redirect( home_url('/wp-admin') );
  exit;
}

get_header();
?>
<style>
    .btn-brown {
  background-color: #6b4a1b;
  color: #fff;
  border-radius: 25px;
}

.btn-brown:hover {
  background-color: #5a3d15;
  color: #fff;
}

.form-control {
  border-radius: 6px;
  border: 2px solid #b08a57;
}
.login-page input[type=password] {
    width: 100%;
    padding: 12px 15px;
}
.login-page button.btn.btn-brown.px-5 {
    padding: 10px;
    background: #b08a57;
    border: unset;
}
.forgot-pass, 
.signup{
    background: #33333385;
    padding: 10px;
    color:#fff;
}
</style>
<div class="container my-5 login-page">
  <div class="row justify-content-start">
    <div class="col-lg-7">

      <form method="post" action="<?php echo esc_url( wp_login_url() ); ?>">

        <!-- Email -->
        <div class="mb-4">
          <input
            type="text"
            name="log"
            class="form-control form-control-lg"
            placeholder="E-mail address"
            required
          >
        </div>

        <!-- Password -->
        <div class="mb-5">
          <input
            type="password"
            name="pwd"
            class="form-control form-control-lg"
            placeholder="Password"
            required
          >
        </div>

        <!-- Buttons -->
        <div class="d-flex align-items-center gap-3 flex-wrap">

          <button type="submit" class="btn btn-brown px-5">
            Log in
          </button>

          <a href="<?php echo wp_lostpassword_url(); ?>"
             class="btn forgot-pass px-4">
            Forgot Password
          </a>

          <a href="<?php echo site_url('/register'); ?>"
             class="btn btn-light border signup px-4 ms-lg-auto">
            Sign up (New Account)
          </a>

        </div>

        <input type="hidden" name="redirect_to"
               value="<?php echo esc_url( home_url('/dashboard') ); ?>">

      </form>

    </div>
  </div>
</div>


<?php get_footer(); ?>
