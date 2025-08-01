@component('mail::message')

    

    
       
            Sistema Bit2
            
            Asignacion de Credenciales

            
            Estimado(a): {{$datos['nombre']}}

            Se envian las credenciales para accesar al sistema.

            
            Usuario: {{$datos['email']}}
            Contraseña: {{$datos['password']}}

            
            Sin más por el momento reciba un cordial saludo de parte del 
            Area de Telefonía Informática del CATGEM.

            
       
    



@component ('mail::button', ['url' => 'https://catgem.edomex.gob.mx/Bit2/public/login']) 
Bit2
@endcomponent 
 


@endcomponent