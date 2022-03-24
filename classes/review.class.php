<?php
class Review {
    protected $Conn;

    public function __construct($Conn){
        $this->Conn = $Conn;
    }

    public function createReview($review_data){
        $query = "INSERT INTO reviews (user_id, centre_id, review_rating, rating_comments) VALUES (:user_id, :centre_id, :review_rating, :rating_comments)";
        $stmt = $this->Conn->prepare($query);
        return $stmt->execute(array(
            'user_id' => $_SESSION['user_data']['user_id'],
            'centre_id' => $review_data['centre_id'],
            'review_rating' => $review_data['review_rating'],
            'rating_comments' => $review_data['rating_comments']
        ));
    }

    public function getReviews($centre_id){
        $query = "SELECT * FROM reviews INNER JOIN users ON users.user_id = reviews.user_id WHERE centre_id = :centre_id";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute([
            "centre_id" => $centre_id
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findUserReview($centre_id){
        $query = "SELECT * FROM reviews WHERE user_id = ? AND centre_id = ?";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute(array($_SESSION['user_data']['user_id'], $centre_id));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function calculateRating($centre_id){
        $query = "SELECT AVG(review_rating) AS avg_rating FROM reviews WHERE centre_id = :centre_id";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute(array(
            'centre_id' => $centre_id,
        ));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }    
}
