<?php if ($this->data['error']) :
    $this->setVar('error', $this->data['error']);
    echo $this->include('_templates/messages/errors');
elseif ($this->data['success']) :
    $this->setVar('success', $this->data['success']);
    echo $this->include('_templates/messages/success');
endif;
