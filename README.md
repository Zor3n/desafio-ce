## Desafío de desarrollo - Laravel MySQL

Solución del desafío de desarrollo de CDE.

Proyecto realizado en Laravel utilizando MySQL como base de datos,
Bootstrap para los estilos y componentes, y FullCalendar para mostrar el calendario.

El desarrollo está conformado por tres páginas: Reservas, buscar y calendario.

Puse algunas restricciones que me parecieron optimas, además de las requeridas por el desafio.

En la página de Reservas donde se puede reservar, actualizar y eliminar 
cada uno de los datos que están en la base de datos.

Para realizar una reserva he puesto una restricción de que solo se pueda hacer dos horas antes
y solo se puede editar sí el tiempo de la citas es mayor a dos horas de la hora actual.
Adiccionalmente, sí la fecha ya ha sido seleccionada anteriormente no se podrá reservar. 

En la página de Buscar, y para separar los requerimientos principales en páginas diferentes,
se puede buscar las citas realizadas para una fecha puntual. Para ahorrar tiempo no le he puesto las
funciones de CRUD ya que lo ideal, en realidad, sería unir Reservas y Buscar.