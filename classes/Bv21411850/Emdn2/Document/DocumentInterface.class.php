<?php
namespace Bv21411850\Emdn2\Document;

interface DocumentInterface
{
    public static function initialize($rawData = array());
    public function getId();
    public function getDateCreation();
}
