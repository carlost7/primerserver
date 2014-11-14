<?php

class PasswordController extends \BaseController {

    /**
     * Display the specified resource.
     * GET /password/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
    {
        echo str_random(10);
    }

}
