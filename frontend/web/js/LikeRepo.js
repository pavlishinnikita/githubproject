$('.repo-like').on('click', function (e) {
    console.log($(e.target).parent().data('id'));
    $.ajax({
        method: 'POST',
        url: "/user/like",
        data: {
            repo_id: $(e.target).parent().data('id')
        },
        success: function (res) {
            var disLike = document.createElement("div");
            disLike.setAttribute('class', res);
            e.target.replaceWith(disLike);
        },
        error: function (res) {
            console.log(res);
        }
    });
});
$('.repo-dislike').on('click', function (e) {
    $.ajax({
        method: 'POST',
        url: "/user/like",
        data: {
            repo_id: $(e.target).parent().data('id')
        },
        success: function (res) {
            var disLike = document.createElement("div");
            disLike.setAttribute('class', res);
            e.target.replaceWith(disLike);
        },
        error: function (res) {
            console.log(res);
        }
    });
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