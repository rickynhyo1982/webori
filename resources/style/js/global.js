$(function() 
{	
	// Fade out status messages, but ensure error messages stay visable.
	if ($('.status_msg').length > 0)
	{
		$('#message').delay(4000).fadeTo(1000,0.01).slideUp(500);
	}

});