<?php

namespace App\Libs\Mailchimp;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class MailchimpHttpException extends BadRequestHttpException
{
    private $errors;

    public $status = 422;

    /**
     * @param string     $message  The internal exception message
     * @param \Exception $previous The previous exception
     * @param int        $code     The internal exception code
     * @param array      $headers
     */
    public function __construct(int $status, string $message = null, array $errors, \Exception $previous = null, int $code = 0, array $headers = [])
    {
        parent::__construct($message, $previous, $code, $headers);
        $this->errors = $errors;
        $this->status = $status;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getStatus()
    {
        return $this->status;
    }
}
