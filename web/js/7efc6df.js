        // Дождёмся загрузки API и готовности DOM.
        ymaps.ready(init);

        var myMap;

        function init () {
            // Создание экземпляра карты и его привязка к контейнеру с
            // заданным id ("map").
            myMap = new ymaps.Map('map', {
                // При инициализации карты обязательно нужно указать
                // её центр и коэффициент масштабирования.
                center:[55.76, 37.64], // Москва
                zoom:10
            });

            // левой кнопкой мыши в любой точке карты.
            myMap.events.add('click', function (e) {
                if (myMap.balloon.isOpen())
                    myMap.balloon.close();

                var coords = e.get('coordPosition');

                $('#acme_findmartialbundle_clubtype_latitude').val(coords[0].toPrecision(9));
                $('#acme_findmartialbundle_clubtype_longitude').val(coords[1].toPrecision(9));

                myMap.balloon.open(coords, {
                    contentHeader:'Новый клуб',
                    contentBody:'<p>Вы указали координаты клуба.</p>' +
                        '<p>Координаты: ' + [
                        coords[0].toPrecision(6),
                        coords[1].toPrecision(6)
                        ].join(', ') + '</p>',
                    contentFooter:'<sup>Щелкните еще раз</sup>'
                });

            });

        }

        function geocode(val){
            ymaps.geocode(val, { results: 1 }).then(function (res) {

                // Выбираем первый результат геокодирования.
                var firstGeoObject = res.geoObjects.get(0);
                coords = firstGeoObject.geometry.getCoordinates();

                $('#acme_findmartialbundle_clubtype_latitude').val(coords[0].toPrecision(9));
                $('#acme_findmartialbundle_clubtype_longitude').val(coords[1].toPrecision(9));

                if (myMap.balloon.isOpen())
                    myMap.balloon.close();

                myMap.balloon.open(coords, {
                    contentHeader:'Новый клуб',
                    contentBody:'<p>Вы указали координаты клуба.</p>' +
                        '<p>Координаты: ' + [
                        coords[0].toPrecision(6),
                        coords[1].toPrecision(6)
                        ].join(', ') + '</p>',
                    contentFooter:'<sup>Щелкните еще раз</sup>'
                });


                // центр
                myMap.setCenter(coords);
                myMap.container.fitToViewport();

                // Задаем изображение для иконок меток. Добавляем полученную коллекцию на карту.
                //res.geoObjects.options.set('preset', 'twirl#metroMoscowIcon');
               // myMap.geoObjects.add(res.geoObjects)

            }, function (err) {
                // Если геокодирование не удалось, сообщаем об ошибке.
                alert(err.message);
            });
        }

        // При щелчке левой кнопкой мыши выводится
        // информация о месте, на котором щёлкнули.
        /*

        function attachReverseGeocode(myMap) {
            myMap.events.add('click', function (e) {
                var coords = e.get('coordPosition');

                // Отправим запрос на геокодирование.
                ymaps.geocode(coords).then(function (res) {
                    var names = [];
                    // Переберём все найденные результаты и
                    // запишем имена найденный объектов в массив names.
                    res.geoObjects.each(function (obj) {
                        names.push(obj.properties.get('name'));
                    });
                    // Добавим на карту метку в точку, по координатам
                    // которой запрашивали обратное геокодирование.
                    myMap.geoObjects.add(new ymaps.Placemark(coords, {
                        // В качестве контента иконки выведем
                        // первый найденный объект.
                        iconContent:names[0],
                        // А в качестве контента балуна - подробности:
                        // имена всех остальных найденных объектов.
                        balloonContent:names.reverse().join(', ')
                    }, {
                        preset:'twirl#redStretchyIcon',
                        balloonMaxWidth:'250'
                    }));
                });
            });
        }

        */


        $(document).ready(function(){ 
            $('#mapsearch').on('click', function(){geocode($(this).prev().val());});

        });