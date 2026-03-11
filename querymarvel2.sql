-- ***************************************************************
-- BASE DE DATOS MÁS COMPLETA DE MARVEL (EXTENDIDA)
-- ***************************************************************

-- 1. Tablas Maestras (Entidades Principales)

-- Tabla de Orígenes (Para clasificar cómo obtuvieron sus poderes)
CREATE TABLE Origenes (
    OrigenID INT AUTO_INCREMENT PRIMARY KEY,
    Tipo VARCHAR(50) NOT NULL, -- Ej: Mutación, Tecnología, Místico, Radiación
    Descripcion TEXT
);

-- Tabla de Ubicaciones (Lugares icónicos)
CREATE TABLE Ubicaciones (
    UbicacionID INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(100) NOT NULL, -- Ej: Wakanda, Asgard, Nueva York
    Clima VARCHAR(50),
    Descripcion TEXT
);

-- Tabla de Personajes (Mejorada con FK a Origen y Ubicación)
CREATE TABLE Personajes (
    PersonajeID INT AUTO_INCREMENT PRIMARY KEY,
    NombreReal VARCHAR(100) NOT NULL,
    Alias VARCHAR(50) NOT NULL,
    FechaDeCreacion DATE,
    OrigenID INT,
    UbicacionOrigenID INT,
    Descripcion TEXT,
    FOREIGN KEY (OrigenID) REFERENCES Origenes(OrigenID),
    FOREIGN KEY (UbicacionOrigenID) REFERENCES Ubicaciones(UbicacionID)
);

-- Tabla de Equipos (Filiaciones)
CREATE TABLE Equipos (
    EquipoID INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(100) NOT NULL, -- Ej: Avengers, X-Men, Fantastic Four
    Fundacion DATE,
    BaseOperaciones INT,
    FOREIGN KEY (BaseOperaciones) REFERENCES Ubicaciones(UbicacionID)
);

-- Tabla de Superpoderes
CREATE TABLE Superpoderes (
    SuperpoderID INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(50) NOT NULL,
    NivelDePoder INT, -- Escala del 1 al 10
    Descripcion TEXT
);

-- Tabla de Cómics
CREATE TABLE Comics (
    ComicID INT AUTO_INCREMENT PRIMARY KEY,
    Titulo VARCHAR(100) NOT NULL,
    AnioPublicacion YEAR,
    ISBN VARCHAR(20),
    Descripcion TEXT
);

-- Tabla de Películas (Universo Cinematográfico o Animación)
CREATE TABLE Peliculas (
    PeliculaID INT AUTO_INCREMENT PRIMARY KEY,
    Titulo VARCHAR(150) NOT NULL,
    AnioEstreno YEAR,
    Director VARCHAR(100),
    FaseMCU INT -- Opcional para el MCU
);

-- 2. Tablas de Relación (Muchos a Muchos)

-- Relación Personaje - Equipo (Un personaje puede estar en varios equipos)
CREATE TABLE PersonajeEquipo (
    PersonajeID INT,
    EquipoID INT,
    Rol VARCHAR(50), -- Ej: Líder, Miembro, Reserva
    PRIMARY KEY (PersonajeID, EquipoID),
    FOREIGN KEY (PersonajeID) REFERENCES Personajes(PersonajeID),
    FOREIGN KEY (EquipoID) REFERENCES Equipos(EquipoID)
);

-- Relación Personaje - Superpoder
CREATE TABLE PersonajeSuperpoder (
    PersonajeID INT,
    SuperpoderID INT,
    PRIMARY KEY (PersonajeID, SuperpoderID),
    FOREIGN KEY (PersonajeID) REFERENCES Personajes(PersonajeID),
    FOREIGN KEY (SuperpoderID) REFERENCES Superpoderes(SuperpoderID)
);

-- Relación Personaje - Comic (Apariciones)
CREATE TABLE PersonajeComic (
    PersonajeID INT,
    ComicID INT,
    EsProtagonista BOOLEAN DEFAULT FALSE,
    PRIMARY KEY (PersonajeID, ComicID),
    FOREIGN KEY (PersonajeID) REFERENCES Personajes(PersonajeID),
    FOREIGN KEY (ComicID) REFERENCES Comics(ComicID)
);

-- Relación Personaje - Película
CREATE TABLE PersonajePelicula (
    PersonajeID INT,
    PeliculaID INT,
    Actor VARCHAR(100),
    PRIMARY KEY (PersonajeID, PeliculaID),
    FOREIGN KEY (PersonajeID) REFERENCES Personajes(PersonajeID),
    FOREIGN KEY (PeliculaID) REFERENCES Peliculas(PeliculaID)
);

-- Relación Rivales (Muchos a Muchos entre los mismos Personajes)
CREATE TABLE Enemistades (
    HeroeID INT,
    VillanoID INT,
    Motivo TEXT,
    PRIMARY KEY (HeroeID, VillanoID),
    FOREIGN KEY (HeroeID) REFERENCES Personajes(PersonajeID),
    FOREIGN KEY (VillanoID) REFERENCES Personajes(PersonajeID)
);

-- 3. Inserción de Datos Iniciales

-- Orígenes
INSERT INTO Origenes (Tipo, Descripcion) VALUES 
('Radiación/Accidente', 'Poderes obtenidos por exposición a radiación o accidentes químicos'),
('Tecnología', 'Uso de armaduras, armas o implantes cibernéticos'),
('Mutación Natural', 'Nacido con el Gen X'),
('Deidad/Místico', 'Proveniente de otros planos o dioses'),
('Suero/Mejora', 'Mejoras biológicas artificiales');

-- Ubicaciones
INSERT INTO Ubicaciones (Nombre, Clima, Descripcion) VALUES 
('Nueva York', 'Templado', 'Hogar de la mayoría de héroes urbanos'),
('Wakanda', 'Tropical', 'Nación tecnológicamente avanzada en África'),
('Asgard', 'Mágico', 'Reino de los dioses nórdicos'),
('Latveria', 'Frío', 'Reino regido por el Doctor Doom'),
('Torre Avengers', 'Climatizado', 'Base oficial en Manhattan');

-- Superpoderes
INSERT INTO Superpoderes (Nombre, NivelDePoder, Descripcion) VALUES 
('Fuerza Sobrehumana', 8, 'Capacidad física extrema'),
('Sentido Arácnido', 7, 'Precognición de peligro'),
('Vuelo', 6, 'Capacidad de desplazarse por el aire'),
('Genio Intelecto', 10, 'Habilidad mental superior'),
('Telepatía', 9, 'Lectura y control de mentes');

-- Personajes
INSERT INTO Personajes (NombreReal, Alias, FechaDeCreacion, OrigenID, UbicacionOrigenID, Descripcion) VALUES 
('Peter Parker', 'Spider-Man', '1962-08-01', 1, 1, 'El vecino amistoso'),
('Tony Stark', 'Iron Man', '1963-03-01', 2, 1, 'El genio en la armadura'),
('T''Challa', 'Black Panther', '1966-07-01', 5, 2, 'Rey de Wakanda'),
('Thor Odinson', 'Thor', '1962-08-01', 4, 3, 'Dios del Trueno'),
('Victor von Doom', 'Dr. Doom', '1962-07-01', 4, 4, 'Soberano de Latveria y archienemigo de los 4 Fantásticos');

-- Equipos
INSERT INTO Equipos (Nombre, Fundacion, BaseOperaciones) VALUES 
('Avengers', '1963-09-01', 5),
('Illuminati', '2005-01-01', 1),
('Fantastic Four', '1961-11-01', 1);

-- Relacionar Personajes con Poderes
INSERT INTO PersonajeSuperpoder (PersonajeID, SuperpoderID) VALUES 
(1, 2), -- Spidey -> Sentido Arácnido
(2, 4), -- Tony -> Genio
(3, 1), -- Panther -> Fuerza
(4, 3), -- Thor -> Vuelo
(5, 4); -- Doom -> Genio

-- Relacionar Personajes con Equipos
INSERT INTO PersonajeEquipo (PersonajeID, EquipoID, Rol) VALUES 
(2, 1, 'Líder'), -- Tony en Avengers
(3, 1, 'Miembro'), -- Panther en Avengers
(2, 2, 'Fundador'); -- Tony en Illuminati

-- Enemistades
INSERT INTO Enemistades (HeroeID, VillanoID, Motivo) VALUES 
(1, 5, 'Doom intentó conquistar el mundo y Spidey ayudó a detenerlo'),
(4, 5, 'Choque de egos y poder cósmico');

-- Películas
INSERT INTO Peliculas (Titulo, AnioEstreno, Director, FaseMCU) VALUES 
('Iron Man', 2008, 'Jon Favreau', 1),
('The Avengers', 2012, 'Joss Whedon', 1),
('Black Panther', 2018, 'Ryan Coogler', 3);

-- Relación Personaje - Película
INSERT INTO PersonajePelicula (PersonajeID, PeliculaID, Actor) VALUES 
(2, 1, 'Robert Downey Jr.'),
(2, 2, 'Robert Downey Jr.'),
(3, 3, 'Chadwick Boseman');
