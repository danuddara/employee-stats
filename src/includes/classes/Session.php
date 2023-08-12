<?php

/**
 * This will be used to display alert messages when you are submitting data.
 */
class Session {

    public function setFlashMessage($type,$message=''): void
    {
        $_SESSION['flash_messages'][$type]=$message;
    }

    public function getFlashMessage($type)
    {
        $value = $_SESSION['flash_messages'][$type];
        //clear the flash message
        $this->setFlashMessage($type);
        return $value;
    }

    public function getFlashMessages()
    {
        $value = $_SESSION['flash_messages'] ?? [];
        $this->clear();
        return $value;
    }

    protected function clear(): void
    {
        $_SESSION['flash_messages'] = null;
    }
}