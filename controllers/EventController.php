<?php
    if(!defined("__root")) {
        require( $_SERVER['DOCUMENT_ROOT']. "\gather_finial\configer.php");
    }
    include __root . "models\EventModel.php";

    class EventConnect
    {
        private $_db;

        public function __construct($dbConnection)
        {
            $this->_db = $dbConnection;
        }
        public function getEvents()
        {
            $allEvents = array();
            $sqlQuery = "SELECT e.*, l.*, b.businessName BusinessName FROM events e JOIN business b ON b.id = e.businessId JOIN locations l ON l.id = b.locationid;";
            //$sqlQuery = "SELECT * FROM events e JOIN business b ON e.businessid = e.id;";
            $pdostmt = $this->_db->prepare($sqlQuery);
            $pdostmt -> execute();
            $results = $pdostmt -> fetchAll();
            foreach($results as $result)
            {
                $event = new EventModel($result);
                array_push($allEvents, $event);
            }
            return $allEvents;
        }
        public function getEventList($id)
        {
            $allEvents = array();
            $query = "SELECT e.*, d.discount FROM events e LEFT JOIN discounts d ON e.id = d.eventid  WHERE businessid = :id";
            $pdostmt = $this->_db->prepare($query);
            $pdostmt->bindValue(':id',$id);
            $pdostmt->execute();
            $results = $pdostmt->fetchAll();
            foreach($results as $result)
            {
                $event = new EventModel($result);
                $event->setEventId($result['id']);
                array_push($allEvents, $event);
            }
            return $allEvents;
        }
        public function createEvent($eventModel)
        {
            $query = "INSERT INTO events
                        (EventName, StartDateTime, EndDateTime, BusinessId, EventDescription)
                        VALUES(:eventName, :startDateTime, :endDateTime, :businessId, :eventDescription);";
            $pdostmt = $this->_db->prepare($query);
            $pdostmt->bindValue(':eventName', $eventModel->getName(), PDO::PARAM_STR);
            $pdostmt->bindValue(':startDateTime', $eventModel->getStartDateTime(), PDO::PARAM_STR);
            $pdostmt->bindValue(':endDateTime', $eventModel->getEndDateTime(), PDO::PARAM_STR);
            $pdostmt->bindValue(':businessId', $eventModel->getBusinessId(), PDO::PARAM_STR);
            $pdostmt->bindValue(':eventDescription', $eventModel->getDescription(), PDO::PARAM_STR);
            //$pdostmt->bindValue(':userId', $eventModel->getUserId(), PDO::PARAM_STR);
            $result = $pdostmt->execute();
            return $result;
        }
        public function linkEventAndCategory($eventId, $categoryId)
        {
            $query = "INSERT INTO eventcategory
                        (EventId, CategoryId)
                        VALUES(:eventId, :categoryId)";
            $pdostmt = $this->_db->prepare($query);
            $pdostmt->bindValue(':eventId', $eventId);
            $pdostmt->bindValue(':categoryId', $categoryId);
            $result = $pdostmt->execute();
            return $result;
        }
        public function getEvent($id) 
        {
            $sqlQuery = "SELECT e.*, l.*, b.businessName BusinessName FROM events e JOIN business b ON b.id = e.businessId JOIN locations l ON l.id = b.locationid WHERE e.id = :id;";
            $pdostmt = $this->_db->prepare($sqlQuery);
            $pdostmt->bindValue(":id", $id, PDO::PARAM_STR);
            $pdostmt -> execute();
            $result = $pdostmt -> fetch();
            $event = new EventModel($result);
            return $event;
        }
        public function deleteEvent($eventModel)
        {
            $query = "DELETE FROM events
                      WHERE Id = :id;";
            $pdostmt = $this->_db->prepare($query);
            $pdostmt-> bindValue(':id', $eventModel->getEventId());
            $result = $pdostmt-> execute();
            return $result;
        }
        public function editEvent($eventModel)
        {
            $query = "UPDATE events
                      SET EventName= :eventName, BusinessId = :businessId, EndDateTime= :endDateTime, StartDateTime= :startDateTime, EventDescription= :eventDescription
                      WHERE Id= :eventId;";
            $pdostmt = $this->_db->prepare($query);
            $pdostmt->bindValue(':eventId', $eventModel->getEventId(), PDO::PARAM_STR);
            $pdostmt->bindValue(':businessId', $eventModel->getBusinessId(), PDO::PARAM_STR);
            $pdostmt->bindValue(':eventName', $eventModel->getName(), PDO::PARAM_STR);
            $pdostmt->bindValue(':endDateTime', $eventModel->getEndDateTime(), PDO::PARAM_STR);
            $pdostmt->bindValue(':startDateTime', $eventModel->getStartDateTime(), PDO::PARAM_STR);
            $pdostmt->bindValue(':eventDescription', $eventModel->getDescription(), PDO::PARAM_STR);
            $result = $pdostmt->execute();
            return $result;
        }
    }
?>