<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Author::first()->get();//con el metodo first me devuelve
        // //el de la posicion 1 pero si le añado el get al final 
        // //me los devuelve todos.
        // return Author::first()->paginate(5); //esto sirve para 
        //paginar y organizar todo por paginas
    }

    public function getByName($value)
    {
            // if($value !== '');
            return Author::where('name', $value)->get();//para que me devuelva
            //un libro por nombre
    }

    public function getById($id)
    {
        return Author::find($id);//para que me devuelva
        //un autor por su id, ejemplo: busco el numero 20 y me lo trae
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            Author::create($request->all());
            return 'El autor se ha agregado con exito';
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Author::where('id', $request->id)->update($request->all());
        return 'El autor se ha actualizado con exito';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    
     public function destroy($id)
     {
         $author = Author::find($id);
         $author->delete();
         return 'El autor se ha eliminado con exito';
     }
}

