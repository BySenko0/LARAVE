<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AlumnoController;

Route::get('/', function () {
    $alumnos = DB::select("
        SELECT persona.*, carrera.nombre AS carrera 
        FROM persona
        INNER JOIN carrera ON persona.carrera_id = carrera.id
    ");

    $carreras = DB::table('carrera')->get(); // Obtener todas las carreras

    return view('index', compact('alumnos', 'carreras'));
});

Route::get('/alumno/{id}', [AlumnoController::class, 'perfil'])->name('alumno.perfil');
Route::post('/alumnos/store', [AlumnoController::class, 'store'])->name('alumnos.store');
