<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marvel v2 - Base de Datos Extendida</title>
    <style>
        :root {
            --marvel-red: #e23636;
            --marvel-blue: #0082c8;
            --dark-bg: #121212;
            --card-bg: #1e1e1e;
            --gold: #f6a700;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--dark-bg);
            color: #ffffff;
            margin: 0;
            padding: 20px;
            background-image: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), url('https://w0.peakpx.com/wallpaper/312/1018/HD-wallpaper-marvel-comics-logo-marvel-characters.jpg');
            background-attachment: fixed;
            background-size: cover;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        header {
            text-align: center;
            padding: 40px 0;
            border-bottom: 4px solid var(--marvel-red);
            margin-bottom: 40px;
            background: rgba(0,0,0,0.6);
            border-radius: 10px;
        }

        h1 {
            font-size: 3em;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 0;
            color: white;
            text-shadow: 2px 2px var(--marvel-red);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 25px;
        }

        .card {
            background: var(--card-bg);
            border-radius: 15px;
            overflow: hidden;
            border: 1px solid #333;
            transition: transform 0.3s ease;
            box-shadow: 0 10px 20px rgba(0,0,0,0.5);
            display: flex;
            flex-direction: column;
        }

        .card:hover {
            transform: translateY(-5px);
            border-color: var(--gold);
        }

        .card-header {
            background: var(--marvel-red);
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h2 {
            margin: 0;
            font-size: 1.4em;
            color: white;
        }

        .alias {
            font-style: italic;
            opacity: 0.9;
            font-size: 0.9em;
        }

        .card-body {
            padding: 20px;
            flex-grow: 1;
        }

        .section-title {
            color: var(--gold);
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            text-transform: uppercase;
            font-size: 0.8em;
            border-bottom: 1px solid #444;
            padding-bottom: 3px;
            margin-top: 15px;
        }

        .info-group {
            margin-bottom: 15px;
        }

        .pill {
            display: inline-block;
            background: #333;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.85em;
            margin: 2px;
            border: 1px solid #555;
        }

        .pill-power { background: #4a148c; }
        .pill-team { background: #01579b; }
        .pill-origin { background: #1b5e20; }

        .description {
            font-size: 0.95em;
            line-height: 1.4;
            color: #ccc;
        }

        .stats {
            display: flex;
            justify-content: space-between;
            background: rgba(0,0,0,0.3);
            padding: 10px;
            border-radius: 8px;
            margin-top: 10px;
        }

        .stat-item {
            text-align: center;
            font-size: 0.8em;
        }

        .stat-value {
            display: block;
            font-weight: bold;
            color: var(--gold);
        }

        .rivals {
            background: #2c0a0a;
            padding: 10px;
            border-radius: 5px;
            font-size: 0.9em;
            margin-top: 10px;
            border-left: 3px solid #ff4444;
        }

        footer {
            text-align: center;
            padding: 40px;
            color: #666;
            font-size: 0.8em;
        }
    </style>
</head>
<body>

<div class="container">
    <header>
        <h1>Marvel Database v2</h1>
        <p>Sistema Avanzado de Relaciones y Entidades</p>
    </header>

    <div class="grid">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "marvel";

        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("<div class='card' style='padding:20px; background:red;'>Error de conexión: " . $conn->connect_error . "</div>");
        }

        // Consulta SQL Avanzada usando GROUP_CONCAT para agrupar múltiples relaciones en una sola fila por personaje
        /*¿Por qué se hizo así? (Los 4 pilares de esta consulta)
1. Evitar la "Repetición de Filas" con GROUP_CONCAT
Si hiciéramos un SELECT normal con JOIN, y Spider-Man tuviera 3 poderes, la base de datos nos devolvería 3 filas iguales de Spider-Man (una por cada poder).

La solución: GROUP_CONCAT toma todos esos poderes y los "comprime" en una sola celda de texto separada por comas. Así, Spider-Man ocupa una sola fila en el resultado, facilitando mucho el diseño de las tarjetas en PHP.
2. El uso de LEFT JOIN en lugar de JOIN normal
Si usáramos un INNER JOIN (el normal), y un personaje no tuviera equipo o poderes registrados, ¡ese personaje desaparecería de la lista!

La solución: LEFT JOIN le dice a la base de datos: "Tráeme al personaje aunque no tenga nada en la otra tabla (ponlo como NULL si es necesario)". Esto asegura que veamos a todos los héroes, tengan o no relaciones completas.
3. El GROUP BY p.PersonajeID
Esta es la instrucción que acompaña a GROUP_CONCAT. Le dice a MySQL: "Agrupa todo lo que encuentres, pero hazlo persona por persona". Sin esto, la consulta daría un error o mezclaría los poderes de todos los héroes en un solo bloque.

4. La Subconsulta para los Rivales (Correlated Subquery)
Esta es la parte más avanzada: (SELECT ... WHERE en.HeroeID = p.PersonajeID).

El problema: La tabla Enemistades relaciona a un personaje de la tabla Personajes con otro personaje de la misma tabla.
La solución: Creamos una "mini-consulta" dentro del SELECT que busca específicamente quién es el villano de ese héroe en particular en ese momento. Además, usamos CONCAT para juntar el nombre del rival con el motivo de la pelea entre paréntesis.
Resumen del beneficio:
Velocidad: Haces una sola petición al servidor de base de datos para traerlo TODO.
Limpieza en PHP: En tu código PHP, no tienes que hacer bucles raros para limpiar datos duplicados; cada fila que recibes es un superhéroe listo para ser mostrado.
Flexibilidad: Si añades 10 poderes más a Iron Man, la consulta seguirá funcionando igual de bien, solo que la celda de "Poderes" será más larga.*/
        $sql = "SELECT 
                    p.PersonajeID,
                    p.NombreReal,
                    p.Alias,
                    p.Descripcion,
                    p.FechaDeCreacion,
                    o.Tipo AS Origen,
                    u.Nombre AS Ubicacion,
                    GROUP_CONCAT(DISTINCT s.Nombre SEPARATOR ', ') AS Poderes,
                    GROUP_CONCAT(DISTINCT e.Nombre SEPARATOR ', ') AS Equipos,
                    (SELECT GROUP_CONCAT(CONCAT(p2.Alias, ' (', en.Motivo, ')') SEPARATOR ' | ') 
                     FROM Enemistades en 
                     JOIN Personajes p2 ON en.VillanoID = p2.PersonajeID 
                     WHERE en.HeroeID = p.PersonajeID) AS Rivales
                FROM Personajes p
                LEFT JOIN Origenes o ON p.OrigenID = o.OrigenID
                LEFT JOIN Ubicaciones u ON p.UbicacionOrigenID = u.UbicacionID
                LEFT JOIN PersonajeSuperpoder ps ON p.PersonajeID = ps.PersonajeID
                LEFT JOIN Superpoderes s ON ps.SuperpoderID = s.SuperpoderID
                LEFT JOIN PersonajeEquipo pe ON p.PersonajeID = pe.PersonajeID
                LEFT JOIN Equipos e ON pe.EquipoID = e.EquipoID
                GROUP BY p.PersonajeID";

        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?>
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h2><?php echo $row['Alias']; ?></h2>
                            <span class="alias"><?php echo $row['NombreReal']; ?></span>
                        </div>
                        <span class="pill pill-origin"><?php echo $row['Origen'] ?? 'Desconocido'; ?></span>
                    </div>
                    
                    <div class="card-body">
                        <div class="description">
                            <?php echo $row['Descripcion']; ?>
                        </div>

                        <span class="section-title">Poderes</span>
                        <div class="info-group">
                            <?php 
                            $poderes = explode(', ', $row['Poderes']);
                            foreach($poderes as $p) if($p) echo "<span class='pill pill-power'>$p</span>";
                            ?>
                        </div>

                        <span class="section-title">Equipos / Afiliaciones</span>
                        <div class="info-group">
                            <?php 
                            $equipos = explode(', ', $row['Equipos']);
                            foreach($equipos as $e) if($e) echo "<span class='pill pill-team'>$e</span>";
                            else if(!$row['Equipos']) echo "<span class='alias'>Sin equipo actual</span>";
                            ?>
                        </div>

                        <div class="stats">
                            <div class="stat-item">
                                <span class="stat-value"><?php echo $row['Ubicacion'] ?? 'N/A'; ?></span>
                                Base
                            </div>
                            <div class="stat-item">
                                <span class="stat-value"><?php echo date('Y', strtotime($row['FechaDeCreacion'])); ?></span>
                                Debut
                            </div>
                        </div>

                        <?php if($row['Rivales']): ?>
                            <span class="section-title">Enemistades Clave</span>
                            <div class="rivals">
                                ⚔️ <?php echo $row['Rivales']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>No hay datos disponibles en la nueva estructura. Asegúrate de ejecutar el archivo SQL v2 primero.</p>";
        }
        $conn->close();
        ?>
    </div>
</div>

<footer>
    Base de Datos Marvel Pro v2.0 - Desarrollado para gestión de multiversos.
</footer>

</body>
</html>
