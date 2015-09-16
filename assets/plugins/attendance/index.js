Chart.defaults.global.animationEasing        = 'easeInOutQuad',
Chart.defaults.global.responsive             = true;
Chart.defaults.global.scaleOverride          = true;
Chart.defaults.global.scaleShowLabels        = false;
Chart.defaults.global.scaleSteps             = 10;
Chart.defaults.global.scaleStepWidth         = 10;
Chart.defaults.global.scaleStartValue        = 0;
Chart.defaults.global.tooltipFontFamily      = 'Open Sans';
Chart.defaults.global.tooltipFillColor       = '#FFFFFF';
Chart.defaults.global.tooltipFontColor       = '#6E6E6E';
Chart.defaults.global.tooltipCaretSize       = 0;
Chart.defaults.global.maintainAspectRatio    = true;

Chart.defaults.Line.scaleShowHorizontalLines = false;
Chart.defaults.Line.scaleShowHorizontalLines = false;
Chart.defaults.Line.scaleGridLineColor       = '#55505C';
Chart.defaults.Line.scaleLineColor           = '#55505C';

var chart    = document.getElementById('chart').getContext('2d'),
    gradient = chart.createLinearGradient(0, 0, 0, 450);

var data  = {
    labels: [ 'Jan', 'Feb', 'Mar', 'Apr', 'May' ],

    datasets: [
        {
          label: 'Custom Label Name',
          fillColor: gradient,
          strokeColor: '#FC2525',
          pointColor: 'white',
          pointStrokeColor: 'rgba(220,220,220,1)',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data: [85, 59, 80, 95, 56]
        }
    ]
};

gradient.addColorStop(0, 'rgba(255, 0,0, 0.5)');
gradient.addColorStop(0.5, 'rgba(255, 0, 0, 0.25)');
gradient.addColorStop(1, 'rgba(255, 0, 0, 0)');

var chart = new Chart(chart).Line(data);