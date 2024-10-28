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
        $this->user = new User([
            'name' => $customer,
            'birthday' => now()->setDate($year, $month, $day),
            'email' => uniqid() . '@example.com',
            'password' => Hash::make('secret'),
            'remember_token' => Str::random(10),
        ]);
        $this->user->save();
    }

    /**
     * @Given there is :qty :carName car for rent
     */
    public function thereIsCarForRent($qty, $carName)
    {
        Car::insert([[
            'car' => $carName,
            'qty' => $qty
        ]]);
    }

    /**
     * @When :customer, wants to rent :carName car
     */
    public function wantsToRentACar($customer, $brand)
    {
        $this->response = $this->actingAs($this->user, 'sanctum')->json('POST', '/api/rent', [
            'car' => $brand
        ]);
    }

    /**
     * @Then :customer will be able to rent a car
     */
    public function willBeAbleToRentACar($customer)
    {
        Assert::assertEquals($this->response->getStatusCode(), 201);
    }

    /**
     * @Then :customer will be not able to rent a car
     */
    public function willBeNotAbleToRentACar($customer)
    {
        Assert::assertEquals($this->response->getStatusCode(), 403);
    }

    /**
     * @Given :customer has already rented :carName car
     */
    public function hasAlreadyRentedCar($customer, $carName)
    {
        $this->user->car = $carName;
    }

    /**
     * @Given there are following cars:
     */
    public function thereAreFollowingCars(TableNode $table)
    {
        Car::insert($table->getHash());
    }

    /**
     * @Then :customer will have :carName car
     */
    public function willHaveCar($customer, $carName)
    {
        $this->user->refresh();
        Assert::assertEquals($carName, $this->user->car);
    }

    /**
     * @Then there will be :qty :carName cars available
     */
    public function thereWillBeCarsAvailable($qty, $carName)
    {
        Assert::assertEquals($qty, Car::where('car', $carName)->first()->qty);
    }
}
