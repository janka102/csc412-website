window.addEventListener('DOMContentLoaded', function() {
  var colors = [
    '#B71C1C', // red
    '#4A148C', // purple
    '#1A237E', // indigo
    '#0D47A1', // blue
    '#006064', // cyan
    '#004D40', // teal
    '#1B5E20', // green
    '#33691E', // light green
    '#F57F17', // yellow
    '#E65100', // orange
    '#BF360C', // deep orange
    '#212121', // grey
    '#263238', // blue grey
    '#343a40'  // default
  ]
  var navbar = document.getElementsByTagName('nav')[0]
  var backgroundRandom = document.getElementById('background-random')

  backgroundRandom.addEventListener('click', function() {
    navbar.style.cssText += 'background-color:' + colors[Math.floor(Math.random() * colors.length)] + ' !important'
  })
})
