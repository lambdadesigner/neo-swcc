
// create some data
var seedData = [{
   "label": "January",
   "value": Math.round(50)
}, {
   "label": "February",
   "value": Math.round(50)
}, {
   "label": "March",
   "value": Math.round(50)
}, {
   "label": "April",
   "value": Math.round(50)
}, {
   "label": "May",
   "value": Math.round(50)
}, {
   "label": "June",
   "value": Math.round(50)
}, {
   "label": "July",
   "value": Math.round(50)
}, {
   "label": "August",
   "value": Math.round(50)
}, {
   "label": "September",
   "value": Math.round(50)
}, {
   "label": "October",
   "value": Math.round(50)
}, {
   "label": "November",
   "value": Math.round(50)
}, {
   "label": "December",
   "value": Math.round(50)
}];

// create tooltip
var tooltip = d3.select('#chart')
   .append('div')
   .attr('class','dtooltip');

tooltip.append('div')
   .attr('class','label');

tooltip.append('div')
   .attr('class','count');

tooltip.append('div')
   .attr('class','percent');

// setup size of chart
var width = 850,
   height = 400,
   radius = Math.min(width, height) / 2;

// setup colours
var colour = d3.scale.ordinal().range(["#e24b77","#fcb41d","#3db880","#3a90c0","#4c77ba","#9460c9","#e85949","#779b24","#ffaebc","#aa79c7","#ea4d41","#5fccca"]);

// setup size of arcs
var arc = d3.svg.arc()
   .innerRadius(radius - 150)
   .outerRadius(radius - 50);

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
         startAngle: 1.1+Math.PI, 
         endAngle: 1.1+Math.PI
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
 tooltip.style('top', (d3.event.pageY)/3 + 'px')
    .style('left', (d3.event.offsetX) + 'px');
});

// setup a legend
var legendRectSize = 20;
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

