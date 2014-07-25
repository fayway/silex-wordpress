<?php
namespace SilexProof;

use Symfony\Component\EventDispatcher\Event;

class SettingsEvent extends Event
{
    protected $source;
    
    public function __construct($source)
    {
        $this->source = $source;
    }
    
    public function getSource()
    {
        return $this->source;
    }
}