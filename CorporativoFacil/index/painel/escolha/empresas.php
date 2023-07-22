<!DOCTYPE html>
<html lang="pt-br">
    <?php
        session_start();
        date_default_timezone_set('Brazil/East');
    ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bot.css" rel="stylesheet" type="text/css"/>
        <link href="css/painel.css" rel="stylesheet" type="text/css"/>
        <link href="css/fonticon.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;500;600&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="../../img/favicon.ico">
        <title>Corporativo Fácil</title>
        <style>
            body{
                background: #cce5ff;
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
            
            .empresas{
                display: block;
            }
            
            .valores{
                color: #000;
            }
            
        </style>
    </head>
    <body class="empresas">
        <?php
            require_once '../../../Config/Conf.inc.php';
            
            $autentica = new Autenticacao();
            if( !$autentica->verificaLogin() ):
                header('Location: ../../formulario-login.php?acao=restrito');
            else:
                $usuario = $_SESSION['autenticado'];
            endif;
            
        ?>
        <article>
            <header>
                <h1>Empresas que atendemos no momento</h1>
            </header>
            <section>
                <header>
                    <h1 style="display: none;"> Navegação </h1>
                </header>
                    <nav class="menu_empresas">
                        <ul>
                            <li>
                                <a href='../pagInicial.php'>Painel</a>
                            </li>
                        </ul>
                    </nav>
            </section>
            
            
            <section>
                <header>
                    <h1>Listagem</h1>
                    <a href='cadastrar_empresa.php' class='botao_azul' style='text-decoration: none;' >cadastrar nova</a>
                </header>
                <?php                
                    $empresas = new Ler();
                    $empresas->consultaManual("SELECT *,em.id AS id_empresa FROM empresas em LEFT JOIN 
                             estados e ON em.estado_UF = e.id");
                        if( $empresas->resultado() ):
                            foreach ( $empresas->resultado() AS $tuplas ):
                                extract($tuplas);
                ?>
                <table>
                    <tr class="titulos">
                        <th>Logotipo</th>
                        <th>Nome Empresa</th>
                        <th>Endereço</th>
                        <th>estado</th>
                        <th>Ação</th>
                    </tr>
                    
                    <tr>
                        <td>
                            <?= Verificacao::imagens($logotipo, $nome_empresa); ?>
                        </td>
                        <td class="valores"><?= $nome_empresa;?></td>
                        <td class="valores"><?= $endereco;?></td>
                        <td class="valores"><?= $descricao;?></td>
                        <td class="valores">
                            <a href="editar_empresa.php?r=<?= $id_empresa*1079*2098*9990;?>">editar</a>
                            <a href="editar_empresa.php?excluir=<?= $id_empresa*1079*2098*9990;?>" class="botao_excluir">excluir.</a>
                        </td>
                    </tr>
                </table>
                <?php      
                        endforeach;
                    endif;
                ?>
            </section>
        </article>
        <script src="js/jQuery.js" type="text/javascript"></script>
        <script src="js/sweetalert2.all.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script>
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
                });

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

        </script>
    </body>
</html>
