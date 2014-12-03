<html>
      <head>
            <meta charset="utf-8">
      </head>
      <body>
            <h2>{{$user->name }} Bienvenido a Primer Server</h2>
            <p>Ahora disfrutaras de la mejor experiencia en hosting</p>
            <p>Empieza por crear un dominio y hacer que tu negocio crezca</p>
            <br>
            <p>Para empezar a crear tus dominios y generar tu negocio exitoso da click en el siguiente enlace</p>
            {{ HTML::LinkRoute('user.show',"Entrar a Primer Server",array($user->id))}}
            
      </body>
      
</html>