<?php
/**
 * Controlador de mensagens da API de serviços
 * @package RestAPI
 * @subpackage Controller
 * @author Maicon Schelter <maiconschelter@gmail.com>
 */

namespace RestAPI\Controller;

require "restapi/model/mensagem.php";

use RestAPI\Model\ModelMensagem;

class ControllerMensagem{

    /**
     * Conexão com o banco de dados
     * @var Resource
     */
    private $Connection;

    /**
     * @var \RestAPI\Model\Mensagem
     */
    private $Model;

    public function __construct(){
        $aConfig = parse_ini_file('restapi.ini');
        $sStringConn = "host={$aConfig['host']} port={$aConfig['port']} dbname={$aConfig['database']} user={$aConfig['username']} password={$aConfig['password']}";
        $this->Connection = @pg_connect($sStringConn);
    }

    public function __destruct(){
        pg_close($this->Connection);
    }

    /**
     *  Retorna o modelo de dados da mensagem
     * @return ModelMensagem
     */
    public function getModel(){
        if(!isset($this->Model)){
            $this->Model = new ModelMensagem();
        }
        return $this->Model;
    }

    /**
     * Seta o modelo de dados da mensagem
     * @param ModelMensagem $oModel - Modelo de dados da mensagem
     */
    public function setModel(ModelMensagem $oModel){
        $this->Model = $oModel;
    }

    /**
     * Retorna todas as mensagens cadastradas
     * @return ModelMensagem[]
     */
    public function getMensagens(){
        $aRetorno = [];
        $sSQL = " SELECT msgid,msgtexto,msgdata
                        FROM api.tbmensagem
                        ORDER BY msgdata DESC";
        $oQuery = pg_query($this->Connection, $sSQL);
        while($aRes = pg_fetch_assoc($oQuery)){
            $oMensagem = new ModelMensagem();
            $oMensagem->setId($aRes['msgid']);
            $oMensagem->setTexto($aRes['msgtexto']);
            $oMensagem->setData($aRes['msgdata']);
            $aRetorno[] = $oMensagem;
        }
        pg_free_result($oQuery);
        return $aRetorno;
    }

    /**
     * Retorna uma mensagem cadastrada com base em seu código
     * @param Integer $iMsgId - Código da mensagem
     * @return ModelMensagem
     */
    public function getMensagem($iMsgId){
        $sSQL = " SELECT msgid,msgtexto,msgdata
                        FROM api.tbmensagem
                        WHERE msgid = $iMsgId";
        $oQuery = pg_query($this->Connection, $sSQL);
        $aRes = pg_fetch_array($oQuery);
        $oMensagem = new ModelMensagem();
        $oMensagem->setId($aRes['msgid']);
        $oMensagem->setTexto($aRes['msgtexto']);
        $oMensagem->setData($aRes['msgdata']);
        pg_free_result($oQuery);
        return $oMensagem;
    }

    /**
     * Grava uma nova mensagem
     */
    public function doGravaMensagem(){
        $sSQL = "INSERT INTO api.tbmensagem(msgtexto) VALUES($1) RETURNING msgid,msgdata";
        $oQuery = pg_query_params($this->Connection, $sSQL, Array($this->Model->getTexto()));
        $aRes = pg_fetch_assoc($oQuery);
        $this->Model->setId($aRes['msgid']);
        $this->Model->setData($aRes['msgdata']);
    }
}