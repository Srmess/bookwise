<?php

class Book
{
    public $id;
    public $title;
    public $author;
    public $description;
    public $released_year;
    public $user_id;
    public $review_amount;
    public $review_avarange;

    private static function query($where, $params)
    {

        $dataBase = new Database(config('database'));

        return $dataBase->query(
            query: " select
            b.id,
            b.title,
            b.author,
            b.description,
            b.released_year,
            count(r.id) as review_amount,
            round(sum(r.rating) / 5) as review_avarange
            from
            books b
            left join reviews r on r.book_id = b.id
            where $where
            group by
            b.id,
            b.title,
            b.author,
            b.description,
            b.released_year",
            class: self::class,
            params: $params
        );
    }


    public static function all($searchparam)
    {
        $books =  self::query(
            where: 'b.title like :search',
            params: ['search' => "%$searchparam%"]
        )->fetchAll();

        return $books;
    }

    public static function get($bookId)
    {
        $book =  self::query(
            where: 'b.id = :id',
            params: ['id' => $bookId]
        )->fetch();

        return $book;
    }
    public static function allMyBooks($user_id)
    {
        $books =  self::query(
            where: 'b.user_id = :id',
            params: ['id' => $user_id]
        )->fetchAll();

        return $books;
    }
}
