<?php
    require_once 'conexao.php';
    
	session_start();
    
    if(isset($_POST['btn-entrar'])):
        $erros = array();
        $email = mysqli_escape_string($conn, $_POST['email']);
        $senha = mysqli_escape_string($conn, $_POST['senha']);
		@$nivel_acesso = mysqli_escape_string($conn, $_POST['nivel_acesso']);
        
        if(empty($email) or empty($senha)):
            $erros[] = "<center>Os Campos precisam ser preenchidos!</center>";
        else:    
            $sql = "SELECT email FROM usuarios WHERE email = '$email'";
            $resultado = mysqli_query($conn, $sql);
            
            if(mysqli_num_rows($resultado) > 0):
                $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
                $resultado = mysqli_query($conn, $sql);
                
                if(mysqli_num_rows($resultado) == 1):
                    $dados = mysqli_fetch_array($resultado);
                    $_SESSION['logado'] = true;
                    $_SESSION['id_usuario'] = $dados['id'];
					header('Location: index.php');
				else:
                    $erros[] = "<center>Login Inválido!</center>";
                endif;    
                    
            else:
                $erros[] = "<center>Login Inválido!</center>";
            endif;    
        endif;
    endif;  
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/favicon.png">
    <link rel="stylesheet/less" type="text/css" href="less/login.less">
    <script src="https://cdn.jsdelivr.net/npm/less" ></script>
    <script src="less.js" type="text/javascript"></script>
    <title>VB - Virtual</title>
</head>
<body>
<section class="user">
    <div class="user_options-container">
      <div class="user_options-text">
        <div class="user_options-unregistered">
          <h2 class="user_unregistered-title">O que é o VB VIRTUAL?</h2>
          <ul>
            <li>Ambiente totalmente setorizado para melhor atender suas demandas</li>
            <li>Abertura de chamados para suporte no próprio ambiente</li>
            <li>Acompanhe metas, performances individuais e indicadores de sua equipe
            <li>Plataforma profissionalizante com cursos e certificações inclusas</li>
            <li>Atualizações sobre ações, eventos sociais e novidades que acontecem na VB</li>
          </ul>
        </div>
  
      </div>
      
      <div class="user_options-forms" id="user_options-forms">
        <div class="user_forms-login">
          <h2 class="forms_title">
            <img src="assets/logo_vb.png">
           <i>Virtual</i>
        </h2>
          <form class="forms_form">
            <div class="form__group field">
              <input required="" placeholder="Name" class="form__field" type="email" name="email">
              <label class="form__label" for="name">E-mail:</label>
          </div>
          <div class="form__group field">
            <input autocomplete="off" required="" name="senha" placeholder="Name" class="form__field" type="password">
            <label class="form__label" for="name">Senha:</label>
        </div>
            <div class="forms_buttons">
              <button id="logar" type="submit" value="Entrar"> LOGAR
            </button>
            
            <!-- BOTÃO DE ESQUECEU A SENHA -->
              <!-- <button href="#" class="cta">
              <span class="hover-underline-animation">Esqueceu sua senha?</span>
              <svg id="arrow-horizontal" xmlns="http://www.w3.org/2000/svg" width="30" height="10" viewBox="0 0 46 16">
                <path id="Path_10" data-name="Path 10" d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z" transform="translate(30)"></path>
              </svg>
            </button> --> -->
            <?php
                            if(!empty($erros)):
                                foreach($erros as $erro):
                                    echo $erro;
                                endforeach;
                            endif;    
                        ?>
            </div>
          </form>
        </div>
        </div>
      </div>
    </div>
  </section>
  <script src="/VB-Virtual/less/login.less"></script>
</body>
</html>