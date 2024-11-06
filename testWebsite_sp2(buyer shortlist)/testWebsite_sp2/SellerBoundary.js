document.addEventListener('DOMContentLoaded', () => {
    new SellerBoundary();
});

class SellerBoundary {
	constructor() {
		 this.init()
	}
	
	init() {
		this.loadCarListings()
		this.setupEventListeners()
	}
	
	loadCarListings(query = ' ') {
		fetch('ReadCarListingforSellerController.php?query=' + query + '&username=' + username)
		.then(response => response.json())
		.then(data => {
        const cardContainer = document.getElementById('listOfcarListings');
        cardContainer.innerHTML = ''; // Clear existing content

        data.forEach(item => {
            const card = document.createElement('div');
            card.className = 'container mt-4';
            card.innerHTML = `
                <a href="carListing.php?id=${item.id}" class="card-link">
                    <div class="card">
                        <div class="row g-0">
                            <!-- Car Image -->
                            <div class="col-md-2">
                                <img src="${item.imagePath}" class="img-fluid rounded-start" alt="Car image">
                            </div>
                            <!-- Car Details -->
                            <div class="col-md-10">
                                <div class="card-body">
                                    <h5 class="card-title">${item.car_name}</h5>
                                    <p class="price" id="price">${item.price}</p>
                                    <div class="row">
                                        <div class="col-6 col-md-4 car-info">
                                            <p><i class="bi bi-calendar3"></i> Registered: ${item.regDate}</p>
                                            <p><i class="bi bi-person"></i> ${item.noOfOwners} Owners</p>
                                        </div>
                                    </div>
                                    <p class="mt-3">${item.description}</p>
                                    <!-- View and shortlist counters -->
                                    <div class="counters">
                                        <div><i class="bi bi-eye"></i> <span id="noOfViews">${item.noOfViews}</span> views</div>
                                        <div><i class="bi bi-heart"></i> <span id="noOfShortlists">${item.noOfShortlists}</span> shortlisted</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            `;
            cardContainer.appendChild(card);
        });
    })
    .catch(error => {
        console.error('There has been a problem with your fetch operation:', error);
    });
  }
  
  setupEventListeners() {
	  document.querySelector('#searchCarListing').addEventListener('input', () => {
            this.loadCarListings(document.querySelector('#searchCarListing').value);
      });
  }
}