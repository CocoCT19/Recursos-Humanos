# Casos de Prueba -- Gestión de Colaboradores

------------------------------------------------------------------------

## Caso de prueba 001

  -----------------------------------------------------------------------
  Campo                    Información
  ------------------------ ----------------------------------------------
  **ID del Caso de         CP-001
  Prueba**                 

  **Título de la Prueba**  Creación de colaborador con datos válidos

  **Módulo /               Gestión de colaboradores -- Creación
  Característica**         

  **Descripción**          Verificar que se puede crear un nuevo
                           colaborador cuando todos los datos ingresados
                           son válidos.

  **Precondiciones**       1\. Usuario autenticado. <br>  2. No
                           existe un colaborador con el número de
                           documento ingresado.

  **Pasos para la          1\. Autenticar usuario. <br>   2. Enviar
  Ejecución**              solicitud POST a `/collaborators` con datos
                           válidos.

  **Datos de Entrada**     first_name: Juan<br> last_name:
                           Pérez<br> document_type:
                           CC<br> document_number:
                           123456<br> birth_date:
                           1999-06-15<br> email:
                           juan@test.com<br> phone_number:
                           3001234567<br> address: Calle 123

  **Resultado Esperado**   Respuesta HTTP 302 con redirección a
                           `/collaborators` y registro creado en la base
                           de datos.

  **Resultado Real**       Registro creado correctamente y redirección
                           ejecutada.

  **Estado**               Pasa
  -----------------------------------------------------------------------

------------------------------------------------------------------------

## Caso de prueba 002

  -----------------------------------------------------------------------
  Campo                    Información
  ------------------------ ----------------------------------------------
  **ID del Caso de         CP-002
  Prueba**                 

  **Título de la Prueba**  Validación de documento duplicado

  **Módulo /               Gestión de colaboradores -- Creación
  Característica**         

  **Descripción**          Verificar que el sistema rechaza la creación
                           de un colaborador con un número de documento
                           ya existente.

  **Precondiciones**       1\. Usuario autenticado.<br> 2. Existe
                           un colaborador registrado con document_number
                           999999.

  **Pasos para la          1\. Autenticar usuario.<br> 2. Enviar
  Ejecución**              solicitud POST a `/collaborators` con un
                           número de documento ya registrado.

  **Datos de Entrada**     first_name: Pedro<br> last_name:
                           Gómez<br> document_type:
                           CC<br> document_number:
                           999999<br> birth_date:
                           1998-01-01<br> email:
                           pedro@test.com<br> phone_number:
                           3111111111<br> address: Calle 2

  **Resultado Esperado**   Respuesta HTTP 302 con error de validación en
                           el campo document_number y no se crea un
                           nuevo registro en base de datos.

  **Resultado Real**       El sistema genera error de validación y
                           mantiene un único registro.

  **Estado**               Pasa
  -----------------------------------------------------------------------

------------------------------------------------------------------------

## Caso de prueba 003

  -------------------------------------------------------------------------
  Campo                    Información
  ------------------------ ------------------------------------------------
  **ID del Caso de         CP-003
  Prueba**                 

  **Título de la Prueba**  Actualización de colaborador existente

  **Módulo /               Gestión de colaboradores -- Edición
  Característica**         

  **Descripción**          Verificar que se puede actualizar la información
                           de un colaborador existente con datos válidos.

  **Precondiciones**       1\. Usuario autenticado.<br> 2. Existe
                           un colaborador registrado en la base de datos.

  **Pasos para la          1\. Autenticar usuario.<br> 2. Enviar
  Ejecución**              solicitud PUT a `/collaborators`/{id} con datos
                           actualizados válidos.

  **Datos de Entrada**     first_name: Juan Carlos<br> last_name:
                           Pérez Gómez<br> document_type:
                           CC<br> document_number:
                           111111<br> birth_date:
                           1990-01-01<br> email:
                           juan.carlos@test.com<br> phone_number:
                           3111111111<br> address: Calle
                           Actualizada

  **Resultado Esperado**   Respuesta HTTP 302 con redirección a
                           `/collaborators` y datos actualizados en la base
                           de datos.

  **Resultado Real**       Actualización realizada correctamente.

  **Estado**               Pasa
  -------------------------------------------------------------------------

------------------------------------------------------------------------

## Caso de prueba 004

  -----------------------------------------------------------------------
  Campo                    Información
  ------------------------ ----------------------------------------------
  **ID del Caso de         CP-004
  Prueba**                 

  **Título de la Prueba**  Consulta de listado de colaboradores

  **Módulo /               Gestión de colaboradores -- Listado
  Característica**         

  **Descripción**          Verificar que se puede obtener el listado
                           completo de todos los colaboradores
                           registrados.

  **Precondiciones**       1\. Usuario autenticado.<br> 2.
                           Existen colaboradores registrados en la base
                           de datos.

  **Pasos para la          1\. Autenticar usuario.<br> 2. Enviar
  Ejecución**              solicitud GET a `/collaborators`.

  **Datos de Entrada**     No aplica

  **Resultado Esperado**   Respuesta HTTP 200 con listado en formato JSON
                           que contenga todos los colaboradores
                           registrados.

  **Resultado Real**       Respuesta HTTP 200 con los registros
                           correspondientes.

  **Estado**               Pasa
  -----------------------------------------------------------------------

------------------------------------------------------------------------

## Caso de prueba 005

  -----------------------------------------------------------------------
  Campo                    Información
  ------------------------ ----------------------------------------------
  **ID del Caso de         CP-005
  Prueba**                 

  **Título de la Prueba**  Eliminación lógica (Soft Delete) de
                           colaborador

  **Módulo /               Gestión de colaboradores -- Eliminación
  Característica**         

  **Descripción**          Verificar que se puede eliminar (mediante soft
                           delete) un colaborador existente.

  **Precondiciones**       1\. Usuario autenticado.<br> 2. Existe
                           colaborador activo en la base de datos.

  **Pasos para la          1\. Autenticar usuario.<br> 2. Enviar
  Ejecución**              solicitud DELETE a `/collaborators`/{id}.

  **Datos de Entrada**     ID válido de colaborador

  **Resultado Esperado**   Respuesta HTTP 200 y el campo deleted_at del
                           registro es llenado en la base de datos (Soft
                           Delete aplicado).

  **Resultado Real**       Eliminación lógica realizada correctamente.

  **Estado**               Pasa
  -----------------------------------------------------------------------
