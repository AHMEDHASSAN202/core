<?php

namespace Modules\Core\DTOs;

use InvalidArgumentException;

abstract class AbstractDTO implements DtoInterface
{
    protected array|null $include;
    protected bool|null $paginated;
    protected int|null $limit;

    public function __construct(array $data)
    {
        if (!$this->map($data)) {
            throw new InvalidArgumentException('There\'e are missing data please check your request');
        }
        $this->paginated = $data['paginated'] ?? false;

        $this->limit = $data['limit'] ?? null;

        $this->include = isset($data['include']) ? extractLazyLoadObjects($data['include']) : null;
    }

    abstract protected function map(array $data): bool;

    public function getIsPaginated(): bool
    {
        return $this->paginated;
    }

}
