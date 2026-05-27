# 🍲 FlavorVault

FlavorVault is a modern full-stack recipe management platform that allows users to discover, create, and manage recipes with authentication, search, and favorites functionality.

Built using PHP (PDO) and PostgreSQL, it is optimized for cloud deployment on Render.

---

## 🚀 Live Concept

A clean, responsive web application where users can:
- Register and login securely
- Create and manage recipes
- Search recipes instantly
- Store favorites
- Upload recipe images

---

## 🧠 Tech Stack

### Backend
- PHP 8+ (PDO)
- PostgreSQL

### Frontend
- HTML5
- CSS3 (modern UI)
- Vanilla JavaScript

### DevOps / Tools
- Git & GitHub
- Render (Cloud Hosting)
- Docker (optional deployment)

---

## 📁 Project Structure


FlavorVault/
│
├── config/
│ ├── db.php
│ └── env.php
│
├── auth/
│ ├── login.php
│ └── register.php
│
├── includes/
│ ├── header.php
│ └── footer.php
│
├── assets/
│ ├── css/
│ ├── js/
│ └── uploads/
│
├── index.php
├── recipe.php
├── dashboard.php
└── README.md


---

## ⚙️ Installation

### 1. Clone repository
```bash
git clone https://github.com/yourusername/flavorvault.git
cd flavorvault
2. Setup database (PostgreSQL)
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
3. Configure environment

Set Render environment variables:

DB_HOST=
DB_NAME=
DB_USER=
DB_PASS=
DB_PORT=5432
4. Run locally
http://localhost/flavorvault
🔐 Security
Password hashing (password_hash)
Prepared statements (PDO)
Session authentication
Input sanitization
🚀 Features
Authentication system
Recipe CRUD system
Search functionality
Image uploads
Responsive UI
📈 Future Improvements
Ratings system
Recipe categories filter
Dark mode
REST API version
Mobile app

<svg width="1200" height="400" xmlns="http://www.w3.org/2000/svg">
  <defs>
    <linearGradient id="bg" x1="0" x2="1">
      <stop offset="0%" stop-color="#ff7e5f"/>
      <stop offset="100%" stop-color="#feb47b"/>
    </linearGradient>
  </defs>

  <rect width="1200" height="400" fill="url(#bg)"/>

  <text x="50%" y="45%" text-anchor="middle"
        font-size="70" fill="white" font-family="Arial">
    FlavorVault
  </text>

  <text x="50%" y="60%" text-anchor="middle"
        font-size="25" fill="white">
    Discover • Create • Share Recipes
  </text>
</svg>
