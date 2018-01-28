<?php

namespace App\Repository\Contracts;

use App\Filter\FilterInterface;

interface CriteriaInterface
{
    /**
     * @return $this
     */
    public function resetScope();

    /**
     * Desconsidera os critérios para a próxima consulta
     * @param bool $status
     * @return $this
     */
    public function skipCriteria(bool $status = true);

    /**
     * Retorna os critérios
     * @return FilterInterface
     */
    public function getCriteria();

    /**
     * Efetua a consulta a partir de um critério
     * @param FilterInterface $criteria
     * @return $this
     */
    public function getByCriteria(FilterInterface $criteria);

    /**
     * Adiciona um novo critério
     * @param FilterInterface $criteria
     * @return $this
     */
    public function pushCriteria(FilterInterface $criteria);

    /**
     * Aplicação dos critérios na where
     * @return $this
     */
    public function applyCriteria();
}