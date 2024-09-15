<?php

namespace Mixd\Src; 

class TestController
{
  public function teste($id = null, $name = null)
  {
    echo "{$id} - {$name}";
  }
}
