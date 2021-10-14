<?php 
namespace App\Repositories;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Core\ProductionEnvironment;

ini_set('error_reporting', E_ALL); // or error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

class PayPalClient
{
    /**
     * Returns PayPal HTTP client instance with environment that has access
     * credentials context. Use this instance to invoke PayPal APIs, provided the
     * credentials have access.
     */
    public static function client()
    {
        return new PayPalHttpClient(self::environment());
    }

    /**
     * Set up and return PayPal PHP SDK environment with PayPal access credentials.
     * This sample uses SandboxEnvironment. In production, use LiveEnvironment.
     */
    public static function environment()
    {
        $clientId = env("CLIENT_ID") ?: "Adl7w3C5oegQRKft3V9ocI-9__dYmVxkFOMBUFcmgVInliiFjRjXYUXEIomg5F63F_aCo5AClX7Zybiz";
        $clientSecret = env("CLIENT_SECRET") ?: "EKpVcn3eDGF7PX-j_AcrSoCTuh1hF6Vt2c2vamrxP62GHGMo0r8DgYX3j87tV7lp7VhkeP3eljLzOwIr";
        return new ProductionEnvironment($clientId, $clientSecret);
    }
}