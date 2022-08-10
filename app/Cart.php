<?php

namespace App;

class Cart
{
    public $services = null;
    public $totalPrice = 0;
    public $animals = null;

    public function __construct($oldService)
    {
        if ($oldService) {
            $this->services = $oldService->services;
            $this->animals = $oldService->animals;
            $this->totalPrice = $oldService->totalPrice;
        }
    }

    public function add($services, $id)
    {
        try {
            $addService = ["price" => $services->price, "services" => $services];
            if ($this->services) {
                if (array_key_exists($id, $this->services)) {
                    $addService = array_unique($id);
                }
            }

            $addService["price"] = $services->price;
            $this->services[$id] = $addService;
            $this->totalPrice += $services->price;
        } catch (\Throwable $e) {
            return redirect()
                ->route("transaction.index") 
                ->with("error", $e->getMessage());
        }
    }

    public function addAnimal($animals, $id)
    {
        try {
            $addAnimal = [
                "name" => $animals->petName,
                "animals" => $animals,
            ];
            if ($this->animals) {
                if (array_key_exists($id, $this->animals)) {
                    $addAnimal = array_unique($id);
                }
            }
            $this->animals[$id] = $addAnimal;
        } catch (\Throwable $e) {
            return redirect()
                ->route("transaction.index")
                ->with("error", $e->getMessage());
        }
    }

    public function removeService($id)
    {
        $this->totalPrice -= $this->services[$id]["price"];
        unset($this->services[$id]);
        unset($this->animals[$id]);
    }
}
