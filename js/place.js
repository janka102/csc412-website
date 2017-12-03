const placeGrid = document.getElementById('place-grid')
const colorPicker = document.getElementById('color-picker')
const colors = document.getElementById('colors')
let latestTime

var request = new XMLHttpRequest()
request.open('GET', 'place/data.php', true)

request.onload = function() {
  if (this.status >= 200 && this.status < 400) {
    // Success!
    var data = JSON.parse(this.response)
    // console.log(data)
    latestTime = data.latest
    initGrid(data.max_x, data.max_y)
    updateGrid(data.data)
  } else {
    // We reached our target server, but it returned an error
  }
}

request.onerror = function() {
  // There was a connection error of some sort
}

request.send()
initColors()

function initColors() {
  const intervals = 3

  for (let min = 255 - 255 / intervals; min > 0; min -= 255 / intervals) {
    const row = document.createElement('div')
    row.classList.add('grid-row')

    for (let r = intervals * 2, g = 0; r > 0; --r, ++g) {
      const color = document.createElement('span')
      color.classList.add('grid-item')
      const [red, green, blue] = [
        Math.min(r / intervals * (255 - min) + min, 255) | 0,
        Math.min(g / intervals * (255 - min) + min, 255) | 0,
        min
      ]
      color.style.backgroundColor = `rgb(${red},${green},${blue})`
      color.dataset.red = red
      color.dataset.green = green
      color.dataset.blue = blue
      row.appendChild(color)
    }

    for (let g = intervals * 2, b = 0; g > 0; --g, ++b) {
      const color = document.createElement('span')
      color.classList.add('grid-item')
      const [red, green, blue] = [
        min,
        Math.min(g / intervals * (255 - min) + min, 255) | 0,
        Math.min(b / intervals * (255 - min) + min, 255) | 0
      ]
      color.style.backgroundColor = `rgb(${red},${green},${blue})`
      color.dataset.red = red
      color.dataset.green = green
      color.dataset.blue = blue
      row.appendChild(color)
    }

    for (let b = intervals * 2, r = 0; b > 0; --b, ++r) {
      const color = document.createElement('span')
      color.classList.add('grid-item')
      const [red, green, blue] = [
        Math.min(r / intervals * (255 - min) + min, 255) | 0,
        min,
        Math.min(b / intervals * (255 - min) + min, 255) | 0
      ]
      color.style.backgroundColor = `rgb(${red},${green},${blue})`
      color.dataset.red = red
      color.dataset.green = green
      color.dataset.blue = blue
      row.appendChild(color)
    }

    colors.appendChild(row)
  }

  for (let max = 255; max > 0; max -= 255 / intervals) {
    const row = document.createElement('div')
    row.classList.add('grid-row')

    for (let r = intervals * 2, g = 0; r > 0; --r, ++g) {
      const color = document.createElement('span')
      color.classList.add('grid-item')
      const [red, green, blue] = [Math.min(r / intervals * max, max) | 0, Math.min(g / intervals * max, max) | 0, 0]
      color.style.backgroundColor = `rgb(${red},${green},${blue})`
      color.dataset.red = red
      color.dataset.green = green
      color.dataset.blue = blue
      row.appendChild(color)
    }

    for (let g = intervals * 2, b = 0; g > 0; --g, ++b) {
      const color = document.createElement('span')
      color.classList.add('grid-item')
      const [red, green, blue] = [0, Math.min(g / intervals * max, max) | 0, Math.min(b / intervals * max, max) | 0]
      color.style.backgroundColor = `rgb(${red},${green},${blue})`
      color.dataset.red = red
      color.dataset.green = green
      color.dataset.blue = blue
      row.appendChild(color)
    }

    for (let b = intervals * 2, r = 0; b > 0; --b, ++r) {
      const color = document.createElement('span')
      color.classList.add('grid-item')
      const [red, green, blue] = [Math.min(r / intervals * max, max) | 0, 0, Math.min(b / intervals * max, max) | 0]
      color.style.backgroundColor = `rgb(${red},${green},${blue})`
      color.dataset.red = red
      color.dataset.green = green
      color.dataset.blue = blue
      row.appendChild(color)
    }

    colors.appendChild(row)
  }

  colors.childNodes.forEach((row, i) => {
    const color = document.createElement('span')
    color.classList.add('grid-item')
    const gray = (255 * (1 - i / (intervals * 2 - 2))) | 0
    color.style.backgroundColor = `rgb(${gray},${gray},${gray})`
    color.dataset.red = gray
    color.dataset.green = gray
    color.dataset.blue = gray
    row.appendChild(color)
  })

  colors.addEventListener('click', e => {
    const el = e.target

    if (el.tagName !== 'SPAN') {
      return
    }

    const { red, green, blue } = el.dataset
    const { x, y } = el.parentElement.parentElement.dataset
    const item = document.getElementById(`grid_${x}-${y}`)
    item.style.backgroundColor = `rgb(${red}, ${green}, ${blue})`

    // console.log('(%s, %s) rgb(%s, %s, %s)', x, y, red, green, blue)
    colors.classList.remove('pick')

    var request = new XMLHttpRequest()
    request.open('POST', 'place/data.php', true)
    request.setRequestHeader('Content-Type', 'application/json')

    request.onload = function() {
      if (this.status >= 200 && this.status < 400) {
        // Success!
        console.log(this.response)
      } else {
        // We reached our target server, but it returned an error
      }
    }

    request.onerror = function() {
      // There was a connection error of some sort
    }

    request.send(JSON.stringify({ x, y, red, green, blue }))
  })
}

function initGrid(max_x, max_y) {
  for (let y = 0; y <= max_y; ++y) {
    const row = document.createElement('div')
    row.classList.add('grid-row')

    for (let x = 0; x <= max_x; ++x) {
      const item = document.createElement('span')
      item.classList.add('grid-item')
      item.style.backgroundColor = '#000'
      item.id = `grid_${x}-${y}`
      item.dataset.x = x
      item.dataset.y = y
      row.appendChild(item)
    }
    placeGrid.appendChild(row)
  }

  placeGrid.addEventListener('click', e => {
    const el = e.target
    colors.classList.add('pick')
    colors.dataset.x = el.dataset.x
    colors.dataset.y = el.dataset.y
  })

  setInterval(() => {
    var request = new XMLHttpRequest()
    request.open('GET', `place/data.php?latest=${latestTime}`, true)

    request.onload = function() {
      if (this.status >= 200 && this.status < 400) {
        // Success!
        var data = JSON.parse(this.response)
        latestTime = data.latest
        updateGrid(data.data)
      } else {
        // We reached our target server, but it returned an error
      }
    }

    request.onerror = function() {
      // There was a connection error of some sort
    }

    request.send()
  }, 5000)
}

function updateGrid(data) {
  for (const row of data) {
    const { x, y, red, green, blue } = row
    const el = document.getElementById(`grid_${x}-${y}`)
    el.style.backgroundColor = `rgb(${red}, ${green}, ${blue})`
  }
}
