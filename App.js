import React, { useState } from "react";

function App() {
  const [cart, setCart] = useState([]);

  const products = [
    { id: 1, name: "Toothpaste", price: 5 },
    { id: 2, name: "Soap", price: 3 },
    { id: 3, name: "Tissue", price: 2 },
  ];

  const addToCart = (item) => {
    const existing = cart.find((i) => i.id === item.id);
    if (existing) {
      setCart(
        cart.map((i) =>
          i.id === item.id ? { ...i, quantity: i.quantity + 1 } : i
        )
      );
    } else {
      setCart([...cart, { ...item, quantity: 1 }]);
    }
  };

  const removeFromCart = (id) => {
    setCart(cart.filter((item) => item.id !== id));
  };

  const getTotal = () =>
    cart.reduce((sum, item) => sum + item.price * item.quantity, 0);

  return (
    <div style={{ padding: "20px", fontFamily: "Arial" }}>
      <h1>Essentials Store 🛍️</h1>

      <h2>Products</h2>
      {products.map((item) => (
        <div key={item.id} style={{ marginBottom: "10px" }}>
          {item.name} - ${item.price}
          <button
            onClick={() => addToCart(item)}
            style={{ marginLeft: "10px" }}
          >
            Add to Cart
          </button>
        </div>
      ))}

      <hr />

      <h2>Shopping Cart</h2>
      {cart.length === 0 ? (
        <p>Your cart is empty.</p>
      ) : (
        cart.map((item) => (
          <div key={item.id} style={{ marginBottom: "10px" }}>
            {item.name} x {item.quantity} — ${item.price * item.quantity}
            <button
              onClick={() => removeFromCart(item.id)}
              style={{ marginLeft: "10px" }}
            >
              Remove
            </button>
          </div>
        ))
      )}

      <h3>Total: ${getTotal()}</h3>
    </div>
  );
}

export default App;
