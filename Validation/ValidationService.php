<?php

declare(strict_types=1);

namespace Validation;

use Symfony\Component\Validator\Validator\ValidatorInterface;
use BaseEntity\BaseEntityInterface;
use Exception\EntityBadRequestException;
use Exception\EntityNotFoundException;
use Exception\EntitySymfonyException;
use Http\StatusHttp;

class ValidationService implements ValidationServiceInterface
{
    /**
     * @var ValidatorInterface
     */
    private $validationEntity;

    public function __construct(ValidatorInterface $validationEntity)
    {
        $this->validationEntity = $validationEntity;
    }

    /**
     * Verifica se existe retorno de consulta, se não existir retorna uma exception
     * @param BaseEntityInterface|null $entity
     * @param string $message
     * @throws EntityNotFoundException
     */
    public function notExist(?BaseEntityInterface $entity, $message = "registro"): void
    {
        if (empty($entity)) {
            throw new EntityNotFoundException(
                StatusHttp::NOT_FOUND,
                "Não foi encontrado nenhum $message!"
            );
        }
    }

    /**
     * Verifica se existe retorno de consulta, se já existir retorna uma exception
     * @param BaseEntityInterface|null $entity
     * @param string $message
     * @throws EntityBadRequestException
     */
    public function exist(?BaseEntityInterface $entity, $message = "Registro já existente!"): void
    {
        if (!empty($entity)) {
            throw new EntityBadRequestException(StatusHttp::BAD_REQUEST, $message);
        }
    }

    /**
     * Valida as restrições das propriedades de um entidade
     * @param BaseEntityInterface $entity
     * @throws EntitySymfonyException
     */
    public function validationEntity(BaseEntityInterface $entity): void
    {
        $errors = [];
        $dataEntity = $this->validationEntity->validate($entity);
        foreach ($dataEntity as $value) {
            if (!empty($value)) {
                array_push($errors, $value->getMessage());
            }
        }

        if (count($errors) > 0) {
            throw new EntitySymfonyException(
                StatusHttp::BAD_REQUEST,
                "",
                null,
                null,
                $errors
            );
        }
    }
}
