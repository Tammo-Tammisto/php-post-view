<?php view('partials/header'); ?>

<main class="container">
    <a class="btn btn-primary" href="/admin/posts/create">New Post</a>
    <table class="table table-striped table-hoverable">
        <thead>
            <th>Id</th>
            <th>Title</th>
            <th>Actions</th>
        </thead>
        <tbody>
            <?php foreach ($posts as $post): ?>
                <tr>
                    <td><?= $post->id ?></td>
                    <td><?= $post->title ?></td>
                    <td>
                        <div class="btn-group" role="group">
                            <a class="btn btn-info" href="/admin/posts/view/<?= $post->id ?>">View</a>
                            <a class="btn btn-warning">Edit</a>
                            <a class="btn btn-danger">Delete</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</main>

<?php view('partials/footer'); ?>