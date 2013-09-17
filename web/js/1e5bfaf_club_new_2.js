        // Дождёмся загрузки API и готовности DOM.
        ymaps.ready(init);

        var myMap = null;
        var mrkCollection = null;
        var latField = null;
        var lngField = null;
        var addrsearch = null;
        var mapContainer = 'map';

        function init () {

            latField = $('#acme_findmartialbundle_clubtype_latitude');
            lngField = $('#acme_findmartialbundle_clubtype_longitude');
            addrsearch = $('#acme_findmartialbundle_clubtype_address');
            addrsearch.css({width:'60%'});

            clat = (latField.val() != '') ? latField.val() : 55.76; // Москва
            clng = (lngField.val() != '') ? lngField.val() : 37.64;

            myMap = new ymaps.Map(mapContainer, {
                center:[clat, clng], // Москва
                zoom:10
            });
            myMap.controls
                .add('typeSelector')
                .add('zoomControl')
                .add('mapTools');

            //устанавливаем маркер если клуб редактируется
            if(latField.val() !== '' && latField.val() !== ''){
                putMarkerOnMap(latField.val(), lngField.val(), addrsearch.val());
                myMap.setZoom(16);
            }
            
            myMap.container.fitToViewport()



            //autocomplete 
            addrsearch.autocomplete({ 
                source: function(request, response){
                                var yGeocoder = ymaps.geocode(addrsearch.val());
                                
                                yGeocoder.then(
                                    function(res){
                                        if (res.geoObjects.getLength()) {
                                            var point = res.geoObjects.get(0);
                                            var responseArray = [];
                                            res.geoObjects.each(function(el, i){
                                                responseArray.push({
                                                    label                       : el.properties.get('text'),
                                                    name                        : el.properties.get('name'),
                                                    value                       : el.properties.get('text'),
                                                    bounds                      : el.geometry.getBounds(),
                                                    viewport                    : el.geometry.getBounds(),
                                                    location                    : el.geometry.getCoordinates(),
                                                    address_components: el.properties.get('metaDataProperty')
                                                });
                                            });
                                            response(responseArray);
                                        }
                                    },
                                    // Обработка ошибки
                                    function (error) {
                                            alert("Возникла ошибка: " + error.message);
                                    }
                                );
                },
                select: function(event,ui){
                    lookupCallback(ui);
                }
            });

            // левой кнопкой мыши в любой точке карты.
            attachReverseGeocode();
        }


        function lookupCallback(result){
            // получение информации о расположении и инициализация переменных
            var point = result.item.location;

            putMarkerOnMap(point[0], point[1], result.item.name, result.item.name);

            if(result.item.bounds)
                myMap.setBounds(result.item.bounds, {checkZoomRange: true});
        }

        // При щелчке левой кнопкой мыши выводится
        function attachReverseGeocode() {
            myMap.events.add('click', function (e) {
                var coords = e.get('coordPosition');

                // Отправим запрос на геокодирование.
                var objects = ymaps.geoQuery(ymaps.geocode(coords))
                objects.then(function(){
                    // Переберём все найденные результаты и
                    // запишем имена найденный объектов в массив names.

                    var names = [];

                    if(objects.getLength() == 0){
                        res('нот фаунд');
                        return;
                    }

                    // Переберём все найденные результаты и
                    // запишем имена найденный объектов в массив names.
                    objects.each(function (obj) {
                        names.push(obj.properties.get('name'));
                    });
  
                    // получение информации о расположении и инициализация переменных
                    point = objects.get(0).geometry.getCoordinates();
                    
                    //поля координа
                    putFieldsValue(point[0].toPrecision(9), point[1].toPrecision(9));

                    putMarkerOnMap(point[0].toPrecision(9), point[1].toPrecision(9), names[0]);

                    //адресное поле
                    putToAdressField(names[0]);

                });

            });
        }

        //записывает координаты  в поля формы
        function putFieldsValue(lat, lng){
            latField.val(lat);
            lngField.val(lng);
        }

        //записывает координаты  в поля формы
        function putToAdressField(address){
            addrsearch.val(address);
        }

        function putMarkerOnMap(lat, lng, label, balloonContent){

            if(mrkCollection === null) mrkCollection = new ymaps.GeoObjectCollection();

            marker = new ymaps.GeoObject({
                // Описание геометрии.
                geometry: {
                    type: "Point",
                    coordinates: [lat, lng]
                },
                // Свойства.
                properties: {
                    // Контент метки.
                    iconContent: label,
                    balloonContent: balloonContent
                }
            }, {
                // Опции.
                // Иконка метки будет растягиваться под размер ее содержимого.
                preset: 'twirl#redStretchyIcon',
                // Метку можно перемещать.
                draggable: true
            });

            //привяжем событие по изменнению полей координат
            marker.events.add('drag', function (e) {
                var coords = e.get('target').geometry.getCoordinates();
                putFieldsValue(coords[0].toPrecision(9), coords[1].toPrecision(9));
            });
            
            //очистим карту
            mrkCollection.removeAll();

            //добавим метку
            mrkCollection.add(marker);
            myMap.geoObjects
                .add(mrkCollection)
            ;
        }


        