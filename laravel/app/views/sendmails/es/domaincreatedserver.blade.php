<html>
      <head>
            <meta charset="utf-8">
      </head>
      <body>
            <h2>Tu dominio {{$domain->domain }} ha sido creado</h2>
            <p>Ahora esta listo para crear tus correos y subir tu sitio a internet</p>
            <br>
            <p>Para entrar al panel de PrimerServer da click en el siguiente enlace</p>
            {{ HTML::LinkRoute('user.show',"Entrar a Primer Server",array($domain->user->id))}}
            <br>
            <p>Comienza a crear tus correos</p>
            {{ HTML::LinkRoute('user.emails.index',"Crear correos electronicos",array($domain->user->id,$domain->id))}}
            <br>
            <p>Para comenzar a subir tus paginas a internet descarga tu archivo de FTP</p>
            {{ HTML::LinkRoute('user.ftps.index',"Servicio de FTP",array($domain->user->id,$domain->id))}}
            
      </body>
      
</html>