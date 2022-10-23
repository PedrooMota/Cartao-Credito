<?php
    include "conectar.php";


    function validaCPF($cpf)
    {

        // Extrai somente os números
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }


    $formValido = true;

    if(!isset($_POST['nome'])){
        $formValido = false;
        $msg = "Nome Inválido";

    }else if(!isset($_POST['email'])){
        $formValido = false;
        $msg = "Email Inválido";

    }else if(!isset($_POST['telefone'])){
        $formValido = false;
        $msg = "Telefone Inválido";

    }else if(!isset($_POST['idade'])){
        $formValido = false;
        $msg = "Digite uma idade";

    }else if(!isset($_POST['salario'])){
        $formValido = false;
        $msg = "Digite um salario válido";

    }else if(!isset($_POST['cpf'])){
        $formValido = false;
        $msg = "Digite um cpf válido";

    }else if(!isset($_POST['serasa'])){
        $formValido = false;
        $msg = "Digite um Serasa válido";

    }else{
        $nome = $_POST['nome'];
        $nome = strip_tags($nome);
        
        
        $email = $_POST['email'];
        $email = strip_tags($email);

        $telefone = $_POST['telefone'];
        $telefone = strip_tags($telefone);

        $idade = $_POST['idade'];
        $idade = strip_tags($idade);

        $salario = $_POST['salario'];
        $salario = strip_tags($salario);

        $cpf = $_POST['cpf'];
        $cpf = strip_tags($cpf);

        $serasa = $_POST['serasa'];
        $serasa = strip_tags($serasa);

        if(strlen($nome)<3){
            $msg="Nome inválido";
            $formValido =false;

        }else if(strlen($email)<10){
            $msg="E-mail inválido";
            $formValido =false;

        }else if(!is_numeric( $salario)){
            $msg="Salário inválido";
            $formValido =false;

        }else if(!is_numeric($idade) || (int)$idade < 16){
            $msg = "Idade Inválida";
            $formValido = false;

        }else if(!is_numeric($telefone) || strlen($telefone) > 11){
            $msg = "Telefone Inválido";
            $formValido = false;

        }else if(!is_numeric($serasa) || (int)$serasa < 500 || (int)$serasa > 1000 ){
            $msg = "Serasa Score Inválido";
            $formValido = false;

        }else if(validaCPF($cpf) == false){
            $msg = "CPF Inválido";
            $formValido = false;

        }
               
    }

    if($formValido == false){
        $urlRetorno = "./index.php?msg=$msg&serasa=$serasa&telefone=$telefone&cpf=$cpf&idade=$idade&salario=$salario&email=$email&nome=$nome";
        header("Location: $urlRetorno");
    }
    

    //número do cartão
    $ncartao1 = 0;
    $ncartao2 = 0;
    $ncartao3 = 0;
    $ncartao4 = 0;
    $ncartao1 = (string)random_int(1000, 9999);
    $ncartao2 = (string)random_int(1000, 9999);
    $ncartao3 = (string)random_int(1000, 9999);
    $ncartao4 = (string)random_int(1000, 9999);
    
    $cartaototal = (string)$ncartao1."-".$ncartao2."-".$ncartao3."-".$ncartao4;
    
    

    //Digito Verificador
    $dv = (string)rand(000, 999);
    
    //Limite do cartão
    (string)$limite = $salario * 1.6;

    //Valor que se ultrapassar fica em vermelho
    $limitever = ((15/100) * $limite) + $limite;

    // Mês de validade do cartão
    $datam = new DateTime();
    $mes = (string)$datam->format("m");

    //Ano de validade do cartão
    $datay = new DateTime();
    $ano = $datay->format("y");
    $ano = (string)$ano + 10;

    $cart = "number: $cartaototal\n limite: $limite\n cvv: $dv\n valid thru: $mes/$ano";
    
    require_once("phpqrcode/qrlib.php");
    
    $QrCode = "Cartãode$nome.png";

    QRcode::png($cart, $QrCode);

        $banco = new Banco();
        //Função que insere as propriedades na tabela Formulario  

        $res = $banco->inserirFormulario($nome, $email, $telefone, $idade, $salario, $serasa, $cpf);
        $res = $banco->inserirCartao($cartaototal, $dv, $limite, $limitever, $mes, $ano);    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilo/style2.css">
    <title>Document</title>
</head>
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
    <center>

        <?php
            echo "<img src='{$QrCode}'width='200px'>";
        ?>

    </center>


<main>
    <div class="container">
        <div class="content">
            <div class="header">
                <div class="box-img">
                    <img src="img/mastercard_logo.png" alt="mastercard">
                    <img src="img/chip.png" alt="chip">
                </div>
            </div>
            <div class="footer">
                <div id="class">

            </div>
            <img src="img/nubank_logo.png" alt="nubank"><br>
            <div id="resp">

            </div>                        
                </div>
        </div>
        <br>
        <br>
    </div>  
</main>



    <footer>

    </footer>


</body>
    <script type="text/javascript">

    var cartaototal = "<?=$cartaototal?>"
    var nome = "<?=$nome?>"
    var limite = "<?=$limite?>"
    var nv = "<?=$dv?>"
    var mes = "<?=$mes?>"
    var ano = "<?=$ano?>"
    var limitemax = "<?=$limitever?>"


    console.log(cartaototal);

    var resposta = document.getElementById('resp');
    var texto = "<br>"+nome+"<br><br>Número Cartão:"+cartaototal+"<br><br>Limite: R$"+limite+"<br><br>Valor Vermelho: R$"+limitemax+"<br><br>Valid Thru:"+mes+"/"+ano+"<br><br>CVC:"+nv;
    resposta.innerHTML=texto;
    


   //Cartão de amostra
   const card = document.querySelector('.container');
    


    card.addEventListener("mousemove", cardEffect);
    card.addEventListener("mouseleave", cardBack);
    card.addEventListener("mouseenter", cardEnter);

    
    function cardEffect(event)
    {

        // função que tornou possível o cartão rotacionar ao passar o mouse.
        const cardWidth = card.offsetWidth;
        const cardHeight = card.offsetHeight;
        const centerX = card.offsetLeft + cardWidth/2;
        const centerY = card.offsetTop + cardHeight/2;
        const positionX = event.clientX - centerX;
        const positionY = event.clientY - centerY;
        
        const rotateX = ((+1)*25*positionY/(cardHeight/2)).toFixed(2);
        const rotateY = ((-1)*25*positionX/(cardWidth/2)).toFixed(2);

        console.log(rotateX,rotateY);

        card.style.transform = `perspective(500px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;

    }

    function cardBack(event)
    {
        card.style.transform = `perspective(500px) rotateX(0deg) rotateY(0deg)`;
        cardTransition();
    }

    function cardTransition()
    {
        clearInterval(card.transitionId);
        card.style.transition = 'transform 400ms';
        card.transitionId = setTimeout(() => {
            card.style.transition = '';
        },400);
    }

    function cardEnter(event)
    {
        cardTransition();
    }

    

</script>


</html>