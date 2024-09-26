<?php view('partials/header'); ?>

<main class="container">
    <h1>View Post <?php echo $post->id; ?></h1>
    <div class="card">
        <div class="card-header">
            <h1><?php echo $post->title; ?></h1>
        </div>
        <div class="card-body">
            <p><?php echo $post->body; ?></p>
        </div>
    </div>
</main>

<?php view('partials/footer'); ?>