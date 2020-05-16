$(function(){
    $('#eleccionTipoBusqueda').hide();
    $('#opcionesAlquiler').hide();
    $('#carga').hide();
    $('#sinDatos').hide();

    if(document.referrer){
        var url = document.referrer;
        url = url.split('8000/');
        console.log(url);
        if(url[1] == 'register'){
            console.log('entra')
            $('#login').trigger('click');
        }
    }


    $('.tipoBusqueda').click(function(){
        $('#opcionesAlquiler').hide();
        $('#eleccionTipoBusqueda').show();
        if('comprar' == $(this).val()){
            $('#elegidoEnTipoDeBusqueda').html('¿Quieres que la compra sea de Obra Nueva?')
        }else{
            $('#opcionesAlquiler').show();
            $('#elegidoEnTipoDeBusqueda').html('¿El alquiler es Vacacional?')
        }
    });

    $('#imagenFiltros').click(function(){
        if($('#panelFiltros').hasClass('d-none')){
            $('#panelFiltros').removeClass('d-none')
            $('#panelFiltros').fadeIn('slow');

        }else{
            $('#panelFiltros').fadeOut('slow');
            $('#panelFiltros').addClass('d-none')
        }
    })
    $('.btn-light').click(function(){
        if($('.botonPulsado') != null){
            $('.botonPulsado').removeClass('botonPulsado')
        }
        $(this).addClass('botonPulsado');
    })

    //cargar provincias
    $.ajax({
        url: '/index/cargarProvincia',
        method: 'GET',
        success: function(data){
            for (var i = 0 ; i<data.length ; i++){
                var option = $('<option>');
                option.attr({
                    value: data[i].provincia
                });
                option.html(data[i].provincia);
                $('#provincia').append(option);
            }
        }
    })

    $('#provincia').change(function(){
        if($(this).val() != '-'){
            var provincia = $(this).val();
            console.log(provincia)
            $.ajax({
                url: '/index/cargarLocalidades/'+provincia,
                method: 'GET',
                success: function(data){
                    $('#localidad option').remove();
                    var option = $('<option>').attr({
                        value: '-',
                        selected: true
                    });
                    option.html('-');
                    $('#localidad').append(option);
                    for(var i = 0 ; i<data.length ; i++){
                        option = $('<option>').attr('value', data[i].nombre);
                        option.html(data[i].nombre);
                        $('#localidad').append(option);
                    }
                }
            })
        }else{
            $('#localidad option').remove();

            var option = $('<option>').attr({
                value: '-',
                selected: true
            });
            option.html('-');
            $('#localidad').append(option);
        }
    })
    
    $('#anuncios').on('click', 'div.card', function(){
        id = $(this).attr('id');
        console.log(id);
        $(location).attr('href', '/inmuebles/vistaInmueble/'+id)
    });
    

    $('#filtroBusqueda').change(function(){
        peticionFiltros();
    });

    $('.botonesOrden').click(function(){
        peticionFiltros();
    })

    function peticionFiltros(){
        $('#sinDatos').hide();
        $('#anuncios').children().remove();
        $('#carga').show();
        var orden = "nada";
        if($('.botonPulsado').html() != null){
            if($('.botonPulsado').html() == 'Menor a Mayor'){
                orden = "ASC";
            }else{
                orden = "DESC"
            }
        }
        console.log($('.botonPulsado').html());
        var arrayTipoPiso = {P: 'Piso', D: 'Duplex', A: 'Adosado', C: 'Chalet'};
        var arrayDireccion = {C: 'Calle', A: 'Avenida', P: 'Plaza'}
        $.ajax({
            url: '/index/filtrosBusqueda/'+orden,
            method: 'POST',
            data: $('#filtroBusqueda').serialize(),
            success: function(data){
                console.log(data);
                $('#carga').hide();
                if(data.length == 0){
                    $('#sinDatos').show();
                }else{
                    for(var i = 0 ; i<data.length; i++){
                        var id ="";
                        //cogemos el di que es el usaremos para pasarlo a la vista del inmueble
                        if(data[i]['alquiler'] == true){
                            id="A-"+data[i]['id'];
                        }else{
                            id="V-"+data[i]['id'];
                        }
                        //creamos el div que engloba a toda la tarjeta
                        var divCard = $('<div>').attr({
                            class: 'card mt-3',
                            id: id
                        });
                        //creamos el titulo del div
                        var divTitulo = $('<div>').attr('class', 'd-flex justify-content-between card-header');
                        //Creamos la etiqueta h5  que es donde estara el titulo dle inmueble
                        var h5 = $('<h5>');
                        if(data[i]['alquiler'] == true){
                            h5.append('Alquiler de ')
                        }else{
                            h5.append('Venta de ');
                        }
                        h5.append(arrayTipoPiso[data[i]['tipo_de_vivienda']] + ' en ');
                        if(data[i]['provincia'] == data[i]['localidad']){
                            h5.append(data[i]['provincia']);
                        }else{
                            h5.append(data[i]['provincia']+', ' + data[i]['localidad'] + ' ');
                        }
                        h5.append('- Barrio de ' + data[i]['barrio'])
                        
                        //creamos el span que es donde estara el nombre del usuario
                        var span = $('<span>').html(data[i]['nombre'] + ' ' + data[i]['primer_apellido'] + ' ' + data[i]['segundo_apellido']);
                        //metemos el h5 y el span creados al contenedor de este apartado
                        divTitulo.append(h5);
                        divTitulo.append(span);
                        //el contenedor lo añadimos al contenedor principal
                        divCard.append(divTitulo);
                        
                        //creamos el div contedor dle grupo de la tarjeta
                        var divBody = $('<div>').attr('class', 'card-body');
                        
                        //creamos el row contenedor del cuerpo de la tarjeta
                        var divRowPri = $('<div>').attr('class', 'row');
                        
                        //creamos un col que ocupa la mitad del contenedor para poner la imagen
                        var divColimg = $('<div>').attr('class', 'col-xl-6 col-lg-12');
                        var img = $('<img>').attr({
                            src: "/uploads/"+data[i]['img'][0]['nombre'],
                            alt: "Imagen Perfil",
                            class: "img-fluid"
                        })
                        //agregamos la imagen al col y despues del row del cuerpo
                        divColimg.append(img);
                        divRowPri.append(divColimg);

                        //creamos el div que contendra el contenido del inmueble
                        var divContenido = $('<div>').attr('class', 'col-xl-6');
                        //creamos el row que contendra el contenido del inmueble
                        var divRowContenido = $('<div>').attr('class', 'row mb-3');
                        //agregamos la direccion y el icono y lo añadimos al row del contenido
                        var divImgUbi = $('<div>').attr('class', 'col-1');
                        var imgIconono = $('<img>').attr({
                            class: 'iconos',
                            alt: 'Imagen Ubi',
                            src:  "/img/ubicacion.svg"
                        })
                        divImgUbi.append(imgIconono);
                        divRowContenido.append(divImgUbi);

                        var divDireccion = $('<div>').attr('class', 'col-11 d-flex justify-content-between')

                        var span = $('<span>').html(
                            arrayDireccion[data[i]['tipo_de_via']] + ' ' +
                            data[i]['nombre_de_la_direccion'] + ' - ' +  data[i]['codigo_postal']
                        )
                        divDireccion.append(span);
                        //creamos el corazón para guardar el inmueble en favoritos
                        var imgCorazón = $('<img>').attr({
                            src: "/img/corazonSinFondo.svg",
                            atl: 'Imagen Corazon',
                            class: 'iconos'
                        });
                        divDireccion.append(imgCorazón);
                        divRowContenido.append(divDireccion);
                        divContenido.append(divRowContenido);
                        
                        //creamos el row de información del inmueble, este row tendra el precio , las habitaciones y si es alquiler la fianza.
                        var divRowInfo = $('<div>').attr('class', 'row');
                        var divPrecio = $('<div>').attr('class', 'col-4');
                        var precio = $('<h4>').attr('class', 'colorPrecio');
                        precio.html(data[i]['precio'] + ' €');
                        divPrecio.append(precio);
                        divRowInfo.append(divPrecio);

                        var divHabMetr = $('<div>').attr('class', 'col-4');
                        var spaHaMe = $('<span>').html(
                            data[i]['n_habitaciones'] + ' Hab. ' + data[i]['metros_cuadrados'] + ' m²');
                        divHabMetr.append(spaHaMe);
                        divRowInfo.append(divHabMetr);

                        if(data[i]['alquiler'] == true){
                            var divFianza = $('<div>').attr('class', 'col-4');
                            var spanFianza;
                            if (data[i]['datosAlq'] != null){
                                spanFianza = $('<span>').html('Fianza: ' + data[i]['datosAlq'][0]['fianza']);   
                            }else{
                                spanFianza = $('<span>').html('Fianza: ' + data[i]['fianza']); 
                            }
                            divFianza.append(spanFianza);
                            divRowInfo.append(divFianza);
                            divRowContenido.append(divRowInfo);
                        }
                        divContenido.append(divRowInfo);

                        //creamos el div que contendra todos los iconos de las caracteristicas del inmueble , este tendra tanto para alquiler como los normales
                        var divRowAnya = $('<div>').attr('class', 'row justify-content-center my-5');
                        if(data[i]['ascensor'] == true){
                            var divcolAscensor = $('<div>').attr('class', 'col-1')
                            var iascensor = $('<img>').attr({
                                src: '/img/ascensor.png',
                                alt: 'Ascensor',
                                class: 'iconos'
                            })
                            divcolAscensor.append(iascensor);
                            divRowAnya.append(divcolAscensor);
                        }
                        if(data[i]['garage'] == true){
                            var divcolgarage = $('<div>').attr('class', 'col-1')
                            var igarage = $('<img>').attr({
                                src: '/img/garage.svg',
                                alt: 'Garage',
                                class: 'iconos'
                            })
                            divcolgarage.append(igarage);
                            divRowAnya.append(divcolgarage);
                        }
                        if(data[i]['piscina'] == true){
                            var divcolpiscina = $('<div>').attr('class', 'col-1')
                            var ipiscina = $('<img>').attr({
                                src: '/img/piscina.svg',
                                alt: 'Piscina',
                                class: 'iconos'
                            })
                            divcolpiscina.append(ipiscina);
                            divRowAnya.append(divcolpiscina);
                        }

                        if(data[i]['alquiler'] == true){
                            if(data[i]['datosAlq'] != null){
                                if(data[i]['datosAlq'][0]['animales'] == true){
                                    var divcolanimales = $('<div>').attr('class', 'col-1')
                                    var ianimales = $('<img>').attr({
                                        src: '/img/animales.svg',
                                        alt: 'Animales',
                                        class: 'iconos'
                                    })
                                    divcolanimales.append(ianimales);
                                    divRowAnya.append(divcolanimales);
                                }
                                if(data[i]['datosAlq'][0]['calefaccion'] == true){
                                    var divcolcalefaccion = $('<div>').attr('class', 'col-1')
                                    var icalefaccion = $('<img>').attr({
                                        src: '/img/calefaccion.png',
                                        alt: 'Calefaccion',
                                        class: 'iconos'
                                    })
                                    divcolcalefaccion.append(icalefaccion);
                                    divRowAnya.append(divcolcalefaccion);
                                }
                                if(data[i]['datosAlq'][0]['aireAcondicionado'] == true){
                                    var divcolaireAcondicionado = $('<div>').attr('class', 'col-1')
                                    var iaireAcondicionado = $('<img>').attr({
                                        src: '/img/aireAcondicionado.svg',
                                        alt: 'Aire Acondicionado',
                                        class: 'iconos'
                                    })
                                    divcolaireAcondicionado.append(iaireAcondicionado);
                                    divRowAnya.append(divcolaireAcondicionado);
                                }
                                if(data[i]['datosAlq'][0]['internet'] == true){
                                    var divcolinternet = $('<div>').attr('class', 'col-1')
                                    var iinternet = $('<img>').attr({
                                        src: '/img/internet.svg',
                                        alt: 'Internet',
                                        class: 'iconos'
                                    })
                                    divcolinternet.append(iinternet);
                                    divRowAnya.append(divcolinternet);
                                }
                                if(data[i]['datosAlq'][0]['reformas'] == true){
                                    var divcolreformas = $('<div>').attr('class', 'col-1')
                                    var ireformas = $('<img>').attr({
                                        src: '/img/reformas.png',
                                        alt: 'Reformas',
                                        class: 'iconos'
                                    })
                                    divcolreformas.append(ireformas);
                                    divRowAnya.append(divcolreformas);
                                }
                            }else{
                                if(data[i]['animales'] == true){
                                    var divcolanimales = $('<div>').attr('class', 'col-1')
                                    var ianimales = $('<img>').attr({
                                        src: '/img/animales.svg',
                                        alt: 'Animales',
                                        class: 'iconos'
                                    })
                                    divcolanimales.append(ianimales);
                                    divRowAnya.append(divcolanimales);
                                }
                                if(data[i]['calefaccion'] == true){
                                    var divcolcalefaccion = $('<div>').attr('class', 'col-1')
                                    var icalefaccion = $('<img>').attr({
                                        src: '/img/calefaccion.png',
                                        alt: 'Calefaccion',
                                        class: 'iconos'
                                    })
                                    divcolcalefaccion.append(icalefaccion);
                                    divRowAnya.append(divcolcalefaccion);
                                }
                                if(data[i]['aireAcondicionado'] == true){
                                    var divcolaireAcondicionado = $('<div>').attr('class', 'col-1')
                                    var iaireAcondicionado = $('<img>').attr({
                                        src: '/img/aireAcondicionado.svg',
                                        alt: 'Aire Acondicionado',
                                        class: 'iconos'
                                    })
                                    divcolaireAcondicionado.append(iaireAcondicionado);
                                    divRowAnya.append(divcolaireAcondicionado);
                                }
                                if(data[i]['internet'] == true){
                                    var divcolinternet = $('<div>').attr('class', 'col-1')
                                    var iinternet = $('<img>').attr({
                                        src: '/img/internet.svg',
                                        alt: 'Internet',
                                        class: 'iconos'
                                    })
                                    divcolinternet.append(iinternet);
                                    divRowAnya.append(divcolinternet);
                                }
                                if(data[i]['reformas'] == true){
                                    var divcolreformas = $('<div>').attr('class', 'col-1')
                                    var ireformas = $('<img>').attr({
                                        src: '/img/reformas.png',
                                        alt: 'Reformas',
                                        class: 'iconos'
                                    })
                                    divcolreformas.append(ireformas);
                                    divRowAnya.append(divcolreformas);
                                }
                            }
                        }
                        divContenido.append(divRowAnya);
                         //agregamos la descripcion
                        var p = $('<p>').attr('class', 'card-text');
                        p.html(data[i]['descripcion']);
                        divContenido.append(p);

                        //agregamos al row principal el cuerpo de la tarjeta
                        divRowPri.append(divContenido);
                        //agregamos el row principal al body
                        divBody.append(divRowPri);
                        //agregamos todo al container general
                        divCard.append(divBody);
                        //lo agregamos al section de la página.
                        $('#anuncios').append(divCard);
                    }
                }
            }
        })
    }

})