-- ======================================================
-- 🧬 ARCHIVO DE BASE DE DATOS: X-MEN RELACIONAL
-- EXPLICACIÓN DE JOINS Y ESTRUCTURA PROFESIONAL
-- ======================================================

-- 1. CREACIÓN DE LA BASE DE DATOS
CREATE DATABASE IF NOT EXISTS xmen_pro;
USE xmen_pro;

-- 2. TABLA DE EQUIPOS (Relación 1 a Muchos con Mutantes)
-- Un equipo tiene muchos mutantes, un mutante pertenece a un equipo.
CREATE TABLE IF NOT EXISTS equipos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_equipo VARCHAR(100) NOT NULL
);

-- 3. TABLA PRINCIPAL DE MUTANTES
CREATE TABLE IF NOT EXISTS mutantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_clave VARCHAR(100) NOT NULL,
    nombre_real VARCHAR(100),
    altura VARCHAR(50),
    bio TEXT,
    imagen LONGBLOB, -- Guardamos la imagen en binario
    equipo_id INT, -- LLAVE FORÁNEA (Relación)
    FOREIGN KEY (equipo_id) REFERENCES equipos(id) ON DELETE SET NULL
);

-- 4. TABLA DE PODERES (Muchos a Muchos con Mutantes)
-- Un mutante tiene muchos poderes, y un poder puede ser compartido por muchos mutantes.
CREATE TABLE IF NOT EXISTS poderes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_poder VARCHAR(100) NOT NULL
);

-- 5. TABLA INTERMEDIA (Tabla de Relación)
-- Relaciona Mutantes con Poderes (Normalización profesional)
CREATE TABLE IF NOT EXISTS mutante_poderes (
    mutante_id INT,
    poder_id INT,
    PRIMARY KEY (mutante_id, poder_id),
    FOREIGN KEY (mutante_id) REFERENCES mutantes(id) ON DELETE CASCADE,
    FOREIGN KEY (poder_id) REFERENCES poderes(id) ON DELETE CASCADE
);

-- ======================================================
-- 📊 EXPLICACIÓN DE LOS JOINS (UNIONES)
-- ======================================================
/*
    ¿POR QUÉ USAMOS UNIONES? 
    En bases de datos profesionales, no guardamos todo en una sola tabla (eso se llama "desnormalizado").
    Dividimos la info en tablas pequeñas y las "unimos" cuando las necesitamos.

    1. INNER JOIN (La unión estricta):
       - Solo devuelve filas cuando hay una coincidencia en AMBAS tablas.
       - Ejemplo: Si quieres ver solo los mutantes que SÍ tienen un equipo asignado.
       - SELECT * FROM mutantes INNER JOIN equipos ON mutantes.equipo_id = equipos.id;

    2. LEFT JOIN (La unión inclusiva izquierda):
       - Devuelve TODOS los registros de la tabla de la izquierda (mutantes), 
         incluso si no tienen nada en la derecha (equipos).
       - Ejemplo: Quieres ver a TODOS los mutantes, y si alguno no tiene equipo, que salga vacío.
       - SELECT * FROM mutantes LEFT JOIN equipos ON mutantes.equipo_id = equipos.id;

    3. RIGHT JOIN (La unión inclusiva derecha):
       - Es lo contrario al LEFT JOIN. Devuelve todos los de la derecha (equipos), 
         incluso si no tiene mutantes registrados.
       - Ejemplo: Quieres ver todos los equipos registrados, aunque estén vacíos.
       - SELECT * FROM mutantes RIGHT JOIN equipos ON mutantes.equipo_id = equipos.id;
*/

-- ======================================================
-- 📝 INSERCIÓN DE DATOS INICIALES (SEMILLAS)
-- ======================================================

-- Insertar Equipos
INSERT INTO equipos (nombre_equipo) VALUES ('X-Men'), ('Brotherhood'), ('New Mutants'), ('X-Force');

-- Insertar Poderes
INSERT INTO poderes (nombre_poder) VALUES ('Telepatía'), ('Regeneración'), ('Garras de Adamantium'), ('Magnetismo'), ('Láser Óptico'), ('Clima');

-- Insertar algunos Mutantes
INSERT INTO mutantes (nombre_clave, nombre_real, altura, bio, equipo_id) VALUES 
('Wolverine', 'Logan', '1.60m', 'Ermitaño canadiense con garras ocultas.', 1),
('Magneto', 'Erik Lehnsherr', '1.88m', 'Maestro del magnetismo.', 2),
('Cyclops', 'Scott Summers', '1.90m', 'Líder táctico de los X-Men.', 1),
('Storm', 'Ororo Munroe', '1.80m', 'Diosa del clima.', 1);

-- Relacionar Poderes (Muchos a Muchos)
-- Wolverine (ID 1) tiene Regeneración (ID 2) y Garras (ID 3)
INSERT INTO mutante_poderes (mutante_id, poder_id) VALUES (1, 2), (1, 3);
-- Magneto (ID 2) tiene Magnetismo (ID 4)
INSERT INTO mutante_poderes (mutante_id, poder_id) VALUES (2, 4);
-- Storm (ID 4) tiene Clima (ID 6)
INSERT INTO mutante_poderes (mutante_id, poder_id) VALUES (4, 6);
