
// create some data
var seedData = [{
   "label": "Pending",
   "value": Math.round(Math.random() * 50)
}, {
   "label": "Accepted",
   "value": Math.round(Math.random() * 50)
}, {
   "label": "Rejected",
   "value": Math.round(Math.random() * 50)
}, {
   "label": "No Action",
   "value": Math.round(Math.random() * 50)
}];

// create tooltip
var tooltip = d3.select('#chart')
   .append('div')
   .attr('class','tooltip');

tooltip.append('div')
   .attr('class','label');

tooltip.append('div')
   .attr('class','count');

tooltip.append('div')
   .attr('class','percent');

// setup size of chart
var width = 650,
   height = 200,
   radius = Math.min(width, height) / 2;

// setup colours
var colour = d3.scale.ordinal().range(["#f5a623","#417505","#d0021b","#9b9b9b"]);

// setup size of arcs
var arc = d3.svg.arc()
   .innerRadius(radius - 60)
   .outerRadius(radius - 10);

var pie = d3.layout.pie()
   .value(function(d) {
      return d["value"];
   })
   .sort(null);

var svg = d3.select("#donut-chart")
   .attr("width", width)
   .attr("height", height)
   .append("g")
   .attr("transform", "translate(" + radius + "," + radius + ")");

var g = svg.selectAll(".arc")
   .data(pie(seedData))
   .enter().append("g")
   .attr("class", "arc");

g.append("path")
   .attr("d", arc)
   .attr("fill", function(d, i) {
      return colour(i);
   })
   .transition()
   .ease("exp")
   .duration(2000)
   .attrTween("d", function(d) {
      var i = d3.interpolate({
         startAngle: 1.1*Math.PI, 
         endAngle: 1.1*Math.PI
      }, d);
      return function(t) { 
         return arc(i(t)); }
      ;
   });

g.on('mouseover', function(d) {
   var total = d3.sum(seedData.map(function(d) {
      return d.value;
   }));
   var percent = Math.round(1000 * d.data.value / total) / 10;
   tooltip.select('.label').html(d.data.label);
   tooltip.select('.count').html(d.data.value);
   tooltip.select('.percent').html(percent + '%'); 
   tooltip.style('display', 'block');
});

g.on('mouseout', function(d) {
   tooltip.style('display', 'none');
});

g.on('mousemove', function(d) {
   console.log(radius);
 tooltip.style('top', (d3.event.pageY) + 'px')
    .style('left', (d3.event.offsetX) + 'px');
});

// setup a legend
var legendRectSize = 18;
var legendSpacing = 4;

var legend = svg.selectAll('.legend')
   .data(colour.domain())
   .enter()
   .append('g')
   .attr("class","legend")
   .attr('transform', function(d, i) {
      var height = legendRectSize + legendSpacing;
      var offset = height * colour.domain().length / 2;
      var horz = radius + 25;
      var vert = i * height - offset;
      return 'translate(' + horz + ',' + vert + ')';
   });
legend.append('rect')
  .attr('width', legendRectSize)
  .attr('height', legendRectSize)
  .style('fill', colour)
  .style('stroke', colour);

legend.append('text')
  .attr('x', legendRectSize + legendSpacing)
  .attr('y', legendRectSize - legendSpacing)
  .text(function(d,i) { return seedData[i].label + ' (' + seedData[i].value +')'; });