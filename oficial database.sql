drop database if exists cencel;
create database cencel;
use cencel;

drop table if exists usuarios;
create table usuarios(
  `id_usuario` tinyint auto_increment,
  `nombre` varchar(255) NOT NULL,
  `ape_pat` varchar(255) NOT NULL,
  `ape_mat` varchar(255) NOT NULL,
  `fecha_nac` date NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `poblacion` varchar(100) NOT NULL,
  `codigo_postal` char(5) DEFAULT NULL,
  `telefono1` varchar(15) NOT NULL,
  `telefono2` varchar(15) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `rfc` char(13) UNIQUE DEFAULT NULL,
  `login` varchar(64) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `perfil` varchar(20) NOT NULL,
  `precio_asignado` varchar(30) NOT NULL,
  `almacen` varchar(50) NOT NULL,
  `tipo_cliente` varchar(30) NOT NULL,
  `status` bit(1) DEFAULT NULL,
  `tipo` bit(1) DEFAULT 1,
  PRIMARY KEY (id_usuario),
  UNIQUE KEY (`rfc`)
)engine=InnoDB;


drop table if exists almacenes;
create table almacenes(
  id_almacen tinyint auto_increment,
  clave varchar(15) not null,
  almacen varchar(50) not null,
  direccion varchar(100),
  contacto varchar(100),
  telefono1 char(15),
  telefono2 char(15),
  status bit,
  central bit DEFAULT 0,
  primary key(id_almacen),
  UNIQUE KEY(`clave`)
)ENGINE=InnoDb;


drop table if exists proveedores;
create table proveedores(
  id_proveedor tinyint auto_increment,
  clave_prov varchar(10),
  proveedor varchar(50) not null,
  direccion varchar(50) not null,
  telefono varchar(15),
  telefono2 varchar(15),
  sitio varchar(50),
  status bit DEFAULT 1,
  primary key(id_proveedor),
  UNIQUE KEY (`proveedor`)
)ENGINE=InnoDb;


drop table if exists departamentos;
create table departamentos(
  id_departamento tinyint auto_increment,
  departamento varchar(50) not null,
  status bit,
  primary key(id_departamento),
  UNIQUE KEY(`departamento`)
)ENGINE=InnoDb;


drop table if exists catalogos;
create table catalogos(
  id_catalogo tinyint auto_increment,
  catalogo varchar(50),
  status bit,  
  tipo bit DEFAULT 0,
  primary key(id_catalogo),
  UNIQUE KEY(`catalogo`)
)ENGINE=InnoDb;


drop table if exists departamentos_catalogos;
create table departamentos_catalogos(
  id_departamento tinyint,
  id_catalogo tinyint,
  primary key(id_departamento,id_catalogo),
  foreign key(id_departamento) references departamentos(id_departamento),
  foreign key(id_catalogo) references catalogos(id_catalogo)
)ENGINE=InnoDb;


drop table if exists departamentos_proveedores;
create table departamentos_proveedores(
  id_departamento tinyint,
  id_proveedor tinyint,
  primary key(id_departamento,id_proveedor),
  foreign key(id_departamento) references departamentos(id_departamento),
  foreign key(id_proveedor) references proveedores(id_proveedor)
)ENGINE=InnoDb;



drop table if exists productos;
create table productos(
  cve varchar(80) not null, -- La clave la genera el usuario --
  departamento varchar(15) NOT NULL DEFAULT '',
  catalogo varchar(15) NOT NULL DEFAULT '',
  clase varchar(20) DEFAULT '',
  proveedor varchar(15) NOT NULL DEFAULT '',
    marca varchar(20),
    modelo varchar(30) NOT NULL DEFAULT '',
    color varchar(30),
    tamano varchar(20),
    co float NOT NULL DEFAULT '0',
    ma float NOT NULL DEFAULT '0',
    mm float NOT NULL DEFAULT '0',
    ds float NOT NULL DEFAULT '0',
    mb float NOT NULL DEFAULT '0',
    pb float NOT NULL DEFAULT '0',
    status bit,
  primary key(cve)
)ENGINE=InnoDb;


drop table if exists catalogos_productos;
create table catalogos_productos(
  id_catalogo tinyint,
  cve varchar(16),
  primary key(id_catalogo, cve),
  foreign key(id_catalogo) references catalogos(id_catalogo),
  foreign key(cve) references productos(cve)
)ENGINE=InnoDb;


drop table if exists almacenes_productos;
create table almacenes_productos(
  `id_almacen` tinyint,
  `cve` varchar(16), -- clave producto --
  `stock` float,
    primary key(`id_almacen`,`cve`),
    foreign key(`id_almacen`) references almacenes(`id_almacen`),
  foreign key(`cve`) references productos(`cve`)
)ENGINE=InnoDb;


-- tablas para FACTURAR INGRESOS --

drop table if exists facturas;
CREATE TABLE IF NOT EXISTS `facturas` (  
  `id_factura` tinyint(10) NOT NULL AUTO_INCREMENT,
  `n_factura` varchar(15) NOT NULL,
  `id_proveedor` tinyint(4),
  `fecha_factura` date NOT NULL,
  `monto` float NOT NULL,
  `status_pagada` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id_factura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


drop table if exists productos_cantidades;
create table productos_cantidades(
  `id_factura` tinyint(10),
  `cve` varchar(16) not null, -- clave producto --
  `clave` varchar(15), -- clave almacen --
  `cant_ingresada` int(15),
    primary key(`id_factura`,`clave`,`cve`),
    foreign key(`id_factura`) references facturas(`id_factura`),
    foreign key(`clave`) references almacenes(`clave`),
  foreign key(`cve`) references productos(`cve`)
)ENGINE=InnoDb;


drop table if exists productos_series;
create table productos_series(
  `id_factura` tinyint(10),
  `cve` varchar(16) not null, -- clave producto --
  `clave` varchar(15), -- clave almacen --
  `imei` char(15),
  `iccid` varchar(20),
  `n_telefono` varchar(10),
  `fecha_activacion` date,
  `folio` int(10) NOT NULL,
  `vendido` bit(1) NOT NULL,
  `observaciones` tinytext,
    primary key(`id_factura`,`clave`,`cve`,`imei`,`iccid`),
    foreign key(`id_factura`) references facturas(`id_factura`),
    foreign key(`clave`) references almacenes(`clave`),
  foreign key(`cve`) references productos(`cve`)
)ENGINE=InnoDb;


-- tablas para PEDIDOS --

drop table if exists pedidos;
create table pedidos(
  `folio` int(10) NOT NULL AUTO_INCREMENT,
  `id_usuario` tinyint,
  `n_remision` int(10),
  `importe` float,
  `fecha_inicio` date,
  `fecha_cierre` date,
  `fecha_vencimiento` date,
  `observaciones` varchar(100),
  `estado` bit(1),
  `pagado` bit(1),
   primary key(`folio`,`id_usuario`),
    foreign key(`id_usuario`) references usuarios(`id_usuario`)
)ENGINE=InnoDb;


drop table if exists productos_pedidos;
create table productos_pedidos(
  `folio` int(10),
  `cve` varchar(16), -- clave producto --
  `precio_co` float, 
  `precio` float,
  `cant_solicitada` int(5),
  `cant_asignada` int(5),
    primary key(`folio`,`cve`),
    foreign key(`folio`) references pedidos(`folio`),
  foreign key(`cve`) references productos(`cve`)
)ENGINE=InnoDb;

-- tablas pagos PEDIDOS --
drop table if exists pagos;
create table pagos(
  `id` int(10) AUTO_INCREMENT,
  `folio` tinyint(10),
  `efectivo` float DEFAULT 0.00, 
  `cheque` float DEFAULT 0.00, 
  `nota_credito` float DEFAULT 0.00,
  `fecha` date,
    primary key(`id`,`folio`),
    foreign key(`folio`) references pedidos(`folio`)
)ENGINE=InnoDb;

-- tablas para TRASPASOS --

drop table if exists traspasos;
create table traspasos(
  `folio` int(10) NOT NULL AUTO_INCREMENT,
  `id_usuario` tinyint,
  `n_remision` int(10),
  `importe` float,
  `fecha_inicio` date,
  `fecha_cierre` date,
  `fecha_vencimiento` date,
  `observaciones` tinytext,
  `estado` bit(1),
  `pagado` bit(1),
  `almacen_origen` varchar(10), -- clave almacen_origen --
  `almacen_destino` varchar(10), -- clave almacen_destino --
    primary key(`folio`,`id_usuario`),
    foreign key(`id_usuario`) references usuarios(`id_usuario`)
)ENGINE=InnoDb;


drop table if exists productos_traspasos;
create table productos_traspasos(
  `folio` int(10),
  `cve` varchar(16), -- clave producto --
  `precio_co` float, 
  `precio` float,
  `cant_solicitada` int(5),
  `cant_asignada` int(5),
    primary key(`folio`,`cve`),
  foreign key(`cve`) references productos(`cve`),
    foreign key(`folio`) references traspasos(`folio`)
)ENGINE=InnoDb;

-- tablas pagos TRASPASOS --
drop table if exists pagos_traspaso;
create table pagos_traspaso(
  `id` int(10) AUTO_INCREMENT,
  `folio` int(10),
  `efectivo` float DEFAULT 0.00, 
  `cheque` float DEFAULT 0.00, 
  `nota_credito` float DEFAULT 0.00,
  `fecha` date,
    primary key(`id`,`folio`),
    foreign key(`folio`) references traspasos(`folio`)
)ENGINE=InnoDb;














