<?php


namespace Mews\Pos\Factory;


use Mews\Pos\Entity\Account\EstPosAccount;
use Mews\Pos\Entity\Account\GarantiPosAccount;
use Mews\Pos\Entity\Account\PayForAccount;
use Mews\Pos\Entity\Account\PosNetAccount;
use Mews\Pos\Entity\Account\KuveytPosAccount;
use Mews\Pos\Exceptions\MissingAccountInfoException;
use Mews\Pos\Gateways\PayForPos;
use Mews\Pos\Entity\Account\VakifBankAccount;
class AccountFactory
{

    /**
     * @param string $bank
     * @param string $clientId
     * @param string $username
     * @param string $password
     * @param string $model
     * @param null $storeKey
     * @param string $lang
     * @return EstPosAccount
     * @throws MissingAccountInfoException
     */
    public static function createEstPosAccount(string $bank, string $clientId, string $username, string $password, string $model = 'regular', $storeKey = null, $lang = 'tr'): EstPosAccount
    {
        self::checkParameters($model, $storeKey);

        return new EstPosAccount($bank, $model, $clientId, $username, $password, $lang, $storeKey);
    }

    /**
     * @param string $bank
     * @param string $merchantId
     * @param string $userCode
     * @param string $userPassword
     * @param string $model
     * @param null $merchantPass
     * @param string $lang
     * @return PayForAccount
     * @throws MissingAccountInfoException
     */
    public static function createPayForAccount(string $bank, string $merchantId, string $userCode, string $userPassword, string $model = 'regular', $merchantPass = null, $lang = PayForPos::LANG_TR): PayForAccount
    {
        self::checkParameters($model, $merchantPass);

        return new PayForAccount($bank, $model, $merchantId, $userCode, $userPassword, $lang, $merchantPass);
    }

    /**
     * @param string $bank
     * @param string $clientId
     * @param string $username
     * @param string $password
     * @param string $terminalId
     * @param string $model
     * @param string|null $storeKey
     * @param string|null $refundUsername
     * @param string|null $refundPassword
     * @param string $lang
     * @return GarantiPosAccount
     * @throws MissingAccountInfoException
     */
    public static function createGarantiPosAccount(string $bank, string $clientId, string $username, string $password, string $terminalId, string $model = 'regular', ?string $storeKey = null, ?string $refundUsername = null, ?string $refundPassword = null, string $lang = 'tr'): GarantiPosAccount
    {
        self::checkParameters($model, $storeKey);

        return new GarantiPosAccount($bank, $model, $clientId, $username, $password, $lang, $terminalId, $storeKey, $refundUsername, $refundPassword);
    }

    /**
     * @param string $bank
     * @param string $clientId
     * @param string $username
     * @param string $password
     * @param string $terminalId
     * @param string $model
     * @param string|null $storeKey
     * @param string|null $refundUsername
     * @param string|null $refundPassword
     * @param string $lang
     * @return KuveytPosAccount
     * @throws MissingAccountInfoException
     */
    public static function createKuveytPosAccount(string $bank, string $clientId, string $username, string $password, string $terminalId, string $model = 'regular', ?string $storeKey = null, ?string $refundUsername = null, ?string $refundPassword = null, string $lang = 'tr'): KuveytPosAccount
    {
        self::checkParameters($model, $storeKey);

        return new KuveytPosAccount($bank, $model, $clientId, $username, $password, $lang, $terminalId, $storeKey, $refundUsername, $refundPassword);
    }


    /**
     * @param string $bank
     * @param string $clientId
     * @param string $username
     * @param string $password
     * @param string $terminalId
     * @param string $posNetId
     * @param string $model
     * @param string|null $storeKey
     * @param string $lang
     * @return PosNetAccount
     * @throws MissingAccountInfoException
     */
    public static function createPosNetAccount(string $bank, string $clientId, string $username, string $password, string $terminalId, string $posNetId, string $model = 'regular', ?string $storeKey = null, string $lang = 'tr'): PosNetAccount
    {
        self::checkParameters($model, $storeKey);

        return new PosNetAccount($bank, $model, $clientId, $username, $password, $lang, $terminalId, $posNetId, $storeKey);
    }

    private static function checkParameters($model, $storeKey)
    {
        if ('regular' !== $model && null === $storeKey) {
            throw new MissingAccountInfoException("$model requires storeKey!");
        }
    }
    public static function createVakifBankAccount(string $bank, string $clientId, string $password, string $terminalId, string $model = 'regular', $merchantType = 0, $subMerchantId = null): VakifBankAccount
    {
        self::checkVakifBankMerchantType($merchantType, $subMerchantId);

        return new VakifBankAccount($bank, $model, $clientId, $password, $terminalId, $merchantType, $subMerchantId);
    }
    private static function checkVakifBankMerchantType(int $merchantType, ?string $subMerchantId)
    {
        if (2 === $merchantType && empty($subMerchantId)) {
            throw new MissingAccountInfoException("SubMerchantId is required for sub branches!");
        }
        if (!in_array($merchantType, VakifBankAccount::getMerchantTypes())) {
            throw new MissingAccountInfoException("Invalid MerchantType!");
        }
    }
}
