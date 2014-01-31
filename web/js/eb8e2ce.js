
    // Get the ul that holds the collection of photos
    var collectionHolder = $('ul.photos');

    // setup an "add a photos" link
    var $addPhotoLink = $('<a href="#" class="add_photo_link">Add a photo</a>');
    var $newLinkLi = $('<li></li>').append($addPhotoLink);


    //добавление новой формы фотографии
    function addPhotoForm(collectionHolder, $newLinkLi) {
      // Get the data-prototype explained earlier
      var prototype = collectionHolder.data('prototype');

      // get the new index
      var index = collectionHolder.data('index');

      // Replace '__name__' in the prototype's HTML to
      // instead be a number based on how many items we have
      var newForm = prototype.replace(/__name__/g, index);

      // increase the index with one for the next item
      collectionHolder.data('index', index + 1);

      // Display the form in the page in an li, before the "Add a photo" link li
      var $newFormLi = $('<li></li>').append(newForm);
      $newLinkLi.before($newFormLi);
    }


    function showBlockForm(blockForm) {
          $('.switcher_block').stop(true,true);
          $('.switcher_button').not('.switcher_button.'+blockForm).each(function(){$(this).removeClass('active');});
          $('.switcher_button.'+blockForm).addClass('active');

          $('.switcher_block').not('.switcher_block.active_block').hide(); 
          $('.switcher_block.active_block').not('.switcher_block.'+blockForm).hide('drop', {}, 5000, function(){
            $(this).removeClass('active_block');
            $('.switcher_block.'+blockForm).show('drop', {direction: 'right'}, 5000, function(){ console.log('bshdb'); $(this).addClass('active_block');});
          }); 
    }


    $(document).ready(function() {

      $('.switcher_button').on('click',function(){
          classList = $(this).attr('class');
          matches = classList.match(/block\d+/);
          showBlockForm(matches[0]);
          return false; 
      });

      // блок с боевыми искуссвами
      // кнопка "Добавить искусство"
      $('#addMasterArt').on('click', function(){
        $(this).parents('form').submit();
        return false;
      });

      // редактировать в списке
      $('.masterArtListBlock').on('click', '.buttonEdit', function(){
        $('.masterArtListForm').hide();
        $('.masterArtListItem').show();
        masterArtListItem = $(this).parents('.masterArtListItem');
        masterArtListForm = masterArtListItem.next();
        masterArtListItem.hide();
        masterArtListForm.show();
        return false;
      });

      // Сохранить редактирование
      $('.masterArtListBlock').on('click', '.buttonSave', function(){
        //send request
        console.log('save');
        masterArtListForm = $(this).parents('.masterArtListForm');
        masterArtListItem = masterArtListForm.prev();
        masterArtListForm.hide();
        masterArtListItem.show();
        return false;
      });

      // Закрыть редактирование
      $('.masterArtListBlock').on('click', '.buttonClose', function(){
        masterArtListForm = $(this).parents('.masterArtListForm');
        masterArtListItem = masterArtListForm.prev();
        masterArtListForm.hide();
        masterArtListItem.show();
        return false;
      });

      // Удалить элемент
      $('.masterArtListBlock').on('click', '.buttondelete', function(){
        //send request
        console.log('delete');
        return false;
      });


      /*
      //photos
      // add the "add a photo" anchor and li to the photos ul
      collectionHolder.append($newLinkLi);

      // count the current form inputs we have (e.g. 2), use that as the new
      // index when inserting a new item (e.g. 2)
      collectionHolder.data('index', collectionHolder.find(':input').length);

      $addPhotoLink.on('click', function(e) {
          // prevent the link from creating a "#" on the URL
          e.preventDefault();

          // add a new photo form (see next code block)
          addPhotoForm(collectionHolder, $newLinkLi);
      });*/

    });