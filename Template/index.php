<?php
/**
 * 
 * Simple HTML template with PHP
 * 
 * @author Tibor Csik <csulok0000@gmail.com>
 * @copyright (c) 2014, Tibor Csik
 * @license The MIT License
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <title>GuestBook <?php echo self::VERSION;?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <style>
            label {display: inline-block; text-align: right; width: 100px;}
            button {margin-left: 100px;}
            .item {border: solid 1px #AAA; background: #EEE; margin-top: 10px;}
            .item .title {border-bottom: solid 1px #AAA; background: #DDD; padding: 2px 10px;}
            .item .date {float: right;}
            .item .comment {padding: 10px;}
        </style>
    </head>
    <body>
        <h1>GuestBook <?php echo self::VERSION;?></h1>
        <form method="POST">
            <div>
                <label>Nick:</label>
                <input type="text" name="nick" placeholder="Nick name" />
            </div>
            <div>
                <label>E-mail:</label>
                <input type="text" name="email" />
            </div>
            <div>
                <label>Comment:</label>
                <textarea name="comment"></textarea>
            </div>
            <div>
                <button type="submit">Comment</button>
            </div>
        </form>
        <div class="comments">
            <h2>Comments: </h2>
            <?php if (isset($data) && $data) {?>
                <?php foreach ($data as $comment) {?>
                    <div class="item">
                        <div class="title">
                            #<?php echo $comment['id'];?>
                            | Nick: <?php echo $comment['nick'];?> 
                            <?php if ($comment['email']) {?>
                            | E-mail: <a href="mailto: <?php echo $comment['email'];?>"><?php echo $comment['email'];?></a>
                            <?php } else {?>
                            | E-mail: -
                            <?php }?>
                            <div class="date"><?php echo date('Y-m-d H:i:s', $comment['createdAt']);?></div>
                        </div>
                        <div class="comment">
                            <?php echo $comment['comment'];?>
                        </div>
                    </div>
                <?php }?>
                <?php if (!isset($_GET['full']) || ! $_GET['full']) {?>
                    <br />
                    <a href="?full=1">View archive comments</a>
                <?php }?>
            <?php } else {?>
                No comments!
            <?php }?>
        </div>
    </body>
</html>