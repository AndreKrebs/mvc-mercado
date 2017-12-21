# mvc-mercado

# Configurações do sistema:

## Banco de dados Postgresql 9.4:

É necessário criar o usuário, senha e base de dados conforme descrito abaixo para o sistema poder conectar.

Usuário: softexpert
Senha: 12345
Base de dados: mercado
Arquivo de dump: documents/dump_database.sql
Se desejar criar a base de dados sem dados: documents/create-database.sql

## Sistema:

Caso seja necessário alterar as configurações de conexão com o banco de dados, basta alterar o arquivo configs/Database.php.

Para desabilitar os erros no sistema, basta comentar ou alterar as linhas 2 e 3 do arquivo configs/config.php, por padrão ele vem com os alertas de erro php ativado.
