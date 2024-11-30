Introdução ao Projeto RM System
Bem-vindo ao RM System! Este projeto foi cuidadosamente estruturado para oferecer uma experiência eficiente e organizada. A estrutura do projeto é composta por quatro itens principais:

Backend: Contém as APIs e lógica de negócios.
Frontend: Responsável pela interface visual do sistema.
Pasta de Fotos: Armazena as imagens do sistema para breve visualização.
Arquivo docker-compose.yml: Configuração para contêineres Docker.
Iniciando o Projeto
Para executar o projeto, siga os passos abaixo:

1. Rodando o Docker
Certifique-se de que o Docker Desktop esteja aberto. Em seguida, execute o comando:

ATENÇÃO: foi criado apenas um docker para o sistema, favor rodar o comando abaixo estando na estrutura correta

-rm-system-backend
-rm-system-frontend
-docker-compose  <-----
-pictures
-readme.md

bash
Copiar código
docker compose up -d
Este comando inicializará os serviços necessários, incluindo o banco de dados.

2. Configurando o Backend
Navegue até a pasta do backend.
Execute o comando para instalar as dependências (caso necessário):
bash
Copiar código
npm install
Inicie o servidor backend com o comando:
bash
Copiar código
npm run dev
3. Configurando o Frontend
Navegue até a pasta do frontend.
Inicie o servidor frontend com o comando:
bash
Copiar código
php artisan serve
Acessando o Banco de Dados
Com o Docker em execução, o banco de dados estará acessível pela URL:

URL: http://localhost:8080/
Preencha os seguintes campos para conexão ao banco:

Motor de Base de Dados: MySQL
Servidor: database
Nome de Utilizador: user
Senha: password
Base de Dados: rm_system
Acessando o Sistema
Depois de configurar o backend e frontend, acesse o sistema pela rota:

OBS: O PROJETO FOI DESENVOLVIDO EM ARQUIVOS SEPARADOS, 
TENHA CAUTELA NO MOMENTO DE INICIA-LO, 
É RECOMENDADO QUE SEJÁ ABERTO EM 2 VS CODE DIFERENTES, UMA PARA CADA FRONT/BACK

URL do Sistema: http://localhost:8000/login
Na tela inicial, você poderá:

Registrar-se como novo usuário.
Após o registro, será redirecionado para a tela de login.
Faça login para acessar a Home: http://localhost:8000/home.
Observação Importante
O arquivo .env já está incluído no projeto e devidamente configurado. Não é necessário ajustar ou copiar informações do .env.example. O sistema está pronto para ser iniciado com os dados já configurados.
Com este roteiro, esperamos que você consiga configurar e explorar o RM System sem complicações. Caso encontre dificuldades, entre em contato com a equipe responsável. 😊