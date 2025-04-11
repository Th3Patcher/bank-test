# 🚀 Laravel Bank App (Dockerized)

Цей проект — демонстраційний банківський API застосунок на базі.\
Усе налаштовано для локального розробницького середовища.

---

## 🧰 Стек технологій

- PHP
- Laravel
- MySQL
- Redis
- Nginx
- phpMyAdmin

---



## 📦 Запуск проєкту

### 1. Встановити залежності (в контейнері PHP)

```bash
docker exec -it php-bank composer install
```

### 2. Копіювати `.env`
```bash
cp .env.example .env
```

### 3. Запуск контейнерів
```bash
docker-compose up --build -d
```
---

## 🛠 Налаштування після запуску

### 1. Встановити залежності (в контейнері PHP)

```bash
docker exec -it php-bank composer install
```

### 2. Генерація ключа додатку
```bash
docker exec -it php-bank php artisan key:generate
```

### 3. Міграції та сидери
```bash
docker exec -it php-bank php artisan migrate --seed
```
