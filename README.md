# Netcamp Projects

This repository contains **two different Netcamp training projects** created by Archit Srivastava.

## Projects in this repository

| Project | Branch | Type | Status |
|---|---|---|---|
| Android Development Project | `app-develoment-by-java` | Android app development using Java and XML | Main Android branch |
| PHP Full-Stack Login System | `full-stack-development` | Web app using PHP, MySQL, HTML, CSS, Bootstrap | Open PR branch |

> Note: The Android branch name currently uses `app-develoment-by-java`. The spelling should ideally be corrected later to `app-development-by-java`, but the current branch name is kept here so visitors can find it.

---

## 1. Android Development Project

**Branch:** `app-develoment-by-java`

This project contains Android development practice work from Netcamp training.

### Main topics covered

- Android Studio project structure
- Java activity code
- XML UI layouts
- Login and signup screens
- Calculator functionality
- Camera feature
- Music player feature
- Bluetooth and WiFi control practice
- Light sensor and torch functionality

### Important paths

```text
app/src/main/java/com/example/my_project
app/src/main/res/layout
```

Use this branch when you want to review the Android app development work.

---

## 2. PHP Full-Stack Login System

**Branch:** `full-stack-development`

This project contains a PHP and MySQL login system created using WAMP server.

### Main features

- User registration
- User login
- Password hashing
- User welcome page
- User profile page
- Profile photo upload
- Admin login
- Admin dashboard
- Logout system
- Basic forgot-password flow
- Shared header, footer, and CSS styling

### Tech stack

- PHP
- MySQL
- HTML
- CSS
- Bootstrap
- WAMP Server

### Database note

The database name used in the project is:

```text
login
```

The project expects a `users` table with fields for username, email, password, profile photo, and admin status.

---

## Recommended cleanup before final portfolio use

- Rename `app-develoment-by-java` to `app-development-by-java` later.
- Keep only one database connection file name, preferably `db_connect.php`.
- Improve SQL safety by using prepared statements everywhere.
- Fix profile upload input-name consistency.
- Add screenshots for both projects.
- Add database SQL file for the PHP project.

---

## Author

**Archit Srivastava**  
B.Tech CSE Student  
GitHub: https://github.com/architcoder1234
