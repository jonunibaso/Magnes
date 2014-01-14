var lsz=152;var srv=Array([lsz]);srv[0]="180upload";srv[1]="1fichier";srv[2]="2shared";srv[3]="4shared";srv[4]="dfiles";srv[5]="amonshare";srv[6]="arabsh";srv[7]="asfile";srv[8]="bayfiles";srv[9]="bitshare";srv[10]="box";srv[11]="boxca";srv[12]="cramit.in";srv[13]="crocko";srv[14]="ctdisk";srv[15]="czshare";srv[16]="datafilehost";srv[17]="demo.ovh.net";srv[18]="depositfiles";srv[19]="divxstage.eu";srv[20]="dl.free.fr";srv[21]="dosya.tc";srv[22]="dropbox";srv[23]="easybytez";srv[24]="esnips";srv[25]="extabit";srv[26]="fastupload.rol.ro";srv[27]="file.damasgate";srv[28]="fileband";srv[29]="filebox";srv[30]="filefactory";srv[31]="fileflyer";srv[32]="fileice.net";srv[33]="filejungle";srv[34]="filemates";srv[35]="filenuke";srv[36]="filepost";srv[37]="files.mail.ru";srv[38]="files.namba.kz";srv[39]="fileserve";srv[40]="filesflash";srv[41]="filesin";srv[42]="filesmonster";srv[43]="filesonic";srv[44]="fileswap";srv[45]="freakshare";srv[46]="fshare.vn";srv[47]="ge.tt";srv[48]="gigabase";srv[49]="gigapeta";srv[50]="gigasize";srv[51]="glumbouploads";srv[52]="good.gd";srv[53]="grooveshark";srv[54]="hidemyass";srv[55]="hipfile";srv[56]="hitfile.net";srv[57]="host.hackerbox.org";srv[58]="hostingbulk";srv[59]="hotfile";srv[60]="howfile";srv[61]="hulkshare";srv[62]="idup.in";srv[63]="imagearn";srv[64]="indowebster";srv[65]="ishare.iask.sina.com.cn";srv[66]="issuu";srv[67]="jandown";srv[68]="jumbofiles";srv[69]="kiwi6";srv[70]="kuai.xunlei";srv[71]="letitbit.net";srv[72]="luckyshare.net";srv[73]="mediafire";srv[74]="megashare.vnn.vn";srv[75]="megashares";srv[76]="minus";srv[77]="mixturecloud";srv[78]="movreel";srv[79]="movshare.net";srv[80]="movzap";srv[81]="muchshare.net";srv[82]="net366.cba.pl";srv[83]="netload.in";srv[84]="novamov";srv[85]="pdfcast.org";srv[86]="pornhost";srv[87]="putlocker";srv[88]="queenshare";srv[89]="rapidgator.net";srv[90]="redpost.mts.ru";srv[91]="rghost.net";srv[92]="saponeclick.de.vu";srv[93]="scribd.com";srv[94]="sendmyway";srv[95]="sendspace";srv[96]="share-online.biz";srv[97]="Hoster";srv[98]="sharebeast";srv[99]="sharecash.org";srv[100]="shareflare.net";srv[101]="sharerepo";srv[102]="slideshare.net";srv[103]="slingfile";srv[104]="sockshare";srv[105]="soundcloud";srv[106]="speedyshare";srv[107]="stagevu";srv[108]="stooorage";srv[109]="sugarsync";srv[110]="transferbigfiles";srv[111]="trilulilu.ro";srv[112]="tusfiles.net";srv[113]="twitvid";srv[114]="u.115";srv[115]="uloz.to";srv[116]="unibytes";srv[117]="up.4share.vn";srv[118]="up.eqla3";srv[119]="upanh";srv[120]="upload.ugm.ac.id";srv[121]="uploadbaz";srv[122]="uploadc";srv[123]="uploading";srv[124]="uploadstation";srv[125]="uplod.ir";srv[126]="uppit";srv[127]="uptobox";srv[128]="veevr";srv[129]="vidbull";srv[130]="vidbux";srv[131]="videarn";srv[132]="videoalbumy.azet.sk";srv[133]="videobam";srv[134]="videobb";srv[135]="vidxden";srv[136]="vimeo";srv[137]="vip-file";srv[138]="wetransfer";srv[139]="wupload";srv[140]="xvidstage";srv[141]="yourfilehost";srv[142]="yousendit";srv[143]="zalaa";srv[144]="zalil.ru";srv[145]="ziddu";srv[146]="zippyshare";srv[147]="novafile";srv[148]="uploaded";srv[149]="rapidshare";srv[150]="turbobit";srv[151]="cloudzer.net";

function validLink(l){
	lp = 0;
	server = "";
	jQuery.each(srv,function(index,value)
	{
		lp ++;
		if(l.indexOf(this)!==-1){
			server = this;
			new_link = "<tr><td><a href='"+ l +"' target='_blank'>"+ l + "</a>";
			new_link +=  "</td><td class='description'><b>"+$('#quality_link').val()+"</b></td>";
			new_link +=  "<td> Direct Download<br>( <b> "+  this + "</b> )</td>";
			new_link +=  "<td>-</td>";
			new_link +=  "<td>-</td>";
			new_link +=  "<td><span class='label label-success'>Active</span></td></tr>";
			$('#links_table').append(new_link);
			
			id = $('#release_id').val();

			$.ajax({
				url:  CI.base_url+"release/addLink/"+id,
				type:'POST',
				data: { releaseID: id, link: l, server: this, quality: $('#quality_link').val() },
				success: function(output_string){

				} 
			});
		}
	});
	if(server!=""){
		//alert(server);
	}else{
		alert('invalid url/server');
//		alert(lp);
}	
}

var send_num_links = 0;

function sendCover(l)
{

	if (l.match(/\.(jpeg|jpg|gif|png)$/) != null){
		id = $('#release_id').val();

		$.ajax({
			url:  CI.base_url+"release/addCoverLink/"+id,
			type:'POST',
			data: { releaseID: id, link: l },
			success: function(output_string){

			} 
		});
	}else{
		alert('not a valid img url');
	}
}

function addToList(listID)
{
	releaseID = $('#release_id').val();


	$.ajax({
		url:  CI.base_url+"release/addToList/",
		type:'POST',
		data: { rID: releaseID, lID: listID },
		success: function(out){
			if(out==true){
				$.pnotify({
					title: 'Success!',
					text: 'Added to List!',
					type: 'success',
					opacity: .9
				});
				$("#list_"+listID).css('background', '#81BD82');
			}else{

				$.pnotify({
					title: 'Oh No!',
					text: "Removed from list!",
					type: 'error',
					opacity: .9
				});
				$("#list_"+listID).css('background', 'none');

			}
			return false;
		} 
	});
}

function rateLink(link,rate)
{
	id = $('#release_id').val();


	$.ajax({
		url:  CI.base_url+"release/rateLink/"+id,
		type:'POST',
		data: { linkID: link, rate: rate },
		success: function(out){
			if(out==true){
				$.pnotify({
					title: 'Success!',
					text: 'Thanks for voting!',
					type: 'success',
					opacity: .9

				});
			}else{

				$.pnotify({
					title: 'Oh No!',
					text: "You can't vote the same link twice!.",
					type: 'error',
					opacity: .9
				});
			}
			return false;
		} 
	});
}

function validLinkSend(l){
	lp = 0;
	server = "";
	jQuery.each(srv,function(index,value)
	{
		lp ++;
		if(l.indexOf(this)!==-1){
			server = this;
			new_link = "<tr><td><a href='"+ l +"' target='_blank'>"+ l + "</a>";
			new_link +=  "</td><td><b>"+$('#quality_link').val()+"</b></td>";
			new_link +=  "<td> Direct Download ( <b> "+  this + "</b> )</td><td></tr>";
			$('#links_table').append(new_link);
			
			id = $('#release_id').val();
			$('#secret_links').append("<input type='hidden' name='link_"+send_num_links+"'  id='link_"+send_num_links+"' value='"+l+"' />");
			$('#secret_links').append("<input type='hidden' name='serv_"+send_num_links+"'' id='serv_"+send_num_links+"' value='"+this+"' />");
			$('#secret_links').append("<input type='hidden' name='qual_"+send_num_links+"'' id='qual_"+send_num_links+"' value='"+$('#quality_link').val()+"' />");

			send_num_links++;
		}
	});
	if(server!=""){
		//alert(server);
	}else{
		alert('invalid url/server');
	}	
}


$.pnotify.defaults.history = false;

function closeDialog () {
	$('#adminUrlModal').modal('hide'); 
};
function closeLoggedDialog () {
	$('#notLoggedModal').modal('hide'); 
};
function okClicked () {
	ncl = document.getElementById ("xlInput").value;
	sendCover(ncl);
	closeDialog ();
};
function anonymousRate()
{
	alert('You must be registered for voting!\n\nIt\'s free!');

}

$('#btn_add_url').click(function() {

	var myVariable = $('#link_url').val();
	if(/^([a-z]([a-z]|\d|\+|-|\.)*):(\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?((\[(|(v[\da-f]{1,}\.(([a-z]|\d|-|\.|_|~)|[!\$&'\(\)\*\+,;=]|:)+))\])|((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=])*)(:\d*)?)(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*|(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)){0})(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(myVariable)) {
		validLink(myVariable);
		$('#link_url').val('');

	} else {
		alert("invalid url");
	}
});

$('#btn_send_add_url').click(function() {

	var myVariable = $('#link_url').val();
	if(/^([a-z]([a-z]|\d|\+|-|\.)*):(\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?((\[(|(v[\da-f]{1,}\.(([a-z]|\d|-|\.|_|~)|[!\$&'\(\)\*\+,;=]|:)+))\])|((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=])*)(:\d*)?)(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*|(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)){0})(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(myVariable)) {
		validLinkSend(myVariable);
		$('#link_url').val('');
	} else {
		alert("invalid url");
	}
});