@component('mail::message')
# ¡Hola, {{ $name }}!

Bienvenido a **Inteligreen CRM**. Se ha creado una cuenta para ti para que puedas gestionar tus clientes y proyectos.

**Tus credenciales de acceso son:**
* **Usuario:** {{ $email }}
* **Contraseña temporal:** {{ $password }}

@component('mail::button', ['url' => route('login')])
Acceder al CRM
@endcomponent

*Por seguridad, te recomendamos cambiar tu contraseña al ingresar por primera vez.*

Gracias,<br>
El equipo de {{ config('app.name') }}
@endcomponent