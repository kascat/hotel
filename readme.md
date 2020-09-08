# Projeto final
## Matéria: Tecnologias de Desenvolvimento Back-end (PHP)
### Passos

- Rodar: `composer install`
- Renomear arquivo .env.example para .env
- Criar banco local e setar os dados no .env
- Rodar: `php artisan key:generate`
- Rodar: `php artisan migrate`

Para criar usuário master/gerente:

- Rodar: `php artisan create-user`

O comando acima irá criar um usuário master/gerente com as seguintes credenciais:

- email: `gerente@mail.com`
- password: `123456`

Os demais usuários (Clientes) podem se auto cadastrar pelo sistema

Para rodar o sistema:

- `php artisan serve`
