Práctica-3 

En esta práctica se implementó: Herencia, Encapsulación, validación de correo y manejo de 

excepciones.

La estructura quedo conformada por el usuario como clase base, Admin(que hereda de usuario)

y alumno(que hereda de usuario y agrega matrícula). Se valida que el correo tenga formato 

correcto con filter\_var($correo,FILTER\_VALIDATE\_EMAIL), si el correo es inválido genera una excepción.



En index.php se usa try/catch para: crear usuarios válidos, detectar correos inválidos y mostrar 

mensaje de error controlado.

