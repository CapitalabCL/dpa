# División política administrativa de Chile

Paquete laravel que contiene las tablas, modelos y datos con la división política administrativa de Chile. Regiones, provincias y comunas.


## Instalación

Instala DPA con composer:

```bash
composer require capitalab/dpa
```

Publica migraciones (opcional)

```
php artisan vendor:publish --tag="dpa.migrations"
```

Corre las migraciones

```
php artisan migrate
```

Cargar datos de regiones, provincias y comunas

```
php artisan dpa:seed
```

## Uso


```php
use Capitalab\DPA\Region;
use Capitalab\DPA\Provincia;
use Capitalab\DPA\Comuna;

public function index()
{
    $regiones = Region::all();
 
    // Regiones con provincias y comunas   
    $regiones = Region::with('provincias.comunas')->get();
    
    // Regiones con sus comunas   
    $regiones = Region::with('comunas')->get();
    
    $rm = Region::where('nombre', '=', 'Región Metropolitana de Santiago')->first();
    
    // O si vives en los 90'
    $rm = Region::where('ordinal', '=', 'RM')->first();
    
    // Comunas de una región
    $comunasRM = $rm->comunas;
    
    $provinciaStgo = Provincia::where('nombre', '=', 'Santiago')->with('comunas')->first();
    $comunasStgo = $provinciaStgo->comunas;

    $providencia = Comuna::where('nombre', '=', 'Providencia')->first();
    $providencia->region; // Región Metropolitana de Santiago
}
```
