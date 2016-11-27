<?php

namespace App\Http\Controllers;

use App\Book;
use Symfony\Component\VarDumper\VarDumper;

/**
 * Class BookController
 * @package App\Http\Controllers
 */
class BookController extends Controller
{
    /**
     * Get Books with filter by Author.name
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get()
    {
        $books = Book::all();
        $author = \Request::get('author');

        if($author !== null){
            $books = Book::whereHas('author',function ($query) use ($author){
               $query->where('name','like',$author);
            })->get();
        }
        
        return response()->json($books);
    }

    /**
     * Get Books by id with Author name
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getById($id)
    {
        $book = Book::find($id);

        return response()->json([
            'book' => $book->name,
            'author' => $book->author->name,
        ]);
    }


    /**
     * Create Book
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        $book = new Book();
        $book->setRawAttributes(\Request::all());

        $validator = $book->validate();

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        return response()->json([
            'status' => $book->save(),
        ]);
    }


    /**
     * Update(edit) Book
     *
     * @param Book $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Book $book)
    {
        $book->setRawAttributes(\Request::all());

        $validator = $book->validate();

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        return response()->json([
            'status' => $book->save(),
        ]);
    }

    /**
     * Delete Book
     *
     * @param Book $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Book $book)
    {
        return response()->json([
            'status' => $book->delete(),
        ]);
    }
}