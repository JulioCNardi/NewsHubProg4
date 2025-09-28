# 📰 NewsHub - Portal de Notícias

## Links:

- Projeto-deploy: https://cheerful-reverence-dev.up.railway.app/
- Link video do youtube: https://www.youtube.com/watch?v=8Z1zGD1yWGQ


## Sobre o Projeto

O **NewsHub** é um portal de notícias moderno e responsivo que utiliza a API do The Guardian para fornecer acesso rápido e prático a notícias. O projeto foi desenvolvido com foco na experiência do usuário, oferecendo uma interface limpa e intuitiva para visualização de notícias.

### Funcionalidades Principais

- **Visualização de Notícias**: Acesso às últimas notícias do The Guardian
- **Busca Inteligente**: Sistema de busca por palavras-chave
- **Categorização**: Filtros por categorias.
- **Sistema de Usuários**: Login, registro e perfil de usuário
- **Design Responsivo**: Interface adaptável para desktop.

### Arquitetura

O projeto utiliza o framework **Yii 2** como base, seguindo o padrão MVC (Model-View-Controller) para uma arquitetura limpa e organizada.

**Estrutura de Diretórios:**
```
NewsHubProg4/
├── assets/              # Assets da aplicação
├── commands/            # Comandos CLI
├── config/              # Configurações da aplicação
├── controllers/         # Controladores
├── models/              # Modelos (dados e regras de negócio)
├── views/               # Templates de visualização
├── web/                 # Arquivos públicos (CSS, JS, imagens)
├── database/            # Scripts SQL e migrações
├── runtime/             # Cache e logs
├── tests/               # Testes automatizados
└── vendor/              # Dependências do Composer
```

## Tecnologias Utilizadas

### Backend
- **PHP 7.4+** - Linguagem de programação
- **Yii 2 Framework** - Framework web PHP
- **MySQL** - Banco de dados relacional
- **Composer** - Gerenciador de dependências

### Frontend
- **Bootstrap 5** - Framework CSS
- **jQuery** - Biblioteca JavaScript
- **HTML5/CSS3** - Estrutura e estilização

### APIs e Serviços
- **The Guardian API** - Fonte de notícias

### Ambiente de Desenvolvimento
- **Laragon 6.0** - Ambiente de desenvolvimento local

## Instalação e Configuração

### Pré-requisitos
- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Composer
- Laragon (ou XAMPP/WAMP)

### 1. Clone o Repositório

### 2. Instale as Dependências
```bash
composer install
```

### 3. Configuração do Banco de Dados

#### Criar o Banco de Dados
Execute o script SQL localizado em `database/script.sql`:
```sql
CREATE SCHEMA newshub;
USE newshub;

CREATE TABLE user (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    auth_key VARCHAR(32),
    access_token VARCHAR(255),
    created_at INT,
    updated_at INT
);
```

#### Configurar Conexão
Edite o arquivo `config/db.php` com suas credenciais:
```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=newshub',
    'username' => 'root',        // Seu usuário MySQL
    'password' => 'root',        // Sua senha MySQL
    'charset' => 'utf8',
];
```

### 4. Configuração da API do Guardian

Para utilizar a API do The Guardian, você precisa:

1. **Registrar-se** em [open-platform.theguardian.com](https://open-platform.theguardian.com)
2. **Obter sua API Key** gratuita
3. **Configurar a variável de ambiente**:
   - No Windows (Laragon): Adicione `API_KEY=sua_api_key_aqui` nas variáveis de ambiente do sistema
   - Ou edite o arquivo `.env` se estiver usando


## Como Executar

### Usando Laragon

1. **Inicie o Laragon**
2. **Inicie os serviços** (Apache, MySQL)
3. **Acesse o projeto** através do navegador:
   ```
   http://localhost/NewsHubProg4/web/
   ```

