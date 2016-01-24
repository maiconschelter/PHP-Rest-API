# PHP-Rest-API

-----------------------------------------------------------------------------------------------------------------------

Configuração do Serviço:

1. Descompactar arquivos.
2. Criar base de dados em PostgreSQL, conforme arquivo "database.sql".
3. Configurar o arquivo "restapi.ini" para conexão com o banco de dados.
4. Configurar servidor Apache para permitir utilizar o arquivo ".htaccess".

-----------------------------------------------------------------------------------------------------------------------

Utilização do Serviço:

Para todos os métodos, utilizar o cabeçalho padrão "Content-Type: application/json".

1. Índice do serviço - GET http://localhost/PHP/Rest/.
2. Lista todas as mensagens: GET http://localhost/PHP/Rest/mensagens.
3. Listar mensagem específica: GET http://localhost/PHP/Rest/mensagem/7.
4. Cadastrar nova mensagem: POST http://localhost/PHP/Rest/mensagem RAW {"texto":"Aqui vai o texto da mensagem..."}.

