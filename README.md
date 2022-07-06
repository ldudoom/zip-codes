## Zip Codes
***

- Como repositorio de datos voy a tomar el archivo en formato TXT.
- Primero genero las interfaces para su posterior implementación.
  + **app/Interfaces/DataLoadInterface.php:** Interface para implementar el procedimiento de carga de datos desde el archivo TXT.
  + **app/Interfaces/DataFilterInterface.php:** Interface para implementar el procedimiento de filtrado del codigo postal.
  + **app/Interfaces/ParsingDataInterface.php:** Interface para implementar el parseo de datos del o los codigos postales encontrados.
  

- Ahora genero las clases concretas para codificar cada uno de los procedimientos mencionados
  + **app/Services/DataLoad.php:** Implementacion de la interface *DataLoadInterface*
  + **app/Services/DataFilter.php:** Implementación de la interface *DataFilterInterface*
  + **app/Services/ParsingData.php:** Implementacion de la interface *ParsingDataInterface*

### DataLoad
En esta clase se encuentra implementado el método público ***"loadData"***.

Recibe como parámetro el nombre del archivo txt del cual vamos a tomar la data.

Devuelve un *"array"* con la información de dicho archivo, siendo cada fila del mismo un elemento del array.

### DataFilter
En esta clase se encuentra implementado el método que buscará el zip code deseado.

Recibe como parámetros, el **array** de datos obtenidos del archivo, y un **string** con el zip code a buscar.

Devuelve un array con el o los registros encontrados de acuerdo al zip code buscado.

### ParsingData
En esta clase se encuentran implementados los métodos para el parsing de la información de zip codes.

Está compuesta de 3 métodos:

- El método público **fieldParsed():** que será el encargado de devolver la información de los zip codes lista para ser presentada al usuario
- El método privado **_explodeZipCodeInfo():** será el método encargado de convertir cada una de las filas del archivo cuyos valores se encuentran separados por un pipe "|" en arreglos de datos.
- El método privado **_parsingDataStructure():** que será el encargado de formatear los datos de tal manera que tenga la misma estructura que el endpoint https://jobs.backbonesystems.io/api/zip-codes/{zip_code}

### ZipCodesController
Este será el archivo encargado de devolver la información en el endpoint.

En su constructor se realiza la inversión de dependencias de los Servicios antes descritos.

Y cuenta con el método ***show()*** que será el encargado de devolver la información cuando se haga el request al endpoint.

### Endpoint
Se encuentra configurado el endpoint:
```
/api/zip-codes/{zip_code}
```

