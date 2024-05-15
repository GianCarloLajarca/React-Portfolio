<?php

Class About {
    public $about_aid;
    public $about_title;
    public $about_photo;
    public $about_is_active;
    public $about_publish_date;
    public $about_description;
    public $about_detail;
    public $about_name;
    public $about_email;
    public $about_phone;
    public $about_birthday;
    public $about_nationality;
    public $about_address;
    public $about_created;
    public $about_search;
    public $about_datetime;

    public $connection;
    public $lastInsertedId;
    public $tblAbout;

    public function __construct($db) {
        $this->connection = $db;
        $this->tblAbout = "about";
    }

    public function create() {
        try {
             $sql = "insert into {$this->tblAbout} ";
             $sql .= "( about_title, ";
             $sql .= "about_photo, ";
             $sql .= "about_is_active, ";
             $sql .= "about_publish_date, ";
             $sql .= "about_description, ";
             $sql .= "about_detail, ";
             $sql .= "about_name, ";
             $sql .= "about_email, ";
             $sql .= "about_phone, ";
             $sql .= "about_birthday, ";
             $sql .= "about_nationality, ";
             $sql .= "about_address, ";
             $sql .= "about_created, ";
             $sql .= "about_datetime ) values ( ";
             $sql .= ":about_title, ";
             $sql .= ":about_photo, ";
             $sql .= ":about_is_active, ";
             $sql .= ":about_publish_date, ";
             $sql .= ":about_description, ";
             $sql .= ":about_detail, ";
             $sql .= ":about_name, ";
             $sql .= ":about_email, ";
             $sql .= ":about_phone, ";
             $sql .= ":about_birthday, ";
             $sql .= ":about_nationality, ";
             $sql .= ":about_address, ";
             $sql .= ":about_created, ";
             $sql .= ":about_datetime ) ";
             $query = $this->connection->prepare($sql);
             $query->execute([
                "about_title" => $this->about_title,
                "about_photo" => $this->about_photo,
                "about_is_active" => $this->about_is_active,
                "about_publish_date" => $this->about_publish_date,
                "about_description" => $this->about_description,
                "about_detail" => $this->about_detail,
                "about_name" => $this->about_name,
                "about_email" => $this->about_email,
                "about_phone" => $this->about_phone,
                "about_birthday" => $this->about_birthday,
                "about_nationality" => $this->about_nationality,
                "about_address" => $this->about_address,
                "about_created" => $this->about_created,
                "about_datetime" => $this->about_datetime,
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
            $sql .= "from {$this->tblAbout} ";
            $sql .= "order by about_is_active desc ";
            $query = $this->connection->query($sql);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function delete()
    {
        try {
            $sql = "delete from {$this->tblAbout} ";
            $sql .= "where about_aid = :about_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "about_aid" => $this->about_aid,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function update()
    {
        try {
            $sql = "update {$this->tblAbout} set ";
            $sql .= "about_title = :about_title, ";
            $sql .= "about_photo = :about_photo, ";
            $sql .= "about_publish_date = :about_publish_date, ";
            $sql .= "about_description = :about_description, ";
            $sql .= "about_detail = :about_detail, ";
            $sql .= "about_name = :about_name, ";
            $sql .= "about_email = :about_email, ";
            $sql .= "about_phone = :about_phone, ";
            $sql .= "about_birthday = :about_birthday, ";
            $sql .= "about_nationality = :about_nationality, ";
            $sql .= "about_address = :about_address, ";
            $sql .= "about_datetime = :about_datetime ";
            $sql .= "where about_aid  = :about_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "about_title" => $this->about_title,
                "about_photo" => $this->about_photo,
                "about_publish_date" => $this->about_publish_date,
                "about_description" => $this->about_description,
                "about_detail" => $this->about_detail,
                "about_name" => $this->about_name,
                "about_email" => $this->about_email,
                "about_phone" => $this->about_phone,
                "about_birthday" => $this->about_birthday,
                "about_nationality" => $this->about_nationality,
                "about_address" => $this->about_address,
                "about_datetime" => $this->about_datetime,
                "about_aid" => $this->about_aid,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function active()
    {
        try {
            $sql = "update {$this->tblAbout} set ";
            $sql .= "about_is_active = :about_is_active, ";
            $sql .= "about_datetime = :about_datetime ";
            $sql .= "where about_aid  = :about_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "about_is_active" => $this->about_is_active,
                "about_datetime" => $this->about_datetime,
                "about_aid" => $this->about_aid,
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
            $sql .= "from {$this->tblAbout} ";
            $sql .= "where about_title like :about_title ";
            $sql .= "order by about_is_active desc, ";
            $sql .= "about_title asc ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "about_title" => "%{$this->about_search}%",
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }
}