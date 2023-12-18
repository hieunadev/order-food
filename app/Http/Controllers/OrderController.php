<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
class OrderController extends Controller
{
    protected array $meals = ['breakfast', 'lunch', 'dinner'];

    public function get_dishes() {
        $json = \File::get('dishes.json');
        $data = json_decode($json, true);
        return $data["dishes"];
    }

    public function index(Request $request)
    {
        $meals = $this->meals;
        $people = "";
        $m = "";
        if ($get_order = $request->session()->get('order')) {
            $people = $get_order["people"];
            $m = $get_order["meal"];
        }

        return view('orders.index', compact('meals', 'people', 'm'));
    }

    public function postStepOne(Request $request)
    {
        $request->validate([
            'people' => ['required', 'max:10'],
            'meal' => ['required'],
        ]);
        $restaurant = "";
        $get_order = $request->session()->get('order');
        if (isset($get_order['restaurant']) && !empty($get_order['restaurant'])) {
            $restaurant = $get_order['restaurant'];
        }
        $order = $request->all();
        $order['restaurant'] = $restaurant;
        $request->session()->put('order', $order);

        return redirect()->route('step.two');
    }

    public function stepTwo(Request $request)
    {
        $restaurant = "";
        $get_order = $request->session()->get('order');
        $test = self::get_dishes();
        if (isset($get_order['restaurant']) && !empty($get_order['restaurant'])) {
            $restaurant = $get_order['restaurant'];
        }
        foreach ($test as $t) {
            if (in_array($get_order['meal'], $t['availableMeals'])) {
                $restaurants[] = $t['restaurant'];
            }
        }

        $res = array_unique($restaurants);
        return view('orders.step-two',compact('res', 'restaurant'));
    }

    public function postStepTwo(Request $request) {

        $request->validate([
            'restaurant' => ['required'],
        ]);

        $orders = $request->session()->get('order');
        $orders["restaurant"] = $request->get('restaurant');
        $request->session()->put('order', $orders);
        return redirect()->route("step.three");
    }

    public function stepThree(Request $request)
    {
        $get_order = $request->session()->get('order');
        $test = self::get_dishes();

        foreach ($test as $t) {
            if (in_array($get_order['meal'], $t['availableMeals']) && $t["restaurant"] == $get_order["restaurant"]) {
                $dish_name[] = $t['name'];
            }
        }
        $orders = array_unique($dish_name);
        return view('orders.step-three',compact('orders'));
    }

    public function postStepThree(Request $request)
    {
        $orders = $request->session()->get('order');

        $request->validate([
            'dishes.*' => [ 'required'],
            'serving' => [ function ($attribute, $value, $fail) use ($request) {
                    $orders = $request->session()->get('order');
                    $totalFoodQuantity = array_sum($request->get('serving'));
                    $numberOfPeopleSelected = $orders["people"];

                    if ($totalFoodQuantity >= $numberOfPeopleSelected && $totalFoodQuantity <= 10) {
                        return;
                    } else {
                        $fail('The total food quantity must be greater than or equal to the number of people and a maximum of 10 is allowed.');
                    }
                },
            ],
        ]);

        $dishes = $request->get('dishes');
        $servings = $request->get('serving');

        $orders['dishes'] = $dishes;
        $orders['servings'] = $servings;

        $request->session()->put('order', $orders);

        return view('orders.review', compact('orders', 'dishes', 'servings'));
    }

    public function review(Request $request)
    {
        $orders = $request->session()->get('order');

        $dishes = $request->get('dishes');
        $servings = $request->get('serving');

        return view('orders.review', compact('orders', 'dishes', 'servings'));
    }

}
