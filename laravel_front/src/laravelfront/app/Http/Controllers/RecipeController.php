<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = Http::post(env("APP_BACKEND") . 'pedir', [
            'cantidad' => $request->cantidad
        ]);
        
        return json_decode($response->getBody());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showColas()
    {
        $response = Http::post(env("APP_BACKEND") . 'cola');
        
        $colas = json_decode($response->getBody(), true);
        $colas = $colas['pedidos'];

        return view('cola',compact('colas'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showIngredientes()
    {
        $response = Http::post(env("APP_BACKEND") . 'ingredientes');
        
        $data = json_decode($response->getBody(), true);
        
        $stock = json_decode($data['stock']['json'], true);

        return view('ingredient',compact('stock'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showHistoric()
    {
        $response = Http::post(env("APP_BACKEND") . 'historico');
        
        $data = json_decode($response->getBody(), true);
        
        $historics = $data['historico'];

        return view('historic',compact('historics'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showRecetas()
    {
        $response = Http::post(env("APP_BACKEND") . 'recetas');
        
        $data = json_decode($response->getBody(), true);
        
        $recetas = $data['receta'];

        return view('recetas',compact('recetas'));
    }

    public function showHistorial()
    {
        $response = Http::post(env("APP_BACKEND") . 'historial');
        
        $data = json_decode($response->getBody(), true);
        $historial = $data['historial'];

        return view('historial', compact('historial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $response = Http::timeout(300)->connectTimeout(300)->post(env("APP_BACKEND") . 'preparar');
        
        return json_decode($response->getBody());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
