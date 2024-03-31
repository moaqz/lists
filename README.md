# 📝 **Lists - To-do lists to get organized**

Lists is a web application designed to help you create lists for organizing your daily tasks or reminders. This repository contains the API developed in Laravel.

> [!Note]
> This is my first project developed using Laravel. If you find anything that can be improved, feel free to create an issue. :)

## 📓 Endpoints documentation

All endpoints are documented using Postman. You can find them [here](https://www.postman.com/moaqz/workspace/public/collection/33971626-f310a71b-23b6-44da-aa21-6733778c7856).

## ⚙️ Getting Started

**Requirements:**

- [x] **Composer** installed. You can download it [here](https://getcomposer.org/download/)
- [x] **PHP** (v8.2+) installed. You can download it [here](https://www.php.net/downloads.php)

**Steps:**

1. Clone the repository:

```bash
git clone git@github.com:moaqz/lists.git
```

2. Install dependencies:

```bash
composer install
```

3. Create a `.env` file and update the following credentials:

```bash
cp .env.example .env
```

-  Update the allowed origins in the `FRONTEND_URL` variable in the `.env` file.

> [!IMPORTANT]
> The origin must only include the schema, host and port. No trailling slashes.
> e.g. http://localhost:3000

- Configure the cookie domain in the `SESSION_DOMAIN` variable in the `.env` file.

> [!IMPORTANT]
> The cookie domain name should not include the scheme, port or a trailling slash.
> e.g. localhost

- Make sure that Sanctum domains are configured using the `SANCTUM_STATEFUL_DOMAINS` variable.

> [!IMPORTANT]
> Stateful domains should only include the hostname and the port.
> e.g. localhost:5173

- Generate a unique key for encryption:

```bash
php artisan key:generate
```

4. Run the server and you are ready to go 🚀

```bash
php artisan serve
```
