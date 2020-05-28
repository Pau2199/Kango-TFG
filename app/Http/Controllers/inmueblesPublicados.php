<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Property;
use App\Image;
use App\Address;
use App\Rental;
use App\Sale;
use App\Favorite;
use Auth;
use App\User;
use DB;

class inmueblesPublicados extends Controller
{

    //    public function updateImagenes(Request $request){
    //        $inmueble = Property::find(3);
    //        $inmueble->descripcion = $requests->perfil;
    //        $inmueble->save();
    //    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        $id = explode('-', $id);
        $datos;

        if($id[0] == 'A'){            $datos=User::select('property.*','address.tipo_de_via','address.barrio','address.localidad','address.provincia','address.nombre_de_la_direccion','address.codigo_postal','address.nPatio','address.nPuerta','address.nPiso','address.escalera','address.bloque','rental.internet', 'rental.animales', 'rental.reformas', 'rental.calefaccion', 'rental.aireAcondicionado', 'rental.fianza')
            ->join('property', 'users.id', '=', 'property.idUsuario')
            ->join('address', 'property.id', '=', 'address.idInmueble')
            ->join('rental', 'property.id', '=', 'rental.idInmueble')
            ->where('property.id', $id[1])->get();

                          for($i = 0 ; $i<count($datos) ; $i++){
                              $imagenes = DB::select('SELECT i.nombre FROM image i WHERE idInmueble = "'. $datos[$i]->id .'"');
                              $datos[$i]->img = $imagenes;
                              $datos[$i]->alquiler = true;
                              if(Auth::check()){
                                  $favorito = Favorite::where('idUser', '=', Auth::User()->id)->where('idInmueble', '=', $datos[$i]->id)->get();
                                  if(count($favorito) > 0){
                                      $datos[$i]->favorito = true;
                                  }else{
                                      $datos[$i]->favorito = false;
                                  }
                              }else{
                                  if(isset($_COOKIE['favoritos'])){
                                      $array = explode(',', $_COOKIE['favoritos']);
                                      for($j = 0; $j<count($array); $j++ ){
                                          $id = explode('-', $array[$j]);
                                          if($id[1] == $datos[$i]->id){
                                              $datos[$i]->favorito = true;
                                              break;
                                          }else{
                                              $datos[$i]->favorito = true;
                                          }
                                      }
                                  }else{
                                      $datos[$i]->favorito = false;
                                  }
                              }
                          }
            }else{
            $datos=User::select('property.*','address.tipo_de_via','address.barrio','address.localidad','address.provincia','address.nombre_de_la_direccion','address.codigo_postal','address.nPatio','address.nPuerta','address.nPiso','address.escalera','address.bloque')
                ->join('property', 'users.id', '=', 'property.idUsuario')
                ->join('address', 'property.id', '=', 'address.idInmueble')
                ->join('sale', 'property.id', '=', 'sale.idInmueble')
                ->where('property.id', $id[1])
                ->get(); 
            for($i = 0 ; $i<count($datos) ; $i++){
                $imagenes = DB::select('SELECT i.nombre FROM image i WHERE idInmueble = "'. $datos[$i]->id .'"');
                $datos[$i]->img = $imagenes;
                $datos[$i]->alquiler = false;
                if(Auth::check()){
                    $favorito = Favorite::where('idUser', '=', Auth::User()->id)->where('idInmueble', '=', $datos[$i]->id)->get();
                    if(count($favorito) > 0){
                        $datos[$i]->favorite = true;
                    }else{
                        $datos[$i]->favorite = false;
                    }
                }else{
                    if(isset($_COOKIE['favoritos'])){
                        $array = explode(',', $_COOKIE['favoritos']);
                        for($j = 0; $j<count($array); $j++ ){
                            $id = explode('-', $array[$j]);
                            if($id[1] == $datos[$i]->id){
                                $datos[$i]->favorito = true;
                                break;
                            }else{
                                $datos[$i]->favorito = false;
                            }
                        }
                    }else{
                        $datos[$i]->favorito = false;
                    }
                }
            }
        }



        return view('vistaInmueble')->with('datos', $datos);
    }

    public function borrarImagen ($imagen){
        //        DB::table('image')->where('nombre', '=', $imagen)->delete();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        $numeroid = explode('-', $id);

        $inmueble = Property::find($numeroid[1]);
        $inmueble->metros_cuadrados = $request->nMetrosCuadrados;
        $inmueble->precio = $request->precio;
        $inmueble->tipo_de_vivienda = $request->tipoInmueble;
        $inmueble->descripcion = $request->descripcion;
        $inmueble->n_habitaciones = $request->nHabitaciones;
        $inmueble->n_cuartos_de_banyo = $request->nCuartosBanyo;

        if($request->ascensor != null){
            $inmueble->ascensor = true;
        }else{
            $inmueble->ascensor = false;
        }

        //comrpobar Garage
        if($request->garage != null){
            $inmueble->garage = true;
        }else{
            $inmueble->garage = false;
        }

        //comprobar Piscina
        if($request->piscina != null){
            $inmueble->piscina = true;
        }else{
            $inmueble->piscina = false;
        }
        $inmueble->save();
        $idInm = $numeroid[1];
        $idAddress = DB::select('SELECT id FROM address WHERE idInmueble = "'. $idInm .'"');

        $address = Address::find($idAddress[0]->id);
        $address->tipo_de_via = $request->tipoVia;
        $address->localidad = $request->localidad;
        $address->provincia = $request->provincia;
        $address->nombre_de_la_direccion = $request->nombreDir;
        $address->codigo_postal = $request->cp;
        $address->nPuerta = $request->nPuerta;
        $address->nPatio = $request->nPatio;
        $address->nPiso = $request->nPiso;
        $address->barrio = $request->barrio;

        if($request->escalera != null){
            $address->escalera = $request->escalera;
        }else{
            $address->escalera = null;
        }
        $address->save();
        if($request->bloque != null){
            $address->bloque = $request->escalera;
        }else{
            $address->bloque = null;
        }

        if($numeroid[0] == 'A'){
            $idAlquiler = DB::select('SELECT id FROM rental WHERE idInmueble = "'. $idInm .'"');
            $alquiler = Rental::find($idAlquiler[0]->id);

            $alquiler->fianza = $request->fianza;
            /*INICIO COMPROBAR EXTRAS ALQUILER*/

            //comprobar animales
            if($request->animales != null){
                $alquiler->animales = true;
            }else{
                $alquiler->animales = false;
            }

            //comprobar reformas
            if($request->reformas != null){
                $alquiler->reformas = true;
            }else{
                $alquiler->reformas = false;
            }

            //comprobar internet
            if($request->internet != null){
                $alquiler->internet = true;
            }else{
                $alquiler->internet = false;
            }

            //comprobar calefaccion
            if($request->calefaccion != null){
                $alquiler->calefaccion = true;
            }else{
                $alquiler->calefaccion = false;
            }

            //comprobar aire acondicionado
            if($request->aire != null){
                $alquiler->aireAcondicionado = true;
            }else{
                $alquiler->aireAcondicionado = false;
            }
            /*FIN COMPROBAR EXTRAS ALQUILER*/
            $alquiler->save();

        }

    }

    public function updateImage(Request $request, $id){
        return $_POST['masImagenes'];
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
