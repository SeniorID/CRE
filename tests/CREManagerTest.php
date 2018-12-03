<?php 
use PHPUnit\Framework\TestCase;

/**
*  Este test corresponde a la clase CREManager class
*
*  @author Mr ID
*/
class CREManagerTest extends TestCase
{
	
  /**
  * Just check if the YourClass has no syntax error 
  *
  * This is just a simple check to make sure your library has no syntax error. This helps you troubleshoot
  * any typo before you even use this library in a real project.
  *
  */
  public function testIsThereAnySyntaxError()
  {
  	$var = new SeniorID\CRE\CREManager;
  	$this->assertTrue(is_object($var));
  	unset($var);
  }
  
  /**
  * Just check if the YourClass has no syntax error 
  *
  * This is just a simple check to make sure your library has no syntax error. This helps you troubleshoot
  * any typo before you even use this library in a real project.
  * 
  */

  public function testDownloadPlaces() {

  	$var = new SeniorID\CRE\CREManager;
  	$this->assertTrue($var->downloadPlaces() != null);
  	unset($var);
  } 

  public function testDownloadPrices() {

    $var = new SeniorID\CRE\CREManager;
    $this->assertTrue($var->downloadPrices() != null);
    unset($var);
  } 


  public function testGetPrices() {


    $var = new SeniorID\CRE\CREManager;

    $this->assertTrue(is_array( $var->getPrices()));

    unset($var);

  }

}
