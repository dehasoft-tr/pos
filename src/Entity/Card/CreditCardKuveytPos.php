<?php

namespace Mews\Pos\Entity\Card;

/**
 * Class CreditCardKuveytPos
 */
class CreditCardKuveytPos extends AbstractCreditCard
{
    /**
     * @inheritDoc
     */
    public function getExpirationDate(): string
    {
        return $this->getExpireMonth().$this->getExpireYear();
    }
}
