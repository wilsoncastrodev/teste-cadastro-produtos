# Desafio Promobit
- Criação de CRUD de produtos, tags e extração de relatório de relevância de produtos.

## Demonstração Online
- Link para demonstração do teste online: https://test.wilsoncastro.dev

## Instalação e Configuração do Projeto
- Clone este repositório Git
- Execute o comando `cd teste-cadastro-produtos`
- Execute `composer install`
- Renomeei ou copie o arquivo `.env.example` para `.env`
- Execute `php artisan key:generate`
- Crie no Mysql um banco de dados chamado `teste_cadastro_produtos` ou o nome que preferir.
- Defina suas credenciais de banco de dados no arquivo `.env`

Exemplo:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=teste_cadastro_produtos
DB_USERNAME=root
DB_PASSWORD=
```

- Execute as migrações da tabela com `php artisan migrate`
- Execute o comando `php artisan db:seed` para popular a tabela User
- Execute `npm install`
- Execute `npm run dev`
- Execute `php artisan serve`
- Abra o navegador e execute a url `http://localhost:8000`

### SQL de extração de relatório de relevancia de produtos:
- Foi utilizado o Eloquent do Laravel para fazer a consulta no banco de dados, 
o trecho de código usado foi o seguinte:
```
Tag::select('name')->withCount('products')->orderByDesc('products_count')->get();
```
- Este trecho de código é equivalente ao seguinte comando SQL:

```
SELECT t.name,
       Count(pt.product_id) AS products_count
FROM   tag t
       LEFT JOIN product_tag pt
              ON t.id = pt.tag_id
GROUP  BY t.name
ORDER  BY products_count DESC
```

### Contato
- Qualquer dúvida estou a sua disposição no e-mail [contato@wilsoncastro.dev](mailto:contato@wilsoncastro.dev)

# Obrigado
