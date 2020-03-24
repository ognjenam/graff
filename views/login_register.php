

<ul class="navbar_user">
    <div class="cd-user-modal">
    <div class="cd-user-modal-container">
    <ul class="cd-switcher">
       <li><a href="#">Sign in</a></li>
       <li><a href="#">New account</a></li>
    </ul>
    <div id="cd-login">
       <!-- log in form -->
       <form class="cd-form" id="loginForm" name="loginFormModal" method="post" action="php/loginValidation.php">
          <p class="fieldset">
             <label class="image-replace cd-email" for="signin-email">E-mail</label>
             <input class="full-width has-padding has-border" autocomplete="off" id="signin-email" name="tbEmail" type="email" placeholder="E-mail">
             <span class="cd-error-message" id="logErrorEmail"></span>
          </p>
          <p class="fieldset">
             <label class="image-replace cd-password" for="signin-password">Password</label>
             <input class="full-width has-padding has-border" id="signin-password" name="tbPassword" type="password"  placeholder="Password">
             <span class="cd-error-message" id="logErrorPassword"></span>
          </p>
          <p class="fieldset">
             <input class="full-width" type="button" value="Login" name="loginSubmit" id="btnLogin">
          </p>
       </form>
    </div>
    <!-- cd-login -->
    <!-- FORMA ZA REGISTRACIJU -->
    <div id="cd-signup">
       <!-- sign up form -->
       <form class="cd-form" id="registerForm" name"registerFormModal" method="post" action="<?=ROOT?>/models/users/register.php">
          <p class="fieldset">
             <label class="image-replace cd-username" for="signup-username">Username</label>
             <input class="full-width has-padding has-border" autocomplete="off" id="signup-username" name="tbRegUsername" type="text" placeholder="Username">
             <span class="cd-error-message" id="regErrorUsername"></span>
          </p>
          <p class="fieldset">
             <label class="image-replace cd-email" for="signup-email">E-mail</label>
             <input class="full-width has-padding has-border" autocomplete="off" id="signup-email" name="tbRegEmail" type="email" placeholder="E-mail">
             <span class="cd-error-message" id="regErrorEmail"></span>
          </p>
          <p class="fieldset">
             <label class="image-replace cd-password" for="signup-password">Password</label>
             <input class="full-width has-padding has-border" id="signup-password" name="tbRegPass" type="password"  placeholder="Password">
             <span class="cd-error-message" id="regErrorPassword"></span>
          </p>
          <p class="fieldset">
             <input class="full-width has-padding" type="button" value="Create account" name="registerButton" id="btnRegister">
          </p>
       </form>
    </div>
  </div>
</div>
</ul>
