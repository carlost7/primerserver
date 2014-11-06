<?php

class EmailListener {

    public function store($email)
    {
        dd($email->password);
    }

    public function update($email)
    {
        dd($email);
    }

    public function destroy($email)
    {
        dd($email);
    }

}
