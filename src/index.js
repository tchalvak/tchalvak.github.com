import _ from 'lodash'
import dialogPolyfill from 'dialog-polyfill'

function coreComponent() {
    const elem = document.createElement('div')
    elem.className = 'final'
    elem.innerHTML = _.join(['Fin', ''], ' ')

    // Poly-fill the dialog components?
    //var dialog = document.querySelector('dialog')
    //dialogPolyfill.registerDialog(dialog)


    return elem
}

document.body.appendChild(coreComponent())