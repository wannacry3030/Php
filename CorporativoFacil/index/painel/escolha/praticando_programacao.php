<?php
    session_start();
    date_default_timezone_get("Brazil/East");
// 30/julho/2020 23:22
/*
    Formatação de datas e verificando anos bissextos.
 */
    $dataHoje = "29/02/2020";
    $separar = explode('/',$dataHoje);
    $dia = $separar[0];
    $mes = $separar[1];
    $ano = $separar[2];
    
    $validaDia = true;
    $validaMes = true;
    var_dump($separar);
    
    /*
        COMO REDIRECIONAR AUTOMATICAMENTE
        header('Refresh: tempo;url= endereço.php');
        
        SE FOR À MESMA PÁGINA:
        header('Refresh:tempo;url='.$_SERVER['PHP_SELF']);
     */
    
    function setViews($topicId){
        $topicId = strip_tags(trim($topicId));
        $artigos = new Ler();
        $artigos->executarLeitura('publicacao', "WHERE id = :id");
        
        foreach($artigos->resultado() AS $resultados):
            $visualizacoes = $resultados['visitas'];
            $visualizacoes = $visualizacoes + 1;
            $todasVisitas = array(
                'visitas'=> $visualizacoes
            );
        endforeach;
        $atualiza = new Editar();
        $atualiza->executarEdicao('publicacao', $todasVisitas, "WHERE id = :id", "id={$id}");
        
    }
    
    
    if($ano <= date('Y') || $ano >= 1800):
        $meses31 = ['1','3','5','7','8','10','12'];    
        $meses30 = ['4','6','9','11'];
        
        if(in_array($mes, $meses31)):
            
            if($dia < 1 || $dia > 31):
                $validaDia = false;
                echo "Data inválida !";
            endif;
            
            echo "Você encontrou meses com último dia sendo 31!<hr>";
        elseif(in_array($mes, $meses30)):
            
            if($dia < 1 || $dia > 30):
                $validaDia = false;
                echo "Data inválida. ";
            endif;
            
            echo "Você encontrou meses com último dia 30!<hr>";
            
        elseif($mes == 2):
            
            if($ano % 4 == 0 || $ano % 100 != 0):
                $fevereiro = '29';
            else:
                $fevereiro = '28';
            endif;
            
            
            if($dia < 1|| $dia > $fevereiro):
                $validaDia = false;
                echo "O mês de fevereiro não tem mais de 29 dias!<hr>";
            else:
                echo "Mês de fevereiro<hr>";                
            endif;
            
        endif;
    else:
        
    endif;
    
    require '../../../Config/Conf.inc.php';
    
    $autentica = new Autenticacao();
    if(!$autentica->verificaLogin()):
        unset($_SESSION['autenticado']);
        header('Location: ../../formulario-login.php?acao=restrito');
        //var_dump($autentica);
    else:
        $usuario = $_SESSION['autenticado'];
    endif;
    // USANDO EXPRESSÕES REGULARES
    
    //obs.: A expressão regular diferencia maiúsculas e minúsculas, a não ser que adicione *i* ao fim da expressão.
    /*     
        
      /^ = Iniciando uma expressão regular
      $/ = Finalizando uma expressão regular
      [] = grupo de caracteres aceitos.
      {} = Quantidade de caracteres aceitos dentro do grupo informado.
     
      {1,5} = até 5 algarismos.
      {1,} = De 1 caractere até infinito.       => MAIS
      {0,} = De nenhum caractere até infinito.  => ASTERISCO
      {0,1} = zero ou 1 algarismo.              => INTERROGAÇÃO
        A interrogoção é igual a {0,1} ? = {0,1} .
        ? = nenhum caractere ou apenas 1 caractere. {0,1   }
        * = {0,} => ou nenhum ou infinitos algarismos/caracteres.  
        + = {1,} => pode ter um caractere ou pode ser infinito.  
        [a,z] => apenas letras minúsculas.
        [A,Z] => apenas letras maiúsculas.
        [a-zA-Z0-9] => letras maiúsculas, letras minúsculas e números de 0 a 9.
        VALIDADOR DE EMAIL => 
        DATA = '/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/'               dd/mm/AAAA
        TELEFONE =  '/^\([0-9]{2}\) [0-9]{4}\.[0-9]{4}$/'       (00) 0000.0000
        CEP = '/^[0-9]{2}\.[0-9]{3}\.[0-9]{3}$/'
        CPF = '/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}\-[0-9]{2}$/'
        URL = '/^[a-z]{4,5}\:\/\/[a-z0-9_\.\-]*\.[a-z]+\.[a-z]{2,4}$/'
     */
    
    $expressao = "email_cinco_53.brasilia@servidor_brasil.2020.com.br";
    if(preg_match('/^[a-z0-9\_\.\-]+\@[a-z0-9_.-]+\.[a-z]{2,4}\.[a-z]{2,4}$/', $expressao)):
        echo "correto!!<hr>";
    else:
        echo "Inadequada.<hr>";
    endif;
    
    /*
        Formatando textos.
     */
    $textoPortugues = "ainda há uma conexão entre a gente, mas parece que já acabou a relação. Se acostume, <b>VOCÊ CONSEGUE SUPERAR.</b> Se ela não quis, problema é DELA; ela é quem está perdendo. Estarei tranquilo, progredindo e trabalhando";
    $textoIngles = "<p>it seems those ties are still there, but this time it's over. Get used to it, YOU CAN GET THROUGH THIS AND YOU WILL. She doesn't wanna be in a relationship with me anymore because <b>quote I'm not a christian unquote</b>; and that's her loss, not mine. I'll focus on my self-development and getting my work done</p>";
    
    function limitaPalavras($texto, $limite=300){
        $texto = strip_tags($texto);
        $contagem = strlen($texto);
        
        if($contagem <= $limite):
            return $texto;
        else:
            $posicao = strrpos(substr($texto, 0, $limite), ' ');
            return substr($texto, 0, $posicao).'...';
        endif;
    }
    
    //echo limitaPalavras($textoIngles,320);
    
    $texto = explode(" ", $textoPortugues);
    $contadorDePalavras = count($texto);
    
    var_dump($texto, $contadorDePalavras);
    
    $limitador = implode(" ",array_slice($texto, 0, 8));
    var_dump($limitador);
    /*  
        Então transformo uma string num ARRAY com explode(), 
        depois crio um contador de índices criados a partir dos espaços dentro dessa string;
        Depois disso transformo esse array de volta em string, 
        só que com um limitador de elementos dentro da string. Esse limitador vem do método ARRAY_SLICE(),
        que vai como parÂmetro do método implode(). Array_slice recebe a string como primeiro parâmetro, 
        o segundo parâmetro é de onde vai começar a *cortar* e o terceiro paraâmetro é até onde vai a string, ou seja,
        qual o tamanho da string.
     */
    
    $tempoPadrao = 10;
    
    if($_SESSION['start_view'] <= time()):
        $excluir = new Excluir();
        $excluir->exclusao('acessos',"WHERE id = :id_sessao OR time_end_view < time(now())");
        unset($_SESSION['start_view']);
    else:
        $_SESSION['start_view']['time_end'] = time() + $tempoPadrao;
        $horaDeFinalizar = array('time_end' => $_SESSION['start_view']['time_end']);
        $atualiza = new Editar();
        $atualiza->executarEdicao('acessos', $horaDeFinalizar, "WHERE id = :id_sessao", "id_sessao={$id}");
    endif;
    ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="../../../css/painel.css" rel="stylesheet" type="text/css"/>        
    </head>
    
    <body>
        <button class="btn_enviar" id="voltar">Voltar</button>
        <a href="../pagInicial.php" class="btn_enviar" style="text-decoration: none; ">Painel</a>
                
        <?php
        
            if(isset($_POST['enviarSabor'])){
                $enviar = $_POST['opcao'];
                echo "<hr>".$enviar."<hr>";
            }
        
        ?>
        
        <form name="sorvete" method="post">
            <span>Quer sorvete?</span>
            <label><input type="radio" name="opcao" value="s">Sim</label>
            <label><input type="radio" name="opcao" value="n">Não</label>
            
            <input type="submit" name="enviarSabor" value="mandar">
        </form>
        
        <script>
            //BOTÃO para voltar uma página
            document.getElementById("voltar").addEventListener('click', () => {
                history.back();
            });
        </script>
    
    </body>
</html>

