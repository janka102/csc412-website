window.addEventListener('DOMContentLoaded', function() {
  var colors = [
    '#FFCDD2', '#EF9A9A', // red
    '#E1BEE7', '#CE93D8', // purple
    '#C5CAE9', '#9FA8DA', // indigo
    '#BBDEFB', '#90CAF9', // blue
    '#80DEEA', '#4DD0E1', // cyan
    '#B2DFDB', '#80CBC4', // teal
    '#A5D6A7', '#81C784', // green
    '#AED581', '#9CCC65', // light green
    '#FFEB3B', '#FDD835', // yellow
    '#FFCC80', '#FFB74D', // orange
    '#FFAB91', '#FF8A65', // deep orange
    '#EEEEEE', '#F8F8F8', // grey
    '#CFD8DC', '#B0BEC5' // blue grey
  ]
  var navbar = document.getElementsByTagName('nav')[0]
  var backgroundRandom = document.getElementById('background-random')

  backgroundRandom.addEventListener('click', function() {
    navbar.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)]
  })
})
