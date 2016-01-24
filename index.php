<?php
/**
 * Serviço de API tipo REST para mensagens
 * @package RestAPI
 * @subpackage Index
 * @author Maicon Schelter <maiconschelter@gmail.com>
 */

require "vendor/autoload.php";
require "restapi/controller/mensagem.php";

use RestAPI\Controller\ControllerMensagem;

//instância e cabeçalho padrão do serviço
$oRestApp = new \Slim\Slim();
$oRestApp->response->header('Content-Type', 'application/json;charset=utf-8');

//endereço padrão do serviço
$oRestApp->get('/', function(){
    echo json_encode('Rest API Messages v1.0.0.');
});

//lista de mensagens
$oRestApp->get('/mensagens', function(){
    $oController = new ControllerMensagem();
    $aMensagens = $oController->getMensagens();
    $aRetorno = [];
    foreach ($aMensagens as $oMensagem) {
         $aRetorno[] = $oMensagem->toJson();
    }
    echo '{"mensagens":[' . implode(',', $aRetorno) . ']}';
});

//busca de mensagem por código
$oRestApp->get('/mensagem/:id', function($id){
    $oController = new ControllerMensagem();
    $oMensagem = $oController->getMensagem($id);
    echo '{"mensagens":[' . $oMensagem->toJson() . ']}';
});

//inserção de nova mensagem
$oRestApp->post('/mensagem', function(){
    $oRequest = \Slim\Slim::getInstance()->request();
    $oDados = json_decode($oRequest->getBody());
    $oController = new ControllerMensagem();
    $oController->getModel()->setTexto($oDados->texto);
    $oController->doGravaMensagem();
    echo '{"mensagens":[' . $oController->getModel()->toJson() . ']}';
});

//inicia o serviço
$oRestApp->run();