<?php
class EventModel
{
    private $_eventId;
    private $_name;
    private $_description;
    private $_startDateTime;
    private $_endDateTime;
    private $_businessId;
    private $_businessName;
    private $_streetName;
    private $_postalCode;
    private $_city;
    private $_province;
    private $_country;
    private $_userId;
    private $_categoryId;
    private $_categoryTitle;

    public function __construct($queryResult)
    {   
        if(isset($queryResult['BusinessName']) && isset($queryResult['StreetName'])) {          
            $this->_businessName = $queryResult["BusinessName"];
            $this->_streetName = $queryResult["StreetName"];
            $this->_postalCode = $queryResult["PostalCode"];
            $this->_city = $queryResult["City"];
            $this->_province = $queryResult["Province"];
            $this->_country = $queryResult["Country"];
        }
        if(isset($queryResult['UsersId'])) {
            $this->_userId = $queryResult['UsersId'];
        }
        /*if(isset($queryResult[0])) {
            $this->_eventId = $queryResult[0]; 
        }*/
        if(isset($queryResult["EventId"])) {
            $this->_eventId = $queryResult["EventId"]; 
        }
        if(isset($queryResult["CategoryId"])) {
            $this->_categoryId = $queryResult["CategoryId"];
        }
        if(isset($queryResult["CategoryTitle"])) {
            $this->_categoryTitle =$queryResult["CategoryTitle"];
        }
        $this->_name = $queryResult["EventName"];
        $this->_description = $queryResult["EventDescription"];
        $this->_startDateTime = $this->formatDateTime($queryResult["StartDateTime"]);
        $this->_endDateTime = $this->formatDateTime($queryResult["EndDateTime"]);
        $this->_businessId = $queryResult["BusinessId"];
    }

    private function formatDateTime($dateTime)
    {
        $matchPattern = '/\d{4}-\d{2}-\d{2}T\d{2}:\d{2}/';
        $replacePattern = '/T/';
        $replacement = " ";
        if(preg_match($matchPattern, $dateTime)) {
            $formattedTime = preg_replace($replacePattern, $replacement, $dateTime);
            //$formattedTime = $formattedTime . ":00";
            return $formattedTime;
        } else {
            return $dateTime;
        }
    }

    private function formatDateTimeForForm($dateTime)
    {
        $matchPattern = '/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}/';
        $replacePattern = '/ /';
        $replacement = "T";
        if(preg_match($matchPattern, $dateTime)) {
            $formattedTime = preg_replace($replacePattern, $replacement, $dateTime);
            return $formattedTime;
        } else {
            return $dateTime;
        }   
    }

    public function getEventId()
    {
        return $this->_eventId;
    }

    public function setEventId($id)
    {
        $this->_eventId = $id;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function setName($value)
    {
        $this->_name = $value;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    public function setDescription($value)
    {
        $this->_description = $value;
    }

    public function getStartDateTime($flag="detail")
    {
        if($flag == "edit") {
            $dateTime = $this->formatDateTimeForForm($this->_startDateTime);
            return $dateTime;
        } else if($flag == "detail") {
            return $this->_startDateTime;
        }
    }

    public function setStartDateTime($value)
    {   
        
        $this->_startDate = $this->formatDateTime($value);
    }

    public function getEndDateTime($flag="detail")
    {
        if($flag == "edit") {
            $dateTime = $this->formatDateTimeForForm($this->_endDateTime);
            return $dateTime;
        } else if($flag == "detail") {
            return $this->_endDateTime;
        }
    }

    public function setEndDateTime($value)
    {
        $this->_endDateTime = $this->formatDateTime($value);
    }

    public function getStreetName()
    {
        return $this->_streetName;
    }

    public function getPostalCode()
    {
        return $this->_postalCode;
    }

    public function getCity()
    {
        return $this->_city;
    }

    public function getProvince()
    {
        return $this->_province;
    }

    public function getCountry()
    {
        return $this->_country;
    }

    public function getBusinessName()
    {
        return $this->_businessName;
    }

    public function getBusinessId()
    {
        return $this->_businessId;
    }

    public function getUserId()
    {
        return $this->_userId;
    }

    public function getCategoryId()
    {
        return $this->_categoryId();
    }

    public function setCategoryId($value)
    {
        $this->_categoryId = $value;
    }

    public function getCategoryTitle()
    {
        return $this->_categoryTitle;
    }
}
?>