<?php

namespace App\Aspect;

use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\Before;
use Go\Lang\Annotation\After;
use Psr\Log\LoggerInterface;
use App\Aspect\Heal;

/**
 * Application logging aspect
 */
class LoggingAspect implements Aspect
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     *
     *
     */
    public function logEverywhere(MethodInvocation $invocation){
        // @Before("execution(public **->*(*))")
        $this->logger->info("################## AOP Log ##################");
        $this->logger->info($invocation, $invocation->getArguments());
        $this->logger->info("################## / AOP Log ##################");
    }

    /**
     *
     *
     */
    public function logEverywhere2(MethodInvocation $invocation){
        // @Before("@execution(App\Aspect\Heal)")

        echo "<br/><b> ... Healing ... </b><br/>";
    }

    /**
     * @param MethodInvocation $invocation
     *
     */
    public function beforePublicMethod(MethodInvocation $invocation)
    {
        // @Before("execution(public App\Http\Controllers\TransactionController->makeTransaction(*))")
        // @Before("execution(public **->*(*))")
        // @Before("execution(public App\Http\Controllers\TransactionController->makeTransaction(*))")
        // @Before("execution(public App\Http\Controllers\TransactionController->makeTransactionParam(*))")

        /* echo "<pre>";var_dump(
            get_class($invocation->getThis()),
            $invocation->getMethod(),
            $invocation->getArguments()
        );echo "</pre>"; */

        echo "<br/><b> ... aspects running before public method ... </b><br/>";
    }

    /**
     * @param MethodInvocation $invocation
     *
     *
     */
    public function beforePublicMethod2(MethodInvocation $invocation)
    {
        // @Before("execution(public App\Http\Controllers\PurchaseController->processPurchase(*))")

        echo "<br/><b> ... aspect running before public method ... </b><br/>";
    }

    /**
     * Writes a log info before method execution
     *
     * @param MethodInvocation $invocation
     *
     *
     */
    public function afterProtectedMethod(MethodInvocation $invocation)
    {
        // @Before("execution(protected App\Http\Controllers\PurchaseController->someProtectedProcedure(*))")
        // @After("execution(protected App\Http\Controllers\PurchaseController->someProtectedProcedure(*))")

        echo "<br/><b> ... aspect running after protected method ... </b><br/>";
    }
}