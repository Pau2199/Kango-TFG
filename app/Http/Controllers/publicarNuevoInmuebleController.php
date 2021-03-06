<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Imagen;
use Illuminate\Http\Request;
use App\Property;
use App\Image;
use App\Address;
use App\Rental;
use App\Province;
use App\Location;
use App\Sale;
use Auth;
use App\User;
use DB;


class publicarNuevoInmuebleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('formInmuebleNuevo');
    }

    public function mostrarInmuebles(){
        $alquilados = User::select('property.*','address.tipo_de_via','address.idProvincia','address.idLocalidad','address.nombre_de_la_direccion','address.codigo_postal','address.nPatio','rental.internet', 'rental.animales', 'rental.reformas', 'rental.calefaccion', 'rental.aireAcondicionado', 'rental.fianza')
            ->join('property', 'users.id', '=', 'property.idUsuario')
            ->join('address', 'property.id', '=', 'address.idInmueble')
            ->join('rental', 'property.id', '=', 'rental.idInmueble')
            ->where('property.idUsuario', Auth::user()->id)
            ->get();

        for($i = 0 ; $i<count($alquilados) ; $i++){
            $imagenes = DB::select('SELECT i.nombre FROM image i WHERE idInmueble = "'. $alquilados[$i]->id .'" && i.nombre LIKE "perfil%"');
            $alquilados[$i]->img = $imagenes;
            $alquilados[$i]->idProvincia = Province::select('nombre')->where('id', $alquilados[$i]->idProvincia)->get();
            $alquilados[$i]->idLocalidad = Location::select('nombre')->where('id', $alquilados[$i]->idLocalidad)->get();
        }

        $venta = User::select('property.*','address.tipo_de_via','address.idLocalidad','address.idProvincia','address.nombre_de_la_direccion','address.codigo_postal','address.nPatio')
            ->join('property', 'users.id', '=', 'property.idUsuario')
            ->join('address', 'property.id', '=', 'address.idInmueble')
            ->join('sale', 'property.id', '=', 'sale.idInmueble')
            ->where('property.idUsuario', Auth::user()->id)
            ->get();

        for($i = 0 ; $i<count($venta) ; $i++){
            $imagenes = DB::select('SELECT i.nombre FROM image i WHERE idInmueble = "'. $venta[$i]->id .'" && i.nombre LIKE "perfil%"');
            $venta[$i]->img = $imagenes;
            $venta[$i]->idProvincia = Province::select('nombre')->where('id', $venta[$i]->idProvincia)->get();
            $venta[$i]->idLocalidad = Location::select('nombre')->where('id', $venta[$i]->idLocalidad)->get();
        }

        return view('anuncios')
            ->with('alquilados', $alquilados)
            ->with('venta', $venta);
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
            'nMetrosCuadrados' => 'required',
            'precio' => 'required',
            'tipoInmueble' => 'required',
            'tipoCompra' => 'required',
            'nHabitaciones' => 'required',
            'nCuartosBanyo' => 'required',
            'cp' => 'required',
            'tipoVia' => 'required',
            'localidad' => 'required',
            'provincia' => 'required',
            'nombreDir' => 'required',
            'nPuerta' => 'required',
            //'nPatio' => 'required',
            'perfil' => 'required',
        ]);

        $inmueble = new Property;
        $inmueble->idUsuario = Auth::user()->id;
        $inmueble->metros_cuadrados = $request->nMetrosCuadrados;
        $inmueble->precio = $request->precio;
        $inmueble->tipo_de_vivienda = $request->tipoInmueble;
        $inmueble->descripcion = $request->descripcion;
        $inmueble->n_habitaciones = $request->nHabitaciones;
        $inmueble->n_cuartos_de_banyo = $request->nCuartosBanyo;
        $inmueble->precio = $request->precio;
        $inmueble->disponible = true;

        /*INICIO COMPROBAR EXTRAS*/
        //comprobar Ascensor
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
        /*FIN COMPROBAR EXTRAS*/

        $inmueble->save();

        //Si el inmueble se alquila
        if($request->tipoCompra == 'A' || $request->tipoCompra == 'AQ'){
            $alquiler = new Rental;

            $this->validate($request,[
                'fianza' => 'required',

            ]);


            $alquiler->fianza = $request->fianza;
            $alquiler->idInmueble = $inmueble->id;

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
        }else{
            $venta = new Sale;
            $venta->idInmueble = $inmueble->id;
            $venta->save();

        }
        //Agregamos ahora la direccion del inmueble;

        $direccion = new Address;
        $direccion->tipo_de_via = $request->tipoVia;
        $id = Location::select('id')->where('nombre', $request->localidad)->get();
        $direccion->idLocalidad = $id[0]->id;
        $id = Province::select('id')->where('nombre', $request->provincia)->get();
        $direccion->idProvincia = $id[0]->id;
        $direccion->nombre_de_la_direccion = $request->nombreDir;
        $direccion->codigo_postal = $request->cp;
        $direccion->barrio = $request->barrio;
        $direccion->nPuerta = $request->nPuerta;
        $direccion->nPatio = $request->nPatio;
        $direccion->nPiso = $request->nPiso;

        //Comprobar si hay escalera
        if($request->escalera != null){
            $direccion->escalera = $request->escalera;
        }

        //comprobar si hay bloque
        if($request->bloque != null){
            $direccion->bloque = $request->bloque;
        }

        $direccion->idInmueble = $inmueble->id;
        $direccion->save();

        //Agregamos a la base de datos las imagenes y las guardamos en una carpeta
        $imagen = $request->file('perfil');
        $image_resize = Imagen::make($imagen->getRealPath()); 
        $image_resize->resize(1920 , 1080);
        $image_resize->save('uploads/perfil'.$inmueble->id.'.'.$imagen->getClientOriginalExtension());


        //        $imagen = imagescale($imagen, 1440);
        //        $imagen->move('uploads', 'perfil'.$inmueble->id.'.'.$imagen->getClientOriginalExtension());

        $img = new Image;
        $img->nombre = 'perfil'.$inmueble->id.'.'.$imagen->getClientOriginalExtension();
        $img->idInmueble = $inmueble->id;

        $img->save();

        if($request->masImagenes != null){
            $imagen = $request->file('masImagenes');
            foreach($imagen as $key => $valor){
                if($key == 0){
                    $aux = new Image;
                    $image_resize =  Imagen::make($valor->getRealPath());
                    $image_resize->resize(1920 , 1080);
                    $image_resize->save('uploads/'.$img->id.'.'.$valor->getClientOriginalExtension());
                    $aux->nombre = $img->id.'.'.$valor->getClientOriginalExtension();
                    $aux->idInmueble = $inmueble->id;
                    $aux->save();
                }else if($key == 1){
                    $aux2 = new Image;
                    $image_resize =  Imagen::make($valor->getRealPath());
                    $image_resize->resize(1920 , 1080);
                    $image_resize->save('uploads/'.$aux->id.'.'.$valor->getClientOriginalExtension());
                    $aux2->nombre = $aux->id.'.'.$valor->getClientOriginalExtension();
                    $aux2->idInmueble = $inmueble->id;
                    $aux2->save();
                }else{
                    $aux3 = new Image;
                    $image_resize =  Imagen::make($valor->getRealPath());
                    $image_resize->resize(1920 , 1080);
                    $image_resize->save('uploads/'.$aux2->id.'.'.$valor->getClientOriginalExtension());
                    $aux3->nombre = $aux2->id.'.'.$valor->getClientOriginalExtension();
                    $aux3->idInmueble = $inmueble->id;
                    $aux3->save();
                }
            }
        }


        return redirect('inmuebles/anunciosActivos');


    }

    public function cargarProvincias(){

        return Province::select('nombre')->get();
    }

    public function cargarLocalidades($selecionada){
        $id = Province::select('id')->where('nombre', $selecionada)->get();
        $localidades = Location::select('nombre')->where('idProvincia', $id[0]->id)->get();
        return $localidades;
    }
}
