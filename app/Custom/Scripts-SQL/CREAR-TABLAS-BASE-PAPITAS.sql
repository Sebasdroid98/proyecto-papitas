-- Alter session set "_ORACLE_SCRIPT"=true;
-- Create user topicos_dba identified by "123456";
-- Grant "CONNECT" to topicos_dba;

-- Tabla Empleados
CREATE TABLE Empleados (
    Emp_Id NUMBER PRIMARY KEY,
    Nombre VARCHAR2(100),
    Cargo VARCHAR2(50),
    Salario NUMBER(10, 2)
);

-- Tabla Tareas
CREATE TABLE Tareas (
    Tarea_Id NUMBER PRIMARY KEY,
    Descripcion VARCHAR2(255),
    Fecha_Asignacion DATE,
    Emp_Id NUMBER,
    FOREIGN KEY (Emp_Id) REFERENCES Empleados(Emp_Id)
);

-- Tabla PapasCrudas
CREATE TABLE PapasCrudas (
    PapaCruda_Id NUMBER PRIMARY KEY,
    Tipo VARCHAR2(50),
    CantidadKg NUMBER(10, 2),
    Proveedor NUMBER,
    Fecha_Compra DATE
);

-- Tabla PapitasFritas
CREATE TABLE PapitasFritas (
    PapitaFrita_Id NUMBER PRIMARY KEY,
    TipoPapaFrita VARCHAR2(50),
    Fecha_Produccion DATE,
    CantidadKg NUMBER(10, 2),
    TipoPapaCruda_Id NUMBER,
    FOREIGN KEY (TipoPapaCruda_Id) REFERENCES PapasCrudas(PapaCruda_Id)
);

-- Tabla Clientes
CREATE TABLE Clientes (
    Cliente_Id NUMBER PRIMARY KEY,
    Nombre VARCHAR2(100),
    Direccion VARCHAR2(255)
);

-- Tabla Ventas
CREATE TABLE Ventas (
    Venta_Id NUMBER PRIMARY KEY,
    Cliente_Id NUMBER,
    Fecha_Venta DATE,
    PapitaFrita_Id NUMBER,
    Cantidad NUMBER,
    PrecioUnitario NUMBER(10, 2),
    FOREIGN KEY (Cliente_Id) REFERENCES Clientes(Cliente_Id),
    FOREIGN KEY (PapitaFrita_Id) REFERENCES PapitasFritas(PapitaFrita_Id)
);

-- Tabla Proveedores
CREATE TABLE Proveedores (
    Proveedor_Id NUMBER PRIMARY KEY,
    Nombre VARCHAR2(100),
    Direccion VARCHAR2(255),
    Contacto VARCHAR2(50)
);

-- Tabla Usuarios
CREATE TABLE Usuarios (
    Usuario_Id NUMBER PRIMARY KEY,
    Nombre VARCHAR2(100),
    Rol VARCHAR2(50)
);

-- Tabla MateriasPrimas
CREATE TABLE MateriasPrimas (
    MateriaPrima_Id NUMBER PRIMARY KEY,
    Nombre VARCHAR2(100),
    Tipo VARCHAR2(50),
    Proveedor NUMBER,
    PrecioPorKg NUMBER(10, 2),
    FechaCompra DATE
);
