import { join as _join } from 'lodash'
import startApp from './nxs'

function coreComponent() {
    const elem = document.createElement('div')
    elem.className = 'final'
    //elem.innerHTML = _join(['Fin', ''], ' ')

    return elem
}

// Start up the app and initialize, with a final callback
startApp(function(){
    document.body.appendChild(coreComponent())
})
