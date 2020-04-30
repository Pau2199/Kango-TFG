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
        $alquilados = User::select('property.*','address.tipo_de_via','address.localidad','address.provincia','address.nombre_de_la_direccion','address.codigo_postal','address.nPatio','rental.internet', 'rental.animales', 'rental.reformas', 'rental.calefaccion', 'rental.aireAcondicionado', 'rental.fianza')
            ->join('property', 'users.id', '=', 'property.idUsuario')
            ->join('address', 'property.id', '=', 'address.idInmueble')
            ->join('rental', 'property.id', '=', 'rental.idInmueble')
            ->where('property.idUsuario', Auth::user()->id)
            ->get();

        for($i = 0 ; $i<count($alquilados) ; $i++){
            $imagenes = DB::select('SELECT i.nombre FROM image i WHERE idInmueble = "'. $alquilados[$i]->id .'"');
            $alquilados[$i]->img = $imagenes;
        }

        $venta = User::select('property.*','address.tipo_de_via','address.localidad','address.provincia','address.nombre_de_la_direccion','address.codigo_postal','address.nPatio')
            ->join('property', 'users.id', '=', 'property.idUsuario')
            ->join('address', 'property.id', '=', 'address.idInmueble')
            ->join('sale', 'property.id', '=', 'sale.idInmueble')
            ->where('property.idUsuario', Auth::user()->id)
            ->get();

        for($i = 0 ; $i<count($venta) ; $i++){
            $imagenes = DB::select('SELECT i.nombre FROM image i WHERE idInmueble = "'. $venta[$i]->id .'"');
            $venta[$i]->img = $imagenes;
        }

        return view('anuncios')
            ->with('alquilados', $alquilados)
            ->with('venta', $venta);
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
            'nPatio' => 'required',
            'perfil' => 'required',
        ]);

        $inmueble = new Property;
        $inmueble->idUsuario = $request->usuario;
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
        $direccion->localidad = $request->localidad;
        $direccion->provincia = $request->provincia;
        $direccion->nombre_de_la_direccion = $request->nombreDir;
        $direccion->codigo_postal = $request->cp;
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
                    $valor->move('uploads', $img->id.'.'.$valor->getClientOriginalExtension());
                    $aux->nombre = $img->id.'.'.$valor->getClientOriginalExtension();
                    $aux->idInmueble = $inmueble->id;
                    $aux->save();
                }else{
                    $aux2 = new Image;
                    $valor->move('uploads', $aux->id.'.'.$valor->getClientOriginalExtension());
                    $aux2->nombre = $aux->id.'.'.$valor->getClientOriginalExtension();
                    $aux2->idInmueble = $inmueble->id;
                    $aux2->save();
                }
            }
        }





    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
