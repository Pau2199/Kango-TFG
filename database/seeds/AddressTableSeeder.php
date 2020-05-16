<?php

use Illuminate\Database\Seeder;

class AddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $tipo_de_via = array('C', 'A', 'P');
        $escalera = array('izquierda', 'derecha');
        $bloque = array('A', 'B','C','D','E','F','G','H','I','J','K');
        $direcciones = array('Alcalá', 'Larios', 'Rua Do Franco', 'Paseo de Gracia', 'De los Ciegos','Avenida de la Constitución','Gran Vía','Betis','Calleja de las Flores', 'Paseo de los Tristes','Ancha','Concepción', 'Tinte', 'Feria', 'Gaona', 'Tejares', 'Zapateros', 'Monjas','Ferran','Provenza', 'Princesa', 'Esperanza', 'París', 'Huelva', 'Mallorca', 'Menorca', 'Muntaner', 'Ronda de la Universidad', 'Via Julia', 'Paseo del Río de la Miel', 'Alta', 'Andalucía', 'Colón', 'Caldería', 'Compás de la Compañia', 'Continua del Muelle', 'Nueva', 'Granada', 'Paseo de Reding', 'Camas', 'Cister', 'Caldería', 'Héroe Sosoa', 'Fresca', 'Ollerias', 'Beatas', 'Alcazabilla', 'De la Paz', 'Na Jordana', 'Serranos', 'Blasco Ibañez','Alameda de Valencia', 'Estafeta', 'Paseo de Saraste', 'Autonomía', 'Ercilla', 'Elcano', 'Navarra', 'Licendiado Poza', 'Doctor Areilza','Carniceria Vieja', 'Colon de Larreátegui', 'Buenos Aires', 'Henao','Somera', 'Sendeja', 'Arbolantxa');
        $barrio = array('Campollano', 'El Pilar', 'Fátima', 'Imaginalia', 'Parque Sur', 'Feria', 'Agua Sol', 'Imaginalia', 'Miralcampo', 'Franciscanos', 'Ensache', 'Congo', 'Casas Viejas', 'Casas Baratas','Aldea Moret', 'La Madrila', 'Casceres el Viejo', 'Lerida', 'León', 'Reina Victoria', 'Oviedo', 'Allende el Río', 'Pna y Guindas', 'Bellulla', 'El casar', 'Juan de la Cierva', 'Getafe del Norte', 'El Bercial', 'Las Margatiras', 'Parla','El Bajondillo', 'El Calvario', 'Montemar', 'San juan', 'Cotar', 'San Julián', 'San Pedro', 'Vilimar','Benicalap', 'Beniferri', 'Borboto', 'Cami de Vera', 'Camí Real', 'Carpesa', 'Campanar', 'Horno de Alcedor', 'Gran Vía', 'Favara', 'En Corts', 'Exposición', 'Marchalenes', 'Ayora', 'Nazaret', 'Pueblo Nuevo', 'Patraix', 'Nuevo Patraix', 'San Isidro', 'Safranar', 'San Marcelino', 'Cruz Cubierta', 'Jesús');
        //        $localidades = [
        //            "Alicante" => ['Angres', 'Alicante', 'Benidorm', 'Calpe', 'Callosa de Segura'],
        //            "Albacete" => ['Alcala del Jucar', 'Nerpio', 'Peñosca', 'Albacete', 'Munera'],
        //            "Almeria" => ['Mojacar', 'Chercos', 'Albanix','Almeria','Chercos'],
        //            "Asturias" => ['Navia', 'Noreña', 'Covera','Corvera', 'Asturias'],
        //            "Avila" => ['Arevalo','Cisla', 'Blancha', 'El Tiemblo', 'Avila'],
        //            "Barcelona" => ['Barcelona', 'Cornella del Llobregat', 'Hopitalet del Llobregat', 'Manilleu', 'Sitges'],
        //            "Burgos" => ['Burgos','Neila', 'Mena', 'Medina', 'Lerma'],
        //            "Caceres" => ['Caceres','Alia', 'Barrado', 'Alia','Jadrillo'],
        //            "Cadiz" => ['Cadiz','Medina Didonia', 'Paterna Rivera', 'Los Barrios','Rota'],
        //            "Castellon" => ['Castellon','Jérica', 'Sot','Gerona', 'Torrechiva'],
        //            "Gerona" => ['Gerona', 'Alp', 'Amer', 'Juya', 'Gorguja'],
        //            "Granada" => ['Granada','Huenajaa', 'Lucar', 'Marchal', 'Trevelez'],
        //            "Huelva" => ['Huelva', 'Cartanya','Aroche','Beas','Alonso'],
        //            "Jaen" =>['Jaen', 'Lepe','Cartanya','Puerto Moral','Aroche'],
        //            "Lugo" =>['Lugo', 'Jamilea','Quesada','Cambil','Mancha Real'],
        //            "Leon" =>['Leon', 'Alhadefe','Ardon','Fabero','Sabero'],
        //            "La Coruña" =>['La Coruña', 'Ames','Capela','Lousame','Toques'],
        //            "Madrid" =>['Madrid', 'Alcala de Henares','Alcorcon','Batres','Loeches'],
        //            "Malaga" =>['Malaga','Alcuacion','Casares','Guacin','Torrox'],
        //            "Navarra" =>['Navarra', 'Garralada','Gesa','Atex','Odieta'],
        //            "Palencia" =>['Palencia', 'Alar rey','Loma de Ucieza','Saldaña','Mantinos'],
        //            "Pontevedra" =>['Pontevedra', 'Golada','Oya','Vilaboa','Poyo'],
        //            "Soria" =>['Soria', 'Peñas','Garray','Gomara','Reznos'],
        //            "Sevilla" =>['Sevilla', 'Alanis','Estepa','Guillena','Paradas'],
        //            "Teruel" =>['Teruel', 'Alcañiz','Rillo','Sarrion','Tormon'],
        //            "Toledo" =>['Toledo', 'Camuñas','Villacañas','Parrillas','Polan'],
        //            "Valencia" =>['Valencia', 'Ademuz','Paterna','Manises','Sedaví'],
        //            "Zaragoza" =>['Zaragoza', 'Badules','Barboles','Mara','Moneva']
        //        ];
        $select;
        function codigoPostal(){
            return mt_rand(30000, 50000);
        }
        function nPuerta(){
            return mt_rand(1, 150);
        }

        function nPatio(){
            return mt_rand(1,200);
        }
        function nPiso(){
            return mt_rand(1,30);
        }
        /*        function provincia(){
            $select = $provincias[mt_rand(0,27)];
            return $select;
        }
        $provincias = ['Alicante', 'Albacete', 'Almeria', 'Asturias', 'Avila', 'Barcelona', 'Burgos', 'Caceres','Cadiz', 'Castellon', 'Gerona','Granada','Huelva','Jaen','Lugo', 'Leon','La Coruña', 'Madrid', 'Malaga', 'Navarra','Palencia','Pontevedra','Soria','Sevilla','Teruel','Toledo','Valencia','Zaragoza'];*/
        DB::table('address')->insert([
            [
                'tipo_de_via' => $tipo_de_via[mt_rand(0,2)],
                'provincia' => 'Madrid',
                'localidad' => 'Alcala de Henares',
                'nombre_de_la_direccion' => $direcciones[mt_rand(0,65)],
                'codigo_postal' => codigoPostal(),
                'nPuerta' => nPuerta(),
                'nPatio' => nPatio(),
                'nPiso' => nPiso(),
                'barrio' => $barrio[mt_rand(0,46)],
                'escalera' => $escalera[mt_rand(0,1)],
                'bloque' => $bloque[mt_rand(0,10)],
                'idInmueble' => 1

            ],
            [
                'tipo_de_via' => $tipo_de_via[mt_rand(0,2)],
                'provincia' => 'Valencia',
                'localidad' => 'Ademuz',
                'nombre_de_la_direccion' => $direcciones[mt_rand(0,65)],
                'codigo_postal' => codigoPostal(),
                'nPuerta' => nPuerta(),
                'nPatio' => nPatio(),
                'nPiso' => nPiso(),
                'barrio' => $barrio[mt_rand(0,46)],
                'escalera' =>null,
                'bloque' => null,
                'idInmueble' => 2
            ],
            [
                'tipo_de_via' => $tipo_de_via[mt_rand(0,2)],
                'provincia' => 'Alicante',
                'localidad' => 'Alicante',
                'nombre_de_la_direccion' => $direcciones[mt_rand(0,65)],
                'codigo_postal' => codigoPostal(),
                'nPuerta' => nPuerta(),
                'nPatio' => nPatio(),
                'nPiso' => nPiso(),
                'barrio' => $barrio[mt_rand(0,46)],
                'bloque' => null,
                'escalera' => $escalera[mt_rand(0,1)],
                'idInmueble' => 3
            ],
            [
                'tipo_de_via' => $tipo_de_via[mt_rand(0,2)],
                'provincia' => 'Albacete',
                'localidad' => 'Almansa',
                'nombre_de_la_direccion' => $direcciones[mt_rand(0,65)],
                'codigo_postal' => codigoPostal(),
                'nPuerta' => nPuerta(),
                'nPatio' => null,
                'nPiso' => null,
                'barrio' => null,
                'bloque' => null,
                'escalera' => null,
                'idInmueble' => 4
            ],
            [
                'tipo_de_via' => $tipo_de_via[mt_rand(0,2)],
                'provincia' => 'Malaga',
                'localidad' => 'Malaga',
                'nombre_de_la_direccion' => $direcciones[mt_rand(0,65)],
                'codigo_postal' => codigoPostal(),
                'nPuerta' => nPuerta(),
                'nPatio' => nPatio(),
                'nPiso' => nPiso(),
                'barrio' => $barrio[mt_rand(0,46)],
                'escalera' => null,
                'bloque' => $bloque[mt_rand(0,10)],
                'idInmueble' => 5
            ],
            [
                'tipo_de_via' => $tipo_de_via[mt_rand(0,2)],
                'provincia' => 'Valencia',
                'localidad' => 'Mislata',
                'nombre_de_la_direccion' => $direcciones[mt_rand(0,65)],
                'codigo_postal' => codigoPostal(),
                'nPuerta' => nPuerta(),
                'nPatio' => nPatio(),
                'nPiso' => nPiso(),
                'escalera' => null,
                'barrio' => $barrio[mt_rand(0,46)],
                'bloque' => $bloque[mt_rand(0,10)],
                'idInmueble' => 6
            ],
            [
                'tipo_de_via' => $tipo_de_via[mt_rand(0,2)],
                'provincia' => 'Zaragoza',
                'localidad' => 'Badules',
                'nombre_de_la_direccion' => $direcciones[mt_rand(0,65)],
                'codigo_postal' => codigoPostal(),
                'nPuerta' => nPuerta(),
                'nPatio' => nPatio(),
                'nPiso' => nPiso(),
                'barrio' => $barrio[mt_rand(0,46)],
                'bloque' => null,
                'escalera' => null,
                'idInmueble' => 7
            ],
            [
                'tipo_de_via' => $tipo_de_via[mt_rand(0,2)],
                'provincia' => 'Soria',
                'localidad' => 'Adradas',
                'nombre_de_la_direccion' => $direcciones[mt_rand(0,65)],
                'codigo_postal' => codigoPostal(),
                'nPuerta' => nPuerta(),
                'nPatio' => nPatio(),
                'nPiso' => nPiso(),
                'barrio' => $barrio[mt_rand(0,46)],
                'bloque' => null,
                'escalera' => null,
                'idInmueble' => 8
            ],
            [
                'tipo_de_via' => $tipo_de_via[mt_rand(0,2)],
                'provincia' => 'Jaen',
                'localidad' => 'Linares',
                'nombre_de_la_direccion' => $direcciones[mt_rand(0,65)],
                'codigo_postal' => codigoPostal(),
                'nPuerta' => nPuerta(),
                'nPatio' => nPatio(),
                'nPiso' => nPiso(),
                'barrio' => $barrio[mt_rand(0,46)],
                'bloque' => null,
                'escalera' => null,
                'idInmueble' => 9
            ],
            [
                'tipo_de_via' => $tipo_de_via[mt_rand(0,2)],
                'provincia' => 'Avila',
                'localidad' => 'Navarrevisca',
                'nombre_de_la_direccion' => $direcciones[mt_rand(0,65)],
                'codigo_postal' => codigoPostal(),
                'nPuerta' => nPuerta(),
                'nPatio' => nPatio(),
                'nPiso' => nPiso(),
                'barrio' => $barrio[mt_rand(0,46)],
                'bloque' => null,
                'escalera' => null,
                'idInmueble' => 10
            ],
        ]);
    }
}
