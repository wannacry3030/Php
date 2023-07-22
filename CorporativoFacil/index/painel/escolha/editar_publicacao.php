<!DOCTYPE html>
<html lang="pt-br">
<?php
    session_start();
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bot.css" rel="stylesheet" type="text/css"/>
    <link href="css/painel.css" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../../../img/favicon.ico">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <script src="https://kit.fontawesome.com/e5e59e1fb1.js" crossorigin="anonymous"></script>
    
    <style>
        body{
            background: #cce5ff;
        }
        
        .galeria{
            display: inline;
            position: relative;
            width: 100%;
            height: auto;
            //background: #00254A url(../../../img/empresa1.png) center center no-repeat;
            background-size: 100%;
            padding: 0.5em 1em;
            left:0;
            margin: 15px 0.5em;
        }
        
        .galeria-botao-excluir{
            position: absolute;
            left: 1.1em;
            top: -1.8em;
            height: 21px;
            width: 21px;
        }
        .galeria-botao-excluir:hover{
            background-color: #ccc;
            transition: 0.5s;
            border-radius: 50em;
        }
        .btn_enviar{
            margin: 1.2em auto;
        }
        
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
    
    
    <title>Editar publicação</title>
</head>
<body class="editar_post">
    <header>        
        <?php
            date_default_timezone_set('Brazil/East');
            require('../../../Config/Conf.inc.php');
            
            if( !class_exists('Autenticacao') ):
                errosDoUsuarioCustomizados("Você não pode acessar à essa área por essa caminho.", CORPF_VERMELHO);
                header('Location:../index.php');
                die;
            endif;
            
            $autentica = new Autenticacao();
            if( !$autentica->verificaLogin() ):
                unset($_SESSION['autenticado']);
                header('Location: ../../formulario-login.php?acao=restrito');
            else:
                $usuario = $_SESSION['autenticado'];
            endif;
            
            
            $id = filter_input(INPUT_GET,'fw', FILTER_VALIDATE_INT);
            echo "<h1>Publicação id " . $id . "</h1>";
           
            if( isset($id) ):
                $id = $id / 1024 / 1024 / 3;
            endif;
            
            $publicacao = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            
            if( isset($publicacao) && $publicacao['editar_publicacao'] ):
                $publicacao['imagem'] = ( $_FILES['imagem']['tmp_name'] ? $_FILES['imagem'] : 'null' );
                unset($publicacao['editar_publicacao']);
                
                require('../modelos/AdmPublicacoes.class.php');
                
                echo "<span class='titulo_campo'>Foto da capa atual</span>";
                $admPublicacoes = new AdmPublicacoes();
                $admPublicacoes->executaEdicao($publicacao, $id);
                                
                if(  !empty($_FILES['fotos']['tmp_name'])  ):
                    $enviarGaleria = new AdmPublicacoes();
                    $enviarGaleria->enviarGaleria($_FILES['fotos'], $id);
                    if(  $enviarGaleria->getResult()  ):
                        errosDoUsuarioCustomizados("A galeria foi atualizada! {$enviarGaleria->getQtdGaleria()} imagens enviadas à galeria", CORPF_VERDE);
                    endif;
                endif;
                
                if( isset($_FILES['fotos']['tmp_name']) && $publicacao == '' ):
                    $ng = new AdmPublicacoes();
                    $ng->enviarGaleria($_FILES['fotos'], $id);
                    if( $ng->getResult() ):
                        errosDoUsuarioCustomizados("Galeria atualizada! {$ng->getQtdGaleria()} enviadas.", CORPF_VERDE);
                    endif;
                endif;
                
                if( $admPublicacoes->getResult() ):
                    errosDoUsuarioCustomizados($admPublicacoes->getErro()[0], $admPublicacoes->getErro()[1]);
                    echo "<a href='publicacoes.php' style='text-decoration: none;'>Clique para ver todas as publicações.</a>";
                endif;
                /*
                $existeCadastro = filter_input(INPUT_GET, 'existeCadastro', FILTER_VALIDATE_BOOLEAN);
                if(isset($existeCadastro) && empty($admPublicacoes)):
                    
                endif;                */
            else:
                $lerDadosParaEdicao = new Ler();
                $lerDadosParaEdicao->executarLeitura('publicacao', "WHERE id = :id", "id={$id}");
                    //Nesse bloco é quando tentei atualizar uma categoria que não existe.
                    //header('Location:publicacoes.php?msg=false');
                
                if( $lerDadosParaEdicao->resultado() ):
                    /* 
                      Bem aqui, peguei a variável $publicacao e reescrevi a mesma, 
                        alimentando-a com os dados da leitura no Banco de Dados(AFINAL, É UM FORMULÁRIO DE EDIÇÃO, 
                        OU SEJA, ME TRARÁ OS DADOS JÁ PRONTOS PARA EDITAR ALGUM CAMPO) ao invés 
                        de cadastrar novamente.
                     */
                    $publicacao = $lerDadosParaEdicao->resultado()[0];
                    $publicacao['data_da_publicacao'] = date('d/m/Y H:i:s', strtotime($publicacao['data_da_publicacao']));
                endif;
            endif;
            /*$img = "IMAGEM EM PNG.png";
            $imFormatada = str_replace(" ", "-", strtolower($img));
            echo $imFormatada;
            echo "<hr>";
            $numero = 1;
            for($contador = 1; $contador <= 10; $contador++):
                echo "<br>".str_pad($contador, 2, 0, STR_PAD_LEFT);
            endfor;*/
        ?>
    </header>
    <main>
        <button id="voltar">Voltar</button>
        <header>
            <h1 class="titulo_campo">Editar publicação</h1>
            <span>
                <?php
                    if($_SESSION['autenticado']['nivel'] == 3):
                        echo "<h1><a href='../pagInicial.php' class='btn_enviar' style='text-decoration: none; '>Painel</a>  </h2>";
                    else:
                        echo "<h1><a href='../pagInicialAutor.php' class='btn_enviar' style='text-decoration: none; '>Painel</a>  </h2>";
                    endif;
                ?>
            </span>
        </header>
        <?php 
            $imagemGaleria = filter_input(INPUT_GET, 'imagemGal', FILTER_VALIDATE_INT);
            $postId = filter_input(INPUT_GET, 'postid', FILTER_VALIDATE_INT);

            if( isset($postId) ):
                $postId = $postId / 9378 / 825 / 14;
                var_dump($postId);
                require_once '../modelos/AdmPublicacoes.class.php';
                $excluir = new AdmPublicacoes();
                $excluir->atualizarGaleria($imagemGaleria);
                if( $excluir->getResult() ):
                    errosDoUsuarioCustomizados($excluir->getErro()[0], $excluir->getErro()[1]);
                    $dadosDoBanco = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                    echo "<a href='publicacoes.php' style='text-decoration: none;'>Clique para ver todas as publicações.</a>";
                    
                    $lerDadosParaEdicao = new Ler();
                    $lerDadosParaEdicao->executarLeitura('publicacao', "WHERE id = :id", "id={$postId}");
                    if($lerDadosParaEdicao->resultado()):
                        $dadosDoBanco = $lerDadosParaEdicao->resultado()[0];
                        $dadosDoBanco['data_da_publicacao'] = date('d/m/Y H:i:s', strtotime($dadosDoBanco['data_da_publicacao']));
                    else:
                        $dadosDoBanco = $lerDadosParaEdicao->resultado()[0];
                        $dadosDoBanco['data_da_publicacao'] = date('d/m/Y H:i:s', strtotime($dadosDoBanco['data_da_publicacao']));                        
                    endif;
                endif;
            endif;
            
            ?>
        <article>
            <header>
                <span class="mostrar-usuario-na-sessao">Usuário: <b><?= $_SESSION['autenticado']['usuario'];?></b> |
                id: <b><?= $_SESSION['autenticado']['id'] * 795 * 157977 * 235;?> </b>
                </span>                
            </header>
            <form name="formulario_publicacoes" method="post" id="uploadForm" enctype="multipart/form-data">
                <header>
                    <h1>PARA CADASTRAR UMA GALERIA, INSIRA UMA CAPA.</h1>
                </header>
                <input type="hidden" name="id_autor" value="<?= $_SESSION['autenticado']['id']; ?>">
                <label>
                    <span class="titulo_campo">Título da publicação</span>
                    <input type="text" name="descricao" class="campos_formulario" value="<?php if(isset($publicacao['descricao'])): echo $publicacao['descricao'];  else: echo $dadosDoBanco['descricao']; endif; ?>" autofocus>
                </label>

                <label>
                    <span class="titulo_campo">Conteúdo</span>
                    <textarea class="textarea_content" name="conteudo"><?php if(isset($publicacao['conteudo'])): echo $publicacao['conteudo'];  else: echo $dadosDoBanco['conteudo']; endif;?></textarea>
                </label>                
                
                <span class="titulo_campo">Carregar nova capa</span>
                <input type="file" name="imagem" class="campos_formulario_arquivo">
                
                <!--  Progress bar! -->
                <div class="progress">
                    <div class="progress-bar"></div>
                </div>
                
                <!--Displays upload status-->
                <div id="uploadStatus"></div>
                
                <span class="titulo_campo">Capa atual:</span>
                <div> <?= Verificacao::imagens($publicacao['imagem'], $publicacao['descricao'], 200,200); ?> </div>
                             
                <label>
                    <span class="titulo_campo">Criada em:</span>
                    <input type="text" id="data_post" class="campos_formulario" placeholder="informe data e hora" name="data_da_publicacao" value="<?php if(isset($publicacao['data_da_publicacao'])): echo $publicacao['data_da_publicacao']; else: echo $dadosDoBanco['data_da_publicacao']; endif;?>">
                </label>

                <label>
                    <span class="titulo_campo">Categoria</span>
                    <select name="id_categoria" class="titulo_campo_selecoes">

                        <option value="null">Escolha uma categoria: </option>
                        <?php
                            $lerInformacoes = new Ler();
                            $lerInformacoes->consultaManual("SELECT DISTINCT ca.id AS id_cat,
                                     p.id_categoria AS categoria_da_publicacao,
                                     ca.titulo AS titulo, ca.conteudo AS conteudo, au.nome AS autor 
                                     FROM categorias ca LEFT JOIN publicacao p ON p.id_categoria = ca.id
                                     LEFT JOIN autor au ON au.id = p.id_autor GROUP BY ca.titulo
                                     ORDER BY titulo ASC");

                            if( !$lerInformacoes->resultado() ):
                                echo "<option disabled='disabled'>Não encontrou a categoria que procura? Cadastre uma nova</option>";
                            else:
                                foreach( $lerInformacoes->resultado() AS $categorias ):
                                    //var_dump($lerInformacoes);
                                    echo "<option value=\"{$categorias['id_cat']}\" ";                                
                                    if($categorias['id_cat'] == $publicacao['id_categoria']):
                                        echo " selected='selected' ";
                                    endif;
                                    echo ">&nbsp &rsaquo;  {$categorias['titulo']}</option>";

                                endforeach;
                            endif;
                        ?>
                    </select>
                </label>
                <label>
                    <span class="titulo_campo">Autor</span>
                    <select name="id_autor" class="titulo_campo_selecoes">
                        <option value="null">Selecione um autor</option>
                        <?php
                            $lerAutor = new Ler();
                            $lerAutor->consultaManual("SELECT DISTINCT a.id AS id_autor,
                                p.id_autor AS id_autor_publicacao, a.nome AS autor 
                                FROM autor a LEFT JOIN publicacao p ON a.id = p.id_autor
                                WHERE a.id = {$_SESSION['autenticado']['id']}");

                            if( !$lerAutor->resultado() ):
                                 echo "<option disabled='disabled'>Não há autores</option>";
                            else:
                                foreach( $lerAutor->resultado() AS $autores ):
                                    echo "<option value=\"{$autores['id_autor']}\" ";
                                    if( $autores['id_autor'] == $publicacao['id_autor'] || $autores['id_autor'] == $dadosDoBanco['id_autor'] ):
                                        echo " selected=\"selected\" ";
                                    endif;

                                    echo "><b> &rsaquo; </b>{$autores['autor']}</option>";
                                endforeach;
                            endif;
                            
                            if( $publicacao['id_autor'] != $_SESSION['autenticado']['id'] ):
                                $lerAutor = new Ler();
                                $lerAutor->consultaManual("SELECT DISTINCT a.id AS id_autor,
                                    p.id_autor AS id_autor_publicacao, a.nome AS autor 
                                    FROM autor a LEFT JOIN publicacao p ON a.id = p.id_autor
                                    WHERE a.id = p.id_autor");
                                if( $lerAutor->resultado() ):
                                    foreach($lerAutor->resultado() AS $au):
                                        echo "<option value=\"{$au['id_autor_publicacao']}\" ";
                                        if($au['id_autor_publicacao'] == $publicacao['id_autor']):
                                            echo " selected=\"selected\" ";
                                        endif;

                                        echo "><b> &rsaquo; </b>{$au['autor']}</option>";
                                    endforeach;
                                endif;
                            endif;
                        ?>
                    </select>
                </label>
                <div class="secao-de-galerias">
                    <label class="titulo_campo">Galeria</label>
                    <input type="file" class="campos_formulario_arquivo" multiple="multiple" name="fotos[]" accept="image/png,image/jpeg">
                    <?php
                        /*
                            SELECT g.nome_imagem AS galeria,
                          p.imagem AS capa,
                          g.id AS id_galeria, p.id AS post_id
                          FROM galerias g LEFT JOIN publicacao p ON g.id_publicacao = p.id
                         */
                        $gb = 0;
                        $trazerGaleria = new Ler();
                        $trazerGaleria->executarLeitura('galerias', "WHERE id_publicacao = :id_post", "id_post={$id}");
                        if( $trazerGaleria->resultado() ):
                            foreach( $trazerGaleria->resultado() AS $galeria ):
                                $gb++;
                    ?>
                    <div class="galeria">
                        <?= Verificacao::imagens($galeria['nome_imagem'], $publicacao['descricao'].'-'.$gb, 200, 150); ?>
                        <a href="editar_publicacao.php?postid=<?= $id*9378*825*14;?>&imagemGal=<?= $galeria['id'];?>" class="imagem j_delete">
                            <img src="icone/cancel.png" alt="excluir" title="<?= $galeria['id']; ?>" class="galeria-botao-excluir">
                        </a>
                    </div>
                    <?php endforeach; endif; ?>
                </div>
                <input type="submit" class="btn_enviar" value="Editar publicacao" name="editar_publicacao">
            </form>
        </article>
    </main>
    <script src="js/jQuery.js"></script>
    <script src="js/jquery.form.min.js"></script>
    <script src="js/funcoes.js"></script>
    <script src="js/jquery.mask.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-datepicker.min.js"></script>
    <script src="js/bootstrap-datepicker.pt-BR.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
    <script type="text/javascript">
        /*tinymce.init({
          selector: '#publicar',
          language: 'pt_BR'
        });  */
        
        $("#data_post").mask('99/99/0000 00:00:00');
    
        document.getElementById("voltar").addEventListener('click',()=>{
           history.back();
        });
        
        $(".botao_excluir").on("click", function(e){
            e.preventDefault();
            
            const destino = $(this).attr('href');
            console.log(destino);
            
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'botao_confirma_js',
                  cancelButton: 'botao_cancela_js'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Quer excluir mesmo?',
                text: "não há como reverter a exclusão.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim!',
                cancelButtonText: 'Não!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    setTimeout(function(){
                        document.location.href = destino;                        
                    }, 1500);
                    swalWithBootstrapButtons.fire(
                        'Excluído!',
                        'Você excluiu o post..',
                        'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                      'Cancelado.',
                      'O post continua aqui :)',
                      'error'
                    )
                }
            })
        })
        
        
        $(function(){
            $(".excluir-item-galeria").click(function(){
                console.log($(this));
                $(this).slideDown(100, function(){
                    $("html, body").animate({scrollTop: $(this).offset().top}, 500)
                });
            });
            
        });
        
        
       
    </script>
</body>
</html>