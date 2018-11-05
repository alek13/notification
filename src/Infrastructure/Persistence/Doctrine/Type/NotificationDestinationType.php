<?php
declare(strict_types=1);

namespace Shippinno\Notification\Infrastructure\Persistence\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\JsonType;
use Shippinno\Notification\Domain\Model\Destination;

class NotificationDestinationType extends JsonType
{
    /**
     * {@inheritdoc}
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform = null)
    {
        /** @var Destination $value */
        return $value->typedJsonRepresentation();
    }

    /**
     * {@inheritdoc}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform = null)
    {
        $type = json_decode($value, true)['type'];
        $class = 'Shippinno\\Notification\\Domain\\Model\\' . $type;

        return $class::fromJsonRepresentation($value);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'notification_destination';
    }
}