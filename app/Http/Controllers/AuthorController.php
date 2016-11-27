<?php

namespace App\Http\Controllers;

use App\Author;
use Symfony\Component\VarDumper\VarDumper;

/**
 * Class AuthorController
 * @package App\Http\Controllers
 */
class AuthorController extends Controller
{

    /**
     * Get Author
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get()
    {
        return response()->json(Author::all());
    }

    /**
     * Get author with book_count by id
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getById($id)
    {
        $author = Author::find($id)->withCount('book')->get();

        return response()->json($author);
    }

    /**
     * Create Author
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        $author = new Author();
        $author->setRawAttributes(\Request::all());

        $validator = $author->validate();

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        return response()->json([
            'status' => $author->save(),
        ]);
    }

    /**
     * Update(edit) Author
     *
     * @param Author $author
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Author $author)
    {
        $author->setRawAttributes(\Request::all());

        $validator = $author->validate();

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        return response()->json([
            'status' => $author->save(),
        ]);
    }

    /**
     * Delete Author
     *
     * @param Author $author
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Author $author)
    {
        return response()->json([
            'status' => $author->delete(),
        ]);
    }
}