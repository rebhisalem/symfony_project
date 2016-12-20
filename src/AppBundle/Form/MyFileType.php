<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Form;


/**
 * Defines the form used to create and manipulate admin users.
 */
class MyFileType
{
   private $sourceFile;
   public function getSourceFile(){
	   return $this->sourceFile;
   }
   public function setSourceFile($sourceFile){
	   $this->sourceFile = $sourceFile;
   }
}
