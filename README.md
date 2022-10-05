<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

rode o comando:
composer install

Configurar a conexão com o banco de dados mysql:
DB_DATABASE=nomeDobanco
DB_USERNAME=seuUser
DB_PASSWORD=suaSenha.

Rodar o comando para criar as tabelas no banco:
php artisan migrate

Rodar o comando para criar a tabela de jobs:
php artisan queue:table

Considerando que você saiba docker e que você fez toda a configuração bonitinha do arquivo docker-compose.yml, rode o comando para criar um container do redis:
docker run --name redis -p 6379:6379 -d redis

suba o servidor com comando:
php artisan serve

Abra um outro terminal para a fila de jobs processar e digite:
php artisan queue:work

acesse a rota:
http://localhost:8000/agendar

envie um objeto do tipo para a rota acima:
{
    "nome": "Fabrício teste",
    "email": "teste@gmail.com",
    "assunto": "Envio teste",
    "corpo_email": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo quas cupiditate accusantium vitae facilis cumque, vel ab. Fuga odio natus nemo mollitia perspiciatis minus fugit.",
    "agendar": "2022-10-05 00:32:57"
}

caso vc deixe em branco o campo agendar ("agendar": ""), o email cairá na fila e será disparado, caso contrário o scheduling irá monitorar a tabela de 1 em um minuto e irá verificar se o campo enviado é true ou false, se for false e se  campo "agendar" for menor ou igual a data de agora (now()), pegue esse registro e envie para a fila de processamento para este email ser disparado.

A fila irá tentar disparar cada email 3x se necessário.

agora rode o próximo comando que é o agendador (scheduling):
php artisan schedule:run

se tudo der certo, vc irá ver os jobs sendo processados (done) no terminal onde vc tem a fila

mas para que o cron rode o nosso command que monitora a tabela "agendas" de um em um minuto, faça os seguintes passos

edite o arquivo crontab que fica dentro de /etc usando o vim:
vim /etc/crontab

fique atento a identação do arquivo e escreva isso nele:
* * * * * root cd /shared/httpd/artisan && php artisan schedule:run >> /dev/null 2>&1

agora starte a cron com o comando (em um outro terminal):
service cron start

agora use o comando para verificar se de fato a cron está rodando:
service cron status

e acho que isso é tudo!

Bônus para quem usa windows e está com problemas de usar o docker:
instale o redis versão 3.0.5

reinicie a máquina

no terminal, digite:
redis-cli

agora digite:
ping
você receberá uma resposta "PONG"

na raiz do projeto laravel, rode o comando para instalar o predis:
composer require predis/predis=v1.1.7

agora, vá em .env e crie a constante:
REDIS_CLIENT=predis

vou ficar devendo como que faz um cron no ruindos (windows).
mas ao rodar apenas o comando:
php artisan schedule:run

Tu verás que os email serão disparados, mas infelizmente será de forma manual : (



