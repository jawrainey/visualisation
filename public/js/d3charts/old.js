

    var width = 650,
        height = 200

        
    //color function used to color nodes
    var fill = d3.scale.category20();
    var tooltip =  tooltip = Tooltip("vis-tooltip", 230);    
    
    var showInfo = function(d, i)
    {
        var content, infoDiv;
        infoDiv = d3.select("#info");
        content = "<ul>";
        content += "  <li>Location: " + d.name + "</li>";
        content += "  <li>Group: " + d.group + "</li>";
        content += "</ul>";
        return infoDiv.html(content);
    };

var showDetails = function(d, i)
{
    var content;
    content = '<p class="main">' + d.name + '</span></p>';
    content += '<hr class="tooltip-hr">';
    content += '<p class="main">' + d.datetime + '</span></p>';
    tooltip.showTooltip(content, d3.event);
    
    if (link)
    {
      link.attr("stroke", function(l)
      {
        if (l.source === d || l.target === d) {
          console.log(d.name);
          return "#555";
        } else {
          return "#ddd";
        }
      }).attr("stroke-opacity", function(l) {
        if (l.source === d || l.target === d) {
          return 1.0;
        } else {
          return 0.5;
        }
      });
    }
    node.style("stroke", function(n) {
      if (n.searched || neighboring(d, n)) {
        return "#555";
      } else {
        return strokeFor(n);
      }
    }).style("stroke-width", function(n) {
      if (n.searched || neighboring(d, n)) {
        return 2.0;
      } else {
        return 1.0;
      }
    });
    return d3.select(this).style("stroke", "black").style("stroke-width", 2.0);
  };

  var hideDetails = function(d, i) {
    tooltip.hideTooltip();
    node.style("stroke", function(n) {
      if (!n.searched) {
        return strokeFor(n);
      } else {
        return "#555";
      }
    }).style("stroke-width", function(n) {
      if (!n.searched) {
        return 1.0;
      } else {
        return 2.0;
      }
    });
    if (link) {
      return link.attr("stroke", "#ddd").attr("stroke-opacity", 0.8);
    }
  };

    var vis = d3.select('#vis')
        .append('svg:svg')
        //.attr('width', width)
        //.attr('height', height);
        //better to keep the viewBox dimensions with variables
        .attr("viewBox", "0 0 " + width + " " + height )
        .attr("preserveAspectRatio", "xMidYMid meet");
    
  // Initialise the graph object
    var graph = {
"nodes": [ 
  {"name":"RT @example: This Olympics is uniting our nation. My twitter feed is a beautiful long list of positivity. Proud of #TeamGB","group":1},{"location":"West Sussex ","group":2},{"location":"Hogwarts, Essex","group":2},{"location":"Disturbin London","group":2},{"location":"gallifrey","group":2},{"location":"North West Coast England","group":2},{"location":"my own little world :)","group":2},{"location":"Compton Martin","group":2},{"location":"County Durham, England","group":2},{"location":"Standing on the yellow line","group":2},{"location":"UK, Milton Keynes","group":2},{"location":"England :)","group":2},{"location":"Worcester, UK","group":2},{"location":"Maidenhead","group":2},{"location":"island in the redverse","group":2},{"location":"A mix between Plymouth & Essex","group":2},{"location":"Cardiff","group":2},{"location":"UK","group":2},{"location":"London","group":2},{"location":"Wales.","group":2},{"location":"London","group":2},{"location":"Crewe, England","group":2},{"location":"Essex","group":2},{"location":"Sheffield\/Stoke-on-Trent ","group":2},{"location":"London","group":2},{"location":"Kent","group":2},{"location":"Luton","group":2},{"location":"Surrey & Berkshire UK","group":2},{"location":"Bath, UK","group":2},{"location":"Robert Pattinson's bedroom","group":2},{"location":"Abergavenny","group":2},{"location":"Abergavenny","group":2},{"datetime":"0 hours, 0 minutes, 0 seconds","location":"West Sussex ","group":3},{"datetime":"0 hours, 0 minutes, 28 seconds","location":"Hogwarts, Essex","group":3},{"datetime":"0 hours, 0 minutes, 33 seconds","location":"Disturbin London","group":3},{"datetime":"0 hours, 0 minutes, 33 seconds","location":"gallifrey","group":3},{"datetime":"0 hours, 0 minutes, 36 seconds","location":"North West Coast England","group":3},{"datetime":"0 hours, 0 minutes, 55 seconds","location":"my own little world :)","group":3},{"datetime":"0 hours, 1 minutes, 9 seconds","location":"Compton Martin","group":3},{"datetime":"0 hours, 1 minutes, 37 seconds","location":"County Durham, England","group":3},{"datetime":"0 hours, 1 minutes, 42 seconds","location":"Standing on the yellow line","group":3},{"datetime":"0 hours, 2 minutes, 20 seconds","location":"UK, Milton Keynes","group":3},{"datetime":"0 hours, 2 minutes, 20 seconds","location":"England :)","group":3},{"datetime":"0 hours, 2 minutes, 34 seconds","location":"Worcester, UK","group":3},{"datetime":"0 hours, 2 minutes, 36 seconds","location":"Maidenhead","group":3},{"datetime":"0 hours, 2 minutes, 56 seconds","location":"island in the redverse","group":3},{"datetime":"0 hours, 2 minutes, 58 seconds","location":"A mix between Plymouth & Essex","group":3},{"datetime":"0 hours, 3 minutes, 1 seconds","location":"Cardiff","group":3},{"datetime":"0 hours, 3 minutes, 30 seconds","location":"UK","group":3},{"datetime":"0 hours, 3 minutes, 31 seconds","location":"London","group":3},{"datetime":"0 hours, 3 minutes, 47 seconds","location":"Wales.","group":3},{"datetime":"0 hours, 6 minutes, 1 seconds","location":"London","group":3},{"datetime":"0 hours, 6 minutes, 24 seconds","location":"Crewe, England","group":3},{"datetime":"0 hours, 7 minutes, 13 seconds","location":"Essex","group":3},{"datetime":"0 hours, 7 minutes, 13 seconds","location":"Sheffield\/Stoke-on-Trent ","group":3},{"datetime":"0 hours, 14 minutes, 36 seconds","location":"London","group":3},{"datetime":"0 hours, 21 minutes, 8 seconds","location":"Kent","group":3},{"datetime":"0 hours, 24 minutes, 40 seconds","location":"Luton","group":3},{"datetime":"0 hours, 26 minutes, 30 seconds","location":"Surrey & Berkshire UK","group":3},{"datetime":"0 hours, 35 minutes, 59 seconds","location":"Bath, UK","group":3},{"datetime":"0 hours, 48 minutes, 11 seconds","location":"Robert Pattinson's bedroom","group":3},{"datetime":"0 hours, 48 minutes, 43 seconds","location":"Abergavenny","group":3},{"datetime":"0 hours, 48 minutes, 43 seconds","location":"Abergavenny","group":3}
 
  ],
  "links": [{"source":0,"target":0},{"source":1,"target":0},{"source":2,"target":0},{"source":3,"target":0},{"source":4,"target":0},{"source":5,"target":0},{"source":6,"target":0},{"source":7,"target":0},{"source":8,"target":0},{"source":9,"target":0},{"source":10,"target":0},{"source":11,"target":0},{"source":12,"target":0},{"source":13,"target":0},{"source":14,"target":0},{"source":15,"target":0},{"source":16,"target":0},{"source":17,"target":0},{"source":18,"target":0},{"source":19,"target":0},{"source":20,"target":0},{"source":21,"target":0},{"source":22,"target":0},{"source":23,"target":0},{"source":24,"target":0},{"source":25,"target":0},{"source":26,"target":0},{"source":27,"target":0},{"source":28,"target":0},{"source":29,"target":0},{"source":30,"target":0},{"source":31,"target":0},{"source":32,"target":1},{"source":33,"target":2},{"source":34,"target":3},{"source":35,"target":4},{"source":36,"target":5},{"source":37,"target":6},{"source":38,"target":7},{"source":39,"target":8},{"source":40,"target":9},{"source":41,"target":10},{"source":42,"target":11},{"source":43,"target":12},{"source":44,"target":13},{"source":45,"target":14},{"source":46,"target":15},{"source":47,"target":16},{"source":48,"target":17},{"source":49,"target":18},{"source":50,"target":19},{"source":50,"target":1},{"source":52,"target":20},{"source":53,"target":21},{"source":54,"target":22},{"source":54,"target":1},{"source":56,"target":23},{"source":57,"target":24},{"source":58,"target":25},{"source":59,"target":26},{"source":60,"target":27},{"source":61,"target":28},{"source":61,"target":1}]
    };

 charge = function(node) {
    return -Math.pow(node.radius, 2.0) / 2;
  };

      var force = d3.layout.force()
        .charge(-150)
        .distance(30)  
        .gravity(.1)
        .nodes(graph.nodes)
        .links(graph.links)
        .size([width, height])
        .start();
        
      var link = vis.selectAll('line.link')
        .data(graph.links)
        .enter().append('svg:line')
        .attr("class", "link")
        .attr("stroke", "#ddd")
        .attr("stroke-opacity", 0.5)  
        .style('stroke-width', 3);

      var node = vis.selectAll("circle.node")
          .data(graph.nodes)
          .enter().append("svg:circle")
          .attr("class", "node")
          .attr("r", function(d) { return (d.group == 1 || d.group == 2) ? 8: 5})
          .style("fill", function(d) { return fill(d.group); })
          .call(force.drag);


      node.append('svg:title')
          .text(function(d) { return d.name; });

      force.on("tick", function(e)
      { 
        
        link.attr("x1", function(d) { return d.source.x; })
            .attr("y1", function(d) { return d.source.y; })
            .attr("x2", function(d) { return d.target.x; })
            .attr("y2", function(d) { return d.target.y; });
      
        node.attr("cx", function(d) { return d.x ; })
            .attr("cy", function(d) { return d.y; });
      
      });

    node.on("mouseover", showDetails)
        .on("mouseout", hideDetails)
        .on("click", showInfo)
    
