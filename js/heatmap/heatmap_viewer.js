function initHeatmapViewer(){
	var canvas = drawHeatmapContainer();
	var heat = simpleheat(canvas).max(heatmap_max_layers);
	setHeatIntensity(heat);
	drawHeatmap(heat);
}

function setHeatIntensity(heat){
	heat.radius(20, 25);
	heat.draw();
}

function drawHeatmap(heat){
	new Ajax.Request(heatmap_retrieve_url, {
		method:'get',
		parameters: {
			heatmap_current_uri: encodeURIComponent(heatmap_current_uri),
			screen_size: JSON.stringify(getScreenSize())
		},
		onSuccess: function(response) {
			var coordinates = JSON.parse(response.responseText).data;
			heat.data(coordinates);
			heat.draw();
		},
		onFailure: function(r) {console.log(r)}
	});
}

function getScreenSize(){
	var width = screen.width,
		height = screen.height;
	return [width, height];
}

function drawHeatmapContainer(){
	var canvas = document.createElement('canvas');
	var body = document.body,
		html = document.documentElement;

	var bodyWidth = Math.max( body.scrollWidth, body.offsetWidth, html.clientWidth, html.scrollWidth, html.offsetWidth),
		bodyHeight = Math.max( body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight);
	canvas.style.position = "absolute";
	canvas.style.left = "0";
	canvas.style.top = "0";
	canvas.width = bodyWidth;
	canvas.height = bodyHeight;
	canvas.style.zIndex = Number.MAX_SAFE_INTEGER;
	body.appendChild(canvas);
	return canvas;
}