USE SGP;
INSERT INTO offices (id, name, short_name, description, status) VALUES
(1, 'ALCALDÍA', 'ALC', 'Despacho del alcalde, máxima autoridad del gobierno local.', 1),
(2, 'SECRETARÍA GENERAL', 'SGEN', 'Encargada de tramitar, archivar y dar fe de los actos administrativos.', 1),
(3, 'GERENCIA MUNICIPAL', 'GEMU', 'Coordina y supervisa las áreas operativas y administrativas.', 1),
(4, 'ASESORÍA JURÍDICA', 'ASEJUR', 'Brinda asesoría legal a todas las dependencias municipales.', 1),
(5, 'OFICINA DE GESTIÓN ADMINISTRATIVA Y FINANCIERA', 'OGAF', 'Gestiona los recursos humanos, logísticos y financieros.', 1),
(6, 'OFICINA DE PLANEAMIENTO, PRESUPUESTO Y DESARROLLO', 'OPPDP', 'Elabora y evalúa planes, programas y presupuestos institucionales.', 1),
(7, 'OFICINA DE TECNOLOGÍAS DE LA INFORMACIÓN Y SISTEMAS', 'OGTI', 'Administra la infraestructura tecnológica y sistemas informáticos.', 1),
(8, 'UNIDAD DE TALENTO HUMANO', 'RH', 'Gestiona los recursos humanos y desarrolla capacidades del personal.', 1),
(9, 'UNIDAD DE TESORERÍA', 'TES', 'Administra el flujo de caja, ingresos y egresos de la municipalidad.', 1),
(10, 'UNIDAD DE CONTABILIDAD', 'CONTA', 'Registra y controla la información contable de la entidad.', 1),
(11, 'UNIDAD DE ABASTECIMIENTO', 'ABA', 'Encargada de compras, almacenamiento y distribución de bienes.', 1),
(12, 'OFICINA DE IMAGEN INSTITUCIONAL', 'IMAG', 'Maneja la comunicación y proyección institucional.', 1),
(13, 'UNIDAD DE CATASTRO', 'CAT', 'Administra la información física y legal de los predios del distrito.', 1),
(14, 'UNIDAD DE DEMUNA', 'DEMUNA', 'Defiende y promueve los derechos de los niños y adolescentes.', 1),
(15, 'UNIDAD DE SISFOH', 'SISFOH', 'Administra la clasificación socioeconómica de los hogares.', 1),
(16, 'SUBGERENCIA DE SERVICIOS MUNICIPALES Y AMBIENTALES', 'SERVMUN', 'Gestiona limpieza, áreas verdes, residuos y ornato.', 1),
(17, 'SUBGERENCIA DE DESARROLLO HUMANO Y SOCIAL', 'DESHUM', 'Promueve programas sociales, culturales y educativos.', 1),
(18, 'SUBGERENCIA DE DESARROLLO ECONÓMICO Y SANEAMIENTO', 'DESECO', 'Impulsa la actividad económica local y el saneamiento básico.', 1),
(19, 'SUBGERENCIA DE PLANEAMIENTO URBANO Y RURAL', 'URBPLAN', 'Planifica el crecimiento urbano y rural del distrito.', 1),
(20, 'SUBGERENCIA DE EJECUCIÓN DE INVERSIONES', 'EJEINV', 'Supervisa la ejecución de proyectos de inversión pública.', 1),
(21, 'SUBGERENCIA DE INVERSIONES Y ESTUDIOS', 'ESTINV', 'Elabora estudios técnicos y proyectos de inversión pública.', 1),
(22, 'GERENCIA DE GESTIÓN TRIBUTARIA', 'GESTTRIB', 'Recauda y fiscaliza los tributos municipales.', 1),
(23, 'GERENCIA DE DESARROLLO TERRITORIAL', 'GESTTERR', 'Coordina proyectos de ordenamiento y uso del territorio.', 1),
(24, 'GERENCIA DE DESARROLLO SOSTENIBLE', 'GESTSOST', 'Promueve políticas de sostenibilidad y gestión ambiental.', 1),
(25, 'OFICINA SIN NOMBRE', 'OSN', 'Dependencia sin denominación específica registrada.', 0),
(26, 'OFICINA DE ASUNTOS DESCONOCIDOS', 'ODAD', 'Área genérica utilizada para registros provisionales.', 1),
(27, 'OFICINA DE INNOVACIÓN', 'OIN', 'Promueve la mejora continua e innovación institucional.', 0);


INSERT INTO job_positions (id, name, description, status) VALUES
(1, 'ALCALDE', 'Máxima autoridad ejecutiva de la Municipalidad', 1),
(2, 'SECRETARIO GENERAL', 'Encargado de tramitar, notificar y archivar la documentación municipal', 1),
(3, 'GERENTE MUNICIPAL', 'Responsable de coordinar y supervisar todas las áreas operativas', 1),
(4, 'ASESOR JURÍDICO', 'Asesora en asuntos legales y normativos a todas las unidades', 1),
(5, 'JEFE DE ADMINISTRACIÓN Y FINANZAS', 'Dirige la gestión administrativa, logística y financiera', 1),
(6, 'JEFE DE PLANEAMIENTO Y PRESUPUESTO', 'Encargado de formular planes y presupuestos institucionales', 1),
(7, 'JEFE DE OGTI', 'Encargado de los sistemas informáticos, redes y soporte técnico', 1),
(8, 'JEFE DE TALENTO HUMANO', 'Gestiona el personal y recursos humanos', 1),
(9, 'TESORERO MUNICIPAL', 'Gestiona ingresos y egresos financieros', 1),
(10, 'CONTADOR MUNICIPAL', 'Responsable de la contabilidad y estados financieros', 1),
(11, 'JEFE DE ABASTECIMIENTO', 'Gestiona compras, logística y almacén', 1),
(12, 'JEFE DE IMAGEN INSTITUCIONAL', 'Comunica y difunde la imagen institucional', 1),
(13, 'JEFE DE CATASTRO', 'Administra la base de datos predial y territorial', 1),
(14, 'RESPONSABLE DEMUNA', 'Protección de derechos de niños y adolescentes', 1),
(15, 'RESPONSABLE SISFOH', 'Administra el sistema de focalización de hogares', 1),
(16, 'SUBGERENTE DE SERVICIOS MUNICIPALES', 'Dirige limpieza, residuos y servicios básicos', 1),
(17, 'SUBGERENTE DE DESARROLLO HUMANO', 'Gestiona programas sociales y comunitarios', 1),
(18, 'SUBGERENTE DE DESARROLLO ECONÓMICO', 'Promueve actividades económicas y productivas', 1),
(19, 'SUBGERENTE DE URBANISMO Y RURALIDAD', 'Gestiona zonificación y desarrollo territorial', 1),
(20, 'SUBGERENTE DE EJECUCIÓN DE OBRAS', 'Encargado de la ejecución de obras públicas', 1),
(21, 'SUBGERENTE DE ESTUDIOS Y PROYECTOS', 'Elabora y evalúa estudios técnicos y de inversión', 1),
(22, 'GERENTE DE TRIBUTACIÓN', 'Supervisa y controla el sistema de tributos locales', 1),
(23, 'GERENTE DE DESARROLLO TERRITORIAL', 'Coordina obras y ordenamiento físico-territorial', 1),
(24, 'GERENTE DE DESARROLLO SOSTENIBLE', 'Lidera programas de sostenibilidad ambiental y social', 1),
(25, 'GERENTE DE SEGURIDAD Y SERENAZGOS', NULL, 1);


INSERT INTO contract_types (id, name, description, status) VALUES
(1, 'NOMBRADO', 'Trabajador bajo el régimen del Decreto Legislativo N.° 276, con estabilidad laboral.', 1),
(2, 'CONTRATADO D.L. 276', 'Contrato temporal bajo el régimen de la Ley N.° 276.', 1),
(3, 'CONTRATO CAS', 'Contrato Administrativo de Servicios regulado por la Ley N.° 1057.', 1),
(4, 'LOCACIÓN DE SERVICIOS', 'Prestación de servicios por terceros sin vínculo laboral directo.', 1),
(5, 'PRACTICANTE PRE-PROFESIONAL', 'Estudiante en formación que realiza prácticas supervisadas.', 1),
(6, 'PRACTICANTE PROFESIONAL', 'Egresado de una carrera profesional que realiza prácticas profesionales.', 1),
(7, 'SUPLENCIA', 'Contrato temporal para reemplazo de personal con licencia o inasistencia prolongada.', 1),
(8, 'SERVICIOS PERSONALES', 'Vinculación por honorarios en labores específicas no permanentes.', 1),
(9, 'CONTRATO TEMPORAL', 'Modalidad de contratación eventual por necesidad institucional.', 0);

INSERT INTO workers (id, dni, first_name, last_name_paternal, last_name_maternal, email, phone, office_id, job_position_id, contract_type_id, status) VALUES
(1, '72581301', 'JUAN ELMER', 'RAMIREZ', 'QUISPE', 'juan.ramirez@winner-systems.com', '912345670', 1, 1, 1, 1),
(2, '70819234', 'MARIA DEL CARMEN', 'HUAMAN', 'CARRILLO', 'maria.huaman@winner-systems.com', '912345671', 2, 2, 2, 1),
(3, '71234567', 'LUIS MIGUEL', 'ESPINOZA', 'SALAZAR', 'luis.espinoza@winner-systems.com', '912345672', 3, 3, 1, 1),
(4, '71543218', 'MARÍA JOSEFA', 'SALAZAR', 'MENDOZA', 'maria.salazar@winner-systems.com', '912345673', 4, 4, 3, 1),
(5, '70192384', 'CARLOS ANDRÉS', 'CCAPA', 'VALVERDE', 'carlos.ccapa@winner-systems.com', '912345674', 5, 5, 6, 1),
(6, '70458291', 'ROSARIO ELENA', 'CHÁVEZ', 'RAMÍREZ', 'rosario.chavez@winner-systems.com', '912345675', 6, 6, 2, 1),
(7, '71639125', 'HUGO MANUEL', 'LOPEZ', 'QUISPE', 'hugo.lopez@winner-systems.com', '912345676', 7, 7, 1, 1),
(8, '70518342', 'PAULA GABRIELA', 'CRUZ', 'GONZALES', 'paula.cruz@winner-systems.com', '912345677', 8, 8, 1, 1),
(9, '71128394', 'JORGE ANTONIO', 'MAMANI', 'HUERTA', 'jorge.mamani@winner-systems.com', '912345678', 9, 9, 3, 1),
(10, '72239184', 'SANDRA MILAGROS', 'APAZA', 'LUQUE', 'sandra.apaza@winner-systems.com', '912345679', 10, 10, 4, 1);

INSERT INTO asset_types (id, name, description, status) VALUES
(1, 'HARDWARE', 'Laptops, CPUs, monitores, teclados, mouse, impresoras, escáneres.', 1),
(2, 'SOFTWARE', 'Windows 10, Microsoft Office, Adobe Photoshop, AutoCAD, Visual Studio Code, IntelliJ IDEA, Kaspersky, ESET, LibreOffice, SPSS, Matlab.', 1),
(3, 'MOBILIARIOS', 'Sillas, escritorios, estantes, mesas, vitrinas, etc.', 1),
(4, 'MAQUINARÍAS', 'Autos, camionetas, motos, volquetes, maquinaria pesada, etc.', 1),
(5, 'HERRAMIENTAS', 'Taladros, llaves inglesas, destornilladores, martillos, alicates, sierras, pinzas, niveles, llaves de tubo, cintas métricas.', 1),
(6, 'OTROS', 'Electrodomésticos u otros activos no clasificados, como microondas, refrigeradoras, ventiladores, cocinas eléctricas, termos, entre otros.', 1);
-- SELECT * FROM asset_types;

INSERT INTO asset_states (id, name, description, status) VALUES
(1, 'NUEVO', 'El bien ha sido adquirido recientemente y no ha sido usado.', 1),
(2, 'BUENO', 'El bien se encuentra en condiciones óptimas para su uso.', 1),
(3, 'REGULAR', 'El bien presenta desgaste o fallas menores, pero es funcional.', 1),
(4, 'MALO', 'El bien está deteriorado y requiere reparación para su uso.', 1),
(5, 'INOPERATIVO', 'El bien no funciona y no puede ser utilizado.', 1),
(6, 'EN MANTENIMIENTO', 'El bien está en proceso de revisión o reparación.', 1),
(7, 'DADO DE BAJA', 'El bien ha sido retirado oficialmente del inventario.', 0),
(8, 'REASIGNADO', 'El bien ha sido transferido a otra oficina o usuario.', 1);

INSERT INTO software_types (id, name, description, status) VALUES 
(1, 'PROPIETARIO', 'Software con licencia comercial, derechos de autor restrictivos y código fuente cerrado.', 1),
(2, 'LIBRE', 'Software que garantiza las cuatro libertades fundamentales: usar, estudiar, modificar y distribuir.', 1),
(3, 'CÓDIGO ABIERTO', 'Software con código fuente accesible, enfocado en el modelo de desarrollo colaborativo.', 1),
(4, 'DESARROLLADO INTERNAMENTE', 'Software creado por el personal interno de la organización para necesidades específicas.', 1),
(5, 'HÍBRIDO - FREEMIUM', 'Software que combina versiones gratuitas básicas con funcionalidades premium de pago.', 1);

SHOW TABLES;
DESCRIBE permissions;
INSERT INTO permissions (name, guard_name) VALUES
('ver usuarios', 'web'),
('crear usuarios', 'web'),
('actualizar usuarios', 'web'),
('eliminar usuarios', 'web'),
('gestionar roles de usuarios', 'web'),
('ver roles', 'web'),
('crear roles', 'web'),
('actualizar roles', 'web'),
('eliminar roles', 'web'),
('ver permisos', 'web'),
('crear permisos', 'web'),
('actualizar permisos', 'web'),
('eliminar permisos', 'web'),
('ver oficinas', 'web'),
('crear oficinas', 'web'),
('actualizar oficinas', 'web'),
('eliminar oficinas', 'web'),
('ver tipos de contratos', 'web'),
('crear tipos de contratos', 'web'),
('actualizar tipos de contratos', 'web'),
('eliminar tipos de contratos', 'web'),
('ver puestos de trabajo', 'web'),
('crear puestos de trabajo', 'web'),
('actualizar puestos de trabajo', 'web'),
('eliminar puestos de trabajo', 'web'),
('ver trabajadores', 'web'),
('crear trabajadores', 'web'),
('actualizar trabajadores', 'web'),
('eliminar trabajadores', 'web'),
('asignar trabajadores', 'web'),
('ver tipos de activos', 'web'),
('crear tipos de activos', 'web'),
('actualizar tipos de activos', 'web'),
('eliminar tipos de activos', 'web'),
('ver estados de activos', 'web'),
('crear estados de activos', 'web'),
('actualizar estados de activos', 'web'),
('eliminar estados de activos', 'web'),
('ver tipos de software', 'web'),
('crear tipos de software', 'web'),
('actualizar tipos de software', 'web'),
('eliminar tipos de software', 'web'),
('ver activos de la empresa', 'web'),
('crear activos de la empresa', 'web'),
('actualizar activos de la empresa', 'web'),
('eliminar activos de la empresa', 'web'),
('aprobar activos de la empresa', 'web'),
('ver mobiliarios', 'web'),
('crear mobiliarios', 'web'),
('actualizar mobiliarios', 'web'),
('eliminar mobiliarios', 'web'),
('asignar mobiliarios', 'web'),
('ver hardware', 'web'),
('crear hardware', 'web'),
('actualizar hardware', 'web'),
('eliminar hardware', 'web'),
('asignar hardware', 'web'),
('ver maquinaria', 'web'),
('crear maquinaria', 'web'),
('actualizar maquinaria', 'web'),
('eliminar maquinaria', 'web'),
('asignar maquinaria', 'web'),
('ver otros activos', 'web'),
('crear otros activos', 'web'),
('actualizar otros activos', 'web'),
('eliminar otros activos', 'web'),
('asignar otros activos', 'web'),
('ver software', 'web'),
('crear software', 'web'),
('actualizar software', 'web'),
('eliminar software', 'web'),
('licenciar software', 'web');

SELECT * FROM roles;
INSERT INTO roles (name, guard_name) VALUES
('Admin', 'web'),
('Autoridad', 'web'),
('Usuario', 'web')


Mutaddores y Accesores
public function name(): Attribute  
    {
        return new Attribute(
        get: fn($name)=> strtolower($name),
        set: fn($name)=> strtolower($name)
        );
    }

{{-- 
    @Author: Edwin Yoner
    @Date: 2025-09-08
    @Change: Adaptación del sidebar para mostrar foto con esquinas redondeadas 
--}}