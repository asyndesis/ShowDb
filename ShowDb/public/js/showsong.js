$('#deletebtn').on('click', function() {
    bootbox.confirm('Are you sure you wanted to delete this song?', function(result) {
	if(result) {
	    $('#deleteform').submit();
	}
    });
});

$('.notedeletebutton').on('click', function() {
    $('#deletenoteform').attr('action', $('#deletenoteform').attr('action') + $(this).attr('data-note-id'));
    $('#deletenoteform').submit();
    $('.notedeletebutton').attr('disabled', true);
});

datbutton = false;

$(document).ready(function() {
    $('#noteaddbutton').click(function() {
	$('#notetable tbody').append('<tr><td><textarea name="notes[]" value="" class="form-control" type="text" placeholder="Note"></textarea></td></tr>');

	$("textarea").trumbowyg({
	    btns: [['bold', 'italic'], ['link'], ['insertImage']]
	});

	if(!datbutton) {
	    $('#notetable').append( '<button id="addbutton" type="submit" class="btn btn-primary">Add Notes</button>');
	    datbutton = true;
	}

    });
});
