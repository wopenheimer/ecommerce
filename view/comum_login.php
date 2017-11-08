  <div class="wrapper">
    <form action="<?= BASE_URL ?>comum/login" method="POST" class="form-signin">       
      <h2 class="form-signin-heading">Entrar</h2>
      <input type="email" class="form-control" name="email" id="email" placeholder="Email" required autofocus="" />
      <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" required />      
      <label class="checkbox">
        <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Lembrar
      </label>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>   
    </form>
  </div>