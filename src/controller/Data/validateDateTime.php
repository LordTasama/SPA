<?php
date_default_timezone_set("America/Bogota");
session_start();
require_once '../../config/mysql.php';
$mysql = new Mysql;

if (
    isset($_SESSION['id']) && isset($_SESSION['correo']) && isset($_SESSION['password']) &&
    isset($_SESSION['login'])
) {
    $id = $_SESSION['id'];
    $mysql->conectar();
    $rol = $_SESSION['rol'] ;

    $stmt = $mysql->consulta("SELECT id_rol, estado FROM usuario where id = ?", [$id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (count($result) == 2) {
        if ($result['estado'] == 1 && ($result['id_rol'] == 1 || $result['id_rol'] == 2)) {
        
        // Obtener información de los terapeutas y sus horarios
    $mysql->conectar();
    $terapeutas = $mysql->consulta("SELECT t.id, t.nombres, t.apellidos, t.hora_inicio, t.hora_fin, s.duracion, c.fecha
        FROM terapeuta t
        JOIN servicio s ON t.id = s.id_terapeuta
        LEFT JOIN cita c ON s.id = c.id_servicio");

    $terapeutaData = [];
    foreach ($terapeutas as $row) {
        $terapeutaId = $row['id'];
        if (!isset($terapeutaData[$terapeutaId])) {
            $terapeutaData[$terapeutaId] = [
                'nombres' => $row['nombres'],
                'apellidos' => $row['apellidos'],
                'hora_inicio' => $row['hora_inicio'],
                'hora_fin' => $row['hora_fin'],
                'duracion' => $row['duracion'],
                'citas' => []
            ];
        }
        if ($row['fecha']) {
            $terapeutaData[$terapeutaId]['citas'][] = $row['fecha'];
        }
    }

    // Calcular las horas no disponibles basado en la duración de los servicios y las citas
    $disabledDates = [];
    foreach ($terapeutaData as $terapeuta) {
        $duracion = $terapeuta['duracion'];
        // Convertir la duración a minutos
        list($duracionMinutos) = explode(' ', $duracion);
        foreach ($terapeuta['citas'] as $cita) {
            $inicio = new DateTime($cita);
            $fin = clone $inicio;
            $fin->modify("+$duracionMinutos minutes");

            // Añadir el rango de tiempo no disponible
            $intervalo = new DateInterval('PT1M');
            $periodo = new DatePeriod($inicio, $intervalo, $fin);
            foreach ($periodo as $fecha) {
                $fechaFormateada = $fecha->format('Y-m-d\TH:i');
                if (!in_array($fechaFormateada, $disabledDates)) {
                    $disabledDates[] = $fechaFormateada;
                }
            }
        }
    }

    // Eliminar fechas duplicadas
    $disabledDates = array_unique($disabledDates);

    // Simulación de obtención de datos desde la base de datos
    $availableDateTime = [          
        "minDate" => date('Y-m-d\TH:i'), // Fecha y hora actual como mínima
   /*      "maxDate" => date('Y-m-d\TH:i', strtotime('+1 week')), // Una semana a partir de la fecha y hora actual como máxima */
        "disabledDates" => $disabledDates, // Fechas y horas no disponibles
    ];

    // Devolver los datos como JSON
    echo json_encode($availableDateTime);
    }
    }
    else{
        session_destroy();
        echo '{"data":"¿Cómo accediste aquí?, vete.","response":"error"}';
        exit;
        }
    }
    else{
        session_destroy();
        echo '{"data":"No deberías estar aquí, vete e inicia sesión correctamente...","response":"error"}';
        exit;
        }
