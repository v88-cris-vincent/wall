<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/wall_style.css"/>
    <title>Document</title>
</head>
<body>
    <?php   
            
    ?> 
    
    <nav>
        <h1>CodingDojo Wall </h1>
        <p> Welcome <?= $first_name; ?> </p>
        <a href="<?=base_url();?>logoff">log off</a>

        <div class="error"><?=$this->session->flashdata('input_errors');?></div>

        <h2 class="post">Post a Message</h2>
        <form action="<?=base_url();?>wall/add_message" method="POST">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>" />
            
            <textarea name="message_input"> </textarea>
            <input type="submit" value="Post a message">
        </form>

        <?php foreach($inbox as $message)
        { ?>

            <h3><?=$message['message_sender_name']?> - <?=$message['message_date'] ?> </h3>
            <input type="hidden" name="message_id" value="<?=$message['message_id']?>" >
            <br><p class="message"><?=$message['message_content']?></p>

            <?php if($message['user_id'] == $this->session->userdata('user_id'))
            { /* ?>
            
            <form action="<?=base_url();?>wall/edit_message" method="POST">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>" />
                <input type="hidden" name="user_id" value="<?=$user_id; ?>" />
                <input type="hidden" name="message_id" value="<?=$message_id; ?>" />
                <input type="submit" value="Edit a message">
            </form>

            <form action="<?=base_url();?>wall/delete_message" method="POST">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>" />
                <input type="hidden" name="user_id" value="<?=$user_id; ?>" />
                <input type="hidden" name="message_id" value="<?=$message_id; ?>" />
                <input type="submit" value="Delete a message">
            </form>

            <?php*/ } ?>
        
            <?php foreach($message['comments'] as $comment)
            { ?>
            <h4><?=$comment['comment_sender_name'] ?> - <?=$comment['comment_date'] ?></h4>
            <br><p><?=$comment['comment_content']?> </p>

                <?php if($comment['user_id'] == $this->session->userdata('user_id'))
                { /* ?>
                
                <form action="<?=base_url();?>wall/edit_message" method="POST">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>" />
                    <input type="hidden" name="user_id" value="<?=$user_id; ?>" />
                    <input type="hidden" name="message_id" value="<?=$message_id; ?>" />
                    <input type="submit" value="Edit a message">
                </form>

                <form action="<?=base_url();?>wall/delete_message" method="POST">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>" />
                    <input type="hidden" name="user_id" value="<?=$user_id; ?>" />
                    <input type="hidden" name="message_id" value="<?=$message_id; ?>" />
                    <input type="submit" value="Delete a message">
                </form>

                <?php*/ } ?>
            

            <?php } ?>

            <h3 class="posst_comment">Post a Comment</h3>
            <form action="<?=base_url();?>wall/add_comment" method="POST">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>" />
                <input type="hidden" name="user_id" value="<?=$message['user_id']; ?>" />
                <input type="hidden" name="message_id" value="<?=$message['message_id']; ?>" />
                <textarea name="comment_input"> </textarea>
                <input type="submit" value="Post a comment">
            </form>

            

        <?php } ?>
    </nav>
</body>
</html>