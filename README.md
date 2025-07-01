# 📦 Price Configurator

A dynamic product pricing configurator built with **Laravel**, **Livewire**, and **Tailwind CSS** — powered by **Docker** and **SQLite** for easy setup and fast local development.

---

## 🚀 Features

- ✅ Product selection with attributes
- ✅ Attribute-based pricing and discount rules
- ✅ User-type rules and total-based discount logic
- ✅ Livewire-powered UI updates
- ✅ Automatically applies discounts from the database
- ✅ Runs on Docker (PHP 8.3 + Apache + SQLite)

---

## 📁 Project Structure

```
.
├── app/
├── database/
│   └── database.sqlite        # Auto-created if missing
├── public/
├── resources/
├── routes/
├── fix-permissions.sh         # Sets permissions, installs composer, runs migrations
├── Dockerfile
├── docker-compose.yml
├── .env.example
└── README.md
```

---

## 🐳 Quick Start (with Docker)

### 1. Clone the project

```bash
git clone https://github.com/MrWasimAbbasi/alshamil.git
cd alshamil
```

### 2. Start the container

```bash
docker compose up --build
```

What this does:

- Installs dependencies via Composer
- Copies `.env.example` → `.env` (if missing)
- Creates `database/database.sqlite` (if missing)
- Fixes permissions on storage & database folders
- Runs `php artisan migrate:fresh --seed`
- Starts Apache

### 3. Open in browser

```
http://localhost:8003
```

---

## 🛠 Useful Commands

```bash
# Artisan
docker compose exec app php artisan migrate

# Composer
docker compose exec app composer dump-autoload

# Node (optional, if using Vite or Tailwind)
docker compose exec app npm install
docker compose exec app npm run build
```

---

## ⚙️ Environment Setup

Ensure this is set in `.env`:

```env
DB_CONNECTION=sqlite
DB_DATABASE=/var/www/html/database/database.sqlite
```

SQLite file is automatically created by the entrypoint script (`fix-permissions.sh`).

---

## 🧠 Discount Rule Format (Example)

Your `discount_rules` table can contain rules like:

| Type       | Condition                            | Discount Type | Amount |
|------------|---------------------------------------|---------------|--------|
| attribute  | `{"group":"Size","value":"Small"}`    | percentage    | 5      |
| total      | `{"min_total":200}`                  | fixed         | 10     |
| user_type  | `{"user_type":"company"}`            | percentage    | 20     |

Rules are applied automatically during calculation.

---

## ❤️ Credits

- Built with [Laravel](https://laravel.com)
- Real-time interactions via [Livewire](https://livewire.laravel.com)
- UI styled with [Tailwind CSS](https://tailwindcss.com)
- Containerized with [Docker](https://www.docker.com)

> UI and configuration designed by [MrWasimAbbasi](https://github.com/MrWasimAbbasi)

---

## 🧾 License

This project is open-source and available under the [MIT License](LICENSE).
