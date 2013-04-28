//Simplified version of Mike Bostock's (the creator of D3) reusable chart recommendations using closures
//see: http://bost.ocks.org/mike/chart/
//Main network code will be encapsulated in a function,
//with getters and setters to allow interaction with the code from outside.    
function Network()
{
    //global variables
    var width  = 500,
        height = 200,
        linksG = null, //contains individual lines (edges)
        nodesG = null; //contains individual circles (nodes)

        force      = d3.layout.force();
        nodeColors = d3.scale.category20();
        tooltip    = Tooltip("vis-tooltip", 230);

    charge = function(node) { return -Math.pow(node.radius, 2.0) / 2; };

    // generate chart here, using `width` and `height`
    function network(selection, datum)
    {
        console.log(selection);
        console.log(datum);
        console.log(linksG);

        var fill = d3.scale.category20();
        var vis  = d3.select(selection)
                    .append("svg")
                    .attr('width', width)
                    .attr('height', height);
                    //better to keep the viewBox dimensions with variables
                    //.attr("viewBox", "0 0 " + width + " " + height )
                    //.attr("preserveAspectRatio", "xMidYMid meet");
        //setLayout("force").start();






















      var force = d3.layout.force()
        .charge(-150)
        .distance(30)  
        .gravity(.1)
        .nodes(datum.nodes)
        .links(datum.links)
        .size([width, height])
        .start();

      var link = vis.selectAll('line.link')
        .data(datum.links)
        .enter().append('svg:line')
        .attr("class", "link")       
        .style('stroke-width', 3);

      var node = vis.selectAll("circle.node")
          .data(datum.nodes)
          .enter().append("svg:circle")
          .attr("class", "node")
          .attr("r", function(d) { return (d.group == 1 || d.group == 2) ? 8: 5})
          .style("fill", function(d) { return fill(d.group); });

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

    }

    setLayout = function(newLayout)
    {
        //Could add more layouts (radical etc) using an if statement. - future proofing
        return force.on("tick", forceTick).charge(-200).linkDistance(50);
    };
    
    function forceTick(e)
    {
        link.attr("x1", function(d) { return d.source.x; })
            .attr("y1", function(d) { return d.source.y; })
            .attr("x2", function(d) { return d.target.x; })
            .attr("y2", function(d) { return d.target.y; });
      
        node.attr("cx", function(d) { return d.x; })
            .attr("cy", function(d) { return d.y; });
    }




















































    strokeFor = function(d)
    {
        return d3.rgb(nodeColors(d.group)).darker().toString();
    };

    showDetails = function(d, i)
    {
        var content;
        
        content = '<p class="main">' + d.name + '</span></p>';
        content += '<hr class="tooltip-hr">';
        content += '<p class="main">' + d.group + '</span></p>';
        tooltip.showTooltip(content, d3.event);

        if (link)
        {
            link.attr("stroke", function(l)
            {
                if (l.source === d || l.target === d)
                {
                    return "#555";
                } else {
                    return "#ddd";
            }
            }).attr("stroke-opacity", function(l)
            {
                if (l.source === d || l.target === d)
                {
                    return 1.0;
                } else {
                    return 0.5;
                }
            });
        }

        node.style("stroke", function(n)
        {
            return strokeFor(n);
        }).style("stroke-width", function(n)
        {
            return 1.0;

        });
        return d3.select(this).style("stroke", "black").style("stroke-width", 2.0);
    };

    hideDetails = function(d, i)
    {
        tooltip.hideTooltip();
        node.style("stroke", function(n)
        {
            return "#555";
        }).style("stroke-width", function(n) { return 2.0; });
    
        if (link)
        {
            return link.attr("stroke", "#ddd").attr("stroke-opacity", 0.8);
        }
    };
    return network;

}



