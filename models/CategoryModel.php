<?php
    class CategoryModel 
    {
        private $_categoryId;
        private $_categoryTitle;
        private $_categoryDescription;
        private $_eventId;

        public function __construct($queryResult)
        {
            if(isset($queryResult["Id"])) {
                $this->_categoryId = $queryResult["Id"];
            }
            if(isset($queryResult["EventId"])) {
                $this->_eventId = $queryResult["EventId"];
            }
            $this->_categoryTitle = $queryResult["CategoryTitle"];
            $this->_categoryDescription = $queryResult["CategoryDescription"];
        }

        public function getTitle()
        {
            return $this->_categoryTitle;
        }

        public function setTitle($title)
        {
            $value = trim($value);
            if(strlen($value) > 5) {
                $this->_categoryTitl = $value;
            } else {
                throw new Exception('Category title is too short.');
            }
        }

        public function getDescription()
        {
            return $this->_categoryDescription;
        }

        public function setDescription($description)
        {
            $value = trim($value);
            if(strlen($value) > 5) {
                $this->_categoryDescription = $value;
            } else {
                throw new Exception('Category description is too short.');
            }
        }

        public function getId ()
        {
            return $this->_categoryId;
        }

        public function setId($id)
        {
            $this->_categoryId = $id;
        }

    }
?>