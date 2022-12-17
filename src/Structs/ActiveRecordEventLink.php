<?php

namespace Smoren\Yii2\EventRouter\Structs;

use Smoren\EventRouter\Interfaces\EventLinkInterface;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;

class ActiveRecordEventLink implements EventLinkInterface
{
    /**
     * @var ActiveRecord
     */
    protected ActiveRecord $link;

    /**
     * @param ActiveRecord $link
     */
    public function __construct(ActiveRecord $link)
    {
        $this->link = $link;
    }

    /**
     * {@inheritDoc}
     * @throws NotSupportedException
     */
    public function getId(): string
    {
        $pk = $this->link->getPrimaryKey();
        if(is_array($pk)) {
            throw new NotSupportedException(
                'ActiveRecordEventLink can return ID only for models with single primary key'
            );
        }
        return $pk;
    }

    /**
     * {@inheritDoc}
     */
    public function getType(): string
    {
        return get_class($this->link);
    }

    /**
     * {@inheritDoc}
     */
    public function getData(): array
    {
        return $this->link->toArray();
    }
}
