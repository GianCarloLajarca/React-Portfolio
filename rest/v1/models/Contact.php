<?php

Class Contact {
    public $contact_aid;
    public $contact_title;
    public $contact_paragraph;
    public $contact_is_active;
    public $contact_publish_date;
    public $contact_phone;
    public $contact_emailaddress;
    public $contact_address;
    public $contact_button;
    public $contact_name;
    public $contact_email;
    public $contact_message;
    public $contact_created;
    public $contact_search;
    public $contact_datetime;

    public $connection;
    public $lastInsertedId;
    public $tblContact;

    public function __construct($db) {
        $this->connection = $db;
        $this->tblContact = "contact";
    }

    public function create() {
        try {
             $sql = "insert into {$this->tblContact} ";
             $sql .= "( contact_title, ";
             $sql .= "contact_paragraph, ";
             $sql .= "contact_is_active, ";
             $sql .= "contact_publish_date, ";
             $sql .= "contact_phone, ";
             $sql .= "contact_emailaddress, ";
             $sql .= "contact_address, ";
             $sql .= "contact_button, ";
             $sql .= "contact_name, ";
             $sql .= "contact_email, ";
             $sql .= "contact_message, ";
             $sql .= "contact_created, ";
             $sql .= "contact_datetime ) values ( ";
             $sql .= ":contact_title, ";
             $sql .= ":contact_paragraph, ";
             $sql .= ":contact_is_active, ";
             $sql .= ":contact_publish_date, ";
             $sql .= ":contact_phone, ";
             $sql .= ":contact_emailaddress, ";
             $sql .= ":contact_address, ";
             $sql .= ":contact_button, ";
             $sql .= ":contact_name, ";
             $sql .= ":contact_email, ";
             $sql .= ":contact_message, ";
             $sql .= ":contact_created, ";
             $sql .= ":contact_datetime ) ";
             $query = $this->connection->prepare($sql);
             $query->execute([
                "contact_title" => $this->contact_title,
                "contact_paragraph" => $this->contact_paragraph,
                "contact_is_active" => $this->contact_is_active,
                "contact_publish_date" => $this->contact_publish_date,
                "contact_phone" => $this->contact_phone,
                "contact_emailaddress" => $this->contact_emailaddress,
                "contact_address" => $this->contact_address,
                "contact_button" => $this->contact_button,
                "contact_name" => $this->contact_name,
                "contact_email" => $this->contact_email,
                "contact_message" => $this->contact_message,
                "contact_created" => $this->contact_created,
                "contact_datetime" => $this->contact_datetime,
             ]);
             $this->lastInsertedId = $this->connection->lastInsertId();
        } catch (PDOException $ex) {
            $query = false;
        }

        return $query;
    }

    public function readAll()
    {
        try {
            $sql = "select * ";
            $sql .= "from {$this->tblContact} ";
            $sql .= "order by contact_is_active desc ";
            $query = $this->connection->query($sql);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function delete()
    {
        try {
            $sql = "delete from {$this->tblContact} ";
            $sql .= "where contact_aid = :contact_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "contact_aid" => $this->contact_aid,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function update()
    {
        try {
            $sql = "update {$this->tblContact} set ";
            $sql .= "contact_title = :contact_title, ";
            $sql .= "contact_paragraph = :contact_paragraph, ";
            $sql .= "contact_publish_date = :contact_publish_date, ";
            $sql .= "contact_phone = :contact_phone, ";
            $sql .= "contact_emailaddress = :contact_emailaddress, ";
            $sql .= "contact_address = :contact_address, ";
            $sql .= "contact_button = :contact_button, ";
            $sql .= "contact_name = :contact_name, ";
            $sql .= "contact_email = :contact_email, ";
            $sql .= "contact_message = :contact_message, ";
            $sql .= "contact_datetime = :contact_datetime ";
            $sql .= "where contact_aid  = :contact_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "contact_title" => $this->contact_title,
                "contact_paragraph" => $this->contact_paragraph,
                "contact_publish_date" => $this->contact_publish_date,
                "contact_phone" => $this->contact_phone,
                "contact_emailaddress" => $this->contact_emailaddress,
                "contact_address" => $this->contact_address,
                "contact_button" => $this->contact_button,
                "contact_name" => $this->contact_name,
                "contact_email" => $this->contact_email,
                "contact_message" => $this->contact_message,
                "contact_datetime" => $this->contact_datetime,
                "contact_aid" => $this->contact_aid,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function active()
    {
        try {
            $sql = "update {$this->tblContact} set ";
            $sql .= "contact_is_active = :contact_is_active, ";
            $sql .= "contact_datetime = :contact_datetime ";
            $sql .= "where contact_aid  = :contact_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "contact_is_active" => $this->contact_is_active,
                "contact_datetime" => $this->contact_datetime,
                "contact_aid" => $this->contact_aid,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function search()
    {
        try {
            $sql = "select ";
            $sql .= "* ";
            $sql .= "from {$this->tblContact} ";
            $sql .= "where contact_title like :contact_title ";
            $sql .= "order by contact_is_active desc, ";
            $sql .= "contact_title asc ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "contact_title" => "%{$this->contact_search}%",
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }
}