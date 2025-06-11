# Task Manager API

RESTful система управления задачами и сотрудниками для малых команд.  
Реализовано на Laravel 10, с поддержкой ролей, уведомлений, очередей и планировщика.

## Описание

Система позволяет:

- Управлять задачами и сотрудниками (CRUD)
- Назначать задачи одному или нескольким сотрудникам
- Группировать и фильтровать задачи
- Поддерживать роли (менеджер, программист)
- Получать уведомления при изменении статуса задач
- Автоматически назначать задачи, если они остались без исполнителей

## Установка и запуск

1. Клонировать репозиторий:
   ```bash
   git clone https://github.com/yourname/task-manager.git
   cd task-manager
   ```

2. Скопировать `.env` и настроить при необходимости:

   ```bash
   cp .env.example .env
   ```

3. Собрать и запустить контейнеры:

   ```bash
   make build
   make up
   ```

4. Установить зависимости и прогнать миграции:

   ```bash
   make composer
   make migrate
   make seed
   ```

Для сброса и полной пересборки:

```bash
make refresh
```

## Доступы

* API: [http://localhost:8080](http://localhost:8080)
* Adminer (MySQL): [http://localhost:8082](http://localhost:8082)
* Redis Commander: [http://localhost:8081](http://localhost:8081)

## Используемые сервисы

* PHP 8.3 (FPM)
* Laravel 10
* MySQL 8
* Redis
* Nginx
* Docker Compose
* Laravel Queue (Redis)
* Laravel Scheduler

## Структура API

* `GET /api/employees` — список сотрудников с ролями
* `POST /api/employees/{id}/assign-role` — назначить роль
* `POST /api/tasks` — создать задачу (ограничено по IP)
* `POST /api/tasks/{id}/assign` — назначить сотрудников
* `GET /api/tasks/grouped-by-status` — задачи по статусам



