<?php

Class Service {
    public $service_aid;
    public $service_title;
    public $service_photo;
    public $service_is_active;
    public $service_publish_date;
    public $service_created;
    public $service_search;
    public $service_datetime;

    public $connection;
    public $lastInsertedId;
    public $tblService;

    public function __construct($db) {
        $this->connection = $db;
        $this->tblService = "service";
    }

    public function create() {
        try {
             $sql = "insert into {$this->tblService} ";
             $sql .= "( service_title, ";
             $sql .= "service_photo, ";
             $sql .= "service_is_active, ";
             $sql .= "service_publish_date, ";
             $sql .= "service_created, ";
             $sql .= "service_datetime ) values ( ";
             $sql .= ":service_title, ";
             $sql .= ":service_photo, ";
             $sql .= ":service_is_active, ";
             $sql .= ":service_publish_date, ";
             $sql .= ":service_created, ";
             $sql .= ":service_datetime ) ";
             $query = $this->connection->prepare($sql);
             $query->execute([
                "service_title" => $this->service_title,
                "service_photo" => $this->service_photo,
                "service_is_active" => $this->service_is_active,
                "service_publish_date" => $this->service_publish_date,
                "service_created" => $this->service_created,
                "service_datetime" => $this->service_datetime,
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
            $sql .= "from {$this->tblService} ";
            $sql .= "order by service_is_active desc ";
            $query = $this->connection->query($sql);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function delete()
    {
        try {
            $sql = "delete from {$this->tblService} ";
            $sql .= "where service_aid = :service_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "service_aid" => $this->service_aid,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function update()
    {
        try {
            $sql = "update {$this->tblService} set ";
            $sql .= "service_title = :service_title, ";
            $sql .= "service_photo = :service_photo, ";
            $sql .= "service_publish_date = :service_publish_date, ";
            $sql .= "service_datetime = :service_datetime ";
            $sql .= "where service_aid  = :service_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "service_title" => $this->service_title,
                "service_photo" => $this->service_photo,
                "service_publish_date" => $this->service_publish_date,
                "service_datetime" => $this->service_datetime,
                "service_aid" => $this->service_aid,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function active()
    {
        try {
            $sql = "update {$this->tblService} set ";
            $sql .= "service_is_active = :service_is_active, ";
            $sql .= "service_datetime = :service_datetime ";
            $sql .= "where service_aid  = :service_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "service_is_active" => $this->service_is_active,
                "service_datetime" => $this->service_datetime,
                "service_aid" => $this->service_aid,
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
            $sql .= "from {$this->tblService} ";
            $sql .= "where service_title like :service_title ";
            $sql .= "order by service_is_active desc, ";
            $sql .= "service_title asc ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "service_title" => "%{$this->service_search}%",
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }
}