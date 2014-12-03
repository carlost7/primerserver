<?php

class FtpsConfigController extends \BaseController {

    /**
     * Display the specified resource.
     * GET /ftpsconfig/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($user_id, $domain_id, $id, $app)
    {
        $ftp = Ftp::find($id);

        $texto = View::make('configftp.' . $app, compact("ftp"))->render();
        
        $path = public_path("public_files/".$ftp->username.".xml");
        $file = File::put($path, $texto);                
        return Response::download($path);
    }

}
