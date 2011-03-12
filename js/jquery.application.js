jQuery(document).ready(function() { 

	$('#mainftp').uploadify({
  	'uploader'              : 'js/uploadify/uploadify.swf',
  	'script'                : 'js/uploadify/uploadify.php',
  	'multi'			: true,
  	'auto'			: true,
  	'height'		: '32', //height of your browse button file
  	'width'			: '250', //width of your browse button file
  	'sizeLimit'             : '512000000',  //remove this to set no limit on upload size
  	'simUploadLimit'        : '1', //remove this to set no limit on simultaneous uploads
        'fileDesc'              : 'Types de fichier autorises',
        'fileExt'               : '*.zip;*.png;*.gif;*.jpeg;*.jpg;*.pdf;*.odt;*.ods;*.odp;*.xls;*.doc;*.docx;*.ppt;*.pptx',
  	'buttonImg'             : 'img/browse.png',
  	'cancelImg'             : 'img/cancel.png',
		'folder'    : 'files/', //folder to save uploads to
		onProgress: function() {
		  $('#loader').show();
		},
		onAllComplete: function() {
		  $('#loader').hide();
		  $('#allfiles').load(location.href+" #allfiles>*","");
		  //location.reload(); //uncomment this line if youw ant to refresh the whole page instead of just the #allfiles div
		}	
	});
});

function register(){
		$.post('actions/connect.php', { email:email },
		function(data){
                    alert(data);
		if (data=='yes') {

		$("#msgbox").slideUp(200,0.1,function()
		{
                    $(this).html('Vous venez de vous connecter ...').addClass('messageboxerror').fadeTo(900,1);
		});

                } else {
		$("#msgbox").slideUp(200,0.1,function()  //start fading the messagebox
		{
                    $(this).html('Erreur lors de la connection ...').addClass('messageboxerror').fadeTo(900,1);
		});
		}
                });

}

function login(email){
		$.post('actions/connect.php', { email:email },
		function(data){
                    alert(data);
		if (data=='yes') {

		$("#msgbox").slideUp(200,0.1,function()
		{
                    $(this).html('Vous venez de vous connecter ...').addClass('messageboxerror').fadeTo(900,1);
		});

                } else {
		$("#msgbox").slideUp(200,0.1,function()  //start fading the messagebox
		{
                    $(this).html('Erreur lors de la connection ...').addClass('messageboxerror').fadeTo(900,1);
		});
		}
                });

}


function delete_file(dir){
    
		if(confirm('Supprimer cet element ?')) {
				  
		$.get('actions/functions.php', { filedel:dir },
		function(data){  
                    if (data=='yes') {
                        location.reload();
//			$('allfiles').fadeTo(900,1, function(){
//			$(this).slideUp(300,function() {
//				$(this).remove();
//                      });
//
//			});
				    
                    $("#msgbox").slideUp(200,0.1,function()
                    {
			$(this).html('Le fichier vient d\'etre supprime ...').addClass('messageboxerror').fadeTo(900,1);
                    });


                    } else {
			$("#msgbox").slideUp(200,0.1,function()  //start fading the messagebox
			{ 
                            $(this).html('Le fichier n\'a pas ete supprime ...').addClass('messageboxerror').fadeTo(900,1);
			});
                    }
		  
                 });
			      
		} 
} 
