document.addEventListener('DOMContentLoaded', () => {
    new CarListingBoundary();
});

class CarListingBoundary {
	constructor() {
		 this.init()
	}
	
	init() {
		this.loadCarListingInfo(id)
		this.checkBuyerShortlist(id)
	}
	
	loadCarListingInfo(id) {
		fetch('CarListingInfoFetchController.php?id=' + id)
		.then(response => response.json())
		.then(data => {
			const item = data[0];
			$('#car_name').html(item.car_name);
			$('#price').html('$' + parseFloat(item.price).toFixed(2));
			$('#regDate').html(item.regDate);
			$('#noOfOwners').html(item.noOfOwners);
			$('#plate_no').html(item.plate_no);
			$('#vehType').html(item.vehType);
			$('#description').html(item.description);
			
			$('.main-image').attr('src', item.imagePath);
		})
		.catch(error => {
        console.error('There has been a problem with your fetch operation:', error);
		});
	}
	
	checkBuyerShortlist(id) {
		fetch('CheckBuyerShortlistController.php?id=' + id + '&username=' + username)
		.then(response => response.json())
		.then(isShortlisted => {
			if(isShortlisted == false) {
				$('#removeFromShortlist').hide();
				$('#addToShortlist').show();
			} else {
				$('#addToShortlist').hide();
				$('#removeFromShortlist').show();				
			}
		})
		.catch(error => {
        console.error('There has been a problem with your fetch operation:', error);
		});
	}
}