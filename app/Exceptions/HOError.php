<?php

namespace App\Exceptions;

use \App\Exceptions\HOException as HOException;

class HOError
{
    public function generalErr()
    {
        throw new HOException('General Error Occurred', 201);
    }

}
