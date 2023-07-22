<?php
/**
 * Description of AdmGalerias
 * Irá administrar(atualização de dados, inserção, e remoção) 
 * @author Marcos Daniel
 */
class AdmCategorias {
    private $id;
    private $dados;
    private $erro;
    private $resultado;    
    
    const tabelaBanco = 'categorias';
    
    public function execucao(array $dados) {
        $this->dados = $dados;
        
        if(in_array('', $this->dados)):
            $this->resultado = false;
            $this->erro = ["Nenhum campo pode ficar em branco!", CORPF_LARANJADO];
        else:
            $this->formatacaoDeDados();
            $this->verificaCategoriaExistente();
            $this->cadastrarCategoria();
        endif;
    }
    public function executarEdicao($id , array $dados) {
        $this->dados = $dados;
        $this->id = (int) $id;
        
        if(in_array('', $this->dados)):
            $this->resultado = false;
            $this->erro = ["Para atualizar a categoria <b>{$this->dados['titulo']}</b> nenhum campo pode ficar em branco!", CORPF_LARANJADO];
        else:
            $this->formatacaoDeDados();
            $this->verificaCategoriaExistente();
            $this->editarCategoria();
        endif;
    }
    
    public function getErro() {
        return $this->erro;
    }
    public function getResult() {
        return $this->resultado;
    }
    
    
    //AQUI PREVINE INSERÇÃO DE CÓDIGOS HTML;
    private function formatacaoDeDados() {
        $this->dados = array_map('strip_tags', $this->dados);
        $this->dados = array_map('trim', $this->dados);
        /*Aqui vão as 
        colunas do Banco:
           $variavel['coluna_banco'] = recebe os campos do formulário já 
                formatados pelos métodos que formatam datas e strings.  */ 
        
        //      colunas do banco  =     campos do formulário.
        $this->dados['titulo'] = $this->dados['titulo'];
        $this->dados['data_categoria'] = Verificacao::datas($this->dados['data_categoria']);
    }
    /** 
        método que verifica se uma categoria já existe no banco. Se sim, o método reescreve o nome da mesma.
    */
    private function verificaCategoriaExistente() {
        /*Aqui, estou vendo se já existe um id nesse formulário. Se sim, quer dizer que estou EDITANDO um registro.
        Se não, não passo nenhum id e prossigo com o cadastro.  */
        $where = ( !empty($this->id) ? "id != {$this->id} AND" : '');
        /*      SE ID == VAZIO,  ENTÃO ->  SELECT * FROM tabela WHERE titulo = :titulo;
                SE ID EXISTE, ENTÃO   ->   SELECT * FROM tabela WHERE id != id_informado AND titulo = :titulo;
                    Importante:  quando o id existe, o método faz UPDATE do registro. Faz update no campo *título*.
        */
        $lerCategoriaExistente = new Ler();
        $lerCategoriaExistente->executarLeitura('categorias', "WHERE {$where} titulo = :t", "t={$this->dados['titulo']}");
        if($lerCategoriaExistente->resultado()):
            $this->dados['titulo'] = $this->dados['titulo'] . '-' . $lerCategoriaExistente->getRowCount();
        endif;
    }
    private function cadastrarCategoria() {
        $insere = new Inserir();
        $insere->executarInsercao(self::tabelaBanco, $this->dados);
        if($insere->tuplasInseridas()):
            $this->resultado = $insere->getResult();
            $this->erro = ["<small style=font-family: '\"Ubuntu\",sans-serif'>A categoria<b> {$this->dados['titulo']}</b> foi cadastrada no sistema</small>!", CORPF_VERDE];
        endif;
    }
    private function editarCategoria() {
        $edita = new Editar();
        $edita->executarEdicao(self::tabelaBanco, $this->dados, "WHERE id = :id", "id={$this->id}");
        if($edita->Resultados()):
            $this->resultado = true;
            $this->erro = ["Categoria <b>{$this->dados['titulo']}</b> atualizada com sucesso!", CORPF_VERDE];
        endif;
    }
}