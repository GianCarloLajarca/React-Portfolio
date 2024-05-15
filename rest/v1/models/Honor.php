<?php

Class Honor {
    public $honor_aid;
    public $honor_title;
    public $honor_photo;
    public $honor_is_active;
    public $honor_publish_date;
    public $honor_date;
    public $honor_giver;
    public $honor_created;
    public $honor_search;
    public $honor_datetime;

    public $connection;
    public $lastInsertedId;
    public $tblHonor;

    public function __construct($db) {
        $this->connection = $db;
        $this->tblHonor = "honor";
    }

    public function create() {
        try {
             $sql = "insert into {$this->tblHonor} ";
             $sql .= "( honor_title, ";
             $sql .= "honor_photo, ";
             $sql .= "honor_is_active, ";
             $sql .= "honor_publish_date, ";
             $sql .= "honor_date, ";
             $sql .= "honor_giver, ";
             $sql .= "honor_created, ";
             $sql .= "honor_datetime ) values ( ";
             $sql .= ":honor_title, ";
             $sql .= ":honor_photo, ";
             $sql .= ":honor_is_active, ";
             $sql .= ":honor_publish_date, ";
             $sql .= ":honor_date, ";
             $sql .= ":honor_giver, ";
             $sql .= ":honor_created, ";
             $sql .= ":honor_datetime ) ";
             $query = $this->connection->prepare($sql);
             $query->execute([
                "honor_title" => $this->honor_title,
                "honor_photo" => $this->honor_photo,
                "honor_is_active" => $this->honor_is_active,
                "honor_publish_date" => $this->honor_publish_date,
                "honor_date" => $this->honor_date,
                "honor_giver" => $this->honor_giver,
                "honor_created" => $this->honor_created,
                "honor_datetime" => $this->honor_datetime,
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
            $sql .= "from {$this->tblHonor} ";
            $sql .= "order by honor_is_active desc ";
            $query = $this->connection->query($sql);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function delete()
    {
        try {
            $sql = "delete from {$this->tblHonor} ";
            $sql .= "where honor_aid = :honor_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "honor_aid" => $this->honor_aid,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function update()
    {
        try {
            $sql = "update {$this->tblHonor} set ";
            $sql .= "honor_title = :honor_title, ";
            $sql .= "honor_photo = :honor_photo, ";
            $sql .= "honor_publish_date = :honor_publish_date, ";
            $sql .= "honor_date = :honor_date, ";
            $sql .= "honor_giver = :honor_giver, ";
            $sql .= "honor_datetime = :honor_datetime ";
            $sql .= "where honor_aid  = :honor_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "honor_title" => $this->honor_title,
                "honor_photo" => $this->honor_photo,
                "honor_publish_date" => $this->honor_publish_date,
                "honor_date" => $this->honor_date,
                "honor_giver" => $this->honor_giver,
                "honor_datetime" => $this->honor_datetime,
                "honor_aid" => $this->honor_aid,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function active()
    {
        try {
            $sql = "update {$this->tblHonor} set ";
            $sql .= "honor_is_active = :honor_is_active, ";
            $sql .= "honor_datetime = :honor_datetime ";
            $sql .= "where honor_aid  = :honor_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "honor_is_active" => $this->honor_is_active,
                "honor_datetime" => $this->honor_datetime,
                "honor_aid" => $this->honor_aid,
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
            $sql .= "from {$this->tblHonor} ";
            $sql .= "where honor_title like :honor_title ";
            $sql .= "order by honor_is_active desc, ";
            $sql .= "honor_title asc ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "honor_title" => "%{$this->honor_search}%",
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }
}