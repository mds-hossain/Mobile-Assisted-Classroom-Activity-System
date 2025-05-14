
# Mobile-Assisted Classroom Activity System

This repository is for the **Mobile-Assisted Classroom Activity System (MACAS)** project, which aims to create an interactive system for classroom activities that is assisted by mobile devices.

## Table of Contents
- [Requirements](#requirements)
- [Setup Guide](#setup-guide)
- [Running the Project](#running-the-project)
- [Project Structure](#project-structure)
- [License](#license)

## Requirements

Before setting up the project, ensure that you have the following software installed:

- **PHP** (preferably version 7.x or higher)
- **Composer** (for managing PHP dependencies)
- **Node.js** (for running JavaScript tasks)
- **npm** (for managing Node.js dependencies)
- **Gulp.js** (for task automation)
- A local development server such as **XAMPP** or **MAMP** for running PHP applications locally.
- An internet browser for testing the system's user interface.

## Setup Guide

### 1. Clone the repository

Start by cloning the repository to your local machine:

```bash
git clone https://github.com/mds-hossain/Mobile-Assisted-Classroom-Activity-System.git
cd Mobile-Assisted-Classroom-Activity-System
```

### 2. Set up the environment file

Create a copy of the example `.env` file and rename it to `.env`. You can do this with the following command:

```bash
cp .env.example .env
```

Next, update the `.env` file with your local configurations, including database connection settings and any other necessary configurations.

### 3. Install PHP Dependencies

Run the following command to install PHP dependencies using Composer:

```bash
composer install
```

### 4. Install Node.js Dependencies

Run the following command to install JavaScript dependencies:

```bash
npm install
```

### 5. Set up the Database

Create a new database in your MySQL server (for example, `macas_db`) and import any necessary schema from the database dump (if available).

Ensure that your `.env` file has the correct database credentials for your local environment.

### 6. Set up SSL (optional)

If you need SSL setup, you can use the provided `macas.crt` certificate file. Follow the instructions specific to your development environment for setting up the certificate.

### 7. Run the Project

#### Start the PHP server:

To run the project, use the following command:

```bash
php -S localhost:8000
```

This will start a local PHP server at `http://localhost:8000`.

#### Start Gulp tasks:

If the project uses Gulp for task automation (e.g., compiling assets), run:

```bash
gulp
```

This will start watching the files and compile them when changes are made.

### 8. Access the Application

Now that the server is running, open your browser and navigate to:

```
http://localhost:8000
```

You should be able to see the system in action!

## Project Structure

Here’s a brief overview of the project structure:

```
├── .gitignore           # Git ignore file
├── .gitattributes       # Git attributes file
├── .env                 # Environment variables
├── .env.example         # Example environment file
├── composer.json        # Composer dependencies
├── gulpfile.js          # Gulp task automation
├── index.php            # Main entry point for the app
├── server.php           # Additional server configuration
├── socket.js            # Socket-related functionality
├── package.json         # NPM dependencies
├── LICENSE              # Project license
└── ...                  # Other project files
```

## License

This project is licensed under the [MIT License](LICENSE).
