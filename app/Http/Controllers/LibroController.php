<?php

namespace App\Http\Controllers;

use App\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $libros = Libro::orderBy('id', 'DESC')->paginate(3);
        return view('Libro.index', compact('libros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Libro.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre'=>'required',
            'resumen'=>'required', 
            'npagina'=>'required', 
            'edicion'=>'required', 
            'autor'=>'required', 
            'precio'=>'required']);
        
            Libro::create($request->all());
            return redirect()->route('libros.index')->with('success', 'Se registro correctamente el libro');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $libros=Libro::find($id);
        return  view('libro.show',compact('libros'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $libro=libro::find($id);
        return view('libro.edit', compact('libro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         
         $this->validate($request,[ 
             'nombre'=>'required', 
             'resumen'=>'required', 
             'npagina'=>'required', 
             'edicion'=>'required', 
             'autor'=>'required', 
             'precio'=>'required']);
        
             libro::find($id)->update($request->all());
             return redirect()->route('libros.index')->with('success', 'Registro actualizado correctamente');
           
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Libro::find($id)->delete();
        return redirect()->route('libros.index')->with('success', 'Registro Eliminado Satisfactoriamente');
    }

    public function getLibros(){
        $libros=Libro::all();
        return response()->json($libros);
    }

}
