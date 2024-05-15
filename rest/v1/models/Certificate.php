<?php

Class Certificate {
    public $certificate_aid;
    public $certificate_title;
    public $certificate_photo;
    public $certificate_is_active;
    public $certificate_publish_date;
    public $certificate_date;
    public $certificate_organization;
    public $certificate_created;
    public $certificate_search;
    public $certificate_datetime;

    public $connection;
    public $lastInsertedId;
    public $tblCertificate;

    public function __construct($db) {
        $this->connection = $db;
        $this->tblCertificate = "certificate";
    }

    public function create() {
        try {
             $sql = "insert into {$this->tblCertificate} ";
             $sql .= "( certificate_title, ";
             $sql .= "certificate_photo, ";
             $sql .= "certificate_is_active, ";
             $sql .= "certificate_publish_date, ";
             $sql .= "certificate_date, ";
             $sql .= "certificate_organization, ";
             $sql .= "certificate_created, ";
             $sql .= "certificate_datetime ) values ( ";
             $sql .= ":certificate_title, ";
             $sql .= ":certificate_photo, ";
             $sql .= ":certificate_is_active, ";
             $sql .= ":certificate_publish_date, ";
             $sql .= ":certificate_date, ";
             $sql .= ":certificate_organization, ";
             $sql .= ":certificate_created, ";
             $sql .= ":certificate_datetime ) ";
             $query = $this->connection->prepare($sql);
             $query->execute([
                "certificate_title" => $this->certificate_title,
                "certificate_photo" => $this->certificate_photo,
                "certificate_is_active" => $this->certificate_is_active,
                "certificate_publish_date" => $this->certificate_publish_date,
                "certificate_date" => $this->certificate_date,
                "certificate_organization" => $this->certificate_organization,
                "certificate_created" => $this->certificate_created,
                "certificate_datetime" => $this->certificate_datetime,
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
            $sql .= "from {$this->tblCertificate} ";
            $sql .= "order by certificate_is_active desc ";
            $query = $this->connection->query($sql);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function delete()
    {
        try {
            $sql = "delete from {$this->tblCertificate} ";
            $sql .= "where certificate_aid = :certificate_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "certificate_aid" => $this->certificate_aid,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function update()
    {
        try {
            $sql = "update {$this->tblCertificate} set ";
            $sql .= "certificate_title = :certificate_title, ";
            $sql .= "certificate_photo = :certificate_photo, ";
            $sql .= "certificate_publish_date = :certificate_publish_date, ";
            $sql .= "certificate_date = :certificate_date, ";
            $sql .= "certificate_organization = :certificate_organization, ";
            $sql .= "certificate_datetime = :certificate_datetime ";
            $sql .= "where certificate_aid  = :certificate_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "certificate_title" => $this->certificate_title,
                "certificate_photo" => $this->certificate_photo,
                "certificate_publish_date" => $this->certificate_publish_date,
                "certificate_date" => $this->certificate_date,
                "certificate_organization" => $this->certificate_organization,
                "certificate_datetime" => $this->certificate_datetime,
                "certificate_aid" => $this->certificate_aid,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function active()
    {
        try {
            $sql = "update {$this->tblCertificate} set ";
            $sql .= "certificate_is_active = :certificate_is_active, ";
            $sql .= "certificate_datetime = :certificate_datetime ";
            $sql .= "where certificate_aid  = :certificate_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "certificate_is_active" => $this->certificate_is_active,
                "certificate_datetime" => $this->certificate_datetime,
                "certificate_aid" => $this->certificate_aid,
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
            $sql .= "from {$this->tblCertificate} ";
            $sql .= "where certificate_title like :certificate_title ";
            $sql .= "order by certificate_is_active desc, ";
            $sql .= "certificate_title asc ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "certificate_title" => "%{$this->certificate_search}%",
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }
}