/*	################################################################

	Autor: Marko Domić 2013/0240, tim Elites

	Projekat: LiveTag
	Verzija: 1.0
	
################################################################# */ 




/*	################################################################ 

	CREATING LARGE AND SMALL IMAGES
	
################################################################# */ 


/** 
 * 	Create large image function
 * 
 *	guestCheck - is guest logged in
 *	adminCheck - is administrator logged in
 *	imgID - ID of currnet image
 *	imgUrl - URL of currnet image
 *	votes - number of votes for currnet image
 *	userID - image owner's ID
 *	username - image owner's username
 *	voted - did logged in user vote
*/
function createLargeImg(guestCheck, adminCheck, imgID, imgUrl, votes, userID, username, voted) {
	
	// get logged in user's ID
	var userInSessionID = document.getElementById('hiddenInfoUserID').getAttribute('data-value');
	
	var divRow = document.createElement('div');
	divRow.className = 'row';
	
	var divLarge = document.createElement('div');
	divLarge.className = 'col-md-12';
	
	// thumbnail wrapper
	var divThumbnail = document.createElement('div');
	divThumbnail.className = 'thumbnail largeThumbnail';
	
	// wrapper for votes and username
	var divControls = document.createElement('div');
	divControls.className = 'caption';		
	
	// get all votes
	var h4Votes = document.createElement('h6');
	h4Votes.setAttribute('class', 'pull-right');
	
	var aVotes = document.createElement('div');
	aVotes.className = 'votes';
	aVotes.id = 'votes_' + imgID;
	aVotes.setAttribute('href',"#");
	aVotes.setAttribute('data-value', imgID);
	aVotes.innerHTML = "(" + votes + ")";
	
	if(!guestCheck && !adminCheck) {
		
		if(userInSessionID != userID) {
			
			// make vote button
			var aLargeLike = document.createElement('div');
			aLargeLike.className = 'likeLink';
			aLargeLike.id = 'like_' + imgID;
			aLargeLike.setAttribute('data-value', imgID);
			
			var votedImg = document.createElement('img');
			votedImg.setAttribute('id', 'voted_' + imgID);
			
			aLargeLike.appendChild(votedImg);
			
			if(voted > 0) 
				votedImg.setAttribute('src', '../icon/sphere.png');
			else 
				votedImg.setAttribute('src', '../icon/sphere_empty.png');													
		} else {
			
			// make delete button
			var aLargeDelete = document.createElement('div');
			aLargeDelete.className = 'deleteLink';
			aLargeDelete.setAttribute('data-value', imgID);
			aLargeDelete.innerHTML = "Obrišite sliku";			
		}
	}
	
	if(adminCheck) {
		
		// make delete button for administrator
		var aLargeDelete = document.createElement('div');
		aLargeDelete.className = 'deleteLink';
		aLargeDelete.setAttribute('data-value', imgID);
		aLargeDelete.innerHTML = "Obrišite sliku";
	}
	
	// make username link	
	var aLargeUsername = document.createElement('a');
	aLargeUsername.className = 'usernameLink';
	aLargeUsername.id = userID;
	aLargeUsername.setAttribute('href', '../andjela/profil.php?userID=' + userID);
	aLargeUsername.innerHTML = username;	
	
	var h4LargeUsername = document.createElement('h6');
	h4LargeUsername.appendChild(aLargeUsername);
	
	// append vote or delete button
	if(!guestCheck && !adminCheck) {
		if(userInSessionID != userID) 
			h4Votes.appendChild(aLargeLike);
		else 
			h4Votes.appendChild(aLargeDelete);
	}
	
	// append delete button for administrator
	if(adminCheck) {		
		h4Votes.appendChild(aLargeDelete);
	}	

	// append all votes
	h4Votes.appendChild(aVotes);
	
	// append all in controls
	divControls.appendChild(h4Votes);
	divControls.appendChild(h4LargeUsername);
	
	// append controls in thumbnail
	divThumbnail.appendChild(divControls);
	
	// creating image
	var aLargeImg = document.createElement('a');
	aLargeImg.setAttribute('href', imgUrl);
	aLargeImg.setAttribute('class','fancybox-effects-d');
	
	var imgLarge = document.createElement("img");
	imgLarge.setAttribute('class', 'img-responsive largeImg');
	imgLarge.id = 'image_' + imgID;
	imgLarge.setAttribute('src', imgUrl);
	
	var imgLargeDivWrapper = document.createElement("div");
	imgLargeDivWrapper.setAttribute('class', 'largeImgWrapper');
	
	imgLargeDivWrapper.appendChild(imgLarge);

	aLargeImg.appendChild(imgLargeDivWrapper);
	
	// append image in thumbnail
	divThumbnail.appendChild(aLargeImg);
	
	// appending thumbnail in row
	divLarge.appendChild(divThumbnail);	
	divRow.appendChild(divLarge);
	
	return divRow;
	
}

/** 
 * 	Create small image function
 * 
 *	guestCheck - is guest logged in
 *	adminCheck - is administrator logged in
 *	imgID - ID of currnet image
 *	imgUrl - URL of currnet image
 *	votes - number of votes for currnet image
 *	userID - image owner's ID
 *	username - image owner's username
 *	voted - did logged in user vote
*/
function createSmallImg(guestCheck, adminCheck, imgID, imgUrl, votes, userID, username, voted) {					
	
	// get logged in user's ID
	var userInSessionID = document.getElementById('hiddenInfoUserID').getAttribute('data-value');
	
	var divSmall = document.createElement('div');
	divSmall.className = 'col-sm-4 col-lg-4 col-md-4 portfolio-item';

	// thumbnail wrapper
	var divThumbnail = document.createElement('div');
	divThumbnail.className = 'thumbnail smallThumbnail';
	divThumbnail.setAttribute('id', 'smallThumbnail');
	
	// creating image
	var aSmallImg = document.createElement('a');
	aSmallImg.setAttribute('href', imgUrl);
	aSmallImg.setAttribute('class','fancybox-effects-d');
	
	var imgSmall = document.createElement("img");
	imgSmall.setAttribute('class', 'img-responsive smallImg');
	imgSmall.id = 'image_' + imgID;
	imgSmall.setAttribute('src', imgUrl);
	
	var imgSmallDivWrapper = document.createElement("div");
	imgSmallDivWrapper.setAttribute('class', 'smallImgWrapper');
	
	imgSmallDivWrapper.appendChild(imgSmall);
	
	aSmallImg.appendChild(imgSmallDivWrapper);
	
	// wrapper for votes and username
	var divControls = document.createElement('div');
	divControls.className = 'caption';
	
	// get all votes
	var h4Votes = document.createElement('h6');
	h4Votes.setAttribute('class', 'pull-right');

	var aVotes = document.createElement('div');
	aVotes.setAttribute('href',"#");
	aVotes.setAttribute('data-value', imgID);
	aVotes.id = 'votes_' + imgID;
	aVotes.className = 'votes';
	aVotes.innerHTML = "(" + votes + ")";
	
	if(!guestCheck && !adminCheck) {
		if(userInSessionID != userID) {
		
			// make vote button
			var aSmallLike = document.createElement('div');
			aSmallLike.className = 'likeLink';
			aSmallLike.id = 'like_' + imgID;
			aSmallLike.setAttribute('data-value', imgID);
			
			var votedImg = document.createElement('img');
			votedImg.setAttribute('id', 'voted_' + imgID);
			
			aSmallLike.appendChild(votedImg);
			
			if(voted > 0) 
				votedImg.setAttribute('src', '../icon/sphere.png');
			else 
				votedImg.setAttribute('src', '../icon/sphere_empty.png');
			
		} else {
			
			// make delete button
			var aSmallDelete = document.createElement('div');
			aSmallDelete.className = 'deleteLink';
			aSmallDelete.setAttribute('data-value', imgID);
			aSmallDelete.innerHTML = "Obrišite sliku";
			
		}	
	}
			
	if(adminCheck) {
		
		// make delete button for administrator
		var aSmallDelete = document.createElement('div');
		aSmallDelete.className = 'deleteLink';
		aSmallDelete.setAttribute('data-value', imgID);
		aSmallDelete.innerHTML = "Obrišite sliku";
	}	
	
	// make username link
	var aSmallUsername = document.createElement('a');
	aSmallUsername.className = 'usernameLink';
	aSmallUsername.id = userID;
	aSmallUsername.setAttribute('href',"../andjela/profil.php?userID=" + userID);
	aSmallUsername.innerHTML = username;

	var h4SmallUsername = document.createElement('h6');
	h4SmallUsername.appendChild(aSmallUsername);
	
	// append vote or delete button
	if(!guestCheck && !adminCheck) {
		if(userInSessionID != userID) 
			h4Votes.appendChild(aSmallLike);
		else 
			h4Votes.appendChild(aSmallDelete);
	}
	
	// append delete button for administrator
	if(adminCheck) {		
		h4Votes.appendChild(aSmallDelete);
	}	
		
	// append all votes
	h4Votes.appendChild(aVotes);

	// append all in controls
	divControls.appendChild(h4Votes);
	divControls.appendChild(h4SmallUsername);	
	
	// append image in thumbnail
	divThumbnail.appendChild(aSmallImg);
	
	// append controls in thumbnail
	divThumbnail.appendChild(divControls);	

	// appending thumbnail in row
	divSmall.appendChild(divThumbnail);
	
	return divSmall;	
}



/*	################################################################ 

	ADDING USERS WHO VOTED FOR CERTAIN IMAGE
	
################################################################# */


/**
 *	Adding in ul, li elements with users who voted
 *
 *	addPoint - html element in which will bi added li elements
 *	data - JSON response with users data
*/
function addUsersVotes(addPoint, data) {
	
	// get elements from JSON object
	var objParsed = jQuery.parseJSON(data);
	var arrayOfVotes = objParsed.votes;
	var status = objParsed.status;	
	
	if(status > 0) {		
		
		// there are votes for certain image
		
		var ulElement = document.createElement('ul');
		var i;
		
		//for all users who voted, creates new li element with user's username and avatar
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
		
		// there are not votes for certain image
		
		var messageAlert = document.createElement('p');
		messageAlert.innerHTML = 'Trenutno nema glasova za odabranu sliku.';
		addPoint.appendChild(messageAlert);
	}
}



/*	################################################################ 

	FUNCTIONS FOR SUCCESSED AJAX RESPONSES
	
################################################################# */


/**
 *	Loading all content function in html
 *
 *	data - JSON response with all data which is required for loading content in html
 * 	userType - type of logged in user
*/
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
	
	// check if logged in user have a message
	if(isMessage) {

		var aMessage = document.createElement('a');
		aMessage.setAttribute('href', '#');
		aMessage.setAttribute('id', 'newMessage');
		aMessage.innerHTML = 'NOVA PORUKA!';
		
		document.getElementById("newMessage").appendChild(aMessage);
		document.getElementById("hiddenNewMessage").setAttribute('data-value', message);
	}

	// insert topic for current day
	document.getElementById("topic").innerHTML = "#" + topicName;
	
	if(!guest && !admin) {
		if (uploadImg) {
		
			// if user can upload image
			
			var h4ElementUploadImg = document.createElement('h4');
			var aUploadLinkUploadImg = document.createElement('a');
		
			aUploadLinkUploadImg.setAttribute('href', 'upload_img.php');
			aUploadLinkUploadImg.setAttribute('target', '_self');
			aUploadLinkUploadImg.setAttribute('class', 'sideLinks');
			aUploadLinkUploadImg.innerHTML = '&bull; Objavite sliku';
		
			h4ElementUploadImg.appendChild(aUploadLinkUploadImg);
			
			var liElementImg = document.createElement('li');
			liElementImg.appendChild(h4ElementUploadImg);
					
			document.getElementById('uploadLink').appendChild(liElementImg);	
		}	
		
		if (sendTopic) {
			
			// if user can send topic
			
			var h4ElementSendTopic = document.createElement('h4');
			var aUploadLinkSendTopic = document.createElement('a');
		
			aUploadLinkSendTopic.setAttribute('href', '../andjela/sendtopic.php');
			aUploadLinkSendTopic.setAttribute('target', '_self');
			aUploadLinkSendTopic.setAttribute('class', 'sideLinks');
			aUploadLinkSendTopic.innerHTML = '&bull; Pošaljite topik';
		
			h4ElementSendTopic.appendChild(aUploadLinkSendTopic);
			
			var liElementTopic = document.createElement('li');
			liElementTopic.appendChild(h4ElementSendTopic);
			
			document.getElementById('uploadLink').appendChild(liElementTopic);	
		}
	}
	
	//creating link for all topics and winners
	var h4ElementList = document.createElement('h4');
	var aUploadLinkList = document.createElement('a');
		
	aUploadLinkList.setAttribute('href', '../andjela/topics.php');
	aUploadLinkList.setAttribute('target', '_self');
	aUploadLinkList.setAttribute('class', 'sideLinks');
	aUploadLinkList.innerHTML = '&bull; Spisak topika i pobednika';
		
	h4ElementList.appendChild(aUploadLinkList);
	
	var liElementWin = document.createElement('li');
	liElementWin.appendChild(h4ElementList);
	
	document.getElementById('uploadLink').appendChild(liElementWin);
	
	// adding large images first
	for( i = 0; i < bigImagesArray.length; i++ ) {

		var largeRow = createLargeImg(guest, admin, bigImagesArray[i].slikaID, bigImagesArray[i].url, bigImagesArray[i].glasovi, bigImagesArray[i].userID, bigImagesArray[i].username, bigImagesArray[i].izglasano);
		document.getElementById("addRowsPoint").appendChild(largeRow);
		
		/*########################################################################
			
			OLD SOLUTION
		 
		
		// Main row for small images	
		var divRow = document.createElement('div');
		divRow.className = 'row';

		for( k = 0; (j < smallImagesArray.length) && (k<3); k++) {						

			var smallImg = createSmallImg(guest, admin, smallImagesArray[j].slikaID, smallImagesArray[j].url, smallImagesArray[j].glasovi, smallImagesArray[j].userID, smallImagesArray[j].username, smallImagesArray[j].izglasano);			
			divRow.appendChild(smallImg);
			j++;
		}
		
		document.getElementById("addRowsPoint").appendChild(divRow);
		
		########################################################################*/
	}
	
	// adding small images
	j = 0;
	while(j < smallImagesArray.length) {				

		// Main row for small images	
		var divRow = document.createElement('div');
		divRow.className = 'row';

		// 3 small images in 1 row
		for( k = 0; (j < smallImagesArray.length) && (k<3); k++) {						

			var smallImg = createSmallImg(guest, admin, smallImagesArray[j].slikaID, smallImagesArray[j].url, smallImagesArray[j].glasovi, smallImagesArray[j].userID, smallImagesArray[j].username, smallImagesArray[j].izglasano);			
			divRow.appendChild(smallImg);
			j++;
		}

		document.getElementById("addRowsPoint").appendChild(divRow);
		
	}
}

/**
 *	Change vote icon function on click
 *
 *	imageID - ID of voted image 
 *	data - JSON response from voting
*/
function changeVote(imageID, data) {
	
	var objParsed = jQuery.parseJSON(data);
	var numberOfVotes = objParsed.votes;
	var voted = objParsed.voted;

	if(document.getElementById('voted_' + imageID).getAttribute('src') == '../icon/sphere_empty.png')
		document.getElementById('voted_' + imageID).setAttribute('src', '../icon/sphere.png');
	else
		document.getElementById('voted_' + imageID).setAttribute('src', '../icon/sphere_empty.png');
		
	document.getElementById('votes_' + imageID).innerHTML = '(' + numberOfVotes + ')';
	
}



/*	################################################################ 

	AJAX REQUESTS
	
################################################################# */


/**
 *	Sending vote or unvote
 *
 *	userLikeID - ID of user who (un)voted
 * 	imageLikeID - ID of image which is (un)voted
*/
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

/**
 *	Deleting image
 *
 *	userDeleteID - ID of user who deletes image
 * 	imageDeleteID - ID of image which is deleted
*/
function deleteImage(userDeleteID, imageDeleteID) {
	
	// URL of deleted image
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

/**
 *	Showing all votes
 *
 *	usersPoint - where to put all users who voted for certain image
 * 	imgID - ID of certain image
*/
function votes(usersPoint, imgID) {
	
	$.ajax({
		async: true,
    	type: "POST",
        url: "../php_scripts/get_votes.php",
		data: {'imageID': imgID},
        success:function(result){
			addUsersVotes(usersPoint, result);
			document.getElementById('myModal').style.display = "block";
        },
        error: function(result){
	        alert("Error: " + result);                
        }
    });
}

/**
 *	Deleting message when user read it's content
*/
function clearMessage() {
	
	var userID = document.getElementById('hiddenInfoUserID').getAttribute('data-value');
	
	$.ajax({
		async: true,
    	type: "POST",
        url: "../php_scripts/clear_message.php",
		data: {'userID': userID},
        error: function(result){
	        alert("Error: " + result);                
        }
    });
}

/**
 *	Loading main elements of html page when it starts
*/
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



/*	################################################################ 

	EVENTS ON CLICK
	
################################################################# */


function events() {
	
	//delete image
	$('.deleteLink').on("click", function() {
		
		var userID = document.getElementById('hiddenInfoUserID').getAttribute('data-value');
		var imageID = this.getAttribute('data-value');

		if (confirm('Da li ste sigurni da želite da obrišete sliku?')) {
			deleteImage(userID, imageID);
		}
	});
	
	// vote for image
	$('.likeLink').on("click", function() {
		var userID = document.getElementById('hiddenInfoUserID').getAttribute('data-value');
		var imageID = this.getAttribute('data-value');
		
		voteForImg(userID, imageID);
	});	
	
	// events for votes modal
	$('.votes').on("click", function() {
		var modal = document.getElementById('modal-body');
		var imageID = this.getAttribute('data-value');
		
		votes(modal, imageID);						
	});
	
	$('.close').on("click", function() {		
		document.getElementById('myModal').style.display = "none";
		document.getElementById('modal-body').innerHTML = "";	
	});
	
	
	// events for message modal 
	$('#newMessage').on("click", function() {
		var modal = document.getElementById('modal-body-message');
		var message = document.getElementById('hiddenNewMessage').getAttribute('data-value');
		
		$('#newMessage').css('background-color', 'transparent');
		
		modal.innerHTML = message;				
		document.getElementById('myModalMessage').style.display = "block";		
	});
	
	$('.close-message').on("click", function() {		
		document.getElementById('myModalMessage').style.display = "none";
		clearMessage();
	});
	
	
	window.onclick = function(event) {
		// modal votes
   		if (event.target == document.getElementById('myModal')) {
     		document.getElementById('myModal').style.display = "none";
			document.getElementById('modal-body').innerHTML = "";
     	}
		
		// modal message
		if (event.target == document.getElementById('myModalMessage')) {
     		document.getElementById('myModalMessage').style.display = "none";
			clearMessage();
     	}
	}	
	
}