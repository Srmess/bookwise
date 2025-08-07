<?php

class Review
{
    public $id;
    public $review;
    public $rating;
    public $user_id;
    public $book_id;

    private static function query($where, $params)
    {
        $database =  new Database(config('database'));

        return $database->query(query: "select * from reviews where $where", class: self::class, params: $params);
    }

    public static function allBookReviews($bookId)
    {

        $reviews = (new self)->query(
            'book_id = :id',
            ['id' => $bookId]
        )->fetchAll();

        return $reviews;
    }
}
