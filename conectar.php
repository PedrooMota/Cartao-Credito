<?php
class Banco{
    private $host = "localhost";
    private $usuario = "root";
    private $senha = "";
    private $banco = "projetoBD";
    private $con = null;

    

    function __construct()
    {
        $this->con = mysqli_connect($this->host, $this->usuario, $this->senha, $this->banco);
        if(!$this->con)
        {
            die("could not connect");
        }else
        {
         
        }

    }

    function inserirFormulario($nome, $email, $telefone, $idade, $salario, $serasa, $cpf){
            $comando = "insert into formulario (nome, email, telefone, idade, salario, serasa, cpf) values ('".$nome."', '".$email."', '".$telefone."', ".$idade.", ".$salario.", ".$serasa.", '".$cpf."');";
            $result = mysqli_query($this->con, $comando);
            return 1;
    }  
    
    function inserirCartao($cartaototal, $dv, $limite, $limitever, $mes, $ano)
    {
        $comando = "insert into cartao (numcartao, digito_verificador, limite_cartao, limite_vermelho, mes_validade, ano_validade) values ('".$cartaototal."', ".$dv.", ".$limite.", ".$limitever.", '".$mes."', '".$ano."')";
        $result = mysqli_query($this->con, $comando);
        return 1;
    }

    

}
?>