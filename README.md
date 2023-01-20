## Desafío de desarrollo - Laravel MySQL Bootstrap FullCalendar

###### RETO CDE.
Desarrollar una aplicación web que permita:

A. Crear reservas de citas veterinarias con los siguientes campos: Documento de identidad dueño mascota, nombres y apellidos dueño mascota, nombre mascota, fecha de la cita y hora de la cita.

B. El sistema debe permitir ver las citas creadas para una fecha puntual (por ejemplo si selecciono la fecha de mañana, debo poder ver las citas creadas en el sistema)

C. El sistema no debe permitir 2 citas en el mismo horario (día y hora)

D. Si faltan más de 2 horas para la hora de la cita, el sistema debe permitir editar la fecha y hora de la cita, de lo contrario no se puede modificar ni cancelar. 

E. Utilizar la API "Full Calendar" para mostrar la cantidad de reservas que tenemos en cada día (se te dará un punto adicional si adicionas una función en donde se pueda ver la hora de la reserva de cada cliente)

###### SOLUCION

Desde mi punto de vista hay dos formas de realizarlo: Desde una perspectiva de administrador y desde una perspectiva de cliente. La primera donde, poniendonos desde la posicion de un administrador del sistema, podemos agendar y ver las citas en una sola página y la segunda donde, desde una perspectiva de usuario, habría una página con un formulario para agendar la cita y otra para ver las citas agendadas.

En este caso me he inclinado por la primera porque me parecio que el ejercicio iba más desde el lado administrativo. He presentado el primero cómo solución y esperar seguir aspirando al proceso, pero por mi parte haré la segunda solución para seguir practicando con el framework. :D

## Descripción de la aplicación:

Cuenta con dos páginas: Reservas y Calendario.

Reserva de citas veterinarias con los campos requeridos. Además, he adiccionado el estado de la reserva. Todo desde la vista de un administrador, con la tabla donde están todas las citas y las funcionalidades CRUD en la página.

Para reservar: Partiendo de uno de los requisitos para actualizar, que la hora
de la cita debe ser mayor a dos horas, he puesto una restricción para reservar la cita y es que debe ser con
minimo dos horas de antelación. O sea, ingresando la fecha y hora actual no dejara reservar. 

He puesto también algunas restricciones basicas a la entrada de datos, que sean requeridos y con el máximo 
puesto en la base de datos.

En el calendario solo se visualizan las citas reservadas y precionando sobre los eventos se muestra
la información de cada uno de ellos.

###### ¡Muchas gracias por tenerme encuenta! Y ojalá seguir en el proceso :D
