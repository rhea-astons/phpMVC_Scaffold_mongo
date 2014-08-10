<h1>THIS IS 'ADD' TEMPLATE OF ITEMS</h1>
<form id="addItem" role="form" action="/Items/add">
  <div class="form-group">
    <label for="nameInput">Name</label>
    <input type="text" class="form-control" id="nameInput" name="name" placeholder="Enter name">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>

<div id="result"></div>

<script>
// Attach a submit handler to the form
$( "#addItem" ).submit(function( event ) {
  // Stop form from submitting normally
  event.preventDefault();

  // Get some values from elements on the page:
  var $form = $( this ),
    name = $form.find( "input[name='name']" ).val(),
    url = $form.attr( "action" );

  // Send the data using post
  var posting = $.post( url, { name: name } );

  // Put the results in a div
  posting.done(function( data ) {
    var content = $( data ).filter("#content");
    $( "#result" ).empty().append( content );
  });
});
</script>