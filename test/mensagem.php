<?php
/**
 * Testes para a API de Rest
 * @package Test
 * @subpackage Mensagem
 * @author Maicon Schelter <maiconschelter@gmail.com>
 */

//página inicial do serviço
$oCurl = curl_init('http://localhost/PHP/Rest/');
curl_setopt($oCurl, CURLOPT_HEADER, Array('Content-type: application/json'));
$oRetorno = json_encode(curl_exec($oCurl));
curl_close($oCurl);
var_dump($oRetorno);

//listar todos as mensagens
$oCurl = curl_init('http://localhost/PHP/Rest/mensagens');
curl_setopt($oCurl, CURLOPT_HEADER, Array('Content-type: application/json'));
$oRetorno = json_encode(curl_exec($oCurl));
curl_close($oCurl);
var_dump($oRetorno);

//listar uma mensagem específica
$oCurl = curl_init('http://localhost/PHP/Rest/mensagem/7');
curl_setopt($oCurl, CURLOPT_HEADER, Array('Content-type: application/json'));
$oRetorno = json_encode(curl_exec($oCurl));
curl_close($oCurl);
var_dump($oRetorno);

//inserir uma nova mensagem
$oCurl = curl_init('http://localhost/PHP/Rest/mensagem');
curl_setopt($oCurl, CURLOPT_POST, true);
curl_setopt($oCurl, CURLOPT_POSTFIELDS, '{"texto":"Uma nova mensagem aqui..."}');
curl_setopt($oCurl, CURLOPT_HEADER, Array('Content-type: application/json'));
$oRetorno = json_encode(curl_exec($oCurl));
curl_close($oCurl);
var_dump($oRetorno);