<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CarController extends Controller
{
    public function showAll() {
        $cars = Car::with('category')->get();

        return view('index', compact('cars'));
    }

    public function cart()
    {
        return view('basquet');
    }

    public function addToCart($id)
    {
        $car = Car::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $car->name,
                "quantity" => 1,
                "price" => $car->price,
                "image" => $car->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Car added to cart successfully!');
    }

    public function updateCart(Request $request)
    {
        if ($request->quantity == 0) {
            $cart = session()->get('cart');
            unset($cart[$request->id]);
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }

        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function removeCart(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Car removed successfully');
        }
    }

    public function list() {
        $cars =  Car::with('category')->get();
        $id = 1;
        return view('car.index', compact('cars', 'id'));
    }

    public function create()
    {
        $categories =  Category::all();
        return view("car.create", compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'make' => 'required',
            'model' => 'required',
            'registration' => 'required',
            'engine_size' => 'required',
            'category_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {

            $Car = new Car;
            $Car->name = $request->name;
            $Car->slug = Str::slug($request->name);
            $Car->price = $request->price;
            $Car->make = $request->make;
            $Car->model = $request->model;
            $Car->registration = $request->registration;
            $Car->engine_size = $request->engine_size;
            $Car->category_id = $request->category_id;
            $Car->image = 'https://http2.mlstatic.com/D_NQ_NP_731664-MCO40978106967_032020-O.webp';
            $Car->save();

             return response()->json(["status" => true, "msg" => "You have successfully create new Car ", "redirect_location" => url("/car/create")]);
        }
    }

    public function edit($id)
    {
        $car = Car::find($id);
        $categories =  Category::all();
        return view("car.edit", compact("car", "categories"));
    }

    public function update(Car $car, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'make' => 'required',
            'model' => 'required',
            'registration' => 'required',
            'engine_size' => 'required',
            'category_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {

            $car->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'price' => $request->price,
                'make' => $request->make,
                'model' => $request->model,
                'registration' => $request->registration,
                'engine_size' => $request->engine_size,
                'category_id' => $request->category_id
            ]);

            return response()->json(["status" => true, "msg" => "You have successfully edit Car, ", "redirect_location" => url("/cars")]);
        }
    }

    public function delete(Car $car)
    {
        $car->delete();

        return back()->with('success', 'Car has been deleted');
    }




}
