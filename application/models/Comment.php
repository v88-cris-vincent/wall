<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends CI_Model {

    public function get_comments_from_messages_id($message_id)
    {
        $safe_message_id = $this->security->xss_clean($message_id);

        $query = 'SELECT comments.user_id, comments.id, CONCAT(first_name, " ",last_name) AS comment_sender_name, comment AS comment_content, comments.created_at as comment_date
                    FROM comments LEFT JOIN users u1 on comments.user_id=u1.id
                    WHERE comments.message_id = ?';

        return $this->db->query($query, $safe_message_id)->result_array();
    }

    public function validate_comment()
    {
        $this->form_validation->set_error_delimiters('<div>','</div>');
        $this->form_validation->set_rules('comment_input', 'Comment', 'required');

        if(!$this->form_validation->run())
        {
            return validation_errors();
        }
        else
        {
            return 'success';
        }
    }

    public function add_comment($post)
    {
        $query = 'INSERT INTO comments(user_id, message_id, comment, created_at, updated_at) VALUES (?,?,?,now(),now())';

        $values = array(
            $this->security->xss_clean($this->session->userdata('user_id')),
            $this->security->xss_clean($post['message_id']),
            $this->security->xss_clean($post['comment_input'])
        );

        $this->db->query($query, $values);
    }

}

?>