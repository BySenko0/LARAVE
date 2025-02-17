<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Alumno</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-300">
    <div class="max-w-5xl mx-auto p-6 bg-white shadow-lg mt-10 rounded-lg">
        <h1 class="text-5xl font-bold text-center text-teal-700">Perfil Alumno</h1>
        
        <div class="flex justify-between mt-4">
            <div class="w-1/3 p-4 bg-gray-100 rounded-lg">
                <img src="https://cdn-icons-png.flaticon.com/512/147/147144.png" class="w-32 mx-auto">
                <p><strong>Matrícula:</strong> {{ $alumno->matricula }}</p>
                <p><strong>Nombre:</strong> {{ $alumno->nombre }} {{ $alumno->apellidoP }} {{ $alumno->apellidoM }}</p>
                <p><strong>Fecha de Nacimiento:</strong> {{ $alumno->fecha_nacimiento }}</p>
                <p><strong>Carrera:</strong> {{ $alumno->carrera }}</p>
                <p><strong>Cuatrimestre:</strong> {{ $alumno->cuatrimestre }}</p>

                <div class="flex justify-between mt-4">
                    <button class="bg-yellow-400 text-white px-4 py-2 rounded">✎ Editar Datos</button>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded">📚 Asignaturas</button>
                </div>
            </div>

            <div class="w-2/3 bg-white p-4 rounded-lg">
                <h2 class="text-xl font-bold text-center">Calificaciones</h2>
                
                <table class="w-full mt-4 border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">Asignatura</th>
                            <th class="border p-2">Primer Parcial</th>
                            <th class="border p-2">Segundo Parcial</th>
                            <th class="border p-2">Tercer Parcial</th>
                            <th class="border p-2">Probabilidad de Pasar</th>
                            <th class="border p-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($calificaciones as $cal)
                        <tr class="border text-center">
                            <td class="border p-2">{{ $cal->materia }}</td>
                            <td class="border p-2"><input type="text" value="{{ $cal->parcial1 }}" class="w-16 border"></td>
                            <td class="border p-2"><input type="text" value="{{ $cal->parcial2 }}" class="w-16 border"></td>
                            <td class="border p-2"><input type="text" value="{{ $cal->parcial3 }}" class="w-16 border"></td>
                            <td class="border p-2">
                                @php
                                    $promedio = ($cal->parcial1 + $cal->parcial2 + $cal->parcial3) / 3;
                                    $probabilidad = ($promedio >= 8) ? "100%" : (($promedio >= 6) ? "Presentar Final" : "Reprobado");
                                @endphp
                                <span class="bg-gray-200 px-2 py-1 rounded">{{ $probabilidad }}</span>
                            </td>
                            <td class="border p-2">
                                <button class="bg-blue-500 text-white px-4 py-1 rounded">🔄 Actualizar</button>
                                <button class="bg-red-500 text-white px-4 py-1 rounded">🗑 Eliminar</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <p class="mt-4 text-center">
                    <strong>Probabilidad de pasar el cuatrimestre:</strong> 
                    <span class="bg-gray-200 px-2 py-1 rounded">
                        @php
                            $totalPromedios = 0;
                            $totalMaterias = count($calificaciones);
                            foreach ($calificaciones as $cal) {
                                $totalPromedios += ($cal->parcial1 + $cal->parcial2 + $cal->parcial3) / 3;
                            }
                            echo ($totalMaterias > 0) ? round(($totalPromedios / $totalMaterias), 2) . "%" : "N/A";
                        @endphp
                    </span>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
