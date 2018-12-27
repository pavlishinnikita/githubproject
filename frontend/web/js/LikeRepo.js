/**
 * Функция для обобщения запроса на сервер и совершения лайка/дизлайка
 * @param action - выполняемое действие
 * @param e - html объект с данными
 */
function ajaxLikeDislike(action, e) {
    $.ajax({
        method: 'POST',
        url: action,
        data: {
            repo_id: $(e.target).parent().data('id'),
            repo_name: $(e.target).prev().html()
        },
        success: function (res) {
            e.target.setAttribute('class', res);
        },
        error: function (res) {
            console.log(res);
        }
    });
}

$('.content-container').on('click', 'i', function (e) {
    if(e.target.classList.contains('repo-like')) {
        ajaxLikeDislike("/user/like", e);
    }
    if(e.target.classList.contains('repo-dislike')) {
        ajaxLikeDislike("/user/like", e);
    }
});