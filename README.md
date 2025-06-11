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
   git clone https://github.com/yourname/task-manager-api.git
   cd task-manager-api
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

---

## Структура API

### Сотрудники

* `GET /api/employees` — список сотрудников с ролями
* `GET /api/employees/{id}` — получить одного сотрудника с ролями
* `POST /api/employees` — создать нового сотрудника
* `PUT /api/employees/{id}` — обновить сотрудника
* `DELETE /api/employees/{id}` — удалить сотрудника
* `POST /api/employees/{id}/assign-role` — назначить роль сотруднику
* `POST /api/employees/{id}/remove-role` — снять роль с сотрудника

---

### Задачи

* `GET /api/tasks` — список задач с фильтрами, сортировкой и пагинацией
* `GET /api/tasks/{id}` — получить одну задачу
* `POST /api/tasks` — создать задачу (ограничение 2 в минуту с одного IP)
* `PUT /api/tasks/{id}` — обновить задачу (триггерит уведомления при изменении статуса)
* `DELETE /api/tasks/{id}` — удалить задачу
* `POST /api/tasks/{id}/assign` — назначить задачу одному или нескольким сотрудникам
* `POST /api/tasks/{id}/unassign` — снять назначение задачи с сотрудника(ов)
* `GET /api/tasks/grouped-by-status` — получить список задач, сгруппированных по статусу

---
