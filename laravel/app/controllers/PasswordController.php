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
            $length         = 9;
            $available_sets = 'luds';
            $sets           = array();
            if (strpos($available_sets, 'l') !== false)
            {
                  $sets[] = 'abcdefghjkmnpqrstuvwxyz';
            }
            if (strpos($available_sets, 'u') !== false)
            {
                  $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
            }
            if (strpos($available_sets, 'd') !== false)
            {
                  $sets[] = '123456789';
            }
            if (strpos($available_sets, 's') !== false)
            {
                  $sets[] = '!#$*';
            }


            $all      = '';
            $password;
            foreach ($sets as $set) {
                  $password .= $set[array_rand(str_split($set))];
                  $all .= $set;
            }

            $all = str_split($all);
            for ($i = 0; $i < $length - count($sets); $i++) {
                  $password .= $all[array_rand($all)];
            }


            echo str_shuffle($password);
      }

}
