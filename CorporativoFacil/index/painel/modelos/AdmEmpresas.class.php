<?php
/**
 * Description of AdmEmpresas
 *
 * @author Marcos Daniel
 */
class AdmEmpresas {
    private $id;
    private $dadosEmpresa;
    private $err;
    private $result;
    
    const tabela = 'empresas';

    public function cadastraEmpresa($dados) {
        $this->dadosEmpresa = $dados;
        if(  in_array('', $this->dadosEmpresa)  ):
            $this->erro = [ "Erro: Nenhum campo pode ficar em branco.", CORPF_LARANJADO ];
            $this->resultado = false;
        else:            
            $this->formataDados();
            if(  $this->dadosEmpresa['logotipo']  ):
                $upload = new Uploads();
                $upload->formataImagem($this->dadosEmpresa['logotipo'],  $this->dadosEmpresa['nome_empresa'],500,'logotipos');
            endif;
            
            if( isset($upload) && $upload->getResultados() ):
                $this->dadosEmpresa['logotipo'] = $upload->getResultados();
                $this->inserirEmpresa();
            else:
                $this->dadosEmpresa['logotipo'] = null;
                $this->inserirEmpresa();
                errosDoUsuarioCustomizados("O logotipo não pode ser cadastrada no Banco de Dados.", CORPF_LARANJADO);
            endif;
        endif;
    }
    public function atualizarEmpresa($id, $dados) {
        $this->id = $id;
        $this->dadosEmpresa = $dados;
        $this->formataDados();
        if( is_array($this->dadosEmpresa['logotipo']) || !empty($this->dadosEmpresa['logotipo']) ):
            $logotipo = new Ler();
            $logotipo->consultaManual("SELECT logotipo FROM ".self::tabela." WHERE id= :id", "id={$this->id}");
            $capaAntiga = 'uploads/' . $logotipo->resultado()[0]['logotipo'];
            if(  file_exists($capaAntiga)&& !is_dir($capaAntiga)  ):
                unlink($capaAntiga);
            endif;
            
            $reescreverCapa = new Uploads();
            $reescreverCapa->formataImagem($this->dadosEmpresa['logotipo'], $this->dadosEmpresa['nome_empresa'], 500, 'logotipos');
            
            if(  isset($reescreverCapa) && $reescreverCapa->getResultados()  ):
                $this->dadosEmpresa['logotipo'] = $reescreverCapa->getResultados();
                $this->edita();
                echo Verificacao::imagens($this->dadosEmpresa['logotipo'], $this->dadosEmpresa['nome_empresa'],500,250);
            else:
                unset($this->dadosEmpresa['logotipo']);
                $this->edita();
            endif;
        else:
            $this->dadosEmpresa['logotipo'] = null;
            $this->edita();
        endif;
    }
    
    public function getErr() {
        return $this->err;
    }
    public function getResult() {
        return $this->result;
    }
    
    private function formataDados() {
        $sobre = $this->dadosEmpresa['sobre_empresa'];
        $logotipo = $this->dadosEmpresa['logotipo'];
        
        unset($this->dadosEmpresa['sobre_empresa'], $this->dadosEmpresa['logotipo']);
        
        $this->dadosEmpresa['nome_empresa'] = Verificacao::tratamentoDeStrings($this->dadosEmpresa['nome_empresa']);
        $this->dadosEmpresa['ramo'] = Verificacao::tratamentoDeStrings($this->dadosEmpresa['ramo']);
        $this->dadosEmpresa['sobre_empresa'] = $sobre;
        $this->dadosEmpresa['logotipo'] = (  $logotipo ? $logotipo : 'null'  );
        $this->dadosEmpresa['site_empresa'] = Verificacao::tratamentoDeStrings($this->dadosEmpresa['site_empresa']);
        $this->dadosEmpresa['pag_facebook'] = Verificacao::tratamentoDeStrings($this->dadosEmpresa['pag_facebook']);
        $this->dadosEmpresa['endereco'] = Verificacao::tratamentoDeStrings($this->dadosEmpresa['endereco']);
        $this->dadosEmpresa['estado_UF'] = Verificacao::tratamentoDeStrings($this->dadosEmpresa['estado_UF']);
        $this->dadosEmpresa['cidade'] = Verificacao::tratamentoDeStrings($this->dadosEmpresa['cidade']);        
    }
    
    private function inserirEmpresa() {
        $insere = new Inserir();
        $insere->executarInsercao(self::tabela, $this->dadosEmpresa);
        if(  $insere->getResult()  ):
            $this->err = ["Empresa {$this->dadosEmpresa['nome_empresa']} cadastrada com sucesso!", CORPF_VERDE];
            $this->result = true;
        else:
            $this->err = ["Erro ao cadastrar empresa:", CORPF_VERMELHO];
            $this->result = false;
        endif;
    }
    
    private function edita() {
        $update = new Editar();
        $update->executarEdicao(self::tabela, $this->dadosEmpresa, "WHERE id = :id", "id={$this->id}");
        if(  $update->Resultados()  ):
            $this->err = ["Empresa {$this->dadosEmpresa['nome_empresa']} atualizada!", CORPF_VERDE];
            $this->result = true;
        else:
            $this->err = ["Erro ao atualizar empresa {$this->dadosEmpresa['nome_empresa']} . ", CORPF_VERMELHO];
            $this->result = false;
        endif;
    }
}