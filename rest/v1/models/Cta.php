<?php

Class Cta {
    public $cta_aid;
    public $cta_title;
    public $cta_subtitle;
    public $cta_is_active;
    public $cta_publish_date;
    public $cta_button;
    public $cta_created;
    public $cta_search;
    public $cta_datetime;

    public $connection;
    public $lastInsertedId;
    public $tblCta;

    public function __construct($db) {
        $this->connection = $db;
        $this->tblCta = "cta";
    }

    public function create() {
        try {
             $sql = "insert into {$this->tblCta} ";
             $sql .= "( cta_title, ";
             $sql .= "cta_subtitle, ";
             $sql .= "cta_is_active, ";
             $sql .= "cta_publish_date, ";
             $sql .= "cta_button, ";
             $sql .= "cta_created, ";
             $sql .= "cta_datetime ) values ( ";
             $sql .= ":cta_title, ";
             $sql .= ":cta_subtitle, ";
             $sql .= ":cta_is_active, ";
             $sql .= ":cta_publish_date, ";
             $sql .= ":cta_button, ";
             $sql .= ":cta_created, ";
             $sql .= ":cta_datetime ) ";
             $query = $this->connection->prepare($sql);
             $query->execute([
                "cta_title" => $this->cta_title,
                "cta_subtitle" => $this->cta_subtitle,
                "cta_is_active" => $this->cta_is_active,
                "cta_publish_date" => $this->cta_publish_date,
                "cta_button" => $this->cta_button,
                "cta_created" => $this->cta_created,
                "cta_datetime" => $this->cta_datetime,
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
            $sql .= "from {$this->tblCta} ";
            $sql .= "order by cta_is_active desc ";
            $query = $this->connection->query($sql);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function delete()
    {
        try {
            $sql = "delete from {$this->tblCta} ";
            $sql .= "where cta_aid = :cta_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "cta_aid" => $this->cta_aid,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function update()
    {
        try {
            $sql = "update {$this->tblCta} set ";
            $sql .= "cta_title = :cta_title, ";
            $sql .= "cta_subtitle = :cta_subtitle, ";
            $sql .= "cta_publish_date = :cta_publish_date, ";
            $sql .= "cta_button = :cta_button, ";
            $sql .= "cta_datetime = :cta_datetime ";
            $sql .= "where cta_aid  = :cta_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "cta_title" => $this->cta_title,
                "cta_subtitle" => $this->cta_subtitle,
                "cta_publish_date" => $this->cta_publish_date,
                "cta_button" => $this->cta_button,
                "cta_datetime" => $this->cta_datetime,
                "cta_aid" => $this->cta_aid,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function active()
    {
        try {
            $sql = "update {$this->tblCta} set ";
            $sql .= "cta_is_active = :cta_is_active, ";
            $sql .= "cta_datetime = :cta_datetime ";
            $sql .= "where cta_aid  = :cta_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "cta_is_active" => $this->cta_is_active,
                "cta_datetime" => $this->cta_datetime,
                "cta_aid" => $this->cta_aid,
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
            $sql .= "from {$this->tblCta} ";
            $sql .= "where cta_title like :cta_title ";
            $sql .= "order by cta_is_active desc, ";
            $sql .= "cta_title asc ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "cta_title" => "%{$this->cta_search}%",
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }
}