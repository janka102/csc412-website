const placeGrid = document.getElementById('place-grid')
const colorPicker = document.getElementById('color-picker')
const colors = document.getElementById('colors')

var request = new XMLHttpRequest()
request.open('GET', 'place/data.php', true)

request.onload = function() {
  if (this.status >= 200 && this.status < 400) {
    // Success!
    var data = JSON.parse(this.response)
    console.log(data)
    initGrid(data.max_x, data.max_y)
    updateGrid(data.data)
    initColors()
  } else {
    // We reached our target server, but it returned an error
  }
}

request.onerror = function() {
  // There was a connection error of some sort
}

request.send()

function initColors() {
  const intervals = 5

  for (let min = 255 - 255 / intervals; min > 0; min -= 255 / intervals) {
    const row = document.createElement('div')

    for (let r = intervals * 2, g = 0; r > 0; --r, ++g) {
      const color = document.createElement('span')
      const [red, green, blue] = [(r / intervals * (255 - min) + min) | 0, (g / intervals * (255 - min) + min) | 0, min]
      color.style.backgroundColor = `rgb(${red},${green},${blue})`
      row.appendChild(color)
    }

    for (let g = intervals * 2, b = 0; g > 0; --g, ++b) {
      const color = document.createElement('span')
      const [red, green, blue] = [min, (g / intervals * (255 - min) + min) | 0, (b / intervals * (255 - min) + min) | 0]
      color.style.backgroundColor = `rgb(${red},${green},${blue})`
      row.appendChild(color)
    }

    for (let b = intervals * 2, r = 0; b > 0; --b, ++r) {
      const color = document.createElement('span')
      const [red, green, blue] = [(r / intervals * (255 - min) + min) | 0, min, (b / intervals * (255 - min) + min) | 0]
      color.style.backgroundColor = `rgb(${red},${green},${blue})`
      row.appendChild(color)
    }

    colors.appendChild(row)
  }

  for (let max = 255; max > 0; max -= 255 / intervals) {
    const row = document.createElement('div')

    for (let r = intervals * 2, g = 0; r > 0; --r, ++g) {
      const color = document.createElement('span')
      const [red, green, blue] = [Math.min(r / intervals * max, max) | 0, Math.min(g / intervals * max, max) | 0, 0]
      color.style.backgroundColor = `rgb(${red},${green},${blue})`
      row.appendChild(color)
    }

    for (let g = intervals * 2, b = 0; g > 0; --g, ++b) {
      const color = document.createElement('span')
      const [red, green, blue] = [0, Math.min(g / intervals * max, max) | 0, Math.min(b / intervals * max, max) | 0]
      color.style.backgroundColor = `rgb(${red},${green},${blue})`
      row.appendChild(color)
    }

    for (let b = intervals * 2, r = 0; b > 0; --b, ++r) {
      const color = document.createElement('span')
      const [red, green, blue] = [Math.min(r / intervals * max, max) | 0, 0, Math.min(b / intervals * max, max) | 0]
      color.style.backgroundColor = `rgb(${red},${green},${blue})`
      row.appendChild(color)
    }

    colors.appendChild(row)
  }

  colors.childNodes.forEach((row, i) => {
    const color = document.createElement('span')
    const gray = (255 * (1 - i / (intervals * 2 - 2))) | 0
    color.style.backgroundColor = `rgb(${gray},${gray},${gray})`
    row.appendChild(color)
  })
}

function initGrid(max_x, max_y) {
  for (let x = 0; x <= max_x; ++x) {
    const row = document.createElement('div')
    row.classList.add('place-grid-row')
    for (let y = 0; y <= max_y; ++y) {
      const item = document.createElement('span')
      item.classList.add('place-grid-item')
      item.style.backgroundColor = '#000'
      item.id = `grid_${x}-${y}`
      item.dataset.x = x
      item.dataset.y = y
      row.appendChild(item)
    }
    placeGrid.appendChild(row)
  }

  placeGrid.addEventListener('click', e => console.log(e.target))
}

function updateGrid(data) {
  for (const row of data) {
    const { x, y, red, green, blue } = row
    const el = document.getElementById(`grid_${x}-${y}`)
    el.style.backgroundColor = `rgb(${red}, ${green}, ${blue})`
  }
}
