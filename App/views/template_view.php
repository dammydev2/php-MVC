<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Tasks Application</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto ">
            <li class="nav-item active">
                <a class="nav-link" href="/">all task</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/task/add">add task</a>
            </li>
        </ul>
        <div class="form-inline my-2 my-lg-0">
            <?php if ( isset($_COOKIE['auth'])): ?>
                <a class="nav-link" href="/auth/logout">logout</a>
            <?php else: ?>
                <a class="nav-link" href="/auth/login">login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<?php include 'app/views/'.$content_view; ?>
</body>
</html>