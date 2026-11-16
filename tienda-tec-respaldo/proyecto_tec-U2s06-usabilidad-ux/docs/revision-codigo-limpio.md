# revisión de código limpio u3s07

| # | principio | qué encontré (archivo y método) | qué cambié | commit |
|---|---|---|---|---|
| 1 | nombres (cap. 2) | en `categoria.php` el parámetro del constructor se llamaba nada más `$n`, y así no se entiende rápido qué guarda | le cambié el nombre a `$nombre` para que cualquiera que lea el código sepa qué es sin adivinar | u3s07: mejora nombres en modelos |
| 2 | funciones pequeñas (cap. 3) | en `repositorioproductos.php`, leer el archivo json y convertir los datos en objetos estaba todo junto y hacía el método muy largo | lo dividí en dos métodos privados más cortos: `leerregistros()` para abrir el json y `convertiraproductos()` para armar los objetos | u3s07: divide responsabilidades en repositorio |
| 3 | objetos (cap. 6) | en las vistas necesitaba revisar si había piezas disponibles sin meterme directo a leer la variable privada `$stock` | dejé que el objeto responda solo con el método `estadisponible()` y lo usé dentro de `mostrardisponibilidad()` en las vistas | u3s07: encapsula disponibilidad en producto |
```[cite: 10, 11, 19, 20]