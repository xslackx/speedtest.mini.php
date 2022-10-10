<?php
namespace SpeedBurger\Interfaces\GenerateDataInterface;

/**
 * To create the random data, the values ​​in bytes
 * are determined, generating the chunks for
 * sending to the client.
 * @see https://github.com/adolfintel/speedtest/blob/master/garbage.php
 * @see https://github.com/ipburger/speedtest.mini.php/blob/master/root/app/speedtest/random.php
 */

interface GenerateDataInterface
{
  /**
   * The values ​​in bytes are determined from the size
   * of the object of the $_GET method requested by the client,
   * then the bytes that must be returned to the client are calculated
   * @return array[] An array of integer values ​​containing the amount of data
   * to send and create the data segments
   */
   public function bytesChunk();

   /**
    * When we receive the array returned by the bytesChunk() method,
    * execute the rndbytes binary because it has versatility in choosing
    * which PRNGs (pseudo random number generators) to use, but if the system
    * does not have it installed, the openssl_random_pseudo_bytes
    * function will be used and the data will be returned to the client.
    * @see https://linux.die.net/man/1/rndbytes
    * @see https://sourceforge.net/projects/dktools/files/dktools/dktools-4.34.1/
    * @see https://www.php.net/manual/en/function.openssl-random-pseudo-bytes.php
    * @return string Returns segmented data
    */
    public function streamChunk();
}
