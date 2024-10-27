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
     * @Given there is :qty :carName car for rent
     */
    public function thereIsCarForRent($qty, $carName)
    {
        throw new PendingException();
    }

    /**
     * @When :customer, wants to rent :carName car
     */
    public function wantsToRentACar($customer, $brand)
    {
        throw new PendingException();
    }

    /**
     * @Then :customer will be able to rent a car
     */
    public function willBeAbleToRentACar($customer)
    {
        throw new PendingException();
    }
}
