/* global $ */
/*  Application Core Runner */
import ready from './ready'
import { loadLastCommitMessage } from './repository'
import dialogPolyfill from 'dialog-polyfill'

// Set sibling dialog elements to open 
// eslint-disable-next-line no-unused-vars
function toggleableDialog(el) {
    $(el)
        .siblings()
        .find('button')
        .first()
        .click(function(el) {
            var dialog = $(el)
                .siblings()
                .find('dialog')
            dialog.attr('open', dialog.attr('open') === 'false')
        })
}

// Foreach Hack for now
var forEach = function (array, callback, scope) {
    for (var i = 0; i < array.length; i++) {
        callback.call(scope, i, array[i]) // passes back stuff we need
    }
}

function fixDialogs(){
    // Poly-fill the dialog components?
    //var dialog = document.querySelector('dialog')
    //dialogPolyfill.registerDialog(dialog)

    forEach(document.querySelectorAll('dialog'), function (index, dialog){
        dialogPolyfill.registerDialog(dialog)
        var dialogToggler = function(dialog){
            return function(){
                dialog.open = !dialog.open
            }
        }
        var toggler = document.querySelector('#'+dialog.dataset.control)
        toggler.onclick = dialogToggler(dialog)
    })

    // IIFE to allow dialog elements to work automatically with their sibling buttons
    /*
    $('button[data-control=dialog]').click(function() {
        // Toggle first sibling dialog
        var $dialog = $(this)
            .siblings('dialog')
            .first()
        // eslint-disable-next-line no-console
        console.assert(!!$dialog.get())
        var next = $dialog.prop('open') === false
        $dialog.prop('open', next)
    })
    */
}

// For small screens
function initSmallScreens(){
    // nullify target= attributes to prevent excess tab opening on mobile
    $('a[target]').attr('target', '')
}

// Optimally, this should only happen for computer browsers and not handheld.
function initNonSmallScreens(){
    loadLastCommitMessage()
}

/** Code to actually start up the application */
var startApp = function(cb){
    ready(function(){  // Wait for domready
        fixDialogs()
        
        // Hide commits by default
        $('#latest-commit').hide()
        $('#latest-commit-title').hide()

        // Large and small screen hacks
        var main = $('#main-body')
        if (main.width() <= 1000) {
            main.addClass('large-body')
            initNonSmallScreens()
        } else { // Default mobile first
            initSmallScreens()
        }
        if(typeof cb === 'function'){
            cb()
        }
    })
}

export default startApp