<?php

namespace App\Services;

use App\Models\Product;

class CartService
{
    protected string $sessionKey = 'cart';

    public function getCart(): array
    {
        return session()->get($this->sessionKey, []);
    }

    public function add(Product $product, int $qty = 1): void
    {
        $cart = $this->getCart();

        if (isset($cart[$product->id])) {
            $cart[$product->id]['qty'] += $qty;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => $qty,
                'subtotal' => $product->price * $qty,
            ];
        }

        $cart[$product->id]['subtotal'] =
            $cart[$product->id]['price'] *
            $cart[$product->id]['qty'];

        session()->put($this->sessionKey, $cart);
    }

    public function update(int $id, int $qty): void
    {
        $cart = $this->getCart();

        if (isset($cart[$id])) {

            $cart[$id]['qty'] = $qty;

            $cart[$id]['subtotal'] =
                $cart[$id]['price'] * $qty;

            session()->put($this->sessionKey, $cart);
        }
    }

    public function remove(int $id): void
    {
        $cart = $this->getCart();

        unset($cart[$id]);

        session()->put($this->sessionKey, $cart);
    }

    public function clear(): void
    {
        session()->forget($this->sessionKey);
    }

    public function total(): float
    {
        return collect(
            $this->getCart()
        )->sum('subtotal');
    }
}