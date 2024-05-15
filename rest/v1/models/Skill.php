<?php

Class Skill {
    public $skill_aid;
    public $skill_title;
    public $skill_photo;
    public $skill_is_active;
    public $skill_publish_date;
    public $skill_description;
    public $skill_created;
    public $skill_search;
    public $skill_datetime;

    public $connection;
    public $lastInsertedId;
    public $tblSkill;

    public function __construct($db) {
        $this->connection = $db;
        $this->tblSkill = "skill";
    }

    public function create() {
        try {
             $sql = "insert into {$this->tblSkill} ";
             $sql .= "( skill_title, ";
             $sql .= "skill_photo, ";
             $sql .= "skill_is_active, ";
             $sql .= "skill_publish_date, ";
             $sql .= "skill_description, ";
             $sql .= "skill_created, ";
             $sql .= "skill_datetime ) values ( ";
             $sql .= ":skill_title, ";
             $sql .= ":skill_photo, ";
             $sql .= ":skill_is_active, ";
             $sql .= ":skill_publish_date, ";
             $sql .= ":skill_description, ";
             $sql .= ":skill_created, ";
             $sql .= ":skill_datetime ) ";
             $query = $this->connection->prepare($sql);
             $query->execute([
                "skill_title" => $this->skill_title,
                "skill_photo" => $this->skill_photo,
                "skill_is_active" => $this->skill_is_active,
                "skill_publish_date" => $this->skill_publish_date,
                "skill_description" => $this->skill_description,
                "skill_created" => $this->skill_created,
                "skill_datetime" => $this->skill_datetime,
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
            $sql .= "from {$this->tblSkill} ";
            $sql .= "order by skill_is_active desc ";
            $query = $this->connection->query($sql);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function delete()
    {
        try {
            $sql = "delete from {$this->tblSkill} ";
            $sql .= "where skill_aid = :skill_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "skill_aid" => $this->skill_aid,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function update()
    {
        try {
            $sql = "update {$this->tblSkill} set ";
            $sql .= "skill_title = :skill_title, ";
            $sql .= "skill_photo = :skill_photo, ";
            $sql .= "skill_publish_date = :skill_publish_date, ";
            $sql .= "skill_description = :skill_description, ";
            $sql .= "skill_datetime = :skill_datetime ";
            $sql .= "where skill_aid  = :skill_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "skill_title" => $this->skill_title,
                "skill_photo" => $this->skill_photo,
                "skill_publish_date" => $this->skill_publish_date,
                "skill_description" => $this->skill_description,
                "skill_datetime" => $this->skill_datetime,
                "skill_aid" => $this->skill_aid,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function active()
    {
        try {
            $sql = "update {$this->tblSkill} set ";
            $sql .= "skill_is_active = :skill_is_active, ";
            $sql .= "skill_datetime = :skill_datetime ";
            $sql .= "where skill_aid  = :skill_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "skill_is_active" => $this->skill_is_active,
                "skill_datetime" => $this->skill_datetime,
                "skill_aid" => $this->skill_aid,
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
            $sql .= "from {$this->tblSkill} ";
            $sql .= "where skill_title like :skill_title ";
            $sql .= "order by skill_is_active desc, ";
            $sql .= "skill_title asc ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "skill_title" => "%{$this->skill_search}%",
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }
}