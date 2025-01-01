<?php

namespace controllers;

use core\Controller;
use models\Comment;
use models\News;
use models\Users;

class NewsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function actionIndex()
    {
        $rows = News::getAllNews();
        return $this->render(null, ['rows' => $rows]);
    }

    public function actionAdd()
    {
        if (!Users::isAdmin()) {
            $this->addErrorMessage('У вас недостатньо прав');
            return $this->redirect('/users/login');
        }

        $model = [
            'title' => '',
            'content' => '',
            'image' => ''
        ];

        if ($this->isPost) {
            $errors = [];
            $model = $_POST;

            if (News::doesNewsExist($_POST['title'])) {
                $errors['title'] = "Заголовок вже існує";
            }
            if (empty($_POST['title'])) {
                $errors['title'] = 'Заголовок обов`язково';
            }
            if (empty($_POST['content'])) {
                $errors['content'] = 'Вміст обов`язково';
            }
            if (empty($_FILES['image']['tmp_name'])) {
                $errors['image'] = 'Фото обов`язково';
            } else {
                $fileError = $_FILES['image']['error'];
                if ($fileError !== UPLOAD_ERR_OK) {
                    $errors['image'] = 'Помилка завантаження';
                }
            }

            if (count($errors) > 0) {
                return $this->render(null, [
                    'errors' => $errors,
                    'model' => $model
                ]);
            } else {
                News::addNews($_POST['title'], $_POST['content'], $_FILES['image']);
                return $this->redirect('/news');
            }
        }

        return $this->render(null, ['model' => $model]);
    }

    public function actionDelete($params)
    {
        $id = intval($params[0]);
        $yes = isset($params[1]) && $params[1] === 'yes';

        if (!Users::isAdmin()) {
            $this->addErrorMessage('У вас недостатньо прав');
            return $this->redirect('/users/login');
        }

        if ($id > 0) {
            $news = News::getNewsById($id);
            if (!$news) {
                $this->addErrorMessage('Не знайдено новину');
                return $this->render();
            }

            if ($yes) {
                $filePath = 'files/news/' . $news['image'];
                if (is_file($filePath)) {
                    unlink($filePath);
                }
                News::deleteNews($id);
                return $this->redirect('/news');
            }

            return $this->render(null, [
                'news' => $news
            ]);
        } else {
            $this->addErrorMessage('Неправильний ID');
            return $this->render();
        }
    }

    public function actionEdit($params)
    {
        $id = intval($params[0]);

        if (!Users::isAdmin()) {
            $this->addErrorMessage('У вас недостатньо прав');
            return $this->redirect('/users/login');
        }

        if ($id > 0) {
            $news = News::getNewsById($id);
            if (!$news) {
                $this->addErrorMessage('Не знайдено новину');
                return $this->render();
            }

            if ($this->isPost) {
                $errors = [];
                $model = $_POST;

                if (empty($model['title'])) {
                    $errors['title'] = 'Заголовок обов`язково';
                }
                if (empty($model['content'])) {
                    $errors['content'] = 'Вміст обов`язково';
                }

                if (count($errors) > 0) {
                    return $this->render(null, [
                        'errors' => $errors,
                        'model' => $model,
                        'news' => $news
                    ]);
                } else {
                    News::updateNews($id, $model);

                    if (!empty($_FILES['image']['tmp_name'])) {
                        News::changeImage($id, $_FILES['image']);
                    }

                    return $this->redirect('/news');
                }
            }

            return $this->render(null, [
                'news' => $news,
                'model' => $news
            ]);
        } else {
            $this->addErrorMessage('Неправильний ID');
            return $this->render();
        }
    }

    public function actionView($params)
    {
        $id = intval($params[0]);
        $newsItem = News::getNewsById($id);
        $comments = Comment::getCommentsByNewsId($id);
        return $this->render(null, [
            'newsItem' => $newsItem,
            'comments' => $comments
        ]);
    }

    public function actionAddComment()
    {
        header('Content-Type: application/json');

        if (!Users::isUserLogged()) {
            echo json_encode(['success' => false, 'message' => 'Вам потрібно увійти']);
            exit;
        }

        if ($this->isPost) {
            $news_id = $_POST['news_id'];
            $user_id = Users::getLoggedUserId();
            $content = $_POST['content'];
            $created_at = date('Y-m-d H:i:s');

            if (empty($content)) {
                echo json_encode(['success' => false, 'message' => 'Коментар не може бути пустим']);
                exit;
            }

            Comment::addComment($news_id, $user_id, $content, $created_at);
            echo json_encode(['success' => true, 'message' => 'Комент додано успішно']);
            exit;
        }

        echo json_encode(['success' => false, 'message' => 'Помилка запиту']);
        exit;
    }

    public function actionDeleteComment($params)
    {
        header('Content-Type: application/json');

        if (!Users::isUserLogged()) {
            echo json_encode(['success' => false, 'message' => 'Вам потрібно увійти, щоб видалити']);
            exit;
        }

        $comment_id = intval($params[0]);
        $comment = Comment::findCommentById($comment_id);

        if (!$comment) {
            echo json_encode(['success' => false, 'message' => 'Коментар не знайдено']);
            exit;
        }

        $news_id = $comment['news_id'];
        $user_id = Users::getLoggedUserId();

        if ($comment['user_id'] == $user_id || Users::isAdmin()) {
            Comment::deleteComment($comment_id);
            echo json_encode(['success' => true, 'message' => 'Коментар видалено успішно']);
        } else {
            echo json_encode(['success' => false, 'message' => 'У вас недостатньо прав']);
        }
        exit;
    }

    public function actionSort($params)
    {
        $field = $params[0];
        $rows = News::getSortedNews($field);
        return $this->render('views/news/index.php', ['rows' => $rows]);
    }
}
