# 🎊EVENTOS 

TICKETMAIS é um sistema web para compra de ingressos para eventos, desenvolvido em PHP com backend em MongoDB. Possui autenticação de usuários (administradores e clientes), gestão de eventos, compra e visualização de ingressos.

---

## 📌Tecnologias Utilizadas

- PHP 7+ (orientação a objetos e sessões)
- MongoDB (NoSQL para armazenamento de eventos, usuários e ingressos)
- Composer (para gerenciamento da biblioteca MongoDB PHP Driver)
- Bootstrap 4 (para interface responsiva e estilização)
- JavaScript (bibliotecas JQuery e Popper para funcionalidade do Bootstrap)



## 📌Funcionalidades

### Usuários
- **Administrador (adm)**: Pode criar, editar e excluir eventos. Visualiza seus eventos cadastrados.
- **Cliente**: Pode visualizar eventos e comprar ingressos. Visualiza os ingressos comprados.

### Eventos
- CRUD completo para eventos (Create, Read, Update, Delete).
- Cada evento possui tema, descrição, data, promotor, localização, vagas totais e imagem.

### Ingressos
- Compra de ingressos vinculada a usuário e evento.
- Visualização dos ingressos comprados pelo cliente.

### Autenticação e Controle de Sessão
- Login e logout.
- Proteção das páginas para usuários logados.
- Controle de acesso baseado no tipo de usuário.

---

## 📌Configuração e Instalação

### Pré-requisitos

- PHP 7.4+ com extensões MongoDB instaladas
- Servidor web (ex: Apache, Nginx)
- MongoDB instalado e em execução localmente
- Composer instalado para gerenciar dependências PHP


### 📌Uso

Acesse a página de login (login.php) para entrar no sistema.

Usuários administradores podem criar, editar e excluir eventos.

Usuários clientes podem comprar ingressos e visualizar seus ingressos.



### 📌Passo a passo de como utilizar:

```bash
- Crie uma pasta no seguinte caminho: C:\xampp\htdocs;

- Abra o CDM da sua máquina e faça os seguintes comandos: cd .. -> cd .. (Até chegar a C: \) -> cd xampp -> cd htdocs -> git clone https://github.com/melissabvieira/Eventos.git;

- composer install -> Verifique se vieram no git clone;

- Configure o MongoDB para rodar localmente (padrão mongodb://localhost:27017);

- Crie o banco de dados eventos no mongoDB;

- Obrigatório: Insira usuários iniciais (administrador e cliente) no MongoDB para testes -> basta rodar no terminal 'php usuarios.php'

- Configure seu servidor web para apontar para a pasta do projeto, abrindo o XAMPP e ligando o APACHE;

- Abra sua aba no google e pesquise "localhost/Eventos-main".




