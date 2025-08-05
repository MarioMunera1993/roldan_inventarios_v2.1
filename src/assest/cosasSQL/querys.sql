--######################################### Tablas normalizadas #########################################

create database inventario_tecnologico_prueba
create database inventario_tecnologico

--######################################### CRUDS Marcas #########################################

-- Tabla de marcas
CREATE TABLE Marcas (
    IdMarca INT PRIMARY KEY IDENTITY(1,1),
    Nombre VARCHAR(50) NOT NULL
);

-- Inserts para la tabla Marcas
INSERT INTO Marcas (Nombre) VALUES ('HP');          -- Hewlett-Packard
INSERT INTO Marcas (Nombre) VALUES ('Dell');
INSERT INTO Marcas (Nombre) VALUES ('Lenovo');
INSERT INTO Marcas (Nombre) VALUES ('Asus');
INSERT INTO Marcas (Nombre) VALUES ('Acer');
INSERT INTO Marcas (Nombre) VALUES ('Apple');       -- Para MacBooks
INSERT INTO Marcas (Nombre) VALUES ('MSI');         -- Popular para gaming
INSERT INTO Marcas (Nombre) VALUES ('Samsung');     -- Aunque menos comunes en laptops ahora, aún presentes
INSERT INTO Marcas (Nombre) VALUES ('LG');          -- Similar a Samsung, tuvieron su auge
INSERT INTO Marcas (Nombre) VALUES ('Toshiba');     -- Menos comunes ahora, pero históricamente relevantes
INSERT INTO Marcas (Nombre) VALUES ('Huawei');      -- Han ganado presencia en el mercado de laptops
INSERT INTO Marcas (Nombre) VALUES ('Compaq');      -- Histórica, ahora parte de HP pero aún reconocida por algunos
INSERT INTO Marcas (Nombre) VALUES ('Janus');       -- Marca colombiana de ensamblaje
INSERT INTO Marcas (Nombre) VALUES ('Compumax');    -- Otra marca colombiana de ensamblaje
INSERT INTO Marcas (Nombre) VALUES ('PC Smart');    -- Marca local que ha tenido presencia
INSERT INTO Marcas (Nombre) VALUES ('ECS');    -- Marca local que ha tenido presencia
INSERT INTO Marcas (Nombre) VALUES ('Grandstream'); --marca de telefonos
INSERT INTO Marcas (Nombre) VALUES ('Yealink'); --marca de telefonos

-- select marcas
SELECT * FROM Marcas

--######################################### CRUDS Modelos #########################################
-- Tabla de modelos
CREATE TABLE Modelos (
    IdModelo INT PRIMARY KEY IDENTITY(1,1),
	IdMarca INT NOT NULL,
    NombreModelo VARCHAR(100) NOT NULL,
    FOREIGN KEY (IdMarca) REFERENCES Marcas(IdMarca)
);

-- insert para modelos
INSERT INTO Modelos (IdMarca,NombreModelo) VALUES (1,'vostro 2');
INSERT INTO Modelos (IdMarca,NombreModelo) VALUES (1,'vostro 2');
INSERT INTO Modelos (IdMarca,NombreModelo) VALUES (2,'insiron 15');

SELECT * FROM Modelos

--######################################### CRUDS Tipos #########################################

-- tabla de tipos de computadores
CREATE TABLE Tipos (
    IdTipo INT PRIMARY KEY IDENTITY(1,1),
    Nombre VARCHAR(20) NOT NULL
);

--Insert para Tipos
INSERT INTO Tipos (Nombre) VALUES ('Portatil');
INSERT INTO Tipos (Nombre) VALUES ('Escritorio');
INSERT INTO Tipos (Nombre) VALUES ('Todo En Uno');
--Tipos de telefonos
INSERT INTO Tipos (Nombre) VALUES ('Inalambrico');
INSERT INTO Tipos (Nombre) VALUES ('Fijo');


--######################################### CRUDS Estados #########################################
-- tabla de estados
CREATE TABLE Estados (
    IdEstado INT PRIMARY KEY IDENTITY(1,1),
    Nombre VARCHAR(20) NOT NULL,
);

--Insert para Estados
INSERT INTO Estados(Nombre) VALUES ('Activo');
INSERT INTO Estados(Nombre) VALUES ('Vendido');
INSERT INTO Estados(Nombre) VALUES ('Disponible');
INSERT INTO Estados(Nombre) VALUES ('Obsoleto');
INSERT INTO Estados(Nombre) VALUES ('En Reperacion');

--######################################### CRUDS Ubicaciones #########################################
-- tabla de ubicaciones
CREATE TABLE Ubicaciones (
    IdUbicacion INT PRIMARY KEY IDENTITY(1,1),
    Nombre VARCHAR(100) NOT NULL,
);

--Insert para Ubicaciones (Bodegas)
INSERT INTO Ubicaciones(Nombre) VALUES ('Amistad');
INSERT INTO Ubicaciones(Nombre) VALUES ('Libertad');
INSERT INTO Ubicaciones(Nombre) VALUES ('Lider');
INSERT INTO Ubicaciones(Nombre) VALUES ('Oriente');
INSERT INTO Ubicaciones(Nombre) VALUES ('La 81');

--######################################### CRUDS GenRam #########################################
-- Tabla de Generaciones Ram
CREATE TABLE genRam(
	IdGeneracionRam INT PRIMARY KEY IDENTITY(1,1),
	GeneracionRam VARCHAR(50) UNIQUE
);
--Insert para genRam
INSERT INTO genRam(GeneracionRam) VALUES ('DDR5');
INSERT INTO genRam(GeneracionRam) VALUES ('DDR4');
INSERT INTO genRam(GeneracionRam) VALUES ('DDR3');
INSERT INTO genRam(GeneracionRam) VALUES ('DDR3 L');
INSERT INTO genRam(GeneracionRam) VALUES ('DDR2');
INSERT INTO genRam(GeneracionRam) VALUES ('DDR');

SELECT * FROM genRam

--######################################### CRUDS SistemasOperativos #########################################
-- Tabla de sistema operativo
CREATE TABLE SistemaOperativo (
    IdSistemaOperativo INT PRIMARY KEY IDENTITY(1,1),
    Nombre VARCHAR(50),--Windows 11 pro
);

--Insert de sistemas Operativos
INSERT INTO SistemaOperativo (Nombre)
VALUES
('Sin Sistema'),
('Windows 11 Pro'),
('Windows 11 Home'),
('Windows 10 Pro'),
('Windows 10 Home'),
('Windows 8.1'),
('Windows 7 Professional'),
('Windows Server 2022'),
('Windows Server 2019'),
('Windows Server 2016');
--######################################### CRUDS Computadores #########################################
CREATE TABLE Computadores (
    IdComputador INT PRIMARY KEY IDENTITY(1,1),
    PlacaComputador INT NOT NULL UNIQUE,
    SerialNumber VARCHAR(50) NOT NULL UNIQUE,
    IdModelo INT,
    IdSistemaOperativo INT,
    IdTipo INT,
    IdEstado INT,
    IdUbicacion INT,
	FechaCompra DATE,
	FechaRegistro DATETIME DEFAULT GETDATE(),
    Observaciones NVARCHAR(MAX),
    FOREIGN KEY (IdModelo) REFERENCES Modelos(IdModelo),
    FOREIGN KEY (IdSistemaOperativo) REFERENCES SistemaOperativo(IdSistemaOperativo),
    FOREIGN KEY (IdTipo) REFERENCES Tipos(IdTipo),
    FOREIGN KEY (IdEstado) REFERENCES Estados(IdEstado),
    FOREIGN KEY (IdUbicacion) REFERENCES Ubicaciones(IdUbicacion)
);

--Insert Computadores
INSERT INTO Computadores(PlacaComputador, SerialNumber, IdModelo, IdSistemaOperativo, IdTipo, IdEstado, IdUbicacion, Observaciones)
VALUES (1001, 'SN-HP-001',1, 1, 1, 1, 1, 'Laptop HP nueva para ventas');

INSERT INTO Computadores(PlacaComputador, SerialNumber, IdModelo, IdSistemaOperativo, IdTipo, IdEstado, IdUbicacion, Observaciones)
VALUES (1002, 'SN-HP-002',4, 2, 2, 3, 3, 'Laptop HP nueva para ventas');

SELECT * FROM Computadores;


--######################################### CRUDS Caracteristicas #########################################
CREATE TABLE Caracteristicas (
    IdCaracteristica INT PRIMARY KEY IDENTITY(1,1),
    IdComputador INT UNIQUE,
    Procesador VARCHAR(100),
    IdGeneracionRam INT,
    MemoriaRAM_GB INT, --8
    FOREIGN KEY (IdComputador) REFERENCES Computadores(IdComputador),
    FOREIGN KEY (IdGeneracionRam) REFERENCES genRam(IdGeneracionRam)
);

INSERT INTO Caracteristicas(IdComputador, Procesador, IdGeneracionRam, MemoriaRAM_GB ) 
VALUES (1,'Intel core i7 13000 2.4ghz', 2, 32)

INSERT INTO Caracteristicas(IdComputador, Procesador, IdGeneracionRam, MemoriaRAM_GB ) 
VALUES (2,'Intel core i5 7gen 1.4ghz', 3, 8)

--######################################### CRUDS Tipos Discos Duros #########################################
CREATE TABLE TiposDisco (
    IdTipoDisco INT PRIMARY KEY IDENTITY(1,1),
    NombreTipo VARCHAR(10) UNIQUE NOT NULL -- Ej: "SSD", "HDD", "NVMe"
);

INSERT INTO TiposDisco(NombreTipo) VALUES ('M.2')
INSERT INTO TiposDisco(NombreTipo) VALUES ('SSD')
INSERT INTO TiposDisco(NombreTipo) VALUES ('HDD')

SELECT * FROM TiposDisco

--######################################### CRUDS Discos Duros #########################################
CREATE TABLE DiscosDuros (
    IdDiscoDuro INT PRIMARY KEY IDENTITY(1,1),
    IdCaracteristica INT NOT NULL,
    DescripcionDisco VARCHAR(100) NOT NULL,
    IdTipoDisco INT NOT NULL, -- Cambiado de TipoDisco VARCHAR
    CapacidadGB INT NULL, -- Añadido como sugerencia
    FOREIGN KEY (IdCaracteristica) REFERENCES Caracteristicas(IdCaracteristica),
    FOREIGN KEY (IdTipoDisco) REFERENCES TiposDisco(IdTipoDisco)
);

INSERT INTO DiscosDuros(IdCaracteristica,DescripcionDisco,IdTipoDisco,CapacidadGB) VALUES (2,'Adata',1,500)
INSERT INTO DiscosDuros(IdCaracteristica,DescripcionDisco,IdTipoDisco,CapacidadGB) VALUES (2,'Hitachi',3,1000)
--######################################### CRUDS Red #########################################

-- Tabla de red
CREATE TABLE Red (
    IdRed INT PRIMARY KEY IDENTITY(1,1),
    IdComputador INT,
    MacLocal VARCHAR(17),
    MacWifi VARCHAR(17) null,
    FOREIGN KEY (IdComputador) REFERENCES Computadores(IdComputador)
);

--insert Red
INSERT INTO red(IdComputador,MacLocal)VALUES(1,'84-SD-27-D5-A3-BC')
INSERT INTO red(IdComputador,MacWifi)VALUES(1,'84-SD-27-D5-A3-05')
INSERT INTO red(IdComputador,MacLocal)VALUES(2,'85-SE-27-D5-A3-BA')

--######################################### CRUDS garantia #########################################

-- Tabla de garantía
CREATE TABLE Garantias (
    IdGarantia INT PRIMARY KEY IDENTITY(1,1),
    IdComputador INT,
    FechaCompra DATE,
    GarantiaHasta DATE,
    Proveedor VARCHAR(100),
    FOREIGN KEY (IdComputador) REFERENCES Computadores(IdComputador)
);

--######################################### Tabla Mantenimientos #########################################
CREATE TABLE Mantenimientos (
    IdMantenimiento INT PRIMARY KEY IDENTITY(1,1),
    IdComputador INT NOT NULL,
    Descripcion NVARCHAR(500) NOT NULL,
    Fecha DATE NOT NULL,
    ArchivoAdjunto NVARCHAR(255) NULL,
    FOREIGN KEY (IdComputador) REFERENCES Computadores(IdComputador)
);

--######################################### Tabla Usuarios #########################################
CREATE TABLE Usuarios (
    IdUsuario INT IDENTITY(1,1) PRIMARY KEY,
    Usuario NVARCHAR(50) NOT NULL UNIQUE,
    PasswordHash NVARCHAR(255) NOT NULL
);

select * from Usuarios

-- Tabla de roles
CREATE TABLE Roles (
    IdRol INT IDENTITY(1,1) PRIMARY KEY,
    NombreRol NVARCHAR(50) NOT NULL UNIQUE
);

-- Agregar columna de rol a la tabla de usuarios
ALTER TABLE Usuarios
ADD IdRol INT NOT NULL DEFAULT 1
    CONSTRAINT FK_Usuarios_Roles FOREIGN KEY (IdRol) REFERENCES Roles(IdRol);

-- Ejemplo de inserción de roles
INSERT INTO Roles (NombreRol) VALUES ('Administrador'), ('Usuario'), ('Invitado');

-- Ejemplo de creación de usuario con rol específico
-- (Recuerda generar el hash de la contraseña en PHP)
INSERT INTO Usuarios (Usuario, PasswordHash, IdRol)
VALUES ('admin', '$2y$10$XDpRNiBvYkLMMupMdSFsXuchv.7VR95uHhPueG5YfnOx9ad7chYoG', 1);

INSERT INTO Usuarios (Usuario, PasswordHash, IdRol)
VALUES ('Juan Cardona', '$2y$10$Cn1Iro8QbV1ea3D0y1cKOOQhEBwJVqf0s9zxB3MfuKHj2wCOE3q.m', 1);


select * from Usuarios
DELETE FROM Usuarios WHERE IdUsuario = 2
DBCC CHECKIDENT(Usuarios, RESEED, 0);

--********************************************TABLAS TELEFONOS**************************************************
/*
-- Tabla para almacenar las IPs de los teléfonos
CREATE TABLE IpTelefonos (
    IdIpTelefono INT IDENTITY(1,1) PRIMARY KEY,
    Ip NVARCHAR(14) NOT NULL UNIQUE
);
*/

drop table Telefonos

-- Tabla principal de Teléfonos
CREATE TABLE Telefonos (
    IdTelefono INT IDENTITY(1,1) PRIMARY KEY,
	PlacaTelefono INT UNIQUE,
    IdMarca INT NOT NULL,
    IdModelo INT NOT NULL,
	Serial VARCHAR(50) NULL UNIQUE,
    IdTipoTelefono INT NOT NULL,
	IpTelefono VARCHAR(16) NULL,
    Mac VARCHAR(50) NOT NULL UNIQUE,
    FechaCompra DATE NOT NULL,
	IdEstado INT NOT NULL,
	IdUbicacion INT NOT NULL,
    Precio DECIMAL(12,2) NOT NULL,
	Notas VARCHAR(100),
    FOREIGN KEY (IdMarca) REFERENCES Marcas(IdMarca),
    FOREIGN KEY (IdModelo) REFERENCES Modelos(IdModelo),
    FOREIGN KEY (IdTipoTelefono) REFERENCES Tipos(IdTipo),
	FOREIGN KEY (IdEstado) REFERENCES Estados(IdEstado),
	FOREIGN KEY (IdUbicacion) REFERENCES Ubicaciones(IdUbicacion)
);


SELECT
t.PlacaTelefono,
m.Nombre AS MarcaTelefono,
md.NombreModelo AS ModeloTelefono,
tp.Nombre AS TipoTelefono,
t.IpTelefono,
t.Mac,
t.FechaCompra,
e.Nombre AS EstadoTelefono,
u.Nombre as Ubicacion,
t.Precio,
t.Notas
FROM Telefonos AS t
JOIN Modelos AS md ON md.IdModelo = t.IdModelo
JOIN Marcas AS m ON md.IdMarca = m.IdMarca
JOIN Tipos AS tp ON t.IdTipoTelefono = tp.IdTipo
JOIN Estados AS e ON t.IdEstado = e.IdEstado
JOIN Ubicaciones AS u ON t.IdUbicacion = u.IdUbicacion

USE [inventario_tecnologico_prueba]
GO

INSERT INTO [dbo].[Telefonos]
           ([PlacaTelefono]
           ,[IdMarca]
           ,[IdModelo]
           ,[IdTipoTelefono]
           ,[IpTelefono]
           ,[Mac]
           ,[FechaCompra]
           ,[IdEstado]
           ,[IdUbicacion]
           ,[Precio]
           ,[Notas])
     VALUES
           (2002
           ,2
           ,18
           ,1
           ,'192.168.20.1'
           ,'VG-MJ-HG-25-04-30'
           ,'20150101'
           ,1
           ,1
           ,500000
           ,'PRUEBITA')
GO

USE [inventario_tecnologico_prueba]
GO

/****** Object:  Table [dbo].[Telefonos]    Script Date: 29/07/2025 8:58:17 a. m. ******/
IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[Telefonos]') AND type in (N'U'))
DROP TABLE [dbo].[Telefonos]
GO

alter table Telefonos
add Serial varchar(50)




--######################################### CONSULTAS CON JOINS #########################################


--Consulta General Detallada
SELECT 
c.PlacaComputador,
c.SerialNumber,
ma.Nombre AS marca,
mo.NombreModelo AS modelo,
so.Nombre AS sistemaOperativo,
t.Nombre AS tipoEquipo,
ca.Procesador,
gr.GeneracionRam AS genRam,
ca.MemoriaRAM_GB AS ramGb,
dd.DescripcionDisco,
dd.CapacidadGB,
td.NombreTipo AS tipoDisco,
r.MacLocal,
r.MacWifi,
es.Nombre AS estado,
u.Nombre AS Bodega,
c.Observaciones
FROM Computadores AS c
JOIN Modelos AS mo ON c.IdModelo = mo.IdModelo
JOIN Marcas AS ma ON mo.IdMarca = ma.IdMarca
JOIN SistemaOperativo AS so ON c.IdSistemaOperativo = so.IdSistemaOperativo
JOIN Tipos AS t ON c.IdTipo = t.IdTipo
JOIN Estados AS es ON c.IdEstado = es.IdEstado
JOIN Ubicaciones AS u ON c.IdUbicacion = u.IdUbicacion
JOIN Red AS r ON r.IdComputador = c.IdComputador
JOIN Caracteristicas AS ca ON ca.IdComputador = c.IdComputador
JOIN genRam AS gr ON ca.IdGeneracionRam = gr.IdGeneracionRam
JOIN DiscosDuros AS dd ON dd.IdCaracteristica = ca.IdCaracteristica
JOIN TiposDisco AS td ON dd.IdTipoDisco = td.IdTipoDisco 


--Consulta General Con IA para quitar duplicidad de discos

SELECT
c.PlacaComputador,
c.SerialNumber,
ma.Nombre AS marca,
mo.NombreModelo AS modelo,
so.Nombre AS sistemaOperativo,
t.Nombre AS tipoEquipo,
ca.Procesador,
gr.GeneracionRam AS genRam,
ca.MemoriaRAM_GB AS ramGb,
STRING_AGG(CONCAT(ISNULL(dd.DescripcionDisco, 'N/A'),' (',
	ISNULL(CONVERT(VARCHAR, dd.CapacidadGB), 'N/A'), 'GB, ',
	ISNULL(td.NombreTipo, 'N/A'), ')'),'; '
	) WITHIN GROUP (ORDER BY dd.IdDiscoDuro) AS DiscosDetalle,
MAX(r.MacLocal) AS MacLocal,
MAX(r.MacWifi) AS MacWifi,
es.Nombre AS estado,
u.Nombre AS Bodega,
c.Observaciones
FROM Computadores AS c
JOIN Modelos AS mo ON c.IdModelo = mo.IdModelo
JOIN Marcas AS ma ON mo.IdMarca = ma.IdMarca
JOIN SistemaOperativo AS so ON c.IdSistemaOperativo = so.IdSistemaOperativo
JOIN Tipos AS t ON c.IdTipo = t.IdTipo
JOIN Estados AS es ON c.IdEstado = es.IdEstado
JOIN Ubicaciones AS u ON c.IdUbicacion = u.IdUbicacion
JOIN Caracteristicas AS ca ON ca.IdComputador = c.IdComputador
JOIN genRam AS gr ON ca.IdGeneracionRam = gr.IdGeneracionRam
LEFT JOIN Red AS r ON r.IdComputador = c.IdComputador -- Asumiendo que r tiene MacLocal, MacWifi
LEFT JOIN DiscosDuros AS dd ON dd.IdCaracteristica = ca.IdCaracteristica
LEFT JOIN TiposDisco AS td ON dd.IdTipoDisco = td.IdTipoDisco
GROUP BY
c.IdComputador,
c.PlacaComputador,
c.SerialNumber,
ma.Nombre,
mo.NombreModelo,
so.Nombre,
t.Nombre,
ca.Procesador,
gr.GeneracionRam,
ca.MemoriaRAM_GB,
es.Nombre,
u.Nombre,
c.Observaciones;