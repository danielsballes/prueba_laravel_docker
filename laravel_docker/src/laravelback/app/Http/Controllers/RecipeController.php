<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receta;
use App\Models\Ingrediente;
use App\Models\Cola;
use App\Models\Historia;
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
     * Encola los pedidos para su preparacion
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            //Pedir receta
            $encolados = 0;
            
            for ($i=0; $i < $request->cantidad; $i++) { 
                $receta = json_decode(Receta::inRandomOrder()->first(), true);
                
                $ingredientes = json_decode($receta['ingredientes'], true);

                $cola = new Cola();

                $cola->receta = $receta['nombre'];
                $cola->ingredientes = json_encode($ingredientes);
                $cola->activo = 1;

                $cola->save();

                $encolados++;

            }

            return [
                'status' => true,
                'encolados' => $encolados
            ];
        } catch (\Throwable $th) {
            return [
                'status' => false
            ];
        }
    }

    /**
     * Muestra la cola de preparación.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCola()
    {
        try {
            $cola = Cola::where('activo', 1)->get();
            
            return [
                'status' => true,
                'pedidos' => json_decode($cola, true)
            ];
        } catch (\Throwable $th) {
            return [
                'status' => false
            ];
        }
    }

    /**
     * Muestra la cola de preparación.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showIngredientes()
    {
        try {
            $ingredientes = Ingrediente::orderBy('id', 'desc')->first();
        
            return [
                'status' => true,
                'stock' => json_decode($ingredientes, true)
            ];
        } catch (\Throwable $th) {
            return [
                'status' => false
            ];
        }
    }

    /**
     * Muestra la cola de preparación.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showHistoric()
    {
        try {
            $historico = Cola::get();

            return [
                'status' => true,
                'historico' => json_decode($historico, true)
            ];
        } catch (\Throwable $th) {
            return [
                'status' => false
            ];
        }
    }

    
    /**
     * Muestra la cola de preparación.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showRecetas()
    {
        try {
            $receta = Receta::get();
            
            return [
                'status' => true,
                'receta' => json_decode($receta, true)
            ];
        } catch (\Throwable $th) {
            return [
                'status' => false
            ];
        }
    }

    public function showHistorial()
    {
        try {
            $historial = Historia::where('cantidad_vendida', '>', 0)->get();
            
            return [
                'status' => true,
                'historial' => json_decode($historial, true)
            ];
        } catch (\Throwable $th) {
            return [
                'status' => false
            ];
        }
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
        try {
            $encolados = 0;
            $preparados = 0;

            $pedidos = Cola::where('activo', 1)->orderBy('created_at', 'asc')->get();
            
            $stock = Ingrediente::orderBy('id', 'desc')->first();
            $arrayStock = json_decode($stock->json, true);

            foreach ($pedidos as $pedido) {
                $faltantes = false;
                $faltantesArray = [];

                $ingredientes = json_decode($pedido->ingredientes, true);
                
                foreach ($ingredientes as $nombre => $cantidad) {
                    if ($arrayStock[$nombre] >= $cantidad) {
                        $arrayStock[$nombre] -= $cantidad;
                    } else {
                        array_push($faltantesArray, $nombre);
                        $faltantes = true;
                    }
                }

                if (!$faltantes) {
                    $pedido->activo = 0;
                    $pedido->save();
                    
                    $preparados++;
                } else {
                    foreach ($faltantesArray as $faltante) {
                        $response = Http::connectTimeout(60)->get(env("MARKET_URL"), ['ingredient' => $faltante]);
                        $data = json_decode($response->getBody(), true);

                        $historial = new Historia();
                        $historial->ingrediente = $faltante;
                        $historial->cantidad_vendida = $data['quantitySold'];
                        $historial->save();

                        $arrayStock[$faltante] += $data['quantitySold'];
                    }

                    $encolados++;
                }
                
                $stockQuery = new Ingrediente();
                $stockQuery->json = json_encode($arrayStock);
                $stockQuery->save();
            }

            return [
                'status' => true,
                'encolados' => $encolados,
                'preparados' => $preparados
            ];
        } catch (\Throwable $th) {
            return [
                'status' => false
            ];
        }
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
