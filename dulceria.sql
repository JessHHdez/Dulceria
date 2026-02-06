CREATE TABLE usuario (
    id_usuario SERIAL PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    correo VARCHAR(100) NOT NULL, 
    contrasena VARCHAR(255) NOT NULL 
);


CREATE TABLE productos (
    id_producto SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    precio_unidad DECIMAL(10,2) NOT NULL,
    cantidad_disponible INT NOT NULL,
    descripcion TEXT 
);


INSERT INTO productos (nombre, precio_unidad, cantidad_disponible, descripcion) VALUES 
    ('Gomita de Fresa', 1.29, 100, 'Gomitas sabor fresa'),
    ('Gomita de Limón', 1.19, 100, 'Gomitas sabor limón'),
    ('Confite de Frutas', 0.99, 200, 'Confites variados de frutas'),
    ('Confite de Colores', 1.49, 150, 'Confites de colores variados'),
    ('Turrón de Almendras', 4.99, 50, 'Turrón de almendras con miel'),
    ('Turrón de Chocolate', 5.49, 50, 'Turrón de chocolate con trozos de frutos secos'),
    ('Mazapán de Cacahuate', 3.99, 75, 'Mazapán de cacahuate cubierto de azúcar glas'),
    ('Mazapán de Pistache', 4.29, 75, 'Mazapán de pistache elaborado artesanalmente'),
    ('Galleta de Chocolate', 2.99, 120, 'Galleta crujiente con chips de chocolate'),
    ('Galleta de Avena', 1.99, 100, 'Galleta de avena con pasas y nueces'),
    ('Galleta de Mantequilla', 3.49, 80, 'Galleta de mantequilla con sabor a vainilla'),
    ('Galleta de Almendras', 2.79, 90, 'Galleta con trozos de almendras tostadas'),
    ('Chocolate con Nueces', 3.79, 70, 'Chocolate amargo con trozos de nueces'),
    ('Chocolate Amargo', 2.99, 100, 'Chocolate oscuro con alto contenido de cacao'),
    ('Chocolate con Caramelo', 3.49, 80, 'Chocolate con relleno cremoso de caramelo'),
    ('Chocolate Blanco', 3.29, 90, 'Chocolate blanco suave y cremoso'),
    ('Caramelo de Frutas', 1.89, 120, 'Caramelos surtidos con sabores naturales de frutas'),
    ('Caramelo de Menta', 1.69, 150, 'Caramelos de menta refrescante'),
    ('Caramelo de Chocolate', 3.29, 100, 'Caramelo relleno de chocolate cremoso'),
    ('Caramelo de Vainilla', 2.49, 120, 'Caramelo con sabor a vainilla y textura suave');
	
UPDATE productos SET categoria = 'caramelos' WHERE id_producto IN (17, 18, 19, 20); 
UPDATE productos SET categoria = 'chocolates' WHERE id_producto IN (13, 14, 15, 16);
UPDATE productos SET categoria = 'galletas' WHERE id_producto IN (9, 10, 11, 12);
UPDATE productos SET categoria = 'confites y gomitas' WHERE id_producto IN (1, 2, 3, 4);
UPDATE productos SET categoria = 'turrones y mazapanes' WHERE id_producto IN (5, 6, 7, 8);

UPDATE productos SET imagen = 'imagen_caramelo1.jpg' WHERE nombre = 'Caramelo de Frutas';
UPDATE productos SET imagen = 'imagen_caramelo2.jpg' WHERE nombre = 'Caramelo de Menta';
UPDATE productos SET imagen = 'imagen_caramelo3.jpg' WHERE nombre = 'Caramelo de Chocolate';
UPDATE productos SET imagen = 'imagen_caramelo4.jpg' WHERE nombre = 'Caramelo de Vainilla';

UPDATE productos SET imagen = 'imagen_chocolate1.jpg' WHERE nombre = 'Chocolate con Nueces';
UPDATE productos SET imagen = 'imagen_chocolate2.jpg' WHERE nombre = 'Chocolate Amargo';
UPDATE productos SET imagen = 'imagen_chocolate3.jpg' WHERE nombre = 'Chocolate con Caramelo';
UPDATE productos SET imagen = 'imagen_chocolate4.jpg' WHERE nombre = 'Chocolate Blanco';

UPDATE productos SET imagen = 'imagen_galleta1.jpg' WHERE nombre = 'Galleta de Chocolate';
UPDATE productos SET imagen = 'imagen_galleta2.jpg' WHERE nombre = 'Galleta de Avena';
UPDATE productos SET imagen = 'imagen_galleta3.jpg' WHERE nombre = 'Galleta de Mantequilla';
UPDATE productos SET imagen = 'imagen_galleta4.jpg' WHERE nombre = 'Galleta de Almendras';

UPDATE productos SET imagen = 'imagen_gomita1.jpg' WHERE nombre = 'Gomita de Fresa';
UPDATE productos SET imagen = 'imagen_gomita2.jpg' WHERE nombre = 'Gomita de Limón';
UPDATE productos SET imagen = 'imagen_confite1.jpg' WHERE nombre = 'Confite de Frutas';
UPDATE productos SET imagen = 'imagen_confite2.jpg' WHERE nombre = 'Confite de Colores';

UPDATE productos SET imagen = 'imagen_turron1.jpg' WHERE nombre = 'Turrón de Almendras';
UPDATE productos SET imagen = 'imagen_turron2.jpg' WHERE nombre = 'Turrón de Chocolate';
UPDATE productos SET imagen = 'imagen_mazapan1.jpg' WHERE nombre = 'Mazapán de Cacahuate';
UPDATE productos SET imagen = 'imagen_mazapan2.jpg' WHERE nombre = 'Mazapán de Pistache';


CREATE TABLE compras (
    id_compra SERIAL PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_producto INT NOT NULL,
    cantidad INT NOT NULL,
    precio_total DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario),
    FOREIGN KEY (id_producto) REFERENCES productos(id_producto)
);


ALTER TABLE usuario ALTER COLUMN contrasena TYPE VARCHAR(255);
ALTER TABLE usuario ADD COLUMN es_admin BOOLEAN DEFAULT FALSE;
ALTER TABLE productos ADD COLUMN categoria VARCHAR(50);
ALTER TABLE productos ADD COLUMN imagen VARCHAR(255);


select*from usuario;
select*from compras;
select*from productos;

insert into usuario (usuario, correo, contrasena,es_admin) values 
	('admin', 'admin@gmail.com', '123456',TRUE);
