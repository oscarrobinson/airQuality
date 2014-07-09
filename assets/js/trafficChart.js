var categories = ['Cars', 'Buses', 'HGVs', 'Motorcycles', 'Total'];

var horTraffic = [18418, 1333, 918, 1522, 22190];
var ricTraffic = [15245, 366, 332, 173, 16116];
var eriTraffic = [27031, 520, 4224, 347, 32122];
var briTraffic = [23316, 4734, 907, 2191, 31147];

var width = 420,
	height = 70;

var widthScale = d3.scale.linear()
	.domain([0, 35000])
	.range([0, 340]);

var colorScale = d3.scale.category10();


var loadTraffic = function(data, id, side) {
	var canvas = d3.select('#trafficWrapper'+id+side)
		.append('svg')
		.attr('width', width)
		.attr('height', height);

	var bars = canvas.selectAll("rect")
		.data(data)
		.enter()
			.append("rect")
			.attr("transform", "translate(70, 0)")
			.attr("width", function(d) {
				return widthScale(d);
			})
			.attr("height", 10)
			.attr("y", function(d, i) {
				return i * 15;
			})
			.attr("fill", function(d) {
				return colorScale(d);
			});

	var texts = canvas.selectAll("text")
		.data(data)
		.enter();

	texts.append("text")
		.attr("font-size", "10px")
		.style("fill", "black")
		.attr("x", "5")
		.attr("y", function(d, i) {
			return i * 15 + 10;
		})
		.text(function (d, i) {
			return categories[i];
		});

	texts.append("text")
		.attr("transform", "translate(70, 0)")
		.style("fill", "black")
		.attr("font-size", "10px")
		.attr("x", function(d) {
			return widthScale(d) + 5;
		})
		.attr("height", 10)
		.attr("y", function(d, i) {
			return i * 15 + 10;
		})
		.text(function(d) {
			return d;
		});
};

	