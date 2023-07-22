<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="escolha/css/bot.css" rel="stylesheet" type="text/css"/>
        <link href="escolha/css/painel.css" rel="stylesheet" type="text/css"/>
        <link href="escolha/css/fonticon.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;500;600&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="../../img/favicon.ico">
        <title>Corporativo Fácil</title>
        <style>            
            .elementos{
                display: flex;
                text-align: center;
                margin: 0;
                //flex-basis: calc(800px - 115px);
                //justify-content: flex-start;       
            }
            .lanca_erro.laranjado{
                margin: 1em auto;
            }
            section header h2{
                margin: -5px 10em 1em 24em;
            }
            
            .suas_publicacoes{
                max-width: 500px;
                width: 25%;
                margin: 0.5em 30em 1em 36em;
                padding: 1em;
                text-decoration: none;
            }
            
            .publicacoes{
                text-align: center;
            }
            
            .estatisticas{
                display: block;
                margin: 1em;
            }
            article.suas_publicacoes{
                display: block;
            }
            
            .suas_publicacoes ul{
                text-decoration: none;
            }
            
            .obrigatorio:required{
                border: 1px solid red;
            }
        </style>
    </head>
    <body>
        <?php
            session_start();
            date_default_timezone_set('Brazil/East');
            require('../../Config/Conf.inc.php');
            
            $acao = filter_input(INPUT_GET, 'acao', FILTER_DEFAULT);
            if( $acao == 'naoAutorizado' ):
                errosDoUsuarioCustomizados("Você tentou acessar uma página interna sem passar pela pág Inicial.", CORPF_AMARELO);
            endif;
        
            $diaSemana = date('w');
            $diasEmPortugues = array(
                            0 => "Domingo",
                            1 => "Segunda-feira",
                            2 => "Terça-feira",
                            3 => "Quarta-feira",
                            4 => "Quinta-feira",
                            5 => "Sexta-feira",
                            6 => "Sábado"   );
            $mes = date('m');
            $mesEmPortugues = array(
                                    "01"=>"Janeiro",
                                    "02"=>"Fevereiro",
                                    "03"=>"Março",
                                    "04"=>"Abril",
                                    "05"=>"Maio",
                                    "06"=>"Junho",
                                    "07"=>"Julho",
                                    "08"=>"Agosto",
                                    "09"=>"Setembro",
                                    "10"=>"Outubro",
                                    "11"=>"Novembro",
                                    "12"=>"Dezembro"
            );
                    //terça     = date(2);
                    //Abril     = date(04);
            echo $diasEmPortugues[$diaSemana] . " , dia <b>" . date('d') . "</b> de <b>" . $mesEmPortugues[$mes] . "</b> de <b>" . date('Y') . "</b>" .". ". date('H')." horas, ".date('i')." minutos e " . date('s') . " segundos";
                        
            //echo Verificacao::imagens('contato.jpg', "FotoDeteste","../../");
            
            
            $autentica = new Autenticacao();
            $sair = filter_input(INPUT_GET, 'sair', FILTER_VALIDATE_BOOLEAN);
            
            if( !$autentica->verificaLogin() ):
                unset($_SESSION['autenticado']);
                header('Location: ../formulario-login.php?acao=restrito');
                //var_dump($autentica);
            else:
                $usuario = $_SESSION['autenticado'];
            endif;
            
            
            
            if( $sair ):
                unset($_SESSION['autenticado']);
                header('Location: ../formulario-login.php?acao=sair');
            endif;
            echo "<hr>";           
        ?>
        
        <header class="cabecalho_principal">
            <div class="conteudo_cabecalho">
                <img src="../../img/empresa2.png" class="foto">
                <nav class="menu">
                    <ul>
                        <li class="usuario">Bem vindo, <?= $usuario['usuario']?> !</li>
                        <li><a href="escolha/usuarios.php">Usuários</a></li>
                        <li><a href="pagInicial.php?sair=true" class="botao_sair" style="margin: 0">sair</a></li>
                    </ul>
                </nav>
                
            </div>
            
        </header>
        
        <main>
            <div class="cta">
                <article class="cta_content">
                    <header>
                        <h1>Aqui você tem o necessário para automatizar o fluxo de sua empresa. Descubra as vantagens de trabalhar com a gente!</h1>
                    </header>

                    <p>Domine HTML5 e CSS3 de uma vez por todas!</p>
                </article>
            </div>
            <div class="elementos">
                <nav>
                    <ul>
                        <li><a href="escolha/publicacoes.php" class="itens_menu">Publicações</a></li>
                        <li><a href="escolha/categorias.php" class="itens_menu">Categorias</a></li>
                        <li><a href="escolha/empresas.php" class="itens_menu">Empresas.</a></li>
                        <li><a href="escolha/praticando_programacao.php" class="itens_menu">Praticando PHP</a></li>
                        <li><a href="../ajax/ajax.php" class="itens_menu">AjaxPHP</a></li>
                    </ul>
                </nav>
                
                <section class="formulario-de-teste-index"> <!--background-color: #ff253a;-->
                    <header>                    
                        <h1>HTML5 e CSS3 Essentials</h1>
                        <p>Aprenda a trabalhar com HTML5 para desenvolver seus projetos e entregar páginas que estejam dentro dos padrões da Web seguindo as boas práticas</p>

                        <a class="abrir-formulario abrir-formulario-js" rel="cadastro" style="margin-top: 1em;"></a>
                    </header>
                    <hr><br>
                    <form name="formulario-teste-json" class="ajax_enviar cadastro" method="post" style="display: none;">
                        <h2 class="titulo_formulario">Cadastrar novo autor</h2>
                        <div class="caixa-de-erro"></div>

                        <label class="titulo_formulario"> Nome:</label>
                        <input type="text" name="nome" class="campos_formulario_cadastro_ajax" autofocus>
                        <input type="hidden" name="acaoFormulario" value="cadastro">

                        <label class="titulo_formulario"> E-mail usuário:</label>
                        <input type="text" name="email" class="campos_formulario_cadastro_ajax obrigatorio" placeholder="nome@servidor.com">

                        <label class="titulo_formulario"> telefone usuário:</label>
                        <input type="text" name="telefone" id="telefone" class="campos_formulario_cadastro_ajax obrigatorio" placeholder="(00) 9 9999-9999">
                        
                        <label class="titulo_formulario"> Sua senha:</label>
                        <input type="password" name="senha" class="campos_formulario_cadastro_ajax obrigatorio" placeholder="sua senha">
                        <label class="titulo_formulario"> Nickname usuário:</label>
                        <input type="text" name="usuario" class="campos_formulario_cadastro_ajax" placeholder="Defina um nome de usuário para entrar no sistema">
                        <input type="hidden" name="nivel" value="1" class="campos_formulario_cadastro_ajax obrigatorio">
                        <label class="titulo_formulario"> insira a data de nascimento:</label>
                        <input type="text" name="data_nasc" id="data_nasc" class="campos_formulario_cadastro_ajax obrigatorio" placeholder="dia/mês/ano">
                        

                        <button class="mandar_formulario_ajax" name="mandar">Cadastro</button>
                        <img class="gif-2-formulario" src="../../img/spinner.gif" alt="CARREGANDO..." title="CARREGANDO...">
                       
                    </form>
                </section>
            </div>
            
            <section class="estatisticas">
                <article class="suas_publicacoes">
                    <header>
                        <h1>Visitas por navegador</h1>
                    </header>
                    <?php
                        $S = new Sessions();
                        $S->checkSession();
                        
                        $estatist = new Ler();
                        $estatist->consultaManual("SELECT SUM(agent_views) AS total FROM navegador");
                        $V = $estatist->resultado()[0]['total'];
                        
                        $estatist->executarLeitura('navegador', "ORDER BY agent_views DESC LIMIT 6");
                        if( !$estatist->resultado() ):
                            errosDoUsuarioCustomizados("Ainda não existem dados dos navegadores.", CORPF_LARANJADO);
                        else:
                            echo "<ul>";
                            foreach( $estatist->resultado() AS $dados ):
                                extract($dados);
                            
                                $porcento = substr( ($agent_views / $V) * 100, 0, 5 );
                    ?>
                        <li>
                            <p><strong><?= $agent_name; ?>: </strong>  <?= $porcento;?>%</p>
                            <div style="height:25px; background-color: #0044cc;width:<?= $porcento;?>%"></div>
                            <p><?= $agent_views;?> visitas</p>
                            <hr>
                        </li>
                    <?php
                            endforeach;
                            echo "</ul>";
                        endif;
                    ?>
                </article>
                
                <header>
                    <h2>Lista de empresas recentes</h2>
                </header>
                
                
                <?php
                    $lerEmpresas = new Ler();
                    $lerEmpresas->executarLeitura("empresas");
                    
                    if( !$lerEmpresas->resultado() ):
                        errosDoUsuarioCustomizados("Nenhum registro de empresas ainda...", CORPF_LARANJADO);
                    else:
                        foreach ( $lerEmpresas->resultado() as $e ) :
                ?>
                
                <div class="suas_publicacoes">
                    <a href="./escolha/empresas.php" style="color: #fff;"><p class="publicacoes"> <?= $e['nome_empresa']; ?> </p></a>
                </div>
                
                <?php
                        endforeach;
                    endif;
                ?>
            </section>
            
            
            
            <section class="secao_1 edicao_jquery">
                <header>
                    <h3>sistema Corporativo Fácil</h3>
                    <p>Aqui você encontra as ferramentas necessárias para alavancar sua empresa!</p>
                </header>
                
                <article>
                    
                </article>
            </section>
            
            <div class="formulario-final">
                <article>
                    <header>
                        <p>Categorias</p>

                        <h1>quer receber as novidades por email? </h1>
                        <p>Informe seu nome e email no campo ao lado  e clique OK</p>
                    </header>

                    <form>
                        <input type="text" placeholder="informe seu nome">
                        <input type="email" placeholder="seu email">
                        <button type="submit">Ok!</button>
                    </form>
                </article>
            </div>
            
        <?php
            //SISTEMA DE NAVEGAÇÃO .
            /*
            $ativar = filter_input(INPUT_GET, 'ativar', FILTER_DEFAULT);
            
            if(!empty($ativar)):
                $incluir = __DIR__ . '\\escolha\\' . strip_tags(trim($ativar)) . 'php';
            else:
                $incluir = __DIR__;
                echo $incluir;
            endif;
            
            if(file_exists($incluir)):
                require_once($incluir);
            else:
                echo "<div class=\"content notfound\">";
                errosDoUsuarioCustomizados("Erro ao incluir página <b>/{$ativar}.php!</b>", CORPF_VERMELHO);
                echo "</div>";
            endif;*/
        ?>
        </main>
        <!--<audio src="../../img/cornucopia.mp3" controls>Overkill's cover of Black Sabbath's Cornucopia.</audio>-->
        <script src="escolha/js/jQuery.js" type="text/javascript"></script>
        <script src="escolha/js/enviar-dados.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
        <script type="text/javascript">            
            /*
                Todo efeito jQuery --no caso, o método fadeOut()--  tem um parâmetro a mais .
            */ /*
            $(".edicao_jquery").on("click",function(){
                $(".edicao_jquery").fadeOut(1000,function(){
                    alert("Você clicou");
                });
            });
            */
            $("#telefone").mask('(99)9.9999-9999');
            $("#data_nasc").mask('00/00/0000');
            
            
            $(function(){
                $(".abrir-formulario").on("click", function(){
                    console.log($(this));
                    $(this).slideDown(300, function(){
                        $("html, body").animate({scrollTop: $(this).offset().top}, 500)
                    });
                });

            });
            
            
            /*$(document).ready(function(){
                
                function dataPadraoBR(data_BR){
                    var separar = data_BR.split('-');
                    var novaData = separar[2] + '/' + separar[1] + '/' + separar[0];
                    return novaData;
                }
                
                var campo = document.getElementById("data_nasc");
                if(campo){
                    campo.setAttribute('type',dataPadraoBR('11-06-2020'));
                }
            });*/
            //shorthands: envia valores ao PHP e retorna respostas
        </script>
        <!--        col:  titulo ||conteudo || data_hoje
                Jogos
                Novidades/notícias sobre jogos
                2020-08-30 08:51:00

                Edit Edit
                Copy Copy
                Delete Delete
                6
                Metal
                Informações sobre o mundo do metal!
                2020-08-30 08:51:00

                Edit Edit
                Copy Copy
                Delete Delete
                17
                Quarentena
                A quarentena vai durar mais tempo.
                2020-08-30 08:50:00

                Edit Edit
                Copy Copy
                Delete Delete
                21
                Cicero
                O Cícero vai conseguir ATENDIMENTOS ANTES DE DEZEM...
                2020-09-30 09:41:00

                Edit Edit
                Copy Copy
                Delete Delete
                38
                Vai-dar-certo
                vai logo!
                2020-08-12 08:59:00


                Edit Edit
                Copy Copy
                Delete Delete
                47
                Vida
                vai dar certo!
                2020-08-14 08:46:00

                Edit Edit
                Copy Copy
                Delete Delete
                50
                Comida
                carne moída com cebola, vitamina de banana e panqu...
                2020-08-15 08:55:00

                Edit Edit
                Copy Copy
                Delete Delete
                53
                Heavy-Metal-thrash-metal
                Drunken Wisdom(1988) - Overkill
                2020-09-18 09:05:00

                Edit Edit
                Copy Copy
                Delete Delete
                55
                Cicero-1
                O cicero vai sair dessa, vitorioso
                2020-09-16 09:56:00

                Edit Edit
                Copy Copy
                Delete Delete
                56
                Musica-1
                FPG- my way(COVER)
                2020-09-16 09:44:00

                Edit Edit
                Copy Copy
                Delete Delete
                57
                Amor
                Miro.
                2020-09-22 09:59:00

                Edit Edit
                Copy Copy
                Delete Delete
                58
                emprego
                Vida profissional
                2020-10-30 15:33:08

        -->
    </body>
</html>