
function labelInsertInto(labelID)
{

		intoId = $('#intoId').val();
		if(intoId>0){

		$.ajax({
			url:  CI.base_url+"label/insertInto",
			type:'POST',
			data: { labelID: labelID, intoID: intoId },
			success: function(output_string){
				alert('done');
			} 
		});
	}else{
		alert('select label');
	}

}

function labelRename(labelID)
{

		newN = $('#newName').val();
		if(newN!=""){

		$.ajax({
			url:  CI.base_url+"label/rename",
			type:'POST',
			data: { labelID: labelID, newN: newN },
			success: function(output_string){
				alert('done');
			} 
		});
	
	}else{
		alert('enter something');
	}

}



function artistInsertInto(artistID)
{

		intoId = $('#intoId').val();
		if(intoId>0){

		$.ajax({
			url:  CI.base_url+"artist/insertInto",
			type:'POST',
			data: { artistID: artistID, intoID: intoId },
			success: function(output_string){
				alert('done');
			} 
		});
	}else{
		alert('select artist');
	}

}

function artistRename(artistID)
{

		newN = $('#newName').val();
		if(newN!=""){

		$.ajax({
			url:  CI.base_url+"artist/rename",
			type:'POST',
			data: { artistID: artistID, newN: newN },
			success: function(output_string){
				alert('done');
			} 
		});
	
	}else{
		alert('enter something');
	}

}