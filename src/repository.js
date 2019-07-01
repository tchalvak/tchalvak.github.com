/* global $ */


// eslint-disable-next-line no-unused-vars
export function repositoryLoad() {
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

export function loadLastCommitMessage() {
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