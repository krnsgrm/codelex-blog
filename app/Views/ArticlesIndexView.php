<h1>Articles</h1>

<form method="get" action="/articles/create/">
    <button type="submit">Create new article</button>
</form>

<?php foreach ($articles as $article): ?>
    <h3>
        <a href="/articles/<?php echo $article->id(); ?>">
            <?php echo $article->title(); ?>
        </a>
    </h3>
    <p><?php echo $article->content(); ?></p>
    <p>
        <small>
            <?php echo $article->createdAt(); ?>
        </small>
    </p>
    <form method="post" action="/articles/<?php echo $article->id(); ?>">
        <input type="hidden" name="_method" value="DELETE"/>
        <button type="submit" onclick="return confirm('Are you sure?');">Delete</button>
    </form>
<?php endforeach; ?>
