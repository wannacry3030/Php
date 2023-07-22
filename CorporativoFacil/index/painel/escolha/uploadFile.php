<?php
    require_once('../../../Config/Conf.inc.php');
    
    if(isset($_POST['editar_publicacao']) || isset($_POST['imagem'])):
        $newFile = $_FILES['imagem'];
        $path = __DIR__ . '/uploads/';
        //AQUI ESTOU ATRÁS DO DIRETÓRIO, E NÃO DO ARQUIVO (não ainda)
        if(!is_writable($path) || !is_dir($path)):
            errosDoUsuarioCustomizados("Erro ao carregar a imagem!", CORPF_LARANJADO);
            var_dump($newFile);
            echo __DIR__;
        else:
            echo "deu certo.";
        endif;
        
        $upload = new Uploads();
        $upload->formataImagem($newFile);
        if($upload->getResultados()):
            Verificacao::imagens($newFile['name']);
        endif;
        
    endif;