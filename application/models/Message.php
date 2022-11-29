<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Model {

    public function get_messages()
    {
        $query = 'SELECT    messages.user_id AS user_id,
                            messages.id AS message_id,
                            message AS message_content,
                            messages.created_at AS message_date,
                            CONCAT(u1.first_name," ", u1.last_name) AS message_sender_name
        FROM messages LEFT JOIN users u1 on messages.user_id = u1.id
        ORDER BY messages.created_at DESC';

        return $this->db->query($query)->result_array();
    }

    public function get_user_id($message_id)
    {
        $query = 'SELECT    messages.user_id AS user_id
        FROM messages';

        return $this->db->query($query)->result_array();
    }

    public function validate_message()
    {
        $this->form_validation->set_error_delimiters('<div>','</div>');
        $this->form_validation->set_rules('message_input', 'Message', 'required');

        if(!$this->form_validation->run())
        {
            return validation_errors();
        }
        else
        {
            return 'success';
        }
    }

    public function add_message($post)
    {
        $query = 'INSERT INTO messages(user_id, message, created_at, updated_at) VALUES (?,?,now(),now())';

        $values = array(
            $this->security->xss_clean($this->session->userdata('user_id')),
            $this->security->xss_clean($post)
        );

        $this->db->query($query, $values);
    }

}

?>