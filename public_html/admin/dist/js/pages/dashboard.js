/*
 * Author: Abdullah A Almsaeed
 * Date: 4 Jan 2014
 * Description:
 *      This is a demo file used only for the main dashboard (index.html)
 **/

/* global moment:false, Chart:false, Sparkline:false */

$(function () {
  'use strict'

  // Make the dashboard widgets sortable Using jquery UI
  $('.connectedSortable').sortable({
    placeholder: 'sort-highlight',
    connectWith: '.connectedSortable',
    handle: '.card-header, .nav-tabs',
    forcePlaceholderSize: true,
    zIndex: 999999
  })
  $('.connectedSortable .card-header').css('cursor', 'move')

  // jQuery UI sortable for the todo list
  $('.todo-list').sortable({
    placeholder: 'sort-highlight',
    handle: '.handle',
    forcePlaceholderSize: true,
    zIndex: 999999
  })

  // bootstrap WYSIHTML5 - text editor
  $('.textarea').summernote()

  $('.daterange').daterangepicker({
    ranges: {
      Today: [moment(), moment()],
      Yesterday: [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days': [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month': [moment().startOf('month'), moment().endOf('month')],
      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment().subtract(29, 'days'),
    endDate: moment()
  }, function (start, end) {
    // eslint-disable-next-line no-alert
    alert('You chose: ' + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
  })

  /* jQueryKnob */
  $('.knob').knob()

  // jvectormap data
  var visitorsData = {
    US: 398, // USA
    SA: 400, // Saudi Arabia
    CA: 1000, // Canada
    DE: 500, // Germany
    FR: 760, // France
    CN: 300, // China
    AU: 700, // Australia
    BR: 600, // Brazil
    IN: 800, // India
    GB: 320, // Great Britain
    RU: 3000 // Russia
  }
  // World map by jvectormap
  $('#world-map').vectorMap({
    map: 'usa_en',
    backgroundColor: 'transparent',
    regionStyle: {
      initial: {
        fill: 'rgba(255, 255, 255, 0.7)',
        'fill-opacity': 1,
        stroke: 'rgba(0,0,0,.2)',
        'stroke-width': 1,
        'stroke-opacity': 1
      }
    },
    series: {
      regions: [{
        values: visitorsData,
        scale: ['#ffffff', '#0154ad'],
        normalizeFunction: 'polynomial'
      }]
    },
    onRegionLabelShow: function (e, el, code) {
      if (typeof visitorsData[code] !== 'undefined') {
        el.html(el.html() + ': ' + visitorsData[code] + ' new visitors')
      }
    }
  })

  // Sparkline charts
  // The Calender
  $('#calendar').datetimepicker({
    format: 'L',
    inline: true
  })

  // SLIMSCROLL FOR CHAT WIDGET
  $('#chat-box').overlayScrollbars({
    height: '250px'
  })

  /* Chart.js Charts */
  // Sales chart
  var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d')
  var salesChartCanvas2 = document.getElementById('revenue-chart-canvas2').getContext('2d')
  var salesChartCanvas3 = document.getElementById('revenue-chart-canvas3').getContext('2d')
  var salesChartCanvas4 = document.getElementById('revenue-chart-canvas4').getContext('2d')
  // $('#revenue-chart').get(0).getContext('2d');

  var salesChartData = {
    labels: labelVentas,
    datasets: [
      {
        label               : 'Venta por dia',
        data                : datosVentas,
        backgroundColor     : 'rgba(40,167,69, 0.2)',
        borderColor         : '#28a745'
      },
      {
        label               : '$ por dia',
        data                : datosVentas2,
        backgroundColor     : 'rgba(23,162,184, 0.2)',
        borderColor         : '#17a2b8'
      }
    ]
  }

  var salesChartData2 = {
    labels: labelVentas,
    datasets: [
      {
        label               : 'Ventas por dia',
        data                : diaVentas,
        backgroundColor     : 'rgba(23,162,184, 0.2)',
        borderColor         : '#17a2b8'
      }
    ]
  }

  var salesChartData3 = {
    labels: labelProducto,
    datasets: [
      {
        data                : datosProducto,
        backgroundColor: ['#28a745', '#17a2b8', '#ffc107', '#dc3545', '#ff5733', '#daf7a6', '#dc7633', '#af7ac5', '#e74c3c', '#99a3a4']
      }
    ]
  }

  var salesChartData4 = {
    labels: ['Usuarios','Clientes'],
    datasets: [
      {
        data                : datosClientes,
        backgroundColor     : ['#28a745', '#17a2b8']
      }
    ]
  }

  var salesChartOptions = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines: {
          display: true
        }
      }],
      yAxes: [{
        gridLines: {
          display: true
        }
      }]
    }
  }

  var pieOptions = {
    legend: {
      display: true
    },
    maintainAspectRatio: false,
    responsive: true
  }

  var pieOptions2 = {
    legend: {
      display: false
    },
    maintainAspectRatio: false,
    responsive: true
  }

  // This will get the first returned node in the jQuery collection.
  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart(salesChartCanvas, { // lgtm[js/unused-local-variable]
    type: 'line',
    data: salesChartData,
    options: salesChartOptions
  })

  var salesChart2 = new Chart(salesChartCanvas2, { // lgtm[js/unused-local-variable]
    type: 'line',
    data: salesChartData2,
    options: salesChartOptions
  })

  var salesChart3 = new Chart(salesChartCanvas3, { // lgtm[js/unused-local-variable]
    type: 'horizontalBar',
    data: salesChartData3,
    options: pieOptions2
  })

  var salesChart4 = new Chart(salesChartCanvas4, { // lgtm[js/unused-local-variable]
    type: 'pie',
    data: salesChartData4,
    options: pieOptions
  })


  // Donut Chart


})
