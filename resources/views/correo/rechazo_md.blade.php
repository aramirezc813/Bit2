@component('mail::message')

# Sistema Bit2

## Notificación de Rechazo de Propuesta

**Motivo del rechazo:**  
> {{ $motivo }}

---

### Propuestas Rechazadas:

@component('mail::table')
| Nombre                       | Estación     | Jornada       |
|-----------------------------|--------------|---------------|
@foreach($datos as $item)
| {{ $item->nombre }}          | {{ $item->id_estacion }} | {{ $item->jlaborals }} |
@endforeach
@endcomponent

---

Si tienes alguna duda, por favor comunícate con el Área de Telefonía Informática del CATGEM.

@component('mail::button', ['url' => 'https://catgem.edomex.gob.mx/Bit2/public/login'])
Ir a Bit2
@endcomponent

@endcomponent
