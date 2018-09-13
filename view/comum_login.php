  <div class="wrapper">
    <form action="<?= BASE_URL ?>comum/login" method="POST" class="form-signin">       
      <h2 class="form-signin-heading">Entrar</h2>
      <input type="email" class="form-control" name="email" id="email" placeholder="Email" required autofocus="" />
      <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" required />      
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>   
      <div class="text-center" style="margin-top: 20px">      
        <a href="<?= BASE_URL ?>comum/novousuario">Novo Usuário</a>      
      </div>          
    </form>
  </div>