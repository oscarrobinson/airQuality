<!DOCTYPE html>
<html>

	<head>
		<title>London Air Quality - Data Visualisation</title>
		<link rel="stylesheet" href="style.css" type="text/css">
		<script src="http://d3js.org/d3.v3.min.js"></script>
	</head>

	<body>
		<div class="canvas"></div>

		<script>

		// dimension vars
		var height = 600,
			width = 600,
			radius = 50; // in use for circles

		// color scale
		var color = d3.scale.linear()
			.domain([0, 700])
		    .range(['white', 'blue']);

		// canvas
		var canvas = d3.select('.canvas').append('svg')
		    .attr('width', width)
		    .attr('height', height);

		// axes
		var circleData = [
			{ "cx": 300, "cy": 300, "radius": 100 },
			{ "cx": 300, "cy": 300, "radius": 200 },
			{ "cx": 300, "cy": 300, "radius": 300 },
			{ "cx": 300, "cy": 300, "radius": 400 },
			{ "cx": 300, "cy": 300, "radius": 500 },
			{ "cx": 300, "cy": 300, "radius": 600 },
			{ "cx": 300, "cy": 300, "radius": 700 }
		]

		var circleGroup = canvas.append("g");

		var circles = circleGroup.selectAll("circle")
			.data(circleData)
			.enter()
			.append("circle");

		var circleAttr = circles
			.attr("cx", function (d) { return d.cx; })
			.attr("cy", function (d) { return d.cy; })
			.attr("r",  function (d) { return 20 + d.radius/3; })
			.attr("fill", "none")
			.attr("stroke", "#444444");

		// time labels
		var labelData = [ 
			{ hour: 0, value: "00:00"},
			{ hour: 1, value: "01:00"},
			{ hour: 2, value: "02:00"},
			{ hour: 3, value: "03:00"},
			{ hour: 4, value: "04:00"},
			{ hour: 5, value: "05:00"},
			{ hour: 6, value: "06:00"},
			{ hour: 7, value: "07:00"},
			{ hour: 8, value: "08:00"},
			{ hour: 9, value: "09:00"},
			{ hour: 10, value: "10:00"},
			{ hour: 11, value: "11:00"},
			{ hour: 12, value: "12:00"},
			{ hour: 13, value: "13:00"},
			{ hour: 14, value: "14:00"},
			{ hour: 15, value: "15:00"},
			{ hour: 16, value: "16:00"},
			{ hour: 17, value: "17:00"},
			{ hour: 18, value: "18:00"},
			{ hour: 19, value: "19:00"},
			{ hour: 20, value: "20:00"},
			{ hour: 21, value: "21:00"},
			{ hour: 22, value: "22:00"},
			{ hour: 23, value: "23:00"}
		]

		var labelGroup = canvas.append("g")
			.attr('transform', 'translate(300, 300)');

		var labels = labelGroup.selectAll("text")
			.data(labelData)
			.enter()
			.append("text");

		var labelAttr = labels
			.attr('font-size', '10px')
			.attr('text-anchor', 'middle')
		    .attr('font-family', 'sans-serif')
		    .attr('fill', '#8C8C8C')
		  	.attr('dy', '-270')
		  	.attr('transform', function (d) {
		  		var r = 15 * d.hour;
		  		return "rotate(" + r + ")";
		  	})
		  	.text(function (d) {
		    return d.value;
			});
		// end of labels

		// segments


		d3.json("data/airData.json", function(data) {


			// alert(data.length);

			console.log(typeof data);

			// console.log(typeof data["BRI"]["Spring"]);
			console.log(data["BRI"]["Spring"]["Monday"]);

			var group = canvas.append('g')
			    .attr('transform', 'translate(300, 300)');

			var arc = d3.svg.arc()
			    .innerRadius(20)
				.outerRadius(function (d, i) {
					if (d.value <= 700) {
						return Math.round(20 + d.value/3);	
					}
					else {
						return 700;
					}	
				});

			var pie = d3.layout.pie()
				.sort(null)
			    .value(function (d) {
			    	console.log("d value" + d.value);
			    	return d.value;
			    	console.log("success");
				});

			var arcs = group.selectAll('.arc')
			    .data(pie(data["BRI"]["Spring"]["Monday"]))
			    .enter()
			    .append('g')
			    .attr('class', 'arc');

			arcs.append('path')
			    .attr('d', arc)
			    .attr('stroke', 'white')
			    .attr('stroke-width', '.5')
			    .attr('fill', function (d, i) {
			    	return color(data["BRI"]["Spring"]["Monday"][i].value);
				});

			arcs.append('text')
			    .attr('text-anchor', 'middle')
			    .attr('font-size', '12px')
			    .attr('font-weight', 'bold')
			    .attr('font-family', 'sans-serif')
			    .attr('fill', '#333333')
			    .text(function (d) {
			    	console.log("text" + Math.round(d.value));
			    	console.log("success");
			    	return Math.round(d.value);
				})
				.attr('transform', function (d, i) {
			    	console.log("data");
			    	// console.log(data["BRI"]["Spring"]["Monday"][i].value);
			    	var c = arc.centroid(d);
			    	return "translate(" + c[0]*2.0 +"," + c[1]*2.0 + ")";
				});
		});

		

		// end of segments

		</script>
		

		
		
	</body>

</html>

