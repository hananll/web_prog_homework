# 🚦 Traffic Restriction Portal

A web application built as a university seminar project for the **Web Programming** course.  
The project extends the **7a – PHP Front Controller design pattern (Solution 2)** base provided in class.

---

## 📌 Project Overview

This portal displays and manages **Hungarian road traffic restriction data** from 2010.  
Users can browse active restrictions, contact the site owner, upload images, and administrators can manage restriction records via a full CRUD interface.

---

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP (Front Controller pattern) |
| Frontend | HTML5, CSS3, Bootstrap 5 |
| Database | MySQL / MariaDB |
| Validation | JavaScript (client-side) + PHP (server-side) |
| Version Control | Git / GitHub |

---

## 📁 Folder Structure

```
/
├── .htaccess                  # URL rewriting (front controller routing)
├── index.php                  # Front controller – single entry point
├── databaselesson.sql         # Full database schema + seed data
├── includes/
│   └── config.inc.php         # App config, DB connection, page routing
├── logicals/
│   ├── login2.php             # Login logic
│   ├── logout.php             # Logout logic
│   ├── register.php           # Registration logic
│   ├── contact.php            # Contact form – save to DB
│   ├── images.php             # Image upload handler
│   └── crud.php               # CRUD operations for restriction table
├── templates/
│   ├── index.tpl.php          # Main layout (navbar, header, footer)
│   └── pages/
│       ├── home.tpl.php       # Mainpage – intro, videos, Google Map
│       ├── images.tpl.php     # Image gallery + upload form
│       ├── contact.tpl.php    # Contact form
│       ├── messages.tpl.php   # Messages list (logged-in only)
│       ├── crud.tpl.php       # CRUD interface for restrictions
│       ├── login.tpl.php      # Login + Registration forms
│       ├── login2.tpl.php     # Login result page
│       ├── logout.tpl.php     # Logout confirmation
│       ├── register.tpl.php   # Registration result page
│       └── 404.tpl.php        # Not found page
├── styles/
│   ├── style.css              # Main stylesheet (Bootstrap + custom)
│   └── table.css              # Table styles for CRUD page
└── images/                    # Static assets + uploaded gallery images
```

---

## 🗄️ Database Structure

| Table | Description |
|---|---|
| `users` | Registered users (login/register) |
| `restriction` | Main traffic restriction records (CRUD) |
| `naming` | Restriction reason lookup (e.g. road construction, flood) |
| `extent` | Restriction severity lookup (e.g. lane closure, complete closure) |
| `messages` | Contact form submissions |
| `image_uploads` | Gallery image upload records |

---

## 🧭 Pages & Access

| Page | URL | Guest | Logged In |
|---|---|---|---|
| Mainpage | `/` | ✅ | ✅ |
| Images | `?images` | ✅ | ✅ |
| Contact | `?contact` | ✅ | ✅ |
| CRUD | `?crud` | ✅ | ✅ |
| Messages | `?messages` | ❌ | ✅ |
| Login | `?login` | ✅ | ❌ |
| Logout | `?logout` | ❌ | ✅ |

---

## ✅ Assignment Checklist

- [x] Built on Solution-2 Front Controller base
- [x] Responsive design with Bootstrap 5
- [x] HTML5 semantic tags + horizontal navbar
- [x] Mainpage with local video, YouTube embed, Google Map
- [x] Image gallery with upload (logged-in users only)
- [x] Contact form with JS + PHP validation, stored in DB
- [x] Messages page (logged-in only, newest first, Guest fallback)
- [x] Full CRUD for `restriction` table
- [x] Deployed to live hosting
- [x] Version controlled with GitHub (5+ commits, both contributors visible)
- [x] PDF documentation (15+ pages)

---

## 🚀 Run Locally

### Requirements
- XAMPP (Apache + MySQL) or any PHP 7.4+ server

### Steps

1. Clone the repository:
   ```bash
   git clone https://github.com/hananll/web_prog_homework
   ```

2. Copy the project folder into your `htdocs` directory.

3. Import the database in phpMyAdmin:
   - Create database `databaselesson` 
   - Import `databaselesson.sql`

4. Update DB credentials in `includes/config.inc.php` if needed:
   ```php
   $dbh = new PDO('mysql:host=localhost;dbname=databaselesson', 'root', '');
   ```

