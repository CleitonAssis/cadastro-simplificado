<?php
require_once 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" type="text/css" href="css/formulario.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    

    <title>Cadastro de Usuário</title>
  </head>
  <body>
    <!-- início do preloader -->
    <div id="preloader">
      <div class="inner">
        <img style="width: 10rem;" src="img/preloader.svg">
        <h3 class="text-center text-muted"><strong>Carregando ...</strong></h3>
        </div>
      </div>
    </div>
    <!-- fim do preloader -->

    <main>
      <!-- Botão para acionar modal -->
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">
        Usuários Cadastrados
      </button>

      <!-- Modal -->
      <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Usuários Cadastrados</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?php
              //Verifica se tem algum usuário cadastrado na base e caso tenha apresenta no modal
              $result_usuario = "SELECT * FROM `usuario` WHERE id_usuario ORDER BY data_cad";
              $resultado_usuario = mysqli_query($con, $result_usuario);
              $cont = mysqli_num_rows($resultado_usuario);
              //var_dump($cont);
              if ($cont == 0) {
                echo "<h3>Nenhum Usuário Cadastrado!</h3>";
              } else {
                echo "
                  <div class='table-responsive'>
                    <table class='table table-hover table-sm'>
                      <thead>
                        <tr>
                          <th class='text-center' scope='col'>ID do Usuário</th>
                          <th class='text-center' scope='col'>Nome</th>
                          <th class='text-center' scope='col'>E-Mail</th>
                          <th class='text-center' scope='col'>Data de Cadastro</th>
                        </tr>
                      </thead>
                      <tbody>";
                      
                      while($row_usuario = mysqli_fetch_assoc($resultado_usuario)) {
                        $id_usuario = $row_usuario['id_usuario'];
                        $nome = $row_usuario['nome'];
                        $email = $row_usuario['email'];
                        $rec_data = date_create($row_usuario['data_cad']);//RECEBE DATA E HORA EM FORMATO DO BANCO DE DADOS
                        $data_cad =date_format($rec_data,"d/m/Y H:i:s");//CONVERTE PARA FORMATO DE DATA E HORA BRASILEIRO
        
                        echo "<tr>
                                <th class='text-center' scope='row'>$id_usuario</th>
                                <td class='text-center'>$nome</td>
                                <td class='text-center'>$email</td>
                                <td class='text-center'>$data_cad</td>
                              </tr>";
                      }
                      echo "        
                      </tbody>
                    </table>
                  </div>";
              }
              ?>
            </div>
            <!--<div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
              <button type="button" class="btn btn-primary">Salvar mudanças</button>
            </div>-->
          </div>
        </div>
      </div>
      <div class="container centralizar">
        <?php
        //Msgs de erro recebidas via sessão
          if (isset($_SESSION['ErroConexao'])) {
            echo "<div class='alert alert-danger text-center'><h4><i class='fas fa-exclamation-triangle'></i>" . $_SESSION['ErroConexao'];
            unset($_SESSION['ErroConexao']);
            session_destroy();
            echo "</h4></div>";
          } elseif (isset($_SESSION['SucessoCadastro'])) {
            echo "<div class='alert alert-success text-center'><h4><i class='fas fa-thumbs-up'></i>" . $_SESSION['SucessoCadastro'];
            unset($_SESSION['SucessoCadastro']);
            echo "</h4></div>";
          } elseif (isset($_SESSION['ErroCadastro'])) {
            echo "<div class='alert alert-danger text-center'><h4><i class='fas fa-thumbs-down'></i>" . $_SESSION['ErroCadastro'];
            unset($_SESSION['ErroCadastro']);
            echo "</h4></div>";
          } elseif (isset($_SESSION['CadastroDuplicado'])) {
            echo "<div class='alert alert-warning text-center'><h4><i class='fas fa-exclamation-triangle'></i>" . $_SESSION['CadastroDuplicado'];
            unset($_SESSION['CadastroDuplicado']);
            echo "</h4></div>";
          }
        ?>
        <h1 class="text-center">Cadastro de Usuário</h1>
        <hr>
        <form action="cadastrar.php" method="POST">
          <div class="form-group">
            <label for="email">Nome</label>
            <input type="text" maxlength="250" class="form-control" name="nome" placeholder="Digite seu Nome Completo" required autofocus>
          </div>
          <div class="form-group">
            <label for="email">Endereço de email</label>
            <input type="email" maxlength="250" class="form-control" name="email" placeholder="Digite seu melhor E-mail" required>
          </div>
          <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" maxlength="50" class="form-control" name="senha" placeholder="Crie uma Senha Bem Forte" required>
          </div>

          
          <button type="submit" class="btn btn-success">Cadastrar</button>
        </form>
      </div>
    </main>
    

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <!--Preloader-->
        <script>
          $(window).on('load', function () {
            $('#preloader .inner').fadeOut();
            $('#preloader').delay(400).fadeOut('slow'); 
            $('body').delay(400).css({'overflow': 'visible'});
          })
        </script>
  </body>
</html>