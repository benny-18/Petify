# Petify - Lost & Found Pet Poster Creator

**Petify** is a Laravel web application that allows users to create, edit, and export professional lost & found pet posters using a variety of templates. It features a live preview powered by Livewire, automatic thumbnail generation, and export to PNG or PDF.

---

## 🚀 Features

- **User Authentication**: Register, login, and manage your own poster projects.
- **Project Dashboard**: View, create, delete, and select poster templates.
- **Live Editing**: Real-time poster preview and autosave powered by Laravel Livewire.
- **Templates**: 5 built‑in poster designs (template-1 through template-5).
- **Image Import**: Upload your pet’s photo and fit it into the template.
- **Automatic Thumbnails**: Generate and store 50% scaled poster thumbnails.
- **Export Options**:
    - **PNG**: High‑resolution raster export.
    - **PDF**: Print-ready document export.
    

---

## ⚙️ Quick Setup

1. **Clone the repository**
    
    ```bash
    git clone https://github.com/benny-18/Petify.git
    cd petify
    
    ```
    
2. **Docker Compose**
    
    ```bash
    docker compose up -d --build
    
    ```
    
3. **Access the app** at `http://localhost:8000`

---

## 🗂️ Directory Structure (key files)

```
/laravel
├── app/
│   ├── Http/Controllers/
│   │   ├── ProjectController.php
│   │   └── UserController.php
│   ├── Livewire/PosterEditor.php
│   ├── Models/Project.php
│   └── Models/User.php
├── database/
│   ├── migrations/
│   │   └── *_create_projects_table.php
│   └── seeders/DatabaseSeeder.php
├── public/
│   ├── css/editor.css
│   ├── js/editor.js
│   └── images/templates/
│       ├── template-1.png
│       └── thumbs/
├── resources/views/
│   ├── dashboard.blade.php
│   ├── editor.blade.php
│   └── livewire/poster-templates/
│       ├── template-1.blade.php
│       └── template-2.blade.php
├── routes/web.php
└── docker-compose.yml

```

> Many more configuration, assets, and helper files can be found in the project root.
> 

---

## 🔧 Usage

1. **Register** an account or **login**.
2. **Create** a new project by providing a title and description.
3. **Choose** a template from the sidebar.
4. **Upload** your pet photo and fill in details (name, age, breed, contact info).
5. **Watch** the live preview update automatically.
6. **Save & Download** in your desired format (PNG, PDF).

---

## 🛠️ Technology Stack

- **Backend**: Laravel 10, Livewire
- **Frontend**: Blade, Vanilla JavaScript, SweetAlert2
- **Image Export**: dom-to-image-more, jsPDF
- **Containerization**: Docker, docker-compose
- **Database**: MySQL (via Docker)

---

Made with 💛 by Petify devs <3

Happy pet poster making!
