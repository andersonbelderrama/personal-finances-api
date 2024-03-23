# Personal Finances API

API desenvolvida para ser usada com App de Finanças Pessoais, onde o frontend é separado e desenvolvido em vuejs. O intuito dessa aplicação é me ajudar e poder ajudar outras pessoas a gerenciar vida financeira pessoal, tais como receitas e gastos.

URL Projeto Frontend: [...]



Desenvolvido por Anderson Belderrama - andersonbelderrama@gmail.com 

Site: http://andersonbelderrama.dev


## Documentação API

```bash
https://documenter.getpostman.com/view/22825389/2sA35Bb4Fq
```

## Ambiente de Desenvolvimento e QA

Criar arquivo .env e configure o apontamento de banco de dados:
```bash
cp .env.example .env
```
Instale as dependencias do composer
```bash
composer install
```

### Sem Docker

Gerar chave de segurança da aplição
```bash
php artisan key:generate
```

Gerar banco de dados
```bash
php artisan migrate
```

Gerar banco de dados com dados fake
```bash
php artisan migrate:fresh --seed
```

Desfazer banco de dados
```bash
php artisan migrate:rollback
```

Rodar Testes
```bash
php artisan test
```

Iniciar servidor de desenvolvimento e QA
```bash
php artisan serve
```

### Com Docker


Crie um alias para o seu terminal entender o comando `sail`
```bash
alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'
```

Inicia docker com banco de dados(mysql)
```bash
sail up -d
```

Finaliza ambiente docker de app e banco de dados(mysql)
```bash
sail down
```

Gerar chave de segurança da aplição
```bash
sail artisan key:generate
```

Gerar banco de dados
```bash
sail artisan migrate
```

Gerar banco de dados com dados fake
```bash
sail artisan migrate:fresh --seed
```

Rodar Testes
```bash
sail artisan test
```

Desfazer banco de dados
```bash
sail artisan migrate:rollback
```


## Ambiente de Produção

[...]
