<?php

/**
 * Generate a chunk data to response to client
 * @see https://github.com/adolfintel/speedtest/blob/master/garbage.php
 */

interface GenerateDataInterface
{
  /**
   * Check limits and return
   * @return
   */
   public function checkLimits();

  /**
   * Create Chunk data and return
   * @return
   */
   public function createChunk();

   /**
    * Stream Chunk data and return
    * @return
    */
    public function streamChunk();
}
