# Casos de Prueba -- Gestión de Contratos

------------------------------------------------------------------------

## Caso de prueba 001

  ---------------------------------------------------------------------
  Campo                   Información
  ----------------------- ---------------------------------------------
  **ID del Caso de        CP-001
  Prueba**                

  **Título de la Prueba** Creación de contrato con colaborador
                          existente

  **Módulo /              Gestión de contratos -- Creación
  Característica**        

  **Descripción**         Verificar que se puede crear un contrato
                          cuando el colaborador existe y los datos
                          ingresados son válidos.

  **Precondiciones**      1\. Usuario autenticado. <br> 2.
                          Existe un colaborador en la base de datos.

  **Pasos para la         1\. Autenticar usuario. <br> 2.
  Ejecución**             Enviar solicitud POST a `/contracts` con
                          datos válidos.

  **Datos de Entrada**    collaborator_id: 1<br>
                          contract_type: Fijo<br> start_date:
                          2026-01-01<br> end_date:
                          2026-12-31<br> position:
                          Developer<br> salary:
                          3000000<br> status: Activo

  **Resultado Esperado**  Respuesta HTTP 201 o 200 y registro creado en
                          la tabla `contracts`.

  **Resultado Real**      Registro creado correctamente.

  **Estado**              Pasa
  ---------------------------------------------------------------------

------------------------------------------------------------------------

## Caso de prueba 002

  ---------------------------------------------------------------------
  Campo                   Información
  ----------------------- ---------------------------------------------
  **ID del Caso de        CP-002
  Prueba**                

  **Título de la Prueba** No permitir creación de contrato con
                          colaborador inexistente

  **Módulo /              Gestión de contratos -- Validación
  Característica**        

  **Descripción**         Verificar que el sistema no permite crear un
                          contrato cuando el colaborador no existe.

  **Precondiciones**      1\. Usuario autenticado. <br> 2. No
                          existe un colaborador con ID 999.

  **Pasos para la         1\. Autenticar usuario. <br> 2.
  Ejecución**             Enviar solicitud POST a `/contracts` con
                          collaborator_id inexistente.

  **Datos de Entrada**    collaborator_id: 999<br>
                          contract_type: Fijo<br> start_date:
                          2026-01-01<br> end_date:
                          2026-12-31<br> position:
                          Developer<br> salary:
                          3000000<br> status: Activo

  **Resultado Esperado**  Respuesta HTTP 422 con error de validación en
                          el campo `collaborator_id`.

  **Resultado Real**      Error de validación generado correctamente.

  **Estado**              Pasa
  ---------------------------------------------------------------------

------------------------------------------------------------------------

## Caso de prueba 003

  ---------------------------------------------------------------------
  Campo                   Información
  ----------------------- ---------------------------------------------
  **ID del Caso de        CP-003
  Prueba**                

  **Título de la Prueba** Validación de fechas y salario en contrato

  **Módulo /              Gestión de contratos -- Validación
  Característica**        

  **Descripción**         Verificar que el sistema valide correctamente
                          las reglas de fechas y salario.

  **Precondiciones**      1\. Usuario autenticado. <br> 2.
                          Existe un colaborador válido.

  **Pasos para la         1\. Autenticar usuario. <br> 2.
  Ejecución**             Enviar solicitud POST a `/contracts` con
                          end_date menor que start_date y salary
                          negativo.

  **Datos de Entrada**    collaborator_id: 1<br>
                          contract_type: Fijo<br> start_date:
                          2026-12-31<br> end_date:
                          2026-01-01<br> position:
                          Developer<br> salary:
                          -1000<br> status: Activo

  **Resultado Esperado**  Respuesta HTTP 422 con errores de validación
                          en los campos `end_date` y `salary`.

  **Resultado Real**      Errores de validación generados
                          correctamente.

  **Estado**              Pasa
  ---------------------------------------------------------------------

------------------------------------------------------------------------

## Caso de prueba 004

  ---------------------------------------------------------------------
  Campo                   Información
  ----------------------- ---------------------------------------------
  **ID del Caso de        CP-004
  Prueba**                

  **Título de la Prueba** Actualización de contrato existente

  **Módulo /              Gestión de contratos -- Actualización
  Característica**        

  **Descripción**         Verificar que un contrato existente puede
                          actualizarse correctamente.

  **Precondiciones**      1\. Usuario autenticado. <br> 2.
                          Existe un contrato previamente registrado.

  **Pasos para la         1\. Autenticar usuario. <br> 2.
  Ejecución**             Enviar solicitud PUT a `/contracts/{id}` con
                          nuevos datos válidos.

  **Datos de Entrada**    collaborator_id: 1<br>
                          contract_type: Indefinido<br>
                          start_date: 2026-01-01<br> end_date:
                          null<br> position: Senior
                          Developer<br> salary:
                          5000000<br> status: Activo

  **Resultado Esperado**  Respuesta HTTP 200 y actualización del
                          registro en la base de datos.

  **Resultado Real**      Contrato actualizado correctamente.

  **Estado**              Pasa
  ---------------------------------------------------------------------