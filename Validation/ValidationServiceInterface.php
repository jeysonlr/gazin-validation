<?php

declare(strict_types=1);

namespace Validation;

use BaseEntity\BaseEntityInterface;

interface ValidationServiceInterface
{
    /**
     * @param BaseEntityInterface|null $entity
     * @param string $message
     */
    public function notExist(?BaseEntityInterface $entity, $message = "registro"): void;

    /**
     * @param BaseEntityInterface|null $entity
     * @param string $message
     */
    public function exist(?BaseEntityInterface $entity, $message = "Registro já existente!"): void;

    /**
     * @param BaseEntityInterface $entity
     */
    public function validationEntity(BaseEntityInterface $entity): void;
}
