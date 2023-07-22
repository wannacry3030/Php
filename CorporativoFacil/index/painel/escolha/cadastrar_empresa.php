<!DOCTYPE html>
<?php
    session_start();
    date_default_timezone_set('Brazil/East');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bot.css" rel="stylesheet" type="text/css"/>
        <link href="css/painel.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;500;600&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="../../../img/favicon.ico">
        <title>Cadastrar empresa</title>
        <style>
            .progress-bar{
                background: green;
                height: 30px;
                width: 0%;
                border-radius: 4px;
                -webkit-border-radius: 4px;
                -moz-border-radius: 4px;
            }
            .progress{
                display: none;
                position: relative;
                margin: 20px;
                width: 400px;
                background-color:#ddd;
                border:1px solid blue;
                padding: 1px;
                left: 15px;
                border-radius: 3px;
            }
            #outputImage{
                display: none;
            }
            input#uploadImage {
                border: #f1f1f1 1px solid;
                padding: 6px;
                border-radius: 3px;
            }

            #outputImage img{
                max-width: 300px;
            }

            .percent{
                position: absolute;
                display: inline-block;
                color: #fff;
                font-weight: bold;
                top: 50%;
                left: 50%;
                margin-top: -9px;
                margin-left: -20px;
                -webkit-border-radius: 4px;
            }
            
            .menu_empresas{
                display: flex;
                align-items: stretch;
            }
            .menu_empresas ul li {
                list-style: none;
                display: flex;
                align-items: center;
            }
            .menu_empresas ul li a {
                padding: 26px;
                display: flex;
                align-items: center;
                height: 40%;
                color: #d36833;
                margin: 0 10px;
            }
            .menu_empresas ul li a:hover{
                color: #FFF;
                background-color: #d36833;
                border-radius: 5px;
                transition: 0.6s;
                display: flex;
                //align-items: stretch;
            }
        </style>
    </head>
    <body>
        <?php
            require ('../../../Config/Conf.inc.php');

            /* VERIFICA A AUTENTICAÇÃO (SESSÃO) do usuário. 
                Se o usuário não entrou no sistema e tenta acessar sem estar autenticado, 
                o sistema o joga pra fora.
             */
            $autentica = new Autenticacao();

            if( !$autentica->verificaLogin() ):
                unset($_SESSION['autenticado']);
                header('Location: ../../formulario-login.php?acao=restrito');
            else:
                $usuario = $_SESSION['autenticado'];
            endif;
            
            $cadastro_empresa = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            
            if( isset($cadastro_empresa) && $cadastro_empresa['cadastra_empresa'] ):
                $cadastro_empresa['logotipo'] = ( $_FILES['logotipo']['tmp_name'] ? $_FILES['logotipo'] : 'null' );
                
                var_dump($cadastro_empresa['logotipo']);
                
                unset($cadastro_empresa['cadastra_empresa']);
                
                $logotipo = $cadastro_empresa['logotipo'];
                
                if(  isset($logotipo)  ):
                    var_dump($logotipo);                    
                endif;
                
                require_once '../modelos/AdmEmpresas.class.php';
                $insereEmpresa = new AdmEmpresas();
                $insereEmpresa->cadastraEmpresa($cadastro_empresa);
                if( $insereEmpresa->getResult() ):
                    errosDoUsuarioCustomizados($insereEmpresa->getErr()[0], $insereEmpresa->getErr()[1]);
                    echo "<a href='empresas.php' style='text-decoration: none;'>Clique para ver todas as empresas!</a>";
                else:
                    errosDoUsuarioCustomizados("Erro ao cadastrar empresa.", CORPF_VERMELHO);
                endif;
                
            endif;
            
        ?>
        <main class="formulario">
            <header>
                <h1>Nova empresa</h1>
            </header>
            
            <section>
                    <nav class="menu_empresas">                        
                        <ul>
                            <li>
                                <a href='../pagInicial.php'>Painel</a>
                            </li>
                            <li>                            
                                <a href="empresas.php" >Voltar às empresas</a>
                            </li>
                        </ul>
                    </nav>
            </section>
            
            <article>
                <header>
                    <h3>Formulário</h3>
                    insira os dados da mesma abaixo:
                </header>
                <form name="cadastra_empresa" method="post" id="uploadForm" enctype="multipart/form-data">
                    
                    <label>
                        <span class="titulo_campo">Logotipo da empresa:</span>
                        <input type="file" class="campos_formulario_arquivo" name="logotipo" id="uploadImage">
                    </label>
                    
                    
                    <div class="progress" id="progressDivId">
                        <div class="progress-bar" id="progressBar"></div>
                        <div class="percent" id="percent">0%</div>
                    </div>
                    <div style="height: 10px;"></div>
                    <div id="outputImage"></div>
                    <button id="submitButton">Subir imagem</button>
                    
                    
                    <label>
                        <span class="titulo_campo">Nome empresa</span>
                        <input type="text" class="campos_formulario" name="nome_empresa">
                    </label>
                    
                    <label>
                        <span class="titulo_campo"> Ramo</span>
                        <input type="text" class="campos_formulario" name="ramo">
                    </label>
                    
                    <label>
                        <span class="titulo_campo"> Sobre a empresa</span>
                        <textarea class="textarea_content" name="sobre_empresa"></textarea>
                    </label>
                    
                    <label>
                        <span class="titulo_campo">Site da empresa:</span>
                        <input type="text" class="campos_formulario" name="site_empresa">
                    </label>
                    
                    <label>
                        <span class="titulo_campo">Página da empresa no Facebook:</span>
                        <input type="text" class="campos_formulario" name="pag_facebook">
                    </label>
                    
                    <label>
                        <span class="titulo_campo">Endereço</span>
                        <input type="text" class="campos_formulario" name="endereco">
                    </label>
                    
                    <label>
                        <span class="titulo_campo">Estado:</span>
                        <select class="titulo_campo_selecoes" name="estado_UF">
                            <option>DF</option>
                            <option>SP</option>
                            <option>RJ</option>
                            <option>MG</option>
                        </select>
                    </label>
                    
                    <label>
                        <span class="titulo_campo">Cidade:</span>
                        <select class="titulo_campo_selecoes" name="cidade">
                            <option>Gama-DF</option>
                            <option>Rio-RJ</option>
                        </select>
                    </label>
                    
                    <input type="submit" class="botao_azul" name="cadastra_empresa" value="Inserir">
                </form>
            </article>
        </main>
            
        <script src="js/jQuery.js"></script>
        <script src="js/funcoes.js"></script>
        <script type="text/javascript">
            $(function () {
                $('#submitButton').click(function () {
                    $('#uploadForm').ajaxForm({
                        target: '#outputImage',
                        url: 'cadastrar_empresa.php',
                        beforeSubmit: function () {
                              $("#outputImage").hide();
                               if($("#uploadImage").val() == "") {
                                   $("#outputImage").show();
                                   $("#outputImage").html("<div class='botao_cancela_js'>Escolha um arquivo!</div>");
                            return false;
                        }
                        console.log($(this));
                            $("#progressDivId").css("display", "block");
                            var percentValue = '0%';

                            $('#progressBar').width(percentValue);
                            $('#percent').html(percentValue);
                        },
                        uploadProgress: function (event, position, total, percentComplete) {
                            var percentValue = percentComplete + '%';
                            $("#progressBar").animate({
                                width: '' + percentValue + ''
                            }, {
                                    duration: 5000,
                                    easing: "linear",
                                    step: function (x) {
                                    percentText = Math.round(x * 100 / percentComplete);
                                        $("#percent").text(percentText + "%");
                                    if(percentText == "100") {
                                           $("#outputImage").show();
                                    }
                                }
                            });
                        },
                        error: function (response, status, e) {
                            alert('Oopa, deu erro...');
                        },

                        complete: function (xhr) {
                            if (xhr.responseText && xhr.responseText != "error")
                            {
                                  $("#outputImage").html(xhr.responseText);
                            }
                            else{  
                                $("#outputImage").show();
                                $("#outputImage").html("<div class='botao_cancela_js'>Erro ao capturar a imagem.</div>");
                                $("#progressBar").stop();
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</html>