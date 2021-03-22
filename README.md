
# Processo seletivo de Desenvolvedor Full Stack no Paytour

## Sobre o teste

# Requisitos do Teste

Criar um formulário para envio de currículos com os seguintes campos:
Nome, e-mail, telefone, Cargo Desejado (Campo texto livre), Escolaridade (Campo select), observações, arquivo e data e hora do envio.

* O formulário deve ser validado
* Apenas o campo observações é opcional
* Não devem ser aceitos arquivos que não possuam as seguintes extensões: .doc, .docx ou .pdf
* O tamanho máximo do arquivo é de 1MB
* Coloque as validações que você achar necessário
* Use o PSR-2 como padrão de codificação
* As bibliotecas devem ser carregadas via composer
* Fique à vontade para usar qualquer framework da sua preferência (ou nenhum)
* Os dados devem ser armazenados em um banco de dados. Além das informações acima, o IP e a data e hora do envio devem ficar registrados
* Um e-mail deve ser enviado com os dados do formulário


## Sobre o Projeto 

O projeto foi criado cumprindo os requisitos descristos para o processo seletivo, onde apresenta um formulário de envio de currículos. 

O projeto foi criado utilizando as seguintes tecnologias:
- Laravel v8.x
- Vue JS
- MySQL
- PHP 7.4
- Mailtrap

É possível ter acesso um demo em http://nornweb.com

### Observações
    - Somente para efeito de teste, os arquivos enviados ficam em um repositório local e público.
   
### Iniciando o projeto

### Instalando as dependencias do projeto:

```
composer install
```

Na pasta do projeto crie um novo arquivo .env, cópia de .env.example e então gere uma nova chave para o projeto:

```
php artisan key:generate
```

```
npm install && npm run dev
```


### Configurando banco de dados:

Para configurar o banco de dados edite no arquivo ".env" as seguintes variaveis de ambiente:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco_de_dados
DB_USERNAME=nome_do_usuario_do_banco
DB_PASSWORD=senha_do_usuario_
````

## Recriando banco de dados pre-configurado:

```
php artisan migrate:fresh
```

Para iniciar o servidor php embutido utilize o seguinte comando:

`````
php artisan serve
`````

Nesse caso, para executar o projeto acesse http://127.0.0.1:8000 


### Configurando um servidor de e-mail:

Essa estapa é opcional para rodar os testes automatizados

Para configurar um servidor de e-mail de testes utilizei o Mailtrap
Você pode criar sua conta gratuitamente e preencher o .env com dados da sua caixa de entrada no [Mailtrap](https://blog.especializati.com.br/utilizando-o-mailtrapio-testes-de-envio-de-e-mail/) para Laravel. 

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=um_endereço_de_email
```

### Executando testes 

```
php artisan test
```

