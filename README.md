# 📅 Sistema de Agendamento

![Version](https://img.shields.io/badge/version-1.0.0-blue)
![Status](https://img.shields.io/badge/status-production-green)
![Laravel](https://img.shields.io/badge/Laravel-13.x-red)
![PHP](https://img.shields.io/badge/PHP-8.3-purple)
![MySQL](https://img.shields.io/badge/MySQL-8.x-blue)
![Tailwind CSS](https://img.shields.io/badge/TailwindCSS-4.x-06B6D4)
![License](https://img.shields.io/badge/license-MIT-green)

Sistema web completo para gerenciamento de agendamentos, desenvolvido com **Laravel, PHP, MySQL, Blade e Tailwind CSS**, com áreas independentes para administradores e clientes.

A aplicação foi projetada seguindo uma arquitetura organizada, componentizada e preparada para ambiente de produção, oferecendo gerenciamento de serviços, horários, agendamentos, clientes, histórico, relatórios, dashboards, autenticação e configurações de perfil.

---

## 📌 Sobre o projeto

O **Sistema de Agendamento** é uma aplicação web desenvolvida para simular uma solução real de gerenciamento de atendimentos e horários.

O sistema possui dois níveis principais de acesso:

* **Administrador**
* **Cliente**

O administrador possui controle completo sobre os serviços, horários de funcionamento, agendamentos, clientes, histórico, indicadores e relatórios.

O cliente possui uma área própria para realizar e acompanhar seus agendamentos, consultar histórico, atualizar seus dados pessoais e gerenciar sua conta.

Além das funcionalidades de negócio, o projeto conta com um **Design System próprio**, componentes Blade reutilizáveis, interface responsiva, Dark Mode, sistema global de notificações e diversas regras de negócio para garantir a consistência dos agendamentos.

---

## ✨ Principais funcionalidades

### 🔐 Autenticação e segurança

* Login
* Cadastro de usuários
* Logout
* Recuperação de senha
* Proteção de rotas autenticadas
* Controle de acesso por perfil
* Middleware de autenticação
* Middleware de autorização por role
* Proteção CSRF
* Hash seguro de senhas
* Validação de senha forte
* Controle de sessão
* Redirecionamento automático por perfil

### 👥 Controle de usuários

O sistema diferencia automaticamente as funcionalidades disponíveis para cada tipo de usuário.

**Administrador:**

* Gerenciamento do sistema
* Visualização de clientes
* Gerenciamento de serviços
* Configuração de horários
* Gerenciamento de agendamentos
* Histórico completo
* Filtros avançados
* Relatórios
* Dashboard analítico

**Cliente:**

* Dashboard personalizado
* Novo agendamento
* Meus agendamentos
* Histórico
* Cancelamento de agendamentos
* Perfil
* Alteração de senha
* Upload de foto de perfil

---

## 📅 Agendamentos

O módulo de agendamentos é responsável por controlar todo o fluxo de marcação de atendimentos.

### Cliente

* Seleção de serviço
* Calendário visual
* Seleção de data
* Visualização dos horários disponíveis
* Confirmação do agendamento
* Visualização dos próprios agendamentos
* Cancelamento
* Histórico de atendimentos
* Filtros
* Visualização do status do atendimento

### Administrador

* Visualização de todos os agendamentos
* Filtros por status
* Filtros por cliente
* Filtros por serviço
* Filtros por período
* Alteração de status
* Visualização detalhada dos atendimentos

### Status disponíveis

* Pendente
* Confirmado
* Concluído
* Cancelado

---

## 🕒 Controle de horários

O administrador pode configurar o expediente semanal do sistema.

É possível definir:

* Dias de funcionamento
* Dias fechados
* Horário de abertura
* Horário de fechamento
* Início do intervalo
* Fim do intervalo

Essas configurações são utilizadas automaticamente pelo sistema de agendamento.

O calendário do cliente considera:

* Dias disponíveis
* Dias fechados
* Horário de funcionamento
* Intervalos
* Duração do serviço
* Agendamentos existentes
* Conflitos de horário

---

## 🛠️ Gerenciamento de serviços

O administrador possui um CRUD completo para gerenciamento dos serviços oferecidos.

Funcionalidades:

* Cadastro
* Edição
* Exclusão lógica
* Ativação/desativação
* Definição de preço
* Definição de duração
* Pesquisa
* Ordenação
* Paginação
* Validações

O sistema também possui regras para evitar operações inconsistentes em serviços relacionados a agendamentos.

---

## 👤 Perfil do usuário

Cada usuário possui uma área própria para gerenciamento de suas informações.

Funcionalidades:

* Alteração de nome
* Alteração de e-mail
* Alteração de telefone
* Upload de foto de perfil
* Preview da imagem antes do envio
* Remoção automática da imagem anterior
* Alteração de senha
* Validação de senha atual
* Exibição dos requisitos de segurança da senha

A foto de perfil também é utilizada na navegação principal do sistema.

---

## 📊 Dashboard

O sistema possui dashboards independentes para administradores e clientes.

### Dashboard administrativo

Apresenta indicadores como:

* Total de agendamentos
* Agendamentos do dia
* Total de clientes
* Receita
* Agendamentos por status
* Serviços mais utilizados
* Receita por período
* Histórico de atendimentos
* Calendário de agendamentos

### Dashboard do cliente

Apresenta informações personalizadas como:

* Próximos agendamentos
* Total de agendamentos
* Agendamentos concluídos
* Último atendimento
* Calendário pessoal
* Indicadores individuais

Os dashboards utilizam gráficos e componentes visuais para facilitar a interpretação das informações.

---

## 📖 Histórico

O sistema possui histórico separado para clientes e administradores.

### Cliente

* Próximos agendamentos
* Agendamentos anteriores
* Serviço
* Data
* Horário
* Duração
* Status
* Paginação

### Administrador

* Histórico geral do sistema
* Cliente
* Serviço
* Data
* Horário
* Duração
* Status
* Pesquisa
* Filtros avançados
* Paginação

---

## 🔎 Filtros e pesquisas

O histórico administrativo possui filtros combináveis para facilitar a localização dos registros.

Filtros disponíveis:

* Cliente
* Serviço
* Status
* Data inicial
* Data final

Os filtros são processados no backend através de uma camada específica de filtragem, permitindo composição dinâmica das consultas.

---

## 📄 Relatórios

O módulo de relatórios permite analisar os dados dos agendamentos e gerar arquivos para utilização externa.

### Indicadores

* Receita total
* Quantidade de serviços concluídos
* Ticket médio

### Filtros

* Status
* Cliente
* Serviço
* Período

### Exportações

* PDF
* Excel

Os arquivos exportados respeitam os filtros selecionados pelo administrador.

---

## 🔔 Sistema de notificações

O projeto utiliza um sistema global de notificações baseado em **SweetAlert2**.

São disponibilizados handlers reutilizáveis para:

* Sucesso
* Erro
* Aviso
* Informação
* Confirmação de ações

As notificações são centralizadas no layout principal, evitando duplicação de código entre as páginas.

Também são tratados globalmente:

* Mensagens de sessão
* Erros de validação
* Confirmações de exclusão
* Confirmações de cancelamento
* Feedbacks de operações

---

## 🎨 Interface e Design System

O projeto possui um Design System próprio desenvolvido para manter consistência visual em toda a aplicação.

### Recursos

* Dark Mode
* Light Mode
* CSS Variables
* Tokens de cores
* Tokens de espaçamento
* Sombras
* Border radius
* Estados de hover
* Estados de focus
* Badges
* Inputs padronizados
* Cards
* Tabelas
* Modais
* Dropdowns
* Toasts
* Empty States
* Paginação
* Loaders

O tema escolhido pelo usuário é persistido utilizando `localStorage`.

---

## 📱 Responsividade

A interface foi desenvolvida para funcionar em diferentes tamanhos de tela.

### Desktop

* Sidebar expansível
* Sidebar recolhível
* Navbar
* Tabelas responsivas
* Dashboards adaptáveis

### Mobile

* Menu hamburger
* Sidebar com overlay
* Navegação adaptada
* Formulários responsivos
* Cards adaptáveis
* Tabelas adaptadas
* Calendário responsivo

A preferência de estado da sidebar também é persistida entre as páginas.

---

# 🖼️ Screenshots

Abaixo estão alguns dos principais pontos da interface que podem ser apresentados no portfólio.

> Coloque os screenshots reais do sistema na pasta `docs/screenshots/`.

### 🔐 Login

![Tela de Login](docs/screenshots/login.png)

Tela de autenticação com validação, feedback visual e opção de exibição da senha.

---

### 📊 Dashboard Administrativo

![Dashboard Administrativo](docs/screenshots/dashboard-admin.png)

Dashboard com indicadores, gráficos, calendário e informações consolidadas dos agendamentos.

---

### 📊 Dashboard do Cliente

![Dashboard do Cliente](docs/screenshots/dashboard-client.png)

Área personalizada para acompanhamento dos próprios agendamentos.

---

### 📅 Novo Agendamento

![Novo Agendamento](docs/screenshots/novo-agendamento.png)

Fluxo de criação de agendamento com seleção de serviço, calendário e horários disponíveis.

---

### 📋 Gerenciamento de Agendamentos

![Agendamentos](docs/screenshots/agendamentos.png)

Painel administrativo para gerenciamento dos atendimentos e atualização de status.

---

### 🛠️ Serviços

![Serviços](docs/screenshots/servicos.png)

CRUD de serviços com pesquisa, paginação, status e ações administrativas.

---

### 🕒 Horários

![Horários](docs/screenshots/horarios.png)

Configuração do expediente semanal e intervalos de atendimento.

---

### 📖 Histórico

![Histórico](docs/screenshots/historico.png)

Histórico de agendamentos com filtros, pesquisa, paginação e informações detalhadas.

---

### 📄 Relatórios

![Relatórios](docs/screenshots/relatorios.png)

Dashboard de relatórios com indicadores financeiros, filtros e exportação.

---

### 👤 Perfil

![Perfil](docs/screenshots/perfil.png)

Área de gerenciamento de informações pessoais, senha e foto de perfil.

---

### 🌙 Dark Mode

![Dark Mode](docs/screenshots/dark-mode.png)

Interface completa utilizando o tema escuro do Design System.

---

# 🛠️ Tecnologias utilizadas

## Backend

* PHP 8.3
* Laravel 13
* Laravel Breeze
* Eloquent ORM
* Form Requests
* Middleware
* Service Layer
* Query Builder
* Soft Deletes
* Carbon

## Frontend

* Blade
* Tailwind CSS
* JavaScript
* Vite
* Alpine.js
* Lucide Icons

## Bibliotecas e componentes

* SweetAlert2
* DataTables
* Chart.js
* FullCalendar
* Laravel Excel
* DomPDF

## Banco de dados

* MySQL

## Desenvolvimento

* Composer
* NPM
* Git
* GitHub
* Vite

---

# 🧱 Arquitetura

O projeto utiliza uma estrutura baseada no padrão MVC do Laravel, complementada por camadas responsáveis pelas regras específicas de cada módulo.

```text
app/
├── Enums/
├── Helpers/
├── Http/
│   ├── Controllers/
│   ├── Middleware/
│   └── Requests/
├── Models/
└── Services/

resources/
├── css/
├── js/
└── views/
    ├── admin/
    ├── client/
    ├── components/
    ├── layouts/
    └── profile/

routes/
├── admin.php
├── appointments.php
├── auth.php
├── client.php
├── services.php
└── web.php

database/
├── factories/
├── migrations/
└── seeders/

public/
├── build/
└── ...

storage/
├── app/
├── framework/
└── logs/
```

---

# 🧩 Organização da aplicação

A aplicação utiliza uma separação de responsabilidades para manter o código organizado e facilitar sua manutenção.

### Controllers

Responsáveis pelo fluxo HTTP e comunicação entre requisições e as camadas internas.

### Services

Centralizam regras de negócio e operações mais complexas.

Exemplos:

* `AppointmentService`
* `ScheduleValidator`
* `HistoryService`
* `DashboardService`
* `ReportService`

### Form Requests

Centralizam as validações de entrada dos formulários.

### Models

Representam as entidades do sistema e seus relacionamentos através do Eloquent ORM.

### Middleware

Responsáveis por autenticação e controle de acesso por perfil.

### Blade Components

Componentes reutilizáveis utilizados em toda a interface.

---

# 🔐 Segurança

O projeto implementa diversos mecanismos de segurança disponíveis no ecossistema Laravel.

* CSRF Protection
* Hash de senhas
* Validação de senha forte
* Middleware `auth`
* Middleware de autorização por role
* Proteção de rotas privadas
* Validação através de Form Requests
* Controle de sessão
* Soft Deletes
* Separação de permissões entre Admin e Client
* `APP_DEBUG=false` em produção
* Variáveis sensíveis armazenadas no `.env`

### Regras de senha

A senha deve possuir:

* Mínimo de 8 caracteres
* Uma letra maiúscula
* Uma letra minúscula
* Um número
* Um caractere especial

---

# ⚙️ Como executar localmente

## 1. Requisitos

Antes de iniciar, certifique-se de possuir:

* PHP >= 8.3
* Composer
* Node.js
* NPM
* MySQL
* Git

---

## 2. Clonar o projeto

```bash
git clone https://github.com/jeffersonjuni/sistema-agendamento-completo.git

cd sistema-agendamento-completo
```

---

## 3. Instalar dependências PHP

```bash
composer install
```

---

## 4. Instalar dependências JavaScript

```bash
npm install
```

---

## 5. Configurar o ambiente

Copie o arquivo `.env.example`:

```bash
cp .env.example .env
```

No Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

Configure as variáveis principais:

```env
APP_NAME="Sistema de Agendamento"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistema_agendamento
DB_USERNAME=root
DB_PASSWORD=
```

---

## 6. Gerar a chave da aplicação

```bash
php artisan key:generate
```

---

## 7. Criar o banco de dados

Crie um banco MySQL:

```sql
CREATE DATABASE sistema_agendamento;
```

Depois execute as migrations:

```bash
php artisan migrate
```

---

## 8. Popular o banco com dados de teste

Caso os Seeders estejam configurados para o ambiente:

```bash
php artisan db:seed
```

Ou:

```bash
php artisan migrate:fresh --seed
```

> O comando `migrate:fresh --seed` apaga as tabelas existentes antes de recriá-las. Utilize apenas em ambientes de desenvolvimento.

---

## 9. Criar o link de armazenamento

Para disponibilizar os arquivos armazenados no disco público:

```bash
php artisan storage:link
```

Isso permite que arquivos como fotos de perfil sejam acessados através de:

```text
/public/storage
```

---

## 10. Compilar os assets

Para desenvolvimento:

```bash
npm run dev
```

Para produção:

```bash
npm run build
```

---

## 11. Iniciar o servidor

Em outro terminal:

```bash
php artisan serve
```

A aplicação estará disponível em:

```text
http://127.0.0.1:8000
```

---

# 🚀 Deploy em produção

A aplicação foi preparada para execução em ambiente de produção utilizando hospedagem compartilhada com suporte a PHP e MySQL.

### Infraestrutura utilizada

* Aplicação: hospedagem PHP
* Web Server: Apache
* Banco de dados: MySQL
* Build frontend: Vite
* Controle de versão: GitHub
* Domínio: `sistema-agendamento.rf.gd`

---

## 📦 Preparação para produção

Antes do upload dos arquivos:

```bash
composer install --no-dev --optimize-autoloader
```

Compile os assets:

```bash
npm install
npm run build
```

Limpe e otimize os caches:

```bash
php artisan optimize:clear
```

Depois:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 🌐 Configuração do ambiente

No servidor, o `.env` deve utilizar configurações de produção semelhantes a:

```env
APP_NAME="Sistema Agendamento"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://sistema-agendamento.rf.gd

APP_LOCALE=pt_BR
APP_FALLBACK_LOCALE=pt_BR

DB_CONNECTION=mysql
DB_HOST=seu-host-mysql
DB_PORT=3306
DB_DATABASE=seu-banco
DB_USERNAME=seu-usuario
DB_PASSWORD=sua-senha

SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=lax

CACHE_STORE=file
QUEUE_CONNECTION=sync
```

> As credenciais reais do banco nunca devem ser versionadas no Git.

---

# 📁 Estrutura de deploy

A estrutura utilizada no ambiente de hospedagem separa os arquivos públicos da aplicação Laravel.

```text
htdocs/
├── index.php
└── sistema/
    ├── app/
    ├── bootstrap/
    ├── config/
    ├── database/
    ├── resources/
    ├── routes/
    ├── storage/
    ├── vendor/
    ├── .env
    └── ...
```

O `index.php` público inicializa a aplicação Laravel localizada no diretório `sistema`.

Essa estrutura permite manter o código da aplicação fora do diretório público principal.

---

# 🔗 Armazenamento de arquivos

As fotos de perfil são armazenadas utilizando o filesystem público do Laravel.

Os arquivos ficam organizados em:

```text
storage/
└── app/
    └── public/
        └── avatars/
```

Após a configuração do ambiente, os arquivos podem ser acessados através da estrutura pública correspondente.

---

# 🗄️ Banco de dados

O sistema utiliza MySQL para armazenamento das informações.

Principais entidades:

```text
users
services
appointments
schedules
```

### Relacionamentos principais

```text
User
 └── hasMany Appointments

Service
 └── hasMany Appointments

Appointment
 ├── belongsTo User
 └── belongsTo Service
```

O sistema utiliza:

* Foreign Keys
* Eloquent Relationships
* Soft Deletes
* Enums
* Migrations
* Factories
* Seeders

---

# 🧪 Testes funcionais realizados

A aplicação foi validada através de testes funcionais nos principais fluxos.

### Autenticação

* Cadastro
* Login
* Logout
* Recuperação de senha
* Validação de credenciais
* Proteção de rotas

### Controle de acesso

* Acesso administrativo
* Acesso de cliente
* Redirecionamento por perfil
* Bloqueio de rotas não autorizadas

### Perfil

* Atualização de dados
* Alteração de senha
* Upload de imagem
* Preview da imagem
* Atualização do avatar
* Validação dos campos

### Agendamentos

* Criação
* Cancelamento
* Alteração de status
* Conflitos de horários
* Horários indisponíveis
* Dias fechados
* Intervalos
* Duração dos serviços

### Serviços

* Cadastro
* Edição
* Exclusão
* Ativação/desativação
* Validação

### Horários

* Configuração de expediente
* Dias fechados
* Intervalos
* Horários disponíveis

### Dashboard

* Indicadores
* Gráficos
* Calendário
* Dados administrativos
* Dados do cliente

### Relatórios

* Filtros
* Indicadores
* Exportação PDF
* Exportação Excel
* Downloads

### Interface

* Desktop
* Tablet
* Mobile
* Sidebar
* Dark Mode
* Light Mode
* Notificações
* Componentes reutilizáveis

---

# 📈 Características técnicas

O projeto foi desenvolvido com foco em:

* Organização de código
* Separação de responsabilidades
* Reutilização de componentes
* Manutenibilidade
* Escalabilidade
* Segurança
* Responsividade
* Experiência do usuário
* Validação no backend
* Centralização de regras de negócio

---

# 💡 Diferenciais do projeto

* Arquitetura MVC organizada
* Service Layer para regras de negócio
* Form Requests para validação
* Middleware de autorização
* Design System próprio
* Componentes Blade reutilizáveis
* Dashboard administrativo e cliente
* Calendário integrado
* Sistema de horários
* Filtros avançados
* Relatórios financeiros
* Exportação PDF e Excel
* Sistema global de notificações
* Dark Mode persistente
* Sidebar responsiva e persistente
* Upload de avatar
* Interface totalmente responsiva
* Preparação para produção

---

# 📌 Status do projeto

**Versão atual: `1.0.0`**

**Status: 🟢 Produção**

O sistema encontra-se funcional e implantado em ambiente de produção, com os principais fluxos administrativos e de cliente implementados e validados.

---

# 🔮 Possíveis evoluções

Algumas funcionalidades podem ser adicionadas em futuras versões:

* Notificações por e-mail
* Integração com WhatsApp
* Confirmação automática de agendamentos
* Sistema de pagamentos
* Integração com Google Calendar
* Relatórios mais avançados
* Controle de permissões mais granular
* Logs administrativos
* Auditoria de alterações
* API REST
* Aplicação mobile

---

# 👨‍💻 Autor

**Jefferson Luiz dos Santos Júnior**

Desenvolvedor Full Stack

Projetos desenvolvidos com foco em aplicações web completas, arquitetura organizada, boas práticas de desenvolvimento e experiência do usuário.

---

## ⭐ Projeto

Se este projeto foi útil ou interessante para você, considere deixar uma ⭐ no repositório.

**Sistema de Agendamento — v1.0.0**
