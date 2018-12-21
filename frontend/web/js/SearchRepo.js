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
            console.log(res);
            $('.content-container').html(res);
        },
        error: function (res) {
            console.log(res);
        }
    });
    return false;
});
// $(document).on('beforeSubmit', "#search-form", function (e) {
//     e.preventDefault();
//     return false;
// });