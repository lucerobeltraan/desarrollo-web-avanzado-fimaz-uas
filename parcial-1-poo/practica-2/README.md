Práctica 2

En la práctica 2 se crearon dos clases: usuario como clase base y admin 

como clase hija. La clase admin hereda de usuario. 

Se crearon los archivos admin.php, usuario.php, index.php y README.md dentro de la práctica 

2\.

Paso 1: clase usuario

En este paso se creo la clase Usuario, el cual contiene nobre y correo como atributos los 

cuales estan encapsulados para proteger su información. Asi mismo, se creó un constructor 

para guardar los datos al crear el objeto. Los métodos getNombre() y getCorreo() para po-

der leer los datos. Y un método getRol() que regresa "Usuario".



Paso 2:clase admin 

&nbsp;En Admin.php se creo la clase "Admin" que extiende al "Usuario" (herencia) y tiene su getRoll() 

que regresa a admiistrador.



Paso 3: Probar en index 

Se creo un objeto "Admin", el cual muestra en pantalla: nombre, correo y rol

