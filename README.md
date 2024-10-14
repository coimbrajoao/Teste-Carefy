O código acima foi desenvolvido para atender ao teste solicitado pela empresa Carefy, que consistia na criação de um sistema capaz de importar, armazenar e exibir arquivos CSV.

Para executar o aplicativo localmente, siga os passos abaixo:

1. Após clonar o repositório, no terminal, execute o comando `composer dumpautoload` para carregar as informações do Composer. É importante que o Composer já esteja previamente instalado na sua máquina.
2. Em seguida, execute o arquivo `Criar-banco`, configurando previamente os parâmetros de conexão com o banco de dados, vale ressaltar que o arquivo cria o banco carefyteste e a tabela censo.
3. Após executar o comando de criar o banco, será possivel executar a aplicação para isso basta executar o comando via terminal php -S localhost:8000 -t public, para assim acessar e realziar os testes devidos na aplicação.

Desde já agradeço pela oportunidade, e fico aberto a sugestões.
