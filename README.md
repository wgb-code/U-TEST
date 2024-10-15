# Desafio técnico UMENTOR

A aplicação consiste em um Dashboard de controle de clientes, onde foi realizado um CRUD simples utilizando **PHP com auxilio do Framework Codeigniter 4**. Abaixo, as instruções de uso:

- Para executar este projeto deverá possuir um ambiente PHP como **XAMPP ou Laragon**

- Criar um arquivo na raiz do projeto com o nome `.env` e alimenta-lo (colar dentro do mesmo) as informações do arquivo `.env.example`

- O SGDB utilizado nesta aplicação foi desenvolvido em **MySQL** por constar no requisito técnico da vaga.

- O Codeigniter por sua vez possui sistemas de **Seeders e Migrations** o que facilita o cambio de SGDBS, porém, ao contrário do Laravel, para rodarmos as Migrations e Seeders pela primeira vez é necessário possuir o Banco de Dados criado, abaixo o SQL necessário para criar este banco.

```
CREATE DATABASE dashboard COLLATE 'utf8mb4_unicode_ci';
```

Após criar o Banco, deverá ser executado o comando de migrate para criação da tabela **Customers**:

```
php spark migrate
```

Para alimentar a tabela **Customers** com alguns usuários inicias, deixei preparado uma **Seed** que ao ser executada irá adicionar quatro usuários iniciais na tabela.

`A execução dessa Seed é opicional, visto que não fará diferença caso não seja executada, a única finalidade dela é iniciar a aplicação com alguns registros na tabela.`

Caso seja do seu interesse, basta executar o comando no seu terminal:

```
php spark db:seed Customers
```

**Com todos os passos acima, a aplicação estará disponivel para ser utilizada e testada :D**

# Tomadas de Decisões

Assim como a grande maioria dos frameworks PHP existentes no mercado `(Symfony, Laravel, Slim)` o CodeIgniter segue a risca os mandamentos do `The Twelve-Factor App` e possui também diversas funcionalidades já conhecidas como `ORM, Ambientes da Aplicação`.

Eu optei em usar apenas o poder das Migrations e Seeders pois acredito que a finalidade deste teste é avaliar meu conhecimento na linguagem PHP e não em seus Frameworks, para isto, estarei escrevendo minhas models com SQL puro, ou seja, `SEM O USO DE ORM's` e como mencionei anteriromente, estarei utilizando o minimo do Framework que eu conseguir, para focar em um desenvolvimento limpo com PHP.

## Por que não PHP Vanilla?

Dado todo o contexto acima, eu poderia ter optado em fazer com PHP puro ao invés de usar um framework, mas optei em adiantar todo o processo de `Autoload, configurações de ambientes e conexões com o banco de dados` usando o CodeIgniter.

Desde já, não teria problema nenhum em desenvolver com PHP puro e poderia também optar pelo Laravel ou até mesmo Slim como o framework da aplicação, mas dado a demanda do projeto, CodeIgniter pareceu fazer mais sentido para mim.

