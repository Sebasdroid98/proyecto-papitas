
SET VERIFY ON;
SET SERVEROUTPUT ON;

-- ///////////////////////////////////////////////////////////////A
/* a) Crear bloques anónimos que sirvan de reportes para temas específicos de
    negocio de su base de datos (uso de cursores, estructuras de control). */

-- Listar Empleados con Salario Mayor a un Valor Específico
DECLARE
    -- Declarar variables
    v_id_empleado NUMBER;
    v_nombre_empleado VARCHAR2(100);
    v_cargo_empleado VARCHAR2(50);
    v_salario_empleado NUMBER(10, 2);
    v_salario_minimo NUMBER := 50000; -- Definir el salario mínimo

    -- Declarar un cursor para obtener empleados con salario superior al mínimo
    CURSOR empleados_cursor IS
        SELECT EMP_ID, EMP_NOMBRE, EMP_CARGO, EMP_SALARIO
        FROM Empleados
        WHERE EMP_SALARIO > v_salario_minimo;

BEGIN
    -- Abrir el cursor y recorrer los resultados
    FOR empleado_rec IN empleados_cursor LOOP
        -- Asignar valores a las variables desde el cursor
        v_id_empleado := empleado_rec.EMP_ID;
        v_nombre_empleado := empleado_rec.EMP_NOMBRE;
        v_cargo_empleado := empleado_rec.EMP_CARGO;
        v_salario_empleado := empleado_rec.EMP_SALARIO;

        -- Mostrar el ID, nombre, cargo y salario del empleado en el informe
        DBMS_OUTPUT.PUT_LINE('ID: ' || v_id_empleado || ', Nombre: ' || v_nombre_empleado || ', Cargo: ' || v_cargo_empleado || ', Salario: ' || v_salario_empleado);
    END LOOP;

    -- Cerrar el cursor
    CLOSE empleados_cursor;
END;

-- Bloque anonimo para obtener y mostrar la informacion de un empleado por su id
DECLARE
    v_emp_cursor SYS_REFCURSOR;
    v_emp_id NUMBER := 1;

    v_emp_rec EMPLEADOS%ROWTYPE;
BEGIN
    v_emp_cursor := EMPLEADO_CRUD_PKG.obtener_detalle_empleado(v_emp_id);

    FETCH v_emp_cursor INTO v_emp_rec;

    IF v_emp_cursor%FOUND THEN
        DBMS_OUTPUT.PUT_LINE('Emp_Id: ' || v_emp_rec.EMP_ID || ', Nombre: ' || v_emp_rec.NOMBRE || ', Cargo: ' || v_emp_rec.CARGO || ', Salario: ' || v_emp_rec.SALARIO);
    ELSE
        DBMS_OUTPUT.PUT_LINE('No se encontraron detalles para el empleado con ID ' || v_emp_id);
    END IF;

    CLOSE v_emp_cursor;
END;

-- ///////////////////////////////////////////////////////////////B
/* b) Cree al menos tres paquetes. */

-- Se define el paquete "EMPLEADO_CRUD_PKG"
CREATE OR REPLACE PACKAGE EMPLEADO_CRUD_PKG AS
    -- Procedimiento para insertar un nuevo empleado
    PROCEDURE CrearEmpleado(
        p_emp_id NUMBER,
        p_emp_nombre VARCHAR2,
        p_emp_cargo VARCHAR2,
        p_emp_salario NUMBER
    );

    -- Procedimiento para actualizar los datos de un empleado existente
    PROCEDURE ActualizarEmpleado(
        p_emp_id NUMBER,
        p_emp_nombre VARCHAR2,
        p_emp_cargo VARCHAR2,
        p_emp_salario NUMBER
    );

    -- Procedimiento para eliminar un empleado por su ID
    PROCEDURE BorrarEmpleado(p_emp_id NUMBER);

    -- Función para obtener los detalles de un empleado por su ID
    FUNCTION obtener_detalle_empleado(p_emp_id NUMBER) RETURN SYS_REFCURSOR;

END EMPLEADO_CRUD_PKG;

-- Cuerpo del paquete "EMPLEADO_CRUD_PKG"
CREATE OR REPLACE PACKAGE BODY EMPLEADO_CRUD_PKG AS

    PROCEDURE CrearEmpleado(
        p_emp_id NUMBER,
        p_emp_nombre VARCHAR2,
        p_emp_cargo VARCHAR2,
        p_emp_salario NUMBER
    ) IS
    BEGIN
        INSERT INTO EMPLEADOS (EMP_ID, NOMBRE, CARGO, SALARIO)
        VALUES (p_emp_id, p_emp_nombre, p_emp_cargo, p_emp_salario);
    END CrearEmpleado;

    PROCEDURE ActualizarEmpleado(
        p_emp_id NUMBER,
        p_emp_nombre VARCHAR2,
        p_emp_cargo VARCHAR2,
        p_emp_salario NUMBER
    ) IS
    BEGIN
        UPDATE EMPLEADOS
        SET NOMBRE = p_emp_nombre, 
            CARGO = p_emp_cargo,
            SALARIO = p_emp_salario
        WHERE EMP_ID = p_emp_id;
    END ActualizarEmpleado;

    PROCEDURE BorrarEmpleado(p_emp_id NUMBER) IS
    BEGIN
        DELETE FROM EMPLEADOS WHERE EMP_ID = p_emp_id;
    END BorrarEmpleado;

    FUNCTION obtener_detalle_empleado(p_emp_id NUMBER) RETURN SYS_REFCURSOR IS
        v_cursor SYS_REFCURSOR;
    BEGIN
        OPEN v_cursor FOR
            SELECT *
            FROM EMPLEADOS
            WHERE EMP_ID = p_emp_id;
        RETURN v_cursor;
    END obtener_detalle_empleado;

END EMPLEADO_CRUD_PKG;

-- Se crea un tipo de objeto para almacenar los detalles de las tareas al usar el método "obtener_detalle_tarea"
-- Definir tipos de objeto
CREATE TYPE DetalleTareaObj AS OBJECT (
    Tarea_Id NUMBER,
    Descripcion VARCHAR2(255),
    Fecha_Asignacion DATE,
    Emp_Id NUMBER
);

CREATE TYPE DetalleTareaTableType AS TABLE OF DetalleTareaObj;

-- Se define el paquete "TAREAS_CRUD_PKG"
CREATE OR REPLACE PACKAGE TAREAS_CRUD_PKG AS

    -- Procedimiento para crear una nueva tarea
    PROCEDURE CrearTarea(
        p_Tarea_Id NUMBER,
        p_Descripcion VARCHAR2,
        p_Fecha_Asignacion DATE,
        p_Emp_Id NUMBER
    );

    -- Procedimiento para actualizar los datos de una tarea existente
    PROCEDURE ActualizarTarea(
        p_Tarea_Id NUMBER,
        p_Descripcion VARCHAR2,
        p_Fecha_Asignacion DATE,
        p_Emp_Id NUMBER
    );

    -- Procedimiento para eliminar una tarea por su ID
    PROCEDURE BorrarTarea(p_Tarea_Id NUMBER);

    -- Función para obtener los detalles de una tarea por su ID
    FUNCTION obtener_detalle_tarea(p_Tarea_Id NUMBER) RETURN DetalleTareaTableType;

END TAREAS_CRUD_PKG;

-- Cuerpo del paquete "TAREAS_CRUD_PKG"
CREATE OR REPLACE PACKAGE BODY TAREAS_CRUD_PKG AS

    PROCEDURE CrearTarea(
        p_Tarea_Id NUMBER,
        p_Descripcion VARCHAR2,
        p_Fecha_Asignacion DATE,
        p_Emp_Id NUMBER
    ) IS
    BEGIN
        INSERT INTO Tareas (Tarea_Id, Descripcion, Fecha_Asignacion, Emp_Id)
        VALUES (p_Tarea_Id, p_Descripcion, p_Fecha_Asignacion, p_Emp_Id);
    END CrearTarea;

    PROCEDURE ActualizarTarea(
        p_Tarea_Id NUMBER,
        p_Descripcion VARCHAR2,
        p_Fecha_Asignacion DATE,
        p_Emp_Id NUMBER
    ) IS
    BEGIN
        UPDATE Tareas
        SET Descripcion = p_Descripcion,
            Fecha_Asignacion = p_Fecha_Asignacion,
            Emp_Id = p_Emp_Id
        WHERE Tarea_Id = p_Tarea_Id;
    END ActualizarTarea;

    PROCEDURE BorrarTarea(p_Tarea_Id NUMBER) IS
    BEGIN
        DELETE FROM Tareas WHERE Tarea_Id = p_Tarea_Id;
    END BorrarTarea;

    FUNCTION obtener_detalle_tarea(p_Tarea_Id NUMBER) RETURN DetalleTareaTableType IS
        v_cursor SYS_REFCURSOR;
        v_detalles DetalleTareaTableType;
    BEGIN
        OPEN v_cursor FOR
            SELECT DetalleTareaObj(Tarea_Id, Descripcion, Fecha_Asignacion, Emp_Id)
            FROM Tareas
            WHERE Tarea_Id = p_Tarea_Id;

        FETCH v_cursor BULK COLLECT INTO v_detalles;

        CLOSE v_cursor;

        RETURN v_detalles;
    END obtener_detalle_tarea;

END TAREAS_CRUD_PKG;

-- Se crea un tipo de objeto para almacenar los detalles del cliente al usar el método "obtener_detalle_cliente"
CREATE TYPE DetalleClienteObj AS OBJECT (
    Cliente_Id NUMBER,
    Nombre VARCHAR2(100),
    Direccion VARCHAR2(255)
);

CREATE TYPE DetalleClienteTableType AS TABLE OF DetalleClienteObj;

-- Se define el paquete "CLIENTES_CRUD_PKG"
CREATE OR REPLACE PACKAGE CLIENTES_CRUD_PKG AS

    -- Procedimiento para crear un nuevo cliente
    PROCEDURE CrearCliente(
        p_Cliente_Id NUMBER,
        p_Nombre VARCHAR2,
        p_Direccion VARCHAR2
    );

    -- Procedimiento para actualizar los datos de un cliente existente
    PROCEDURE ActualizarCliente(
        p_Cliente_Id NUMBER,
        p_Nombre VARCHAR2,
        p_Direccion VARCHAR2
    );

    -- Procedimiento para eliminar un cliente por su ID
    PROCEDURE BorrarCliente(p_Cliente_Id NUMBER);

    -- Función para obtener los detalles de un cliente por su ID
    FUNCTION obtener_detalle_cliente(p_Cliente_Id NUMBER) RETURN DetalleClienteTableType;

END CLIENTES_CRUD_PKG;

-- Cuerpo del paquete "CLIENTES_CRUD_PKG"
CREATE OR REPLACE PACKAGE BODY CLIENTES_CRUD_PKG AS

    PROCEDURE CrearCliente(
        p_Cliente_Id NUMBER,
        p_Nombre VARCHAR2,
        p_Direccion VARCHAR2
    ) IS
    BEGIN
        INSERT INTO Clientes (Cliente_Id, Nombre, Direccion)
        VALUES (p_Cliente_Id, p_Nombre, p_Direccion);
    END CrearCliente;

    PROCEDURE ActualizarCliente(
        p_Cliente_Id NUMBER,
        p_Nombre VARCHAR2,
        p_Direccion VARCHAR2
    ) IS
    BEGIN
        UPDATE Clientes
        SET Nombre = p_Nombre,
            Direccion = p_Direccion
        WHERE Cliente_Id = p_Cliente_Id;
    END ActualizarCliente;

    PROCEDURE BorrarCliente(p_Cliente_Id NUMBER) IS
    BEGIN
        DELETE FROM Clientes WHERE Cliente_Id = p_Cliente_Id;
    END BorrarCliente;

    FUNCTION obtener_detalle_cliente(p_Cliente_Id NUMBER) RETURN DetalleClienteTableType IS
        v_cursor SYS_REFCURSOR;
        v_detalles DetalleClienteTableType;
    BEGIN
        OPEN v_cursor FOR
            SELECT DetalleClienteObj(Cliente_Id, Nombre, Direccion)
            FROM Clientes
            WHERE Cliente_Id = p_Cliente_Id;

        FETCH v_cursor BULK COLLECT INTO v_detalles;

        CLOSE v_cursor;

        RETURN v_detalles;
    END obtener_detalle_cliente;

END CLIENTES_CRUD_PKG;

-- Se crea un tipo de objeto para almacenar los detalles del cliente al usar el método "obtener_detalle_venta"
CREATE TYPE DetalleVentaObj AS OBJECT (
    Venta_Id NUMBER,
    Cliente_Id NUMBER,
    Fecha_Venta DATE,
    PapitaFrita_Id NUMBER,
    Cantidad NUMBER,
    PrecioUnitario NUMBER(10, 2)
);

CREATE TYPE DetalleVentaTableType AS TABLE OF DetalleVentaObj;

-- Se define el paquete "VENTAS_CRUD_PKG"
CREATE OR REPLACE PACKAGE VENTAS_CRUD_PKG AS

    -- Procedimiento para crear una nueva venta
    PROCEDURE CrearVenta(
        p_Venta_Id NUMBER,
        p_Cliente_Id NUMBER,
        p_Fecha_Venta DATE,
        p_PapitaFrita_Id NUMBER,
        p_Cantidad NUMBER,
        p_PrecioUnitario NUMBER
    );

    -- Procedimiento para actualizar los datos de una venta existente
    PROCEDURE ActualizarVenta(
        p_Venta_Id NUMBER,
        p_Cliente_Id NUMBER,
        p_Fecha_Venta DATE,
        p_PapitaFrita_Id NUMBER,
        p_Cantidad NUMBER,
        p_PrecioUnitario NUMBER
    );

    -- Procedimiento para eliminar una venta por su ID
    PROCEDURE BorrarVenta(p_Venta_Id NUMBER);

    -- Función para obtener los detalles de una venta por su ID
    FUNCTION obtener_detalle_venta(p_Venta_Id NUMBER) RETURN DetalleVentaTableType;

END VENTAS_CRUD_PKG;

-- Cuerpo del paquete "VENTAS_CRUD_PKG"
CREATE OR REPLACE PACKAGE BODY VENTAS_CRUD_PKG AS

    PROCEDURE CrearVenta(
        p_Venta_Id NUMBER,
        p_Cliente_Id NUMBER,
        p_Fecha_Venta DATE,
        p_PapitaFrita_Id NUMBER,
        p_Cantidad NUMBER,
        p_PrecioUnitario NUMBER
    ) IS
    BEGIN
        INSERT INTO Ventas (Venta_Id, Cliente_Id, Fecha_Venta, PapitaFrita_Id, Cantidad, PrecioUnitario)
        VALUES (p_Venta_Id, p_Cliente_Id, p_Fecha_Venta, p_PapitaFrita_Id, p_Cantidad, p_PrecioUnitario);
    END CrearVenta;

    PROCEDURE ActualizarVenta(
        p_Venta_Id NUMBER,
        p_Cliente_Id NUMBER,
        p_Fecha_Venta DATE,
        p_PapitaFrita_Id NUMBER,
        p_Cantidad NUMBER,
        p_PrecioUnitario NUMBER
    ) IS
    BEGIN
        UPDATE Ventas
        SET Cliente_Id = p_Cliente_Id,
            Fecha_Venta = p_Fecha_Venta,
            PapitaFrita_Id = p_PapitaFrita_Id,
            Cantidad = p_Cantidad,
            PrecioUnitario = p_PrecioUnitario
        WHERE Venta_Id = p_Venta_Id;
    END ActualizarVenta;

    PROCEDURE BorrarVenta(p_Venta_Id NUMBER) IS
    BEGIN
        DELETE FROM Ventas WHERE Venta_Id = p_Venta_Id;
    END BorrarVenta;

    FUNCTION obtener_detalle_venta(p_Venta_Id NUMBER) RETURN DetalleVentaTableType IS
        v_cursor SYS_REFCURSOR;
        v_detalles DetalleVentaTableType;
    BEGIN
        OPEN v_cursor FOR
            SELECT DetalleVentaObj(Venta_Id, Cliente_Id, Fecha_Venta, PapitaFrita_Id, Cantidad, PrecioUnitario)
            FROM Ventas
            WHERE Venta_Id = p_Venta_Id;

        FETCH v_cursor BULK COLLECT INTO v_detalles;

        CLOSE v_cursor;

        RETURN v_detalles;
    END obtener_detalle_venta;

END VENTAS_CRUD_PKG;

-- Se define el paquete "ProveedorPaquete"
CREATE OR REPLACE PACKAGE ProveedorPaquete AS

    PROCEDURE InsertarProveedor(
        p_id_proveedor NUMBER,
        p_nombre VARCHAR2,
        p_direccion VARCHAR2,
        p_telefono VARCHAR2
    );

    PROCEDURE ActualizarProveedor(
        p_id_proveedor NUMBER,
        p_nombre VARCHAR2,
        p_direccion VARCHAR2,
        p_telefono VARCHAR2
    );

    PROCEDURE EliminarProveedor(p_id_proveedor NUMBER);

    FUNCTION ObtenerDetalleProveedor(p_id_proveedor NUMBER) RETURN SYS_REFCURSOR;
END ProveedorPaquete;

-- Cuerpo del paquete "ProveedorPaquete"
CREATE OR REPLACE PACKAGE BODY ProveedorPaquete AS

    PROCEDURE InsertarProveedor(
        p_id_proveedor NUMBER,
        p_nombre VARCHAR2,
        p_direccion VARCHAR2,
        p_telefono VARCHAR2
    ) IS
    BEGIN
        INSERT INTO Proveedores (ID_Proveedor, Nombre, Direccion, Telefono)
        VALUES (p_id_proveedor, p_nombre, p_direccion, p_telefono);
    END InsertarProveedor;

    PROCEDURE ActualizarProveedor(
        p_id_proveedor NUMBER,
        p_nombre VARCHAR2,
        p_direccion VARCHAR2,
        p_telefono VARCHAR2
    ) IS
    BEGIN
        UPDATE Proveedores
        SET Nombre = p_nombre, Direccion = p_direccion, Telefono = p_telefono
        WHERE ID_Proveedor = p_id_proveedor;
    END ActualizarProveedor;

    PROCEDURE EliminarProveedor(p_id_proveedor NUMBER) IS
    BEGIN
        DELETE FROM Proveedores WHERE ID_Proveedor = p_id_proveedor;
    END EliminarProveedor;

    FUNCTION ObtenerDetalleProveedor(p_id_proveedor NUMBER) RETURN SYS_REFCURSOR IS
        v_cursor SYS_REFCURSOR;
    BEGIN
        OPEN v_cursor FOR
        SELECT *
        FROM Proveedores
        WHERE ID_Proveedor = p_id_proveedor;
        RETURN v_cursor;
    END ObtenerDetalleProveedor;

END ProveedorPaquete;

-- Se define el paquete "PapasCrudasPaquete"

CREATE OR REPLACE PACKAGE PapasCrudasPaquete AS

    PROCEDURE InsertarPapasCrudas(
        p_id_papas_crudas NUMBER,
        p_cantidad NUMBER,
        p_fecha_ingreso DATE,
        p_id_proveedor NUMBER
    );

    PROCEDURE ActualizarPapasCrudas(
        p_id_papas_crudas NUMBER,
        p_cantidad NUMBER,
        p_fecha_ingreso DATE,
        p_id_proveedor NUMBER
    );

    PROCEDURE EliminarPapasCrudas(p_id_papas_crudas NUMBER);

    FUNCTION ObtenerDetallePapasCrudas(p_id_papas_crudas NUMBER) RETURN SYS_REFCURSOR;
END PapasCrudasPaquete;

-- Cuerpo del paquete "PapasCrudasPaquete"
CREATE OR REPLACE PACKAGE BODY PapasCrudasPaquete AS

    PROCEDURE InsertarPapasCrudas(
        p_id_papas_crudas NUMBER,
        p_cantidad NUMBER,
        p_fecha_ingreso DATE,
        p_id_proveedor NUMBER
    ) IS
    BEGIN
        INSERT INTO PapasCrudas (ID_Papas_Crudas, Cantidad, Fecha_Ingreso, ID_Proveedor)
        VALUES (p_id_papas_crudas, p_cantidad, p_fecha_ingreso, p_id_proveedor);
    END InsertarPapasCrudas;

    PROCEDURE ActualizarPapasCrudas(
        p_id_papas_crudas NUMBER,
        p_cantidad NUMBER,
        p_fecha_ingreso DATE,
        p_id_proveedor NUMBER
    ) IS
    BEGIN
        UPDATE PapasCrudas
        SET Cantidad = p_cantidad, Fecha_Ingreso = p_fecha_ingreso, ID_Proveedor = p_id_proveedor
        WHERE ID_Papas_Crudas = p_id_papas_crudas;
    END ActualizarPapasCrudas;

    PROCEDURE EliminarPapasCrudas(p_id_papas_crudas NUMBER) IS
    BEGIN
        DELETE FROM PapasCrudas WHERE ID_Papas_Crudas = p_id_papas_crudas;
    END EliminarPapasCrudas;

    FUNCTION ObtenerDetallePapasCrudas(p_id_papas_crudas NUMBER) RETURN SYS_REFCURSOR IS
        v_cursor SYS_REFCURSOR;
    BEGIN
        OPEN v_cursor FOR
        SELECT *
        FROM PapasCrudas
        WHERE ID_Papas_Crudas = p_id_papas_crudas;
        RETURN v_cursor;
    END ObtenerDetallePapasCrudas;

END PapasCrudasPaquete;

-- Se define el paquete "PapasFritasPaquete"
CREATE OR REPLACE PACKAGE PapasFritasPaquete AS

    PROCEDURE InsertarPapasFritas(
        p_id_papas_fritas NUMBER,
        p_cantidad NUMBER,
        p_fecha_produccion DATE,
        p_id_papas_crudas NUMBER
    );

    PROCEDURE ActualizarPapasFritas(
        p_id_papas_fritas NUMBER,
        p_cantidad NUMBER,
        p_fecha_produccion DATE,
        p_id_papas_crudas NUMBER
    );

    PROCEDURE EliminarPapasFritas(p_id_papas_fritas NUMBER);


    FUNCTION ObtenerDetallePapasFritas(p_id_papas_fritas NUMBER) RETURN SYS_REFCURSOR;
END PapasFritasPaquete;

-- Cuerpo del paquete "PapasFritasPaquete"
CREATE OR REPLACE PACKAGE BODY PapasFritasPaquete AS

    PROCEDURE InsertarPapasFritas(
        p_id_papas_fritas NUMBER,
        p_cantidad NUMBER,
        p_fecha_produccion DATE,
        p_id_papas_crudas NUMBER
    ) IS
    BEGIN
        INSERT INTO PapasFritas (ID_Papas_Fritas, Cantidad, Fecha_Produccion, ID_Papas_Crudas)
        VALUES (p_id_papas_fritas, p_cantidad, p_fecha_produccion, p_id_papas_crudas);
    END InsertarPapasFritas;

    PROCEDURE ActualizarPapasFritas(
        p_id_papas_fritas NUMBER,
        p_cantidad NUMBER,
        p_fecha_produccion DATE,
        p_id_papas_crudas NUMBER
    ) IS
    BEGIN
        UPDATE PapasFritas
        SET Cantidad = p_cantidad, Fecha_Produccion = p_fecha_produccion, ID_Papas_Crudas = p_id_papas_crudas
        WHERE ID_Papas_Fritas = p_id_papas_fritas;
    END ActualizarPapasFritas;

    PROCEDURE EliminarPapasFritas(p_id_papas_fritas NUMBER) IS
    BEGIN
        DELETE FROM PapasFritas WHERE ID_Papas_Fritas = p_id_papas_fritas;
    END EliminarPapasFritas;

    FUNCTION ObtenerDetallePapasFritas(p_id_papas_fritas NUMBER) RETURN SYS_REFCURSOR IS
        v_cursor SYS_REFCURSOR;
    BEGIN
        OPEN v_cursor FOR
        SELECT *
        FROM PapasFritas
        WHERE ID_Papas_Fritas = p_id_papas_fritas;
        RETURN v_cursor;
    END ObtenerDetallePapasFritas;

END PapasFritasPaquete;

-- /////////////////////////////////////////////////////////////////////////////C
/* c) Creación de Inserciones, Borrados y actualización de datos con
Procedimientos almacenados o funciones. – CRUD (Relacione con los
paquetes) */

DECLARE
    -- Variables para almacenar los detalles del empleado y mensajes de error
    emp_details SYS_REFCURSOR;
    error_message VARCHAR2(200);

BEGIN
    -- Intenta insertar un nuevo empleado
    BEGIN
        EMPLEADO_CRUD_PKG.insertar_empleado(54, 'Nombre', 'Cargo', NULL, SYSDATE, 50000, 0, 1);
    EXCEPTION
        WHEN OTHERS THEN
        -- Captura el mensaje de error en la variable error_message
        error_message := SQLERRM;
    END;

    -- Intenta obtener detalles del empleado recién insertado
    BEGIN
        emp_details := EMPLEADO_CRUD_PKG.obtener_detalle_empleado(54);
        -- Aquí puedes hacer algo con los detalles del empleado si la operación es exitosa
    EXCEPTION
        WHEN OTHERS THEN
        -- Captura el mensaje de error en la variable error_message
        error_message := SQLERRM;
    END;

    -- Imprime el mensaje de error
    DBMS_OUTPUT.PUT_LINE('Error: ' || error_message);
END;


-- ///////////////////////////////////////////////////////////////////D
/* d) Evidencie uso de estructuras de control. */

CREATE OR REPLACE PROCEDURE determinar_comision (p_emp_id NUMBER) AS
    v_salario NUMBER;
    v_comision NUMBER;
BEGIN
    -- Obtener el salario del empleado
    SELECT EMP_SALARIO INTO v_salario FROM EMPLEADOS WHERE EMP_ID = p_emp_id;

    -- Determinar la comisión basada en el salario
    IF v_salario >= 50000 THEN
        v_comision := 0.1; -- 10% de comisión para salarios mayores o iguales a 50000
    ELSE
        v_comision := 0.05; -- 5% de comisión para salarios menores a 50000
    END IF;

    -- Mostrar el resultado
    DBMS_OUTPUT.PUT_LINE('Empleado ID ' || p_emp_id || ' tiene una comisión del ' || v_comision * 100 || '%.');
END determinar_comision;/

-- DECLARE
--     emp_id NUMBER := 1; -- Puedes cambiar el ID del empleado según tu base de datos
-- BEGIN
--     determinar_comision(emp_id);
-- END;


-- ///////////////////////////////////////////////////////////////////////////////////E
/* e) Manejo de excepciones. */


-- Ejemplo de llamada a la función para obtener detalles de un empleado
VAR emp_details REFCURSOR;
BEGIN
  :emp_details := EMPLEADO_CRUD_PKG.obtener_detalle_empleado(1);
END;

-- Mostrar resultados del cursor
PRINT emp_details;

-- Alternativamente, puedes usar un bloque LOOP para mostrar los resultados fila por fila
DECLARE
    emp_id NUMBER;
    emp_nombre VARCHAR2(10);
    emp_cargo VARCHAR2(10);
    -- Otros campos según la estructura de la tabla EMPLEADOS
BEGIN
    LOOP
        FETCH :emp_details INTO emp_id, emp_nombre, emp_cargo;
        EXIT WHEN :emp_details%NOTFOUND;
        DBMS_OUTPUT.PUT_LINE('ID: ' || emp_id || ', Nombre: ' || emp_nombre || ', Cargo: ' || emp_cargo);
    END LOOP;
    CLOSE :emp_details;
END;


-- /////////////////////////////////////////////////////////////////////F
/* f) Creación de Tablas y de registros (Normal, Subconsultas, Alterar Tablas y
Borrar Tablas, Manejo de Restricciones. */

CREATE OR REPLACE PROCEDURE DETERMINAR_COMISION(p_emp_id NUMBER) AS
    v_comision NUMBER;
    v_dep_id NUMBER;
BEGIN
    -- Intentar recuperar datos de la tabla EMPLEADOS
    SELECT EMP_COMISION, DEP_ID
    INTO v_comision, v_dep_id
    FROM EMPLEADOS
    WHERE EMP_ID = p_emp_id;

EXCEPTION
    -- Capturar la excepción cuando no se encuentra ninguna fila
    WHEN NO_DATA_FOUND THEN
        DBMS_OUTPUT.PUT_LINE('Error: No se encontró ningún dato para el empleado ' || p_emp_id);
    
    -- Capturar otras excepciones específicas y manejarlas según sea necesario
    WHEN OTHERS THEN
        DBMS_OUTPUT.PUT_LINE('Error inesperado: ' || SQLERRM);
END DETERMINAR_COMISION;


-- Invocar el procedimiento con un ID de empleado específico (por ejemplo, 1)
DECLARE
    emp_id NUMBER := 1; -- Puedes cambiar el ID del empleado según tu base de datos
BEGIN
    DETERMINAR_COMISION(emp_id);
END;


-- ////////////////////////////////////////////////////////////////////////////G
/* g) Uso de al menos 3 Cursores (donde lo considere necesario) */

CREATE TABLE empleados_sub AS
SELECT emp_id, emp_nombre FROM empleados WHERE emp_salario > 3000:
INSERT INTO departamentos VALUES (10, 'Contabilidad'); 
INSERT INTO departamentos VALUES (20, 'Ventas');
ALTER TABLE departamentos ADD piso NUMBER;
DROP TABLE departamentos;


-- ////////////////////////////////////////////////////////////////////////////H
/* h) Al menos 4 reglas de negocio que estén relacionadas con restricciones a los
datos de una tabla. - implementar Trigger */

CREATE OR REPLACE TRIGGER check_salario_minimo
BEFORE INSERT OR UPDATE ON EMPLEADOS
FOR EACH ROW
DECLARE
    salario_minimo NUMBER := 50000; -- Salario mínimo permitido
BEGIN
    IF :NEW.SALARIO < salario_minimo THEN
        RAISE_APPLICATION_ERROR(-20001, 'El salario no puede ser inferior al salario mínimo ('|| salario_minimo ||').');
    END IF;
END;

-- ///

CREATE OR REPLACE TRIGGER check_fecha_contrato
BEFORE INSERT OR UPDATE ON EMPLEADOS
FOR EACH ROW
DECLARE
    fecha_limite DATE := TO_DATE('01-01-2000', 'DD-MM-YYYY'); -- Fecha límite permitida
BEGIN
    IF :NEW.EMP_FECHACONTRATO < fecha_limite THEN
        RAISE_APPLICATION_ERROR(-20002, 'La fecha de contrato no puede ser anterior a cierta fecha.');
    END IF;
END;

-- ///

CREATE OR REPLACE TRIGGER check_jefe
BEFORE UPDATE ON EMPLEADOS
FOR EACH ROW
BEGIN
    IF :NEW.EMP_ID = :NEW.EMP_JEFE THEN
        RAISE_APPLICATION_ERROR(-20003, 'Un empleado no puede ser su propio jefe.');
    END IF;
END;

-- ///

CREATE OR REPLACE TRIGGER check_max_empleados_por_departamento
BEFORE INSERT OR UPDATE ON EMPLEADOS
FOR EACH ROW
DECLARE
    max_empleados_por_departamento NUMBER := 100; -- Cantidad máxima permitida de empleados por departamento
    cantidad_empleados NUMBER;
BEGIN
    SELECT COUNT(*) INTO cantidad_empleados
    FROM EMPLEADOS
    WHERE DEP_ID = :NEW.DEP_ID;

    IF cantidad_empleados >= max_empleados_por_departamento THEN
        RAISE_APPLICATION_ERROR(-20004, 'Se ha alcanzado la cantidad máxima de empleados para este departamento.');
    END IF;
END;

-- ////////////////////////////////////////////////////////////////////////////////i
/* i) Creación y Generación de vistas */

CREATE OR REPLACE VIEW vista_empleados AS
SELECT EMP_ID, EMP_NOMBRE, EMP_CARGO, EMP_FECHACONTRATO, DEP_ID
FROM EMPLEADOS
WHERE EMP_SALARIO > 500;

-- /////////////////////////////////////////////////////////////////////////j
/* j) Revisión de diccionario de datos. */

SELECT * FROM ALL_TAB_COLUMNS WHERE TABLE_NAME = 'EMPLEADOS';

-- //////////////////////////////////////////////////////////////////////////K
/* k) Generación de índices y secuencias */

CREATE INDEX xxxxxxxx ON empleados(empleados.emp_id);

-- ///

CREATE SEQUENCE empleados_ss
START WITH 1
INCREMENT BY 1
NOCACHE
NOCYCLE;

-- ///////////////////////////////////////////////////////////////////////////L
/* l) Una regla de negocio está relacionada con el formato de datos. */

CREATE OR REPLACE TRIGGER formato_nombres_cargos
BEFORE INSERT OR UPDATE ON EMPLEADOS
FOR EACH ROW
BEGIN
    :NEW.NOMBRE := UPPER(:NEW.NOMBRE); -- Convierte el nombre a mayúsculas
    :NEW.CARGO := UPPER(:NEW.CARGO); -- Convierte el cargo a mayúsculas
END;




-- //////////////////////////////////////////////////////////////////////

-- CREATE OR REPLACE PROCEDURE DETERMINAR_COMISION(p_emp_id NUMBER) AS
--     v_comision NUMBER;
-- BEGIN
--     SELECT COMISION INTO v_comision
--     FROM TU_TABLA
--     WHERE EMP_ID = p_emp_id;
-- EXCEPTION
--     WHEN TOO_MANY_ROWS THEN
--         -- Puedes seleccionar solo la primera fila o mostrar un mensaje de error
--         DBMS_OUTPUT.PUT_LINE('Error: Se obtuvieron más de una fila para el empleado ' || p_emp_id);
--     WHEN NO_DATA_FOUND THEN
--         -- Manejar el caso cuando no se encuentra ninguna fila
--         DBMS_OUTPUT.PUT_LINE('Error: No se encontró ningún dato para el empleado ' || p_emp_id);
-- END DETERMINAR_COMISION;

-- ///
