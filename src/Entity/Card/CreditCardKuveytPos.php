<?php

namespace Mews\Pos\Entity\Card;

/**
 * Class CreditCardGarantiPos
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
