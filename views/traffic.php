
</style>
<div class="trafficChart">
  <div style="width: 40px;">4</div>
  <div style="width: 80px;">8</div>
  <div style="width: 150px;">15</div>
  <div style="width: 160px;">16</div>
  <div style="width: 230px;">23</div>
  <div style="width: 420px;">42</div>
</div>
<div id="trafficWrapper">

</div>
<script>


	var categories = ['Cars', 'Buses', 'HGVs', 'Motorcycles', 'Total'];

	var wesTraffic = [18418, 1333, 918, 1522, 22190];
	var ricTraffic = [15245, 366, 332, 173, 16116];
	var bexTraffic = [27031, 520, 4224, 347, 32122];
	var briTraffic = [23316, 4734, 907, 2191, 31147];

	var width = 500,
		height = 500;

	var widthScale = d3.scale.linear()
		.domain([0, 35000])
		.range([0, 450]);

	var colorScale = d3.scale.category10();

	//var axis = d3.svg.axis()
	//	.scale(widthScale);

	var canvas = d3.select('#trafficWrapper')
		.append('svg')
		.attr('width', width)
		.attr('height', height)

	var bars = canvas.selectAll("rect")
		.data(wesTraffic)
		.enter()
			.append("rect")
			.attr("transform", "translate(70, 0)")
			.attr("width", function(d) {
				return widthScale(d);
			})
			.attr("height", 20)
			.attr("y", function(d, i) {
				return i * 25;
			})
			.attr("fill", function(d) {
				return colorScale(d);
			});

	var texts = canvas.selectAll("text")
		.data(wesTraffic)
		.enter();

	texts.append("text")
		.attr("font-size", "10px")
		.style("fill", "black")
		.attr("x", "5")
		.attr("y", function(d, i) {
			return i * 25 + 15;
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
		.attr("height", 20)
		.attr("y", function(d, i) {
			return i * 25 + 15;
		})
		.text(function(d) {
			return d;
		});

</script>
