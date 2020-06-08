## Sobre E-commerce

Sistema de gerencimento de e-commerce(usuários, clientes, configuração de loja, catálogo de produtos,etc...) desenvolvido com Laravel e VueJs.

### Instalação
1 - Faça o clone do projeto
~~~
git clone https://github.com/danielsa97/ecommerce.git
~~~
Após realizar o clone do projeto execute os comandos abaixo para instalação do projeto:

2 - Instale as dependências do Laravel.
~~~
composer install
~~~

3 - Instale as dependências do Javascript(VueJs, DataTables,etc...).
~~~
npm install
~~~

4 - Crie um arquivo .env baseado no arquivo .env.example
5 - Configure as variáveis de ambiente para sua conexão com banco de dados
~~~
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce
DB_USERNAME=root
DB_PASSWORD=root
~~~
6 - Instale as Migrations e Seeders do sistema
~~~
php artisan migrate --seed
~~~
7 - Gere os arquivos compilados do sistema
~~~
npm run build
~~~
8 - Execute a aplicação
~~~
php artisan serve
~~~

Se tudo ocorreu bem, sua aplicação estara disponível para acesso.



#### Daniel de Sá, David Felipe
