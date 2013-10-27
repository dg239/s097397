$(document).ready(function(){
	$('#button1').click(function() {
		console.log('Hello slackfuck.');
		$(this).attr('disabled',true);

		$.ajax('https://api.github.com/gists',{
			type:'POST',
			dataType: 'json',
			data:JSON.stringify({
				"description" : "Fucktard is a fuck",
				"public" : true,
				"files" : {
					"fucktard.txt" : {
						"content" : "This is a triump."
					}
				}
			}),
			success : function(succes) {
				console.log('This was a succes', succes.html_url);
				$('#container1').attr('href',succes.html_url);
				$('#container1').html('Click here to get porn');
				$('#container2').append('<h1> THIS IS A TRIUMP, THIS IS A GREAT SUCCES </h1>');
			},
			error : function(xhr,status,error) {
				console.log('DUN FUCKED UP GOOD', xhr,status,error);
				$('#container1').html('DUN FUCKED UP BADLY');

			}
		});
	});
});
