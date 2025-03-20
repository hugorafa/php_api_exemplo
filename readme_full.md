API RESTful Simples em PHP com Rotas

Esta API permite criar, visualizar, atualizar e deletar usuários usando requisições HTTP com rotas amigáveis.

Endpoints e Métodos

Criar usuário

POST /users

Exemplo de corpo da requisição (JSON):

Resposta:

Listar todos os usuários

GET /users

Resposta:

Obter usuário por ID

GET /users/{id}

Exemplo:

/users/65a3d9f1e

Resposta:

Atualizar usuário

PUT /users/{id}

Exemplo de corpo da requisição:

Resposta:

Deletar usuário

DELETE /users/{id}

Resposta:

Testando com Postman

Abra o Postman.

Crie uma nova requisição e defina o método adequado (GET, POST, PUT, DELETE).

Insira a URL correspondente ao endpoint desejado, por exemplo:

http://seu-servidor/users

http://seu-servidor/users/{id}

Para requisições POST e PUT, vá para a aba Body, selecione raw, escolha JSON e insira os dados conforme os exemplos acima.

Clique em Send e veja a resposta no painel inferior.

Essa API é uma implementação simples sem autenticação ou banco de dados real, ideal para aprendizado sobre consumo de APIs RESTful.
