<?php

namespace Site\Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cities
 */
class Cities
{
    /**
     * @var integer
     */
    private $cityid;

    /**
     * @var integer
     */
    private $countryid;

    /**
     * @var integer
     */
    private $regionid;

    /**
     * @var string
     */
    private $name;


    /**
     * Get cityid
     *
     * @return integer 
     */
    public function getCityid()
    {
        return $this->cityid;
    }

    /**
     * Set countryid
     *
     * @param integer $countryid
     * @return Cities
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
     * Set regionid
     *
     * @param integer $regionid
     * @return Cities
     */
    public function setRegionid($regionid)
    {
        $this->regionid = $regionid;
    
        return $this;
    }

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
     * Set name
     *
     * @param string $name
     * @return Cities
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
