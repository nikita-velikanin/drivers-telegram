<?php

declare(strict_types=1);

namespace FondBot\Drivers\Telegram\Types;

use FondBot\Drivers\Type;
use FondBot\Templates\Keyboard;

class ReplyKeyboardMarkup extends Type
{
    private $keyboard;
    private $resizeKeyboard;
    private $oneTimeKeyboard;
    private $selective;

    public static function create(Keyboard $keyboard)
    {
        return (new static)
            ->setKeyboard(KeyboardButton::createFromTemplate($keyboard->getButtons()))
            ->setResizeKeyboard($keyboard->getParameters()->get('resize_keyboard', true))
            ->setOneTimeKeyboard($keyboard->getParameters()->get('one_time_keyboard', true))
            ->setSelective($keyboard->getParameters()->get('selective'));
    }

    /**
     * @return KeyboardButton[]
     */
    public function getKeyboard(): array
    {
        return $this->keyboard;
    }

    /**
     * @param KeyboardButton[] $keyboard
     *
     * @return ReplyKeyboardMarkup
     */
    public function setKeyboard(array $keyboard): self
    {
        $this->keyboard = $keyboard;

        return $this;
    }

    public function getResizeKeyboard(): ?bool
    {
        return $this->resizeKeyboard;
    }

    public function setResizeKeyboard(?bool $resizeKeyboard): self
    {
        $this->resizeKeyboard = $resizeKeyboard;

        return $this;
    }

    public function getOneTimeKeyboard(): ?bool
    {
        return $this->oneTimeKeyboard;
    }

    public function setOneTimeKeyboard(?bool $oneTimeKeyboard): self
    {
        $this->oneTimeKeyboard = $oneTimeKeyboard;

        return $this;
    }

    public function getSelective(): ?bool
    {
        return $this->selective;
    }

    public function setSelective(?bool $selective): self
    {
        $this->selective = $selective;

        return $this;
    }

    public function toNative()
    {
        $keyboard = collect($this->keyboard)
            ->transform(function (KeyboardButton $value) {
                return $value->toNative();
            })
            ->toArray();

        return collect([
            'keyboard' => [$keyboard],
            'resize_keyboard' => $this->resizeKeyboard,
            'one_time_keyboard' => $this->oneTimeKeyboard,
            'selective' => $this->selective,
        ])
            ->filter(function ($value) {
                return $value !== null;
            })
            ->toArray();
    }
}
