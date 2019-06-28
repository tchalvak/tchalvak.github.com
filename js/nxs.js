/* global $ */
// eslint-disable-next-line no-unused-vars
function repositoryLoad() {
    var limit = 20 // how many repos to list
    var login = 'tchalvak' // your username

    $.getJSON(
        'http://github.com/api/v1/json/' + login + '?callback=?',
        function(data) {
            var repos = $.grep(data.user.repositories, function() {
                return !this.fork
            })

            repos.sort(function(a, b) {
                return b.watchers - a.watchers
            })

            $.each(repos.slice(0, limit), function() {
                $('#repos').append(
                    '<li><a href="' + this.url + '">' + this.name + '</a></li>'
                )
            })
        }
    )

    $('#waiting').hide() // Hide the not yet loaded message.
} // End of repositoryLoad function.

function loadLastCommitMessage() {
    var login = 'tchalvak' // your username

    $.getJSON(
        'http://github.com/api/v1/json/' +
            login +
            '/ninjawars/commit/master/?callback=?',
        function(data) {
            $.grep(data.commit, function() {
                return true
            })

            // Load latest commit message.
            $('#latest-commit').html(data.commit.message)
            $('#latest-commit').append(
                '<div id=\'commit-author\'>--' +
                    data.commit.author.name +
                    '</div>'
            )
            $('#latest-commit-title').show()
            $('#latest-commit').show()
        }
    )
}

// eslint-disable-next-line no-unused-vars
function toggleDialog(el) {
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

$(document).ready(function() {
    // IIFE to allow dialog elements to work automatically with their sibling buttons
    $('button[data-control=dialog]').click(function() {
        // Toggle first sibling dialog
        var $dialog = $(this)
            .siblings('dialog')
            .first()
        console.assert(!!$dialog.get())
        var next = $dialog.prop('open') === false
        $dialog.prop('open', next)
    })

    $('#latest-commit').hide()
    $('#latest-commit-title').hide()

    var main = $('#main-body')
    if (main.width() > 1000) {
        // Optimally, this should only happen for computer browsers and not handheld.
        loadLastCommitMessage()
        main.addClass('large-body')
    } else {
        // For smallscreens, nullify target= attributes.
        $('a[target]').attr('target', '')
    }
})
