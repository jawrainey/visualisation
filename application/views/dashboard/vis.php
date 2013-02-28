        <article>
          <p><b>STAGE THREE</b></p>
          <h1>Visualistion of {insert user's visualistion name}</h1>
          <div id="rain">
          <style>
          .axis path,
          .axis line {
            fill: none;
            stroke: #000;
            shape-rendering: crispEdges;
          }

          .x.axis path {
            display: none;
          }

          .line {
            fill: none;
            stroke: steelblue;
            stroke-width: 1.5px;
          }

          #rain { padding-bottom: 1.62em; }
          </style>
          <script>

          var margin = {top: 20, right: 20, bottom: 30, left: 50},
              width = 500,
              height = 325;

          var parseDate = d3.time.format("%d-%b-%y").parse;

          var x = d3.time.scale()
              .range([0, width]);

          var y = d3.scale.linear()
              .range([height, 0]);

          var xAxis = d3.svg.axis()
              .scale(x)
              .orient("bottom");

          var yAxis = d3.svg.axis()
              .scale(y)
              .orient("left");

          var line = d3.svg.line()
              .x(function(d) { return x(d.date); })
              .y(function(d) { return y(d.close); });

          var svg = d3.select("#rain").append("svg")
              .attr("width", width + margin.left + margin.right)
              .attr("height", height + margin.top + margin.bottom)
            .append("g")
              .attr("transform", "translate(" + margin.left + "," + margin.top + ")");


          d3.tsv("<?php echo $this->config->base_url(); ?>data.tsv", function(error, data) {
            data.forEach(function(d) {
              d.date = parseDate(d.date);
              d.close = +d.close;
            });

            x.domain(d3.extent(data, function(d) { return d.date; }));
            y.domain(d3.extent(data, function(d) { return d.close; }));

            svg.append("g")
                .attr("class", "x axis")
                .attr("transform", "translate(0," + height + ")")
                .call(xAxis);

            svg.append("g")
                .attr("class", "y axis")
                .call(yAxis)
              .append("text")
                .attr("transform", "rotate(-90)")
                .attr("y", 6)
                .attr("dy", ".71em")
                .style("text-anchor", "end")
                .text("Price ($)");

            svg.append("path")
                .datum(data)
                .attr("class", "line")
                .attr("d", line);
          });

          </script>
        </div>
          <p>Click a thumbnail below to view alternative visualistions.</p>
          <ul id="thumbnails">
            <li><a href="#"><img src="http://donsmaps.com/clickphotos/dolnivi200x100.jpg" width="200" height="100"></img></a></li>
            <li><a href="#"><img src="http://donsmaps.com/clickphotos/dolnivi200x100.jpg" width="200" height="100"></img></a></li>
            <li><a href="#"><img src="http://donsmaps.com/clickphotos/dolnivi200x100.jpg" width="200" height="100"></img></a></li>
          </ul>
        </article>