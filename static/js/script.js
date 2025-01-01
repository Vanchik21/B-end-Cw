
document.addEventListener('DOMContentLoaded', function () {
    const select = document.getElementById('select');
    const link = document.getElementById('sort-link');

    if (select && link) {
        if (select.dataset.view === 'genre-view') {
            link.href = `/event/view/${select.dataset.genreid}/`;
        } else {
            link.href = `/${select.dataset.module}`;
        }

        select.addEventListener('change', function () {
            if (select.dataset.view === 'event-view') {
                if (select.value !== 'default') {
                    link.href = `/${select.dataset.module}/sort/${select.value}/${select.dataset.genreid}/`;
                } else {
                    link.href = `/event/view/${select.dataset.genreid}/`;
                }
            } else {
                if (select.value !== 'default') {
                    link.href = `/${select.dataset.module}/sort/${select.value}/`;
                } else {
                    link.href = `/${select.dataset.module}/`;
                }
            }
        });
    }

    const menuBtn = document.getElementById('menuBtn');
    const menuBox = document.getElementById('menuBox');

    if (menuBtn && menuBox) {
        menuBtn.addEventListener('click', function () {
            menuBtn.classList.toggle('active');
            menuBox.classList.toggle('active');
        });

        const menuItems = document.querySelectorAll('.menu__item');
        menuItems.forEach(item => {
            item.addEventListener('click', function () {
                menuBtn.classList.remove('active');
                menuBox.classList.remove('active');
            });
        });
    }

    const commentForm = document.querySelector('.comment-form form');

    if (commentForm) {
        commentForm.addEventListener('submit', function (event) {
            event.preventDefault();

            const formData = new FormData(commentForm);

            fetch('/news/addComment', {
                method: 'POST',
                body: formData,
            })
                .then(response => response.text())
                .then(text => {
                    console.log('Raw response:', text);
                    try {
                        return JSON.parse(text);
                    } catch (error) {
                        console.error('Помилка парсінгу:', error);
                        throw new Error('Сервер повернув поламаний JSON');
                    }
                })
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Помилка:', error);
                });
        });
    }
    const deleteButtons = document.querySelectorAll('.comment-item .delete');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            const commentItem = button.closest('.comment-item');
            const formData = new FormData();
            formData.append('comment_id', button.dataset.commentId);

            fetch(`/news/deleteComment/${button.dataset.commentId}`, {
                method: 'POST',
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        commentItem.remove();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Помилка:', error);
                });
        });
    });

});
