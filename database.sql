CREATE TABLE usuario(
	username VARCHAR(40) NOT NULL,
	nombre VARCHAR(50) NOT NULL,
	apellido VARCHAR(30) NOT NULL,
	email VARCHAR(30) NOT NULL,
	telefono VARCHAR(15) NOT NULL,
	password VARCHAR(100) NOT NULL,
	telefonoPadres VARCHAR(15),
	direccion VARCHAR(200) NOT NULL,
	fechaNacimiento DATE NOT NULL,
	rango VARCHAR(10) NOT NULL,
	PRIMARY KEY(username)
);

CREATE TABLE sede(
	sedeID VARCHAR(300) NOT NULL,
	nombre VARCHAR(100) NOT NULL,
	ubicacion VARCHAR(200) NOT NULL,
	telefono VARCHAR(15) NOT NULL,
	maximoAlumnos INT NOT NULL,
	instructora VARCHAR(40) NOT NULL,
	PRIMARY KEY(sedeID),
	FOREIGN KEY(instructora) REFERENCES usuario(username)
);

CREATE TABLE file(
	fileID VARCHAR(300) NOT NULL,
	fileOwner VARCHAR(40) NOT NULL,
	fileName VARCHAR(200) NOT NULL,
	fileLocation VARCHAR(500) NOT NULL,
	PRIMARY KEY(fileID),
	FOREIGN KEY(fileOwner) REFERENCES usuario(username)
);