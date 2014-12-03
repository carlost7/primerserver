<html>
      <head>
            <meta charset="utf-8">
      </head>
      <body>
            <h2>Ocurrio un error al intentar comprar el dominio {{{ $domain->domain }}}</h2>
            <p>El dominio {{{ $domain->domain }}} ya no se encuentra disponible.</p>
            <p>En el siguiente link puedes seleccionar un nuevo dominio.</p>
            <br>
            {{ HTML::LinkRoute('user.domains.edit',"Seleccionar nuevo dominio",array($domain->user->id,$domain->id))}}
            
      </body>
</html>