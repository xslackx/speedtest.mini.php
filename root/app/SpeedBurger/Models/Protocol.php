<?php
namespace SpeedBurger\Models;

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

use SpeedBurger\Interfaces\ProtocolInterface;

class Protocol implements ProtocolInterface
{
  /**
  *
  */
  public httpVersion();

  /**
  *
  */
  public viewHeaders();

  /**
  *
  */
  public addHeader();

}
