# SAOE
## Sistema de administração e organização de eventos acadêmicos Open Source
Já imaginou poder controlar seus eventos de forma simples, rápida, gratuita e com total controle? Esse é o objetivo do projeto SAOE, com um design simples e direto esse sistema busca te auxiliar no controle dos artigos que são enviados ao seu evento.

## Wikis
Possuimos informações adicionais nas wikis do projeto, fique a vontade para conferir.

## Contribuir
Quer contribuir com o projeto? Manda um pull request!

## Pré-requisitos
O sistema atualmente funciona totalmente online sendo escrito em PHP e utilizando um banco de dados MySQL.
- Servidor PHP >= 5.6v com suporte a .htaccess
- Banco de dados MySQL (O sistema na teoria suporta outros tipos de bancos de dados, mas ainda não testamos essa possibilidade)

## Instalação
Atualmente a instalação é bem mais complexa do que gostariamos e futuramente será apenas um arquivo simples onde você deverá apenas seguir o que está sendo pedido e tudo irá se organizar automaticamente.
Porém no momento está funcionando desse modo:

### Antes de começar
Antes de iniciar a instalação você deverá criar um banco de dados específico para a aplicação.
E dentro desse banco rode o seguinte código:

```sql
SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `trabalhos`;
CREATE TABLE `trabalhos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `autor` varchar(45) DEFAULT NULL,
  `autorid` varchar(45) DEFAULT NULL,
  `enviadoem` varchar(45) DEFAULT NULL,
  `titulo` varchar(45) DEFAULT NULL,
  `descricao` varchar(120) DEFAULT NULL,
  `avaliado` int(11) DEFAULT NULL,
  `nota` int(11) DEFAULT NULL,
  `comentarios` text,
  `area` varchar(45) DEFAULT NULL,
  `avaliador` varchar(45) DEFAULT NULL,
  `avaliadorid` varchar(45) DEFAULT NULL,
  `avaliadoem` varchar(45) DEFAULT NULL,
  `arquivo` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `sobrenome` varchar(255) DEFAULT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  `lattes` varchar(255) DEFAULT NULL,
  `rg` varchar(45) DEFAULT NULL,
  `cpf` varchar(45) DEFAULT NULL,
  `nascimento` varchar(45) DEFAULT NULL,
  `rua` varchar(45) DEFAULT NULL,
  `bairro` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `cep` varchar(45) DEFAULT NULL,
  `img` varchar(45) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `ativo` varchar(45) DEFAULT NULL,
  `complemento` varchar(45) DEFAULT NULL,
  `perfil` varchar(45) DEFAULT NULL,
  `trabalhos` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```
## Após isto...
Após realizar a configuração do banco de dados, faça o seguinte:
1. Baixe o repositório compactado e descompacte na pasta de destino, no seu servidor. 
2. Altere o arquivo configuration/conexao.json adicionando as informações referentes ao banco de dados criado.
3. Altere o arquivo configuration/saoe.json alterando o campo 'public' para o URL em que seu código será mostrado (no caso, apenas os valores que vem após o domínio do seu site).
4. Se quiser, na mesma pasta da alteração anterior modifique o 'name' para o nome do seu evento.
5. Se registre como organizador e no banco de dados altere o campo 'ativo' do seu usuário para 1.
6. Desfrute das funções disponíveis.

Em breve isso tudo estará automatizado...
Obrigado por ler.
