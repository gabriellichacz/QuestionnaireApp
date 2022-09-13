<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Widoki

## resources/views
Widoki standardowego użytkownika.

## resources/views/admin
Widoki panelu administratora. W /components znajdują sie mniejsze komponenty takie jak dodawanie nowej ankiety.

## resources/views/layouts
Głowny układ aplikacji. W /components znajdują sie mniejsze komponenty takie jak nawigacja.

# Kontrolery

## app/Http/Controllers/Controller.php
Kontroler odpowiadający za logikę widoku niezalogowanego gościa.

## app/Http/Controllers/HomeController.php
Kontroler odpowiadający za logikę widoku standardowego użytkownika.

## app/Http/Controllers/AdminHomeController.php
Kontroler odpowiadający za logikę widoku administratora.

# Middleware

## database/migrations/2014_10_12_000000_create_users_table.php
W migracji tworzącej tabelę 'Users' dodana kolumna 'Admin' przyjmująca wartość boolean (z wartością domyślną 'false').

## app/Http/Middleware/Admin.php
Główny plik, odpowiadający za logikę zabezpieczenia.

## app/Models/User.php
W modelu użytkownika dodana funkcja isAdmin(), która sprawdza czy dany użytkownik ma w tabeli wartośc 'true' w kolumnie 'admin'.

## app/Http/Kernel.php
W 'protected $routeMiddleware' dodany wpis o nowym middleware dotyczącym zabezpieczeń administratora.

# Plan
Rejestracja w tabeli 'polls' pustych ankiet.
W kolejnej tabeli informacje o polach w danej ankiecie.
Inna tabela do zapisywania wyników ankiety danego użytkownika i wyników ogólnych ankiety (albo zrobienie podsumowania w kontrolerze).