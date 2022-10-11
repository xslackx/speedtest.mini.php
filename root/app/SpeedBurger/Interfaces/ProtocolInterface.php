<?php
namespace SpeedBurger\Interfaces;

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

use Psr\Http\Message\ServerRequestInterface;


/**
 * Checks which type of http protocol version is used by the client,
 * if necessary, also define or view headers,
 * this interface is extended by the Get and Post and Response interfaces
 * to give more flexibility
 * @see https://github.com/ipburger/speedtest.mini.php/blob/master/root/app/speedtest/random.php
 */

interface ProtocolInterface
{
  /**
  * Verify which http version client send to server, each http version has
  * new features like keep-alive, pipeline, request priorization, state code
  * but other
  * @see https://www.ietf.org/rfc/rfc2616.txt
  * @see https://www.rfc-editor.org/rfc/rfc1945
  * @see https://www.rfc-editor.org/rfc/rfc7540
  * @return integer 
  */
  public httpVersion();

  /**
  * Browsers or CLI, headers are like spices.
  * @return array[]
  */
  public viewHeaders();

  /**
  * Add new headers as needed
  */
  public addHeader();


}
