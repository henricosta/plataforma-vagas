# Projeto de Plataforma de Vagas
Este é um projeto desenvolvido para a disciplina de Desenvolvimento Web em HTML5, CSS, Javascript e PHP ministrada pelo professor Henrique Mota.

O projeto consiste em uma plataforma de vagas de emprego, onde os usuários podem se cadastrar e as empresas podem postar suas vagas.

### Tecnologias Utilizadas
O projeto foi desenvolvido utilizando as seguintes tecnologias:

- PHP: Linguagem de programação utilizada para o desenvolvimento do backend.
- Laravel: Framework PHP escolhido para a aplição.
- Vue.js: Framework JavaScript utilizado para o desenvolvimento do frontend.
- Inertia.js: Biblioteca JavaScript que permite criar interfaces de usuário dinâmicas utilizando componentes Vue.js no backend Laravel.
- SQLite: Banco de dados utilizado inicialmente devido à rapidez na configuração e desenvolvimento, mas futuramente pretendo utilizar o MySQL no ambiente de produção, visando escalabilidade e melhor gerenciamento de permissões.

### Funcionalidades
O projeto conta com as seguintes funcionalidades principais:

- Cadastro de Usuários: Os usuários podem se cadastrar na plataforma fornecendo informações como nome e contatos.
- Cadastro de Empresas: As empresas podem se cadastrar fornecendo informações como nome da empresa, descrição, cnpj, número de funcionários etc.
- Postagem de Vagas: As empresas cadastradas podem postar vagas de emprego com titulo, modalidade, localização, número de vagas disponíveis etc.
- Candidatura às Vagas: Os usuários cadastrados podem se candidatar às vagas disponíveis na plataforma.
- Gerenciamento de Vagas: As empresas podem gerenciar suas vagas, visualizando as candidaturas recebidas com as informações de contato dos candidatos.

### Instalação
Para executar o projeto localmente, siga as instruções abaixo:

1. Certifique-se de ter o PHP e o Composer instalados em seu sistema.

2. Clone este repositório em seu ambiente de desenvolvimento local.

3. Navegue até o diretório raiz do projeto e execute o seguinte comando para instalar as dependências:
```
composer install
```
4. Crie um arquivo .env na raiz do projeto e copie o conteúdo do arquivo .env.example para ele.

5. Gere a chave de aplicativo executando o seguinte comando:
```
php artisan key:generate
```
6. Execute as migrações do banco de dados usando o seguinte comando:
```
php artisan migrate --force
```
7. (Opcional) Execute as seeds.
```
php artisan db:seed
```
8. Inicie o servidor de desenvolvimento executando o seguinte comando:
```
php artisan serve
```
9. Abra o navegador e acesse http://localhost:8000 para visualizar a página principal.
