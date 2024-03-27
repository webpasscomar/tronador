# Tronador - API
Endpoints **API**
servidor (local) : [localhost](http://127.0.0.1:8000)


 ### POST - Registro de nuevos usuarios

  

     http://127.0.0.1:8000/api/users/v1

> **/api/users/v1**
 

 1. En phone y nationality_id enviar datos numéricos.
 2. Phone acepta entre 8 y 20 dígitos
 3. A los usuarios que se registran desde la app se les asigna el rol de **User** 
 4. Request **Headers**:
 
>|key| value |
>|--|--|
>| Accept | application/json |

 
 

 - Response (**status : 201**)

 ``` json
{
    "message":"Usuario registrado"
}
 ```

 - Datos para el registro de usuarios - Enviar por **Body** raw ( json )
 
``` json
{
	  "name":"example",
	  "email":"example@correo.com",
	  "password":"password",
	  "repassword":"password",
	  "lastname":"apellido",
	  "phone": 111111111,
	  "nationality_id":1
}
```

---
### POST - Login de usuarios previamente registrados

    http://127.0.0.1:8000/api/login

> **/api/login** 

 1. Login de usuarios
 2. Request **Headers**:
 
>|key| value |
>|--|--|
>| Accept | application/json |
 
- Response (**status : 200**)  

``` json
{
    "message": "Usuario conectado con éxito.",
    "authorization": {
        "token": "1111dfdf1111abc11111fds111dfdfdf11111dfd1111fgretd111",
        "type": "bearer"
    }
}
 ```
- Datos para el login de usuarios - Enviar por **Body** raw ( json )
``` json
{
    "email":"example@correo.com",
    "password":"password"
}
```
---

### GET - Obtener Senderos publicados

    http://127.0.0.1:8000/api/trails/v1

> **/api/trails/v1** 

1. Se obtienen todos los senderos publicados
2. Se requiere enviar token: Bearer token_generado_al_loguearse
3. Request **Headers**:
   

>|key| value |
>|--|--|
>| Accept | application/json |
>| Authorization | Bearer Token |

- Response (**status : 200**)

``` json
[
    {
        "id": 1,
        "nombre": "nombre en español",
        "name": "nombre en inglés",
        "resumen": "resumen en español"
        "summary": "resumen en inglés"
        "image": "archivo.jpg",
        "dificultad": "Dif: Media (nov-abr) - Alta (may-oct)",
        "difficulty": "Diff: Moderate (nov-apr) - Hugh (may-oct)",
        "kms": "15",
        "elevation": "1300",
        "duracion": "5 a 7 hs de marcha en verano",
        "duration": "5 to 7 hours",
        "periodo": "Todo el año",
        "period": "Open all year",
        "geom": "archivo.gpx",
        "order": 1,
        "status": 1,
        "created_at": "2024-01-01T01:00:00.000000Z",
        "updated_at": "2024-01-01T01:00:00.000000Z"
    }
]
 ```

---

### GET - Obtener Contenidos publicados

    http://127.0.0.1:8000/api/references/v1/3

> /api/references/v1/topic_id 
  

1. Se envia por parámetro el id del tema (topic_id)
2. Muestra todos los contenidos del tema que se envia por parámetro
3. Se requiere enviar token: Bearer token_generado_al_loguearse
4. Request **Headers**:

>|key| value |
>|--|--|
>| Accept | application/json |
>| Authorization | Bearer Token |
 

- Response (**status : 200**)
    

``` json
[
    {
        "nombre": "nombre en español",
        "name": "nombre en inglés",
        "descripcion": "descripción en español",
        "description": "descripción en inglés",
        "image": "archivo.jpg"| puede ser null,
        "pdf": "archivos.pdf"| puede ser null,
        "trail_id": 1 | puede ser null,
        "initial": "sigla de institución"
    }
]
 ```

---
### GET - Obtener Nacionalidades publicadas

    http://127.0.0.1:8000/api/nationalities/v1

> /api/nationalities/v1 
  

1. Muestra todas las nacionalidades
2. Se requiere enviar token: Bearer token_generado_al_loguearse
3. Request **Headers**:
    
>|key| value |
>|--|--|
>| Accept | application/json |
>| Authorization | Bearer Token |

- Response (**status : 200**)
    
``` json
  {
      "id": 1,
      "name": "nacionalidad"
  }

 ```

---
### GET - Obtener Puntos publicados

    http://127.0.0.1:8000/api/points/v1/1

> **/api/points/v1/trail_id** 
  

1. Se envia por parámetro el id del sendero (trail_id)
2. Muestra todos los puntos del sendero que se envia por parámetro
3. Se requiere enviar token: Bearer token_generado_al_loguearse
4. Request **Headers**:
    
>|key| value |
>|--|--|
>| Accept | application/json |
>| Authorization | Bearer Token |


- Response (**status = 200**)
    

``` json
[
    {
        "nombre": "nombre del punto en español",
        "name": "nombre del punto en inglés",
        "descripcion": "descripción del punto en español",
        "decription": "descripción del punto en inglés",
        "image": "archivo.svg",
        "pdf": "archivo.pdf",
        "lat": "111",
        "lng": "22",
        "icon": "icono.png",
        "institution": "sigla de institución"
    }
]
 ```
---
### GET - Obtener Alertas publicadas

    http://127.0.0.1:8000/api/alerts/v1

> **/api/alerts/v1** 
  

1. Se muestran todas las alertas publicadas
2. Se requiere enviar token: Bearer token_generado_al_loguearse
3. Request **Headers**:

>|key| value |
>|--|--|
>| Accept | application/json |
>| Authorization | Bearer Token |
    

- Response (status = 200)
    

``` json
{
    "titulo": "titulo en español",
    "title": "titulo en inglés",
    "descripcion": "descripción en español",
    "description": "descripción en inglés",
    "date": "2024-01-01 01:00:00",
    "institution": "sigla de institución"
}
 ```
