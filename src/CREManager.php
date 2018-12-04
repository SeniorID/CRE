<?php 

namespace SeniorID\CRE;

use GuzzleHttp\Client;
use Laravie\Parser\Xml\Reader;
use Laravie\Parser\Xml\Document;

/**
*  A sample class
*
*  Use this section to define what this class is doing, the PHPDocumentator will use this
*  to automatically generate an API documentation using this information.
*
*  @author Mr. ID
*/
class CREManager {

  private  const PLACES_URL = 'https://publicacionexterna.azurewebsites.net/publicaciones/places'; 
  private  const PRICES_URL = 'https://publicacionexterna.azurewebsites.net/publicaciones/prices'; 

  private $httpClient;

  public function __construct() {

    $this->httpClient = new Client();
  
  }


  /**
  *  Iniciar el proceso de descarga de las gasolineras. 
  *
  *  @return steam con los datos de los lugares
  *
  */
  public function downloadPlaces() {
    try {

      $response = $this->httpClient->get(CREManager::PLACES_URL);

      return $response->getBody()->getContents();
    
    } catch(Exception $e) {
    
      return null;
    }


  }  

  public function downloadPrices() {

    try {

      $response = $this->httpClient->get(CREManager::PRICES_URL);

      return $response->getBody()->getContents();
    
    } catch(Exception $e) {
    
      return null;
    }

  }




  public function getPlaces() {
 
    $xml = (new Reader(new Document()))->extract($this->downloadPlaces());

    $places = $xml->parse([

        'places' => ['uses' => 'place[::place_id>place_id,name,brand,cre_id,category,location.address_street>location,location.x>lng,location.y>lat]']

    ]);

    return array_column($places['places'],NULL,'place_id');

  
  }

  public function getPrices() {

    $xml = (new Reader(new Document()))->extract($this->downloadPrices());

    $prices = $xml->parse([
        'places' => ['uses' => 'place[::place_id>place_id,gas_price,gas_price::update_time>last_update,gas_price::type>gas_type]'],
        
    ]);
    
    return array_column($prices['places'],NULL,'place_id');
    

  }


}