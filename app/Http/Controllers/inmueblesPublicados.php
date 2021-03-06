<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Imagen;
use Illuminate\Http\Request;
use App\Property;
use App\Image;
use App\Address;
use App\Rental;
use App\Sale;
use App\Favorite;
use App\Province;
use App\Location;
use Auth;
use App\User;
use DB;

class inmueblesPublicados extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        $id = explode('-', $id);
        $datos;

        if($id[0] == 'A'){            $datos=User::select('property.*','address.tipo_de_via','address.barrio','address.idLocalidad','address.idProvincia','address.nombre_de_la_direccion','address.codigo_postal','address.nPatio','address.nPuerta','address.nPiso','address.escalera','address.bloque','rental.internet', 'rental.animales', 'rental.reformas', 'rental.calefaccion', 'rental.aireAcondicionado', 'rental.fianza')
            ->join('property', 'users.id', '=', 'property.idUsuario')
            ->join('address', 'property.id', '=', 'address.idInmueble')
            ->join('rental', 'property.id', '=', 'rental.idInmueble')
            ->where('property.id', $id[1])->get();

                          for($i = 0 ; $i<count($datos) ; $i++){
                              $imagenes = DB::select('SELECT i.nombre FROM image i WHERE idInmueble = "'. $datos[$i]->id .'"');
                              $datos[$i]->img = $imagenes;
                              $datos[$i]->alquiler = true;
                              $datos[$i]->idProvincia = Province::select('nombre')->where('id', $datos[$i]->idProvincia)->get();
                              $datos[$i]->idLocalidad = Location::select('nombre')->where('id', $datos[$i]->idLocalidad)->get();
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
                                              $datos[$i]->favorito = false;
                                          }
                                      }
                                  }else{
                                      $datos[$i]->favorito = false;
                                  }
                              }
                          }
                         }else{
            $datos=User::select('property.*','address.tipo_de_via','address.barrio','address.idLocalidad','address.idProvincia','address.nombre_de_la_direccion','address.codigo_postal','address.nPatio','address.nPuerta','address.nPiso','address.escalera','address.bloque')
                ->join('property', 'users.id', '=', 'property.idUsuario')
                ->join('address', 'property.id', '=', 'address.idInmueble')
                ->join('sale', 'property.id', '=', 'sale.idInmueble')
                ->where('property.id', $id[1])
                ->get(); 
            for($i = 0 ; $i<count($datos) ; $i++){
                $imagenes = DB::select('SELECT i.nombre FROM image i WHERE idInmueble = "'. $datos[$i]->id .'"');
                $datos[$i]->img = $imagenes;
                $datos[$i]->alquiler = false;
                $datos[$i]->idProvincia = Province::select('nombre')->where('id', $datos[$i]->idProvincia)->get();
                $datos[$i]->idLocalidad = Location::select('nombre')->where('id', $datos[$i]->idLocalidad)->get();
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

    public function pagar(){
        return view('pago');
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
        if($request->perfil != null){
            $imagen = $request->file('perfil');
            $image_resize = Imagen::make($imagen->getRealPath()); 
            $image_resize->resize(1920 , 1080);
            $image_resize->save('uploads/perfil'.$numeroid[1].'.'.$imagen->getClientOriginalExtension());
        }

        if($request->masImagenes != null){
            $imagen = $request->file('masImagenes');
            $data = Image::latest('id')->first();
            $data = $data->id;
            foreach($imagen as $key =>$valor){
                $data = intval($data)+1;
                $input = 'imagen'.$key;
                $image_resize = Imagen::make($valor->getRealPath()); 
                $image_resize->resize(1920 , 1080);
                $image_resize->save('uploads/'.$data.'.'.$valor->getClientOriginalExtension());

                $img = new Image;
                $img->nombre = $data.'.'.$valor->getClientOriginalExtension();
                $img->idInmueble = $numeroid[1];
                $img->save();
            }
        }

        $idInm = $numeroid[1];
        $idAddress = DB::select('SELECT id FROM address WHERE idInmueble = "'. $idInm .'"');

        $address = Address::find($idAddress[0]->id);
        $address->tipo_de_via = $request->tipoVia;
        $id = Location::select('id')->where('nombre', $request->localidad)->get();
        $address->idLocalidad = $id[0]->id;
        $id = Province::select('id')->where('nombre', $request->provincia)->get();
        $address->idProvincia = $id[0]->id;
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

    public function actualizarEstado(Request $request){
        $inmueble = Property::find($request->idInmueble);
        $info;
        if(Auth::Check() && (Auth::User()->id == $inmueble->idUsuario || Auth::User()->rol == 'Admin')){
            if($inmueble->disponible == 1){
                $inmueble->disponible = 0;
                $info = "act";
            }else{
                $inmueble->disponible = 1;
                $info  = "desc";
            }
            $inmueble->save();
        }else{
            $info = "error";
        }

        return $info;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $imagen = Image::where('nombre', '=', $request->nombreImg)->first();
        unlink('uploads/'.$imagen->nombre);
        $imagen->delete();
        return $request;
    }
}
