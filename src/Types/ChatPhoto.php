<?php

declare(strict_types=1);

namespace FondBot\Drivers\Telegram\Types;

use FondBot\Drivers\Type;

class ChatPhoto extends Type
{
    private $smallFileId;
    private $bigFileId;

    public function getSmallFileId(): string
    {
        return $this->smallFileId;
    }

    public function setSmallFileId(string $smallFileId): self
    {
        $this->smallFileId = $smallFileId;

        return $this;
    }

    public function getBigFileId(): string
    {
        return $this->bigFileId;
    }

    public function setBigFileId(string $bigFileId): self
    {
        $this->bigFileId = $bigFileId;

        return $this;
    }
}
