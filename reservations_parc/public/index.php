<?php
session_start();

// Inclure les fichiers essentiels
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/core/Router.php';

// Autoload pour modèles et contrôleurs
spl_autoload_register(function ($class) {
    // Charger les modèles
    if (file_exists(__DIR__ . "/../app/models/$class.php")) {
        require __DIR__ . "/../app/models/$class.php";
    }

    // Charger les contrôleurs
    if (file_exists(__DIR__ . "/../app/controllers/$class.php")) {
        require __DIR__ . "/../app/controllers/$class.php";
    }
});

// Lancer le router
Router::run();