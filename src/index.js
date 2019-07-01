import _ from 'lodash'
import startApp from './nxs'

function coreComponent() {
    const elem = document.createElement('div')
    elem.className = 'final'
    elem.innerHTML = _.join(['Fin', ''], ' ')

    return elem
}

// Start up the app and initialize, with a final callback
startApp(function(){
    document.body.appendChild(coreComponent())
})