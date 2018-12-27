// $('#search-form').on('submit', function (e) {
//     console.log("test");
//     e.preventDefault();
//     return false;
// });
$('#bth-search').on('click', function (e) {
    e.preventDefault();
    var name = $('#repoName').val();
    $.ajax({
        type: 'GET',
        url: '/user/search',
        data: {
            'repoName' : name
        },
        //url: 'https://api.github.com/search/repositories',
        //data: "q=" + name + "&sort=stars&order=desc",
        success: function (res) {
            $('.content-container').replaceWith(res);
        },
        error: function (res) {
            console.log(res);
        }
    });
    return false;
});