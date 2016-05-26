
function createLargeImg(guestCheck, adminCheck, imgID, imgUrl, votes, userID, username, voted) {
	
	var userInSessionID = document.getElementById('hiddenInfoUserID').getAttribute('data-value');
	
	var divRow = document.createElement('div');
	divRow.className = 'row';
	
	var divLarge = document.createElement('div');
	divLarge.className = 'col-lg-12';
	
	var divControls = document.createElement('div');
	divControls.className = 'controls';		
	
	var aVotes = document.createElement('div');
	aVotes.className = 'votes';
	aVotes.id = 'votes_' + imgID;
	aVotes.setAttribute('href',"#");
	aVotes.setAttribute('data-value', imgID);
	aVotes.innerHTML = "(" + votes + ")";
	
	if(!guestCheck && !adminCheck) {
		if(userInSessionID != userID) {
		
			var aLargeLike = document.createElement('div');
			aLargeLike.className = 'likeLink';
			aLargeLike.id = 'like_' + imgID;
			aLargeLike.setAttribute('data-value', imgID);
			if(voted > 0) 
				aLargeLike.innerHTML = "Unlike";
			else 
				aLargeLike.innerHTML = "Like";
						
		} else {
			
			var aLargeDelete = document.createElement('div');
			aLargeDelete.className = 'deleteLink';
			aLargeDelete.setAttribute('data-value', imgID);
			aLargeDelete.innerHTML = "Obriši sliku";
			
		}
	}
	
	if(adminCheck) {
		
		var aLargeDelete = document.createElement('div');
		aLargeDelete.className = 'deleteLink';
		aLargeDelete.setAttribute('data-value', imgID);
		aLargeDelete.innerHTML = "Obriši sliku";
	}
	
	var aLargeUsername = document.createElement('a');
	aLargeUsername.className = 'usernameLink';
	aLargeUsername.id = userID;
	aLargeUsername.setAttribute('href', '../andjela/profil.php?userID=' + userID);
	aLargeUsername.innerHTML = username;	
	
	if(!guestCheck && !adminCheck) {
		if(userInSessionID != userID) 
			divControls.appendChild(aLargeLike);
		else 
			divControls.appendChild(aLargeDelete);
	}
	
	if(adminCheck) {		
		divControls.appendChild(aLargeDelete);
	}	
	
	divControls.appendChild(aLargeUsername);
	divControls.appendChild(aVotes);
	
	divLarge.appendChild(divControls);
	
	var aLargeImg = document.createElement('a');
	aLargeImg.setAttribute('href',"#");
	
	var imgLarge = document.createElement("img");
	imgLarge.setAttribute('class', 'img-responsive largeImg');
	imgLarge.id = 'image_' + imgID;
	imgLarge.setAttribute('src', imgUrl);
	
	var imgLargeDivWrapper = document.createElement("div");
	imgLargeDivWrapper.setAttribute('class', 'largeImgWrapper');
	
	imgLargeDivWrapper.appendChild(imgLarge);

	aLargeImg.appendChild(imgLargeDivWrapper);
	divLarge.appendChild(aLargeImg);
	
	divRow.appendChild(divLarge);
	
	return divRow;
	
}

function createSmallImg(guestCheck, adminCheck, imgID, imgUrl, votes, userID, username, voted) {					
	
	var userInSessionID = document.getElementById('hiddenInfoUserID').getAttribute('data-value');
	
	var divSmall = document.createElement('div');
	divSmall.className = 'col-md-4 portfolio-item';
	
	var aSmallImg = document.createElement('a');
	aSmallImg.setAttribute('href',"#");
	
	var imgSmall = document.createElement("img");
	imgSmall.setAttribute('class', 'img-responsive smallImg');
	imgSmall.id = 'image_' + imgID;
	imgSmall.setAttribute('src', imgUrl);
	
	var imgSmallDivWrapper = document.createElement("div");
	imgSmallDivWrapper.setAttribute('class', 'smallImgWrapper');
	
	imgSmallDivWrapper.appendChild(imgSmall);
	
	aSmallImg.appendChild(imgSmallDivWrapper);
	
	var divControls = document.createElement('div');
	divControls.className = 'controls';
	
	var aVotes = document.createElement('div');
	aVotes.setAttribute('href',"#");
	aVotes.setAttribute('data-value', imgID);
	aVotes.id = 'votes_' + imgID;
	aVotes.className = 'votes';
	aVotes.innerHTML = "(" + votes + ")";
	
	if(!guestCheck && !adminCheck) {
		if(userInSessionID != userID) {
		
			var aSmallLike = document.createElement('div');
			aSmallLike.className = 'likeLink';
			aSmallLike.id = 'like_' + imgID;
			aSmallLike.setAttribute('data-value', imgID);
			if(voted > 0) 
				aSmallLike.innerHTML = "Unlike";
			else
				aSmallLike.innerHTML = "Like";	
			
		} else {
			
			var aSmallDelete = document.createElement('div');
			aSmallDelete.className = 'deleteLink';
			aSmallDelete.setAttribute('data-value', imgID);
			aSmallDelete.innerHTML = "Obriši sliku";
			
		}	
	}
			
	if(adminCheck) {
		
		var aSmallDelete = document.createElement('div');
		aSmallDelete.className = 'deleteLink';
		aSmallDelete.setAttribute('data-value', imgID);
		aSmallDelete.innerHTML = "Obriši sliku";
	}	
	
	var aSmallUsername = document.createElement('a');
	aSmallUsername.className = 'usernameLink';
	aSmallUsername.id = userID;
	aSmallUsername.setAttribute('href',"../andjela/profil.php?userID=" + userID);
	aSmallUsername.innerHTML = username

	if(!guestCheck && !adminCheck) {
		if(userInSessionID != userID) 
			divControls.appendChild(aSmallLike);
		else 
			divControls.appendChild(aSmallDelete);
	}
	
	if(adminCheck) {		
		divControls.appendChild(aSmallDelete);
	}	
		
	divControls.appendChild(aSmallUsername);
	divControls.appendChild(aVotes);
	
	divSmall.appendChild(aSmallImg);
	divSmall.appendChild(divControls);	
	
	return divSmall;	
}

function addUsersVotes(addPoint, data) {
	
	var objParsed = jQuery.parseJSON(data);
	var arrayOfVotes = objParsed.votes;
	var status = objParsed.status;	
	
	if(status > 0) {		
		
		var ulElement = document.createElement('ul');
		var i;
		
		for(i = 0; i < arrayOfVotes.length; i++) {
			
			var liElement = document.createElement('li');

			var aElementUser = document.createElement('a');
			aElementUser.setAttribute('href', '../andjela/profil.php?userID=' + arrayOfVotes[i].userID);
			var imgDivElement = document.createElement('div');
			var imgUser = document.createElement('img');
			imgUser.setAttribute('src', '../andjela/' + arrayOfVotes[i].avatarURL);
			imgUser.setAttribute('alt', '../andjela/' + arrayOfVotes[i].avatarURL);
			
			imgDivElement.appendChild(imgUser);
			
			var h3Element = document.createElement('h3');
			h3Element.innerHTML = arrayOfVotes[i].username;
			
			aElementUser.appendChild(imgDivElement);
			aElementUser.appendChild(h3Element);
			
			liElement.appendChild(aElementUser);
			
			ulElement.appendChild(liElement);
		}
		
		addPoint.appendChild(ulElement);
		
	} else {
		
		var messageAlert = document.createElement('p');
		messageAlert.innerHTML = 'Trenutno nema glasova za odabranu sliku.';
		addPoint.appendChild(messageAlert);
	}
}

function loadContent(data, userType) {

	var objParsed = jQuery.parseJSON(data);
	var bigImagesArray = objParsed.big;
	var smallImagesArray = objParsed.small;
	var topicName = objParsed.topicName;
	var topicID = objParsed.topicID;
	var uploadImg = objParsed.uploadImg;
	var sendTopic = objParsed.sendTopic;
	var isMessage = objParsed.isMessage;
	var message = objParsed.message;
	var guest, admin;
	var i, j, k;
	
	// check if user is guest
	if(userType == 'guest') {
		guest = true;
	} else {
		guest = false;
	}
	
	// check if user is admin
	if(userType == 'admin') {
		admin = true;
	} else {
		admin = false;
	}	
	
	document.getElementById("topic").innerHTML = topicName;
	
	if(!guest && !admin) {
		if (uploadImg) {
		
			var h4ElementUploadImg = document.createElement('h4');
			var aUploadLinkUploadImg = document.createElement('a');
		
			aUploadLinkUploadImg.setAttribute('href', 'upload_img.php');
			aUploadLinkUploadImg.setAttribute('target', '_self');
			aUploadLinkUploadImg.innerHTML = 'Objavite sliku';
		
			h4ElementUploadImg.appendChild(aUploadLinkUploadImg);
			document.getElementById('uploadLink').appendChild(h4ElementUploadImg);	
		}	
		
		if (sendTopic) {
			
			var h4ElementSendTopic = document.createElement('h4');
			var aUploadLinkSendTopic = document.createElement('a');
		
			aUploadLinkSendTopic.setAttribute('href', '../andjela/sendtopic.php');
			aUploadLinkSendTopic.setAttribute('target', '_self');
			aUploadLinkSendTopic.innerHTML = 'Pošaljite topik';
		
			h4ElementSendTopic.appendChild(aUploadLinkSendTopic);
			document.getElementById('uploadLink').appendChild(h4ElementSendTopic);	
		}
	}
	
	var h4ElementList = document.createElement('h4');
	var aUploadLinkList = document.createElement('a');
		
	aUploadLinkList.setAttribute('href', '../andjela/topics.php');
	aUploadLinkList.setAttribute('target', '_self');
	aUploadLinkList.innerHTML = 'Spisak topika i pobednika';
		
	h4ElementList.appendChild(aUploadLinkList);
	document.getElementById('uploadLink').appendChild(h4ElementList);
	

	for( i = 0, j = 0; i < bigImagesArray.length; i++ ) {

		var largeRow = createLargeImg(guest, admin, bigImagesArray[i].slikaID, bigImagesArray[i].url, bigImagesArray[i].glasovi, bigImagesArray[i].userID, bigImagesArray[i].username, bigImagesArray[i].izglasano);
		document.getElementById("addRowsPoint").appendChild(largeRow);

		// Main row for small images	
		var divRow = document.createElement('div');
		divRow.className = 'row';

		for( k = 0; (j < smallImagesArray.length) && (k<3); k++) {						

			var smallImg = createSmallImg(guest, admin, smallImagesArray[j].slikaID, smallImagesArray[j].url, smallImagesArray[j].glasovi, smallImagesArray[j].userID, smallImagesArray[j].username, smallImagesArray[j].izglasano);			
			divRow.appendChild(smallImg);
			j++;
		}
		
		document.getElementById("addRowsPoint").appendChild(divRow);
	}
	

	while(j < smallImagesArray.length) {				

		// Main row for small images	
		var divRow = document.createElement('div');
		divRow.className = 'row';

		for( k = 0; (j < smallImagesArray.length) && (k<3); k++) {						

			var smallImg = createSmallImg(guest, admin, smallImagesArray[j].slikaID, smallImagesArray[j].url, smallImagesArray[j].glasovi, smallImagesArray[j].userID, smallImagesArray[j].username, smallImagesArray[j].izglasano);			
			divRow.appendChild(smallImg);
			j++;
		}

		document.getElementById("addRowsPoint").appendChild(divRow);
		
	}
}

function changeVote(imageID, data) {
	
	var objParsed = jQuery.parseJSON(data);
	var numberOfVotes = objParsed.votes;
	var voted = objParsed.voted;

	if(document.getElementById('like_' + imageID).innerHTML == 'Like')
		document.getElementById('like_' + imageID).innerHTML = 'Unlike';
	else
		document.getElementById('like_' + imageID).innerHTML = 'Like';
		
	document.getElementById('votes_' + imageID).innerHTML = '(' + numberOfVotes + ')';
	
}

function voteForImg(userLikeID, imageLikeID) {
	
	$.ajax({
		async: true,
    	type: "POST",
        url: "../php_scripts/vote_for_img.php",
		data: {'userLike': userLikeID, 'imgID': imageLikeID},
        success:function(result){
			changeVote(imageLikeID, result);
        },
        error: function(result){
	        alert("error");                
        }
    });
	
}

function deleteImage(userDeleteID, imageDeleteID) {
	
	var imageURL = document.getElementById('image_' + imageDeleteID).getAttribute('src');
	
	$.ajax({
		async: true,
    	type: "POST",
        url: "../php_scripts/delete_image.php",
		data: {'userDeleteID': userDeleteID, 'imageDeleteID': imageDeleteID, 'url': imageURL},
        success:function(result){
			
			var objParsed = jQuery.parseJSON(result);
			var success = objParsed.success;
			var message = objParsed.message;
			
			if(success > 0) {
				
				alert(message);
				location.reload();
			} else {
				
				alert(message + '\n\n' + 'Pokušajte ponovo.');
			}
			
        },
        error: function(result){
	        alert("error");                
        }
    });
}

function votes(usersPoint, imgID) {
	
	$.ajax({
		async: true,
    	type: "POST",
        url: "../php_scripts/get_votes.php",
		data: {'imageID': imgID},
        success:function(result){
			//alert(result);
			addUsersVotes(usersPoint, result);
        },
        error: function(result){
	        alert("Error: " + result);                
        }
    });
}

window.onload = function() {
	
	var userID = document.getElementById('hiddenInfoUserID').getAttribute('data-value');
	var userType = document.getElementById('hiddenInfoUserType').getAttribute('data-value');

	$.ajax({
		async: true,
    	type: "POST",
        url: "../php_scripts/get_all_content.php",
		data: {'logedInUserID': userID, 'logedInUserType': userType},
        success:function(result){
        	loadContent(result, userType);
			events();		
        },
        error: function(result){
	        alert("Error: " + result);                
        }
    });
}


function events() {
	
	$('.deleteLink').on("click", function() {
		
		var userID = document.getElementById('hiddenInfoUserID').getAttribute('data-value');
		var imageID = this.getAttribute('data-value');

		if (confirm('Da li ste sigurni da želite da obrišete sliku?')) {

			deleteImage(userID, imageID);
		}
	});
	
	$('.likeLink').on("click", function() {
		var userID = document.getElementById('hiddenInfoUserID').getAttribute('data-value');
		var imageID = this.getAttribute('data-value');
		
		voteForImg(userID, imageID);
	});	
	
	$('.votes').on("click", function() {
		var modal = document.getElementById('modal-body');
		var imageID = this.getAttribute('data-value');
		
		votes(modal, imageID);				
		document.getElementById('myModal').style.display = "block";		
	});
	
	$('.close').on("click", function() {		
		document.getElementById('myModal').style.display = "none";
		document.getElementById('modal-body').innerHTML = "";	
	});
	
	window.onclick = function(event) {
   		if (event.target == document.getElementById('myModal')) {
     		document.getElementById('myModal').style.display = "none";
			document.getElementById('modal-body').innerHTML = "";
     	}
	}	
	
}