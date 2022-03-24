<?php
class Centre{
    protected $Conn;

    public function __construct($Conn){
        $this->Conn = $Conn;
    }

    public function getAllCentres($category_id){
        $query = "SELECT * FROM sports_centres WHERE category_id = :category_id";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute([
            "category_id" => $category_id
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCentre($centre_id){
        $query = "SELECT * FROM sports_centres WHERE centre_id = :centre_id";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute([
            "centre_id" => $centre_id
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchCentres($query_string) {
        $query = "SELECT * FROM sports_centres WHERE centre_name LIKE :query_string";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute([
            "query_string" => "%".$query_string."%"
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  
    }    
}