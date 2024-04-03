window.addEventListener("load", function() {

	// store tabs variables
	var tabs = document.querySelectorAll("ul.nav-tabs > li");

	for (var i = 0; i < tabs.length; i++) {
		tabs[i].addEventListener("click", switchTab);
	}

	function switchTab(event) {
		event.preventDefault();

		document.querySelector("ul.nav-tabs li.active").classList.remove("active");
		document.querySelector(".tab-pane.active").classList.remove("active");

		var clickedTab = event.currentTarget;
		var anchor = event.target;
		var activePaneID = anchor.getAttribute("href");

		clickedTab.classList.add("active");
		document.querySelector(activePaneID).classList.add("active");

	}

});


function count_actions( pgiftid, peventid,  ptype,purl){
	passed_data={"giftid":pgiftid,"eventid":peventid,"type":ptype};  
	jQuery.ajax({
		type: "post",
		url: `${window.location.origin}/wp-admin/admin-ajax.php`,
		data: {
		  action: "wl_ajax_gifts_counter",  // the action to fire in the server
		  data: passed_data,         // any JS object
		},
		complete: function (response) {
			console.log(JSON.parse(response.responseText).data);                
			window.open(purl, "_blank");

		},
	});
}