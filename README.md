## Desafío de desarrollo - Laravel MySQL Bootstrap FullCalendar

Solución del desafío de desarrollo de CDE.

Proyecto realizado en Laravel utilizando MySQL como base de datos,
Bootstrap para los estilos y componentes, y FullCalendar para mostrar el calendario.

Cuenta con dos páginas: Reservas y Calendario.

Reserva de citas veterinarias con los campos requeridos. Además, he adiccionado el estado de la reserva.

Para reservar: Partiendo de uno de los requisitos para actualizar, que la hora
de la cita debe ser mayor a dos horas, he puesto una restricción para reservar la cita y es que debe ser con
minimo dos horas de antelación. O sea, ingresando la fecha y hora actual no dejara reservar. 

He puesto también algunas restricciones basicas a la entrada de datos, que sean requeridos y con el máximo 
puesto en la base de datos.

En el calendario solo se visualizan las citas reservadas y precionando sobre los eventos se muestra
la información de cada uno de ellos.