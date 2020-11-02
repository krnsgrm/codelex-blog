<a href="/">Back</a>
<h1><?php echo $article->title(); ?></h1>
<p><?php echo $article->content(); ?></p>
<p>
    <small>
        <b><?php echo $article->createdAt(); ?></b>
    </small>
</p>
<hr>
<p>

</p>
<hr>

<hr>
<p>
    <?php if(!empty($comments)): ?>

        <?php foreach($comments as $comment): ?>

            <b><?php echo $comment->name(); ?>: </b>
            <?php echo $comment->comment(); ?>
            <br>
            <small><?php echo $comment->createdAt(); ?></small>
            <br>
            <form method="post" action="/articles/<?php echo $article->id(); ?>/comments/<?php echo $comment->id(); ?>">
                <input type="hidden" name="_method" value="DELETE" />
                <button type="submit" onclick="return confirm('Are you sure?');">Delete</button>
            </form>
            <br>
            <br>

        <?php endforeach; ?>

    <?php else: ?>
    <strong>No comments for this article</strong>
    <?php endif; ?>
</p>
<hr>
<form method="post" action="/articles/<?php echo $article->id();?>/comments">
    <label for="name">Name</label><br>
    <input type="text" id="name" name="name"><br><br>
    <label for="comment">Comment</label><br>
    <textarea name="comment" id="comment" cols="35" rows="7"></textarea><br>
    <button type="submit">Submit</button>
</form>