-- Inserciones para la Tabla Empleados:

-- SELECT TO_CHAR(SYSDATE, 'YYYY-MM-DD HH24:MI:SS') AS formato_fecha FROM dual;/*para saber cual es el formato de la fecha actual*/
INSERT INTO Empleados (Emp_Id, Nombre, Cargo, Salario) VALUES (1, 'Juan Perez', '2', 25000);
INSERT INTO Empleados (Emp_Id, Nombre, Cargo, Salario) VALUES (2, 'Ana Martinez', '1', 35000);
INSERT INTO Empleados (Emp_Id, Nombre, Cargo, Salario) VALUES (3, 'Carlos Lopez', '2', 27000);
INSERT INTO Empleados (Emp_Id, Nombre, Cargo, Salario) VALUES (4, 'Maria Rodriguez', '1', 38000);
INSERT INTO Empleados (Emp_Id, Nombre, Cargo, Salario) VALUES (5, 'Luisa Gonzalez', '2', 26000);
INSERT INTO Empleados (Emp_Id, Nombre, Cargo, Salario) VALUES (6, 'Javier Fernandez', '2', 28000);
INSERT INTO Empleados (Emp_Id, Nombre, Cargo, Salario) VALUES (7, 'Sara Ramirez', '1', 39000);
INSERT INTO Empleados (Emp_Id, Nombre, Cargo, Salario) VALUES (8, 'Diego Herrera', '2', 25500);
INSERT INTO Empleados (Emp_Id, Nombre, Cargo, Salario) VALUES (9, 'Laura Castro', '2', 26500);
INSERT INTO Empleados (Emp_Id, Nombre, Cargo, Salario) VALUES (10, 'Manuel Torres', '1', 39500);

-- Inserciones para la Tabla Tareas:

INSERT INTO Tareas (Tarea_Id, Descripcion, Fecha_Asignacion, Emp_Id) VALUES (1, 'empacado', '2023-10-25', 1);
INSERT INTO Tareas (Tarea_Id, Descripcion, Fecha_Asignacion, Emp_Id) VALUES (2, 'pelado', '2023-10-25', 2);
INSERT INTO Tareas (Tarea_Id, Descripcion, Fecha_Asignacion, Emp_Id) VALUES (3, 'fritado', '2023-10-25', 3);
INSERT INTO Tareas (Tarea_Id, Descripcion, Fecha_Asignacion, Emp_Id) VALUES (4, 'domiciliario', '2023-10-25', 4);
INSERT INTO Tareas (Tarea_Id, Descripcion, Fecha_Asignacion, Emp_Id) VALUES (5, 'atencion', '2023-10-25', 5);
INSERT INTO Tareas (Tarea_Id, Descripcion, Fecha_Asignacion, Emp_Id) VALUES (6, 'limpieza', '2023-10-25', 6);
INSERT INTO Tareas (Tarea_Id, Descripcion, Fecha_Asignacion, Emp_Id) VALUES (7, 'empacado', '2023-10-25', 7);
INSERT INTO Tareas (Tarea_Id, Descripcion, Fecha_Asignacion, Emp_Id) VALUES (8, 'pelado', '2023-10-25', 8);
INSERT INTO Tareas (Tarea_Id, Descripcion, Fecha_Asignacion, Emp_Id) VALUES (9, 'fritado', '2023-10-25', 9);
INSERT INTO Tareas (Tarea_Id, Descripcion, Fecha_Asignacion, Emp_Id) VALUES (10, 'pelado', '2023-10-25', 10);

-- Inserciones para la Tabla PapasCrudas:

INSERT INTO PapasCrudas (PapaCruda_Id, Tipo, CantidadKg, Proveedor, Fecha_Compra) VALUES (1, 'Papa Criolla', 500,1, TO_DATE('2023-10-20', 'YYYY-MM-DD'));
INSERT INTO PapasCrudas (PapaCruda_Id, Tipo, CantidadKg, Proveedor, Fecha_Compra) VALUES (2, 'Papa Amarilla', 700, 2, TO_DATE('2023-10-21', 'YYYY-MM-DD'));

-- Inserciones para la Tabla PapitasFritas:

INSERT INTO PapitasFritas (PapitaFrita_Id, TipoPapaFrita, Fecha_Produccion, CantidadKg, TipoPapaCruda_Id) VALUES (1, 'Papa Criolla', TO_DATE('2023-10-25', 'YYYY-MM-DD'), 300, 1);
INSERT INTO PapitasFritas (PapitaFrita_Id, TipoPapaFrita, Fecha_Produccion, CantidadKg, TipoPapaCruda_Id) VALUES (2, 'Papa Amarilla', TO_DATE('2023-10-25', 'YYYY-MM-DD'), 500, 2);

-- Inserciones para la Tabla Clientes:

INSERT INTO Clientes (Cliente_Id, Nombre, Direccion) VALUES (1, 'Dulcer�a La Abuelita', 'Calle 123, Cali');
INSERT INTO Clientes (Cliente_Id, Nombre, Direccion) VALUES (2, 'Dulcer�a Los Olivos', 'Avenida XYZ, Popay�n');
INSERT INTO Clientes (Cliente_Id, Nombre, Direccion) VALUES (3, 'La Tienda de los Dulces', 'Carrera 456, Timb�o');
INSERT INTO Clientes (Cliente_Id, Nombre, Direccion) VALUES (4, 'Dulcer�a Las Delicias', 'Avenida 789, Piendam�');
INSERT INTO Clientes (Cliente_Id, Nombre, Direccion) VALUES (5, 'Dulcer�a La Ni�a', 'Calle 321, Cali');
INSERT INTO Clientes (Cliente_Id, Nombre, Direccion) VALUES (6, 'Dulcer�a El Para�so', 'Carrera 654, Timb�o');
INSERT INTO Clientes (Cliente_Id, Nombre, Direccion) VALUES (7, 'La Dulce Tentaci�n', 'Avenida 987, Cali');
INSERT INTO Clientes (Cliente_Id, Nombre, Direccion) VALUES (8, 'Dulcer�a Los Sue�os', 'Calle 654, Piendam�');
INSERT INTO Clientes (Cliente_Id, Nombre, Direccion) VALUES (9, 'La Tienda de Az�car', 'Carrera 321, Popay�n');
INSERT INTO Clientes (Cliente_Id, Nombre, Direccion) VALUES (10, 'Dulcer�a La Esperanza', 'Avenida 555, Timb�o');

-- Inserciones para la Tabla Ventas

INSERT INTO Ventas (Venta_Id, Cliente_Id, Fecha_Venta, PapitaFrita_Id, Cantidad, PrecioUnitario) VALUES (1, 1, TO_DATE('2023-10-25', 'YYYY-MM-DD'), 1, 10, 5.99);
INSERT INTO Ventas (Venta_Id, Cliente_Id, Fecha_Venta, PapitaFrita_Id, Cantidad, PrecioUnitario) VALUES (2, 2, TO_DATE('2023-10-25', 'YYYY-MM-DD'), 2, 15, 6.49);
INSERT INTO Ventas (Venta_Id, Cliente_Id, Fecha_Venta, PapitaFrita_Id, Cantidad, PrecioUnitario) VALUES (3, 3, TO_DATE('2023-10-26', 'YYYY-MM-DD'), 1, 8, 5.99);
INSERT INTO Ventas (Venta_Id, Cliente_Id, Fecha_Venta, PapitaFrita_Id, Cantidad, PrecioUnitario) VALUES (4, 4, TO_DATE('2023-10-26', 'YYYY-MM-DD'), 2, 12, 6.49);
INSERT INTO Ventas (Venta_Id, Cliente_Id, Fecha_Venta, PapitaFrita_Id, Cantidad, PrecioUnitario) VALUES (5, 5, TO_DATE('2023-10-27', 'YYYY-MM-DD'), 1, 5, 5.99);
INSERT INTO Ventas (Venta_Id, Cliente_Id, Fecha_Venta, PapitaFrita_Id, Cantidad, PrecioUnitario) VALUES (6, 6, TO_DATE('2023-10-27', 'YYYY-MM-DD'), 2, 20, 6.49);
INSERT INTO Ventas (Venta_Id, Cliente_Id, Fecha_Venta, PapitaFrita_Id, Cantidad, PrecioUnitario) VALUES (7, 7, TO_DATE('2023-10-28', 'YYYY-MM-DD'), 1, 7, 5.99);
INSERT INTO Ventas (Venta_Id, Cliente_Id, Fecha_Venta, PapitaFrita_Id, Cantidad, PrecioUnitario) VALUES (8, 8, TO_DATE('2023-10-28', 'YYYY-MM-DD'), 2, 18, 6.49);
INSERT INTO Ventas (Venta_Id, Cliente_Id, Fecha_Venta, PapitaFrita_Id, Cantidad, PrecioUnitario) VALUES (9, 9, TO_DATE('2023-10-29', 'YYYY-MM-DD'), 1, 6, 5.99);
INSERT INTO Ventas (Venta_Id, Cliente_Id, Fecha_Venta, PapitaFrita_Id, Cantidad, PrecioUnitario) VALUES (10, 10, TO_DATE('2023-10-29', 'YYYY-MM-DD'), 2, 22, 6.49);

-- Inserciones para la Tabla Proveedores

INSERT INTO Proveedores (Proveedor_Id, Nombre, Direccion, Contacto) VALUES (1, 'Proveedor Papa Criolla', 'Calle 1, Ciudad', 'Contacto Papa Criolla');
INSERT INTO Proveedores (Proveedor_Id, Nombre, Direccion, Contacto) VALUES (2, 'Proveedor Papa Amarilla', 'Calle 2, Ciudad', 'Contacto Papa Amarilla');
INSERT INTO Proveedores (Proveedor_Id, Nombre, Direccion, Contacto) VALUES (3, 'Proveedor Sal', 'Calle 3, Ciudad', 'Contacto Sal');
INSERT INTO Proveedores (Proveedor_Id, Nombre, Direccion, Contacto) VALUES (4, 'Proveedor Pl�stico', 'Calle 4, Ciudad', 'Contacto Pl�stico');
INSERT INTO Proveedores (Proveedor_Id, Nombre, Direccion, Contacto) VALUES (5, 'Proveedor Logo', 'Calle 5, Ciudad', 'Contacto Logo');
INSERT INTO Proveedores (Proveedor_Id, Nombre, Direccion, Contacto) VALUES (6, 'Proveedor Tapabocas', 'Avenida Norte, Ciudad', 'Contacto Tapabocas');
INSERT INTO Proveedores (Proveedor_Id, Nombre, Direccion, Contacto) VALUES (7, 'Proveedor Guantes', 'Calle Este, Ciudad', 'Contacto Guantes');
INSERT INTO Proveedores (Proveedor_Id, Nombre, Direccion, Contacto) VALUES (8, 'Proveedor Aseo', 'Avenida Oeste, Ciudad', 'Contacto Aseo');
INSERT INTO Proveedores (Proveedor_Id, Nombre, Direccion, Contacto) VALUES (9, 'Proveedor Varios', 'Calle Sur, Ciudad', 'Contacto Varios');

-- Inserciones para la Tabla Usuarios

INSERT INTO Usuarios (Usuario_Id, Nombre, Rol) VALUES (1, 'Administrador', 'Administrador');
INSERT INTO Usuarios (Usuario_Id, Nombre, Rol) VALUES (2, 'Jefe', 'Jefe');

-- Inserciones para la Tabla MateriasPrimas

INSERT INTO MateriasPrimas (MateriaPrima_Id, Nombre, Tipo, Proveedor, PrecioPorKg, FechaCompra)
VALUES (1, 'Papa Criolla', 'Papa', 1, 1.50, TO_DATE('2023-10-20', 'YYYY-MM-DD'));

INSERT INTO MateriasPrimas (MateriaPrima_Id, Nombre, Tipo, Proveedor, PrecioPorKg, FechaCompra)
VALUES (2, 'Papa Amarilla', 'Papa', 2, 1.20, TO_DATE('2023-10-21', 'YYYY-MM-DD'));

INSERT INTO MateriasPrimas (MateriaPrima_Id, Nombre, Tipo, Proveedor, PrecioPorKg, FechaCompra)
VALUES (3, 'Sal', 'Condimento', 3, 0.80, TO_DATE('2023-10-22', 'YYYY-MM-DD'));

INSERT INTO MateriasPrimas (MateriaPrima_Id, Nombre, Tipo, Proveedor, PrecioPorKg, FechaCompra)
VALUES (4, 'Pl�stico', 'Material', 4, 2.50, TO_DATE('2023-10-23', 'YYYY-MM-DD'));

INSERT INTO MateriasPrimas (MateriaPrima_Id, Nombre, Tipo, Proveedor, PrecioPorKg, FechaCompra)
VALUES (5, 'Logo', 'Material', 5, 1.00, TO_DATE('2023-10-24', 'YYYY-MM-DD'));

INSERT INTO MateriasPrimas (MateriaPrima_Id, Nombre, Tipo, Proveedor, PrecioPorKg, FechaCompra)
VALUES (6, 'Gasolina', 'Combustible', 9, 3.00, TO_DATE('2023-10-25', 'YYYY-MM-DD'));

INSERT INTO MateriasPrimas (MateriaPrima_Id, Nombre, Tipo, Proveedor, PrecioPorKg, FechaCompra)
VALUES (7, 'Luz', 'Servicio', 9, 0.50, TO_DATE('2023-10-26', 'YYYY-MM-DD'));

INSERT INTO MateriasPrimas (MateriaPrima_Id, Nombre, Tipo, Proveedor, PrecioPorKg, FechaCompra)
VALUES (8, 'Agua', 'Servicio', 9, 0.30, TO_DATE('2023-10-27', 'YYYY-MM-DD'));

INSERT INTO MateriasPrimas (MateriaPrima_Id, Nombre, Tipo, Proveedor, PrecioPorKg, FechaCompra)
VALUES (9, 'Tapabocas', 'Equipo de Protecci�n', 6, 1.00, TO_DATE('2023-10-28', 'YYYY-MM-DD'));

INSERT INTO MateriasPrimas (MateriaPrima_Id, Nombre, Tipo, Proveedor, PrecioPorKg, FechaCompra)
VALUES (10, 'Guantes', 'Equipo de Protecci�n', 7, 0.80, TO_DATE('2023-10-29', 'YYYY-MM-DD'));

INSERT INTO MateriasPrimas (MateriaPrima_Id, Nombre, Tipo, Proveedor, PrecioPorKg, FechaCompra)
VALUES (11, 'Aseo', 'Limpieza', 8, 0.75, TO_DATE('2023-10-30', 'YYYY-MM-DD'));

INSERT INTO MateriasPrimas (MateriaPrima_Id, Nombre, Tipo, Proveedor, PrecioPorKg, FechaCompra)
VALUES (12, 'Varios', 'Miscel�neo', 9, 1.50, TO_DATE('2023-10-31', 'YYYY-MM-DD'));
