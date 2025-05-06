# Wallamotop

Es una plataforma de subastas entre particulares, similar a Wallapop en que conecta usuarios para vender, en este
caso, motocicletas de segunda mano, pero la venta no es directa: los productos se ofrecen en formato de puja, y el
comprador final es quien haya hecho la oferta más alta al cierre de la subasta.

El proyecto se realizó usando el framework Laravel (PHP) como backend, y TailWind, bootstrap y css como frontend.Además lo desplegué en producción en una instancia de AWS (Aamazon Web Service) para que fuera accesible y no sequedara solo en desarrollo local.

También añadir, que lo contenericé usando Docker, para que fuera totalmente portable, sin necesidad de tener queinstalar dependencias como PHP, Laravel... en los equipos en los que en un futuro se quieran añadir actualizaciones alproyecto.

Algunos requisitos funcionales destacables del poryecto son:
- Login y registro
- Sistema de roles, admin y user
- Verificación de cuenta a través de link automático por correo electrónico
- Las pujas solo se guardan si la cantidad es mayor
- Sistema de cuentas regresivas en tiempo real totalmente dinámico y funcional
- El usuario que puede comprar la motocicleta será el que tenga la puja más alta cuando finalice la cuenta regresiva
- El admin puede crear, eliminar, actualizar motocicletas
- El admin tiene una pestaña de vista de usuario para ver como vería la apicación web un usuario normal
- No es posible acceder al rol de admin escribiendo la url
- Asincronía
- El admin puede ver las pujas, comentarios etc... de cada usuario, por si tuviera que moderar.
Para más detalles o imágenes de la web, consulte el enlace de github.

# Videos de la aplicación web.
## Visualización general de la web
https://github.com/user-attachments/assets/67908b12-f59d-4f78-883f-a3783f537b06

## Operación con los productos, pujas y navegabilidad
https://github.com/user-attachments/assets/426ad67c-0330-434c-ab44-c22e0bcb2670

## Panel de administración y operaciones de admin
https://github.com/user-attachments/assets/dbb78ebd-858d-4ac3-9c92-3285e4b4b121



