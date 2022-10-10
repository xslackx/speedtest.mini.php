<?php
namespace SpeedBurger\Models\GenerateData;

use \SpeedBurger\Interfaces\GenerateDataInterface;
/**
 * This class implements the Interface GenerateData
 * @see https://github.com/adolfintel/speedtest/blob/master/garbage.php
 * @see https://github.com/ipburger/speedtest.mini.php/blob/master/root/app/speedtest/random.php
 * @see https://en.wikipedia.org/wiki/Image_resolution
 */

class GenerateData implements GenerateDataInterface
{
  public $bytesToSend;
  public $blobName;
  public $chunkSize;
  public $chunkToSend;
  public $dataSize;
  public $randAlg;
  private $randStream;

  /* 1 Byte = 8 Bit 1 Kilobyte = 1,024 Bytes
     1 Megabyte = 1,048,576 Bytes 1 Gigabyte = 1,073,741,824 Bytes */
  private $max = 1073741824;

  public function __construct($data)
  {
    if(!empty($data['size']) && gettype($data['size']) === 'integer' &&
    $data['size'] < $this->max)
    {
      $this->dataSize = $data['size'];
    } elseif(!empty($data['size']) &&
      gettype($data['size']) === 'integer' && $data['size'] > $this->max)
    {
      $this->dataSize = 10;
    } else
    {
      $this->dataSize = 100;
    }

    if(empty($data['blob']))
    {
      $this->blobName = isset($_SERVER['HTTP_CLIENT_IP']) ?
      $_SERVER['HTTP_CLIENT_IP'] :
      (isset($_SERVER['HTTP_X_FORWARDED_FOR']) ?
      $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']);

      $this->blobName = sha1($this->blobName) . '.jpg';
    } else {
      $this->blobName = $data['blob'] . '.jpg';
    }

    if(empty($data['chunksize']))
    {
      $this->chunkSize = 1024 * 1024;
    } elseif(!empty($data['chunksize']) &&
      $data['chunksize'] > 1000 * 1024 * 1024)
    {
      $this->chunkSize = 10 * 1024 * 1024;
    } else
    {
      $this->chunkSize = 1024 * 1024;
    }

    if(empty($data['alg']))
    {
      $this->randAlg = 'openssl';
    }

  }

  public function bytesChunk()
  {
    /* equation derived from looking at the average sizes of images
      provided by speedtest.net */
    $this->bytesToSend = 1.9 * pow((int) $this->dataSize, 2);

    $this->chunkSize = $this->chunkSize < $this->bytesToSend ?
    $this->chunkSize : $this->bytesToSend;

    $this->chunkToSend = ceil($this->bytesToSend/$this->chunkSize);

    return array( $this->bytesToSend,
    $this->chunkSize, $this->chunkToSend);
  }

  public function streamChunk()
  {
    /* if rndbytes no exist then use
    openssl_random_pseudo_bytes to gen random bytes */
    system('which rndbytes', $which);
    if($which === 1)
    {
      $this->randStream = openssl_random_pseudo_bytes($this->chunkSize);
    }
    elseif($which === 0)
    {
      // pcntl_exec();
      return "need to implement";
    }
    for($i=0; $i < $this->chunkToSend; $i++)
    {
      return $this->randStream;
      flush();
    }
  }



}
