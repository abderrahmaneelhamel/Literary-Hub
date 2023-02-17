<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class bookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Book::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "book_title" => 'required',
            "book_description" => 'required',
            "book_author'" => 'required',
            "book_cover" => 'required',
            "likes" => 'required',
            "category_id" => 'required',
        ]);
        $book = book::create([
            "book_title" => $request->book_title,
            "book_description" => $request->book_description,
            "book_author'" => $request->book_author,
            "book_cover" => $request->book_cover,
            "likes" => $request->likes,
            "category_id" => $request->category_id,
        ]);
        return response()->json($book);
    }

    /**
     * Display the specified resource.
     */
    public function show(book $book)
    {
        return response()->json($book);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, book $book)
    {
        $this->validate($request, [
            "book_title" => 'required',
            "book_description" => 'required',
            "book_author'" => 'required',
            "book_cover" => 'required',
            "likes" => 'required',
            "category_id" => 'required',
        ]);
        book::where('id',$book->id)->update([
            "book_title" => $request->book_title,
            "book_description" => $request->book_description,
            "book_author'" => $request->book_author,
            "book_cover" => $request->book_cover,
            "likes" => $request->likes,
            "category_id" => $request->category_id,
        ]);
        return response()->json($book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(book $book)
    {
        book::where('id',$book->id)->delete();
        return response()->json([
            'message' => 'deleted'
        ]);
    }
}
