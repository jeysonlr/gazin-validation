<?php

declare(strict_types=1);

namespace ResponseError;

use JMS\Serializer\Annotation\Type;

class ResponseError
{
    /**
     * @var string
     * @Type("string")
     */
    private $message;

    /**
     * @var string
     * @Type("string")
     */
    private $internalmessage;

    /**
     * @var int
     * @Type("int")
     */
    private $internalcode;

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }

    /**
     * @return string|null
     */
    public function getInternalMessage(): ?string
    {
        return $this->internalmessage;
    }

    /**
     * @param string|null $internalmessage
     */
    public function setInternalMessage(?string $internalmessage): void
    {
        $this->internalmessage = $internalmessage;
    }

    /**
     * @return int|null
     */
    public function getInternalCode(): ?int
    {
        return $this->internalcode;
    }

    /**
     * @param int|null $internalcode
     */
    public function setInternalCode(?int $internalcode): void
    {
        $this->internalcode = $internalcode;
    }
}
