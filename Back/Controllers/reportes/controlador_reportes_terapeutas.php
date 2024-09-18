<?php
include('../../Model/conexion.php');

$conexion = new Conexion();

try {
    $consulta = "WITH horarios_laborales AS (
    SELECT 
        t.id AS TerapeutaID,
        t.nombre,
        t.apellido,
        DATE_FORMAT(c.fecha, '%Y-%m-%d') AS Fecha,
        TIME('09:00:00') AS Inicio_Laboral,
        TIME('18:00:00') AS Fin_Laboral
    FROM terapeutas t
    LEFT JOIN citas c ON t.id = (SELECT s.id_Terapeuta FROM servicios s WHERE s.id = c.id_Servicio LIMIT 1)
    GROUP BY t.id, Fecha
),
horas_ocupadas AS (
    SELECT 
        t.id AS TerapeutaID,
        CONCAT(t.nombre, ' ', t.apellido) AS Terapeuta,
        c.fecha AS Fecha,
        TIME_FORMAT(c.hora_Inicio, '%H:%i') AS Hora_Inicio,
        TIME_FORMAT(c.hora_Fin, '%H:%i') AS Hora_Fin
    FROM terapeutas t
    JOIN servicios s ON t.id = s.id_Terapeuta
    JOIN citas c ON s.id = c.id_Servicio
),
horas_disponibles AS (
    SELECT 
        h.TerapeutaID,
        h.nombre,
        h.apellido,
        h.Fecha,
        h.Inicio_Laboral,
        h.Fin_Laboral,
        GROUP_CONCAT(
            CASE
                WHEN h.Fecha = o.Fecha THEN CONCAT(TIME_FORMAT(o.Hora_Inicio, '%H:%i'), '-', TIME_FORMAT(o.Hora_Fin, '%H:%i'))
                ELSE NULL
            END 
            ORDER BY o.Hora_Inicio SEPARATOR '; '
        ) AS Horarios_Ocupados
    FROM horarios_laborales h
    LEFT JOIN horas_ocupadas o ON h.TerapeutaID = o.TerapeutaID AND h.Fecha = o.Fecha
    GROUP BY h.TerapeutaID, h.Fecha
)
SELECT 
    d.TerapeutaID,
    CONCAT(d.nombre, ' ', d.apellido) AS Terapeuta,
    d.Fecha,
    d.Inicio_Laboral,
    d.Fin_Laboral,
    d.Horarios_Ocupados,
    CONCAT(
        TIME_FORMAT(d.Inicio_Laboral, '%H:%i'), 
        '-', 
        COALESCE(
            SUBSTRING_INDEX(d.Horarios_Ocupados, ';', 1), 
            TIME_FORMAT(d.Fin_Laboral, '%H:%i')
        )
    ) AS Horarios_Disponibles
FROM 
    horas_disponibles d
ORDER BY 
    d.TerapeutaID, d.Fecha;
";
    $clientes = $conexion->ConsultaCompleja($consulta);
    echo json_encode($clientes);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
