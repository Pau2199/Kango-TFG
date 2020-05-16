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
                        if(data[i]['alquiler'] == true){
                            id="A"+data[i]['id'];
                        }else{
                            id="V"+data[i]['id'];
                        }
                        var divCard = $('<div>').attr({
                            class: 'card mt-3',
                            id: id
                        });
                        var divTitulo = $('<div>').attr('class', 'd-flex justify-content-between card-header');
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

                        var span = $('<span>').html(data[i]['nombre'] + ' ' + data[i]['primer_apellido'] + ' ' + data[i]['segundo_apellido']);
                        divTitulo.append(h5);
                        divTitulo.append(span);
                        divCard.append(divTitulo);

                        var divBody = $('<div>').attr('class', 'card-body');
                        var divRowPri = $('<div>').attr('class', 'row');
                        var divColimg = $('<div>').attr('class', 'col-xl-6 col-lg-12');
                        var img = $('<img>').attr({
                            src: "/uploads/"+data[i]['img'][0]['nombre'],
                            alt: "Imagen Perfil",
                            class: "img-fluid"
                        })
                        divColimg.append(img);
                        divRowPri.append(divColimg);

                        var divContenido = $('<div>').attr('class', 'col-xl-6');
                        var divRowContenido = $('<div>').attr('class', 'row mb-3');
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
                        var imgCorazón = $('<img>').attr({
                            src: "/img/corazonSinFondo.svg",
                            atl: 'Imagen Corazon',
                            class: 'iconos'
                        });
                        divDireccion.append(imgCorazón);
                        divRowContenido.append(divDireccion);
                        divContenido.append(divRowContenido);

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

                        var p = $('<p>').attr('class', 'card-text');
                        p.html(data[i]['descripcion']);
                        divContenido.append(p);



                        divRowPri.append(divContenido);
                        divBody.append(divRowPri);
                        divCard.append(divBody);

                        $('#anuncios').append(divCard);
                    }
                }
            }
        })
    }

})