<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Book::first()->get();//con el metodo first me devuelve
        // //el de la posicion 1 pero si le añado el get al final 
        // //me los devuelve todos.
        // return Book::first()->paginate(5); //esto sirve para 
        //paginar y organizar todo por paginas
    }

    public function getByTitle($value)
    {
        return Book::where('title', $value)->get();//para que me devuelva
        //un libro por titulo
    }

    public function getById($id)
    {
        return Book::find($id);//para que me devuelva
        //un libro por su id, ejemplo: busco el numero 20 y me lo trae
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            Book::create($request->all());
            return 'El libro se ha agregado con exito';
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Book::where('id', $request->id)->update($request->all());
        return 'El libro se ha actualizado con exito';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    
     public function destroy($id)
     {
         $book = Book::find($id);
         $book->delete();
         return 'El libro se ha eliminado con exito';
     }
  
}
