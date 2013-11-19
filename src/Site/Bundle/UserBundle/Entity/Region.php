<?php

namespace Site\Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Region
 */
class Region
{
    /**
     * @var integer
     */
    private $regionid;

    /**
     * @var integer
     */
    private $countryid;

    /**
     * @var string
     */
    private $name;


    /**
     * Get regionid
     *
     * @return integer 
     */
    public function getRegionid()
    {
        return $this->regionid;
    }

    /**
     * Set countryid
     *
     * @param integer $countryid
     * @return Region
     */
    public function setCountryid($countryid)
    {
        $this->countryid = $countryid;
    
        return $this;
    }

    /**
     * Get countryid
     *
     * @return integer 
     */
    public function getCountryid()
    {
        return $this->countryid;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Region
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
}
