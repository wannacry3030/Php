<?phps
    $dadoInformado = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    echo "funciona";
    //var_dump($dadoInformado);
    if(isset($dadoInformado['enviar_numero'])):
        if(is_string($dadoInformado)):
            echo "Não pode ser texto!";
            return false;
        elseif(is_float($dadoInformado)):
            echo "Não pode ser número quebrado! Informe um inteiro.";
            return false;
        elseif(is_int($dadoInformado)):
            echo "número inteiro!";
            while(is_int($dadoInformado)):
                //var_dump($dadoInformado);
                for ($contador = 1; $contador < 10; $contador++):
                    for($contadorDeBlocos = 2; $contadorDeBlocos < 10; $contadorDeBlocos++):
                    
                        echo "<label><span class=\"titulo_campo\">Bloco {$contadorDeBlocos}: informe outro número inteiro:</span>
                                <input type=\"text\" name=\"titulo\" class=\"campos_formulario\" autofocus >
                                {$dadoInformado}
                            </label>

                        <input type=\"submit\" class=\"btn_enviar\" value=\"cadastrar categoria\" name=\"cadastrar_categoria\">";
                        $numeros = [$dadoInformado];
                        array_push($numeros, $dadoInformado);
                    endfor;
                    if(!is_int($dadoInformado)):
                        echo "informe um número inteiro!";
                        echo "<label><span class=\"titulo_campo\">informe outro número inteiro:</span>
                            <input type=\"text\" name=\"titulo\" class=\"campos_formulario\" autofocus>
                        </label>

                        <input type=\"submit\" class=\"btn_enviar\" value=\"cadastrar categoria\" name=\"cadastrar_categoria\">";
                        if(is_int($dadoInformado)):
                            echo "Boa! informe mais um número inteiro";
                            echo "<label><span class=\"titulo_campo\">informe outro número inteiro:</span>
                                    <input type=\"text\" name=\"titulo\" class=\"campos_formulario\" autofocus>
                                </label>

                                <input type=\"submit\" class=\"btn_enviar\" value=\"cadastrar categoria\" name=\"cadastrar_categoria\">";
                        endif;
                    endif;
                endfor;
            endwhile;
        endif;
    endif;
?>
<!DOCTYPE html>
<html>
<head>
    <title>programa verificador de números inteiros</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../../css/painel.css" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <form action="" name="formulario_categorias" method="post">
        <label>
            <span class="titulo_campo">informe um número inteiro:</span>
            <input type="text" name="titulo" class="campos_formulario" autofocus>
        </label>
            
        <input type="submit" class="btn_enviar" value="Enviar" name="enviar_numero">
    </form>
</body>
</html>    