<?php
/**
 * Modelo de dados de mensagens
 * @package RestAPI
 * @subpackage Model
 * @author Maicon Schelter <maiconschelter@gmail.com>
 */

namespace RestAPI\Model;

class ModelMensagem{

    /**
     * Código da mensagem
     * @var Integer
     */
    private $id;

    /**
     * Texto da mensagem
     * @var String
     */
    private $texto;

    /**
     * Data e hora da mensagem
     * @var Date
     */
    private $data;

    /**
     * Retorna o código da mensagem
     * @return Integer
     */
    public function getId(){
        return $this->id;
    }

    /**
     * Retorna o texto da mensagem
     * @return String
     */
    public function getTexto(){
        return $this->texto;
    }

    /**
     * Retorna a data e hora da mensagem
     * @return Date
     */
    public function getData(){
        return $this->data;
    }

    /**
     * Seta o código da mensagem
     * @param Integer $id - Código da mensagem
     */
    public function setId($id){
        $this->id = $id;
    }

    /**
     * Seta o texto da mensagem
     * @param String $texto - Texto da mensagem
     */
    public function setTexto($texto){
        $this->texto = $texto;
    }

    /**
     * Seta a data e hora da mensagem
     * @param Date $data - Data e hora da mensagem
     */
    public function setData($data){
        $this->data = $data;
    }

    /**
     * Retorna a mensagem em formato JSON
     * @return String
     */
    public function toJson(){
        $aRetorno = [
             'codigo' => $this->id
            ,'mensagem' => $this->texto
            ,'data' => $this->data
        ];
        return json_encode($aRetorno);
    }
}