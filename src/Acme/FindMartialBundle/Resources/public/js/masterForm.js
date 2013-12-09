
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



    $(document).ready(function() {

      $('.switcher_button').on('click',function(){

          $('.switcher_block').stop(true,true);

          classList = $(this).attr('class');
          matches = classList.match(/block\d+/);

          $('.switcher_button').not('.switcher_button'+matches[0]).each(function(){$(this).removeClass('active');});
          $(this).addClass('active');

          $('.switcher_block').not('.switcher_block.active_block').hide(); 
          $('.switcher_block.active_block').not('.switcher_block.'+matches[0]).hide('drop', {}, 200, function(){
            $(this).removeClass('active_block');
            $('.switcher_block.'+matches[0]).show('drop', {direction: 'right'}, 200, function(){$(this).addClass('active_block');});
          }); 

          return false; 
      });


      $('form').on('click', '#addArt', function() {
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