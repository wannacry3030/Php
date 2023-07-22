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
        <title>Editar</title>
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
            
            $id = filter_input(INPUT_GET, 'r', FILTER_VALIDATE_INT);
            if( isset($id) ):
                $id = $id / 1079 / 2098 / 9990;
            endif;
                        
            $atualiza = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            
            if(  isset($atualiza) && $atualiza['atualiza_empresa']  ):
                $atualiza['logotipo'] = ( $_FILES['logotipo']['tmp_name'] ? $_FILES['logotipo'] : 'null' );
                unset($atualiza['atualiza_empresa']);
                
                require_once '../modelos/AdmEmpresas.class.php';
                $a = new AdmEmpresas();
                $a->atualizarEmpresa($id, $atualiza);
                
                if( $a->getResult() ):
                    errosDoUsuarioCustomizados($a->getErr()[0], $a->getErr()[1]);
                    echo "<a href='empresas.php' style='text-decoration: none;'>Clique para ver todas as empresas!</a>";
                endif;
                
            else:
                $le = new Ler();
                $le->executarLeitura('empresas', "WHERE id = :id", "id={$id}");
                if( $le->resultado() ):
                    $atualiza = $le->resultado()[0];
                endif;
            endif;
        ?>
        <main class="formulario">
            <header>
                <h1>Editar</h1>
                <button id="voltar">Voltar</button>
            </header>
            
            <section>
                <h2> <a href='../pagInicial.php' class='botao_painel'>Painel</a>  </h2>
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
                    
                    
                    <label>
                        <span class="titulo_campo">Nome empresa</span>
                        <input type="text" class="campos_formulario" name="nome_empresa" value="<?php if( isset($atualiza['nome_empresa']) ): echo $atualiza['nome_empresa']; else: echo "erro grande";endif;?>">
                    </label>
                    
                    <label>
                        <span class="titulo_campo"> Ramo</span>
                        <input type="text" class="campos_formulario" name="ramo" value="<?php if( isset($atualiza['ramo']) ): echo $atualiza['ramo']; endif;?>">
                    </label>
                    
                    <label>
                        <span class="titulo_campo"> Sobre a empresa</span>
                        <textarea class="textarea_content" name="sobre_empresa">
                            <?php if( isset($atualiza['sobre_empresa']) ): echo $atualiza['sobre_empresa']; endif;?>
                        </textarea>
                    </label>
                    
                    <label>
                        <span class="titulo_campo">Site da empresa:</span>
                        <input type="text" class="campos_formulario" name="site_empresa" value="<?php if( isset($atualiza['site_empresa']) ): echo $atualiza['site_empresa']; endif;?>">
                    </label>
                    
                    <label>
                        <span class="titulo_campo">Página da empresa no Facebook:</span>
                        <input type="text" class="campos_formulario" name="pag_facebook" value="<?php if( isset($atualiza['pag_facebook']) ): echo $atualiza['pag_facebook']; endif;?>">
                    </label>
                    
                    <label>
                        <span class="titulo_campo">Endereço</span>
                        <input type="text" class="campos_formulario" name="endereco" value="<?php if( isset($atualiza['endereco']) ): echo $atualiza['endereco']; endif;?>">
                    </label>
                    
                    <label>
                        <span class="titulo_campo">Estado:</span>
                        <select class="titulo_campo_selecoes" name="estado_UF">
                            <option value="null">selecione de onde veio a empresa</option>
                            <?php
                                $ler_Estados = new Ler();
                                $ler_Estados->consultaManual("SELECT em.estado_UF,e.id AS id,e.descricao AS nome FROM empresas em
                                        LEFT JOIN estados e ON em.estado_UF = e.id");
                                
                                if(  !$ler_Estados->resultado()  ):
                                    errosDoUsuarioCustomizados("Não há registros.", CORPF_LARANJADO);
                                else:
                                    foreach(  $ler_Estados->resultado() AS $estados  ):
                                        
                                        echo "<option value=\"{$estados['id']}\"  "; 
                                        if(  $atualiza['estado_UF'] == $estados['id']  ):
                                            echo "selected  =  'selected'  ";
                                        endif;
                                        echo ">{$estados['nome']} </option>";
                                    endforeach;
                                endif;
                            ?>
                        </select>
                    </label>
                    
                    <label>
                        <span class="titulo_campo">Cidade:</span>
                        <select class="titulo_campo_selecoes" name="cidade">
                            <option>Gama-DF</option>
                            <option>Rio-RJ</option>
                        </select>
                    </label>
                    
                    <input type="submit" class="botao_azul" name="atualiza_empresa" value="Editar">
                </form>
            </article>
        </main>
            
        <script src="js/jQuery.js"></script>
        <script src="js/funcoes.js"></script>
        <script type="text/javascript">
            
            document.getElementById('voltar').addEventListener('click',()=>{
               history.back();
            });
        </script>
    </body>
</html>