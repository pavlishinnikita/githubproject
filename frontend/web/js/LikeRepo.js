$('.repo-like').on('click', function (e) {
    console.log($(e.target).parent().data('id'));
    // console.log($(this).data('id'));
    console.log("test-like");
    $.ajax({
        method: 'POST',
        url: "/user/like",
        data: {
            repo_id: $(e.target).parent().data('id')
        },
        success: function (res) {
            console.log(res);
            // this.replaceWith(res);
        },
        error: function (res) {
            console.log(res);
        }
    });
});
$('.repo-dislike').on('click', function (e) {
    // console.log($(this).data('id'));
    console.log($(e.target).parent().data('id'));
    console.log("test-dislike");
});


// $('.repo-list-item').on('click', function (e) {
    // if(e.target == $('.repo-like')) {
    //     console.log("Like");
    // } else if(e.target == $('.repo-dislike')) {
    //     console.log("Like");
    // } else {
    //     return false;
    // }
// });