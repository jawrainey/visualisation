//Enables the content from the left multiple option box to be moved into the right ~ user friendly.
$().ready(function() {
    $('.add').click(function() {  
      return !$('#left option:selected').remove().appendTo('#right');  
    });  
    $('.remove').click(function() {  
      return !$('#right option:selected').remove().appendTo('#left');  
    });  
});