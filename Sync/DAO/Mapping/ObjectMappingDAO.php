<?php

/*
 * @copyright   2018 Mautic Inc. All rights reserved
 * @author      Mautic, Inc.
 *
 * @link        https://www.mautic.com
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\IntegrationsBundle\Sync\DAO\Mapping;

/**
 * Class ObjectMappingDAO
 */
class ObjectMappingDAO
{
    const SYNC_TO_MAUTIC = 'mautic';
    const SYNC_TO_INTEGRATION = 'integration';
    const SYNC_BIDIRECTIONALLY = 'bidirectional';

    /**
     * @var string
     */
    private $internalObjectName;

    /**
     * @var string
     */
    private $integrationObjectName;

    /**
     * @var array
     */
    private $internalIdMapping = [];

    /**
     * @var array
     */
    private $integrationIdMapping = [];

    /**
     * @var FieldMappingDAO[]
     */
    private $fieldMappings = [];

    /**
     * ObjectMappingDAO constructor.
     *
     * @param string $internalObjectName
     * @param string $integrationObjectName
     */
    public function __construct(string $internalObjectName, string $integrationObjectName)
    {
        $this->internalObjectName    = $internalObjectName;
        $this->integrationObjectName = $integrationObjectName;
    }

    /**
     * @param        $internalField
     * @param        $integrationField
     * @param string $direction
     *
     * @return ObjectMappingDAO
     */
    public function addFieldMapping($internalField, $integrationField, $direction = self::SYNC_BIDIRECTIONALLY): ObjectMappingDAO
    {
        $this->fieldMappings[] = new FieldMappingDAO(
            $this->internalObjectName,
            $internalField,
            $this->integrationObjectName,
            $integrationField,
            $direction
        );

        return $this;
    }

    /**
     * @return FieldMappingDAO[]
     */
    public function getFieldMappings(): array
    {
        return $this->fieldMappings;
    }

    /**
     * @param int $internalObjectId
     *
     * @return int|null
     */
    public function getMappedIntegrationObjectId(int $internalObjectId): ?int
    {
        if (array_key_exists($internalObjectId, $this->internalIdMapping)) {
            return $this->internalIdMapping[$internalObjectId];
        }

        return null;
    }

    /**
     * @param mixed $integrationObjectId
     *
     * @return mixed|null
     */
    public function getMappedInternalObjectId($integrationObjectId)
    {
        if (array_key_exists($integrationObjectId, $this->integrationIdMapping)) {
            return $this->integrationIdMapping[$integrationObjectId];
        }

        return null;
    }

    /**
     * @param int $internalObjectId
     * @param int $integrationObjectId
     *
     * @throws \LogicException
     */
    public function mapIds(int $internalObjectId, $integrationObjectId)
    {
        if (array_key_exists($internalObjectId, $this->internalIdMapping)) {
            throw new \LogicException(); // TODO better exception
        }
        $this->internalIdMapping[$internalObjectId]       = $integrationObjectId;
        $this->integrationIdMapping[$integrationObjectId] = $internalObjectId;
    }

    /**
     * @return string
     */
    public function getInternalObjectName(): string
    {
        return $this->internalObjectName;
    }

    /**
     * @return string
     */
    public function getIntegrationObjectName(): string
    {
        return $this->integrationObjectName;
    }
}