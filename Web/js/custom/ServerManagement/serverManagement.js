import naja from "naja";

/**
 * Sends request to DB to rturn server status in given intervals
 */
export function getServerStatus() {
	setInterval(async function () {
		let body = document.getElementById("serverStatus");
		let link = body.getAttribute("data-url");
		const response = await naja.makeRequest("GET", link);

		document.getElementById("liveStatus").innerHTML = response.serverStatus;
	}, 5000)
}

