<?php
/**
 * Description of AdmGalerias
 * Irá administrar(atualização de dados, inserção, e remoção) 
 * @author Marcos Daniel [ atualizada  pela última vez em 19 / 12 / 2020  ]
 */
class AdmPublicacoes {
    private $id;
    private $dados;
    private $id_autor;
    private $erro;
    private $resultado;
    private $qtdGaleria;
    
    const tabelaBanco = 'publicacao';
    
    public function executaCadastro(array $dados) {
        $this->dados = $dados;
        $this->id_autor = $this->dados['id_autor'];
        if(  in_array('', $this->dados)  ):
            $this->erro = ["Nenhum campo pode ficar em branco!", CORPF_LARANJADO];
            $this->resultado = false;
        else:
            $this->formatacaoDeDados();
            $this->formataNomes();
        
            if( $this->dados['imagem'] ):
                $upload = new Uploads();
                $upload->formataImagem($this->dados['imagem'], $this->dados['descricao']);
            endif;
            
            if(  isset($upload) && $upload->getResultados()  ):
                $this->dados['imagem'] = $upload->getResultados();
                $this->cadastrarPublicacaoCategoria();
            else:
                $this->dados['imagem'] = null;
                $this->cadastrarPublicacaoCategoria();
                errosDoUsuarioCustomizados("A imagem não pode ser cadastrada no Banco de Dados.", CORPF_LARANJADO);
            endif;
        endif;
    }
    public function executaEdicao(array $dados, $id) {
        $this->dados = $dados;
        $this->id = (int) $id;
        
        if(in_array('', $this->dados)):
            $this->erro = ["Para editar <b>*{$this->dados['descricao']}*</b>, nenhum campo pode ficar em branco.", CORPF_LARANJADO];
            $this->resultado = false;
        else:
            $this->formatacaoDeDados();
            $this->formataNomes();            
            if(  is_array($this->dados['imagem']) && isset($this->dados['imagem'])  ):
                $pegarCapaExistente = new Ler();
                $pegarCapaExistente->executarLeitura(self::tabelaBanco, "WHERE id = :id", "id={$this->id}");
                $capa = 'uploads/' . $pegarCapaExistente->resultado()[0]['imagem'];
                if(file_exists($capa) && !is_dir($capa)):
                    unlink($capa);
                endif;
                
                $reescreverCapa = new Uploads();
                $reescreverCapa->formataImagem($this->dados['imagem'],  $this->dados['descricao']);
                if(  isset($reescreverCapa) && $reescreverCapa->getResultados()[0]  ):
                    $this->dados['imagem'] = $reescreverCapa->getResultados();
                    $this->editarPublicacao();
                    echo Verificacao::imagens($this->dados['imagem'], $this->dados['descricao'], 500, 250);
                endif;
            else:
                unset($this->dados['imagem']);
                $this->editarPublicacao();
                errosDoUsuarioCustomizados("Capa não atualizada. Capa anterior mantida!", E_USER_WARNING);
            endif;
        endif;
    }
    public function enviarGaleria(array $imagens, $idPost) {
        $this->dados = $imagens;
        $this->id = (int) $idPost;
        
        $imagem = new Ler();
        $imagem->executarLeitura(self::tabelaBanco, "WHERE id = :id", "id={$this->id}");
        if(  !$imagem->resultado()  ):
            $this->erro = ["Erro ao enviar galeria: índice {$this->id} não encontrado.", CORPF_VERMELHO];
            $this->resultado = false;
        elseif($imagem->resultado()):
            echo "Segundo bloco: entrou aqui!";
            $image = $imagem->resultado()[0]['descricao'];
            
            $todasAsImagensGaleria = array();
            $qtdImagensGaleria = count($this->dados['tmp_name']);
            $indicesDasImagens = array_keys($this->dados);
            
            for($contador = 0; $contador < $qtdImagensGaleria; $contador++):
                foreach($indicesDasImagens AS $indices):
                    $todasAsImagensGaleria[$contador][$indices] = $this->dados[$indices][$contador];
                endforeach;
            endfor;
            
            $subirGaleria = new Uploads();
            $i = 0;
            $quantasForamEnviadas = 0;
            
            foreach($todasAsImagensGaleria AS $enviadas):
                $i++;
                $nomeImagemFormatado = "{$image}-gb-{$this->id}-" . (substr(md5(time() + $i), 0, 5));
                $subirGaleria->formataImagem($enviadas, $nomeImagemFormatado);
                if($subirGaleria->getResultados()):
                    $nomeImagemGaleria = $subirGaleria->getResultados();
                    $galeria = ['nome_imagem' => $nomeImagemGaleria,
                                'id_publicacao' => $this->id,
                                'data_galeria' => date('Y-m-d H:i:s') ];
                    
                    $insereGaleria = new Inserir();
                    $insereGaleria->executarInsercao('galerias', $galeria);
                    $quantasForamEnviadas++;
                endif;
            endforeach;
            
            if($quantasForamEnviadas >= 1):
                $this->erro = ["Galeria atualizada: foram enviadas {$quantasForamEnviadas} nessa publicação.", CORPF_VERDE];
                $this->resultado = true;
                $this->qtdGaleria = $qtdImagensGaleria;
            endif;
        else:
            echo "entrou nesse bloco e deu certo!";
            $descricao = $this->dados['name'];
            $todasAsImagensGaleria = array();
            $qtdImagensGaleria = count($this->dados['tmp_name']);
            $indicesDasImagens = array_keys($this->dados);
            
            for($contador = 0; $contador < $qtdImagensGaleria; $contador++):
                foreach($indicesDasImagens AS $indices):
                    $todasAsImagensGaleria[$contador][$indices] = $this->dados[$indices][$contador];
                endforeach;
            endfor;
            
            $subirGaleria = new Uploads();
            $i = 0;
            $quantasForamEnviadas = 0;
            
            foreach($todasAsImagensGaleria AS $enviadas):
                $i++;
                $nomeImagemFormatado = "{$descricao}-gb-{$this->id}-" . (substr(md5(time() + $i), 0, 5));
                $subirGaleria->formataImagem($enviadas, $nomeImagemFormatado);
                if($subirGaleria->getResultados()):
                    $nomeImagemGaleria = $subirGaleria->getResultados();
                    $galeria = ['nome_imagem' => $nomeImagemGaleria,
                                'id_publicacao' => $this->id,
                                'data_galeria' => date('Y-m-d H:i:s') ];
                    
                    $insereGaleria = new Inserir();
                    $insereGaleria->executarInsercao('galerias', $galeria);
                    $quantasForamEnviadas++;
                endif;
            endforeach;
            
            if($quantasForamEnviadas >= 1):
                $this->erro = ["Galeria atualizada: foram enviadas {$quantasForamEnviadas} nessa publicação.", CORPF_VERDE];
                $this->resultado = true;
                $this->qtdGaleria = $qtdImagensGaleria;
            endif;
        endif;
    }
    
    /*public function editarGaleria(array $capa, array $galeria, $postId) {
        $this->dados['imagem'] = $capa;
        $this->dados['fotos'] = $galeria;
        $this->id = $postId;
        
        $lerGaleria = new Ler();
        $lerGaleria->consultaManual("SELECT g.nome_imagem AS galeria, 
                    p.imagem AS capa, g.id AS id_galeria, 
                    p.id AS post_id FROM galerias g 
                    LEFT JOIN publicacao p ON g.id_publicacao = p.id 
                    WHERE post_id = {$this->id}");
            $novaCapa = $lerGaleria->resultado()[0]['capa'];
            $novaGaleria = $lerGaleria->resultado()[0]['galeria'];
            var_dump($novaCapa,$novaGaleria);
    }*/
    public function atualizarGaleria($idGaleria) {
        $this->id = (int) $idGaleria;
        $lerIdGaleria = new Ler();
        $lerIdGaleria->executarLeitura('galerias', "WHERE id = :id_publicacao", "id_publicacao={$this->id}");
        
        if($lerIdGaleria->resultado()):
            $imagem = '../uploads/'.$lerIdGaleria->resultado()[0]['nome_imagem'];
            if(file_exists($imagem) && !is_dir($imagem)):
                unlink($imagem);
            endif;
            
            $deleta = new Excluir();
            $deleta->exclusao('galerias', "WHERE id = :gallery_id", "gallery_id={$this->id}");
            if($deleta->getResultado()):
                $this->erro = ["imagem excluída da galeria!", CORPF_VERDE];
                $this->resultado = true;
            endif;
        else:
            errosDoUsuarioCustomizados("Galeria não cadastrada ou apagada.", CORPF_AMARELO);
        endif;
    }

    public function getErro() {
        return $this->erro;
    }
    public function getResult() {
        return $this->resultado;
    }
    public function getQtdGaleria() {
        return $this->qtdGaleria;
    }
    public function registrarDataOriginal() {
        $pegarDataOriginal = new Ler();
        $pegarDataOriginal->consultaManual("SELECT data_da_publicacao FROM publicacao WHERE id = :id", "id={$this->id}");
        if($pegarDataOriginal->resultado()):
            $this->dados['data_da_publicacao'] = $pegarDataOriginal->resultado()[0]['data_da_publicacao'];
            $insereData = new Inserir();
            $insereData->executarInsercao("datas", $this->dados['data_da_publicacao']);
            if($insereData->getResult()):
                errosDoUsuarioCustomizados("A data original foi guardada", CORPF_VERDE);
            else:
                errosDoUsuarioCustomizados("Erro ao guardar a data", CORPF_LARANJADO);
            endif;
        endif;
    }
    
        //AQUI PREVINE INSERÇÃO DE CÓDIGOS HTML;
    private function formatacaoDeDados() {
        $imagem = $this->dados['imagem'];
        $conteudo = $this->dados['conteudo'];
        unset($this->dados['imagem'], $this->dados['conteudo']);
        $this->dados = array_map('strip_tags', $this->dados);
        $this->dados = array_map('trim', $this->dados);
        
        $this->dados['data_da_publicacao'] = Verificacao::datas($this->dados['data_da_publicacao']);
        $this->dados['descricao'] = Verificacao::tratamentoDeStrings($this->dados['descricao']);
        //$this->dados['nome_post'] = Verificacao::tratamentoDeStrings($this->dados['descricao']);
        $this->dados['imagem'] = ( $imagem ? $imagem : 'null' );
        $this->dados['tipo'] = 'post';
        $this->dados['conteudo'] = $conteudo;
        $this->dados['id_categoria'] = ( $this->dados['id_categoria'] == 'null' ? null : $this->dados['id_categoria']);
        $this->dados['id_autor'] = (   $this->dados['id_autor'] == 'null' ? null : $this->dados['id_autor']   );
    }
    /**
        método que verifica se uma categoria já existe no banco. Se sim, o método reescreve o nome da mesma.
    private function verificaCategoriaExistente() {
        $where = ( !empty($this->dados['id_categoria']) ? "ca.id = {$this->dados['id_categoria']} AND" : "");
        
        $lerCategoriaExistente = new Ler();
        $lerCategoriaExistente->executarLeitura('publicacao p', "LEFT JOIN categorias ca ON ca.id = p.id_categoria "
                . "WHERE {$where} id_categoria = :categoria", "categoria={$this->dados['id_categoria']}");
        if($lerCategoriaExistente->resultado()):
            errosDoUsuarioCustomizados("Essa categoria já existe no banco!", CORPF_LARANJADO);
            return false;
        else:
            //errosDoUsuarioCustomizados("Categoria cadastrada!", CORPF_VERDE);
            echo "A consulta no Banco de Dados está errada!";
            return true;
        endif;
    }
    */
    
    private function formataNomes() {
        $where = (  isset($this->id) ? "id != {$this->id} AND" : "");
        $leitura = new Ler();
        $leitura->executarLeitura(self::tabelaBanco, "WHERE {$where} descricao = :d", "d={$this->dados['descricao']}");
        if($leitura->resultado()):
            $this->dados['descricao'] = $this->dados['descricao'] . "-" . $leitura->getRowCount();
        endif;
    }
    private function cadastrarPublicacaoCategoria() {
        $insere = new Inserir();
        $insere->executarInsercao(self::tabelaBanco, $this->dados);
        if($insere->getResult()):
            $this->erro = ["A publicação <b>*{$this->dados['descricao']}*</b> foi cadastrada no sistema", CORPF_VERDE];
            $this->resultado = $insere->getResult();
        endif;
    }
    private function editarPublicacao() {
        $editar = new Editar();
        $editar->executarEdicao(self::tabelaBanco, $this->dados, "WHERE id = :id", "id={$this->id}");
        if($editar->Resultados()):
            $this->resultado = true;
            $this->erro = ["Publicação <b>*{$this->dados['descricao']}*</b> editada com sucesso.", CORPF_VERDE];
            //$this->registrarDataOriginal($this->dados['data_da_publicacao']);
        else:
            $this->resultado = false;
            $this->erro = ["erro", CORPF_AMARELO];
        endif;
    }
}