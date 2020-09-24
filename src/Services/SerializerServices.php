<?php
/**
 * Created by PhpStorm
 * User: shadowluffy
 * Date: 9/24/20
 * Time: 1:30 PM
 */

namespace App\Services;

use JMS\Serializer\SerializerBuilder as Serialize;

/**
 * Class SerializerServices
 * @package App\Services
 *
 * @author CONTE Alexandre <pro.alexandre.conte@gmail.com>
 */
class SerializerServices
{
    public function setSerializeObject($object)
    {
        $serializer = Serialize::create()->build();
        $jsonContent = $serializer->serialize($object, 'json');

        return $jsonContent;
    }
}