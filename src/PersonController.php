<?php

namespace Mixd\Src; 

class PersonController
{
  public function me($age = null, $name = null)
  {
    echo "Meu nome é {$name} tenho {$age} anos";
  }
}
