<?php

declare(strict_types=1);

namespace Exception;

use ResponseError\ResponseError;
use Exception;

class BaseException extends Exception
{
    /**
     * @var null|string
     */
    private $messageError;

    /**
     * @var null|string
     */
    private $internalMessage;

    /**
     * @var null|int
     */
    private $internalCode;

    /**
     * @var array
     */
    private $arrayMessage;

    public function __construct(
        int $statusCode,
        ?string $messageError = "",
        ?string $internalMessage = null,
        ?int $internalCode = null,
        $arrayMessage = []
    ) {
        $this->messageError = $messageError;
        $this->internalMessage = $internalMessage;
        $this->internalCode = $internalCode;
        $this->arrayMessage = $arrayMessage;
        parent::__construct($messageError, $statusCode, null);
    }

    /**
     * @return array
     */
    public function getError(): array
    {
        return [$this->createError($this->messageError)];
    }

    /**
     * @return array
     */
    public function getCustomError(): array
    {
        $countError = !empty($this->arrayMessage) ? count($this->arrayMessage) : 0;
        if ($countError > 0) {
            $customErrors = [];
            foreach (range(1, $countError) as $i) {
                array_push($customErrors, $this->createError($this->arrayMessage[$i - 1]));
            }
            return $customErrors;
        }
        return [$this->createError($this->messageError)];
    }

    /**
     * @param $message
     * @return ResponseError
     */
    private function createError($message): ResponseError
    {
        $error = new ResponseError();
        $error->setMessage($message);
        $error->setInternalMessage($this->internalMessage);
        $error->setInternalCode($this->internalCode);
        return $error;
    }

    /**
     * @return string|null
     */
    public function getInternalMessage(): ?string
    {
        return $this->internalMessage;
    }
}
