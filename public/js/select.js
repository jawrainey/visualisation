//Enables the content from the left multiple option box to be moved into the right ~ user friendly.
$().ready(function() {
    $('.add').click(function() {  
      return !$('#toSelect option:selected').remove().appendTo('#selectedAtts');  
    });  
    $('.remove').click(function() {  
      return !$('#selectedAtts option:selected').remove().appendTo('#toSelect');  
    });
});