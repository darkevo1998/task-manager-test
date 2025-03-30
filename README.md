# Laravel Task Management Application

A simple task management application with drag-and-drop reordering and project organization.

## Features

- Create, edit, and delete projects
- Create, edit, and delete tasks within projects
- Drag-and-drop reordering of tasks
- Automatic priority updating
- Clean, responsive interface with Tailwind CSS

## Requirements

- PHP 8.1+
- Composer
- Node.js 16+
- MySQL 5.7+
- NPM/PNPM/Yarn

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/darkevo1998/task-manager-test.git
   cd task-manager
   ```
2. Install PHP dependencies:
   ```bash
   composer install
   ```
3. Install JavaScript dependencies:
   ```bash
   npm install
   ```
4. Create a copy of the .env file:
   ```bash
   cp .env.example .env
   ```
5. Generate an application key:
   ```bash
   php artisan key:generate
   ```
6. Configure your database in the `.env` file:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=task_manager
   DB_USERNAME=your_db_username
   DB_PASSWORD=your_db_password
   ```
7. Run migrations and seed the database with sample data:
   ```bash
   php artisan migrate --seed
   ```
8. Compile frontend assets:
   ```bash
   npm run dev
   ```

## Running the Application

Start the development server:
```bash
php artisan serve
```
Visit [http://localhost:8000](http://localhost:8000) in your browser.

## Usage

### Projects Page:
- View all projects
- Click "Add Project" to create new projects
- Click on any project to view its tasks

### Tasks Page:
- View all tasks for the selected project
- Drag and drop tasks to reorder them (priority updates automatically)
- Click "Add Task" to create new tasks
- Edit or delete existing tasks

## Deployment

### For Production

Compile assets for production:
```bash
npm run build
```
Optimize the application:
```bash
php artisan optimize
```
Configure your web server (Apache/Nginx) to point to the `public` directory.

### Environment Variables for Production

Set these in your production `.env` file:
```env
APP_ENV=production
APP_DEBUG=false
```

## Troubleshooting

### Vite Manifest Not Found
If you see this error:
- Make sure you've run `npm install`
- Run `npm run dev` or `npm run build`
- Clear view cache: `php artisan view:clear`

### Database Issues
- Verify your database credentials in `.env`
- Make sure MySQL is running
- Run `php artisan migrate:fresh --seed` to reset the database

