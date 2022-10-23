<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="estilo/style.css">


</head>
<?php
        $nome = "";
        $email = "";
        $idade = "";
        $salario = "";
        $cpf = "";
        $telefone = "";
        $serasa = "";
        $msg = "";
       

        if(isset($_GET['nome'])){
            $nome = $_GET['nome'];
        }
        if(isset($_GET['email'])){
            $email = $_GET['email'];
        }
        if(isset($_GET['telefone'])){
            $telefone = $_GET['telefone'];
        }
        if(isset($_GET['idade'])){
            $idade = $_GET['idade'];
        }
        if(isset($_GET['salario'])){
            $salario = $_GET['salario'];       
        }
        if(isset($_GET['cpf'])){
            $cpf = $_GET['cpf'];
        }
        if(isset($_GET['serasa'])){
            $serasa = $_GET['serasa'];
        }
        if(isset($_GET['msg'])){
            $msg = $_GET['msg'];
        }
            
    ?>

<body>

   
    <header>
        <div id="header">
            <div id="divimg1">
                <img src="img/univap.png" id="img1" alt="">
            </div>

            <h1>Nubank!</h1>

            <div id="divimg2">
                <img src="img/info.jpg" id="img2" alt="">
            </div>
        </div>
    </header>


  

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" href="https://www.serasa.com.br/score/" target="_blank">Verificar Serasa</a>
            </li>  
          </ul>
        </div>
      </nav>

        <br>

        <h2>Você deseja realizar seu cadastro?</h2>

        <br>
        <h4>aperte aqui!</h4>
        <h4> ↓</h4>

        <div class="container-fluid mt-3">
            <div class="offcanvas offcanvas-end" id="demo">
                <div class="offcanvas-header">
                <h2 class="offcanvas-title">Cadastre-se</h2>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>

                <div class="offcanvas-body">
                    <form action="processo.php" method="POST">
                        <div class="field">
                            <label for="nome">Seu Nome:</label>
                            <input type="text" id="nome" name="nome" placeholder="Digite seu nome*" value = "<?php echo $nome ?>"onkeyup="escreverCartao()"required>
                        </div>
                        
                        <div class="field">
                            <label for="telefone">Seu Telefone:</label>
                            <input type="number" id="telefone" name="telefone" value = "<?php echo $telefone ?>"placeholder="Digite seu Telefone*" required>
                        </div>

                        <div class="field">
                            <label for="idade">Sua Idade:</label>
                            <input type="number" name="idade" id="idade" value = "<?php echo $idade ?>" placeholder="Digite sua Idade*" required>
                        </div>
                
                        <div class="field">
                            <label for="email">Seu E-Mail:</label>
                            <input type="text" id="email" name="email" value = "<?php echo $email ?>"placeholder="Digite seu E-Mail*" required>
                        </div>     
                        
                        <div class="field">
                            <label for="salario">Seu Salário:</label>
                            <input type="number" id="salario" name="salario" value = "<?php echo $salario ?>" placeholder="Digite seu Salário*" required>
                        </div>

                        <div class="field">
                            <label for="cpf">Seu CPF:</label>
                            <input type="number" id="cpf" name="cpf" value = "<?php echo $cpf ?>"placeholder="Digite seu CPF*" required>
                        </div>
            
                        <div class="field">
                            <label for="serasa">Seu Serasa:</label>
                            <input type="number" id="serasa" name="serasa" value = "<?php echo $serasa ?>"placeholder="Serasa Score*" required>
                        </div>
                        <input type="submit" class="btn btn-secondary" value="Enviar" id="btcc" onClick="addCartao();"/>
                    </form> 
                    
                   

                    </div>
                </div>
            </div>   
            
           
        <div id="bot">
            <?php
                echo $msg;
            ?>
        </div>

        <main>
            
           
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo">
                Cadastrar
            </button>   

        </main>
          
    
      

        <footer>

        </footer>
   
    
</body>
    

</html>