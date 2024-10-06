<?php
/**
 * ProcessingStatus
 *
 */




namespace VenosT\AllegroApiClient\Model;
use VenosT\AllegroApiClient\ObjectSerializer;

/**
 * ProcessingStatus Class Doc Comment
 *
 * @category Class
 * @description The processing status of the command.
 * @package  VenosT\AllegroApiClient
 */
class ProcessingStatus
{
    /**
     * Possible values of this enum
     */
    const QUEUEING = 'QUEUEING';
    const RUNNING = 'RUNNING';
    const VALIDATED_AND_RUNNING = 'VALIDATED_AND_RUNNING';
    const RUNNING_BUT_WITH_ERRORS = 'RUNNING_BUT_WITH_ERRORS';
    const SUCCESSFUL = 'SUCCESSFUL';
    const PARTIAL_SUCCESS = 'PARTIAL_SUCCESS';
    const ERROR = 'ERROR';
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::QUEUEING
            self::RUNNING
            self::VALIDATED_AND_RUNNING
            self::RUNNING_BUT_WITH_ERRORS
            self::SUCCESSFUL
            self::PARTIAL_SUCCESS
            self::ERROR
        ]
    }
}
