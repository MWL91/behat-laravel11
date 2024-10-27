<?php

use App\Models\Car;
use App\Models\User;
use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\Concerns\InteractsWithAuthentication;
use Illuminate\Foundation\Testing\Concerns\MakesHttpRequests;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Testing\TestResponse;
use PHPUnit\Framework\Assert;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    use MakesHttpRequests,
        InteractsWithAuthentication;

    private User $user;
    private TestResponse $response;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->app = require Application::inferBasePath().'/bootstrap/app.php';
        $this->app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();
        Car::truncate();
    }

    /**
     * @Given there is a :customer, that was born in :year-:month-:day
     */
    public function thereIsAThatWasBornIn($customer, $year, $month, $day)
    {
        throw new PendingException();
    }

    /**
     * @Given there is :arg2 :arg1 car for rent
     */
    public function thereIsCarForRent($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @When :arg1, wants to rent :arg2 car
     */
    public function wantsToRentCar($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Then :arg1 will be able to rent a car
     */
    public function willBeAbleToRentACar($arg1)
    {
        throw new PendingException();
    }
}
